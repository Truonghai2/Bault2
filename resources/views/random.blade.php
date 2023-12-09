@php

$user = App\Models\User::with('random')->find(auth()->id());
    // dd($user)
@endphp
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="id" content="2">
    <meta name="user-id" content="{{ auth()->id() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <meta name="url" content="{{ url('').'/'.config('chatify.routes.prefix') }}" data-user="{{ Auth::user()->id }}">
    <script
    src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="icon" href="{{ asset('img/new_logo.png') }}" type = "image/x-icon">
    <title>Người lạ | Bault</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">  
    <link rel="stylesheet" href="{{ asset('css/renderPost.css') }}">
    <link rel="stylesheet" href="{{ asset('css/notifications.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/loading.css') }}">
    <link rel="stylesheet" href="{{ asset('css/post.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animationsCoffee.css') }}">
    <script src="{{ asset('js/notifications.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/messenger_model.css') }}">
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('css/messenger_layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search-user.css') }}">

    <script src='https://unpkg.com/nprogress@0.2.0/nprogress.js'></script>

    {{-- styles --}}
    <link rel='stylesheet' href='https://unpkg.com/nprogress@0.2.0/nprogress.css'/>

    <script src="{{ asset('js/chatify/font.awesome.min.js') }}"></script>
    <script src="{{ asset('js/chatify/autosize.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/random.css') }}">
</head>


