<?php 
namespace App\QueryBuilders;

use App\Models\Compatible;
use App\Models\User;
use App\Repositories\UserRepository;
use ParagonIE\Sodium\Compat;

class UserQueryBuilders{
    protected $query;
    protected $around;
    protected $userRepository;
    public function __construct()
    {
        $this->query = User::where('id','!=', auth()->id())->with(['avatarPhotos','avatarPosts','posts','photos','interests','compatibleRequester','compatibleRequested','friended']);
        
        
    }
    public function filterAge($minAge,$maxAge){
        $this->query->where('ngaysinh', '>=', $minAge)
            ->where('ngaysinh', '<=', $maxAge);

        return $this;
    }
    public function filterLocation($address){
        if($address !== 'all'){
            $this->query->where('diachi',$address);

        }
        return $this;
    }

    
    public function filterMoney($money){

        if($money !== 'all'){
            $this->query->where('meny',$money);

        }
        return $this;
    }
    public function filterWork($work_decode){
        if(is_array($work_decode) && count($work_decode) > 0){
            $this->query->whereIn('job',$work_decode)
                ->groupBy('id','first_name','last_name','avatar',
                'ngaysinh',
                'gender',
                'bigo',
                'latitude',
                'longitude',
                'email',
                'password',
                'img_bg',
                'diachi',
                'school',
                'resize',
                'select_birthday',
                'end_select_birthday',
                'select_gender',
                'select_type',
                'who_select',
                'created_at',
                'updated_at',
                'role',
                'ready_dating',
                'ready_random',
                'job',
                'lever',
                'meny',
                'zodiac',
                'active',
                'zalo',
                'link_fb',
                'link_ig',
                'active_status',
                'dark_mode',
                'messenger_color'
                )
                ->havingRaw('COUNT(DISTINCT job) >= ?', [1]);
        }
        return $this;
    }

    
    public function filterGender($gender){
        if ($gender !== 'all') {
            $this->query->where(function ($query) use ($gender) {
                $query->where('gender', $gender);
                if ($gender === 'LGPTM') {
                    $query->orWhere('gender', 'male');
                }
                if ($gender === 'LGPTF') {
                    $query->orWhere('gender', 'female');
                }
            });
        }
        return $this;
    }
    public function filterZodiac($zodiac)
    {
        if ($zodiac !== 'all') {
            $this->query->where('zodiac', $zodiac);
        }
        return $this;
    }
    public function statusActive($ready_dating){
        return $ready_dating !== 0;
    }

    public function filterInterest($userInterests)
    {
        if (is_array($userInterests) && count($userInterests) > 0) {
            $this->query->whereIn('id', function ($query) use ($userInterests) {
                $query->select('user_id')
                    ->from('interest')
                    ->whereIn('list_interest_id', $userInterests);
            });
        }
        return $this;
    }
    
    public function filterLever($lever){
        if($lever !=='all'){
            $this->query->where('lever',$lever);
        }
        return $this;
    }
    public function getAround(){
        $user = $this->query->get();
    }

    public function filterCompatible($user)
    {
        $requester_id = auth()->id();
        $requested_id = $user->id;
        $check = Compatible::where(function ($query) use ($requester_id, $requested_id) {
            $query->where('requester_id', $requester_id)->where('requested_id', $requested_id);
        })->orWhere(function ($query) use ($requester_id, $requested_id) {
            $query->where('requested_id', $requester_id)->where('requester_id', $requested_id);
        })->first();

        if ($check && $check->status === 'accepted') {
            // Nếu có kết quả và status là 'accepted', bạn có thể trả về null hoặc một giá trị khác (tuỳ theo nhu cầu của bạn).
            return null;
        }
        

        return $user;
    }
    public function getMatchingUsers()
    {
        $user = $this->query->get();
        $matchingUsers = [];
        $imgAvatar = [];
    
        foreach ($user as $index) {
            if ($this->statusActive($index->ready_dating) && $this->filterCompatible($index)) {
                $matchingUsers[] = $index;
                
            }
        }
    
        return $matchingUsers;
    }
    

}