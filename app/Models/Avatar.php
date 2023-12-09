<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model{
    protected $table = 'avatar';
    protected $fillable = [
        'id',
        'content',
        'img',
        'created_at',
        'user_id'
    ];

    public function avatar(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    
}