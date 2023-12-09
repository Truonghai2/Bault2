<?php 
namespace App\ConfigPusher;

use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class PusherClient{

    public $pusher;



    public function __construct()
    {
        $this->pusher = new Pusher(
            config('chatify.pusher.key'),
            config('chatify.pusher.secret'),
            config('chatify.pusher.app_id'),
            config('chatify.pusher.options'),
        );
    }

    public function pusherAuth($requestUser, $authUser, $channelName, $socket_id)
    {
        // Auth data
        $authData = json_encode([
            'user_id' => $authUser->id,
            'user_info' => [
                'first_name' => $authUser->first_name,
                'last_name' => $authUser->last_name,

            ]
        ]);
        // check if user authenticated
        if (Auth::check()) {
            if($requestUser->id == $authUser->id){
                return $this->pusher->socket_auth(
                    $channelName,
                    $socket_id,
                    $authData
                );
            }
            // if not authorized
            return response()->json(['message'=>'Unauthorized'], 401);
        }
        // if not authenticated
        return response()->json(['message'=>'Not authenticated'], 403);
    }


// trigger an event using Pusher
    public function push($channel, $event, $data){
        return $this->pusher->trigger($channel,$event,$data);
    }
// function get fe client matched
    public function matched($user){


        return view('layout.clientMatching',[
            'get' => 'matched',
            'user' => $user,
        ])->render();
    }

    // function fe queue

    public function queue(){
        return view('layout.clientMatching',[
            'get' => 'queue',

        ])->render();
    }
    //  function get html canceled
    public function cancel(){
        return view('layout.clientMatching',[
            'get' => 'cancel'
        ])->render();
    }
}