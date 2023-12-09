<?php
 namespace App\Repositories;

use App\Models\Compatible;
use App\Models\Dating;
use App\Models\Friendship;
use App\Models\Matching;
use App\Models\Post;
use App\Models\Random;
use App\Models\User;
use PhpParser\Node\Expr\Match_;

 class UserRepository{
    
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    

    public function CreateRandom($id,$newdata, $to_id){
        $random = new Random();
        $random->from_id = $id;
        $random->to_id = $to_id;
        $random->ready_random = $newdata;
        $random->save();

    }

    public function updateRandom(Random $random,$newData,$to_id){
        $random->ready_random = $newData;
        $random->to_id = $to_id;
        $random->save();
    }

    // tạo đối tượng hẹn hò
    public function createDating($user_id,$address,$money,$gender,$work,$lever,$type_selects,$zodiac){
        $dating = new Matching();
        $dating->user_id = $user_id;
        $dating->address = $address;
        $dating->money = $money;
        $dating->work =$work;
        $dating->gender = $gender;
        $dating->lever = $lever;
        $dating->type_select = $type_selects;
        $dating->zodiac = $zodiac;
        $dating->save();
    }


    // cập nhật lại đối tượng hẹn hò
    public function updateDating($user_id,$address,$money,$gender,$work,$lever,$type_selects,$zodiac){
        $dating = Matching::where('user_id', $user_id)->first();
        $dating->address = $address;
        $dating->money = $money;
        $dating->work = $work; // Chuyển work thành JSON nếu cần
        $dating->lever = $lever;
        $dating->gender = $gender;
        $dating->type_select = $type_selects;
        $dating->zodiac = $zodiac;
        $dating->save();
    }

    

    public function updateAge($user_id,$minAge, $maxAge){
        $user = User::find($user_id);
        $user->select_birthday = $minAge;
        $user->end_select_birthday = $maxAge;
        $user->save();
    }
    public function Update($id, $newdata, $column) {
        // Kiểm tra tồn tại của người dùng
        $user = User::find($id);
     
        // Cập nhật dữ liệu
        try {
            $user->$column = $newdata;
            $user->save();
            return true;
        } catch (\Exception $e) {
            return false; // Xử lý lỗi nếu có lỗi trong quá trình lưu dữ liệu
        }
    }
    public function CreateUser($first_name,$last_name,$email,$password,$birthDay,$gender){
        $user = new User();
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->email = $email;
        $user->ngaysinh = $birthDay;
        $user->password = $password;
        $user->gender = $gender;
        $user->created_at = now();
        $user->save();
        

    }


    public function createComment(array $data)
    {
        
    }
    public function CreatePost($content,$id,$type){
        $post = new Post();
        $post->content = $content;
        $post->Creator_ID = $id;
        $post->type_post = $type;
        $post->save();

        return $post->getKey();
    }
    public function acceptedFriendship($requested_id,$requester_id){
        $friendship = Friendship::where('requested_id',$requested_id)->where('requester_id',$requester_id)->first();
        if($friendship){
            $friendship->status = 'accepted';
        }
        $friendship->save();
    }

    public function rejectFriendRequest($requested_id,$requester_id){
        Friendship::where('requested_id',$requested_id)->where('requester_id',$requester_id)->delete();
        
    }

    public function createFriendship($requester_id,$requested_id){
        $friendship = new Friendship();
        $friendship->requester_id = $requester_id;
        $friendship->requested_id = $requested_id;
        $friendship->created_at = now();
        $friendship->status = 'pending';
        $friendship->save();
  
    }
    public function unfriend($requester_id,$requested_id){
        return Friendship::where(function($query) use ($requester_id, $requested_id) {
            $query->where('requester_id', $requester_id)->where('requested_id', $requested_id);
        })->orWhere(function($query) use ($requester_id, $requested_id) {
            $query->where('requester_id', $requested_id)->where('requested_id', $requester_id);
        })->delete();
    }
    public function BlockUser($requester_id,$requested_id){
        
    }
    public function checkFriendshipStatus($requester_id,$requested_id){
        return Friendship::where(function ($query) use ($requester_id, $requested_id) {
            $query->where('requester_id', $requester_id)->where('requested_id', $requested_id);
        })->orWhere(function ($query) use ($requester_id, $requested_id) {
            $query->where('requester_id', $requested_id)->where('requested_id', $requester_id);
        })->first();

      
        
    }
    public function updateAvatar($userId, $filename) {
        // Cập nhật đường dẫn ảnh đại diện trong cơ sở dữ liệu
        return User::where('id', $userId)->update(['avatar' => $filename]);
    }


    public function checklikeUser($requester_id,$requested_id){
        return Compatible::where(function ($query) use ($requester_id,$requested_id){
            $query->where('requester_id',$requester_id)->where('requested_id',$requested_id);
        })->orWhere(function($query) use ($requester_id,$requested_id){
            $query->where('requested_id',$requester_id)->where('requester_id',$requested_id);
        })
        ->first();

    }

    public function createCompatible($requester_id,$requested_id){
        $compatible = new Compatible();
        $compatible->requester_id = $requester_id;
        $compatible->requested_id = $requested_id;
        $compatible->status = 'pending';
        $compatible->save();
    }

    public function updateCompatible($requester_id,$requested_id){
        return Compatible::where('requester_id',$requested_id)->where('requested_id',$requester_id)->update(['status' => 'accepted']);
    }
 }