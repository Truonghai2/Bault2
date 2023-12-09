<?php

namespace App\Http\Controllers;

use App\Events\UserActivityEvent;
use Carbon\Carbon;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function updateActivity(Request $request)
    {
        // Cập nhật trạng thái hoạt động của người dùng ở đây

        $userId = auth()->user()->id; // Đổi thành ID của người dùng cụ thể

        $isActive = true; // Thay đổi thành trạng thái hoạt động thích hợp

        event(new UserActivityEvent($userId, $isActive));

        return response()->json(['message' => 'Cập nhật hoạt động thành công']);
    }
    

}
