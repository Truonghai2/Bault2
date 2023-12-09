<?php 

namespace App\Repositories;

use App\Models\Photo;

class PhotoRepository {
    public function createPhoto($userId, $postId, $filename) {
        $photo = new Photo();
        $photo->user_id = $userId;
        $photo->post_id = $postId;
        $photo->image = $filename;
        $photo->save();
        return $photo;
    }
}