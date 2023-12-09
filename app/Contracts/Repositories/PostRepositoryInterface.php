<?php 
namespace Contracts\Repositories;

use App\Models\User;

interface PostRepositoryInterface{
    public function createPost(User $user, array $data);
    public function deletePost(User $user, $post_id);
    public function renderPost(User $user);
    public function likePost(User $user,$post_id);
    public function checkLikePost(User $user);
    public function commentPost(User $user,array $data);
    public function reportPost(User $user, array $data);
    public function updatePost(User $user, $post_id, array $data);
    public function findPostById($post_id);
    public function getUserPosts(User $user);
    public function searchPosts($query);
}