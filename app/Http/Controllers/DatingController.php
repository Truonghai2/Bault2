<?php
namespace App\Http\Controllers;

use App\Models\Dating;
use App\Models\User;
use App\QueryBuilders\UserQueryBuilders;
use App\Services\DatingService;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class DatingController extends Controller{

    protected $datingService;
    public function __construct(DatingService $datingService)
    {
        $this->datingService = $datingService;
    }
    public function uploadStatus(Request $request){
        $user_id =  $request->input('user_id');
        
        DB::table('user')->where('id',$user_id)->update(['ready_dating'=> 1]);
        DB::table('dating')->insert([
            'user_id' => $user_id,
        ]); 
        return response()->json(['success' => true]);
    }
    public function erase_status(Request $request){
        $user_id =  $request->input('user_id');
        
        DB::table('user')->where('id',$user_id)->update(['ready_dating'=> 0]);
        return response()->json(['success' => true]);
    }
    
    

    public function matchingUser(Request $request){
        $minAge = $request->input('min_age');
        $maxAge = $request->input('max_age');
        $id = auth()->id();
        $address = $request->input('address');
        $money = $request->input('money');
        $work = $request->input('work');
        $lever = $request->input('lever');
        $gender = $request->input('gender');
        $type_selects = $request->input('type_select');
        $zodiac = $request->input('zodiac');
        $address = $address ?? 'all';
        $money = $money ?? 'all';
        $work = $work ?? 'all';
        $lever = $lever ?? 'all';
        $gender = $gender ?? 'all';
        $zodiac = $zodiac ?? 'all';
        $work_encode = json_encode($work);
        $work_decode = json_decode($work_encode);
       
        $this->datingService->updateDating($id,$address,$money,$gender,$work_encode,$lever,$type_selects,$zodiac,$minAge,$maxAge);
        if($type_selects === 'all'){
            $builder = new UserQueryBuilders();
            $userMatching = $builder
                ->filterAge($minAge,$maxAge)
                ->filterLever($lever)
                ->filterLocation($address)
                ->filterMoney($money)
                ->filterWork($work_decode)
                ->filterGender($gender)
                ->filterZodiac($zodiac)
                ->getMatchingUsers();
        }
        else{
            $userInterests = DB::table('interest')
                        ->select('list_interest_id')
                        ->where('user_id', $id)
                        ->pluck('list_interest_id')
                        ->toArray();
            $builder = new UserQueryBuilders();
            $userMatching = $builder
            ->filterInterest($userInterests)
            ->filterAge($minAge,$maxAge)
            ->filterLever($lever)
            ->filterLocation($address)
            ->filterMoney($money)
            ->filterWork($work_decode)
            ->filterGender($gender)
            ->filterZodiac($zodiac)
            ->getMatchingUsers();
        }
        return response()->json(['success' => true, 'user' => $userMatching]);

    }
    public function selectUser(Request $request){
        $id = $request->input('user_id');
        $user = User::find($id);
        return response()->json(['success' => true, 'user' => $user]);
    }
    public function closeUserMatching(Request $request){
        $requested  = $request->input('requested_id');
        $requester = $request->input('requester_id');
        $check = DB::table('compatible')->where('requester_id',$requested)->where('requested_id',$requester)->first();
        if($check){
            DB::table('compatible')
            ->where('requester_id', $requested)
            ->where('requested_id', $requester)
            ->delete();
        }
        return response()->json(['success' => true]);
    

        
    }

    public function likeUser(Request $request){
        $requester_id = auth()->id();
        $requested_id = $request->input('user_id');
        $this->datingService->likeUser($requester_id,$requested_id);
    }
    // public function acceptedMatching(Request $request){
    //     $requested  = $request->input('requested_id');
    //     $requester = $request->input('requester_id');
    //     $check = DB::table('compatible')
    //     ->where(function($query) use ($requested, $requester) {
    //         $query->where('requested_id', '=', $requested)
    //               ->orWhere('requester_id', '=', $requester);
    //     })
    //     ->first();
    //     if($check){
    //         DB::table('compatible')
    //         ->where(function($query) use ($requested, $requester) {
    //             $query->where('requested_id', '=', $requested)
    //                 ->orWhere('requester_id', '=', $requester);
    //         })
    //         ->update(['status','accepted']);
    //     }
    //     else{
    //         DB::table('compatible')->insert([
    //             'reques'
    //         ]);
    //     }
    // }
}