<body>
   <div id="wapper">
    <header>
        <div class="logo">
            <div class="item">
            <a href="/" title="Nền tảng trò chuyện, hẹn hò Bault"><img width="70px" style="margin-left: 12px;" src="{{ asset('img/new_logo.png') }}"  alt=""></a>
            </div>
            
            <div class="selection item">
                <i style="font-size: 20px; " class='bx bx-search-alt-2'></i>
                
               
                    <input class="search-user" autocomplete="off" name="search" type="text" placeholder="Tìm kiếm trên Bault">
                    
                
            </div>
            <div class="dropdown d-none" id="dropdown-search-user">
                @livewire('search-user')
            </div>
            
        <script>
            $('.search-user').click(function(){
                $('#dropdown-search-user').removeClass('d-none');
                $('.livewire-input').focus();

            })
        </script>

        </div>
        
        <nav class="nav-menu">
            <ul class="item">
                <a class="active" href="/" title="Trang Chủ"><li><i class='bx bxs-home' ></i></li></a>
                <a href="friends" title="Lời mời kết Bạn"><li><i class='bx bxs-user item1' ></i><i class='bx bxs-user item2' ></i></i></li></a>
                <a href="dating" title="Hẹn Hò"><li><i class='bx bxs-heart-circle' ></i></li></a>
                <a href="look-around" title="Tìm xung quanh bạn"><li><i class='bx bxs-location-plus' ></i></li></a>
            </ul>
        </nav>
        <div class="user">
            <div class="item menu">
                <i class='bx bx-menu'></i>
            </div>
            
            <div class="message-notification item messeger">
                <button class="message-button">
                   <i class='bx bxl-messenger' ></i>
                    
                </button>
                <span class="badge"></span>
                <div class="message-dropdown">
                    <div class="container">
                    <div class="dropdown-header">
                        <div class="title">
                            <h4>Chat</h4>
                        </div>
                        <div class="search-message d-flex">
                            <i style="font-size: 10px; " class='bx bx-search-alt-2'></i>
                           <span>Tìm kiếm trên Messenger</span>
                        </div>
                        <div class="navbar-messenger d-flex">
                            <div class="messenger-friend item active">
                                <span>Hộp thư</span>
                            </div>
                            <div class="messenger-nofriend item">
                                <span>Người lạ</span>
                            </div>

                            <div class="messenger-dating item">
                                <span>Hẹn hò</span>
                            </div>
                        </div>
                       
                    </div>
                    <div class="dropdown-main" id="dropdown-main-messenger">
                        <div class="main-messenger-friend item  active">

                            <div class="chat-list-friend" id="add_Css" >
                                
                            </div>
                        </div>
                        <div class="main-messenger-nofriend item">
                            <div class="chat-list-nofriend" id="add_Css"></div>
                        </div>
                        <div class="main-messenger-dating item" >
                            <div class="chat-list-dating" id="add_Css"></div>
                        </div>
                    </div>
                    <div class="dropdown-footer">
                        <a href="/chatify">
                            Xem tất cả trên Messenger
                        </a>
                    </div>
                </div>
                </div>
            </div>
            
            
            <div class="item thongbao" id="notifications" data-user-id="{{ $user->id }}">
                <i class='bx bxs-bell' ></i>
                <div id="cnt-notifications">0</div>
                <script>
                    var userId = $('#notifications').data('user-id');
                    $.ajax({
                        url:'/notifications',
                        type:'GET',
                        data: {
                            user_id: userId,
                            '_token': '{{ csrf_token() }}'
                            
                        },
                        success:function(response){
                            if(response.cnt_notifications  === 0){
                                $('#cnt-notifications').css('display','none');
                            }
                            $('#cnt-notifications').text(response.cnt_notifications);
                            
                        },
                        error:function(response){
                            alert(response.error);
                        }
                    })
                </script>
                <div class="dropdown" id="dropdown-notifications" style="display:none;">
                    <div class="container">
                        <div class="dropdown-header" >
                            <div class="header-left d-flex">
                                <div class="title item">
                                    <span>Thông báo</span>
                                </div>
                                <div class="btn-menu item">
                                    <i class='bx bx-menu-alt-right'></i>
                                </div>

                            </div>
                            
                            
                        </div>
                        <div class="dropdown-main">
                            <div class="form-notifications">
                                <div class="content-title">
                                    <h6>Mới nhất</h6>
                                </div>
                                <div class="New">
                                    
                                    
                                    
                                </div>
                                <div class="content-title">
                                    <h6>Lời mời kết bạn</h6>
                                </div>
                                <div class="addFriend">
                                    
                                    
                                </div>
                                <div class="content-title">
                                    <h6>Trước đó</h6>
                                </div>
                                <div class="before">
                                    
                                    
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
           
            
            
            <div class="item information" id="informations">
                
                    
                        <div class="avatar">
                            @if(!empty($user->avatar))
                                <a ><li><img src="{{ asset('storage/users_avatar/'.$user->avatar) }}"></li></a>
                            @else
                                <a ><li><img class="avatar" src="{{ asset('storage/users_avatar/guest-user-250x250.jpg') }}"></li></a>
                            @endif
                        </div>
                    
                <div class="dropdown-user" id="">
                
                 
                        <div class="header-dropdown" id="drodown-use">
                            <div class="container user d-flex">
                                @if (!empty($user->avatar))
                                    <a href=" {{ route('profile', ['id' => $user->id]) }}"><li><img src="../storage/users_avatar/{{ $user->avatar }}"></li></a>
                                @else
                                    <a href=" {{  route('profile', ['id' => $user->id]) }} "><li><img class="avatar" src="../storage/users_avatar/guest-user-250x250.jpg"></li></a>
                                @endif
                                <a href=" {{ route('profile', ['id' => $user->id]) }} "><li class="name">{{ $user->first_name }} {{ $user->last_name }}</li></a>
                            </div>
                            <div class="container">
                                <a class="item-profile" href=" {{ route('profile', ['id' => $user->id]) }}">
                                    <li>Xem tất cả trang cả nhân</li>
                                </a>
                            </div>
                        </div>
                    
                        <div class="main-dropdown">
                            <div class="menu container">
                                <li></li>
                                <li></li>
                                @if ($user->role == 'admin')
                                    <a href=""><li>Admin</li></a>
                                @endif
                                <a><li><i class='bx bxs-cog'></i>Cài đặt</li></a>
                                <a href="{{ route('logout') }}"><i class="bx bx-log-out"></i>Đăng xuất</a>
                                
                                
                            </div>
                        </div>
                   

                </div>
            </div>
            
            
        </div>
    </header>
        <div class="main đ-flex">        
                                        
            
            <div class="main-left">
                <div class="header-main-left">
                    <div class=""></div>
                </div>
                <div class="main-content-left">
                    @if($user->random && $user->random->ready_random !== 0)
                        @if($user->random && $user->random->ready_random === 1)
                            {!! view('layout.clientMatching',['get' => 'queue']) !!}
                        @elseif($user->random && $user->random->ready_random === 2)
                            @php
                                $userMatching = App\Models\User::find($user->random->to_id);
                               
                            @endphp

                            {!! view('layout.clientMatching',['get'=> 'matched', 'user' => $userMatching]) !!}
                            
                        @elseif($user->random && $user->random->ready_random === 3)
                        @endif
                    @else
                        {!! view('layout.clientMatching',['get' => 'cancel'])!!}
                    @endif
                </div>
            </div>
            @if($user->random && $user->random->ready_random === 3)
            <div class="main-rigth "style="
            margin-top: 75px;
            background-color: #e1e1e1;
            justify-content: end;
            position: fixed;
            right: 10px;
            width: 350px;
            padding: 10px;
            border-radius: 10px;
            height:87%;
            
        ">
                <div class="informain"style="
                padding: 10px;
                border-bottom: 1px solid #d0d0d0;
            ">
                    <div class="user" style="display: flex;justify-content: center;">
                        @isset($user->avatar)
                        <img width="100px" style="border-radius:50%;"src="{{ asset('storage/users_avatar/'.$user->avatar) }}" alt="">
                        @else
                        <img width="100px" style="border-radius:50%;" src="{{ asset('storage/users_avatar/guest-user-250x250.jpg') }}" alt="">
                        @endisset
                    </div>
                    <div class="username" style="text-align: center; margin-top:10px; font-weight:600;">{{ $user->first_name }} {{ $user->last_name }}</div>
                    

                </div>

                <div class="btn-action">
                    <div class="setting d-flex" style="
                    padding: 10px;
                    border-radius: 10px;
                    background-color: #d0d0d0;
                    align-items: center;
                    margin-top: 10px;
                    cursor: pointer;
                ">
                        <div class="icon">
                            <i class='bx bxs-cog'></i>
                        </div>
                        <div class="title" style="margin-left:10px;" >Cài đặt</div>
                    </div> 

                    <div class="information-app d-flex
                    " style="
                    padding: 10px;
                    border-radius: 10px;
                    background-color: #d0d0d0;
                    align-items: center;
                    margin-top: 10px;
                    cursor: pointer;
                ">
                        <div class="icon"><i class='bx bx-info-circle' ></i></div>
                        <div class="title"  style="margin-left:10px;">Thông tin</div>
                    </div>
                    <div class="out-room d-flex" style="
                    padding: 10px;
                    border-radius: 10px;
                    background-color: rgb(255, 53, 53);
                    align-items: center;
                    margin-top: 10px;
                    cursor: pointer;
                ">
                        <div class="icon"><i class='bx bx-log-out'style="color:#fff !important" ></i></div>
                        <div class="title" style="color:#fff !important; margin-left:10px;" >Thoát cuộc trò chuyện</div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
   </div>
   <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
   <script src="{{ asset('js/call/code.js') }}"></script>
    <script>
        // $('.btn-action-random').click(function(){
        //     actionsRandom();
        // })
            
    </script>

    
        <script>
            $('.btn-accept').click(function(){
                accepteMatching();
            })
            $('.btn-cancel').click(function(){
                cancelMatching();
            })
        </script>
        

       

        @if ($user->random && $user->random->ready_random === 1)
        <script>requestData()</script>
        @endif
        <script>$('.btn-action-random').on('click', function() {
            requestData();
        });
        </script>
        <script>

            $('.out-room').click(function(){
                cancelMatching();
            })
        </script>
</body>
</html>