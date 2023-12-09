<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matching extends Model{
    protected $table ="dating";
    protected $fillable = [
        'id',
        'user_id',
        'address',
        'lever',
        'money',
        'work',
        'gender',
        'type_select',
        'zodiac',

    ];
    
}
