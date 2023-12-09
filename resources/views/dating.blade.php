@php
    $id  = auth()->id();
    $user  = DB::table('user')->where('id',$id)->first();
    // $interest = DB::table('interest')->where('user_id',$id)->get();
    // $chuckedInterest = $interest->chunk(3);
    $dating = DB::table('dating')->where('user_id',$id)->first();
    // $work_decode = json_decode($dating->work);

    
@endphp

@if (!Auth::check())
<script>window.location = "{{ route('login') }}";</script>
@endif
<!DOCTYPE html>

<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hẹn hò | Bault</title>
    <link rel="stylesheet" href="{{ asset('css/notifications.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="{{ asset('img/new_logo.png') }}" type = "image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.css">
    <link rel="stylesheet" href="{{ asset('css/dating.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.css">

    {{-- <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script> --}}
</head>
<body class = "reload">
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
        <div class="header-menu">
            @if($user->ready_dating === 1)
            <div class="main-content-flex d-flex">
                <div class="header-user" >
                    <div class="content ">
                        <div class="user d-flex">
                            @isset($user->avatar)
                                <div class="avatar">
                                    <a href="{{ route('profile',['id'=>$id]) }}"> <img src="{{ asset('storage/users_avatar/'.$user->avatar ) }}" alt=""></a>
                                </div>
                            @else
                                <div class="avatar">
                                    <a href="{{ route('profile',['id'=>$id]) }}"><img src="{{ asset('storage/users_avatar/guest-user-250x250.jpg' ) }}" alt=""></a>
                                </div>
                            @endisset
                                <div class="name">
                                    <a href="{{ route('profile',['id'=>$id]) }}">{{ $user->first_name }} {{ $user->last_name }}</a>
                                </div>
                        </div>
                        <div class="navbar-menu d-flex">
                            <div class="item menu-user-item active">
                                <span>Chức năng</span>
                            </div>
                            <div class="item matching-user-like">
                                <span>Các tương hơp</span>
                            </div>
                        </div>
                        <div class="item-navbar1 active">
                            
                            <div class="filter d-flex container">
                                <i class='bx bx-filter-alt'></i>
                                <div class="title">
                                    <span>Lọc</span>
                                </div>
                            </div>
                            
                                
                                        <div class="edit-information container item d-flex" data-user-id="{{ $id }}">
                                            <i class='bx bxs-cog' ></i>
                                            <div class="title">
                                                <span>Chỉnh sửa thông tin</span>
                                            </div>
                                            
                                            
                                        </div>
                                        
                                        
                                        <div class="erase-status container item d-flex" data-user-id="{{ $id }}">
                                            <meta name="csrf-token" content="{{ csrf_token() }}">
                                            <i class='bx bxs-eraser' ></i>
                                            <div class="title">
                                                <span>Ngừng hẹn hò</span>
                                            </div>
                                        </div>
                                        <script>
                                            $(document).ready(function(){
                                                $('.erase-status').on('click',function(){
                                                    var userId = $(this).data('user-id');
                                                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                                                    $.ajax({
                                                        url: '/erase-status',
                                                        type: 'POST',
                                                        data: {
                                                            user_id: userId,
                                                            _token: csrfToken
                                                        },
                                                        success:function(response){
                                                            location.reload();
                                                        }
                                                    })
                                                })
                                            })
                                        </script>
                                    
                                <script>
                                    $(document).ready(function(){
                                        $('.bx-menu-alt-right').on('click', function(){
                                            $('#dropdown-edit-daing').toggle();
                                        });
    
                                        $(document).on('click', function(event){
                                            if (!$(event.target).is('.bx-menu-alt-right')) {
                                                $('#dropdown-edit-daing').hide();
                                            }
                                        });
                                    });
                                </script>
                            
                        </div>
                        <div class="item-navbar2">
                            <div class="content d-flex">
                                <div class="box-like-you" title="số người thích bạn">
                                    @isset($user->avatar)
                                    <div class="img-background" style="background-image: url('{{ asset('storage/users_avatar/'.$user->avatar ) }}');"></div>

                                    @else
                                    <div class="img-background" style="background-image: url('{{ asset('storage/users_avatar/guest-user-250x250.jpg') }}');"></div>

                                        
                                    @endisset
                                    <div class="box-cnt absolute bg-yellow d-flex">
                                        <div class="cnt-like-you"><span>0</span></div>
                                        <div class="heart"><i class='bx bxs-heart'></i></div>
                                    </div>
                                </div>
                                <div class="box-accepted" title="ghép thành công">
                                    @isset($user->avatar)
                                    <div class="img-background" style="background-image: url('{{ asset('storage/users_avatar/'.$user->avatar ) }}');"></div>

                                    @else
                                    <div class="img-background" style="background-image: url('{{ asset('storage/users_avatar/guest-user-250x250.jpg') }}');"></div>

                                        
                                    @endisset
                                    <div class="box-cnt absolute bg-yellow d-flex">
                                        <div class="cnt-accepted"><span>0</span></div>
                                        <div class="heart"><i class='bx bxs-heart'></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function(){
                        $('.menu-user-item').click(function(){
                            $('.menu-user-item').addClass('active');
                            $('.item-navbar1').addClass('active');
                            $('.matching-user-like').removeClass('active');
                            $('.item-navbar2').removeClass('active');
                        })
                        $('.matching-user-like').click(function(){
                            $('.matching-user-like').addClass('active');
                            $('.item-navbar2').addClass('active');
                            $('.menu-user-item').removeClass('active');
                            $('.item-navbar1').removeClass('active');
                            var user_id = {{ $id }};
                            $.ajax({
                                url: 'count-compatible',
                                type:"GET",
                                data: {
                                    user_id:user_id,
                                },
                                success:function(response){ 
                                    $('.cnt-like-you span').text(response);
                                },
                                error:function(){
                                    $('.cnt-like-you span').text(0);
                                }

                            })
                            $.ajax({
                                url:'count-compatible-accepted',
                                type:'GET',
                                data:{
                                    user_id:user_id,
                                },
                                success:function(response){
                                    $('.cnt-accepted span').text(response);
                                },
                                error:function(){
                                    $('.cnt-accepted span').text(response);
                                }
                            })
                        })
                    })
                </script>
                <div class="modal" id="modal-edit-information">
                    <div class="content">
                        
                            <div class="modal-header container d-flex">
                                <div class="title"><h4>Chỉnh sửa</h4></div>
                                <div class="btn-close" id="close-modal-edit-information"></div>
                            </div>
                            <div class="modal-main" id="content-main-modal-information">
                                <div class="content-header-main">
                                    <div class="img-bg">
                                        <img src="{{ asset('img/test_bg.jpg') }}" alt="">
                                        <div class="icon-edit-img ">
                                            <i class='bx bx-camera' title="Chỉnh sửa ảnh bìa" ></i>
                                        </div>
                                        <div class="dropdown" id="dropdow-edit-img-bg" style="display:none;x">
                                            <div class="container bg-white position-absolute ">
                                                <div class="menu-btn">
                                                    <div class="btn-see-image item d-flex">
                                                        <div class="icon"><i class='bx bxs-image-alt' ></i></div>
                                                        <div class="title">Xem ảnh bìa</div>
                                                    </div>
                                                    <div class="edit-image-bg item d-flex">
                                                        <div class="icon"><i class='bx bx-upload'></i></div>
                                                        <div class="title">Tải ảnh bìa lên</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        $('.icon-edit-img ').click(function(){
                                            // alert('ok');
                                            $('#dropdow-edit-img-bg').toggle();
                                        })
                                    
                                    </script>
                                    <div class="avt">
                                        @isset($user->avatar)
                                        <img src="{{ asset('storage/users_avatar/'.$user->avatar ) }}" alt="">
                                        @else
                                        <img src="{{ asset('storage/users_avatar/guest-user-250x250.jpg') }}">
                                        @endisset
                                        <div class="icon-camera"><i class='bx bx-camera' ></i></div>
                                    </div>
                                    <div class="dropdown " id="dropdown-avatar" style="display:none;">

                                        <div class="container content-dropdown-avt ">
                                            <div class="item see-avt d-flex align-items-center">
                                                <div class="icon"><i class="bx bxs-image-alt"></i></div>
                                                <div class="title"><span>Xem ảnh đại diện</span></div>
                                            </div>
                                            <div class="item update-avatar d-flex align-items-center">
                                                <div class="icon"><i class="bx bxs-user"></i></div>
                                                <div class="title"><span>Cập nhật ảnh đại diện</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="name">{{ $user->first_name }} {{ $user->last_name }}</div>
                                    <div class="bigo" data-user-id="{{ $id }}">
                                        @isset($user->bigo)
                                            {{ $user->bigo }}
                                            @else
                                            <li class="null">

                                                Thêm tiểu sử
                                            </li>
                                        @endisset
                                    </div>
                                    <div class="modal" id="modal-edit-bigo">
                                        <div class="content">
                                            <div class="modal-header">
                                                <div class="title"><h4>Chỉnh sửa tiểu sử</h4></div>
                                                <div class="btn-close"></div>
                                            </div>
                                            <div class="modal-main">
                                                <div class="input-bigo">
                                                    <input id="new-bigo" type="text" autocomplete="off"  value="{{ $user->bigo }}" placeholder="Nhập tiểu sử">
                                                </div>
                                            </div>
                                            <div class="modal-footer-edit d-flex">
                                                <div class="btn-erase">
                                                    Hủy
                                                </div>
                                                <div class="btn-save" id="save-bigo">
                                                    @csrf
                                                    Lưu
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <script>
                                        $(document).ready(function(){
                                            $('.bigo').on('click',function(){
                                                $('#modal-edit-bigo').css('display','block');
                                            })
                                            $('.btn-close').on('click',function(){
                                                $('#modal-edit-bigo').css('display','none');
                                            })
                                            $('.btn-erase').on('click',function(){
                                                $('#modal-edit-bigo').css('display','none');
                                            })
                                            $('#save-bigo').on('click',function(){
                                                var userId = $('.bigo').data('user-id');
                                                var values = $('#new-bigo').val();
                                                console.log(values);
                                                $.ajax({
                                                    url: '/bigo',
                                                    type:'POST',
                                                    data:{
                                                    user_id : userId,
                                                    new_bigo: values,
                                                    '_token': '{{ csrf_token() }}',
                                                    },
                                                    
                                                    dataType: 'json',
                                                    success: function(response) {
                                                        // Cập nhật dữ liệu trên giao diện
                                                        $('.bigo').text(response.bigo);
                                                        $('#modal-edit-bigo').css('display','none');
                                                    },
                                                    error: function(response) {
                                                        alert('Đã xảy ra lỗi: ' + response.responseText);
                                                    },
                                                })
                                            })
                                        })
                                    </script>
                                    
                                </div>
                                <div class="content-main-main ">
                                    <div class="information-user container">
                                        <div class="title">
                                            <h4>Chi tiết</h4>

                                        </div>
                                        <div class="information-render">
                                            <div class="lever  item-render " id="lever-user">
                                                <div class="user-lever d-flex">
                                                    @isset($user->lever)
                                                    <div class="d-flex lever-not-null">
                                                        <i class='bx bxs-graduation'></i>    

                                                        <li class="not_null">
                                                            Trình độ <span>{{ $user->lever }}</span>
                                                        </li>
                                                    </div>
                                                    <div class="btn-edit-lever "><i class='bx bxs-edit-alt'></i></div>
                                                
                                                    @else
                                                        
                                                        <li class="null" id="lever-null">
                                                            <i class='bx bx-add-to-queue'></i>
                                                            <span>Thêm trình độ học vấn</span>
                                                        </li>
                                                    @endisset
                                                </div>
                                                <div class="btn-edit"></div>
                                            </div>
                                            <div class="menu-lever-select" style="display:none;">
                                                
                                                <div class="selcet-lever" >
                                                    <input type="radio" id="lever-dh" name="lever" value="Đại học">
                                                    <label for="lever-dh">Đại học</label>
                                                    <input type="radio" id="lever-cd" name="lever" value="Cao đẳng">
                                                    <label for="lever-cd">Cao đẳng</label>
                                                    <input type="radio" id="lever-12" name="lever" value="12/12">
                                                    <label for="lever-12">12/12</label>
                                                    <input type="radio" id="lever-null" name="lever" value="">
                                                    <label for="lever-null">Không</label>
                                                    
                                                </div>
                                                <div class="footer d-flex">
                                                    <div class="bn-erase-lever" id="btn-erase-lever">Hủy</div>
                                                    <div  id="btn-save-lever" data-user-id="{{ $id }}"> @csrf Lưu</div>
                                                </div>
                                            </div>


                                            <script>
                                               $(document).ready(function(){
                                                    $('#lever-null').click(function(){
                                                        $('.menu-lever-select').css('display','block');
                                                        $('#lever-null').css('display','none');
                                                    });
                                                    $('.btn-edit-lever').click(function(){
                                                        $('.menu-lever-select').css('display','block');
                                                        $('#lever-user').css('display','none');
                                                    })
                                                    $('#btn-erase-lever').click(function(){
                                                        $('.menu-lever-select').css('display','none');
                                                        $('#lever-null').css('display','block');
                                                        $('#lever-user').css('display','block');
                                                    });
                                                    $('input[name="lever"]').change(function(){
                                                        values = $(this).val();
                                                    })
                                                    $('#btn-save-lever').click(function(){
                                                        var userId = $(this).data('user-id');
                                                        if(values !== null){
                                                            $.ajax({
                                                                url: '/add-lever',
                                                                type: 'POST',
                                                                data: {
                                                                    user_id: userId,
                                                                    lever : values,
                                                                    '_token':'{{ csrf_token() }}',
                                                                },
                                                                success:function(response){
                                                                    var html = '';
                                                                    html += ' <div class="d-flex lever-not-null">'+
                                                                        '<i class="bx bxs-graduation"></i>'+    

                                                                        '<li class="not_null">'+
                                                                            'Trình độ <span>'+response.lever+'</span>'+
                                                                        '</li>'+
                                                                    '</div>'+
                                                                    '<div class="btn-edit-lever "><i class="bx bxs-edit-alt"></i></div>';
                                                                    
                                                                    $('.user-lever').empty();
                                                                    $('.user-lever').append(html);$('#lever-user').css('display','block');
                                                                    $('.menu-lever-select').css('display','none');
                                                                }
                                                            })
                                                        }
                                                    });
                                                });

                                            </script>
                                            <div class="school d-flex item-render">
                                               <div class="d-flex school-user" style="width: 100%;">
                                                     @isset($user->school)
                                                       <div class="not_null-user-school d-flex" style="flex:5;">
                                                            <i class='bx bxs-graduation'></i>    

                                                            <li class="not_null">
                                                                Học tại <span>{{ $user->school }}</span>
                                                            </li>
                                                       </div>
                                                       <div class="btn-edit-school" style="flex:0;"><i class='bx bxs-edit-alt'></i></div>
                                                    
                                                    @else
                                                        
                                                        <li class="null" id="null_school">
                                                            <i class='bx bx-add-to-queue'></i>
                                                            <span>Thêm trường học</span>
                                                        </li>
                                                    @endisset
                                               </div>
                                            </div>
                                            <div class="add-school" style="display:none;">
                                                <div class="input-school">
                                                    <input type="text" id="input-school-user" value="{{ $user->school }}" placeholder="Nhập trường học">
                                                </div>
                                                <div class="footer d-flex">
                                                    <div id="btn-erase-school">Hủy</div>
                                                    <div id="btn-save-school" data-user-id="{{ $id }}">Lưu</div>
                                                </div>
                                            </div>
                                            <script>
                                                $(document).ready(function(){
                                                    $('#null-school').click(function(){
                                                        $('#null_school').css('display','none');
                                                        $('.add-school').css('display','block');

                                                    })
                                                    $('#btn-erase-school').click(function(){
                                                        $('#null_school').css('display','block');
                                                        $('.add-school').css('display','none');
                                                        $('.school-user').removeClass('d-none');
                                                    })
                                                    $('.btn-edit-school').click(function(){
                                                        $('.school-user').addClass('d-none');
                                                        $('.add-school').css('display','block');
                                                    })
                                                    $('#btn-save-school').click(function(){
                                                        var user = $(this).data('user-id');
                                                        var values = $('input[id="input-school-user"]').val();
                                                        $.ajax({
                                                            url: 'add-school',
                                                            type: 'POST',
                                                            data: {
                                                                user_id: user,
                                                                school: values,
                                                                '_token':'{{ csrf_token() }}',
                                                            },
                                                            success:function(response){ 
                                                                var html = '';
                                                                html +='<i class="bx bxs-graduation"></i>'+    

                                                                '<li class="not_null">'+
                                                                    'Học tại <span>'+response.school+'</span>'+
                                                                '</li>';
                                                                $('.school').empty();
                                                                $('.school').append(html);
                                                                $('.add-school').css('display','none');
                                                            }
                                                        })
                                                     })
                                                })
                                            </script>
                                            <div class="address-user d-flex item-render">
                                                @isset($user->diachi)
                                                    <div  class="d-flex" style="flex: 1;">
                                                        <i class='bx bx-home' ></i>
                                                        <li class="not_null">
                                                            Sống tại <span>{{ $user->diachi }}</span>
                                                        </li>
                                                    </div>
                                                    <div class="btn-edit-address" style="flex: 0;">
                                                        <i class='bx bxs-edit-alt'></i>
                                                    </div>
                                                @else   
                                                    
                                                    <li class="null" id="add-address">
                                                        <i class='bx bx-add-to-queue'></i>  
                                                        <span>Thêm nơi sống</span>
                                                    </li>
                                                @endisset
                                            </div>
                                            <div class="edit-address" style="display:none;">
                                                @php
                                                    $list_town = DB::table('list_town')->get();
                                                @endphp
                                                <select name="address" id="add-address-user">
                                                    <option value="">Chọn nơi ở của bạn</option>
                                                    @foreach($list_town as $index)
                                                        <option value="{{ $index->name }}">{{ $index->name }}</option>
                                                    @endforeach
                                                    
                                                </select>
                                                <div class="footer d-flex">
                                                    <div class="btn-erase">Hủy</div>
                                                    <div class="btn-save" id="btn-save-address" data-user-id="{{ $id }}"> @csrf Lưu</div>
                                                </div>
                                            </div> 
                                            <script>
                                                $(document).ready(function(){
                                                    $('#add-address').on('click',function(){
                                                        $('.edit-address').css('display','block');
                                                        $('.address-user').css('display','none');
                                                    })
                                                    $('.btn-erase').on('click',function(){
                                                        $('.edit-address').css('display','none');
                                                        $('.address-user').css('display','block');
                                                        $('.address-user').removeClass('d-none');
                                                    })
                                                    $('.btn-edit-address').click(function(){
                                                        $('.edit-address').css('display','block');
                                                        $('.address-user').addClass('d-none');
                                                    })
                                                    // truyền dữ liệu về database
                                                    var selectedValue = ''; // Khởi tạo biến để lưu giá trị đã chọn

                                                    // Sự kiện khi người dùng chọn từ select box
                                                    $('#add-address-user').change(function(){
                                                        selectedValue = $(this).val(); // Lưu giá trị đã chọn vào biến
                                                    });
                                                    $('#btn-save-address').on('click',function(){
                                                        var userId = $(this).data('user-id');
                                                        if (selectedValue !== '') {
                                                            // Gửi dữ liệu lên server nếu đã chọn giá trị
                                                            $.ajax({
                                                                url:'/address',
                                                                type:'POST',
                                                                data:{
                                                                    user_id:userId,
                                                                    new_data: selectedValue,
                                                                    '_token':'{{ csrf_token() }}',
                                                                },
                                                                dataType: 'json',
                                                                success: function(response){
                                                                    var html ='';
                                                                    html += '<i class="bx bx-home" ></i>'+
                                                                    '<li class="not_null">'+
                                                                        'Sống tại <span>'+ response.address + '</span>'+
                                                                    '</li>';
                                                                    $('.address-user').empty();
                                                                    $('.address-user').append(html);
                                                                    $('.edit-address').css('display','none');
                                                                    
                                                                },
                                                                error: function(error){
                                                                    // Xử lý lỗi (nếu có)
                                                                    console.error(error);
                                                                }
                                                            });
                                                        } else {
                                                            alert('Vui lòng chọn địa chỉ trước khi lưu.');
                                                        }
                                                    })
                                                })
                                            </script>
                                            <div class="work d-flex item-render">
                                                @isset($user->job)
                                                <div class="d-flex" style="flex: 1;">
                                                    <i class='bx bxs-briefcase'></i>
                                                    <li class="not_null">
                                                        Công việc <span>{{ $user->job }}</span>
                                                    </li>
                                                </div>
                                                <div class="btn-edit-work" style="flex: 0;"><i class='bx bxs-edit-alt'></i></div>
                                                @else
                                                
                                                <li class="null" id="add-work">
                                                    <i class='bx bx-add-to-queue'></i>  
                                                    <span>Thêm công việc</span>
                                                </li>
                                                @endisset
                                            </div> 
                                            <div class="add-work" style="display:none;">
                                                <div class="input-work">
                                                    <input type="text" id="input-work-user" autocomplete="off" placeholder="Nhập công việc của bạn">
                                                </div>
                                                <div class="footer d-flex">
                                                    <div class="btn-erase-work">Hủy</div>
                                                    <div class="btn-save-work" data-user-id="{{ $id }}">@csrf Lưu</div>
                                                </div>
                                            </div>
                                            <script>
                                                $(document).ready(function(){
                                                    $('#add-work').click(function(){
                                                        $('.add-work').css('display','block');
                                                        $('#add-work').css('display','none');
                                                    })
                                                    $('.btn-erase-work').click(function(){
                                                        $('.add-work').css('display','none');
                                                        $('#add-work').css('display','block');
                                                        $('.work').removeClass('d-none');
                                                    })
                                                    $('.btn-edit-work').click(function(){
                                                        $('.add-work').css('display','block');
                                                        $('.work').addClass('d-none');
                                                    })
                                                    $('.btn-save-work').click(function(){
                                                        var user_id = $(this).data('user-id');
                                                        var values = $('input[id="input-work-user"]').val();
                                                        $.ajax({
                                                            url:'/add-work',
                                                            type:"POST",
                                                            data: {
                                                                user_id: userId,
                                                                work: values,
                                                                '_token':'{{ csrf_token() }}',
                                                            },
                                                            success:function(response){
                                                                var html ='';
                                                                html +='<i class="bx bxs-briefcase"></i>'+
                                                                '<li class="not_null">'+
                                                                'Công việc <span>'+ response.work+'</span>'+
                                                                '</li>';
                                                                $('.work').empty();
                                                                $('.work').append(html);
                                                                $('.add-work').css('display','none');
                                                            }

                                                        })
                                                    })
                                                    document.getElementById('input-work-user').addEventListener('input',function(){
                                                        var values = this.value;
                                                        search(values);
                                                    });
                                                    
                                                    function search(values){
                                                        $.ajax({
                                                            url:'search-work',
                                                            type:'GET',
                                                            data:{
                                                                value: values,

                                                            },
                                                            success:function(response){

                                                            }
                                                             
                                                        })
                                                    }
                                                })
                                            </script>
                                            <div class="money d-flex item-render">
                                                @isset($user->meny)
                                                <div class="d-flex" style="flex: 1;">
                                                    <i class='bx bxs-briefcase'></i>
                                                    <li class="not_null">
                                                        Lương 
                                                            @if($user->meny === '0-3000')
                                                                <span>0 ~ 3 triệu</span>
                                                            @elseif ($user->meny === '4000-7000')
                                                                <span>4 ~ 7 triệu</span>
                                                            @elseif ($user->meny === '8000-12000')
                                                              <span>8 ~ 12 triệu</span>
                                                            @elseif($user->meny === '13000-24000')
                                                             <span>13 ~ 24 triệu</span>
                                                            @elseif ($user->meny == '25000-30000')
                                                                <span>25 ~ 30 triệu</span>
                                                            @elseif($user->meny =='31000-40000')
                                                                <span>31 ~ 40 triệu</span>
                                                            @elseif($user->meny =='41000-50000')
                                                                <span>41 ~ 50 triệu</span>
                                                            @elseif($user->meny === '51000-100000' )
                                                                <span>51 ~ 100 triệu</span>
                                                            @endif
                                                        
                                                    </li>
                                                </div>
                                                <div class="btn-edit-salary" style="flex: 0;"><i class='bx bxs-edit-alt'></i></div>
                                                @else
                                                
                                                <li class="null" id="add-money">
                                                    <i class='bx bx-add-to-queue'></i>  
                                                    <span>Thêm mức lương</span>
                                                </li>
                                                @endisset
                                            </div> 
                                            <div class="add-money-user" style="display: none;">
                                                <select name="money" id="add-option-money-user" style="
                                                border: 1px solid blueviolet;
                                                width: 100%;
                                                padding: 10px;
                                                border-radius: 10px;
                                                outline: none;
                                            ">
                                                    <option value="">Lựa chọn mức lương</option>
                                                    <option value="0-3000">0 ~ 3 triệu</option>
                                                    <option value="4000-7000">4 ~ 7 triệu</option>
                                                    <option value="8000-12000">8 ~ 12 triệu</option>
                                                    <option value="13000-24000">13 ~ 24 triệu</option>
                                                    <option value="25000-30000">25 ~ 30 triệu</option>
                                                    <option value="31000-40000">31 ~ 40 triệu</option>
                                                    <option value="41000-50000">41 ~ 50 triệu</option>
                                                    <option value="51000-100000">51 ~ 100 triệu</option>
                                                </select>
                                                <div class="footer d-flex" style="margin-top: 10px">
                                                    <div class="btn-erase-money">
                                                        Hủy
                                                    </div>
                                                    <div class="btn-save-money" data-user-id="{{ $id }}">@csrf Lưu</div>
                                                </div>

                                            </div>
                                            <script>
                                                $(document).ready(function(){
                                                    $("#add-money").click(function(){
                                                        $('.add-money-user').css('display','block');
                                                        $('#add-money').css('display','none');
                                                    })
                                                    $('.btn-erase-money').click(function(){
                                                        $('.add-money-user').css('display','none');
                                                        $('#add-money').css('display','block');
                                                        $('.money').removeClass('d-none');
                                                    })
                                                    $('.btn-edit-salary').click(function(){
                                                        $('.add-money-user').css('display','block');
                                                       $('.money').addClass('d-none');
                                                    })
                                                    var values = '';
                                                    $('#add-option-money-user').change(function(){
                                                        values = $(this).val();
                                                    
                                                    })

                                                    $('.btn-save-money').click(function(){
                                                        var user_id = $('.btn-save-work').data("user-id");
                                                        $.ajax({
                                                            url:"add-money",
                                                            type: "POST",
                                                            data: {
                                                                user_id: user_id,
                                                                money: values,
                                                                '_token':'{{ csrf_token() }}',
                                                            },
                                                            success:function(response){
                                                                var html = '';
                                                                html += '<i class="bx bxs-briefcase"></i>'+
                                                                    '<li class="not_null">'+
                                                                        'Lương'; 
                                                                        if(response.money === '0-3000')
                                                                            html+= '<span>0 ~ 3 triệu</span>';
                                                                        else if (response.money === '4000-7000')
                                                                            html += '<span>4 ~ 7 triệu</span>';
                                                                        else if (response.money === '8000-12000')
                                                                            html += '<span>8 ~ 12 triệu</span>';
                                                                        else if(response.money === '13000-24000')
                                                                            html += '<span>13 ~ 24 triệu</span>';
                                                                        else if (response.money == '25000-30000')
                                                                            html += '<span>25 ~ 30 triệu</span>';
                                                                        else if(response.money =='31000-40000')
                                                                            html += '<span>31 ~ 40 triệu</span>';
                                                                        else if(response.money =='41000-50000')
                                                                            html += '<span>41 ~ 50 triệu</span>';
                                                                        else if(response.money === '51000-100000' )
                                                                            html += '<span>51 ~ 100 triệu</span>';
                                                                        
                                                                    
                                                                html +='</li>';
                                                                $('.money').empty();
                                                                $('.money').append(html);
                                                                $('.add-money-user').css('display','none');
                                                            }
                                                        })
                                                    })
                                                })
                                            </script>
                                            <div class="zodiac-user d-flex item-render">
                                                @isset($user->zodiac)
                                                <div class="d-flex" style="flex:1;">
                                                    <i class='bx bxs-moon'></i>
                                                <li class="not_null">
                                                    Cung <span>{{ $user->zodiac }}</span>
                                                </li>
                                                </div>
                                                <div class="btn-edit-zodiac" style="flex:0;">
                                                    <i class='bx bxs-edit-alt'></i>
                                                </div>
                                                @else
                                                
                                                <li class="null">
                                                    <i class='bx bx-add-to-queue'></i>  
                                                    <span>Thêm cung hoàng đạo</span>
                                                </li>
                                                @endisset
                                            </div>
                                            <div class="add-zodiac d-none">
                                                <select name="zodiac" id="select-zodiac" style="
                                                border: 1px solid blueviolet;
                                                width: 100%;
                                                padding: 10px;
                                                border-radius: 10px;
                                                outline: none;
                                                margin:0;
                                            ">
                                                    <option value="">Chọn cung hoàng đạo</option>
                                                    <option value="Bạch Dương">Bạch Dương</option>
                                                    <option value="Kim Ngưu">Kim Ngưu</option>
                                                    <option value="Song Tử" checked>Song Tử</option>
                                                    <option value="Cự Giải">Cự Giải</option>
                                                    <option value="Sư Tử">Sư Tử</option>
                                                    <option value="Xử Nữ">Xử Nữ</option>
                                                    <option value="Thiên Bình">Thiên Bình</option>
                                                    <option value="Thiên Yết">Thiên Yết</option>
                                                    <option value="Nhân Mã">Nhân Mã</option>
                                                    <option value="Ma Kết">Ma Kết</option>
                                                    <option value="Bảo Bình">Bảo Bình</option>
                                                    <option value="Song Ngư">Song Ngư</option>
                                                </select>
                                                <div class="footer d-flex" style="margin-top: 10px;">
                                                    <div class="btn-erase-zodiac">
                                                        Hủy
                                                    </div>
                                                    <div class="btn-save-zodiac" data-user-id="{{ $id }}">@csrf Lưu</div>
                                                </div>
                                            </div>
                                            <script>
                                                $(document).ready(function(){
                                                    $('.zodiac-user').click(function(){
                                                        $('.add-zodiac').removeClass('d-none');
                                                        $('.zodiac-user').addClass('d-none');
                                                    })

                                                    $('.btn-erase-zodiac').click(function(){
                                                        $('.add-zodiac').addClass('d-none');
                                                        $('.zodiac-user').removeClass('d-none');
                                                    })

                                                    var values = '';
                                                    $('#select-zodiac').change(function(){
                                                        values = $(this).val();
                                                        
                                                    })
                                                    $('.btn-save-zodiac').click(function(){
                                                        $.ajax({
                                                            url: "post-zodiac",
                                                            method: "POST",
                                                            data:{
                                                                data:values,
                                                                '_token':'{{ csrf_token() }}'
                                                            },
                                                            success:function(){
                                                                $('.zodiac-user').empty();
                                                                var html = `<div class="d-flex" style="flex:1;">
                                                                    <i class='bx bxs-moon'></i>
                                                                    <li class="not_null">
                                                                        Cung <span>${values}</span>
                                                                    </li>
                                                                </div>
                                                                <div class="btn-edit-zodiac" style="flex:0;">
                                                                    <i class='bx bxs-edit-alt'></i>
                                                                </div>`;
                                                                $('.add-zodiac').addClass('d-none');
                                                                $('.zodiac-user').removeClass('d-none');
                                                                $('.zodiac-user').append(html);
                                                            }
                                                        })
                                                    })
                                                  
                                                })
                                            </script>
                                            <div class="interest-user ">
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
                                            <div class="btn-add-interest d-flex ">
                                                
                                                <div class="title">Thêm sở thích</div>
                                            </div>
                                           
                                        </div>
                                    </div>
                                    
                                    <div class="social_network container">
                                        <div class="title">
                                            <h4>Mạng xã hội</h4>

                                        </div>
                                        <div class="main-social-network ">
                                            <div class="zalo d-flex item-render">
                                                @isset($user->zalo)
                                                    <div class="d-flex" style="flex: 1;">
                                                        <i class='bx bxs-phone'></i>
                                                        <li class="not_null">Zalo: <span>{{ $user->zalo }}</span></li>
                                                    </div>
                                                    <div class="edit-number-zalo" style="flex: 0;"><i class='bx bxs-edit-alt'></i></div>
                                                @else
                                                
                                                    <li class="null" id="add_number_zalo"><i class='bx bx-add-to-queue'></i>  <span>Thêm zalo</span></li>
                                                @endisset

                                            </div>
                                            <div class="input-add-zalo d-none">
                                                <div class="class-input-number">
                                                    <input id="zaloValue" type="text" autocomplete="off" placeholder="Nhập số zalo của bạn" value="{{ $user->zalo }}" style="
                                                    border: 1px solid blueviolet;
                                                    width: 100%;
                                                    padding: 10px;
                                                    border-radius: 10px;
                                                   
                                                    outline: none;
                                                ">
                                                </div>
                                                <div class="btn-action d-flex">
                                                    <div class="btn-erase" id="btn-erase-zalo">
                                                        Hủy
                                                    </div>
                                                    <div class="btn-save" id="btn-save-zalo">
                                                        Lưu
                                                    </div>
                                                </div>
                                            </div>


                                            <script>

                                                $('#add_number_zalo').click(function(){
                                                    $('.input-add-zalo').removeClass('d-none');
                                                    $('.zalo').addClass('d-none');
                                                })
                                                $('#btn-erase-zalo').click(function(){
                                                    $('.input-add-zalo').addClass('d-none');
                                                    $('.zalo').removeClass('d-none');

                                                })
                                                $('.edit-number-zalo').click(function(){
                                                    $('.input-add-zalo').removeClass('d-none');
                                                    $('.zalo').addClass('d-none');
                                                })
                                                $('#btn-save-zalo').click(function(){
                                                    var value = $('#zaloValue').val();
                                                    $.ajax({
                                                        url: 'post-zalo',
                                                        method: "POST",
                                                        data:{
                                                            data:value,
                                                            '_token':'{{ csrf_token() }}'
                                                        },
                                                        success:function(){
                                                            html=`<div class="d-flex" style="flex: 1;">
                                                                <i class='bx bxs-phone'></i>
                                                                <li class="not_null">Zalo: ${value}</li>
                                                            </div>
                                                            <div class="edit-number-zalo" style="flex: 0;"><i class='bx bxs-edit-alt'></i></div>`;
                                                            $('.zalo').empty();
                                                            $('.input-add-zalo').addClass('d-none');
                                                    $('.zalo').removeClass('d-none');
                                                    $('.zalo').append(html);
                                                            
                                                        }
                                                    })
                                                })
                                            </script>
                                            <div class="instargram d-flex item-render">
                                                @isset($user->link_ig)
                                                    <div class="d-flex" style="flex: 1;">
                                                        <i class='bx bxl-instagram-alt' ></i>
                                                    <li class="not_null">Instagram: <span>{{ $user->link_ig }}</span></li>
                                                    </div>
                                                    <div class="btn-edit-instagram" style="flex: 0;"><i class='bx bxs-edit-alt'></i></div>
                                                @else
                                                
                                                <li class="null" id="show-input-instagram"><i class='bx bx-add-to-queue'></i> <span>Thêm instagram</span></li>
                                                @endisset
                                            </div>
                                            <div class="input-add-instagram d-none">
                                                <div class="class-input-number">
                                                    <input id="instagramValue" type="text" autocomplete="off" placeholder="Nhập instagram của bạn" value="{{ $user->link_ig }}" style="
                                                    border: 1px solid blueviolet;
                                                    width: 100%;
                                                    padding: 10px;
                                                    border-radius: 10px;
                                                   
                                                    outline: none;
                                                ">
                                                </div>
                                                <div class="btn-action d-flex">
                                                    <div class="btn-erase" id="erase-instagram">
                                                        Hủy
                                                    </div>
                                                    <div class="btn-save" id="save-instagram">
                                                        Lưu
                                                    </div>
                                                </div>
                                            </div>
                                            <script>
                                                $(document).ready(function(){
                                                    $('#show-input-instagram').click(function(){
                                                        $('.input-add-instagram').removeClass('d-none');
                                                        $('.instargram').addClass('d-none');
                                                    })
                                                    $('#erase-instagram').click(function(){
                                                        $('.input-add-instagram').addClass('d-none');
                                                        $('.instargram').removeClass('d-none');
                                                    })
                                                    $('.btn-edit-instagram').click(function(){
                                                        $('.input-add-instagram').removeClass('d-none');
                                                        $('.instargram').addClass('d-none');
                                                    })
                                                    $('#save-instagram').click(function(){
                                                        var value = $('#instagramValue').val();
                                                        $.ajax({
                                                            url:'post-ins',
                                                            method:'POST',
                                                            data:{
                                                                data:value,
                                                                '_token':'{{ csrf_token() }}'
                                                            },
                                                            success:function(){
                                                                var html =`<div class="d-flex" style="flex: 1;">
                                                                    <i class='bx bxl-instagram-alt' ></i>
                                                                <li class="not_null">Instagram: ${value}</li>
                                                                </div>
                                                                <div class="btn-edit-instagram" style="flex: 0;"><i class='bx bxs-edit-alt'></i></div>`;
                                                                $('.instargram').empty();
                                                                $('.input-add-instagram').addClass('d-none');
                                                                $('.instargram').removeClass('d-none');
                                                                $('.instargram').append(html);
                                                            }
                                                        })
                                                    })
                                                })
                                            </script>
                                            <div class="facebook d-flex item-render">
                                                @isset($user->link_fb)
                                                    <div class="d-flex" style="flex: 1;">
                                                        <i class='bx bxl-facebook-circle' ></i>
                                                        <li class="not_null" id="openPageButton" data-link-fb="{{ $user->link_fb }}">Facebook: <span>{{ $user->link_fb }}</span></li>
                                                    </div>
                                                    <div class="btn-edit-facebook" style="flex: 0;">
                                                        <i class='bx bxs-edit-alt'></i>
                                                    </div>
                                                @else
                                                
                                                <li class="null" id="add-link-fb"> <i class='bx bx-add-to-queue'></i> <span>Thêm link facebook</span></li>
                                                @endisset
                                            </div>
                                            <div class="input-add-facebook d-none">

                                                <div class="class-input-number">
                                                    <input id="facebookValue" type="text" autocomplete="off" placeholder="Nhập link facebook của bạn" value="{{ $user->link_fb }}" style="
                                                    border: 1px solid blueviolet;
                                                    width: 100%;
                                                    padding: 10px;
                                                    border-radius: 10px;
                                                   
                                                    outline: none;
                                                ">
                                                </div>
                                                <div class="btn-action d-flex">
                                                    <div class="btn-erase" id="erase-facebook">
                                                        Hủy
                                                    </div>
                                                    <div class="btn-save" id="save-facebook">
                                                        Lưu
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="email item-render">
                                                <i class='bx bxs-envelope' ></i>
                                                <a class="not_null" href="mailto:{{ $user->email }}">Email: <span>{{ $user->email }}</span></a>
                                            </div>
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                if ('{{ $user->link_fb }}' != '') {
                                                    var url_fb = '{{ $user->link_fb }}';
                                                    document.getElementById("openPageButton").addEventListener("click", function() {
                                                        window.open(url_fb, "_blank");
                                                    });
                                                }
                                        
                                                $('#add-link-fb').click(function() {
                                                    $('.facebook').addClass('d-none');
                                                    $('.input-add-facebook').removeClass('d-none');
                                                });
                                        
                                                $('#erase-facebook').click(function() {
                                                    $('.facebook').removeClass('d-none');
                                                    $('.input-add-facebook').addClass('d-none');
                                                });
                                        
                                                $('.btn-edit-facebook').click(function() {
                                                    $('.facebook').addClass('d-none');
                                                    $('.input-add-facebook').removeClass('d-none');
                                                });
                                        
                                                $('#save-facebook').click(function() {
                                                    var value = $('#facebookValue').val();
                                                    $.ajax({
                                                        url: 'post-fb',
                                                        method: 'POST',
                                                        data: {
                                                            data: value,
                                                            '_token': '{{ csrf_token() }}'
                                                        },
                                                        success: function() {
                                                            var html = `<div class="d-flex" style="flex: 1;">
                                                                <i class='bx bxl-facebook-circle'></i>
                                                                <li class="not_null" id="openPageButton" data-link-fb="${value}">Facebook:  ${value}</li>
                                                            </div>
                                                            <div class="btn-edit-facebook" style="flex: 0;">
                                                                <i class='bx bxs-edit-alt'></i>
                                                            </div>`;
                                                            
                                                            $('.facebook').empty();
                                                            $('.facebook').removeClass('d-none');
                                                            $('.input-add-facebook').addClass('d-none');
                                                            $('.facebook').append(html);
                                                        }
                                                    });
                                                });
                                            });
                                        </script>
                                        
                                    </div>
                                    @php
                                       
                                   
                                        $friend = App\Models\Friendship::where('requested_id',$id)->orWhere('requester_id',$id)->where('status','accepted')->get();
                                        $chuckFriend = $friend->chunk(3);
                                    @endphp
                                    <div class="album-user">
                                        <div class="header d-flex">
                                            <div class="title"><h4>Ảnh</h4></div>
                                            <div class="see">Xem tất cả ảnh</div>
                                        </div>
                                        <div class="main-album-user">
                             
                                            @foreach ($chuckPhoto as $index)
                                                <div class="row">
                                                    @foreach($index as $item)
                                                        <div class="box-img">
                                                    
                                                            @if ($item->post->type_post === 'post')
                                                                <img src="{{ asset('img/upload/'. $item->image) }}" alt="">
                                                            @elseif($item->post->type_post ==='avatar')
                                                                <img src="{{ asset('storage/users_avatar/'. $item->image) }}" alt="">
                                                            @endif
                                                            
                                                        </div>
                                                    @endforeach
                                                </div>
                                                
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="friend-user">
                                        <div class="header d-flex">
                                            <div class="title"><h4>Bạn bè</h4></div>
                                            <div class="see">Xem tất cả bạn bè</div>
                                        </div>
                                        <div class="main-friend-user">
                                            @foreach($chuckFriend as $index)
                                                <div class="row">
                                                    @foreach($index as $item)
                                                    @php
                                                        $friendId = ($item->requester_id === $id) ? $item->requested_id : $item->requester_id;
                                                        $friendInfo = DB::table('user')->where('id', $friendId)->first();
                                                    @endphp
                                                    @if($friendInfo)
                                                        <div class="user">
                                                            @isset($friendInfo->avatar )
                                                                <div class="avt"><a href=" {{ route('profile', ['id' => $friendInfo->id]) }}"><img src="{{ asset('storage/users_avatar/' . $friendInfo->avatar) }}" alt=""></a></div>
                                                            @else
                                                                <div class="avt"><a href=" {{ route('profile', ['id' => $friendInfo->id]) }}"><img src="{{ asset('storage/users_avatar/guest-user-250x250.jpg') }}"></a></div>
                                                            @endisset
                                                            <div class="name"><a href=" {{ route('profile', ['id' => $friendInfo->id]) }}">{{ $friendInfo->first_name }} {{ $friendInfo->last_name }}</a></div>
                                                        </div>
                                                    @endif
                                
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="post">

                                        <div class=""></div>
                                    </div>
                                </div>
                            </div>
                        
                    </div>
                </div>
            </div>
            @endif
        </div>
        @php
                                        $interesting = DB::table('list_interest')->get();
                                        $list = $interesting->take(9)->chunk(3);
                                        
                                  
                                    @endphp
                                    <div class="modal" id="model-interesting">
                                        <div class="container content-modal justify-content-center bg-white">
                                            <div class="header-modal d-flex">
                                                <div class="tile"><h5>Thêm sở thích</h5></div>
                                                <div class="btn-close" id="close-modal-interesting"></div>
                                            </div>
                                            <div class="main-modal">
                                                <div class="content-modal">
                                                @foreach($list as $row)
                                                    <div class="row">
                                                        @foreach($row as $index)
                                                            <div class="block-interest d-flex">
                                                                <div class="custom-radio d-flex">
                                                                    <input type="checkbox" id="option{{ $index->id }}" data-interest-id="{{ $index->id }}" name="choice[]" value="{{ $index->id }}"
                                                                           @foreach($selectUser as $int)
                                                                               @if($int->listInterest->content === $index->content && $id === $int->user_id) checked @endif
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
                                                <div class="btn-search-interest d-flex justify-content-center">
                                                    <div class="icon"><i class='bx bx-search'></i></div>
                                                    <div class="title">Tìm sở thích của bạn</div>
                                                </div>
                                                </div>
                                                
                                            </div>
                                            <div class="footer-modal bg-white d-flex">
                                                <div class="btn-erase" id="cancel-modal-interest">Hủy</div>
                                                <div class="btn-save" id="save-modal-interest">Lưu</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal" id="modal-search-interest">
                                        
                                            <div class="container content-modal justify-content-center bg-white">
                                                <div class="header-modal d-flex">
                                                    <div class="icon-cancel"><i class='bx bx-left-arrow-alt'></i></div>
                                                    <div class="input-search-interest">
                                                        <input  class="livewire-input" type="text" id="search-interesting" autocomplete="off" placeholder="Nhập sở thích của bạn">
                                                    </div>

                                                </div>
                                                <div class="main-modal">
                                                    <div class="iput-null d-none"></div>
                                                    <div class="input-is-null">
                                                        
                                                        @foreach ($chunked as $item)
                                                            <div class="row">
                                                                @foreach ($item as $index)
                                                                <div class="block-interest d-flex">
                                                                    <div class="custom-radio d-flex">
                                                                        <input type="checkbox" id="option{{ $index->id }}" data-interest-id="{{ $index->id }}" name="choice[]" value="{{ $index->id }}"
                                                                            @foreach($selectUser as $int)
                                                                                @if($int->listInterest->content === $index->content && auth()->id() === $int->user_id) checked @endif
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
                                                        </div>
                                    
                                                   
                                                </div>
                                                <div class="footer-madal d-flex">
                                                    <div class="btn-erase" id="cancel-modal-search-interesting">Hủy</div>
                                                    <div class="btn-save" id="save-modal-search-interestins">Lưu</div>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal" id="modal-update-avatar"style="z-index:20004;">
                                        <div class="container content-modal justify-content-center bg-white top-50 w-100 position-relative" style="transform: translateY(-50%); max-width: 500px;   margin: 0 auto; border-radius:10px; padding:20px;">
                                            <div class="header-modal d-flex justify-content-between align-item-center">
                                                <div class="title">
                                                    <h5>Cập nhật ảnh đại diện</h5>
                                                </div>
                                                <div class="btn-close" id="close-modal-update-avatar"></div>
                                            </div>
                                            <div class="main-modal">
                                                <div class="menu-update-avatar ">
                                                    <div class="btn-update-avatar d-flex justify-content-center w-100">
                                                        <div class="icon"><i class='bx bx-upload'></i></div>
                                                        <div class="title">Tải ảnh đại diện lên</div>
                                                        
                                                    </div>
                                                
                                                    <input type="file" id="image-input"  name="post-img-avatar" accept=".{{implode(', .',config('chatify.attachments.allowed_images'))}}"  hidden>
                                               


                                                </div>
                                                <div class="content-update-avatar d-none">
                                                    <div class="user d-flex">
                                                        <div class="avatar">
                                                            @isset($user->avatar)
                                                            <img width="50px" style="border-radius:50%;" src="{{ asset('storage/users_avatar/'.$user->avatar) }}" alt="">
                                                                @else
                                                                <img src="" alt="">
                                                            @endisset
                                                        </div>
                                                        <div class="name">
                                                            <span>{{ $user->first_name }} {{ $user->last_name }}</span>
                                                        </div>


                                                    </div>
                                                    <div class="content-post">
                                                        <div class="input-content-post-avatar">
                                                            <textarea name="content-post" id="content-post" placeholder="Hãy nhập những gì bạn muốn chia sẻ"></textarea>
                                                        </div>
                                                        <div class="cropped-avatar-display d-flex justify-content-center">
                                                            <div id="cropped-preview" style="display: none;">
                                            
                                                                <img id="cropped-preview-image" src="" alt="Cropped Image Preview">
                                                            </div>
                                                        </div>
                                                        <div class="edit-image-avatar">
                                                            <div class="btn btn-crop-image-avatar d-flex">
                                                                <div class="icon"><i class='bx bx-crop'></i></div>
                                                                <div class="title">Chỉnh sửa ảnh</div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="cropp-image-avatar d-none">
                                                    <div class="cropper-container">
                                                        <img id="cropped-image" src="" alt="Cropped Image">
                                                    </div>
                                                    <button id="crop-button" class="d-flex align-items-center">
                                                        <div class="icon">
                                                            <i class='bx bx-crop'></i>
                                                        </div>
                                                        <div class="title">Cắt</div>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="footer-modal d-flex bg-white d-none" id="footer-modal-post-avatar">
                                                <div class="btn-erase" id="erase-avatar-post">Hủy</div>
                                                <div class="btn-save" id="save-avatar-post">Lưu</div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <script>

                                        $(document).ready(function(){
                                            $('.btn-update-avatar').click(function(event){
                                                event.preventDefault(); // Prevent the default behavior of the button click
                                                var $input = $('input[name="post-img-avatar"]').click();
                                                
                                            });

                                            $('#image-input').change(function() {
                                                var input = this;
                                                if (input.files ) {
                                                    $('.menu-update-avatar').addClass('d-none');
                                                    // $('.content-update-avatar').removeClass('d-none');
                                                    $('.cropp-image-avatar').removeClass('d-none');
                                                }
                                            });

                                            $('.btn-crop-image-avatar').click(function(){
                                                $('.cropp-image-avatar').removeClass('d-none');
                                                $('.content-update-avatar').addClass('d-none');
                                                $('#footer-modal-post-avatar').addClass('d-none');
                                            })
                                            $('#crop-button').click(function(){
                                                $('#modal-edit-images').removeClass('d-block');
                                            })
                                        });
                                        document.addEventListener('DOMContentLoaded', function () {
                                          const imageInput = document.getElementById('image-input');
                                          const croppedImage = document.getElementById('cropped-image');
                                          const cropButton = document.getElementById('crop-button');
                                          const saveButton = document.getElementById('save-avatar-post');
                                          const croppedPreview = document.getElementById('cropped-preview');
                                          const croppedPreviewImage = document.getElementById('cropped-preview-image');
                                          
                                          let cropper;
                                          let croppedData;
                                        
                                          imageInput.addEventListener('change', function () {
                                            const file = imageInput.files[0];
                                            const reader = new FileReader();
                                        
                                            reader.onload = function (e) {
                                              const imageUrl = e.target.result;
                                              croppedImage.src = imageUrl;
                                        
                                              // Initialize the Cropper.js instance
                                              cropper = new Cropper(croppedImage, {
                                                aspectRatio: 1, // 1:1 aspect ratio for cropping
                                                viewMode: 1,    // Restrict the crop box to stay within the container
                                                dragMode: 'move', // Enable the ability to move the crop box
                                                crop: function(event) {
                                                  // You can access the cropped data using event.detail
                                                  croppedData = event.detail;
                                                },
                                              });
                                        
                                            //   saveButton.style.display = 'block';
                                            };
                                        
                                            reader.readAsDataURL(file);
                                          });
                                        
                                          cropButton.addEventListener('click', function () {
                                            // Crop the image
                                            const croppedCanvas = cropper.getCroppedCanvas();
                                            if (croppedCanvas) {
                                              croppedImage.src = croppedCanvas.toDataURL('image/jpeg');
                                              croppedPreviewImage.src = croppedCanvas.toDataURL('image/jpeg');
                                              $('.content-update-avatar').removeClass('d-none');
                                                    $('.cropp-image-avatar').addClass('d-none');
                                                    $('#footer-modal-post-avatar').removeClass('d-none');
                                            
                                              croppedPreview.style.display = 'block'; // Display the cropped image preview
                                            }
                                          });
                                          const csrfToken = "{{ csrf_token() }}";
                                          saveButton.addEventListener('click', function () {

                                             var pathImage = $('#cropped-preview-image').attr('src');
                                            var content = $('#content-post').val();
                                            console.log(content);
                                             $.ajax({
                                                url: '{{ route("updateAvatar") }}',
                                                method: 'POST',
                                                data:{
                                                    path: pathImage,
                                                    content: content,
                                                    '_token': csrfToken,
                                                },
                                                success:function(data){
                                                    location.reload();
                                                }
                                             })
                                            });
                                        });
                                        </script>
                                        
                                        
                                 
                                   
                                    
                                    <script>


                                        $('.btn-add-interest').click(function(){
                                            $('#model-interesting').css('display','block');
                                        })

                                        $('#close-modal-interesting').click(function(){
                                            $('#model-interesting').css('display','none');
                                        })
                                        var selectedCheckboxes = JSON.parse(localStorage.getItem('selectedCheckboxes')) || {};
                                        $('input[name="choice[]"]').each(function() {
                                            var checkboxId = $(this).data('interest-id'); // Lấy ID của checkbox
                                                var isChecked = $(this).prop('checked'); // Kiểm tra checkbox đã được chọn hay chưa

                                                // Cập nhật mảng selectedCheckboxes dựa trên trạng thái checkbox
                                                if (isChecked) {
                                                    selectedCheckboxes[checkboxId] = true;
                                                } else {
                                                    delete selectedCheckboxes[checkboxId];
                                                }

                                                // Lưu mảng selectedCheckboxes vào Local Storage
                                                localStorage.setItem('selectedCheckboxes', JSON.stringify(selectedCheckboxes));
                                        });

                                            // Bắt sự kiện khi checkbox thay đổi trạng thái
                                            $('input[type="checkbox"]').change(function() {
                                                var checkboxId = $(this).data('interest-id'); // Lấy ID của checkbox
                                                var isChecked = $(this).prop('checked'); // Kiểm tra checkbox đã được chọn hay chưa
                                                // alert('ok                                                // Cập nhật mảng selectedCheckboxes dựa trên trạng thái checkbox
                                                if (isChecked) {
                                                    selectedCheckboxes[checkboxId] = true;
                                                } else {
                                                    delete selectedCheckboxes[checkboxId];
                                                }

                                                // Lưu mảng selectedCheckboxes vào Local Storage
                                                localStorage.setItem('selectedCheckboxes', JSON.stringify(selectedCheckboxes));
                                            });

                                            // Khôi phục trạng thái của checkbox từ mảng selectedCheckboxes khi trang web được nạp lại
                                            $('input[name="choice[]"]').each(function() {
                                                var checkboxId = $(this).data('interest-id');
                                                if (selectedCheckboxes[checkboxId]) {
                                                    $(this).prop('checked', true);
                                                }
                                            });
                                        
                                            $('.btn-search-interest').click(function(){
                                                $('#modal-search-interest').css('display','block');
                                            })
                                            $('.icon-cancel').click(function(){
                                                $('#modal-search-interest').css('display','none');
                                            })
                                            var arrayInteresting = @json($listInteresting);
                                            var chunkedInterest = @json($selectUser);
                                            // console.log(chunkedInterest);

                                            $('#search-interesting').on('input', function () {
                                                var iputInterest = $(this).val();
                                                const inputValue = $.trim(iputInterest);
                                                

                                                if (inputValue) {
                                                    $('.input-is-null').addClass('d-none');
                                                    $('.iput-null').removeClass('d-none'); 
                                                    var results = arrayInteresting.filter(function (interest) {
                                                        return interest.content.toLowerCase().includes(inputValue.toLowerCase());
                                                    });

                                                    // Hiển thị kết quả trong HTML
                                                    var html = '';
                                                    $('.iput-null').empty();

                                                    if (results.length > 0) {
                                                        for (var i = 0; i < results.length; i += 3) {
                                                            html += '<div class="row">';
                                                            for (var j = i; j < i + 3 && j < results.length; j++) {
                                                                var check ='';
                                                                if(chunkedInterest.length > 0){
                                                                    for(var k = 0;k< chunkedInterest.length;k++){
                                                                        if(chunkedInterest[k].list_interest_id === results[j].id){
                                                                            check ='checked';
                                                                        }
                                                                    }
                                                                }
                                                                html += `<div class="block-interest d-flex">
                                                                    <div class="custom-radio d-flex">
                                                                        <input type="checkbox" id="option${results[j].id}" data-interest-id="${results[j].id}" name="choice[]" value="${results[j].id}" ${check}>
                                                                        <label for="option${results[j].id}" class="d-flex">
                                                                            <div class="icon"><img src="{{ asset('img/icon/${results[j].icon}') }}" alt="Icon"></div>
                                                                            <div class="title">${results[j].content}</div>
                                                                        </label>
                                                                    </div>
                                                                </div>`;
                                                            }
                                                            html += '</div>';
                                                        }
                                                    }
                                                    else{
                                                        html = '<div class="title justify-content-center d-flex" style="margin-top:15px;"><h5 style="color:#8e8e8e !important;">Không có sở thích nào!</h5></div>'
                                                    }

                                                    // Đặt kết quả vào một phần tử HTML để hiển thị
                                                    // console.log(html);
                                                    $('.iput-null').html(html);
                                                } 
                                                else{
                                                    $('.input-is-null').removeClass('d-none');
                                                    $('.iput-null').addClass('d-none');   
                                                }
                                            });


                                           


                                            $('#cancel-modal-interest').click(function(){
                                                $('#model-interesting').css('display','none');
                                            })
                                    </script>
        <div class="main">
            <div class="">
                @if($user->ready_dating === 0)
                    <div class="ready-dating">
                        <div class="btn-ready">
                            <span id="started-dating" data-user-id="{{ $id }}"><meta name="csrf-token" content="{{ csrf_token() }}">Bắt đầu hẹn hò</span>
                        </div>
                    </div>
                    <script>
                    $(document).ready(function(){
                        $("#started-dating").on('click', function(){
                            var userId = $(this).data('user-id');
                            // console.log(userId);
                            var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Lấy CSRF token
                            $.ajax({
                                url: '/started_dating',
                                type: 'POST',
                                data: {
                                    user_id: userId,
                                    _token: csrfToken // Thêm _token vào dữ liệu gửi đi
                                },
                                success: function(response){
                                    location.reload();
                                    
                                }
                            });
                        });
                    });
                    </script>
                @else
                    <div class="menu-filter-user">
                        <div class="content">
                            <div class="container">
                                
                                <div class="content-main d-flex">
                                    @php
                                        $list_town = DB::table('list_town')->get();
                                    @endphp
                                    <div class="block-content">
                                        <div class="select-address item-select">
                                            <div class="title"><span>Nơi bạn muốn tìm kiếm:</span></div>
                                            <select name="address" id="select-address">
                                                <option value="all">Chọn nơi bạn muốn tìm</option>
                                                @foreach($list_town as $index)
                                                    <option value="{{ $index->name }}">{{ $index->name }}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                        <div class="birthday item-select">
                                            <div class="title"><span>Độ tuổi:</span></div>
                                            <div id="range-slider2"></div>
                                            <div class="select_birthday d-flex">
                                                
                                                <div id="min-birthday"> </div>
                                                <p> - </p>
                                                <div id="max-birthday"> </div>
                                                <p> tuổi</p>
                                            </div>
                                        </div>
                                       
                                       <div class="money">
                                            <div class="title">
                                                <span>Thu nhập:</span>
                                                
                                            </div>
                                            <select name="money" id="option-money">
                                                <option value="all">Lựa chọn mức lương</option>
                                                <option value="0-3000">0 ~ 3 triệu</option>
                                                <option value="4000-7000">4 ~ 7 triệu</option>
                                                <option value="8000-12000">8 ~ 12 triệu</option>
                                                <option value="13000-24000">13 ~ 24 triệu</option>
                                                <option value="25000-30000">25 ~ 30 triệu</option>
                                                <option value="31000-40000">31 ~ 40 triệu</option>
                                                <option value="41000-50000">41 ~ 50 triệu</option>
                                                <option value="51000-100000">51 ~ 100 triệu</option>
                                            </select>
                                       </div>
                                    </div>
                                    
                                    <div class="block-content">
                                        <div class="job item-select">
                                            <div class="title"><span>Nghề nghiệp:</span></div>
                                            <input type="text" id="job" placeholder="Nhập nghề nghiệp" autocomplete="off">
                                            <div class="dropdown" id="dropdown-list-job" style="display: none;">@csrf</div>
                                        </div>
                                        
                                        
                                        
                                        <div class="item-select lever">
                                            <div class="title"><span>Học vấn:</span></div>
                                            
                                            <div class="selcet-lever">
                                                <input type="radio" id="lever-1" name="lever" value="Đại học" @if($dating->lever ==='Đại học') @checked(true) @endif>
                                                <label for="lever-1">Đại học</label>
                                                <input type="radio" id="lever-2" name="lever" value="Cao đẳng" @if($dating->lever ==='Cao đẳng') @checked(true) @endif>
                                                <label for="lever-2">Cao đẳng</label>
                                                <input type="radio" id="lever-3" name="lever" value="12/12"  @if($dating->lever ==='12/12') @checked(true) @endif>
                                                <label for="lever-3">12/12</label>
                                                
                                                <input type="radio" id="lever-4" name="lever" value="all" @if($dating->lever === null) @checked(true) @endif>
                                                <label for="lever-4">Không</label>
                                            </div>
                                        </div>
                                        <div class="gender item-select">
                                            <div class="title"><span>Giới tính:</span></div>
                                            <div class="option-gender-radio">
                                                <input type="radio" id="gender-option-m" name="gender" value="male" @if($dating->gender ==='male') @checked(true) @endif>
                                                <label for="gender-option-m">Nam</label>
                                                <input type="radio" id="gender-option-f" name="gender" value="female" @if($dating->gender ==='female') @checked(true) @endif>
                                                <label for="gender-option-f">Nữ</label>
                                                <input type="radio" id="gender-option-Lm" name="gender" value="LGPTM" @if($dating->gender ==='LGPTM') @checked(true) @endif>
                                                <label for="gender-option-Lm">Đồng tính nam</label>
                                                <input type="radio" id="gender-option-Lf" name="gender" value="LGPTF" @if($dating->gender ==='LGPTF') @checked(true) @endif>
                                                <label for="gender-option-Lf">Đồng tính nữ</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block-content">
                                        <div class="interest item-select">
                                            <div class="title">
                                                <span>Kiểu:</span>
                                            </div>
                                            <div class="op-interest">
                                                <input type="radio" id="option-interest-all" name="interest" value="all" @if($dating->type_select === 'all' or $dating->type_select === null) checked @endif>
                                                <label for="option-interest-all">Tất cả mọi người</label>
                                                <input type="radio" id="option-interest-interest" name="interest" value="interest"  @if($dating->type_select === 'interest') checked @endif>
                                                <label for="option-interest-interest">Theo sở thích</label>
                                            </div>
                                        </div> 
                                        <div class="zodiac item-select">
                                            <div class="title"><span>Cung hoàng đạo:</span></div>
                                            <select name="zodiac" id="zodiac">
                                                <option value="all">Chọn cung hoàng đạo</option>
                                                <option value="Bạch Dương">Bạch Dương</option>
                                                <option value="Kim Ngưu">Kim Ngưu</option>
                                                <option value="Song Tử" checked>Song Tử</option>
                                                <option value="Cự Giải">Cự Giải</option>
                                                <option value="Sư Tử">Sư Tử</option>
                                                <option value="Xử Nữ">Xử Nữ</option>
                                                <option value="Thiên Bình">Thiên Bình</option>
                                                <option value="Thiên Yết">Thiên Yết</option>
                                                <option value="Nhân Mã">Nhân Mã</option>
                                                <option value="Ma Kết">Ma Kết</option>
                                                <option value="Bảo Bình">Bảo Bình</option>
                                                <option value="Song Ngư">Song Ngư</option>
                                            </select>

                                        </div>
                                        <div class=""></div>
                                    </div>
                                </div>
                                <div class="content-footer">
                                    <div class="d-flex">
                                        <div class="btn-submit" id="submit-all-select">OK</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="render-user card-stack" id="card-stack">
                       
                    </div>
                @endif
            </div>
        </div>

       
        <div class="user_id" data-user-id="{{ $id }}"></div>
    </div>
    @include('modal.modal')
    
    <script src="{{ asset('js/notifications.js') }}"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="{{ asset('js/vi.js') }}"></script>
    <script src="{{ asset('js/check-in.js') }}"></script>
    <script>
        $(document).ready(function () {

            $('.null_school').click(function(){
                $('.add-school').css('display','block');
            })
            // ... (các phần code khác)

            // Lấy dữ liệu ban đầu và điền vào form

            var initialData = {!! json_encode($dating) !!}; // Đảm bảo dữ liệu JSON đã được truyền từ Laravel
            // 
            if (initialData) {
                // Điền dữ liệu vào các input và dropdown tương ứng
                $('#select-address').val(initialData.address);
                $('#min-birthday').text(initialData.min_age);
                $('#max-birthday').text(initialData.max_age);
                $('#option-money').val(initialData.money);
               
                
                // Điền giá trị cho các radio và checkbox
                $('input[name="lever"][value="' + initialData.lever + '"]').prop('checked', true);
                $('input[name="gender"][value="' + initialData.gender + '"]').prop('checked', true);
                $('input[name="interest"][value="' + initialData.type_select + '"]').prop('checked', true);
                $('#zodiac').val(initialData.zodiac);
            }
           

            // ... (các phần code khác)
        });
    </script>
    @if($user->ready_dating !== 0)
        <script>
            $(document).ready(function(){
                var address = $('#select-address').val();
                console.log(address);
                var minAge = null;
                var maxAge = null;
                var money =  $('#option-money').val();
                var lever = $('input[name="lever"]:checked').val();
                var gender = $('input[name="gender"]:checked').val();
                var stype_select = $('input[name="interest"]:checked').val();
                var zodiac = $('#zodiac').val();
                var id = {{ $id }}; 
                var saveUser;
                
                var i = 0;
                var work = JSON.parse(localStorage.getItem('work'));
                if (!work) {
                    // Nếu mảng work chưa tồn tại, tạo một mảng mới
                    work = [];
                }
                

                $('input[name="job-input"]').each(function(){
                                var checkboxValue = $(this).val();
                                console.log(work[checkboxValue])
                                if(work[checkboxValue]){
                                    $(this).prop('checked',true);
                                }
                })
                
                var listJob = @json($listJob);
                // console.log(listJob);

                $('#job').on('input', function () {
                    var values = $(this).val();
                    var checkValue = $.trim(values);

                    if (checkValue) {
                        $('#dropdown-list-job').css('display','block'); 
                        var results = listJob.filter(function (job) {
                            return job.name.toLowerCase().includes(checkValue.toLowerCase());
                        });

                        var html = '';
                        console.log(results);
                        $('#dropdown-list-job').empty();

                        if (results.length > 0) {
                            for (var i = 0; i < results.length; i += 3) {
                                html += '<div class="row">';
                                for (var j = i; j < i + 3 && j < results.length; j++) {
                                    var jobId = results[j].id;
                                    var option =
                                        '<input type="checkbox" id="check-box' + jobId + '" name="job-input" value="' + results[j].name + '" />' +
                                        '<label for="check-box' + jobId + '">' + results[j].name + '</label>';
                                    $('#dropdown-list-job').append(option);
                                }
                                html += '</div>';
                            }
                        }


                        
                        $('input[name="job-input"]').each(function () {
                            var checkboxValue = $(this).val();
                            if (work.includes(checkboxValue)) {
                                // Nếu checkboxValue tồn tại trong mảng work, kiểm tra checkbox
                                $(this).prop('checked', true);
                            }
                        });
                        
                        clickCheckbox();
                    }
                    else{
                        $('#dropdown-list-job').css('display','none');
                    }
                });

                // Bắt sự kiện "change" cho checkbox
                function clickCheckbox() {
                    // Bắt sự kiện "change" cho checkbox
                    $('input[name="job-input"]').change(function () {
                        var checkboxValue = $(this).val();
                        var isChecked = $(this).prop('checked');

                        if (isChecked) {
                            // Nếu checkbox được chọn, thêm giá trị vào mảng work
                            work.push(checkboxValue);
                        } else {
                            // Nếu checkbox bị bỏ chọn, loại bỏ giá trị khỏi mảng work
                            var index = work.indexOf(checkboxValue);
                            if (index > -1) {
                                work.splice(index, 1);
                            }
                        }

                        // Lưu mảng work vào local storage
                        localStorage.setItem('work', JSON.stringify(work));
                    });
                }

                
                // ***********************************


            
                                               
                $('#select-address').change(function(){
                    address = $(this).val();
                   
                });
    
                // nouislider birthday select user
                var slider_birthday = document.getElementById('range-slider2');
                var startBirthday = parseInt({{ $user->select_birthday }});
                var endBirthday = parseInt({{ $user->end_select_birthday }});
                var sliderValues = [startBirthday, endBirthday]; // Mảng chứa giá trị từ đầu bên này đến đầu bên kia
        
                noUiSlider.create(slider_birthday, {
                    start: sliderValues,
                                                range: {
                                                    'min': 16,
                                                    'max': 80
                                                },
                                                format: {
                                                    to: function(value) {
                                                        return parseInt(value); // Chuyển giá xtrị thành số nguyên
                                                    },
                                                    from: function(value) {
                                                        return parseInt(value); // Chuyển giá trị thành số nguyên
                                                    }
                                                }
                        });
        
                        slider_birthday.noUiSlider.on('update', function(values) {
                            minAge = parseInt(values[0]);
                            maxAge = parseInt(values[1]);
                                                
                            // Cập nhật giá trị hiển thị ra HTML
                        document.getElementById('min-birthday').textContent = ' '+  minAge + ' ';
                        document.getElementById('max-birthday').textContent = ' '+ maxAge + ' ';
    
                });
                $('#option-money').change(function(){
                    money = $(this).val();
                })
                
                $('input[name="lever"], input[name="gender"], input[name="interest"]').change(function(){
                    lever = $('input[name="lever"]:checked').val();
                    gender = $('input[name="gender"]:checked').val();
                    stype_select = $('input[name="interest"]:checked').val();
                });
                $('#zodiac').change(function(){
                    zodiac = $(this).val();
                })
               
                var arrayUserMatching = [] ;
                $.ajax({
                    url:'/matching-user',
                    type:'GET',
                    data:{
                        user_id : id,
                        address:address,
                        min_age: minAge,
                        max_age: maxAge,
                        money: money,
                        work: work,
                        lever: lever,
                        gender: gender,
                        type_select: stype_select,
                        zodiac: zodiac,
                    },
                    success:function(response){
                        var user = response.user;
                        if(user.length === 0 ){
                                $('.render-user').empty();
                                $('.render-user').append('<div class="null_user_matching"><h4>Hiện không có người dùng nào phù hợp</h4></div>')
                        }
                        else{
                            arrayUserMatching.push(user);
                            var i = 0;
                            var k = 0;
                            if (arrayUserMatching[0][i] && arrayUserMatching[0][i].avatar_photos && arrayUserMatching[0][i].avatar_photos.length > 0) {
                                k = arrayUserMatching[0][i].avatar_photos.length;
                            }
                            renderUser(i,k);
                                
                        }
                       
                    }
                })

                
                $('#submit-all-select').click(function(){
                    
                    $.ajax({
                        url:'/matching-user',
                        type:'GET',
                        data:{
                            user_id : id,
                            address:address,
                            min_age: minAge,
                            max_age: maxAge,
                            money: money,
                            work: work,
                            lever: lever,
                            gender: gender,
                            type_select: stype_select,
                            zodiac: zodiac,
                        },
                        success:function(response){
                           
                            var user = response.user;
                            if(user.length === 0 ){
                                    $('.render-user').empty();
                                    $('.render-user').append('<div class="null_user_matching"><h4>Hiện không có người dùng nào phù hợp</h4></div>')
                            }
                            else{
                                arrayUserMatching = [];
                                arrayUserMatching.push(user);
                                var i = 0;
                                var k = 0;
                                if (arrayUserMatching[0][i] && arrayUserMatching[0][i].avatar_photos && arrayUserMatching[0][i].avatar_photos.length > 0) {
                                    k = arrayUserMatching[0][i].avatar_photos.length;
                                }
                                renderUser(i,k);
                                    
                            }
                        }
                    })
                })
                

                function renderUser(i,k){
               
                    $('.render-user').empty();
                   
                    
                    var avatarUrl = '{{ asset("storage/users_avatar") }}' + '/' ;
                    if(k > 0){
                        
                        avatarUrl += arrayUserMatching[0][i].avatar_photos[k-1].image;
                    }
                    else{
                        avatarUrl +='guest-user-250x250.jpg';
                    }
                    
                                var slide = '';
                                    
                                if(arrayUserMatching[0][i].avatar_photos.length > 1){
                                    for (var j = arrayUserMatching[0][i].avatar_photos.length - 1; j>= 0 ; j--) {
                                        var active = '';
                                        if(k > 1){
                                            active = (j === k - 1) ? 'active' : ''; 
                                        }
                                        else{
                                            active = 'active';
                                        }

                                        slide += `
                                            <div class="slider-tabs tabs-${j} ${active}" data-tabs-id="${j}">
                                                <div class=""></div>
                                            </div>
                                        `;
                                    }
                                }
                                else{
                                    slide += `
                                        <div class="slider-tabs tabs-${j} active" data-tabs-id="${j}">
                                            <div class=""></div>
                                        </div>
                                    `;
                                }
                                var bigo = '';
                                if(arrayUserMatching[0][i].bigo !== null){
                                    bigo = arrayUserMatching[0][i].bigo;
                                }

                                var html = '<div class="box-content card" data-user-matching='+arrayUserMatching[0][i].id+' id="card-'+arrayUserMatching[0][i].id+'" style="background-image:url(' + avatarUrl + '); z-index:'+arrayUserMatching[0][i].id+';">' +
                                        '<div class="cnt-img">' +
                                            slide
                                        +'</div>' +
                                        '<div class="btn-nolike-userMatching d-none">'+
                                            '<div class="title"><h3>Bỏ qua</h3></div>'+
                                        '</div>'+
                                        '<div class="btn-like-userMatching d-none">'+
                                            '<div class="title"><h3>Thích</h3></div>'+
                                        '</div>'+
                                        '<div class="btn-trans d-flex">' +
                                        '<div class="btn-prev"><i class="bx bx-chevron-left" id="prevPhoto" title="Bỏ qua"></i></div>' +
                                        '<div class="btn-right"><i class="bx bx-chevron-right" id="nextPhoto" title="Thích"></i></div>' +
                                        '</div>' +
                                        '<div class="user ">' +
                                        '<div class="information-user-matching d-flex">' +
                                        '<div class="name">' +
                                        '<h5>' + arrayUserMatching[0][i].first_name + ' ' + arrayUserMatching[0][i].last_name + '</h5>' +
                                        '</div>' +
                                        '<div class="age"><h5>18</h5></div>' +
                                        '<div class="btn-information"><i class="bx bxs-info-circle" id="show-profile-modal" data-user-matching="'+ arrayUserMatching[0][i].id +'"></i></div>' +
                                        '</div>' +
                                        '<div class="bigo">' + bigo + '</div>' +
                                        '<div class="menu-btn-status d-flex">' +
                                        '<div class="btn-back item"><i class="bx bx-reset" id="btn-reset-user" data-card-id ="'+i+'"title="Quay lại đối tượng trước" ></i></div>' +
                                        '<div class="btn-closes item" >' +
                                        '<i class="bx bx-x" id="btn-part-user"  data-card-id ="'+i+'" data-user-matching="'+arrayUserMatching[0][i].id+'" title="Bỏ qua"></i>' +
                                        '</div>' +
                                        '<div class="btn-like item"><i class="bx bxs-heart" id="btn-like"data-card-id ="'+i+'"title="Thích người dùng"></i></div>' +
                                        '</div>' +
                                        '</div>' +
                                        '</div>';

                                $('.render-user').append(html);
                                menuEvent(i,k);
                }
               

                function menuEvent(i,k){

                    $('#show-profile-modal').click(function(){
                        var id = $(this).data('user-matching');

                        showModal(id,i);
                    })

                    
                    $('#btn-reset-user').click(function(){
                        $('#card-' + arrayUserMatching[0][i].id).css('opacity', '0');
                        $('#card-' + arrayUserMatching[0][i].id).css('transform', 'translateX(0)');
                                            setTimeout(function() {
                                                
                            resetUserMatching(i,k);
                        }, 500);
                        
                    })
                    $('#btn-part-user').click(function(){
                        $('#card-' + arrayUserMatching[0][i].id).css('opacity', '0');
                        $('#card-' + arrayUserMatching[0][i].id).css('transform', 'translateX(-100%)');
                        $('.btn-nolike-userMatching').removeClass('d-none');
                                            setTimeout(function() {
                            deleteUserMatching(i,k)
                        }, 500);
                   
                    })
                    $('#prevPhoto').click(function(){
                        prevPhoto(i,k);
                    })
                    $('#nextPhoto').click(function(){
                        nextPhoto(i,k);
                    })
                    $('#btn-like').click(function(){
                        $('#card-' + arrayUserMatching[0][i].id).css('opacity', '0');
                        $('#card-' + arrayUserMatching[0][i].id).css('transform', 'translateX(100%)');
                        $('.btn-like-userMatching').removeClass('d-none');
                                            setTimeout(function() {
                            likeUserMatching(i,k);
                        }, 500);
                    })
                }
                var userMatching = [];
                function showModal(id,i){


                    $('#modal-show-profile').css('display','block');
                    var fullname = arrayUserMatching[0][i].first_name + ' ' + arrayUserMatching[0][i].last_name
                    $('.add-name-user .nameusers').html(fullname)
                    if(arrayUserMatching[0][i].img_bg !== null){
                        $('.content-header-main .bg-user-matching img').attr('src',arrayUserMatching[0][i].img_bg);
                    }
                    var avatar = '{{ asset("storage/users_avatar") }}' + '/';
                    
                    if(arrayUserMatching[0][i].avatar !== null){
                        avatar += arrayUserMatching[0][i].avatar;
                        $('.content-header-main .avatar-user-matching img').attr('src',avatar);
                    }
                    else{
                        avatar += 'guest-user-250x250.jpg';
                        $('.content-header-main .avatar-user-matching img').attr('src',avatar);

                    }

                    $('.bigo-user-matching').html(arrayUserMatching[0][i].bigo);
                    $('.name-user-matching').html(fullname)

                    // check status dating
                    if(arrayUserMatching[0][i].compatible_requester.length > 0){
                        $('.btn-accept-like-matching').removeClass('d-none');
                        $('.btn-like-user-matching').addClass('d-none');
                    }
                    else if(arrayUserMatching[0][i].compatible_requested.length > 0){
                        $('.btn-unlike-user-matching').removeClass('d-none');
                        $('.btn-like-user-matching').addClass('d-none');
                       
                    }
                    else if(arrayUserMatching[0][i].compatible_requested.length === 0 && arrayUserMatching[0][i].compatible_requester.length === 0 ){
                        $('.btn-like-user-matching').removeClass('d-none');
                        $('.btn-accept-like-matching').addClass('d-none');
                        $('.btn-unlike-user-matching').addClass('d-none');
                    }
                    // add lever on modal
                    if(arrayUserMatching[0][i].lever !== null){
                        $('#lever-user-matching').empty();
                        var html = ` <div class="user-lever d-flex">
                                <div class="d-flex lever-not-null">
                                    <i class="bx bxs-graduation"></i>    

                                    <li class="not_null">
                                        Trình độ <span>${arrayUserMatching[0][i].lever}</span>
                                    </li>
                                </div>
                                <div class="btn-edit-lever "></div>
                            
                            </div>
                            <div class="btn-edit"></div>`;
                        $('#lever-user-matching').append(html);
                    }
                    else{
                        
                        $('#lever-user-matching').empty();
                    }

// add school on modal 
                    if(arrayUserMatching[0][i].school !== null){
                        $('#school-user-matching').empty();
                        var html = `<div class="d-flex school-user" style="width: 100%;">
                                                                                        <div class="not_null-user-school d-flex" style="flex:5;">
                                        <i class="bx bxs-graduation"></i>    

                                        <li class="not_null">
                                            Học tại <span>${arrayUserMatching[0][i].school}</span>
                                        </li>
                                   </div>
                                   <div class="btn-edit-school" style="flex:0;"></div>
                                
                                                                               </div>`;
                        $('#school-user-matching').append(html);
                    }
                    else{
                        $('#school-user-matching').empty();
                    }

                    // add address on modal 

                    if(arrayUserMatching[0][i].diachi !== null){
                        $('#address-user-matching').empty();
                        var html = `<div class="d-flex" style="flex: 1;">
                                    <i class="bx bx-home"></i>
                                    <li class="not_null">
                                        Sống tại <span>${arrayUserMatching[0][i].diachi}</span>
                                    </li>
                                </div>
                                <div class="btn-edit-address" style="flex: 0;">
                                    
                                </div>
                                                                       `;
                                                                       $('#address-user-matching').append(html)                                         
                    }
                    else{
                        $('#address-user-matching').empty();
                    }

                    // add work on modal 

                    if(arrayUserMatching[0][i].job !== null){
                        $('#work-user-matching').empty();
                        var html = `<div class="d-flex" style="flex: 1;">
                                <i class="bx bxs-briefcase"></i>
                                <li class="not_null">
                                    Công việc <span>${arrayUserMatching[0][i].job}</span>
                                </li>
                            </div>
                            <div class="btn-edit-work" style="flex: 0;"></div>`;
                        $('#work-user-matching').append(html);
                    }else{
                        $('#work-user-matching').empty();
                    }


                    // add salary on modal 
                    if(arrayUserMatching[0][i].meny !== null){
                        $('#salary-user-matching').empty();

                        var salary = '';
                        if(arrayUserMatching[0][i].meny === '0-3000')
                                                                salary ='<span>0 ~ 3 triệu</span>';
                                                            else if (arrayUserMatching[0][i].meny === '4000-7000')
                                                                salary = '<span>4 ~ 7 triệu</span>';
                                                            else if (arrayUserMatching[0][i].meny === '8000-12000')
                                                              salary = '<span>8 ~ 12 triệu</span>';
                                                            else if(arrayUserMatching[0][i].meny === '13000-24000')
                                                             salary = '<span>13 ~ 24 triệu</span>';
                                                            else if (arrayUserMatching[0][i].meny == '25000-30000')
                                                                salary = '<span>25 ~ 30 triệu</span>';
                                                            else if(arrayUserMatching[0][i].meny =='31000-40000')
                                                                 salary = '<span>31 ~ 40 triệu</span>';
                                                            else if(arrayUserMatching[0][i].meny =='41000-50000')
                                                                salary = '<span>41 ~ 50 triệu</span>';
                                                            else if(arrayUserMatching[0][i].meny === '51000-100000')
                                                                salary = '<span>51 ~ 100 triệu</span>';
                                                        
                        var html = ` <div class="d-flex" style="flex: 1;">
                                <i class="bx bxs-briefcase"></i>
                                <li class="not_null">
                                    Lương 
                                        ${salary}
                                                                                                
                                </li>
                            </div>
                            <div class="btn-edit-salary" style="flex: 0;"></div>`;  
                        $('#salary-user-matching').append(html); 
                    }else{
                        $('#salary-user-matching').empty();
                    }
                    // add zodiac on modal 

                    if(arrayUserMatching[0][i].zodiac !== null){
                        $('#zodiac-user-matching').empty();
                        var html = `<div class="d-flex" style="flex:1;">
                                <i class="bx bxs-moon"></i>
                            <li class="not_null">
                                Cung <span>${arrayUserMatching[0][i].zodiac}</span>
                            </li>
                            </div>
                            <div class="btn-edit-zodiac" style="flex:0;">
                                
                            </div>`;
                            $('#zodiac-user-matching').append(html);

                    }else{
                        $('#zodiac-user-matching').empty();
                    }

                    var listInterestingUserMatching = @json($listInteresting);

                    if (arrayUserMatching[0][i].interests.length > 0) {
                        var html = '';
                        $('#interest-user-matching').empty();

                        var interests = arrayUserMatching[0][i].interests;

                        for (var j = 0; j < interests.length; j++) {
                            for (var z = 0; z < listInterestingUserMatching.length; z++) {
                                if (interests[j].list_interest_id === listInterestingUserMatching[z].id) {
                                    html += `<div class="box-interest d-flex">
                            <li class="icon"><img width="40px" src="{{ asset('img/icon/') }}/${listInterestingUserMatching[z].icon}" alt="Icon"></li>
                            <li class="title">${listInterestingUserMatching[z].content}</li>
                        </div>`;
                                }
                            }
                            // Render 3 items một dòng
                            if ((j + 1) % 3 === 0 || j === interests.length - 1) {
                                html = '<div class="row">' + html + '</div>';
                                $('#interest-user-matching').append(html);
                                html = '';
                            }
                        }
                    } else {
                        $('#interest-user-matching').empty();
                    }

                    if(arrayUserMatching[0][i].zalo !== null){
                        $('#zalo-use-matching').empty();
                        var html =`<div class="d-flex" style="flex: 1;">
                                    <i class="bx bxs-phone"></i>
                                    <li class="not_null">Zalo: <span>${arrayUserMatching[0][i].zalo}</span></li>
                                </div>
                                <div class="edit-number-zalo" style="flex: 0;"></div>`;


                                $('#zalo-use-matching').append(html);
                    }else{
                        $('#zalo-use-matching').empty();
                    }
                    if(arrayUserMatching[0][i].link_ig !== null){
                        $('#instagram-user-matching').empty();
                        var html =`<div class="d-flex" style="flex: 1;">
                                    <i class="bx bxl-instagram-alt"></i>
                                <li class="not_null">Instagram: <span>${arrayUserMatching[0][i].link_ig}</span></li>
                                </div>
                                <div class="btn-edit-instagram" style="flex: 0;"></div>`;
                        $('#instagram-user-matching').append(html);
                    }else{
                        $('#instagram-user-matching').empty();
                    }
                    if(arrayUserMatching[0][i].link_fb !== null){
                        $('#facebook-user-matching').empty();
                        var html = `<div class="d-flex" style="flex: 1;">
                                    <i class="bx bxl-facebook-circle"></i>
                                    <li class="not_null" id="openPageButton" data-link-fb="${arrayUserMatching[0][i].link_fb}">Facebook: <span>${arrayUserMatching[0][i].link_fb}</span></li>
                                </div>
                                <div class="btn-edit-facebook" style="flex: 0;">
                                    
                                </div>`;
                                $('#facebook-user-matching').append(html);       
                    }else{
                        $('#facebook-user-matching').empty();
                    }
                    

                    $('#email-user-matching .not_null span').html(arrayUserMatching[0][i].email)
                    if (arrayUserMatching[0][i].photos.length > 0) {
                            $('#album-user-matching').empty();
                            var html = '';
                            for (var j = 0; j < arrayUserMatching[0][i].photos.length && j < 9; j += 3) {
                                html += '<div class="row">';
                                for (var z = j; z < j + 3 && z < arrayUserMatching[0][i].photos.length; z++) {
                                    var src = '';
                                    for (var l = 0; l < arrayUserMatching[0][i].posts.length; l++) {
                                        if (arrayUserMatching[0][i].photos[z].post_id === arrayUserMatching[0][i].posts[l].ID) {
                                            if (arrayUserMatching[0][i].posts[l].type_post === 'avatar') {
                                                src = `{{ asset("storage/users_avatar/") }}/${arrayUserMatching[0][i].photos[z].image}`;
                                            } else if (arrayUserMatching[0][i].posts[l].type_post === 'post') {
                                                src = `{{ asset("img/upload/") }}/${arrayUserMatching[0][i].photos[z].image}`;
                                            }
                                        }
                                    }
                                    html += `<div class="box-img">
                                        <img src="${src}" alt="">
                                    </div>`;
                                }
                                html += '</div>';
                            }
                            $('#album-user-matching').append(html);
                        }
                        else{
                        $('#album-user-matching').empty();
                        var html = '<h5 class="null_image" style="color:#b1b1b1 !important; text-align:center;">Hiện không có ảnh nào</h5>';
                        $('#album-user-matching').append(html);
                    }
                    

                    if (arrayUserMatching[0][i].friended.length > 0) {
                        var html = '';
                        $('#friend-user-matching').empty();

                        var promises = []; // To collect all promises

                        for (var j = 0; j < arrayUserMatching[0][i].friended.length && j < 9; j++) {
                            if (j % 3 === 0) {
                                // Start a new row for every 3 users
                                if (j > 0) {
                                    html += '</div>';
                                }
                                html += '<div class="row">';
                            }

                            (function(z) {
                                var promise;
                                if (arrayUserMatching[0][i].friended[z].requester_id !== arrayUserMatching[0][i].id && arrayUserMatching[0][i].friended[z].requested_id === arrayUserMatching[0][i].id) {
                                    promise = findUser(arrayUserMatching[0][i].friended[z].requester_id);
                                } else if (arrayUserMatching[0][i].friended[z].requester_id === arrayUserMatching[0][i].id && arrayUserMatching[0][i].friended[z].requested_id !== arrayUserMatching[0][i].id) {
                                    promise = findUser(arrayUserMatching[0][i].friended[z].requested_id);
                                }

                                if (promise) {
                                    promises.push(promise); // Collect the promises
                                }
                            })(j);
                        }

                        // Close the last row div
                        if (arrayUserMatching[0][i].friended.length > 0) {
                            html += '</div>';
                        }

                        // Wait for all promises to resolve
                        Promise.all(promises)
                            .then(function(users) {
                                var rowIdx = 0; // Track the current row index
                                
                                for (var n = 0; n < users.length; n++) {
                                    if (n % 3 === 0) {
                                        // Start a new row when the current index is a multiple of 3
                                        if (n > 0) {
                                            html += '</div>';
                                            rowIdx++;
                                        }
                                        html += '<div class="row">';
                                    }
                                    
                                    var avatarUserMatching = '{{ asset("storage/users_avatar") }}' + '/';
                                    if (users[n].avatar === null) {
                                        avatarUserMatching += 'guest-user-250x250.jpg';
                                    } else {
                                        avatarUserMatching += users[n].avatar;
                                    }

                                    html += `<div class="user">
                                        <div class="avt"><a href=""><img src="${avatarUserMatching}" alt=""></a></div>
                                        <div class="name"><a href="">${users[n].first_name} ${users[n].last_name}</a></div>
                                    </div>`;
                                }

                                // Close the last row div
                                if (users.length > 0) {
                                    html += '</div>';
                                }

                                // console.log(html);
                                $('#friend-user-matching').append(html);
                            });
                    }

                    // add post on modal
                        // if(arrayUserMatching[0][i].posts.length > 0){

                        //     $('.post-user-matching').empty();
                        //     var html = '';
                        //     for(var j = 0;j < arrayUserMatching[0][i].posts.length;j++){
                        //         for(var z = 0 ;z < arrayUserMatching[0][i].photos.length;z++){
                        //             if(arrayUserMatching[0][j].posts[j].ID === arrayUserMatching[0][i].photos[z].post_id){
                        //                 if(arrayUserMatching[0][i].posts[j].type_post === 'avatar'){

                        //                 }
                        //                 else if(arrayUserMatching[0][i].posts[j].type_post === 'post'){
                                            
                        //                 }
                        //             }
                        //         }
                        //     }
                        // }


                }
                function findUser(id) {
                    
                    return new Promise(function(resolve, reject) {
                        $.ajax({
                            url: 'search-user',
                            method: 'GET',
                            data: {
                                user_id: id,
                            },
                            success: function(response) {
                                var user = response.user;
                                resolve(user);
                            },
                            error: function(error) {
                                reject(error);
                            }
                        });
                    });
                }

                function resetUserMatching(i,k){
                    if(i > 0){
                        i--;
                        k = arrayUserMatching[0][i].avatar_photos.length;
                        renderUser(i,k);
                    }
                    else{
                        renderUser(0,k);
                    }
                }
                function deleteUserMatching(i,k){
                    if(i <= arrayUserMatching.length){
                        i++;
                        k = arrayUserMatching[0][i].avatar_photos.length;
                        renderUser(i,k);
                    }
                    else{

                    }
                }
                function likeUserMatching(i,k){
                    if(i <= arrayUserMatching.length){
                        var id = arrayUserMatching[0][i].id;
                        i++;
                        k = arrayUserMatching[0][i].avatar_photos.length;
                        renderUser(i.k);
                        $.ajax({
                            url:'/like-user',
                            method:'POST',
                            data:{
                                user_id:id,
                                '_token':'{{ csrf_token() }}',
                            },
                            success:function(data){

                            }
                        })
                    }
                }


                function prevPhoto(i,k){
                   
                    if(k == 0){
                            
                            renderUser(i,k);
                    }
                    else if(k > 0){
                        k++;
                        renderUser(i,k);
                    }
                    
                }


                function nextPhoto(i,k){
                    if(k > 0){
                        k--;
                        renderUser(i,k);
                    }
                    else if (k == 0){
                        renderUser(i,k);    
                    }
                        
             
               }
                
        })

        
        
        </script>
    
    @endif
    <script>
        $('.edit-information').on('click',function(){
                                                $('#modal-edit-information').toggle();
                                                var userId = $(this).data('user-id');
                                                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                                                
                                                $.ajax({
                                                    url: 'search-user',
                                                    type: 'GET',
                                                    data:{
                                                        user_id: userId,
                                                        _token: csrfToken
                                                    },
                                                    success:function(response){
                                                        // $('#content-main-modal-information').empty();
                                                        var user = response.user;
                                                        console.log(user);
                                                    }

                                                })
                                            });
                                                
                                            
                                            $('#close-modal-edit-information').on('click',function  (){
                                                $('#modal-edit-information').toggle();

                                            });

                                            $(document).ready(function(){
    
});
    </script>
    <script >
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
    <script>
        $(document).ready(function(){
            $('.filter').click(function(){
                $('.menu-filter-user').toggle();
            })
        })
    </script>

    <script>
        const container = $('#content-main-modal-information');
        const clickImghere = container.find('.avt img');
        const clickIconhere = container.find('.avt .icon-camera');
        clickImghere.click(function(){
            $('#dropdown-avatar').toggle();
        })
        clickIconhere.click(function(){
            $('#modal-update-avatar').addClass('d-block');
           
        })
        $('.update-avatar').click(function(){
            $('#modal-update-avatar').addClass('d-block');
            $('#dropdown-avatar').css('display','none');
        })
        $('#close-modal-update-avatar').click(function(){
            $('#modal-update-avatar').removeClass('d-block');
        })


    </script>
    {{-- <script src="{{ asset('js/check-in.js') }}"></script> --}}
</body>
</html>