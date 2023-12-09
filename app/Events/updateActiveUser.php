<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserActivityEvent implements ShouldBroadcast
{
    public $userId;
    public $isActive;

    public function __construct($userId, $isActive)
    {
        $this->userId = $userId;
        $this->isActive = $isActive;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('user-activity.' . $this->userId);
    }
}