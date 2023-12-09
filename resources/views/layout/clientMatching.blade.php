@if($get === 'matched' && $user)
@php
// dd($user);
    $genderUser = '';
                                if($user->gender === 'male'){
                                    $genderUser = 'Nam';
                                }
                                else{
                                    $genderUser = 'female';

                                }
@endphp
<div class="render-user-matching" style="
position: absolute;
width: 500px;
top: 200px;
left: 500px;
">
<div class="title">
    <h2><pre class="text-align-center" style="text-align: center;color: blueviolet !important;">Đã tìm thấy đối tượng</pre></h2>
</div>
    <div class="user">
        <div class="avatar d-flex justify-content-center">
            @isset($user->avatar)
                
            <img width="180px" style="border-radius:50%; " src="{{ asset('storage/users_avatar/'.$user->avatar) }}" alt="">
            @else
            
            <img width="180px" style="border-radius:50%; " src="{{ asset('storage/users_avatar/guest-user-250x250.jpg') }}" alt="">
            @endisset
        </div>
        <div class="informations d-flex justify-content-center align-items-center" style="margin-top:15px;">
            <div class="username" style="font-weight: 600;">
                <h3>{{ $user->first_name }} {{ $user->last_name }}</h3>
            </div>
            <div class="dot bg-black" style="animation: none; margin-left: 8px; "></div>
            <div class="gender" style="font-weight: 600; margin-left: 8px;"><h3>{{ $genderUser }}</h3></div>
        </div>
    </div>
    <div class="btn-actions d-flex justify-content-center" style="margin-top: 15px;">
        <div class="btn-cancel" style="
        width: 99%;
        text-align: center;
        padding: 10px;
        color: #f03933 !important;
border: 1px solid #f03933;
border-radius: 30px;
cursor: pointer;

    " data-user-id="{{ $user->id }}">Bỏ qua</div>
        <div class="btn-accept" style="
        width: 99%;
        text-align: center;
        padding: 10px;
        color: #47f5af !important;
border: 1px solid #47f5af;
border-radius: 30px;
cursor: pointer;
margin-left:10px;
    " data-user-id="{{ $user->id }}">Ghép</div>
    </div>
</div>
@endif



{{-- html queue matching --}}
@if ($get === 'queue')
<div class="queue-matching-user">
    <div class="" style="
    position: absolute;
    top: 100px;
    left: 712px;
">
        <div class="steaming-coffee">
            <div class="cup"></div>
          <div class="test">
          <div class="steam">
            <div class="one"></div>
            <div class="two"></div>
            </div>
            <div class="steam-2">
            <div class="one"></div>
            <div class="two"></div>
            </div>
              <div class="steam-3">
            <div class="one"></div>
            <div class="two"></div>
            </div>
            </div>
          </div>

          
    </div>
    <div class="title-queue" style="
    position: absolute;
top: 412px;
left: 589px;
width: 500px;
    ">
    <div class="title">
            <h3 style="color: #a0a0a0 !important;">Đang đợi người lạ vào chém gió...</h3>
            <h4 style="text-align: center;color: #a0a0a0 !important; margin-left:-100px;">Có thể hơi lâu chút nha. Vì bọn mình có chat bot.</h4>
          </div>

    </div>
</div>
@endif


@if ($get === 'cancel')
    <div class="content-null" style="
        position: absolute;
        width: 500px;
        top: 163px;
        left: 527px;
    ">
        <div class="title-welcome">
            <h1><pre>Hi, WELLCOME!</pre></h1>
        </div>
        <div class="title-instruct">
            <h4>Bấm nút dưới để bắt đầu tìm người lạ</h4>
        </div>
        <div class="btn-action-random top-50">
            Bắt đầu ghép ngẫu nhiên
        </div>
    </div>
    
@endif