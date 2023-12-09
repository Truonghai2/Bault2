<?php

namespace App\Listeners;

use App\Events\UserActivityEvent;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserActivityListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
   
    public function handle(UserActivityEvent $event)
    {
        $userId = $event->userId;
        $isActive = $event->isActive;

        // Cập nhật trạng thái hoạt động của người dùng trong cơ sở dữ liệu
        User::where('id', $userId)->update(['active_status' => $isActive]);

        // Hoặc bạn có thể thực hiện các hành động khác dựa trên sự kiện
    }
}
