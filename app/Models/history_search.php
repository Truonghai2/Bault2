<?php
    namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class history_search extends Model{
    protected $table = 'history_search';
    protected $fillable = [
        'user_id',
        'user_seach_id',

    ];
}