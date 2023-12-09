<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    
    protected $table = 'post';
    protected $fillable = ['ID','Content', 'Created_at', 'Likes','type_post', 'comment', 'share', 'Creator_ID'];

    public function likes()
    {
        return $this->belongsToMany(User::class, 'like', 'post_id', 'user_id')->withTimestamps();
    }

    public function isLikedBy(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'Creator_ID');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function user_comment(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
