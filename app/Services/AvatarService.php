<?php 
namespace App\Services;

use App\Models\Post;
use App\Repositories\UserRepository;
use App\Repositories\PhotoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AvatarService {
    protected $userRepository;
    protected $photoRepository;

    public function __construct(UserRepository $userRepository, PhotoRepository $photoRepository) {
        $this->userRepository = $userRepository;
        $this->photoRepository = $photoRepository;
    }

    public function updateAvatar($user, $content, $pathImage) {
        // Xử lý logic cập nhật avatar ở đây
        list(, $pathImage) = explode(',', $pathImage);
        $imageData = base64_decode($pathImage);
        $filename = Str::random(20) . '.jpg';
        $imagePath = 'storage/users_avatar/' . $filename;
        file_put_contents($imagePath, $imageData);

        // Tạo một bài viết mới cho avatar
        $post_id = $this->userRepository->CreatePost($content,$user->id,'avatar');
        // Lấy ID của bài viết vừa tạo
        $newPostId = $post_id;

        // Tạo bản ghi ảnh mới
        $photo = $this->photoRepository->createPhoto($user->id, $newPostId, $filename);

        // Cập nhật đường dẫn ảnh đại diện trong cơ sở dữ liệu
        $this->userRepository->updateAvatar($user->id, $filename);

        return $photo;
    }
}


