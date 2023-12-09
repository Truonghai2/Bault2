<?php 
namespace App\Services;

use App\Models\Friendship;
use App\Models\User;
use App\Repositories\EloquentFriendshipRepository;

class FriendshipService{
    protected $repository;
    public function __construct(EloquentFriendshipRepository $eloquentFriendshipRepository)
    {
        $this->repository = $eloquentFriendshipRepository;
    }

    
    public function checkFriendship($requested_id){
        $requested = User::find($requested_id);
        $requester = auth()->user();
        

        $status = $this->repository->checkFriendshipStatus($requester,$requested);
       
        if($status != null && $status == 'accepted'){
            
            return response()->json(['success' => true, 'statusbtn' => 'friendAccepted']);
        }
        elseif($status != null && $status == 'pending'){
            return response()->json(['success' => true,'statusbtn' => 'friendPending']);
        }
        elseif($status !=  null && $status =='receive'){
            return response()->json(['success' => true, 'statushiddebtn' => true]);
        }
        elseif($status === null){
            return response()->json(['success' => true,'statusbtn' => 'nofriend']);
        }
    }

    public function PendingFriendship($requested_id){
        $requester = auth()->user();
        $requested = User::find($requested_id);

        $this->repository->sendFriendRequest($requester,$requested);
        return response()->json(['success' => true,'statusbtn' => 'friendPending']);
    }


    public function acceptedfriend($requester_id){
        $requested = auth()->user();
        $requester = User::find($requester_id);
        $this->repository->acceptFriendRequest($requested,$requester);
        return response()->json(['success' => true, 'statusbtn' => 'friendAccepted']);
    }
    public function rejectFriend($requester_id){
        $requested = auth()->user();
        $requester = User::find($requester_id);
        $this->repository->declineFriendRequest($requested,$requester);
        return response()->json(['success' => true,'statusbtn' => 'nofriend']);
    }
    

    public function unfriend($requester_id){
        $requested = auth()->user();
        $requester = User::find($requester_id);
        $this->repository->unfriend($requested,$requester);
        return response()->json(['success' => true,'statusbtn' => 'nofriend']);
    }

    public function cancelFriendship($requester_id){
        $requested = auth()->user();
        $requester = User::find($requester_id);

        $this->repository->cancelFriendship($requested,$requester);
        return response()->json(['success' => true,'statusbtn' => 'nofriend']);
    }
}