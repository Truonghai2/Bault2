<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Interest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RenderController extends Controller
{
    public function getAllPosts()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $postsWithComments = Post::with(['user', 'comments','user_comment'])
            ->orderByDesc('created_at') // Change 'Created_at' to 'created_at'
            ->get();
            

        $like = DB::table('like')->select('user_id', 'post_id')->get();
        
        // Tạo một mảng để chứa ảnh tương ứng với mỗi bài đăng
        $postImages = [];
        $postComments = [];
        $cntCmt = [];
        $replyComment = [];

        $cntReplyCmt = [];
        foreach ($postsWithComments as $post) {
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
        // dd($re)
        // dd($cntCmt);
        // dd($postComments);
        // Truyền mảng ảnh và bình luận vào view
        // dd($replyComment);

        $user = auth()->user();
        $returnUser = [];

        if($user->latitude !== null && $user->longitude !== null){
            $users = DB::table('user')->select('id', 'first_name', 'last_name', 'avatar', 'ngaysinh', 'gender', 'bigo')
                ->selectRaw("(6371 * ACOS(COS(RADIANS(latitude)) * COS(RADIANS($user->latitude)) * COS(RADIANS($user->longitude) - RADIANS(longitude)) + SIN(RADIANS(latitude)) * SIN(RADIANS($user->latitude)))) AS distance")
                ->where('id', '!=', $user->id)
                ->having('distance', '<=', 50)
                ->orderBy('distance')
                ->get();


            // dd($users);/
            $minInterestMatch = 1;
            $userInterests = DB::table('interest')
                    ->select('list_interest_id')
                    ->where('user_id', $user->id)
                    ->pluck('list_interest_id')
                    ->toArray();
                    
            if(count($userInterests) > 0 ){
                // if()
                // Tìm kiếm các người dùng khác có sở thích chung
                    $matchedUsers = DB::table('interest')
                    ->select('user_id')
                    ->whereIn('list_interest_id', $userInterests)
                    ->where('user_id', '!=', $user->id)
                    ->groupBy('user_id')
                    ->havingRaw('COUNT(DISTINCT list_interest_id) >= ?', [$minInterestMatch])
                    ->pluck('user_id')
                    ->toArray();
                // dd($matchedUsers);
                

                foreach($users as $index){
                    foreach($matchedUsers as $item){
                        if($index->id == $item){
                            $returnUser[] = $index;
                        }
                    }
                }
            }
            else{
                $returnUser[] = $users;
            }
        }
        // dd($returnUser);
       
        // dd($postsWithComments);
 

        return view('welcome', [

            'post' => $postsWithComments,
            'replyComment' => $replyComment,
            'postImages' => $postImages,
            'comment' => $postComments,
            'like' => $like,
            'cntCmt' =>$cntCmt,
            'cntReply' => $cntReplyCmt, 
            'userSuggest' => $returnUser
        ]);
    }

    // public function suggest()
    // {
    //     // Check if a user is authenticated
    //     if (!auth()->check()) {
    //         return route('login');
    //     }

    
    // }

}



