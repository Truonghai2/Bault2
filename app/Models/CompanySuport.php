<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySuport extends Model{
    protected $table = "company_suport";
    protected $fillable = [
        'link',
        'content',
        'img',
        'link_web',
        'created_at',
        'prioritize'
    ];
    // public function users(){
    //     return $this->toba
    // }
}