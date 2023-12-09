<?php
namespace App\Http\Controllers;

use App\Models\Random;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\ConfigPusher\PusherClient;
use App\Services\UpdateAllService;
use Illuminate\Support\Facades\Auth;

class RandomController extends Controller{


    protected $update;

    public function __construct(UpdateAllService $updateAllService)
    {
        $this->update = $updateAllService;
    }


    public function pusherAuth(Request $request){
        $pusher = new PusherClient();
        return $pusher->pusherAuth(
            $request->user(),
            Auth::user(),
            $request['channel_name'],
            $request['socket_id']
        );
    }
    public function findMatch(Request $request)
    {
        
        // Logic tìm kiếm người dùng phù hợp
        $currentUser = auth()->user();
        $matchedUsers = Random::where('from_id', '!=', $currentUser->id)->where('ready_random',1)->orderByDesc('updated_at')->first();
        $pusher = new PusherClient();
        if($matchedUsers){

            $this->update->updateRelations($currentUser->id,2,$matchedUsers->id);
            $this->update->updateRelations($matchedUsers->id,2,$currentUser->id);
            
            $pusher->push("matching.".$currentUser->id,'success-matching',[
                'from_id' => $currentUser->id,
                'to_id' => $matchedUsers->id,
                'render' => $pusher->matched($matchedUsers),
            ]);
            $pusher->push("matching.".$matchedUsers->id,'success-matching',[
                'from_id' => $matchedUsers->id,
                'to_id' => $currentUser->id,
                'render' => $pusher->matched($currentUser),
            ]);
        }
        else{

            $pusher->push("matching.".$currentUser->id,'queue-Matching',[
                'from_id'=> $currentUser->id,
                'matching' => $pusher->queue(),
            ]);
            $this->update->updateRelations($currentUser->id,1,null);
        }
    }

    public function cancelMatching(Request $request){
        $user = auth()->user();
        $random = Random::where('from_id',$user->id)->first();
        if($random){

            $this->update->updateRelations($user->id,0,null);

            $this->update->updateRelations($random->to_id,0,null);
            $pusher = new PusherClient();
            $pusher->push("matching.".$user->id,'cancel-matching',[

                
                'matching' => $pusher->cancel(),
            ]);
            $pusher->push("matching.".$random->to_id,'cancel-matching',[

                'matching' => $pusher->cancel(),
            ]);
        }
        
    }


    public function accepteMatching(Request $request){
        $userMatching = Random::where('from_id', auth()->id())->first();
    
        if ($userMatching) {
            $userMatching->ready_random = 3; // Gán giá trị mới
            $userMatching->save(); // Lưu thay đổi
        }
        return response()->json(['success' => true]);

    }


    public function sendVideocall(Request $request){
        $data = $request->all(); // Lấy tất cả dữ liệu từ request
        // dd($data);
        $auth_id = auth()->id();
        // Kiểm tra và truy cập dữ liệu JSON từ request
        if (isset($data['offer']) && isset($data['userId'])) {
            $offer = $data['offer'];
            $userId = $data['userId'];


            $pusher = new PusherClient();


            $pusher->push('matching.'.$userId,'video-call',[
                'from_id' => $auth_id,
                'to_id' => $userId,
                'offer' => $offer,
            ]);
           
            // Xử lý dữ liệu tại đây...
        }
    }


    public function triggerPusher(Request $request){
        $data = $request->all();

        $pusher = new PusherClient();


        $pusher->push($data['request']['channel'],$data['request']['event'],[
            'sdp' => $data['request']['data'],
            'from' => auth()->id(),
            'to' => $data['request']['to'],
        ]);
        
    }


    
}