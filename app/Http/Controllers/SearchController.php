<?php

namespace App\Http\Controllers;

use App\Models\Compatible;
use App\Models\ListInterest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search_interest(Request $request)
    {
        $val = $request->input('val');
        
        $result = ListInterest::where('content', 'like', '%' . $val . '%')
                    ->with('interests')
                    ->get();

                    // dd($result);
        
        return response()->json($result);
    }
    public function erase_status(Request $request){
        $val = $request->input('val');
        
        $result = DB::table('list_interest')
                    ->where('content', 'like', '%' . $val . '%')
                    ->get();
        
        return response()->json($result);
    }

    public function search_job(Request $request){
        $val = $request->input('values');
        $request = DB::table('list_job')->where('name','like','%' . $val. '%')->get();
        return response()->json($request);

    }
    public function countLikeMe(Request $request){
        $user_id = auth()->id();
        $cntUser = Compatible::where('requester_id',$user_id)->where('status','pending')->count();
        return response() -> json($cntUser);
    }
    public function countCompatible(Request $request){
        $user_id = $request->input('user_id');
        
        $cntUser = Compatible::where(function ($query) use ($user_id) {
                $query->where('requested_id', $user_id)
                      ->orWhere('requester_id', $user_id);
            })
            ->where('status', 'accepted')
            ->count();
    
        return response()->json($cntUser);
    }
    
}
