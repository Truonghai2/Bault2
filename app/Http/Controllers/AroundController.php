<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Events\updateActiveUser;
use App\Models\User;
use App\QueryBuilders\UserQueryBuilders;
use App\Services\UpdateAllService;

class AroundController extends Controller{

    protected $UpdateAllService;
    protected $userQueryBuilder;
    public function __construct(UpdateAllService $updateAllService,UserQueryBuilders $userQueryBuilders)
    {
        $this->UpdateAllService = $updateAllService;
        $this->userQueryBuilder = $userQueryBuilders;
    }
    // lưu vị trí


    public function saveCheckIn(Request $request){
        $user_id = auth()->id();
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        
        $this->UpdateAllService->Update($user_id,$latitude,'latitude');
        $this->UpdateAllService->Update($user_id,$longitude,'longitude');
       
        return response() ->json('lưu vị trí thành công');
        
    }
    // lưu khoảng cách mong muốn
    public function saveReSize(Request $request){
        $user_id = auth()->id();
        $distance = $request->input('distance');
        $this->UpdateAllService->Update($user_id,$distance,'resize');
        return response()->json(['success'=>true]);
    }
    // lưu độ tuổi mong muốn
    public function saveBirthday(Request $request){
        $user_id = auth()->id();
        $minbirthday = $request->input('start_birthday');
        $maxbirthday = $request->input('end_birthday');

        $this->UpdateAllService->Update($user_id,$minbirthday,'select_birtday');
        $this->UpdateAllService->Update($user_id,$maxbirthday,'end_select_birthday');
        return response()->json(['success'=>true]);
    }
    // lưu giới tính mong muốn 
    public function saveGender(Request $request){
        $user_id = auth()->id();
        $gender =$request->input('gender');
        $this->UpdateAllService->Update($user_id,$gender,'gender');
        return response()->json(['success'=>true]);
    }
    // lưu kiểu tìm kiếm
    public function saveStype(Request $request){
        $user_id = auth()->id();
        $stype = $request->input('stypeSelect');
        $this->UpdateAllService->Update($user_id,$stype,'select_type');
        return response()->json(['success'=>true]);
    }
    // lưu ai có thể tìm thấy bạn
    public function saveWhoSelect(Request $request){
        $user_id = auth()->id();
        $who = $request->input('who_selected');
        $this->UpdateAllService->Update($user_id,$who,'who_select');
        return response()->json(['success'=>true]);
    }
    // tìm user  
    public function selectUser(Request $request){
        // $user_id = 1;
        $user_id = auth()->id();
        $user = User::find($user_id);
        $interest = DB::table('interest')->where('user_id', $user_id)->get();
        
        // Lấy sở thích của user hiện tại
        $minInterestMatch = 1;
        $userInterests = DB::table('interest')
            ->select('list_interest_id')
            ->where('user_id', $user_id)
            ->pluck('list_interest_id')
            ->toArray();

        // Tìm kiếm các người dùng khác có sở thích chung
        $matchedUsers = DB::table('interest')
            ->select('user_id')
            ->whereIn('list_interest_id', $userInterests)
            ->where('user_id', '!=', $user_id)
            ->groupBy('user_id')
            ->havingRaw('COUNT(DISTINCT list_interest_id) >= ?', [$minInterestMatch])
            ->pluck('user_id')
            ->toArray();

        // Đếm số lượng sở thích của user hiện tại
        $cntInterest = $interest->count();

        $latitude = $user->latitude;
        $longitude = $user->longitude;
        $minAge = $user->select_birthday; // Min độ tuổi user muốn tìm 
        $maxAge = $user->end_select_birthday; // Max độ tuổi user muốn tìm
        $radius = $user->resize; // Khoảng cách user muốn tìm
        $stypeGender = $user->select_gender; // Kiểu giới tính user muốn tìm
        $gender = $user->gender; // Giới tính user hiện tại

        $users = DB::table('user')->select('id', 'first_name', 'last_name', 'avatar', 'ngaysinh', 'gender', 'who_select', 'bigo')
            ->selectRaw("(6371 * ACOS(COS(RADIANS(latitude)) * COS(RADIANS($latitude)) * COS(RADIANS($longitude) - RADIANS(longitude)) + SIN(RADIANS(latitude)) * SIN(RADIANS($latitude)))) AS distance")
            ->where('id', '!=', $user_id)
            ->having('distance', '<=', $radius)
            ->orderBy('distance')
            ->get();

        // Tính tuổi của các user
        $userAge = [];
        $saveUser = [];
        $statusFriendship = [];
        foreach ($users as $index) {
            $birthDate = date_create($index->ngaysinh);
            $now = date_create();
            $age = date_diff($now, $birthDate)->y;
            $userAge[$index->id] = $age;

            $friend_ship = DB::table('friendship')
                ->where('requested_id', $user_id)
                ->where('requester_id', $index->id)
                ->first();

            if ($user->select_type === "follow_interest") {
                if ($cntInterest < 3) {
                    return response()->json(['success' => true, 'status' => 'addInterest']);
                } else {
                    if ($minAge <= $userAge[$index->id] && $userAge[$index->id] <= $maxAge) {
                        if ($stypeGender === 'all') {
                            if (in_array($index->id, $matchedUsers) && ($index->who_select === $gender || $index->who_select === 'all-select')) {
                                $saveUser[] = $index;
                                if ($friend_ship) {
                                    if ($friend_ship->status === 'pending') {
                                        $statusFriendship[$index->id] = "acceptedFriend";
                                    } else if ($friend_ship->status === 'accepted') {
                                        $statusFriendship[$index->id] = "Friend";
                                    }
                                } else {
                                    $friend_ship = DB::table('friendship')
                                        ->where('requested_id', $index->id)
                                        ->where('requester_id', $user_id)
                                        ->first();

                                    if (!$friend_ship) {
                                        $statusFriendship[$index->id] = "noFriend";
                                    } else {
                                        if ($friend_ship->status === 'pending') {
                                            $statusFriendship[$index->id] = "friendPending";
                                        } else if ($friend_ship->status === 'accepted') {
                                            $statusFriendship[$index->id] = "Friend";
                                        }
                                    }
                                }
                            }
                        } else {
                            if ($index->gender === $stypeGender && in_array($index->id, $matchedUsers) && ($index->who_select === $gender || $index->who_select === 'all-select')) {
                                $saveUser[] = $index;
                                if ($friend_ship) {
                                    if ($friend_ship->status === 'pending') {
                                        $statusFriendship[$index->id] = "acceptedFriend";
                                    } else if ($friend_ship->status === 'accepted') {
                                        $statusFriendship[$index->id] = "Friend";
                                    }
                                } else {
                                    $friend_ship = DB::table('friendship')
                                        ->where('requested_id', $index->id)
                                        ->where('requester_id', $user_id)
                                        ->first();

                                    if (!$friend_ship) {
                                        $statusFriendship[$index->id] = "noFriend";
                                    } else {
                                        if ($friend_ship->status === 'pending') {
                                            $statusFriendship[$index->id] = "friendPending";
                                        } else if ($friend_ship->status === 'accepted') {
                                            $statusFriendship[$index->id] = "Friend";
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            } elseif ($user->select_type === 'all-stype') {
                if ($minAge <= $userAge[$index->id] && $userAge[$index->id] <= $maxAge) {
                    if ($stypeGender !== 'all') {
                        if ($index->gender === $stypeGender && ($index->who_select === $gender || $index->who_select === 'all-select')) {
                            $saveUser[] = $index;
                            if ($friend_ship) {
                                if ($friend_ship->status === 'pending') {
                                    $statusFriendship[$index->id] = "acceptedFriend";
                                } else if ($friend_ship->status === 'accepted') {
                                    $statusFriendship[$index->id] = "Friend";
                                }
                            } else {
                                $friend_ship = DB::table('friendship')
                                    ->where('requested_id', $index->id)
                                    ->where('requester_id', $user_id)
                                    ->first();

                                if (!$friend_ship) {
                                    $statusFriendship[$index->id] = "noFriend";
                                } else {
                                    if ($friend_ship->status === 'pending') {
                                        $statusFriendship[$index->id] = "friendPending";
                                    } else if ($friend_ship->status === 'accepted') {
                                        $statusFriendship[$index->id] = "Friend";
                                    }
                                }
                            }
                        }
                    } else {
                        if (($index->who_select === $gender || $index->who_select === 'all-select')) {
                            $saveUser[] = $index;
                            if ($friend_ship) {
                                if ($friend_ship->status === 'pending') {
                                    $statusFriendship[$index->id] = "acceptedFriend";
                                } else if ($friend_ship->status === 'accepted') {
                                    $statusFriendship[$index->id] = "Friend";
                                }
                            } else {
                                $friend_ship = DB::table('friendship')
                                    ->where('requested_id', $index->id)
                                    ->where('requester_id', $user_id)
                                    ->first();

                                if (!$friend_ship) {
                                    $statusFriendship[$index->id] = "noFriend";
                                } else {
                                    if ($friend_ship->status === 'pending') {
                                        $statusFriendship[$index->id] = "friendPending";
                                    } else if ($friend_ship->status === 'accepted') {
                                        $statusFriendship[$index->id] = "Friend";
                                    }
                                }
                            }
                        }
                    }
                }
            }
            
        }
        return response()->json(['success'=>true,'user'=>$saveUser,'userage'=>$userAge,'statusFriendship'=>$statusFriendship]);
        // dd($saveUser, $userAge, $statusFriendship);
    }
}