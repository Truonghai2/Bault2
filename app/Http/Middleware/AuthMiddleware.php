<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (Auth::check()) {
            // Nếu đã đăng nhập thì cho phép tiếp tục thực hiện request
            return $next($request);
        }

        // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
        return redirect('/login');
    }
}