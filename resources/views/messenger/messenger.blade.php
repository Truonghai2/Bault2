@if(session()->has('email'))

    @php
        $id = session('id');
    @endphp
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Messeger | Bault</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
        <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">  
        <link rel="stylesheet" href="{{ asset('css/renderPost.css') }}">
        <link rel="stylesheet" href="{{ asset('css/notifications.css') }}">
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="{{ asset('css/messenger_model.css') }}">
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

                    <form action="search.php" method="GET">
                        <input name="search" type="text" placeholder="Tìm kiếm trên Bault">
                        
                    </form>
                </div>
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
                                <form action="" method="get">
                                    <input type="text" placeholder="Tìm kiếm trên messeger">
                                </form>
                            </div>
                        </div>
                        
                    </div>
                    </div>
                </div>
                @if (session()->has('email'))
                @php
                    $email = session('email');
                    $user = DB::table('user')->where('email', $email)->first();
                @endphp
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
                @endif
                
                
                <div class="item information" id="informations">
                    @if (session()->has('email'))
                        @php
                            $email = session('email');
                            $user = DB::table('user')->where('email', $email)->first();
                        @endphp
                        @if($user)
                            <div class="avatar">
                                @if(!empty($user->avatar))
                                    <a ><li><img src="{{ asset('storage/users_avatar/'.$user->avatar) }}"></li></a>
                                @else
                                    <a ><li><img class="avatar" src="{{ asset('storage/users_avatar/guest-user-250x250.jpg') }}"></li></a>
                                @endif
                            </div>
                        @endif
                        
                    @endif
                    <div class="dropdown-user" id="">
                    
                    
                    @if (session()->has('email'))
                        @php
                            $email = session('email');
                            $user = DB::table('user')->where('email', $email)->first();
                        @endphp
                        @if($user)
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
                        @endif
                    @endif
                        

                    </div>
                </div>
                
                
            </div>
        </header>
        <div class="main">
            <div class="content d-flex m-t-100">
                <div class="main-left-messenger">
                    <div class="content-header d-flex">
                        <div class="title-themes">
                            <h3>Chat</h3>
                        </div>
                        <div class="menu-btn d-flex">
                            <div class="menu"><i class='bx bx-menu'></i></div>
                        <div class="create-new-mess">
                            <i class='bx bx-edit'></i>
                        </div>
                        </div>
                    </div>
                    <div class="content-main">
                        <div class="search-user d-flex">
                            <div class="icon">
                                <i class='bx bx-search-alt-2' ></i>
                            </div>
                            <span>Tìm kiếm trên Messenger</span>
                        </div>
                        <div class="navbar-messenger d-flex">
                            <div class="messenger-friend active">
                                <span>Hộp thư</span>
                            </div>
                            <div class="messenger-nofriend">
                                <span>Người lạ</span>
                            </div>

                            <div class="messenger-dating">
                                <span>Hẹn hò</span>
                            </div>
                        </div>
                    </div>
                    <div class="content-footer">
                        <div class="footer-messenger-friend active">

                            <div class="chat-list"></div>
                        </div>
                        <div class="footer-messenger-nofriend"></div>
                        <div class="footer-messenger-dating"></div>
                    </div>
                    
                </div>
                <div class="main-mid-messenger">
                    <div class="content-header d-flex">
                      
                            <div class="user d-flex">
                                <a href="" class="d-flex">
                                    <div class="avatar">
                                        <img src="http://127.0.0.1:8082/storage/users_avatar/320518049_516078647157927_7794997058474116629_n.jpg" alt="">
                                    </div>
                                    <div class="username"><h5>Trương Hải</h5></div>
                                </a>
                            </div>
                            <div class="menu-btn d-flex">
                                <div class="call">
                                    <i class='bx bxs-phone' ></i>
                                </div>
                                <div class="video-call"><i class='bx bxs-video' ></i></div>
                                <div class="btn-information">
                                    <i class='bx bxs-info-circle'></i>
                                </div>
                            </div>
                    </div>
                    <div class="content-main box-chat">

                        @livewire('chat')
                    </div>
                    <div class="content-footer d-flex">
                        <form class="typing-area d-flex">

                            @csrf
                            <input type="text" class="requester_id" name="requester_id" value="{{ $id }}" hidden>
                            <input type="text" class="incoming_id" name="incoming_id" value="2" hidden>
                            
                            <div class="input img">
                                <i class='bx bxs-camera'></i>
                                <input class="" type="file" name="file[]" >
                            </div>
                           
                            <div class="input title-messenger">

                                <input type="text"  name="message" class="input-field" placeholder="Nhắn tin" autocomplete="off">
                            </div>
                            
                            <div class="btn-submit">
                                <i class='bx bxs-send' ></i>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="main-right-messenger">
                    <div class="content-header">
                        <div class="user ">
                            <div class="avatar">
                                <img src="http://127.0.0.1:8082/storage/users_avatar/320518049_516078647157927_7794997058474116629_n.jpg" alt="">
                            </div>
                            <div class="username">
                                <a href=""><H4>Trương Hải</H4></a>
                            </div>
                        </div>
                        <div class="menu-btn d-flex">
                            <div class="join-profile ">
                                <div class="icon"><i class='bx bxs-user-circle' ></i></div>
                                <div class="title">
                                    <span>Xem trang cá nhân</span>
                                </div>
                            </div>
                            <div class="search-messenger ">
                                <div class="icon"><i class='bx bx-search-alt-2' ></i></div>
                                <div class="title">Tìm kiếm</div>
                            </div>
                            <div class="report">
                                <div class="icon">
                                    <i class='bx bx-repost'></i>
                                </div>
                                <div class="title">Báo cáo</div>
                            </div>
                        </div>
                    </div>
                    <div class="themes d-flex">
                        
                            <div class="color-themes"></div>
                            <div class="title">Đổi chủ đề</div>
                        
                    </div>
                    <div class="rename d-flex">
                        <div class="icon">Aa</div>
                        <div class="title">Đổi biệt hiệu</div>
                    </div>
                    <div class="file-img d-flex">
                        <div class="icon"><i class='bx bx-images' ></i></div>
                        <div class="title">File phương tiện</div>
                    </div>
                    <div class="links d-flex">
                        <div class="icon"><i class='bx bx-link' ></i></div>
                        <div class="title">Liên kết</div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/chat.js') }}"></script>
    <script>

        // selection list chat 
        var usersList = $('.chat-list');
        setInterval(() => {
            $.ajax({
                type: "GET",
                url: "/getlistchat",
                dataType: "html",
                success: function(data) {
                    
                    usersList.html(data);
                    
                },
                error: function(xhr, status, error) {
                    console.error("Lỗi AJAX: " + status + ", " + error);
                }
            });
        }, 500);

    </script>
    {{-- <script>
        
        setInterval(function() {
            $.ajax({
                type: "POST",
                url: "/messenger/{id}",
                data: { 
                    
                    '_token': '{{ csrf_token() }}'
                },
                success: function(response) {
                    chatBox.html(response.html);
                    if (!chatBox.hasClass("active")) {
                        scrollToBottom();
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Lỗi AJAX: " + status + ", " + error);
                }
            });
        }, 500);

        function scrollToBottom() {
            chatBox.scrollTop(chatBox.prop("scrollHeight"));
        }

    </script> --}}
</body>
</html>
@endif