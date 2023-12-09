<?php
namespace App\Services;

use App\Abstracts\Repositories\UserRepositoryAbstract;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService{
    protected $userRepository;
    protected $userRepositoryAbstract;
    public function __construct(UserRepository $userRepository, UserRepositoryAbstract $userRepositoryAbstract)
    {
        $this->userRepository = $userRepository; 
        $this->userRepositoryAbstract = $userRepositoryAbstract;
    }
    public function RegistersUsers($first_name,$last_name,$email,$password,$birthday,$gender){
        // check pass 8 chữ số
       if (strlen($password) < 8 || !preg_match("/\d/", $password)) {
        return redirect('/login')->with('error', 'Mật khẩu phải chứa ít nhất 8 kí tự và 1 chữ số.');
    }

    // Tính tuổi từ ngày sinh 
    $birthDate = date_create($birthday);
    $now = date_create();
    $age = date_diff($now, $birthDate)->y;

    // kiểm tra xem user có nhỏ hơn 16 tuổi hay không
    if ($age < 16) {
        return redirect('/login')->with('error', 'Bạn phải đủ 16 tuổi để đăng ký tài khoản.');
    }

    // Check if email exists
    $user = User::where('email', $email)->first();
    if ($user) {
        return redirect('/login')->with('error', 'Email đã được sử dụng.');
    }

    // Hash password
    $hashed_password = Hash::make($password);
    // Insert dữ liệu vào bảng user
        $this->userRepository->CreateUser($first_name,$last_name,$email,$hashed_password,$birthday, $gender);
        return redirect('/login')->with('success', 'Đăng ký thành công. Vui lòng đăng nhập để tiếp tục.');
    }
    

}