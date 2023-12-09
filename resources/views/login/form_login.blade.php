@extends('login.model.login')
@section('tsss')
    

<div class="form-right">
    <div class="content-form">
        <div class="form-login">
            

            <form class="form" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="item">
                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Email đăng nhập" required autofocus>
                    
                </div>
                
                <div class="item">
                    <input id="password" type="password" name="password" placeholder="Mật khẩu" required autocomplete="current-password">
                    
                </div>
                
                
                <button class="item" id="login-button" type="submit">
                    {{ __('Đăng nhập') }}
                </button>
                @error('error')
                        <span role="alert" style="color:red; font-size:12px; margin-left:100px;">
                            <strong>{{ $error }}</strong>
                        </span>
                @enderror
                <div class="forget">
                    {{-- {{ route('password.request') }} --}}
                    <a href="">
                        {{ __('Quên mật khẩu?') }}
                    </a>
                </div>
            </form>
            
        </div>
        <div class="form-creat" id="form-creater">
            <button class="item"> Tạo tài khoản mới</button>
        </div>
    </div>
</div>

@endsection

@section('dmmm')
<div class="modal" id="myModal">
    <div class="modal-content">
        <div class="modal-header">
            <div class="title">
                <li><p>Đăng ký nhanh</p></li>
            </div>
            <div class="close">
                <li>X</li>
            </div>
        </div>
        <div class="modal-main">
            <div class="container">
                {{-- // --}}
                <form action="{{ route('register') }}"  method="POST"> 
                    @csrf
                    <input class="item first-name" type="text" name="first_name" id="first_name" placeholder="Họ" required>
                    <input class="item last-name" type="text" name="last_name" id="last_name" placeholder="Tên" required>
                    <input class="item email" type="email" name="email" id="email" placeholder="Email đăng nhập" required autofocus>
                    <input class="item email" type="email" name="email-confirm" id="email" placeholder="Nhập lại email" required autofocus>
                    <input class="item password" type="password" name="password" id="password" placeholder="Mật khẩu mới" required autocomplete="current-password">
                    <div class="birth-day d-flex">
                        <div>
                            <label class="item title" for="birthday">Ngày sinh:</label>
                        </div>
                        <div class="main">
                            <select class="item day" name="birthday_day" id="birthday_day" required>
                                <option value="">Ngày</option>
                                @for ($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <select class="item month" name="birthday_month" id="birthday_month" required>
                                <option value="">Tháng</option>
                                <option value="1">Tháng 1</option>
                                <option value="2">Tháng 2</option>
                                <option value="3">Tháng 3</option>
                                <option value="4">Tháng 4</option>
                                <option value="5">Tháng 5</option>
                                <option value="6">Tháng 6</option>
                                <option value="7">Tháng 7</option>
                                <option value="8">Tháng 8</option>
                                <option value="9">Tháng 9</option>
                                <option value="10">Tháng 10</option>
                                <option value="11">Tháng 11</option>
                                <option value="12">Tháng 12</option>
                            </select>
                            <select class="item year" name="birthday_year" id="birthday_year" required>
                                <option value="">Năm</option>
                                @for ($i = date("Y"); $i >= date("Y") - 100; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class=" gender d-flex">
                        <div class="item sex" >Giới tính:</div>
                        <div class="main">
                            <select class="item " id="gender" name="gender" required>
                                <option value="">-- Chọn giới tính --</option>
                                <option value="male">Nam</option>
                                <option value="female">Nữ</option>
                                <option value="other">Khác</option>
                            </select>
                        </div>
                    </div>
                    <input type="submit" class="register" value="Đăng ký">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection