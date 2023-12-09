<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;       
    }
    public function create(Request $request)
    {
       // Lấy các giá trị từ request
       $first_name = $request->input('first_name');
       $last_name = $request->input('last_name');
       $email = $request->input('email');
       $password = $request->input('password');
       $birthday = $request->input('birthday_year') . '-' . $request->input('birthday_month') . '-' . $request->input('birthday_day');
       $gender = $request->input('gender');

       $this->userService->RegistersUsers($first_name,$last_name,$email,$password,$birthday,$gender);

    }
    public function showRegistrationForm(){
        
        return view('login.form_login');
    
    }
}
