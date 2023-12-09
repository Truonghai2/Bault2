<?php   
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Random extends Model{
    protected $table = 'random';
    protected $fillable = ['user_id','ready_random','created_at','updated_at'];


    // relations

    public function users(){
        return $this->belongsTo(User::class ,'user_id','id');

    }
}