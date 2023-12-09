<?php 
namespace App\Services;

use App\Repositories\PostRepository;

class PostService{
    protected $postRepository;
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    // public function createPost($user_id,array $data){
    //     if($data['content'] === null && $data[''])
    // }
}