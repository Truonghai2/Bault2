@if (!Auth::check())
   
<script>window.location = "{{ route('login') }}";</script>
@else
    @php
        $user = Auth::user();
    @endphp
<!DOCTYPE html>
{{-- {{ str_replace('_', '-', app()->getLocale()) }} --}}
<html lang="vi">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="id" content="0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="url" content="{{ url('').'/'.config('chatify.routes.prefix') }}" data-user="{{ Auth::user()->id }}">
        <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="icon" href="{{ asset('img/new_logo.png') }}" type = "image/x-icon">
        <title>Bault</title>
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
    </head>
    
    <body >
        
        {{-- <div id="load">
            <div>G</div>
            <div>N</div>
            <div>I</div>
            <div>D</div>
            <div>A</div>
            <div>O</div>
            <div>L</div>
        </div> --}}
        <script>
            window.addEventListener('load');
        </script>
        <div id="wapper ">
            
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
                                    <div class="messenger-nofriend item position-relative">
                                        <span>Người lạ</span>
                                        <div class="dot position-absolute top-0" style="background-color: #2d88ff;">

                                        </div>
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
            
            <main>
                <div class="main-left">
                    <div class="user">
                        <div class="account-user d-flex ">
                        
                                <div class="avatar">
                                    @if(!empty($user->avatar))
                                        <a href=" {{ route('profile', ['id' => $user->id]) }}"><li><img src="{{ asset('storage/users_avatar/'.$user->avatar) }}"></li></a>
                                    @else
                                        <a href=" {{  route('profile', ['id' => $user->id])}}"><li><img class="avatar" src="{{ asset('storage/users_avatar/guest-user-250x250.jpg') }}"></li></a>
                                    @endif
                                </div>
                                <div class="name-user">
                                    <a href=" {{ route('profile', ['id' => $user->id]) }}"><li>{{ $user->first_name }} {{ $user->last_name }}</li></a>
                                </div>
                           
                        </div>
                        <div class="friends-user item-menu">
                            <li><i class='bx bxs-user item1' ></i><i class='bx bxs-user item2' ></i></i></li>
                            <div class="title item">
                                
                                    <a href="friends"><li>Bạn bè</li></a>
                                
                            </div>
                        </div>
                        <div class=" d-flex item-menu">
                            <a href="/look-around" title="Tìm xung quanh bạn"><li><i class='bx bxs-location-plus' ></i></li></a>
                            <div class="title item">
                                <a href="/look-around"><li>Tìm bạn quanh đây</li></a>
                            </div>
                        </div>
                        <div class="reset-index d-flex item-menu">
                            <a href="{{ url('/') }}">
                                <li><i class='bx bx-reset'></i></li>
                            </a>
                            <div class="title">
                                <a href="/">
                                    <li>Bài viết mới nhất</li>
                                </a>
                            </div>
                        </div>
                        <div class="henho_random d-flex item-menu">
                            <a href="{{ url('/random') }}">
                                <li><i class='bx bx-home-heart'></i></li>
                            </a>
                            <div class="title">
                                <a href="{{ url('/random') }}">
                                    <li>Ghép ngẫu nhiên với người lạ</li>
                                </a>
                            </div>
                        </div>
                        <div class="voice_random d-flex item-menu">
                            <a href="">
                                <li><i class='bx bxs-phone'></i></li>
                            </a>
                            <div class="title">
                                <a href="">
                                    <li>Voice ngẫu nhiên với người lạ</li>
                                </a>
                            </div>
                        </div>
                        <div class="video_call_random d-flex item-menu">
                            <a href="">
                                <li><i class='bx bxs-video' ></i></li>
                            </a>
                            <div class="title">
                                <a href="{{ url('/CallRandom') }}">
                                    <li>Video call ngầu nhiên với người lạ</li>
                                </a>
                            </div>
                        </div>
                        <div class="item-menu d-flex">
                            <a href="">
                                <li><i class='bx bxs-heart-circle' ></i></li>
                            </a>
                            <div class="title">
                                <a href="{{ url('dating') }}">
                                    <li>Hẹn hò</li>
                                </a>
                            </div>
                        </div>
                        <div class="item-menu d-flex">
                            <a href="">
                                <li><i class='bx bxl-messenger'></i></li>
                            </a>
                            <div class="title">
                                <a href="{{ url('messenger') }}">
                                    <li>Messeger</li>
                                </a>
                            </div>
                        </div>
                    </div>
    
                </div>
                <div class="main-mid">
                    
    
                    <div class="status">
                        <div class="status-top item">
                            <div class="avatar d-flex">
                              
                                   
                                            
                                                @if(!empty($user->avatar))
                                                    <a href="{{  route('profile', ['id' => $user->id]) }} ">
                                                        <img src=" {{ asset('storage/users_avatar/' . $user->avatar)  }}">
                                                    </a>
                                                @else
                                                    <a href="{{  route('profile', ['id' => $user->id]) }} ">
                                                        <img class="avatar" src="{{ asset('storage/users_avatar/guest-user-250x250.jpg') }}">
                                                    </a>
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
                    
                    <div class="post-status">
                    
                        <div class="container">
                                <!-- The Modal -->
                            <div id="myModal" class="modal">
    
                            <!-- Modal content -->
    
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3>Tạo bài viết</h3>
                                        <span class="close">x</span>
                                    </div>
                                    <div class="modal-main">
                                        <div class="modal-user">
                                            <div class="avatar-user d-flex">
                                               
                                                  
                                                            
                                                                @if(!empty($user->avatar))
                                                                    <a href="{{  route('profile', ['id' => $user->id]) }} ">
                                                                        <img src="{{asset('storage/users_avatar/' . $user->avatar) }}">
                                                                    </a>
                                                                @else
                                                                    <a href="{{ route('profile', ['id' => $user->id]) }} ">
                                                                        <img class="avatar" src="{{ asset('storage/users_avatar/guest-user-250x250.jpg') }}">
                                                                    </a>
                                                                @endif
                                                            
                                                            <div class="name-user">
                                                                <a href="{{  route('profile', ['id' => $user->id]) }}">
                                                                    <li>{{ $user->first_name }} {{ $user->last_name }}</li>
                                                                </a>
                                                            </div>
                                                     
                                                
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    

                                   
                                        <form action="{{ route('post_title') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-main input-text-status">
                                                <textarea name="title" class="form-control" aria-label="With textarea" placeholder="Bạn hãy viết gì đó đi..."></textarea>
                                            </div>
                                            <div id="image-preview"></div>
                                            <div class="modal-main post-img" id="post-images-id">
                                                <div class="modal-content">
                                                    <div class="close-smo" id="smof"><li>x</li></div>
                                                    <div class="add-images">
                                                        <div class="icon">
                                                            <label for="image-upload">
                                                                <i class="bx bxs-add-to-queue"></i>
                                                            </label>
                                                        </div>
                                                        <div class="text">
                                                            <h6>Thêm Ảnh/Video</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="file" id="file-input" name="image[]" multiple style="display: none;">
                                            <div class="modal-footer">
                                                <div class="footer-left">
                                                    <p>Thêm vào bài viết của bạn</p>
                                                </div>
                                                <div class="footer-right d-flex">
                                                    <div class="item">
                                                        <i class="bx bxl-instagram-alt" id="modal-conclick"></i>
                                                    </div>
                                                    <div class="item">
                                                        <i class="bx bxs-location-plus"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <footer class="footer-modal">
                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                <button class="post" type="submit" name="post_submit">Đăng</button>
                                            </footer>
                                            <input type="hidden" name="client_time" id="client-time" value="">
                                        </form>
                                    
                                    <script>
                                        
                                        // lấy giờ 
                                        
    
                                        // modal-status
                                        window.addEventListener('DOMContentLoaded', function() {
                                        const addImagesButton = document.querySelector('.add-images');
                                        const fileInput = document.querySelector('#file-input');
                                        const imagePreview = document.querySelector('#image-preview');
                                        const deleteButton = document.createElement('button');
                                        deleteButton.textContent = 'Xóa';
    
                                        let numImages = 0; // số lượng ảnh đang hiển thị
    
                                        addImagesButton.addEventListener('click', function() {
                                            fileInput.click();
                                        });
    
                                        fileInput.addEventListener('change', function() {
                                            const files = fileInput.files;
    
                                            for (let i = 0; i < files.length; i++) {
                                            if (files[i].type.startsWith('image/') || files[i].type.startsWith('video/')) {
                                                const mediaElement = files[i].type.startsWith('image/') ? document.createElement('img') : document.createElement('video');
                                                mediaElement.setAttribute('controls', true);
                                                mediaElement.style.Height = 'auto';
                                                mediaElement.style.width = '100%';
                                                mediaElement.style.objectFit = 'cover';
                                                mediaElement.src = URL.createObjectURL(files[i]);
                                                imagePreview.appendChild(mediaElement);
                                                numImages++;
                                            }
                                            }
                                                                            
                                            // nếu có ảnh thì hiển thị nút xóa
                                            if (numImages > 0) {
                                            imagePreview.appendChild(deleteButton);
                                            }
                                        });
    
                                        deleteButton.addEventListener('click', function() {
                                            while (imagePreview.firstChild) {
                                            imagePreview.removeChild(imagePreview.firstChild);
                                            }
                                            numImages = 0;
                                                                            
                                            // kiểm tra xem có bao nhiêu ảnh đang hiển thị
                                            if (numImages === 0) {
                                            deleteButton.style.display = 'none'; // ẩn nút xóa
                                            }
                                        });
                                        });
                                        </script>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- render post --}}

                   
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
                                    <a href="{{ route('profile',['id'=>$posts->Creator_ID]) }}" class=" d-flex"><li>{{ $posts->user->first_name }} {{ $posts->user->last_name }}</li>@if($posts->type_post ==='avatar')<span style="margin-left: 5px;">đã cập nhật ảnh đại diện của @if($posts->user->gender==='male') anh @else cô @endif ấy.</span>@endif</a> 
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
                            
                            
                            @if ($posts->type_post ==='post')
                                @isset ($postImages[$posts->ID])
                                    <img src="{{ asset('img/upload/'.$postImages[$posts->ID]) }}" alt="">
                                @endisset
                            @elseif($posts->type_post==='avatar')
                                <div class="content-post-img-avatar position-relative" style="height: 412px; margin-top:15px;">
                                    <div class="img-background-user">
                                        @isset($posts->user->img_bg)
                                            <div class="img_bg_user" style="background-image: url({{ asset('storage/img_background/'.$posts->user->img_bg) }})"></div>
                                            
                                        @else
                                        <div class="img_bg_user" style="background-image: url({{ asset('img/test_bg.jpg') }})"></div>

                                        @endisset
                                    </div>
                                    <div class="avatar-post-img position-absolute"style="
                                    background-color: #d0d0d0;
                                    padding: 10px;
                                    border-radius: 50%;
                                    top: 20px;
                                    left: 50%;
                                    transform: translateX(-50%);
                                " >
                                        <img style="width: 330px; border-radius:50%; margin:0;" src="{{ asset('storage/users_avatar/'.$postImages[$posts->ID]) }}" alt="">
                                    </div>
                                </div>
                            @endif
                                                
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
                                                        <img width="23px" src="{{ asset('img/like.png') }}" alt="">
                                                        <div class="title">Thích</div>
                                                        
                                                    </button>
                                                </form>
                                            
                                                <form id="unlike-form" action="{{ route('post.unlike') }}" method="POST" style="display:none">
                                                    @csrf
                                                    <input type="hidden" name="post_id" value="{{ $posts->ID }}">
                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                    <button type="submit" class="btn unlike-btn d-flex">
                                                        <img width="30px" src="{{ asset('img/liked.png') }}" alt="">
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
                       

                        @if(($key === 2 || count($post) < 2) && count($userSuggest) > 0 )

                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                                <img class="d-block w-100" src="..." alt="First slide">
                              </div>
                              <div class="carousel-item">
                                <img class="d-block w-100" src="..." alt="Second slide">
                              </div>
                              <div class="carousel-item">
                                <img class="d-block w-100" src="..." alt="Third slide">
                              </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="sr-only">Next</span>
                            </a>
                          </div>
                        @endif
                        
                    @empty
                        <h4 class="post-null">Hiện không có bài viết nào!</h4>
                    @endforelse
                
                            
                </div>
                @livewire('friendship')
            </main>

            
            <script>
                

                $('.btn-like-comment').click(function(){
                    var postID = $(this).data('post-id');
                    var cmtID = $(this).data('cmt-id');
                    
                    $.ajax({
                        url:'like-cmt',
                        method: 'POST',
                        data:{
                            post_id: postID,
                            cmt_id: cmtID,
                            '_token': '{{ csrf_token() }}'
                        },
                        success:function(response){
                            if(response.check === true){
                                $('.btn-like-comment[data-cmt-id='+cmtID+']').addClass('liked')
                            }
                            else{
                                $('.btn-like-comment[data-cmt-id='+cmtID+']').removeClass('liked')
                            }

                            if(response.cntLike > 0){
                                $('.cnt-like-cmt[data-cmt-id='+cmtID+']').removeClass('d-none');
                                $('.cntLikes[data-cmt-id='+cmtID+']').html(response.cntLike);
                            }
                            else{
                                $('.cnt-like-cmt[data-cmt-id='+cmtID+']').addClass('d-none');
                                $('.cntLikes[data-cmt-id='+cmtID+']').html(response.cntLike);
                            }
                            $('.cntLikes[data-cmt-id='+cmtID+']').removeClass('d-none');
                        }
                    })
                })


                $(document).ready(function(){
                   
                    $.ajax({
                        url:'get-like-cmt',
                        method: 'GET',
                        data:{
                            '_token': '{{ csrf_token() }}'
                        },
                        success:function(response){
                            var likedComments = response.liked;
                            likedComments.forEach(function(comment) {
                                var commentId = comment.id;

                                // Check if there is a button for this comment and update UI accordingly
                                var $likeButton = $('.btn-like-comment[data-cmt-id=' + commentId + ']');
                                if ($likeButton.length > 0) {
                                    // Comment is liked, you can add a liked class or change text
                                    $likeButton.addClass('liked');
                                    
                                }
                                if(comment.like_count > 0){
                                    $('.cnt-like-cmt[data-cmt-id='+commentId+']').removeClass('d-none');
                                    $('.cnt-like-cmt[data-cmt-id='+commentId+'] .content-cnt .cntLikes').html(comment.like_count);
                                }

                                $('.cnt-like-cmt[data-cmt-id='+commentId+'] .content-cnt .cntLikes').removeClass('d-none');
                                
                            });
                        }
                    })


                    $('#comment-form').submit(function(event) {
                        event.preventDefault(); // Prevent the form from submitting normally.

                        // Get the form data.
                        var formData = $(this).serialize();
                        var url = $(this).attr('action');

                        // Send the AJAX request.
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: formData,
                            dataType: 'json', // Expect JSON response.
                            success: function(response) {
                                // Handle the response from the server.
                                if (response.success) {
                                    $('.render-comment').append(response.html)
                                    // If successful, clear the form and update the comments section as needed.
                                    $('#target-comment-' + response.post_id).val(''); // Clear the comment input.
                                    // You can update the comments section here if needed.
                                }
                            },
                            error: function(xhr, status, error) {
                                // Handle any errors that occur during the request.
                                console.error(xhr.responseText);
                            }
                        });
                    });
                    
                 

                })
                $('.btn-relay').click(function(){
                    var cmtID = $(this).data('cmt-id');
                    var postID = $(this).data('post-id');
                    var userID = $(this).data('user-id');
                    $('.form-relay-cmt-'+cmtID+'').removeClass('d-none');
                    var nameuser = $(this).data('user-name');
                    // alert(userID);
                    $('.reply-cmt-'+cmtID+' input[name="reply-cmt-user-id"]').val(userID);
                    $('.reply-cmt-'+cmtID+' input[name="cmt-id-reply"]').val(cmtID);
                    $('.reply-cmt-'+cmtID+' input[name="post-id-reply"]').val(postID);
                    // var relayName = '<span class="name-relay">'+nameuser+' '+'</span>'
                    $('.input-relay-comment-'+cmtID+' .title-reply-comment .name-user-reply').html(nameuser);
                    // Lấy phần tử .input-relay-comment-{{ $comments['id'] }} bằng lớp
                    var inputRelayComment = document.querySelector('.input-relay-comment-'+cmtID+'');

                    // Lấy phần tử .focus bên trong .input-relay-comment
                    var focusElement = inputRelayComment.querySelector('.focus');
                    // focusElement.focus();
                    // Đặt nội dung của phần tử .focus
                    focusElement.innerHTML = '&nbsp;';
                    focusElement.focus();

                    
                })
                
                // Lấy phần tử có thuộc tính contentEditable

                $('.submit-reply-comment').click(function(){
                    var cmtID = $(this).data('cmt-id');
                    // alert(cmtID);
                    reply(cmtID);
                })
                
                function reply(cmtID) {
                    const userID = $('.reply-cmt-'+cmtID+' input[name="reply-cmt-user-id"]').val();
                    const postID = $('.reply-cmt-'+cmtID+' input[name="post-id-reply"]').val();
                    const content = $('.input-relay-comment-'+cmtID+' .title-reply-comment .focus').text();
                    // alert(userID + ', ' + cmtID + ', ' + postID);

                    $.ajax({
                        url: "{{ route('reply-comment') }}",
                        method: 'POST',
                        data: {
                            user_id: userID,
                            post_id: postID,
                            cmt_id: cmtID,
                            content: content,
                            '_token': '{{ csrf_token() }}'
                        },
                        success: (response) => {
                            $('.render-reply-comment[data-cmt-id='+response.cmtID+']').append(response.html);
                            var inputRelayComment = document.querySelector('.input-relay-comment-'+cmtID+'');

                            // Lấy phần tử .focus bên trong .input-relay-comment
                            var focusElement = inputRelayComment.querySelector('.focus');
                            // focusElement.focus();
                            // Đặt nội dung của phần tử .focus
                            focusElement.innerHTML = '&nbsp;';

                            $(".name-user-reply").html('');
                        },
                        error: (xhr, status, error) => {
                            // Handle AJAX errors here if needed
                        }
                    });
                }



                
            </script>
            <script>

                $('.main-img img').click(function(){
                    var postId = $('.main-img').data('post-id');
                    var userID = $('main-img').data('user-post-id');
                    $.ajax({
                        url:'Post',
                        method: 'GET',
                        data:{
                            post_id : postId,
                            user_id : userID,
                            '_token':'{{ csrf_token() }}',
                        },
                        success:function(response){

                        }
                    })
                })
            </script>
        </div>
        <div class="row-list-layout">
            <div class="layout messenger-layout messenger-messagingView d-none" data-messenger-id="1">
                <div class="layout-content">
                    <div class="layout-header d-flex">
                        <div class="user d-flex">
                            <div class="avatar" id ="layout-avatar-user">
                                <img src="http://127.0.0.1:8082/storage/users_avatar/320518049_516078647157927_7794997058474116629_n.jpg" alt=""> 
                            </div>
                            <div class="username" id="layout-name-user"><h6>Trương Tuấn Hải</h6>
                                <div class="status-active">
                                    <span class="status-active-render d-flex">
                                        <i class="bx bxs-circle"></i>
                                        <div class="title">Không hoạt động</div>
                                    </span>    
                                </div> 
                            </div>
                            <div class="menu-drow"> 
                                <i class="bx bx-chevron-down"></i>
                                </div>
                            </div>
                            <div class="menu-btn d-flex">
                                <div class="btn-call">
                                    <i class="bx bxs-phone"></i>
                                </div>
                                <div class="btn-video">
                                    <i class="bx bxs-video"></i>
                                </div>
                                <div class="btn-hidde " >
                                    <i class="bx bx-minus" ></i>
                                </div>
                                <div class="btn-close close-layout-messenger" onclick="closeLayout()" data-messenger-id="1"></div>
                            </div>
                            {{-- <div class="internet-connection">
                                <span class="ic-connecting">Đang kết nối...</span>
                                <span class="ic-noInternet">Không có kết nối mạng</span>
                            </div> --}}
                        </div>

                        <div class="layout-main m-body messages-container app-scroll">
                            <div class="messages"></div>
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
                        
                        
                                <div class="messenger-sendCard d-flex">
                                    <form id="message-form" class="d-flex" method="POST" action="{{ route('send.message') }}" enctype="multipart/form-data">
                                        @csrf
                                        <label><span class="fas fa-plus-circle"></span><input disabled='disabled' type="file" class="upload-attachment d-none" name="file" accept=".{{implode(', .',config('chatify.attachments.allowed_images'))}}, .{{implode(', .',config('chatify.attachments.allowed_files'))}}" /></label>
                                        <button class="emoji-button"></span><span class="fas fa-smile"></button>
                                        <textarea readonly='readonly' name="message" class="m-send app-scroll" autocomplete="off" placeholder="Tin nhắn " style="background-color: #d0d0d0;
                                        border-radius: 20px;"></textarea>
                                        
                                        <button disabled='disabled' class="send-button"><span class="fas fa-paper-plane"></span></button>
                                    </form>
                                </div> 
                                                              
                            
                        
                    </div>
                </div>
        </div>
        <div class="list-messenger-hidden"></div> 
    
       
        
    </div>
    

    <script>

        
    </script>
