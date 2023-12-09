<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model{
    protected $table = 'interest';
    protected $fillable = [
        'id',
        'user_id',
        'list_interest_id',

    ];
// relationsip 
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'interest', 'list_interest_id', 'user_id');
    }

    public function listInterest()
    {
        return $this->belongsTo(ListInterest::class, 'list_interest_id', 'id');
    }
}