<?php

use App\ConfigPusher\PusherClient;
use App\Http\Controllers\AroundController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DatingController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\FriendshipController;

use App\Http\Controllers\MessegerController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RandomController;
use App\Http\Controllers\RenderController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PythonScriptController;
use App\Http\Middleware\AuthMiddleware;
use App\Models\Comment;
use App\Models\Compatible;
use App\Models\Interest;
use App\Models\Photo;
use App\Models\User;
use Chatify\Http\Controllers\MessagesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::get('/app',function(){
    return view('app');
});
Route::middleware(['web', 'auth'])->group(function () {
    // Your protected routes go here
    Route::get('/', 'DashboardController@index');
    // ...
});
Route::get('/',function(){
    return view('welcome');

});
Route::post('/',[LoginController::class, 'index'])->name('cookie');
Route::get('/home',function(){
    return view('welcome');
});

Route::get('/friends',function(){
    return view('friends');
});
Route::get('/dating',function(){
    $listJob = DB::table('list_job')->get();
    $lists = DB::table('list_interest')->get();
                                        $chunked = $lists->chunk(3);
                                        $selectUser = Interest::with('listInterest')
                                            ->where('user_id', auth()->id())
                                            ->get();
                                            // dd($selectUser);
                                            $photo = Photo::where('user_id',auth()->id())->With('post')->get();
                                       
                                            $chuckPhoto = $photo->chunk(3)->take(9);
                                            // dd($chuckPhoto);
                                        $interestUser = $selectUser->chunk(3);
    return view('dating',['chunked'=>$chunked ,'selectUser' => $selectUser,'interestUser' => $interestUser,'listInteresting' =>$lists,'listJob'=>$listJob,'chuckPhoto' => $chuckPhoto]);
});
Route::get('/look-around',function(){
    return view('around');
});

Route::get('/request',function(){
    return view('request');
});
Route::get('/',[PostController::class,'postIndex'])->name('postIndex');

Route::get('/random',function(){
    return view('random');
});

// check login
// Route::get('/',[UserController::class,'index'])->name('user');


// post bài viết
Route::get('/post_title',[PostController::class,'index'])->name('post_title');
Route::post('/post_title',[PostController::class,'store'])->name('post_title.store');

Route::get('/home',[RenderController::class,'getAllPosts'])->name('render');
Route::get('/',[RenderController::class,'getAllPosts'])->name('render');
// Route::get('/',[RenderController::class,'suggest'])->name('render');


// login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login',[LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'create']);

// đăng ký=> register



Route::get('/profile', function () {
    $lists = DB::table('list_interest')->get();
    $chunked = $lists->chunk(3);
    $selectUser = Interest::with('listInterest')
        ->where('user_id', auth()->id())
        ->get();
        // dd($selectUser);
    $interestUser = $selectUser->chunk(3);
    return view('user.profile',['chunked'=>$chunked ,'selectUser' => $selectUser,'interestUser' => $interestUser,'listInteresting' =>$lists]);
});
// cookie
// Route::get('/',[LoginController::class,'index'])->name('cookie')
// profile
Route::get('/profile/{id}', [UserController::class,'showProfile'])->name('profile');
//  đăng xuất
Route::get('/logout',[LoginController::class,'logout'])->name('logout');
// Route::get('/',[PostController::class,'CheckLike'])->name('check');
// like
// Route::get('/',[PostController::class,'CheckLike'])->name('post.likes');
Route::post('/post/like',[PostController::class,'like'])->name('post.like');
Route::post('/post/unlike',[PostController::class,'like'])->name('post.unlike');
// delete

Route::delete('/posts/{id}',[PostController::class,'destroy'])->name('posts.destroy');
 

// edit tiểu sử
Route::post('/bigo',[EditController::class,'editBigo'])->name('bigo');
// address

Route::post('/address',[EditController::class,'address'])->name('address');

Route::get('/check',[FriendshipController::class,'friendship'])->name('check');

Route::post('/acceptedfriend',[FriendshipController::class,'friendship'])->name('accepted.post');
Route::post('/unfriend',[FriendshipController::class,'friendship'])->name('eraseAddFriend.post');
Route::post('/unpending',[FriendshipController::class,'friendship'])->name('unPending.post');


// notifications
// Route::get('/check-notifications',[NotificationController::class,'renderNotifications'])->name('checkNotification');


// lưu vị trí user 
Route::post('/save-location',[AroundController::class,'saveCheckIn'])->name('savelocation.post');
Route::post('/save-distance',[AroundController::class,'saveReSize'])->name('saveresize.post');
Route::post('/save-birthday',[AroundController::class,'saveBirthday'])->name('saveBirthday.post');

Route::post('/save-gender',[AroundController::class,'saveGender'])->name('saveGender.post');
Route::post('/save-stype',[AroundController::class,'saveStype'])->name('saveStype.post');
Route::post('/save-whoselect',[AroundController::class,'saveWhoSelect'])->name('saveWhoSelect.post');
Route::get('/test',[AroundController::class,'selectUser'])->name('selectUser');
Route::get('/select-user',[AroundController::class,'selectUser'])->name('selectUser');
Route::get('/notifications',[NotificationController::class,'renderNotification'])->name('renderNotification');
Route::get('/loadNotifications',[NotificationController::class,'Notifications'])->name('Notifications');

Route::get('/search-interest',[SearchController::class ,'search_interest'])->name('search_interest');

Route::post('/started_dating',[DatingController::class,'uploadStatus'])->name('uploadStatus.post');

