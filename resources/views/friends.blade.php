@php 
    use Illuminate\Support\Collection;
    $id = Auth::user()->id;
    
    $user = auth()->user();
    $friend_ship = DB::table('friendship')
    ->join('user','user.id','=','friendship.requester_id')
    ->select('friendship.*','user.first_name','user.last_name','user.avatar','user.gender')
    ->where('friendship.status','pending')
    ->where('requested_id',$id)
    ->orderBy('friendship.created_at', 'desc')
    ->get();


    $max = 5;
    $arrayFriend = $friend_ship->toArray(); 
    $t = array_chunk($arrayFriend, $max);
    // dd($chunkedItems);
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('img/new_logo.png') }}" type = "image/x-icon">
    <title>Bạn bè | Bault</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href=" {{ asset('css/index.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/notifications.css') }}">
    <link rel="stylesheet" href="{{ asset('css/friends.css') }}">
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


        <div class="main d-flex">
            <div class="main-left ">
                <div class="header-title d-flex">
                    <h5>Bạn bè</h5>
                    <div class="icon-settings">
                        <i class='bx bxs-cog'></i>
                    </div>
                </div>
                <div class="menu container">
                    <li class="active d-flex">
                        <div class="icon">
                            <i class='bx bxs-user'></i>
                        </div>
                        <div class="title">
                            <span>Trang chủ</span>
                        </div>
                        
                    </li>
                    <a href="{{ route('friendship') }}">
                        <li class="d-flex">
                            <div class="icon">
                                <i class='bx bxs-user-plus'></i>
                            </div>
                            <div class="title"><span>Lời mời kết bạn</span></div>
                            <div class="icon-2"><i class='bx bx-chevron-right'></i></div>
                        </li>
                    </a>
                    <li class="d-flex">
                        <div class="icon">
                            <i class='bx bxs-user-plus'></i>
                        </div>
                        <div class="title">
                            <span> Gợi ý</span>
                        </div>
                        <div class="icon-2" style="margin-left: 191px"><i class='bx bx-chevron-right'></i></div>
                    </li>
                    <li class="d-flex">
                        <div class="icon">
                            <i class='bx bxs-send' ></i>
                        </div>
                        <div class="title">
                            <span>Lời mời đã gửi</span>
                        </div>
                        <div class="icon-2"style="margin-left: 119px"><i class='bx bx-chevron-right'></i></div>
                    </li>
                    <li class="d-flex">
                        <div class="icon">
                            <i class='bx bxs-user-detail'></i>
                        </div>
                        <div class="title"><span>Tất cả bạn bè</span></div>
                        <div class="icon-2" style="margin-left: 130px"><i class='bx bx-chevron-right'></i></div>
                    </li>
                </div>
            </div>
            <div class="main-right">
                <div class="show-friendship active container">
                    <div class="header-show-friendship d-flex">
                        <h5 class="">Lời mời kết bạn</h5>
                        <div class="title"><p>Xem tất cả lời mời</p></div>
                    </div>
                    <div class="block-show-add-friend">
                    @if($friend_ship)
                        @foreach ($t as $row)

                            <div class="row">
                                @foreach($row as $friend)
                                <div class="box-user" >
                                    <div class="user">
                                        <div class="avatar">
                                            @isset($friend->avatar)
                                                <a href="{{ route('profile',['id'=>$friend->requester_id]) }}"><li><img src="{{ asset('storage/users_avatar/' . $friend->avatar) }}" alt=""></li></a>
                                            @else
                                                <a href="{{ route('profile',['id'=>$friend->requester_id]) }}"><li><img src="{{ asset('storage/users_avatar/guest-user-250x250.jpg') }}"></li></a>
                                            @endisset
                                        </div>
                                        <div class="footer-user">
                                            <div class="information-user container d-flex">
                                                <div class="name ">
                                                    <a href="{{ route('profile',['id'=> $friend->requester_id]) }}"><li>{{ $friend->first_name }} {{ $friend->last_name }}</li></a>
                                                </div>
                                                <div class="gender-user">
                                                    @if($friend->gender === 'male')
                                                        <div class="gender">Nam</div>
                                                    
                                                    @elseif($friend->gender ==='famale')
                                                        <div class="gender">Nữ</div>
                                                    @else 
                                                        <div class="gender">Bí mật</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="btn-friend container">
                                                <div class="accepted" data-user-id="{{ $id }}" data-requester-id="{{ $friend->requester_id }}">
                                                    @csrf
                                                    <button>Chấp nhập</button>
                                                </div>
                                                <div class="erase" data-user-id="{{ $id }}" data-requester-id="{{ $friend->requester_id }}">
                                                    <button>Xóa</button>
                                                    @csrf
                                                </div>
                                                <div class="accept" style="display:none;">
                                                    <button>Đã chấp nhận lời mời...</button>
                                                </div>
                                                <div class="erased" style="display:none;">
                                                    <button>Đã từ chối lời mời...</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            
                            
                        @endforeach
                    @else
                        <h3>Hiện không có lời mời kết bạn nào</h3>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/notifications.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/check-in.js') }}"></script>
    <script src="{{ asset('js/vi.js') }}"></script>
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
            $('.accepted').on('click',function(){
                var userId = $(this).data('user-id');
                var requester_id = $(this).data('requester-id');
                $.ajax({
                    url: '/acceptedfriend',
                    type:'POST',
                    data:{
                        user_id: userId,
                        friend_ship: requester_id,
                        '_token': '{{ csrf_token() }}',
                    },
                    
                    success:function(response) {
                        $('.accepted').css('display','none');
                        $('.erase').css('display','none');
                        $('.accept').css('display','block');
                    },
                    error:function(){
                        console.log('lỗi rồi đại vương');
                    }

                })
            })
            $('.erase').on('click',function(){
                var userId = $(this).data('user-id');
                var requester_id = $(this).data('requester-id');
                $.ajax({
                    url:'/unfriend',
                    type:'POST',
                    data:{
                        user_id: userId,
                        friend_ship: requester_id,
                        '_token': '{{ csrf_token() }}',
                    },
                    
                    success:function(response) {
                        $('.accepted').css('display','none');
                        $('.erase').css('display','none');
                        $('.erased').css('display','block');
                    },
                    error:function(){
                        console.log('lỗi rồi đại vương');
                    },
                    
                })
            })
        })
    </script>
    
</body>
</html>