<?php 
namespace App\Contracts\Repositories;

use App\Models\User;

interface FriendshipRepositoryInterface{


    public function sendFriendRequest(User $user, User $friend);

    public function acceptFriendRequest(User $user, User $friend);

    public function declineFriendRequest(User $user, User $friend);

    public function blockFriend(User $user, User $friend);

    public function unfriend(User $user, User $friend);

    public function cancelFriendship(User $user,User $friend);

    public function checkFriendshipStatus(User $user, User $friend);
}