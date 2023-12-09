<?php
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Post;
    use App\Models\Photo;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Response;
    use App\Models\Like;
    use App\Models\Comment;
use App\Models\User;
use App\Repositories\PhotoRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Profiler\Profile;

    class PostController extends Controller{
        protected $userRepository;
        protected $photo;
        public function __construct(UserRepository $userRepository,PhotoRepository $photo) {
            $this->userRepository = $userRepository;
            $this->photo = $photo;
        }
        public function index(){
            return view('welcome');
        }
        // đăng post
        public function store(Request $request)
        {
            $title = $request->input('title');
            $id = auth()->id();
            $images = array();

            // Kiểm tra title và ảnh
            if(empty($title) && empty($request->file('image'))) {
                return redirect()->back()->withErrors(['message' => 'Title và ảnh không được bỏ trống']);
            }

            if ($request->hasFile('image')) {
                $file_count = count($request->file('image'));
                for ($i = 0; $i < $file_count; $i++) {
                    $file = $request->file('image')[$i];
                    $file_name = $file->getClientOriginalName();
                    $file_ext = $file->getClientOriginalExtension();
                    $file_type = $file->getClientMimeType();
                    $file_size = $file->getSize();

                    $extensions = array("jpg", "jpeg", "png", "gif", "mp4", "avi", "mpeg");
                    $max_size = 23 * 1024 * 1024;
                    if (!in_array($file_ext, $extensions)) {
                        return "Chỉ hỗ trợ upload file JPEG, PNG, GIF, MP4, AVI, MPEG";
                    }

                    if ($file_size > $max_size) {
                        return 'Kích thước ảnh/quay phim quá lớn';
                    }

                    $directory = "img/upload/";
                    if (!file_exists($directory)) {
                        mkdir($directory, 0777, true);
                    }

                    $new_name = uniqid('', true) . '.' . $file_ext;
                    $file->move($directory, $new_name);
                    $images[] = $new_name;
                }
            }
            $posts_id = $this->userRepository->CreatePost($title,$id,'post');


            foreach ($images as $image) {
                $this->photo->createPhoto($id,$posts_id,$image);
                
            }

            return redirect('/');
        }
        // like post
       
        public function like(Request $request)
        {
            $postId = $request->input('post_id');
            $userId = $request->input('user_id');
            
            // Kiểm tra xem người dùng đã like bài viết này chưa
            $like = DB::table('like')->where('post_id', $postId)->where('user_id', $userId)->first();

            if ($like) {
                // Nếu người dùng đã like bài viết này thì xóa like đó
                DB::table('like')->where('post_id', $postId)->where('user_id', $userId)->delete();

                // Trả về số lượng like hiện tại của bài viết
                $postLikes = DB::table('like')->where('post_id',$postId)->count();
                DB::table('post')->where('ID', $postId)->update(['Likes' => $postLikes]);
                return response()->json(['success' => true, 'likes' => $postLikes]);
            } else {
                // Tạo mới một đối tượng like
                DB::table('like')->insert([
                    'post_id' => $postId,
                    'user_id' => $userId,
                    'created_at' => now()
                ]);

                // Trả về số lượng like hiện tại của bài viết
                $postLikes = DB::table('like')->where('post_id',$postId)->count();
                DB::table('post')->where('ID',$postId)->increment('Likes');
                return response()->json(['success' => true, 'likes' => $postLikes]) ;
            }
        }

        // check like post
        // public function CheckLike(Request $request){
        //     $user_id = $request->input('user_id');
        //     $post_id = $request->input('post_id');
        //     $liked = true;
        //     $check = DB::table('like')->where('user_id',$user_id)->where('post_id',$post_id)->first();
        //     if($check){
        //         return response()->json(['liked'=>$liked]);
        //     }
        //     else{
        //         return response()->json(['liked'=>$liked = false]);
        //     }

        // }


        // xóa post
        public function destroy($id)
        {
            // Find the post by ID
            $post = Post::where("ID", $id)->first();

            if (!$post) {
                return response()->json(['success' => false, 'message' => 'Post not found']);
            }

            // Define the storage directory based on the type_post
            $storageDirectory = 'img/upload'; // Default to 'img/upload' if the type_post is not set correctly

            if ($post->type_post === 'avatar') {
                $storageDirectory = 'users_avatar';
            } 

            // Delete the post
            
            Post::where("ID", $id)->delete();
            // Delete associated likes
            Like::where('post_id', $id)->delete();

            // Find and delete associated photos
            $photos = Photo::where('post_id', $id)->get();

            foreach ($photos as $photo) {
                // Build the full path to the image
                $imagePath = public_path($storageDirectory . '/' . $photo->image);

                // Delete the photo file
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }

                // Delete the photo record
                $photo->delete();
            }
            

            // Delete associated comments
            Comment::where('post_id', $id)->delete();

            return response()->json(['success' => true, 'message' => 'Post and associated photos deleted successfully']);
        }

        // comment
        public function storeComment(Request $request)
        {
            $validatedData = $request->validate([
                'content' => 'required|string',
                'post_id' => 'required|integer|exists:post,ID', // Correct the table name to 'posts'
            ]);

            $comment = new Comment;
            $comment->content = $validatedData['content'];
            $comment->user_id = auth()->id();
            $comment->post_id = $validatedData['post_id'];
            $comment->created_at = now();
            $comment->save();

            // Update the comment count on the associated post
            $post = Post::find($comment->post_id);
            $post->Comments = Comment::where('post_id', $post->ID)->count();
            $post->save();

            $user = auth()->user();
            $full_name = $user->first_name . ' ' . $user->last_name;
            $avatar = !is_null($user->avatar) ? asset("storage/users_avatar/{$user->avatar}") : asset("storage/users_avatar/guest-user-250x250.jpg");
            $commentId = $comment->id; // Get the actual comment ID
            $startDate = Carbon::parse($comment->created_at); // Sử dụng parse để chuyển đổi ngày tháng từ chuỗi hoặc timestamp
            $endDate = Carbon::now(); // Ngày đích, hiện tại
            $diff = $startDate->diffForHumans($endDate);
            $html = '
                <div class="user d-flex">
                    <div class="avatar-user">
                        <a href="' . route('profile', ['id' => $user->id]) . '">
                            <img style="width: 40px; border-radius: 50%;" src="' . $avatar . '" alt="">
                        </a>
                    </div>
                    <div class="comment-content">
                        <div class="comment-content-header">
                            <div class="name-user">
                                <a href="' . route('profile', ['id' => $user->id]) . '"><h6>' . $full_name . '</h6></a>
                            </div>
                            <div class="content-body">
                                <span class="content-cmt">' . $comment->content . '</span>
                                <span class="cnt-like-cmt d-none" data-cmt-id="' . $commentId . '">
                                    <div class="content-cnt d-flex">
                                        <div class="icon-like">
                                            <img src="' . asset("img/likes.png") . '" alt="">
                                        </div>
                                        <div class="cntLikes" data-cmt-id="' . $commentId . '"></div>
                                    </div>
                                </span>
                            </div>
                        </div>
                        <div class="btn-function d-flex">
                            <div class="btn-like-comment" data-cmt-id="' . $commentId . '" data-post-id="' . $post->ID . '">
                                <span>Thích</span>
                            </div>
                            <div class="btn-relay">
                                <span>Phản hồi</span>
                            </div>
                            <div class="time-comment">
                                <span>'. $diff .'</span>
                            </div>
                        </div>
                    </div>
                </div>
            ';
            $post_id = $comment->post_id;
            return response()->json(['success' => true,'html' => $html,'post_id' => $post_id]);
        }

        public function reply_comment(Request $request){
            $user = auth()->user();
            $user_id = $request->input('user_id');
            $post_id = $request->input('post_id');
            $cmt_id = $request->input('cmt_id');

            $replyComment = json_encode(['cmt_id' => $cmt_id, 'user_id' => $user->id]);

            $comment = new Comment;
            $comment->user_id = $user_id;
            $comment->post_id = $post_id;
            $comment->content = $request->input('content');
            $comment->relay_comment = $replyComment;
            $comment->created_at = now();
            $comment->save();

            $post = Post::find($comment->post_id);
            $post->Comments = Comment::where('post_id', $post->ID)->count();
            $post->save();

            $users = User::find($user_id);
            $full_name = $user->first_name . ' ' . $user->last_name;
            $avatar = !is_null($user->avatar) ? asset("storage/users_avatar/{$user->avatar}") : asset("storage/users_avatar/guest-user-250x250.jpg");
            $commentId = $comment->id; // Get the actual comment ID
            $startDate = Carbon::parse($comment->created_at); // Sử dụng parse để chuyển đổi ngày tháng từ chuỗi hoặc timestamp
            $endDate = Carbon::now(); // Ngày đích, hiện tại
            $diff = $startDate->diffForHumans($endDate);


            $html = '
                <div class="user d-flex">
                    <div class="avatar-user">
                        <a href="' . route('profile', ['id' => $user->id]) . '">
                            <img style="width: 40px; border-radius: 50%;" src="' . $avatar . '" alt="">
                        </a>
                    </div>
                    <div class="comment-content">
                        <div class="comment-content-header">
                            <div class="name-user">
                                <a href="' . route('profile', ['id' => $user->id]) . '"><h6>' . $full_name . '</h6></a>
                            </div>
                            <div class="content-body">
                                <span class="content-cmt"><span class="user-get-name-reply"><a href="'.route('profile', ['id' => $users->id]).'">'.$users->first_name.' ' .$users->last_name.'</a></span> ' . $comment->content . '</span>
                                <span class="cnt-like-cmt d-none" data-cmt-id="' . $commentId . '">
                                    <div class="content-cnt d-flex">
                                        <div class="icon-like">
                                            <img src="' . asset("img/likes.png") . '" alt="">
                                        </div>
                                        <div class="cntLikes" data-cmt-id="' . $commentId . '"></div>
                                    </div>
                                </span>
                            </div>
                        </div>
                        <div class="btn-function d-flex">
                            <div class="btn-like-comment" data-cmt-id="' . $commentId . '" data-post-id="' . $comment->post_id . '">
                                <span>Thích</span>
                            </div>
                            <div class="btn-relay">
                                <span>Phản hồi</span>
                            </div>
                            <div class="time-comment">
                                <span>'. $diff .'</span>
                            </div>
                        </div>
                    </div>
                </div>
            ';

            return response()->json(['success' => true ,'html' => $html,'cmtID' => $cmt_id]);
        }

        public function modalPost(Request $request){
            $post_id = $request->input('post_id');
            $user_id = $request->input('user_id');
            $post = Post::find($post_id);
            dd($post);
        }

    }