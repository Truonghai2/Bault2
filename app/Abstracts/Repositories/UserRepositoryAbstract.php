<?php 
namespace App\Abstracts\Repositories;

use App\Models\Post;
use Contracts\Repositories\PostRepositoryInterface;

abstract class UserRepositoryAbstract implements PostRepositoryInterface{

    protected $post;
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    
    
}
