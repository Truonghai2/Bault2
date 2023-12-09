<?php 
namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\FriendshipService;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FriendshipController extends Controller{
    protected $friendshipService;
    public function __construct(FriendshipService $friendshipService)
    {
        $this->friendshipService = $friendshipService;
    }


    public function friendship(Request $request){
        $requester_id = $request->input('user_id');
        $type = $request->input('type');
        if(auth()->id() === $requester_id){
            return true;
        }
        $status = 0;
        if($type === 'check'){
            $status = $this->friendshipService->checkFriendship($requester_id);
           
        }
        elseif($type === 'pending'){
            $status = $this->friendshipService->PendingFriendship($requester_id);
        }
        elseif($type === 'accepteFriend'){
            $status = $this->friendshipService->acceptedfriend($requester_id);
           
        }
        elseif($type === 'unfriend'){
            $status = $this->friendshipService->unfriend($requester_id);
        }
        elseif($type === 'unpending'){
            $status = $this->friendshipService->cancelFriendship($requester_id);
        }
        return $status;
    } 
    
}