<script>
     // message form on submit.
    $("#message-form").on("submit", (e) => {
        e.preventDefault();
        sendMessage();
    });

    // message input on keyup [Enter to send, Enter+Shift for new line]
    $("#message-form .m-send").on("keyup", (e) => {
        // if enter key pressed.
        if (e.which == 13 || e.keyCode == 13) {
            // if shift + enter key pressed, do nothing (new line).
            // if only enter key pressed, send message.
            if (!e.shiftKey) {
            triggered = isTyping(false);
                sendMessage();
            }
        }
    });
    
   

</script>
        
        
        <script src="../js/check-in.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script>
            
        
           
            function closeLayout() {
               
                localStorage.removeItem('messengerId');
                
              
                $('.layout').addClass('d-none');
            }
            $('.bx-minus').click(function(){
                var id = $('meta[name=id]').attr('content');
                localStorage.removeItem('messengerId');
                $('.layout').addClass('d-none');
                
                var storedIds = JSON.parse(localStorage.getItem('storedIds')) || [];
                var index = storedIds.indexOf(id);

                // Nếu tìm thấy id trong mảng, thì loại bỏ nó
                if (index !== -1) {
                    storedIds.splice(index, 1);
                }
                // Kiểm tra xem mảng storedIds đã đủ 3 phần tử chưa
                if (storedIds.length >= 4) {
                    // Nếu đ 2Aã đủ 3 phần tử, loại bỏ phần tử đầu tiên
                    storedIds.shift();
                }

                // Thêm id mới vào mảng
                storedIds.push(id);

                // Lưu lại danh sách ID đã thay đổi vào localStorage
                localStorage.setItem('storedIds', JSON.stringify(storedIds));
                updateItemMessenger();
            });


            function updateItemMessenger() {
                var storedIds = JSON.parse(localStorage.getItem('storedIds')) || [];
                $('.list-messenger-hidden').empty();
                if(storedIds.length > 0){
                    storedIds.forEach(function(id) {
                        $.ajax({
                            url: 'get_user', // Ensure the correct URL for your Laravel route
                            method: 'GET',
                            data: {
                                id: id,
                            },
                            success: function(response) {
                                
                                var avatar = '';
                                if (response.user.avatar === null) {
                                    avatar = 'guest-user-250x250.jpg';
                                } else {
                                    avatar = response.user.avatar;
                                }
                                var html = `
                                    <div class="layout-hiddenMessenger" data-id="${response.user.id}" >
                                        <div class="newMessenger d-none">
                                            <i class='bx bxs-circle'></i>
                                        </div>
                                        <div class="btn-close close-hidden-messenger" data-id="${response.user.id}" onclick ="closehidden(${response.user.id})"></div>
                                        <div class="avatar">
                                            <img src="{{ asset('storage/users_avatar/') }}/${avatar}" alt="User Avatar" onclick ="layoutOppen(${response.user.id})" />
                                        </div>
                                    </div>
                                `;
                                $('.list-messenger-hidden').append(html);
                            },
                        });
                    });
                }
            }
        function closehidden(id){
            var storedIds = JSON.parse(localStorage.getItem('storedIds')) || [];
            var index = storedIds.indexOf(id);

            // Nếu tìm thấy id trong mảng, thì loại bỏ nó
            if (index !== -1) {
                storedIds.splice(index, 1);
            }
            alert('ok   ')
            // Lưu lại danh sách ID đã thay đổi vào localStorage
            localStorage.setItem('storedIds', JSON.stringify(storedIds));
            updateItemMessenger();
        }

           updateItemMessenger();
        function layoutOppen(id){
            setMessengerId(id);
            const newId = $('meta[name=id]').attr('content');

            var storedIds = JSON.parse(localStorage.getItem('storedIds')) || [];
            var index = storedIds.indexOf(newId);

            // Nếu tìm thấy id trong mảng, thì loại bỏ nó
            if (index !== -1) {
                storedIds.splice(index, 1);
            }

            // Lưu lại danh sách ID đã thay đổi vào localStorage
            localStorage.setItem('storedIds', JSON.stringify(storedIds));
            localStorage.setItem('messengerId', id);
    
            
            IDinfoMain(id);
            updateItemMessenger();
            EventInput()
            initializeScrollAction();
            hiddenIp(); 
            message_img();

        }
            
           
        </script>
        
        
        <script>

            var postImgid = document.getElementById("post-images-id");
            var instagramIcon = document.getElementById('modal-conclick');
            var closeSmo = document.getElementById("smof");
            
            instagramIcon.onclick= function() {
                postImgid.style.display="block";
            };
            
            closeSmo.onclick=function() {
                postImgid.style.display="none";
            };
        </script>
        <script>
            
            var modal = document.getElementById("myModal");
    
            // Get the button that opens the modal
            var btn = document.getElementById("status-input");
            var btn2 = document.getElementById("status-img");
            var btn3 = document.getElementById("status-check");
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];
            btn3.onclick = function(){
                modal.style.display ="block";
            }
            // When the user clicks on the button, open the modal
            btn2.onclick = function(){
                modal.style.display="block";
            }
            btn.onclick = function() {
            modal.style.display = "block";
            }
    
            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
            modal.style.display = "none";
            }
    
            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
            
        </script>
        
        <script>
            var spanMenus = document.querySelectorAll('#spanMenu-post');
            var dropdownPosts = document.querySelectorAll('#dropdown-post');
            

            for (var i = 0; i < spanMenus.length; i++) {
            (function(index) {
                var spanMenu = spanMenus[index];
                var dropdown = dropdownPosts[index];
                spanMenu.addEventListener('click', function(event) {
                event.stopPropagation(); // stop the event from bubbling up to the document
                dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
                });
                document.addEventListener('click', function() {
                dropdown.style.display = 'none';
                });
            })(i);
            }
        </script>
        
        
      
    
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('js/vi.js') }}"></script>
        
        
       
        {{-- like post --}}
        <script>
            $(document).ready(function() {
                // Lấy danh sách bài viết
                var $posts = $('.post');

                // Kiểm tra trạng thái nút Like/Unlike đã được lưu trong Local Storage chưa
                var likeStatuses = JSON.parse(localStorage.getItem('likeStatuses')) || {};
                $posts.each(function() {
                    var postId = $(this).data('post-id');
                    var likeStatus = likeStatuses[postId];

                    if (likeStatus === 'liked') {
                        $(this).find('#like-form').hide();
                        $(this).find('#unlike-form').show();
                    } else if (likeStatus === 'unliked') {
                        $(this).find('#like-form').show();
                        $(this).find('#unlike-form').hide();
                    }
                });

                $('.like-btn').click(function(e) {
                    e.preventDefault();
                    var $form = $(this).closest('form');
                    var $likeCount = $(this).closest('.post').find('#like-count');
                    var postId = $(this).closest('.post').data('post-id');
                    $.ajax({
                        type: 'POST',
                        url: $form.attr('action'),
                        data: $form.serialize(),
                        success: function(response) {
                            console.log(response);
                            if (response.success) {
                                // Cập nhật số lượng like trong giao diện
                                $likeCount.text(response.likes);

                                // Hiển thị nút Unlike và ẩn nút Like
                                $form.hide();
                                $form.siblings('#unlike-form').show();

                                // Lưu trạng thái nút Like/Unlike vào Local Storage
                                likeStatuses[postId] = 'liked';
                                localStorage.setItem('likeStatuses', JSON.stringify(likeStatuses));
                            }
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                });

                // Xử lý sự kiện click nút unlike
                $('.unlike-btn').click(function(e) {
                    e.preventDefault();
                    var $form = $(this).closest('form');
                    var $likeCount = $(this).closest('.post').find('#like-count');
                    var postId = $(this).closest('.post').data('post-id');
                    $.ajax({
                        type: 'POST',
                        url: $form.attr('action'),
                        data: $form.serialize(),
                        success: function(response) {
                            console.log(response);
                            if (response.success) {
                                // Cập nhật số lượng like trong giao diện
                                $likeCount.text(response.likes);

                                // Hiển thị nút Like và ẩn nút Unlike
                                $form.hide();
                                $form.siblings('#like-form').show();

                                // Lưu trạng thái nút Like/Unlike vào Local Storage
                                likeStatuses[postId] = 'unliked';
                                localStorage.setItem('likeStatuses', JSON.stringify(likeStatuses));
                            }
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                });
            });
        </script>
        
        {{-- chỉnh sửa  post--}}
        <script>
            $(document).ready(function() {
                $('#edit-post-form').on('submit', function(e) {
                    e.preventDefault();
                    var post_id = $('input[name="post_id"]').val();
                    var post_content = $('#post-content').val();
                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'POST',
                        data: {
                            post_id: post_id,
                            post_content: post_content,
                            _token: $('input[name="_token"]').val()
                        },
                        success: function(response) {
                            alert('Bài viết đã được cập nhật!');
                            window.location.href = '/';
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus + ': ' + errorThrown);
                        }
                    });
                });
            });
        </script>


        {{-- xóa bài viết --}}
        <script>
            $('.delete-post-btn').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('post-id');
                if (confirm('Bạn có chắc chắn muốn xóa bài viết này?')) {
                    $.ajax({
                        url: '/posts/' + id,
                        type: 'DELETE',
                        data: {
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            if (data.success) {
                                $('.post[data-post-id="' + id + '"]').remove();
                            }
                        },
                        error: function(xhr) {
                            alert('Đã xảy ra lỗi khi xóa bài viết!');
                        }
                    });
                }
            });
        </script>
     

        <script>
            moment.locale('vi');
            $(document).ready(function() {
                $('#notifications').on('click', function(event) {
                    event.stopPropagation(); // Prevent click event from propagating to document
                    $('#dropdown-notifications').toggle();

                    var userId = $('#notifications').data('user-id');
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
                            $('.before').empty();
                            var form = "";
                            var newForm = "";
                            var formAddFriend = "";
                            if (notifications === null) {
                                form += '<div class="null-notification">Hiện không có thông báo nào</div>';
                                
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
                                        } 
                                        else if(notification.notification_type === 'likepost'){
                                            
                                            form += '<div class ="model-notifications';
                                            if(notification.see === 'checknt'){
                                                form  +=' active d-flex">' ; 
                                            }
                                            else{
                                                form+=' d-flex">' ; 
                                            }
                                            form+='<div class="avatar">';
                                            if (requester.avatar !== null ) {
                                                form += '<a href="'+ '{{ url("profile/") }}'+'/' +  requesterId +'"><li><img src="' + '{{ asset("storage/users_avatar/") }}' + '/' + requester.avatar + '" alt="Avatar"></a>';
                                            } else {
                                                form += '<a href="'+ '{{ url("profile/") }}'+'/' +   requesterId +'"><li><img src="{{ asset("storage/users_avatar/guest-user-250x250.jpg") }}" alt="Avatar"></a>';
                                            }
                                            form += '</div>'+
                                                    '<div class="icon">'+
                                                        '<i class="bx bxs-like"></i>'+
                                                    '</div>'+
                                                    '<div class="content">'+
                                                        '<div class="title"><span class="user-name">'+ requester.first_name + ' ' + requester.last_name +'</span> '+ notification.content +'</div>'+
                                                        '<div class="time">'+ moment(notification.created_at).fromNow() +'</div>'+
                                                    '</div>'+
                                                    '<div class ="status" style ="';
                                            if(notification.see !== 'checknt'){ 
                                                form += 'display:none;">';
                                                
                                            }
                                            else{
                                                form += 'display:block;">';
                                            }
                                                        form +='<div><i class="bx bxs-circle"></i></div>'+
                                                    '</div>'+

                                                '</div>';
                                        }
                                        
                                    }
                                    
                                }
                            }
                            $('.addFriend').append(formAddFriend);
                            $('.before').append(form);
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
<?php $sendFormHtml = view('vendor.Chatify.layouts.sendForm')->render(); ?>
<script>
    var dropdownOpen = false; // Ban đầu cho phép cuộc gọi AJAX

    $('.bxl-messenger').click(function(){
        $('.message-dropdown').toggle();

        
        dropdownOpen = !dropdownOpen;
    });
    $('.messenger-friend').click(function(){
        $('.messenger-friend').addClass('active');
        $('.main-messenger-friend').addClass('active');
        $('.messenger-nofriend').removeClass('active');
        $('.main-messenger-nofriend').removeClass('active');
        $('.main-messenger-dating').removeClass('active');
        $('.messenger-dating').removeClass('active');
    })
    $('.messenger-nofriend').click(function(){
        $('.messenger-friend').removeClass('active');
        $('.main-messenger-friend').removeClass('active');
        $('.messenger-nofriend').addClass('active');
        $('.main-messenger-nofriend').addClass('active');
        $('.main-messenger-dating').removeClass('active');
        $('.messenger-dating').removeClass('active');
    })
    $('.messenger-dating').click(function(){
        $('.messenger-friend').removeClass('active');
        $('.main-messenger-friend').removeClass('active');
        $('.messenger-nofriend').removeClass('active');
        $('.main-messenger-nofriend').removeClass('active');
        $('.main-messenger-dating').addClass('active');
        $('.messenger-dating').addClass('active');
    })
    

    var sendMessageRoute = "{{ route('send.message') }}";
 
    
</script>
       <script src="https://js.pusher.com/7.2.0/pusher.min.js"></script>
       <script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@3.0.3/dist/index.min.js"></script>
       <script >
           // Gloabl Chatify variables from PHP to JS
           window.chatify = {
               name: "{{ config('chatify.name') }}",
               sounds: {!! json_encode(config('chatify.sounds')) !!},
               allowedImages: {!! json_encode(config('chatify.attachments.allowed_images')) !!},
               allowedFiles: {!! json_encode(config('chatify.attachments.allowed_files')) !!},
               maxUploadSize: {{ Chatify::getMaxUploadSize() }},
               pusher: {!! json_encode(config('chatify.pusher')) !!},
               pusherAuthEndpoint: '{{route("pusher.auth")}}'
           };
           window.chatify.allAllowedExtensions = chatify.allowedImages.concat(chatify.allowedFiles);
       </script>
       <script src="{{ asset('js/chatify/utils.js') }}"></script>
       <script src="{{ asset('js/chat.js') }}"></script>
       
       {{-- <script src="{{ asset('js/chatify/code.js') }}"></script> --}}
    </body>
</html>

@endif