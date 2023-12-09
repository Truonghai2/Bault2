<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;



use App\Models\Message;


class MessageCreated 
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $user;
    public $message;

    public function __construct(Message $message, $user)
    {
        $this->user = $user;
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return 'chat-channel';
    }
    public function broadcastToEveryone()
    {
        
    }
}

