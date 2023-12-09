<?php 
// app/Http/Controllers/AvatarController.php

namespace App\Http\Controllers;

use App\Services\AvatarService;
use Illuminate\Http\Request;

class AvatarController extends Controller {
    protected $avatarService;

    public function __construct(AvatarService $avatarService) {
        $this->avatarService = $avatarService;
    }

    public function updateAvatar(Request $request) {
        $user = auth()->user();
        $content = $request->input('content');
        $pathImage = $request->input('path');

        // Gọi service để cập nhật avatar
        $photo = $this->avatarService->updateAvatar($user, $content, $pathImage);

        // Xử lý và trả về kết quả (ví dụ: trả về ID của bức ảnh vừa tạo)
        return response()->json(['success' => true, 'photo_id' => $photo->id]);
    }
}
