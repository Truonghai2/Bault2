<?php

namespace App\Repositories;

use App\Contracts\Repositories\FriendshipRepositoryInterface;
use App\Models\Friendship;
use App\Models\User;

class EloquentFriendshipRepository implements FriendshipRepositoryInterface
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function sendFriendRequest(User $user, User $friend)
    {
        $this->userRepository->createFriendship($user->id, $friend->id);
    }

    public function acceptFriendRequest(User $user, User $friend)
    {
        $this->userRepository->acceptedFriendship($user->id, $friend->id);
    }

    public function declineFriendRequest(User $user, User $friend)
    {
        $this->userRepository->rejectFriendRequest($user->id, $friend->id);
    }

    public function blockFriend(User $user, User $friend)
    {
        $this->userRepository->BlockUser($user->id,$friend->id);
    }

    public function unfriend(User $user, User $friend)
    {
        $this->userRepository->unfriend($user->id, $friend->id);
    }


    public function cancelFriendship(User $user, User $friend)
    {
       $this->userRepository->rejectFriendRequest($friend->id,$user->id);
        
    }
    public function checkFriendshipStatus(User $user, User $friend)
    {
        $friendship = $this->userRepository->checkFriendshipStatus($user->id,$friend->id);

        if (!$friendship) {
            return null; // Không có mối quan hệ bạn bè
        }
        else{
            if($friendship->requested_id == $user->id && $friendship->requester_id === $friend->id && $friendship->status === 'pending' ){
                return 'receive';
            }
            elseif($friendship->requester_id == $user->id && $friendship->requested_id === $friend->id && $friendship->status === 'pending'){
                return 'pending';
            }
            else{
                return $friendship->status;
            }
        }
        
       
    }
}
