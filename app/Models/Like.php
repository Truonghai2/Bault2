<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{   protected $table = 'like';
    protected $fillable = ['user_id', 'post_id', 'created_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}