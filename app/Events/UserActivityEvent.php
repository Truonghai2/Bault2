<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserActivityEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $isActive;

    public function __construct($userId, $isActive)
    {
        $this->userId = $userId;
        $this->isActive = $isActive;
    }

    public function broadcastOn()
    {
        return new Channel('user-activity.' . $this->userId);
    }
}