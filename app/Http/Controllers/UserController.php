<?php 

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\Comment;
use App\Models\Interest;
use App\Models\Photo;
use App\Models\Post;
use App\Models\User;
use App\Services\AvatarService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{
    protected $avatarService;
    public function __construct(AvatarService $avatarService) {
        $this->avatarService = $avatarService;
    }
  
    public function showProfile($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        // truy vấn CSDL để lấy thông tin user
        $user = DB::table('user')->where('id', $id)->first();
        

        $userPosts = Post::with(['user', 'comments', 'user_comment'])
        ->where('Creator_ID', $id) // Filter posts by Creator_ID
        ->orderByDesc('created_at')
        ->get();

            $like = DB::table('like')->select('user_id', 'post_id')->get();
        
            // Tạo một mảng để chứa ảnh tương ứng với mỗi bài đăng
            $postImages = [];
            $postComments = [];
            $cntCmt = [];
            $replyComment = [];
    
            $cntReplyCmt = [];
            foreach ($userPosts as $post) {
                $image = DB::table('photos')->where('post_id', $post->ID)->value('image'); // Change 'ID' to 'id'
                $postImages[$post->ID] = $image;
                $cnt = Comment::where('post_id',$post->ID)->count();
                $cntCmt[$post->ID] = $cnt;
                $cntReply = Comment::where('post_id')->whereNotNull('relay_comment')->count();
                $cntReplyCmt[$post->ID] = $cntReply;
                // Retrieve all comments for this post
                $comments = Comment::where('post_id', $post->ID)
                    ->where(function($query) {
                        $query->whereNull('relay_comment')->orWhere('relay_comment', ''); // Check for null or empty string
                    })
                    ->with('user')
                    ->latest('created_at')
                    ->take(2)
                    ->get()
                    ->toArray();
    
                $reply_comments = Comment::where('post_id', $post->ID)
                    ->whereNotNull('relay_comment')
                    ->latest('created_at')
                    ->take(2)
                    ->get();
            
                // Extract user_id from relay_comment
                $userIds = $reply_comments->map(function ($comment) {
                    $relayComment = json_decode($comment->relay_comment, true);
                    return $relayComment['user_id'];
                });
            
                // Retrieve users by user IDs
                $users = User::whereIn('id', $userIds)->get();
            
                // Now, associate users with reply comments
                $replyComment[$post->ID] = $reply_comments->map(function ($comment) use ($users) {
                    $relayComment = json_decode($comment->relay_comment, true);
                    $user = $users->where('id', $relayComment['user_id'])->first();
            
                    // Attach the user to the comment
                    $comment->user = $user;
            
                    return $comment;
                });
                // $replyComment[$post->ID] = $reply_comments;
                $postComments[$post->ID] = $comments;
            }
        
            
            
            $lists = DB::table('list_interest')->get();
            $chunked = $lists->chunk(3);
            $selectUser = Interest::with('listInterest')
                ->where('user_id', $id)
                ->get();
                // dd($selectUser);
            $interestUser = $selectUser->chunk(3);
            // dd($returnUser);
           
            // dd($postsWithComments);
     
    
            return view('user.profile', [
                'user' => $user,
                'post' => $userPosts,
                'replyComment' => $replyComment,
                'postImages' => $postImages,
                'comment' => $postComments,
                'like' => $like,
                'cntCmt' =>$cntCmt,
                'cntReply' => $cntReplyCmt, 
                
                'chunked'=>$chunked ,'selectUser' => $selectUser,
                'interestUser' => $interestUser
            ]);
        
        
    }
    public function updateAvatar(Request $request){
      
        $this->avatarService->updateAvatar(auth()->user(),$request->input('content'),$request->input('path'));
    }
    
    
}