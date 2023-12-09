@if ($get === 'header' && $user)

<header>
    <div class="logo">
        <div class="item">
        <a href="{{ url('/home') }}" title="Nền tảng trò chuyện, hẹn hò Bault"><img width="70px" style="margin-left: 12px;" src="{{ asset('img/new_logo.png') }}"  alt=""></a>
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
            <a class="active" href="{{ url('/') }}" title="Trang Chủ"><li><i class='bx bxs-home' ></i></li></a>
            <a href="{{ url('/friends') }}" title="Lời mời kết Bạn"><li><i class='bx bxs-user item1' ></i><i class='bx bxs-user item2' ></i></i></li></a>
            <a href="{{ url('/dating') }}" title="Hẹn Hò"><li><i class='bx bxs-heart-circle' ></i></li></a>
            <a href="{{ url('/look-around') }}" title="Tìm xung quanh bạn"><li><i class='bx bxs-location-plus' ></i></li></a>
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
            
        </div>

        <div class="item thongbao" id="notifications" data-user-id="{{ $user->id }}">
            <i class='bx bxs-bell' ></i>
            <div id="cnt-notifications">0</div>
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
            
            
            
                    
                    @if(!empty($user->avatar)) 
                    <a ><li><img width="40px" style="border-radius:50%;" src="{{ asset('storage/users_avatar/'.$user->avatar) }}"></li></a>
                     @else 
                        <a ><li><img class='avatar' src='../storage/users_avatar/guest-user-250x250.jpg'></li></a>
                    @endif
                
            
            <div class="dropdown-user" id="">
            
            
                @if($user)
                <div class="header-dropdown" id="drodown-use">
                    <div class="container user d-flex">
                        @if (!empty($user->avatar))
                        <a ><li><img src="{{ asset('storage/users_avatar/'.$user->avatar) }}"></li></a>
                        @else
                            <a href=""><li><img class="avatar" src="{{ asset('storage/users_avatar/guest-user-250x250.jpg') }}"></li></a>
                        @endif
                        <a href=""><li class="name">{{ $user->first_name }} {{ $user->last_name }}</li></a>
                    </div>
                    <div class="container">
                        <a class="item-profile" href="{{ route('profile', ['profileId' => $user->id, 'id' => $user->id]) }}">
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
                

            </div>
        </div>
        
        
    </div>
</header>

    
@endif