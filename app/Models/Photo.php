<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $table = 'photos';
    protected $fillable = ['id','user_id','post_id', 'image'];

    public function post()
    {
        return $this->belongsTo(Post::class,'post_id','ID');
    }

    public function posts(){
        return $this->hasMany(Post::class, 'Creator_ID', 'id');
    }
}