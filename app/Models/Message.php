<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
    protected $table = 'messege'; // Tên bảng trong cơ sở dữ liệu
    protected $fillable = ['id','requested_id', 'requester_id', 'content','file','status','created_at'];
     // Các trường có thể được gán
    
    public  function  users(){
        return $this->belongsToMany(User::class, 'user', 'requester_id', 'requested_id')->withTimestamps();
    }
    public function isAuthenticatedUsers()
    {
        $authenticatedUserId = Auth::user()->id;
        
        return $this->requester_id === $authenticatedUserId || $this->requested_id === $authenticatedUserId;
    }
    public function getReadableCreatedAt()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }
}
