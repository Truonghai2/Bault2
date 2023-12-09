@include('Chatify::layouts.headLinks')
@php
    $user = Auth::user();

    
@endphp
<div id="wapper">
    <header>
        <div class="logo">
            <div class="item">
            <a href="/" title="Nền tảng trò chuyện, hẹn hò Bault"><img width="70px" style="margin-left: 12px;" src="{{ asset('img/new_logo.png') }}"  alt=""></a>
            </div>
            
            <div class="selection item">
                <i style="font-size: 20px; " class='bx bx-search-alt-2'></i>
                @livewire('search-user')
                {{-- <form action="search.php" method="GET">
                    <input name="search" type="text" placeholder="Tìm kiếm trên Bault">
                    
                </form> --}}
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
    <div class="messenger" style="
    max-height: 672px;
" >
        {{-- ----------------------Users/Groups lists side---------------------- --}}
        <div class="messenger-listView {{ !!$id ? 'conversation-active' : '' }}">
            {{-- Header and search bar --}}
            <div class="m-header">
                <nav>
                    <a href="#"><i class="fas fa-inbox"></i> <span class="messenger-headTitle">Chat</span> </a>
                    {{-- header buttons --}}
                    <nav class="m-header-right">
                        <a href="#"><i class="fas fa-cog settings-btn"></i></a>
                        <a href="#" class="listView-x"><i class="fas fa-times"></i></a>
                    </nav>
                </nav>
                {{-- Search input --}}
                <input type="text" class="messenger-search" placeholder="Search" />
                {{-- Tabs --}}
                {{-- <div class="messenger-listView-tabs">
                    <a href="#" class="active-tab" data-view="users">
                        <span class="far fa-user"></span> Contacts</a>
                </div> --}}
            </div>
            {{-- tabs and lists --}}
            <div class="m-body contacts-container">
               {{-- Lists [Users/Group] --}}
               {{-- ---------------- [ User Tab ] ---------------- --}}
               <div class="show messenger-tab users-tab app-scroll" data-view="users">
                   {{-- Favorites --}}
                   <div class="favorites-section">
                    <p class="messenger-title"><span>Yêu thích</span></p>
                    <div class="messenger-favorites app-scroll-hidden"></div>
                   </div>
                   {{-- Saved Messages --}}
                   <p class="messenger-title"><span>Bạn</span></p>
                   {!! view('Chatify::layouts.listItem', ['get' => 'saved']) !!}
                   {{-- Contact --}}
                   <p class="messenger-title"><span></span></p>
                   <div class="navbar-item d-flex">
                            <div class="item message-friend active">
                                <span>Hộp Thư</span>
                            </div>
                            <div class="item message-nofriend">
                                <span>Người lạ</span>
                            </div>
                            <div class="item message-dating">
                                <span>Hẹn hò</span>
                            </div>
                    </div>
                   <div class="listOfContacts active" id="messenger-friend" style="width: 100%;height: calc(100% - 272px);position: relative;"></div>
                   <div class="listOfContacts" id="messenger-nofriend" style="width: 100%;height: calc(100% - 272px);position: relative;"></div>
                   <div class="listOfContacts" id="messenger-dating" style="width: 100%;height: calc(100% - 272px);position: relative;"></div>
               </div>
               <script>
                $(document).ready(function(){
                    $('.message-friend span').click(function(){
                        $('.message-friend').addClass('active');
                        $('#messenger-friend').addClass('active');
                        $('.message-nofriend').removeClass('active');
                        $('#messenger-nofriend').removeClass('active');
                        $('.message-dating').removeClass('active');
                        $('#messenger-dating').removeClass('active');
                    })
                    $('.message-nofriend span').click(function(){
                        $('.message-friend').removeClass('active');
                        $('#messenger-friend').removeClass('active');
                        $('.message-nofriend').addClass('active');
                        $('#messenger-nofriend').addClass('active');
                        $('.message-dating').removeClass('active');
                        $('#messenger-dating').removeClass('active');
                    })
                    $('.message-dating span').click(function(){
                        $('.message-friend').removeClass('active');
                        $('#messenger-friend').removeClass('active');
                        $('.message-nofriend').removeClass('active');
                        $('#messenger-nofriend').removeClass('active');
                        $('.message-dating').addClass('active');
                        $('#messenger-dating').addClass('active');
                    })
                })
           </script>
               
                 {{-- ---------------- [ Search Tab ] ---------------- --}}
               <div class="messenger-tab search-tab app-scroll" data-view="search">
                    {{-- items --}}
                    <p class="messenger-title"><span>Tìm kiếm</span></p>
                    <div class="search-records">
                        <p class="message-hint center-el"><span>Nhập cuộc trò chuyện bạn muốn tìm</span></p>
                    </div>
                 </div>
            </div>
        </div>
    
        {{-- ----------------------Messaging side---------------------- --}}
        <div class="messenger-messagingView">
            {{-- header title [conversation name] amd buttons --}}
            <div class="m-header m-header-messaging">
                <nav class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                    {{-- header back button, avatar and user name --}}
                    <div class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                        
                        <a href="{{ !!$id ? route('profile', ['id' => $users->id]) : '' }}" class="show-listView"><i class="fas fa-arrow-left"></i></a>
                        <div class="avatar av-s header-avatar" style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;">
                            <img style="width: 100%;" src="" alt="">
                        </div>
                        <a  href="{{ !!$id ? route('profile', ['id' => $users->id]) : '' }}" class="user-name">{{ config('chatify.name') }}</a>
                    </div>
                    {{-- header buttons --}}
                    <nav class="m-header-right">
                        <a href="#" class="add-to-favorite"><i class="fas fa-star"></i></a>
                        <a href="/"><i class="fas fa-home"></i></a>
                        <a href="#" class="show-infoSide"><i class="fas fa-info-circle"></i></a>
                    </nav>
                </nav>
                {{-- Internet connection --}}
                <div class="internet-connection">
                    <span class="ic-connecting">Đang kết nối...</span>
                    <span class="ic-noInternet">Không có kết nối mạng</span>
                </div>
               
            </div>
    
            {{-- Messaging area --}}
            <div class="m-body messages-container app-scroll">
                <div class="messages">
                    <p class="message-hint center-el"><span>Hãy lựa chọn tin nhắn</span></p>
                </div>
                {{-- Typing indicator --}}
                <div class="typing-indicator">
                    <div class="message-card typing">
                        <div class="message">
                            <span class="typing-dots">
                                <span class="dot dot-1"></span>
                                <span class="dot dot-2"></span>
                                <span class="dot dot-3"></span>
                            </span>
                        </div>
                    </div>
                </div>
    
            </div>
            {{-- Send Message Form --}}
            @include('Chatify::layouts.sendForm')
        </div>
        {{-- ---------------------- Info side ---------------------- --}}
        <div class="messenger-infoView app-scroll">
            {{-- nav actions --}}
            <nav>
                <p></p>
                <a href="#"><i class="fas fa-times"></i></a>
            </nav>
            {!! view('Chatify::layouts.info')->render() !!}
        </div>
    </div>
</div>

@include('Chatify::layouts.modals')
@include('Chatify::layouts.footerLinks')
