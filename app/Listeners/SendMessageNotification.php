<?php // app/Listeners/SendMessageNotification.php
namespace App\Listeners;

use App\Events\MessageCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendMessageNotification implements ShouldQueue
{
    public function handle(MessageCreated $event)
    {
        // Handle the event, send notifications, etc.
    }
}
