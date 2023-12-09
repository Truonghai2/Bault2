<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class NotificationController extends Controller{
    public function renderNotification(Request $request){
        $user_id = $request->input('user_id');
        // $user_id = 1;
        $oneWeekAgo = Carbon::now()->subWeek(); // Lấy thời điểm 1 tuần trước
        $cnt_notifications = DB::table('notifications')
            ->where('user_id', $user_id)
            ->where('see', 'checknt')
            ->whereDate('created_at', '>=', $oneWeekAgo)
            ->count();
       
        if($cnt_notifications){
            return response()->json(['success'=>true, 'cnt_notifications' => $cnt_notifications]);
        }
        else{
            return response()->json(['success'=>true,'cnt_notifications'=>0]);
        }
    }
    public function Notifications(Request $request)
    {
        $user_id = $request->input('user_id');
        // $user_id = 1;
        $oneWeekAgo = Carbon::now()->subWeek();
        $notifications = DB::table('notifications')
            ->where('user_id', $user_id)
            
            ->get();

        $requesterIds = $notifications->pluck('requester_id')->toArray();

        $requesters = DB::table('user')
            ->whereIn('id', $requesterIds)
            ->get();
        
        // Đoạn code dd($requester_id) đã được comment lại vì không cần thiết

        if (count($notifications) > 0) {
            return response()->json(['success' => true, 'notification' => $notifications, 'requesters'=> $requesters]);
        } else {
            return response()->json(['success' => true, 'notification' => null]);
        }
    }

}