Route::post('/erase-status',[DatingController::class,'erase_status'])->name('erase_status.post');
// search user
Route::get('/search-user',[DatingController::class,'selectUser'])->name('selectUser');

Route::post('/add-lever',[EditController::class,'lever'])->name('lever.post');
Route::post('/add-school',[EditController::class,'school'])->name('school.post');
Route::post('/add-work',[EditController::class,'work'])->name('work.post');
Route::post('/add-money',[EditController::class,'money'])->name('money.post');

Route::post('/post-zodiac',[EditController::class,'zodiac'])->name('zodiac.post');

Route::post('/post-zalo',[EditController::class,'zalo'])->name('zalo.post');

Route::post('/post-ins',[EditController::class,'instagram'])->name('instagram.post');

Route::post('/post-fb',[EditController::class,'facebook'])->name('facebook.post');


Route::get('/matching-user',[DatingController::class,'matchingUser'])->name('matchingUser');

Route::get('/get-list-job',[SearchController::class,'search_job'])->name('search_job');


                                // url: 'count-compatible',
                               
Route::get('/count-compatible',[SearchController::class,'countLikeMe'])->name('countLikeMe');

Route::get('/count-compatible-accepted',[SearchController::class,'countCompatible'])->name('countCompatible');




Route::post('/get-chat',[MessegerController::class,'getMessages'])->name('getMessages.post');

// Route::post('/messenger/{id}',[MessegerController::class, 'selecttions_user'])->name('selecttions_user');
Route::get('/messenger/{id}',[MessegerController::class,'show'])->name('showMessenger');

Route::get('/getlistchat',[MessegerController::class,'getUsers'])->name('getUsers');

Route::get('/get-layout-messenger',[MessegerController::class,'layout'])->name('layout');
Route::post('/getMessenger',[MessegerController::class,'getMessages']);
Route::get('/get-main-right',[Controller::class,'gets']);


Route::get('/friendship',[FriendshipController::class,'friendship'])->name('friendship');

Route::get('/get_user', function(Request $request){
    $id = $request->input('id'); // Use input() to get the 'id' parameter from the request
    $user = User::find($id); // Use the User model to find the user by ID
    
    if ($user) {
        return response()->json(['success' => true, 'user' => $user]);
    } else {
        return response()->json(['success' => false, 'message' => 'User not found']);
    }
});

Route::post('/like-cmt', function(Request $request) {
    $post_id = $request->input('post_id');
    $id = auth()->id();
    $cmt_id = $request->input('cmt_id');

    // Fetch the comment you want to update
    $comment = Comment::where('post_id', $post_id)->where('id', $cmt_id)->first();
    $check_like = true ;
    if ($comment) {
        // Retrieve the current Likes value and decode it from JSON to an array
        $currentLikes = json_decode($comment->Likes, true);
        
        // Check if $currentLikes is null or empty, and initialize it as an empty array if needed
        if (!$currentLikes) {
            $currentLikes = [];
        }

        // Check if the user's ID is already in the array
        $index = array_search($id, $currentLikes);

        if ($index !== false) {
            // User's ID is in the array, so remove it
            unset($currentLikes[$index]);
            $check_like= false;
        } else {
            // User's ID is not in the array, so add it
            $currentLikes[] = $id;
            
        }

        // Encode the array as JSON
        $newLikes = json_encode($currentLikes);

        // Update the Likes column in the comment with the new JSON string
        $comment->update(['Likes' => $newLikes]);

        // Count the number of likes after the update
        $cntLikes = count($currentLikes);
        
        return response()->json(['success' => true, 'cntLike' => $cntLikes,'check' => $check_like]);
    }

    return response()->json(['success' => false, 'message' => 'Comment not found']);
});

Route::get('/get-like-cmt', function (Request $request) {
    $id = auth()->id();

    // Retrieve comments where the user has liked and count the likes
    $likedComments = Comment::select(['*', DB::raw('JSON_LENGTH(Likes) as like_count')])
        ->whereRaw('JSON_CONTAINS(Likes, ?)', [$id])
        ->get();
    
    // You now have an array of comments that the user has liked along with the like count
    // dd($likedComments);
    return response()->json(['success' => true,'liked'=>$likedComments]);
});


Route::post('/cmt',[PostController::class,'storeComment'])->name('cmtpost');

Route::post('/reply-cmt',[PostController::class,'reply_comment'])->name('reply-comment');

Route::get('/Post',[PostController::class,'modalPost']);


Route::get('/testPython',[PythonScriptController::class,'run']);

Route::post('/save-cropped-image',[UserController::class,'UpdateAvatar'])->name('updateAvatar');

Route::post('/accept-friend-request', [FriendshipController::class,'acceptFriendRequest'])->name('accept-friend-request');
Route::post('/send-friend-request', [FriendshipController::class,'friendship']);
Route::post('/like-user',[DatingController::class,'likeUser']);

Route::get('/select-compatible', function(){
    $id = auth()->id();
    $result = Compatible::where('requester_id', $id)->get();
    
    return $result;
});

// Route::post('actionsRandom',[EditController::class ,'actionsrandom']);

Route::post('/find-match',[RandomController::class, 'findMatch']);


        Route::get('/acceptRandomMatching',[RandomController::class,'accepteMatching']);

        Route::get('/cancelRandomMatching',[RandomController::class,'cancelMatching']);

Route::get('/CallRandom',function(){
    return view('randomVideoCall');
});

Route::post('/sendvideo',[RandomController::class,'sendVideocall'])->name('post.video');

Route::post('/triggerPusher',[RandomController::class,'triggerPusher']);


Route::post('/pusher/auth',[RandomController::class,'pusherAuth']);

