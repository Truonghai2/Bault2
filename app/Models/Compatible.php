<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compatible extends Model{
    protected $table = 'compatible';
    protected $primaryKey = 'id';
    protected $fillable = ['requester_id','requested_id','status'];


    // relations
    public function user(){
        return $this->belongsTo(User::class,'requester_id','requested_id','id');
    }
}