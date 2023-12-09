<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Comment extends Model{
    use Notifiable;

    
    protected $table = "comment";
    protected $fillable = [
        'id',
        'post_id',
        'user_id',
        'content',
        'relay_comment',
        'Likes',
        'created_at',

    ];
    public function user_like(){
        return $this->belongsTo(User::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}