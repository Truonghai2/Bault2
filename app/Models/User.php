<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Repositories\UserRepository;
use App\States\FriendshipState;
use App\States\PendingFriendshipState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'user';
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'avatar',
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
        'select_birhtday',
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
        
        
    ];
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

   
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function likedPosts()
    {
        return $this->belongsToMany(Post::class, 'like', 'user_id', 'post_id');
    }
   
    public function posts()
    {
        return $this->hasMany(Post::class, 'Creator_ID','id');
    }


    public function avatarPosts()
    {
        return $this->hasMany(Post::class, 'Creator_ID', 'id')->where('type_post', 'avatar');
    }
    public function getRequester(){
        return $this->belongsTo(User::class, 'requester_id');
    }
    public function getRequested()
    {
        return $this->belongsTo(User::class, 'requested_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'user_id');
    }
    
// get interest bang user_id
    public function interests()
    {
        return $this->hasMany(Interest::class, 'user_id', 'id');
    }
// get list interest 
    public function listInterest()
    {
        return $this->belongsTo(ListInterest::class, 'list_interest_id', 'id');
    }

// lấy avatar dựa trên user_id
    public function avatarPhotos(){
        return $this->hasMany(Photo::class, 'user_id','id')->join('post','photos.post_id','=','post.ID')->where('post.type_post','avatar');
    }
    
    // lấy tất photo bằng user_id
    public function Photos()
    {
        return $this->hasMany(Photo::class,'user_id','id');
    }

    public function compatibleRequester(){
        return $this->hasMany(Compatible::class,'requester_id','id');
    }

    // get dating status and array 
    public function compatibleRequested(){
        return $this->hasMany(Compatible::class,'requested_id','id');
    }
//   get bạn bè
    public function friended()
    {
        return $this->hasMany(Friendship::class, 'requested_id', 'id')
            ->where('status', 'accepted')
            
            ->orWhere(function($q){
                $q->where('requester_id' ,$this->id)
                    ->where('status','accepted');
            });
    }



    public function liked(){
        return $this->hasMany(Like::class,'user_id','id');
    }


    public function random() {
        return $this->hasOne(Random::class, 'from_id', 'id');
    }
}
