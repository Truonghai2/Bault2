@php 
  $id  = Auth::user()->id;
  $userS = DB::table('user')->where('id', $id) ->first();
@endphp 

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('img/new_logo.png') }}" type = "image/x-icon">
    <title>{{ $user->first_name }} {{ $user->last_name }} | Bault</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/notifications.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
</head>
<body>
  <div id="loading-animation" class="hide">
    <!-- Animation tải -->
  </div>
    <div id="wrapper">
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
                        
                        
                        
                                
                                @if(!empty($userS->avatar)) 
                                <a ><li><img src="{{ asset('storage/users_avatar/'.$userS->avatar) }}"></li></a>
                                 @else 
                                    <a ><li><img class='avatar' src='../storage/users_avatar/guest-user-250x250.jpg'></li></a>
                                @endif
                            
                        
                        <div class="dropdown-user" id="">
                        
                        
                            @if($userS)
                            <div class="header-dropdown" id="drodown-use">
                                <div class="container user d-flex">
                                    @if (!empty($userS->avatar))
                                    <a ><li><img src="{{ asset('storage/users_avatar/'.$userS->avatar) }}"></li></a>
                                    @else
                                        <a href=""><li><img class="avatar" src="{{ asset('storage/users_avatar/guest-user-250x250.jpg') }}"></li></a>
                                    @endif
                                    <a href=""><li class="name">{{ $userS->first_name }} {{ $userS->last_name }}</li></a>
                                </div>
                                <div class="container">
                                    <a class="item-profile" href="{{ route('profile', ['profileId' => $userS->id, 'id' => $userS->id]) }}">
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
          <div class="top-content">
            <div class="container test">
              <div class="header user-thumbnail container">
                @if($user)
                    @if(!empty($user->img_bg))
                    <div class="img-background">
                      
                          <a><img src="{{ asset('storage/users_avatar/'.$user->img_bg) }}" alt="" /></a>
                        
                          
                      
                    </div>
                    <div class="set_img d-flex">
                      <i class='bx bxs-camera' ></i>
                      <div class="title">
                        @if($user->id===$userS->id)
                        <a href=""><li>Chỉnh sửa ảnh bìa</li></a>
                        @endif
                      </div>
                    </div>
                    @else
                    <div class="img-background">
                      <div class="cover-image"><a><img src="{{ asset('img/bault_logo.png') }}" alt="" /></a></div>
                      {{-- <div class="cover-image" style="background-image: url('{{ asset('img/bault_logo.png') }}')"></div> --}}


                      @if($user->id===$userS->id)
                      <div class="button-add-img d-flex">
                        <i class='bx bxs-add-to-queue' ></i>
                        <div class="title" id="add-img-bg">
                          Thêm ảnh bìa
                        </div>
                      </div>
                      @endif
                    </div>
                    @endif
                @endif
                <div class="user container d-flex">
                  <div class="avatar">
                    
                    @if($user)
                        
                        @if(!empty($user->avatar))
                            <a ><li><img id="avatar-btn-menu" src="{{ asset('storage/users_avatar/'.$user->avatar) }}"></li></a>
        
                        
                        @else 
                        <a ><li><img src="{{ asset('storage/users_avatar/guest-user-250x250.jpg') }}"></li></a>
                        
                        @endif
                    @endif
                    @if($user->id === $userS->id)
                          <div class="dropdow-avatar " id="avatar-dropdown" style="display:none;">
                            <div class="container ">
                              <div class="item d-flex">
                                <i class='bx bxs-image-alt'></i>
                                <div class="title ">
                                  Xem ảnh đại diện
                                </div>
                              </div>
                              <div class="item d-flex btn-menu-avatar">
                                <i class='bx bxs-user'></i>
                                <div class="title">
                                  Cập nhật ảnh đại diện
                                </div>
                              </div>

                            </div>
                          </div>
                          @endif
                    
                  </div>
                  
                  @if($user->id === $userS->id)
                  <div class="btn-menu-avatar">
                    <i class='bx bxs-camera'></i>
                  </div>
                  @endif
                  <div class="name">
                    <a href=""><h3>{{ $user->first_name }} {{ $user->last_name }}</h3></a>
                  </div>
                  @if($user->id===$userS->id)
                  <div class="edit d-flex">
                    <a href=""><li><i class='bx bxs-edit'></i></li></a>
                    <div class="title">
                      
                      <a href=""><li>Chỉnh sửa trang cá nhân</li></a>
                      
                      
                     
                    </div>
                 </div>
                 @else
                
                  <div class="menu d-flex">
                    <div id="add-friends">
                      <div class="add-friends item d-flex" data-checkfriendship-id="{{ $user->id  }}" data-user-id="{{ $user->id }}" data-friendship-id="{{ $userS->id }}">
                        <a ><li><i class='bx bxs-user-plus bx-flip-horizontal' ></i></li></a>
                        <div class="title d-flex">
                          
                      
                          
                          <a ><li id="Status-add-friend">Kết bạn</li></a>
                        
                        </div>
                      </div>
                    </div>
                    <div id="friend-pending" style="display:none;" data-user-id="{{ $userS->id }}" data-friendships-id="{{ $user->id }}">
                      <div class="friend-pending item d-flex" >
                        <i class='bx bxs-user-x' ></i>
                        <div class="title">
                          Hủy lời mời
                        </div>
                      </div>
                    </div>
                    <div id="friend-accepted" style="display:none;">
                      <div class="friend-accepted item d-flex">
                        <i class='bx bxs-user-check'></i>
                        <div class="title">
                          Bạn bè
                        </div>
                        
                      </div>
                      
                    </div>
                    <div class="dropdown-friend-accepted" data-user-id="{{ $userS->id }}" data-friendship-id="{{ $user->id }}" >
                      <div class="menu d-flex">
                        <div class="item d-flex">
                          <i class='bx bxs-user-x'></i>
                          <div class="title">
                            Hủy kết bạn
                          </div>
                        </div>
                      </div>
                    </div>
                    <script>
                      $(document).ready(function(){
                        $('#friend-accepted').on('click', function() {
                          $('.dropdown-friend-accepted').toggleClass('active');
                        });
                      });
                    </script>
                    <div id="accepted-btn"style="display:none;">
                      <div class="accepted item d-flex" >
                        <i class='bx bxs-user-check'></i>
                        <div class="title">
                          Phản hồi
                        </div>
                      </div>
                    </div>
                    <div id="messenger-friend">
                      <div class="messenger-friend item d-flex">
                        <a href=""><i class='bx bxl-messenger' ></i></a>
                        <div class="title">
                          <a href=""><li>Nhắn tin</li></a>
                        </div>
                      </div>
                    </div>
                    
                 </div>
                 
                 @endif
                </div>
                
              </div>
              
              <div class="block-title-add-friend" style="display:none;">
                <div class="container d-flex">
                  <div class="title item">
                    <span>{{ $user->first_name }} {{ $user->last_name }} đã gửi cho bạn lời mời kết bạn</span>
                  </div>
                  <div class="btn item d-flex">
                    <div class="btn-accepted sub-item" data-user-id="{{ $userS->id }}" data-friendship-id="{{ $user->id }}">
                      @csrf
                      <span>Chấp nhận lời mời</span>
                    </div>
                    <div class="btn-erase sub-item" data-user-id="{{ $userS->id }}" data-friendship-id="{{ $user->id }}">
                      @csrf
                      <span>Xóa lời mời</span>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="nav-menu d-flex bg-light" id="nav-item-margin">
                
                <div class="item container">
                  <div class="sub-menu d-flex">
                    <li class="tab-item active" data-target="#post-content">Bài viết</li>
                    <li class="tab-item"data-target="#intro-content">Giới thiệu</li>
                    <li class="tab-item">Bạn bè</li>
                    <li class="tab-item">Ảnh</li>
                    <li class="tab-item">Video</li>
                    <li class="tab-item">Check-in</li>
                    <li class="tab-item">Xem thêm</li>
                    
                  </div>
    
                </div>
                <div class="item">
                  <div class="btn-menu">
                    <button>...</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @if($user->id === $userS->id)
           <div class="modal" id="modal-add-avatar">
            <div class="content-modal">
              <div class="modal-header d-flex">
                <div class="title">
                  <h4>Cập nhập ảnh đại diện</h4>
                </div>
                <div class="btn-close">
               

                </div>
              </div>
              <div class="modal-main container">
                <div class="btn-add-avatar container d-flex">
                  <i class='bx bx-upload'></i>
                  <div class="title">Tải ảnh lên</div>
                  
                </div>
                <input type="file" id="file-input-avatar" name="image" multiple style="display: none;">
                <div class=""></div>
              </div>
            </div>
           </div>
           @endif
          <div class="main trans-content active" >
            
            <div class="container d-flex" id="post-content">
              <div class="user">
                <div class="information">
                  <div class="bio container">
                    <div class="header">
                      <h3>Giới thiệu</h3>
                      <div class="bigo-form">
                        <div class="title" id="bigo">
                       
                          {{ $user->bigo }}
                      
                      
                        </div>
                        @if($user->id === $userS->id)
                        <div class="edit">
                          <li class="bigo-edit-btn">Chỉnh sửa tiểu sử</li>
                        </div>
                        @endif
                      </div>
                      @if($user->id === $userS->id)
                      <div class="form-edit" style="display:none; ">
                        <div class="header">
                          <input type="text" name="newBigo" autocomplete="off" id="newBigo" value="{{ $user->bigo }}" placeholder="Nhập tiểu sử bạn của bạn">
                        </div>
                        <div class="footer ">
                          <div class="item-btn d-flex">
                            <div class="item">
                              <button class="destroy-bigo">Hủy</button>
                            </div>
                            <div class="item">
                              
                              <button class="save" name="submit" type="submit" data-user-id="{{ $user->id }}"> @csrf Lưu</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      @endif
                    </div>
                  </div>
                  <div class="school container ">
                    @if(!empty($user->school))
                     <div class="item d-flex address-user-edit">
                      <i class='bx bxs-school' ></i>
                      <div class="title">
                          
                          
                        <li class='not_null' style="padding: 10px 10px 10px 10px;">Học tại <a class="title">{{ $user->school }}</a></li>
                          
                          
                          
                      </div>
                     </div>
                     @else
                     @if($user->id===$userS->id)
                     <div class="item d-flex address-user-edit" id="">
                      <i class='bx bxs-school' ></i>
                      <div class="title" id="add-school">
                        <li class='null' >Thêm học vấn +</li>
                      </div>
                     </div>
                     @endif
                     @endif
                     @if(!empty($user->diachi))
                     <div class="item d-flex address-user-edit" >
                      <i class='bx bxs-home' ></i>
                      <div class="title">
                        
                          <li class="not_null" style="padding: 10px 10px 10px 10px;">Sống tại <a class="title" id="address">{{ $user->diachi }}</a></li>
                          
                        
                        
                      </div>
                     </div>
                     @else
                     @if($user->id === $userS->id)
                     <div  id="address-user">
                      <div class="item d-flex" >
                        <i class='bx bxs-home' ></i>
                        <div class="title">
                          
                            
                            <li class='null'>Thêm nơi ở</li>
                         
                          
                          
                        </div>
                       </div>
                     </div>
                     @endif
                     @endif
                     @if($user->id === $userS->id)
                     <div class="edit-address-user" style="display:none;">
                      <div class="header-edit-address">
                        <div class="title">
                          <span>Tỉnh/thành phố</span>
                        </div>
                        <div><input id="new-address" type="text" autocomplete="off" placeholder="Tỉnh/Thành phố"> </div>
                      </div>
                      <div class="footer-address">
                        <div class="menu-item d-flex">
                          <div class="item">
                            <button class="cansole-address">Hủy</button>
                          </div>
                          <div class="item">
                            <button class="save-address" data-user-id="{{ $user->id }}">@csrf Lưu</button>
                          </div>
                        </div>
                      </div>
                     </div>
                     @endif
                     @if($user->id === $userS->id)

                     <div class="item edit">
                      <li class="null">Chỉnh sửa chi tiết</li>
                    </div>
                    @endif


                    <div class="item interest" >
                      <div class="item-interest">
                        @foreach($interestUser as $item)
                                                    <div class="row">
                                                        @foreach($item as $interest)
                                                        {{-- @dd($interest) --}}
                                                            <div class="box-interest d-flex">
                                                                <li class="icon"><img width="40px" src="{{ asset('img/icon/'.$interest->listInterest->icon) }}" alt="Icon"></li>
                                                                <li class="title">{{ $interest->listInterest->content }}</li>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                      </div>
                       @if($user->id === $userS->id)
                        <div class="btn-add-interest" id="btn-interest">
                          <li class='null'>Thêm sở thích</li>
                        </div>
                      @endif
                      
                    </div>
                     
                  </div>
                  
    
                </div>
                <div class="modal" id="interest">
                  <div class="content container">
                    <div class="modal-header">
                      <div class="modal-header-left center">
                        <h4>Thêm sở thích</h4>
                        
                      </div>
                      <div class="modal-header-right ">
                        <div class="btn-close"></div>
                      </div>

                      {{-- <div class="footer-header-modal">
                        <li><span>Bạn thích làm gì? Hãy chọn các sở thích phổ biến dưới đây hoặc thêm sở thích khác nhé.</span></li>
                      </div> --}}
                    </div>
                    <div class="modal-main">
                      {{-- <div class="header-main">
                        <div class="title">
                          <h5>Sở thích được đề suất</h5>

                        </div>
                        <div class="menu-interest container">
                          @php
                              $list = DB::table('list_interest')->get();
                              $chunkedList = $list->take(9)->chunk(3);
                              $interest = DB::table('interest')->where('user_id', $user->id)->get();

                              
                          @endphp
                      
                          @foreach($chunkedList as $row)
                              <div class="row">
                                  @foreach($row as $index)
                                      <div class="block-interest d-flex">
                                          <div class="custom-radio d-flex">
                                              <input type="checkbox" id="option{{ $index->id }}" name="choice[]" value="{{ $index->id }}"
                                                     @foreach($interest as $int)
                                                         @if($int->content === $index->content && $id === $int->user_id) checked @endif
                                                     @endforeach>
                                              <label for="option{{ $index->id }}" class="d-flex">
                                                  <div class="icon"><img src="{{ asset('img/icon/'.$index->icon) }}" alt="Icon"></div>
                                                  <div class="title">{{ $index->content }}</div>
                                              </label>
                                          </div>
                                      </div>
                                  @endforeach
                              </div>
                          @endforeach
                      </div> --}}
                        <div class="search-interest d-flex">
                          <div class="icon-search">
                            <i class='bx bx-search-alt-2'></i>
                          </div>
                          <div class="title">
                            <span>Tìm kiếm sở thích khác</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer-interest">
                      <div class="two-btn-status d-flex">
                        <div class="erase">Hủy</div>
                        <div class="save">Lưu</div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="modal" id="search-interest">
                  <div class="content">
                    <div class="modal-header">
                      <div class="header-left">
                        <div class="title">
                          <h4>Tìm kiếm sở thích</h4>
                        </div>
                        
                      </div>
                      <div class="header-right">
                        <div class="btn-close"></div>
                      </div>
                    </div>
                    <div class="modal-main">
                      <div class="header-main ">
                          <div class="search d-flex">
                            <div class="icon">
                              <i class='bx bx-search-alt-2'></i>
                            </div>
                            <div class="input">
                              <input id="search-interest-ip" type="text" placeholder="Nhập sở thích bạn muốn tìm">
                            </div>
                          </div>
                      </div>
                      <div id="insert-search-interest">

                      </div>
                      
                    </div>
                    <div class="modal-footer"></div>
                  </div>
                  
                </div>
                
                <div class="album-img">
                  <div class="header-album d-flex">
                    <div class="header-left">
                        <div class="title">
                          <a href=""> <li><h4>Ảnh</h4></li></a>
                        </div>
                    </div>
                    <div class="header-right">
                        <div class="title">
                          <a href=""> <li>Xem tất cả ảnh</li></a>
                        </div>
                    </div>
                  </div>
                  <div class="main">
                    
    
                  </div>
                </div>
              </div>
              <div class="post">
                <div class="header-post">
                <div class="status">
                    <div class="status-top item">
                      <div class="avatar">
                       
                          
                          @if(!empty($userS->avatar)) 
                            <a href=" url('/profile')" ><li><img src="{{ asset('storage/users_avatar/'.$userS->avatar) }}"></li></a>
                          @else 
                            <a  ><li><img class='avatar' src="{{ asset('storage/users_avatar/guest-user-250x250.jpg') }}"></li></a>
                          @endif
                          
                        

                      </div>
                      <div id="status-input" class="input-status item"  style="cursor:pointer; ">
                        <span>Bạn hãy viết gì đó đi...</span>
                      </div>
    
                    </div>
                    <div class="status-menu" >
                      <div class="item" id="status-img" style="text-align: center;">
                        <i class='bx bxl-instagram-alt'  ></i>
                        <a  href="#"> Ảnh/Video</a>
                      </div>
                      <div class="item" id="status-check">
                        <i class='bx bx-current-location'></i>
                        <a href="#" onclick="getLocation()">Check-in</a>
                        
                      </div>
    
                    </div>
                    
                  </div>
                </div>

               
                
                @forelse ($post as $key => $posts)
                
                        <div class="post-title post" data-post-id="{{ $posts->ID }}" data-user-id="{{ $user->id }}">
                        <div class="container">
                            <div class="header-post-title d-flex">
                                <div class="avatar" id="transProfile"  data-profile-id="{{ $posts->Creator_ID }}" data-user-id="{{ $user->id }}">
                                    @isset($posts->user->avatar)
                                    <a href="{{ route('profile',['id'=>$posts->Creator_ID]) }}"><li><img src="{{ asset('storage/users_avatar/' . $posts->user->avatar) }}" alt=""></li></a>
                                    @else
                                    <a href="{{ route('profile',['id'=>$posts->Creator_ID]) }}" ><li><img src="{{ asset('storage/users_avatar/guest-user-250x250.jpg') }}"></li></a>
                                    @endisset
                                </div>
                                <div class="name">
                                    <a href="{{ route('profile',['id'=>$posts->Creator_ID]) }}"><li>{{ $posts->user->first_name }} {{ $posts->user->last_name }}</li></a> 
                                    <div class="time">
                                    <li>{{ \Carbon\Carbon::parse($posts->Created_at)->diffForHumans() }}</li>
                                    </div>
                                </div>
                                <div class="menu" >
                                    <span id ="spanMenu-post" data-target="dropdown-post">...</span>
                                    <div class="dropdown-menu-post" id="dropdown-post" style="display: none">
                                        <div class="container">
                                            @if($posts->Creator_ID === $user->id)
                                                <div class="edit item">
                                                    <i class='bx bxs-edit-alt' ></i>
                                                    <div class="title"> Chỉnh sửa bài viết</div>
                                                </div>
                                                
                                                    <div class="remote item">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="delete-post-btn d-flex" data-post-id="{{ $posts->ID }}">
                                                            <i  class='bx bxs-trash'></i>
                                                            <div class="title">Xóa bài viết</div>
                                                        </button>
                                                    </div>
                                                
                                            @else
                                                <div class="repost-post item">
                                                    <i class='bx bxs-comment-error'></i>
                                                    <div class="title">Báo cáo bài viết</div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(!empty($posts->Content))
                            <div class="content"><p>{{ $posts->Content }}</p></div>
                            @endif
                            <div class="main-img"  data-toggle="modal" data-target="modal-post" data-post-id="{{ $posts->ID }}" data-user-post-id="{{ $posts->Creator_ID }}">
                            
                            
                            @isset ($postImages[$posts->ID])
                                <img src="{{ asset('img/upload/'.$postImages[$posts->ID]) }}" alt="">
                            @endisset
                                                
                            <div class="item d-flex">
                                <div class="like-count d-flex" >
                                   
                                   <img src="{{ asset('img/likes.png') }}" alt="">
                                   <div id="like-count">{{ $posts->Likes }}</div>
                                    
                                </div>
                                <div class="coment-count d-flex">
                                    {{ $posts->Comments }}
                                    <div class="icon-comment"><img src="{{ asset('img/comment.png') }}" alt=""></div>
                                </div>
                                <div class="share-count d-flex">
                                    0
                                    <div class="icon-share">
                                        <i class='bx bx-share bx-flip-horizontal' ></i>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="footer-post-img d-flex">
                            <div class="like item d-flex ">
                                <div class="sub-item  d-flex">
                                    
                              
                                    <div class="like-content like-btn">
                                           
                                                <form id="like-form" action="{{ route('post.like') }}" method="POST">
                                                    @csrf
                                                    
                                                    <input type="hidden" name="post_id" value="{{ $posts->ID }}">
                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                    <button type="submit" data-is-liked="" class="btn like-btn d-flex">
                                                        <i class="bx bxs-like"></i>
                                                        <div class="title">Thích</div>
                                                        
                                                    </button>
                                                </form>
                                            
                                                <form id="unlike-form" action="{{ route('post.unlike') }}" method="POST" style="display:none">
                                                    @csrf
                                                    <input type="hidden" name="post_id" value="{{ $posts->ID }}">
                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                    <button type="submit" class="btn unlike-btn d-flex">
                                                        <i class="bx bxs-like"></i>
                                                        <div class="title">Thích</div>
                                                    </button>
                                                </form>
                                            
                                    </div>
                                </div>
                            </div>
                            <div class="comment item d-flex ">
                                <div class="sub-item d-flex">
                                <a href="#target-comment"><li><i class="bx bxs-comment"></i></li></a>
                                <div class="comments"><a href="#target-comment-{{ $posts->ID }}" data-post-id="{{ $posts->ID }}"><li>Bình luận</li></a></div>
                                </div>
                            </div>
                            <div class="share item d-flex">
                                <div class="sub-item d-flex">
                                <a href="#"><li><i class='bx bxs-share bx-flip-horizontal' ></i></li></a>
                                <div class="shares"><a href>Chia sẻ</a></div>
                                </div>
                            </div>
                            </div>
                            <div class="Render-minicoment">
                                <div class="content" id="comments">
                                    <div class="box-comment">
                                        
                                        <div class="select-all-comment @if($cntCmt[$posts->ID] <= 2) d-none @endif "><span>Xem tất cả bình luận</span></div>
                                        <div class="render-comment">

                                            
                                            @foreach ($comment as $postId => $postComments)
                                            @if (!empty($postComments) && $postId === $posts->ID)
                                                @php
                                                    $reversedComments = collect($postComments)->reverse(); // Reverse the comments collection
                                                @endphp
                                                @foreach ($reversedComments as $comments)
                                                    @php
                                                        $startDate = Carbon\Carbon::parse($comments['created_at']); // Sử dụng parse để chuyển đổi ngày tháng từ chuỗi hoặc timestamp
                                                        $endDate = Carbon\Carbon::now(); // Ngày đích, hiện tại
                                                        $diff = $startDate->diffForHumans($endDate);
                                                    @endphp
                                                    
                                                    <div class="user d-flex">
                                                        <div class="avatar-user">
                                                            <a href="{{ route('profile',['id' => $comments['user']['id']]) }}">
                                                                @if (isset($comments['user']['avatar']) && !empty($comments['user']['avatar']))
                                                                    <img style="width: 40px; border-radius:50%;" src="{{ asset('storage/users_avatar/' . $comments['user']['avatar']) }}" alt="">
                                                                @else
                                                                    <img style="width: 40px; border-radius:50%;" src="{{ asset('storage/users_avatar/guest-user-250x250.jpg') }}" alt="">
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="comment-content">
                                                            <div class="comment-content-header">
                                                                <div class="name-user">
                                                                    <a href="{{ route('profile',['id' => $comments['user']['id']]) }}"><h6>{{ $comments['user']['first_name'] }} {{ $comments['user']['last_name'] }}</h6></a>
                                                                </div>
                                                                <div class="content-body">
                                                                    <span class="content-cmt">{{ $comments['content'] }}</span>
                                                                    <span class="cnt-like-cmt d-none" data-cmt-id="{{ $comments['id'] }}">
                                                                        <div class="content-cnt d-flex">
                                                                            <div class="icon-like">
                                                                                <img src="{{ asset('img/likes.png') }}" alt="">
                                                                            </div>
                                                                            <div class="cntLikes" data-cmt-id="{{ $comments['id'] }}"></div>
                                                                        </div>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="btn-function d-flex">
                                                                <div class="btn-like-comment" data-cmt-id="{{ $comments['id'] }}" data-post-id="{{ $posts->ID }}">
                                                                    <span>Thích</span>
                                                                </div>
                                                                <div class="btn-relay" data-cmt-id="{{ $comments['id'] }}" data-user-id="{{ $comments['user']['id'] }}" data-user-name="{{ $comments['user']['first_name'] }} {{ $comments['user']['last_name'] }}" data-post-id="{{ $posts->ID }}">
                                                                    <span>Phản hồi</span>


                                                                    
                                                                </div>
                                                                <div class="time-comment">
                                                                    <span>{{ $diff }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="relay-comments-render ">
                                                        <div class="render-relay-comment ">
                                                            <div class="title-render-comment @if($cntReply[$posts->ID] <= 2) d-none @endif">
                                                                <span>Xem thêm bình luận</span>
                                                            </div>
                                                            <div class="render-reply-comment" data-cmt-id="{{ $comments['id'] }}">
                                                               @php
                                                                   $rev = collect($replyComment[$posts->ID])->reverse();
                                                               @endphp
                                                                @foreach ($rev as $reply)
                                                                
                                                                @php
                                                                    $startDate = Carbon\Carbon::parse($reply['created_at']);
                                                                    $endDate = Carbon\Carbon::now();
                                                                    $dif = $startDate->diffForHumans($endDate);

                                                                    $relayComment = json_decode($reply['relay_comment']);

                                                                    // Check if JSON decoding was successful
                                                                    if ($relayComment !== null) {
                                                                        $check = $relayComment->cmt_id;
                                                                    } else {
                                                                        $check = null; // Handle the case where JSON decoding failed
                                                                    }
                                                                    if($relayComment->user_id !== $user->id){
                                                                        $users = App\Models\User::find($relayComment->user_id);
                                                                    }
                                                                   
                                                                        
                                                                    
                                                                    

                                                                @endphp
                                                                @if($check == $comments['id'])
                                                                    <div class="user d-flex">
                                                                        <div class="avatar-user">
                                                                            <a href="{{ route('profile',['id' => $reply['user']['id']]) }}">
                                                                                @if (isset($reply['user']['avatar']) && !empty($reply['user']['avatar']))
                                                                                    <img style="width: 40px; border-radius:50%;" src="{{ asset('storage/users_avatar/' . $reply['user']['avatar']) }}" alt="">
                                                                                @else
                                                                                    <img style="width: 40px; border-radius:50%;" src="{{ asset('storage/users_avatar/guest-user-250x250.jpg') }}" alt="">
                                                                                @endif
                                                                            </a>
                                                                        </div>
                                                                        <div class="comment-content">
                                                                            <div class="comment-content-header">
                                                                                <div class="name-user">
                                                                                    <a href="{{ route('profile',['id' => $reply['user']['id']]) }}"><h6>{{ $reply['user']['first_name'] }} {{ $reply['user']['last_name'] }}</h6></a>
                                                                                </div>
                                                                                <div class="content-body">
                                                                                    <span class="content-cmt">@if($relayComment->user_id !== $comments['user']['id'])<span class="user-get-name-reply"><a href="{{ route('profile',['id'=> $comments['user']['id']]) }}">{{ $comments['user']['first_name'] }} {{ $comments['user']['last_name'] }}</a></span>@endif {{ $reply['content'] }}</span>
                                                                                    <span class="cnt-like-cmt d-none" data-cmt-id="{{ $reply['id'] }}">
                                                                                        <div class="content-cnt d-flex">
                                                                                            <div class="icon-like">
                                                                                                <img src="{{ asset('img/likes.png') }}" alt="">
                                                                                            </div>
                                                                                            <div class="cntLikes" data-cmt-id="{{ $reply['id'] }}"></div>
                                                                                        </div>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="btn-function d-flex">
                                                                                <div class="btn-like-comment" data-cmt-id="{{ $reply['id'] }}" data-post-id="{{ $posts->ID }}">
                                                                                    <span>Thích</span>
                                                                                </div>
                                                                                <div class="btn-relay" data-cmt-id="{{ $reply['id'] }}" data-user-id="{{ $reply['user']['id'] }}" data-user-name="{{ $reply['user']['first_name'] }} {{ $reply['user']['last_name'] }}" data-post-id="{{ $posts->ID }}">
                                                                                    <span>Phản hồi</span>
                
                
                                                                                    
                                                                                </div>
                                                                                <div class="time-comment">
                                                                                    <span>{{ $dif }}</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="form-relay-cmt-{{ $comments['id'] }} d-none custom-replay-comment">
                                                                <div class="user d-flex">
                                                                    <div class="avatar">
                                                                        @isset($user->avatar)
                                                                            <img style="width: 40px; border-radius:50%;" src="{{ asset('storage/users_avatar/' . $user->avatar) }}" alt="{{ $user->first_name }} {{ $posts->last_name }}">
                                                                        @else
                                                                            <img style="width: 40px; border-radius:50%;" src="{{ asset('storage/users_avatar/guest-user-250x250.jpg') }}">
                                                                        @endisset
                                                                    </div>
                                                                    <div class="reply-cmt-{{ $comments['id'] }} d-flex" style="width:100%;">
                                                                        @csrf
                                                                        <input name="reply-cmt-user-id" value=""   type="hidden">
                                                                        <input type="hidden" name="cmt-id-reply" value="">
                                                                        <input type="hidden" name="post-id-reply" value="">
                                                                        <div class="input-cmt">
                                                                            <div class="input-relay-comment-{{ $comments['id'] }}" id="editable-content" contentEditable="true">
                                                                                <p class="title-reply-comment" dir="ltr">
                                                                                    <span class="name-user-reply"></span>
                                                                                    <span class="focus"> </span>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="submit">
                                                                            <button type="submit-reply-comment" name="submit-comment-reply-comment" class="submit-reply-comment" data-cmt-id="{{ $comments['id'] }}"><i class='bx bxs-send'></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>      
                                                        </div>
                                                    </div>
                                                    
                                                @endforeach
                                            @endif
                                        @endforeach
                                        </div>
                                    </div>
                                </div>
                                <form id="comment-form"  action="{{ route('cmtpost') }}" method="POST">
                                    <div class="user d-flex">
                                        <div class="avt">
                                            @isset($user->avatar)
                                                <a href="{{ route('profile',['id'=>$user->id]) }}"><li><img src="{{ asset('storage/users_avatar/' . $user->avatar) }}" alt="{{ $user->first_name }} {{ $posts->last_name }}"></li></a>
                                            @else
                                                <a href="{{ route('profile',['id'=>$user->id]) }}"><li><img src="{{ asset('storage/users_avatar/guest-user-250x250.jpg') }}"></li></a>
                                            @endisset
                                        
                                        </div>
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $posts->ID }}">
                                        <input type="hidden" name="relay_comment" value="">
                                        <div class="input-tile">
                                            <input name="content" id="target-comment-{{ $posts->ID }}" type="text" autocomplete="off" placeholder="Viết bình luận...">
                                            
                                        </div>
                                        <div class="submit">
                                            <button  type="submit-comment" name="submit-comment"><i class='bx bxs-send'></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div> 
                        </div>

                        
                        
                    @empty
                        <h4 class="post-null">Hiện không có bài viết nào!</h4>
                    @endforelse
                        
              
              </div>
              
            </div>

            
           </div>
           <div class="main trans-content">
              <div  id="intro-content"> 
                <div class="container block-content-info d-flex">
                  <div class="content">
                    <div class="header-content">
                      <h3>Giới thiệu</h3>
                    </div>
                    <div class="menu container">
                      <div class="item-info active"><li>Tổng quan</li></div>
                      <div class="item-info"><li>Công việc và học vấn</li></div>
                      <div class="item-info"><li>Nơi sống</li></div>
                      <div class="item-info"><li>Thông tin liên hệ và cơ bản</li></div>
                      <div class="item-info"><li>Gia đình và các mối quan hệ</li></div>
                      @if($user->id === $userS->id)
                      <div class="item-info"><li>Chi tiết về bạn</li></div>
                      @else
                      <div class="item-info"><li>Chi tiết về {{ $user->last_name }}</li></div>
                      @endif
                      <div class="item-info"><li>Sự kiện trong đời</li></div>
                    </div>
                  </div>
                  <div class="info">
                    <div class="container">
                      <div class="menu-info active">
                        @if($user->id !== $userS->id)
                        <div class="item d-flex">
                          <i class='bx bxs-briefcase'></i>
                          @if(!empty($user->vieclam))
                          <div class="title">làm việc tại {{ $user->vieclam}}</div>
                          @else
                          <div class="title">Không có nơi làm việc để hiển thị</div>
                          @endif
                        </div>
                        @else
                        <div class="item d-flex">
                          @if(!empty($user->vieclam))
                          <i class='bx bxs-briefcase'></i>
                         
                          <div class="title">làm việc tại {{ $user->vieclam}}</div>
                          <div class="btn-menu">
                            <span>...</span>
                          </div>
                          @else
                          <i class='bx bx-plus'></i>
                          <div class="title"><a href="">Thêm nơi làm việc</a></div>
                          @endif
                        </div>
                        @endif
                        @if($user->id !== $userS->id)
                        <div class="item d-flex">
                          <i class='bx bxs-location-plus' ></i>
                          @if(!empty($user->diachi))
                          <div class="title">Sống tại {{ $user->diachi }}</div>
                          @else
                          <div class="title">Không có địa điểm nào để hiển thị</div>
                          @endif
                        </div>
                        @else
                        <div class="item d-flex">
                          @if(!empty($user->diachi))
                          <i class='bx bxs-location-plus' ></i>
                          
                          <div class="title">Sống tại {{ $user->diachi }}</div>
                          @else
                          <i class='bx bx-plus'></i>
                          <div class="title"> <a href="">Thêm nơi ở</a> </div>
                          @endif
                        </div>
                        @endif
                        <div class="item d-flex">
                          <i class='bx bxs-graduation'></i>
                          @if(!empty($user->school))
                          <div class="title">Học tại {{ $user->school}}</div>
                          <div class="btn-menu">
                            <span>...</span>
                          </div>
                          @else
                          <div class="title">Không có trường học nào để hiển thị</div>
                          @endif
                        </div>
                      </div>
                      <div class="menu-info">
                        <div class="item">
                          <div class="header-menu-info">
                            <h5>Công việc</h5>
                          </div>
                          <div class="main-menu-info d-flex">
                            
                            @if(!empty($user->vieclam))
                              <i class='bx bxs-graduation'></i>
                              <div class="title">làm việc tại {{ $user->vieclam }}</div>
                              <i class='bx bxs-edit-alt'></i>
                            
                            @else
                              @if($userS->id === $user->id)
                                <div class="d-flex hover-bg-color">
                                  <i class="bx bx-plus"></i>
                                <div class="title">
                                  Thêm nơi làm việc
                                </div>
                                </div>
                                @else
                                <i class='bx bxs-graduation'></i>
                                <div class="title">Không có nơi làm việc để hiển thị</div>
                              @endif
                            @endif
                          </div>
                        </div>
                        <div class="item">
                          <div class="header-menu-info">
                            <h5>Trường học</h5>
                            <div class="main-menu-info d-flex">
                              
                              @if(!empty($user->school))
                                <i class='bx bxs-graduation'></i>
                                <div class="title">Học tại {{ $user->school}}</div>
                                <i class='bx bxs-edit-alt'></i>
                              @else
                                @if ($userS->id === $user->id)
                                    <i class="bx bx-plus"></i>
                                    <div class="title">Thêm trường học</div>
                                    @else
                                    <i class='bx bxs-graduation'></i>
                                    <div class="title">Không có trường học nào để hiển thị</div>
                                @endif
                              
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="menu-info ">
                        <div class="item">
                          <div class="header-menu-info">
                            <h5>Nơi sống</h5>
                            <div class="main-menu-info d-flex">
                              
                              @if(!empty($user->diachi))
                              <i class='bx bxs-location-plus' ></i>
                              <div class="title">Sống tại {{ $user->diachi }}</div>
                              @else
                                 @if ($userS->id === $user->id)
                                  <i class="bx bx-plus"></i>
                                  <div class="title">Thêm nơi ở</div>
                                     @else
                                     <i class='bx bxs-location-plus' ></i>
                                  <div class="title">Không có địa điểm nào để hiển thị</div>
                                 @endif
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="menu-info">
                        <div class="item">
                          <div class="header-menu-info">
                            <h5>Thông tin liên hệ</h5>
                            <div class="main-menu-info d-flex">
                              <i class='bx bxs-envelope' ></i>
                              
                              <div class="title"><a href="mailto:{{ $user->email }}">Email: {{ $user->email }}</a></div>
                              
                              
                              
                            </div>
                            <div class="main-menu-info d-flex">
                              <i class='bx bxs-phone' ></i>
                              @if(!empty($user->sodienthoai))
                              <div class="title">số điện thoại: {{ $user->sodienthoai }}</div>
                              @else
                              <div class="title">Không có số điện thoại nào để hiển thị</div>
                              @endif
                              
                              
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="header-menu-info">
                            <h5>Các trang web và liên kết xã hội</h5>
                            <div class="main-menu-info d-flex">
                              <i class='bx bx-link' ></i>
                              
                              @if(!empty($user->link))
                              <div class="title"> <a href="{{ $user->link }}">{{ $user->link }}</a></div>
                              @else
                              <div class="title"> Không có liên kết để hiển thị</div>
                              @endif
                              
                              
                              
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="header-menu-info">
                            <h5>Thông tin cơ bản</h5>
                            <div class="main-menu-info d-flex">
                              <i class='bx bxs-cake'></i>
                              <div class="title">
                                  {{ $user->ngaysinh }}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
           </div>
           <div class="main trans-content">
              
           </div>
           <div class="main trans-content">
            @php


            @endphp
              ảnh
           </div>
           <div class="main trans-content">video</div>
           <div class="main trans-content">check-in</div>
           
        </div>
        <script src="{{ asset('js/vi.js') }}"></script>
        <script src="{{ asset('js/notifications.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script>
                 
          $('.search-interest').on('click',function(){
            $('#search-interest').css('display','block');
            $('#interest').css('display','none');
          })
          $('.btn-close').on('click',function(){
            $('#search-interest').css('display','none');
          })
          document.getElementById('search-interest-ip').addEventListener('input',function(){
            var values = this.value;
            
            search(values);
          })
         
          function search(values){
            $.ajax({
              url:'/search-interest',
              data: {
                val : values,
              },
              success:function(response){
                displayInterest(response);
              }
            })
          }
          function displayInterest(response){
            var searchResultsContainer = document.getElementById('insert-search-interest');
            searchResultsContainer.innerHTML = '';

            // Hiển thị kết quả tìm kiếm
            if (response.length > 0) {
              for (var i = 0; i < response.length; i++) {
                var resultItem = document.createElement('div');
                var resultIcon = document.createElement('img');
                resultIcon.src = '{{ asset('img/icon/') }}' + '/' + response[i].icon;
                resultItem.textContent = response[i].content;
                searchResultsContainer.appendChild(resultIcon);
                searchResultsContainer.appendChild(resultItem);
              }
            } else {
              var noResultsMessage = document.createElement('div');
              noResultsMessage.textContent = 'Không tìm thấy kết quả.';
              searchResultsContainer.appendChild(noResultsMessage);
            }
          }
        
      </script>
        <script>
          $(document).ready(function(){ 
            $('#btn-interest').on('click',function(){
              $('#interest').css('display','block');
            })
            $('.btn-close').on('click',function(){
              $('#interest').css('display','none');
            })
          })
        </script>
        <script>
          moment.locale('vi');
            $(document).ready(function() {
                $('#notifications').on('click', function(event) {
                    event.stopPropagation(); // Prevent click event from propagating to document
                    $('#dropdown-notifications').toggle();

                    var userId = {{ $id }};
                    $.ajax({
                        url: '/loadNotifications',
                        type: 'GET',
                        data: {
                            user_id:userId,
                        },
                        success: function(response) {
                            var notifications = response.notification;
                            var requesters = response.requesters;
                            $('.addFriend').empty();
                           
                            var form = "";
                            var newForm = "";
                            var formAddFriend = "";
                            if (notifications === null) {
                                $('.form-notifications').empty();
                                form += '<h5 class="null-notification">Hiện không có thông báo nào</h5>';
                            } else {
                                for (var i = notifications.length - 1; i >= 0; i--) {
                                    var notification = notifications[i];
                                    var requesterId = notification.requester_id;
                                    var requester = null;

                                    // Tìm kiếm thông tin của requester dựa trên requesterId
                                    for (var j = 0; j < requesters.length; j++) {
                                        if (requesters[j].id === requesterId) {
                                            requester = requesters[j];
                                            break;
                                        }
                                    }
                                    if (requester) {
                                        // Xử lý thông báo và requester ở đây
                                        if (notification.notification_type === 'acceptedFriend') {
                                            formAddFriend += '<div class ="model-notifications';
                                            if(notification.see === 'checknt'){
                                                formAddFriend+=' active d-flex">' ; 
                                            }
                                            else{
                                                formAddFriend+=' d-flex">' ; 
                                            }
                                            formAddFriend+='<div class="avatar">';
                                            if (requester.avatar !== null ) {
                                                formAddFriend += '<a href="'+ '{{ url("profile/") }}'+'/' +  requesterId +'"><li><img src="' + '{{ asset("storage/users_avatar/") }}' + '/' + requester.avatar + '" alt="Avatar"></a>';
                                            } else {
                                                formAddFriend += '<a href="'+ '{{ url("profile/") }}'+'/' +   requesterId +'"><li><img src="{{ asset("storage/users_avatar/guest-user-250x250.jpg") }}" alt="Avatar"></a>';
                                            }
                                            formAddFriend += '</div>'+
                                                    '<div class="icon">'+
                                                        '<i class="bx bxs-user"></i>'+
                                                    '</div>'+
                                                    '<div class="content">'+
                                                        '<div class="title"><span class="user-name">'+ requester.first_name + ' ' + requester.last_name +'</span> '+ notification.content +'</div>'+
                                                        '<div class="time">'+ moment(notification.created_at).fromNow() +'</div>'+
                                                    '</div>'+
                                                    '<div class ="status" style ="';
                                            if(notification.see !== 'checknt'){ 
                                                formAddFriend += 'display:none;">';
                                                
                                            }
                                            else{
                                                formAddFriend += 'display:block;">';
                                            }
                                                        formAddFriend +='<div><i class="bx bxs-circle"></i></div>'+
                                                    '</div>'+

                                                '</div>';
                                        } else if (notification.notification_type === 'addFriend') {
                                            // Xử lý các trường hợp khác
                                        } else {
                                            // Xử lý các trường hợp khác
                                        }
                                        
                                    }
                                    
                                }
                            }
                            $('.addFriend').append(formAddFriend);
                            $('.form-notifications').append(form);
                        }
                    })
                });

                $(document).click(function(event) {
                    if (!$(event.target).closest('#dropdown-notifications').length && !$(event.target).is('#notifications')) {
                        $('#dropdown-notifications').hide();
                    }
                });
            });
        </script>
        <script >
          const informations = document.getElementById('informations');
    const dropdownUser = document.querySelector('.dropdown-user');
    
    informations.addEventListener('click', function() {
      if (dropdownUser.style.display === 'none' || dropdownUser.style.display === '') {
        dropdownUser.style.display = 'block';
      } else {
        dropdownUser.style.display = 'none';
      }
    });
    document.addEventListener('click', function(event) {
      const isClickedInsideInformations = informations.contains(event.target);
      const isClickedInsideDropdownUser = dropdownUser.contains(event.target);
      if (!isClickedInsideInformations && !isClickedInsideDropdownUser) {
        dropdownUser.style.display = 'none';
      }
    });
        </script>


        {{-- <script>

          $(document).ready(function() {
            // Lắng nghe sự kiện click trên các thẻ li trong div.sub-menu
            $('div.sub-menu li').click(function() {
              // Xóa lớp active trên tất cả các thẻ li trong div.sub-menu
              $('div.sub-menu li').removeClass('active');
              // Thêm lớp active vào thẻ li được click
              $(this).addClass('active');
            });
          });
        </script> --}}
        <script>
          let menuItems = document.querySelectorAll('.tab-item');
          let subMenuItems = document.querySelectorAll('.trans-content');
          
          menuItems.forEach((menuItem, index) => {
            const pane = subMenuItems[index];
            menuItem.onclick = function() {
              const activeTabItem = document.querySelector('.tab-item.active');
              const activePane = document.querySelector('.trans-content.active');
              
              if (activeTabItem) {
                activeTabItem.classList.remove('active');
              }
              if (activePane) {
                activePane.classList.remove('active');
              }
              
              menuItem.classList.add('active');
              pane.classList.add('active');
            };
          });
        </script>
        <script>
          let itemInfo = document.querySelectorAll('.item-info');
          let subMenuInfo = document.querySelectorAll('.menu-info');
          
          itemInfo.forEach((itemInfo, index) => {
            const pane = subMenuInfo[index];
            itemInfo.onclick = function() {
              const activeTabItem = document.querySelector('.item-info.active');
              const activePane = document.querySelector('.menu-info.active');
              
              if (activeTabItem) {
                activeTabItem.classList.remove('active');
              }
              if (activePane) {
                activePane.classList.remove('active');
              }
              
              itemInfo.classList.add('active');
              pane.classList.add('active');
            };
          });
        </script>
        <script>
          $(document).ready(function(){
            $('.bigo-edit-btn').on('click', function(e) {
              $('.form-edit').css('display', 'block');
              $('.bigo-form').css('display', 'none');
            });

            $('.save').on('click',function(e){
              $('.form-edit').css('display', 'none');
              $('.bigo-form').css('display', 'block');
            })

            $('.destroy-bigo').on('click',function(e){
              $('.form-edit').css('display', 'none');
              $('.bigo-form').css('display', 'block');
            })
            // address
            $('#address-user').on('click',function(){
              $('.edit-address-user').css('display','block');
              $('#address-user').css('display','none');
            })
            $('.cansole-address').on('click',function(){
              $('.edit-address-user').css('display','none');
              $('#address-user').css('display','block');
            })
            $('.save-address').on('click',function(){
              $('.edit-address-user').css('display','none');
              $('#address-user').css('display','block');
            })
          });

          
        </script>
        <script>
          $(document).ready(function(){
            $('.save').on('click',function(e){
              var userId = $(this).data('user-id');
              var newBigo = $('#newBigo').val();
              console.log(userId,newBigo);
              $.ajax({
                url: '/bigo',
                type:'POST',
                data:{
                  user_id : userId,
                  new_bigo: newBigo,
                  '_token': '{{ csrf_token() }}',
                },
                
                dataType: 'json',
                success: function(response) {
                    // Cập nhật dữ liệu trên giao diện
                    $('#bigo').text(response.bigo);
                    
                },
                error: function(response) {
                  alert('Đã xảy ra lỗi: ' + response.responseText);
                },
              })
            })
          })
        </script>
        {{-- address --}}
        <script>
          $(document).ready(function(){
            $('.save-address').on('click',function(){
              var userId = $(this).data('user-id');
              var newdata = $('#new-address').val();
              
              $.ajax({
                url:'/address',
                type:'POST',
                data:{
                  user_id:userId,
                  new_data:newdata,
                  '_token':'{{ csrf_token() }}',
                },
                dataType: 'json',
                success: function(response){
                  $('#address').text(response.address);
                },
                error: function(response){
                  alert('Đã xảy ra lỗi: ' + response.responseText);
                },
              })
            })
          })
        </script>
        <script>
          $(document).ready(function(){
            $('.btn-menu-avatar').on('click',function(){
             $('#modal-add-avatar').css('display','block');
            })
            $('.btn-close').on('click',function(){
              $('#modal-add-avatar').css('display','none');
            })
          })
        </script>
        @if($user->id == $userS->id)
        <script>
          const btnAddAvatar = document.querySelector('.btn-add-avatar');
          const fileInputAvatar = document.querySelector('#file-input-avatar');

          btnAddAvatar.addEventListener('click', function() {
            fileInputAvatar.click();
          });

          fileInputAvatar.addEventListener('change', function() {
            const files = this.files;
            for (let i = 0; i < files.length; i++) {
              const file = files[i];
              const img = document.createElement("img");
              img.file = file;
              img.classList.add("uploaded-image");
              btnAddAvatar.parentNode.insertBefore(img, btnAddAvatar);
              
              const reader = new FileReader();
              reader.onload = (function(aImg) { 
                return function(e) { 
                  aImg.src = e.target.result; 
                }; 
              })(img);
              reader.readAsDataURL(file);
            }
          });
        </script>
        @endif
        <script>
          $(document).ready(function(){
            $('#avatar-btn-menu').on('click', function() {
              if ($('#avatar-dropdown').is(':visible')) {
                $('#avatar-dropdown').hide();
              } else {
                $('#avatar-dropdown').show();
              }
            });
          });
        </script>
        <script>
        // $(document).ready(function(){
        //   $('#btn-interest').on('click',function(){
            
        //   })
        // })
        </script>
        <script>
          
          $('.add-friends').on('click', function(e) {
            var userId = $(this).data('user-id');
            var friendShip = $(this).data('friendship-id');
            

            $.ajax({
              url: '/send-friend-request',
              type: 'POST',
              data: {
                user_id: userId,
                type: 'pending',
                '_token': '{{ csrf_token() }}',
              },
              success: function(response) {
                if(response.statusbtn==='friendPending'){
                  $('#nav-item-margin').css('margin-top','150px');
                  $('#friend-pending').css('display','block');
                  $('#add-friends').css('display','none');
                      
                }
              },
              error: function(response) {
                console.log('loi');
              },
            });
          });
        
        </script>
        <script>
          
            var userId = $('.add-friends').data('checkfriendship-id');
            var friendship = $('.add-friends').data('friendship-id');
            
            $.ajax({
              url:'/check',
              type:'GET',
              data:{
                user_id:userId,
                type:'check',
                '_token': '{{ csrf_token() }}',
              },
              success:function(response){
                  console.log(response);
                  if(response.statusbtn==="friendAccepted"){
                    $('#friend-accepted').css('display','block');
                    $('#add-friends').css('display','none');
                    $('.messenger-friend').addClass('accepted-trans-messenger');
                    $('#nav-item-margin').css('margin-top','150px');
                  }
                  else if(response.statusbtn==='friendPending'){
                      $('#friend-pending').css('display','block');
                      $('#add-friends').css('display','none');
                      $('#nav-item-margin').css('margin-top','150px');
                  }
                  else if(response.statusbtn==='nofriend'){
                    $('#add-friends').css('display','block');
                    $('#nav-item-margin').css('margin-top','150px');
                  }
                  
                 
            
              },
            })
            $.ajax({
              url:'/check',
              type:'GET',
              data:{
                user_id:userId,
                type: 'check',
                '_token': '{{ csrf_token() }}',
              },
              success:function(response){
                if(response.statushiddebtn){
                  $('#accepted-btn').css('display','block');
                  $('#add-friends').css('display','none');
                  $('.block-title-add-friend').css('display','block');
                  $('#nav-item-margin').css('margin-top','10px')
                }
                // else{
                //   $('#nav-item-margin').css('margin-top','150px');
                //   $('#friend-accepted').css('display','block');
                //   $('#add-friends').css('display','none');
                //   $('.messenger-friend').addClass('accepted-trans-messenger');
                // }
                 
            
              },
            })
          
        </script>
        <script>
          $(document).ready(function(){
            $('.btn-accepted').on('click',function(){
              var userId = $(this).data('user-id');
              var friendship =$(this).data('friendship-id');
              $.ajax({
                url:'/acceptedfriend',
                type:'POST',
                data:{
                  user_id:friendship,
                  type : 'accepteFriend',
                  '_token': '{{ csrf_token() }}',
                },
                success:function(response){
                  if(response.statusbtn==='friendAccepted'){
                    $('#friend-accepted').css('display','block');
                    $('#add-friends').css('display','none');
                    $('.messenger-friend').addClass('accepted-trans-messenger');
                    $('#accepted-btn').css('display','none');
                    $('.block-title-add-friend').css('display','none');
                    $('#nav-item-margin').css('margin-top','150px');
                  }
                }
              })
            })
            $('.btn-erase').on('click',function(){
              var userId = $(this).data('user-id');
              var friendship =$(this).data('friendship-id');
              $.ajax({
                url:'/unfriend',
                type:'POST',
                data:{
                  user_id:friendship,
                  type:'unfriend',
                  '_token': '{{ csrf_token() }}',
                },
                success:function(response){
                    if(response.statusbtn==='nofriend'){
                      $('#add-friends').css('display','block');
                      $('#accepted-btn').css('display','none');
                      $('.block-title-add-friend').css('display','none');
                      $('#nav-item-margin').css('margin-top','150px');
                    }
                },
              })
            })
            $('#friend-pending').on('click',function(){
              var userId = $(this).data('user-id');
              var friendship =$(this).data('friendships-id');
              console.log(userId,friendship);
              $.ajax({
                url:'/unpending',
                type:'POST',
                data:{
                  user_id:friendship,
                  type:'unpending',
                  '_token': '{{ csrf_token() }}',
                },
                success:function(response){
                    if(response.statusbtn === 'nofriend'){
                      $('#add-friends').css('display','block');
                      $('#friend-pending').css('display','none');
                      $('#nav-item-margin').css('margin-top','150px');
                    }
                },
              })
            })
            $('.dropdown-friend-accepted').on('click',function(){
              var userId = $(this).data('user-id');
              var friendShip =$(this).data('friendship-id');
              $.ajax({
                url:'/unfriend',
                type:'POST',
                data:{
                  user_id:friendShip,
                  type:'unfriend',
                  '_token':'{{ csrf_token() }}',
                  
                },
                success:function(response){
                  if(response.statusbtn==='nofriend'){
                    $('#nav-item-margin').css('margin-top','150px');
                    $('#friend-accepted').css('display','none');
                    $('.dropdown-friend-accepted').css('display','none');
                    $('#add-friends').css('display','block');
                  }
                },
              })
            })
          })
        </script>
        
</body>
</html>