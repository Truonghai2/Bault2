<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListInterest extends Model{
    protected $table = 'list_interest';
    protected $fillable =[
        'id',
        'content',
        'icon',
        
    ];

    public function interests()
    {
        return $this->hasMany(Interest::class, 'list_interest_id', 'id');
    }
}