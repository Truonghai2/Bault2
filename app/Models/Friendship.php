<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friendship extends Model{
    protected $table = 'friendship';
    protected $fillable = [
        'requested_id',
        'requester_id',
        'created_at',
        'updated_at',
        'status',

    ];
    const STATUS_PENDING = 'pending';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_DECLINED = 'declined';
    const STATUS_BLOCKED = 'blocked';

    
    public function getRequester(){
        return $this->belongsTo(User::class, 'requester_id');
    }
    public function getRequested()
    {
        return $this->belongsTo(User::class, 'requested_id');
    }


}