<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{ 
    use RegistersUsers;

    public function showLoginForm()
    {
        if(Auth::check()){
            return redirect()->intended('/');
        }else{
            return view('login.form_login');
        }
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            // Đăng nhập thành công
            return redirect()->intended('/');
        }
        
        // Đăng nhập thất bại
        return redirect()->back()->withErrors(['login' => 'Đăng nhập không thành công.']);
    }
    
    public function logout()
    {
        Auth::logout();
    
        return redirect('/login');
    }
     /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    public function guard()
    {
        return Auth::guard(); // Assuming you're using the default guard
    }
}
