@php 
    $id = Auth::user()->id;
    $user = DB::table('user')->where('id',$id)->first();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tìm quanh bạn | Bault</title>
    <link rel="icon" href="{{ asset('img/new_logo.png') }}" type = "image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href=" {{ asset('css/index.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/notifications.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/around.css') }}">
    <!-- Bao gồm CSS của noUiSlider -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.css">

<!-- Bao gồm thư viện noUiSlider -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.js"></script>
</head>
<body>
    <div id="wapper" data-user-id="{{ $id }}" >
        @csrf 
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
                        <ul class="message-list"><li class="message-item">
                        <div class="message-avatar">
                        <img src="storage/users_avatar/332493083_571903534980119_5163269150813936355_n.jpg" alt="John">
                        </div>
                        <div class="message-content">
                        <div class="message-content-header">
                            <div class="message-sender">John</div>
                        </div>
                        <div class="message-content-footer d-flex">
                            <div class="message-body">Hello there!</div>
                            <div class="message-time">10:00 AM</div>
                        </div> 
                        </div>
                        
                    </li><li class="message-item">
                        <div class="message-avatar">
                        <img src="storage/users_avatar/332493083_571903534980119_5163269150813936355_n.jpg" alt="Mary">
                        </div>
                        <div class="message-content">
                        <div class="message-content-header">
                            <div class="message-sender">Mary</div>
                        </div>
                        <div class="message-content-footer d-flex">
                            <div class="message-body">How are you?</div>
                            <div class="message-time">11:30 AM</div>
                        </div> 
                        </div>
                        
                    </li><li class="message-item">
                        <div class="message-avatar">
                        <img src="storage/users_avatar/332493083_571903534980119_5163269150813936355_n.jpg" alt="Peter">
                        </div>
                        <div class="message-content">
                        <div class="message-content-header">
                            <div class="message-sender">Peter</div>
                        </div>
                        <div class="message-content-footer d-flex">
                            <div class="message-body">Can we meet tomorrow?</div>
                            <div class="message-time">2:45 PM</div>
                        </div> 
                        </div>
                        
                    </li>
                    </ul>
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

        <div class="main d-flex">
            <div class="left-main container fixed">
                @csrf
                <div class="content">
                    <div class="content-header">
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
                    </div>
                    <div class="main-content">
                        <div class="item resize">
                            <span>Khoảng cách:</span>
                            <div id="range-slider1"></div>
                            <p id="distance-value"></p>
                        </div>
                        @isset($user->select_gender)
                        <div class="item select-gender">
                            <label for="gender">Giới tính:</label>
                            <div class="gender-options">
                                <input class="sub-item" type="radio" id="male" name="gender" value="male" @if($user->select_gender==="male") @checked(true) @endif>
                                <label  for="male">Nam</label>
                                
                                <input class="sub-item" type="radio" id="female" name="gender" value="female"@if($user->select_gender==="female") @checked(true) @endif>
                                <label for="female">Nữ</label>
                                
                                <input class="sub-item" type="radio" id="other" name="gender" value="all"@if($user->select_gender==="all") @checked(true) @endif>
                                <label for="all">Tất cả</label>
                            </div>
                        </div>
                        @else
                        <div class="item select-gender">
                            <label for="gender">Giới tính:</label>
                            <div class="gender-options">
                                
                                    <input class="sub-item" type="radio" id="male" name="gender" value="male">
                                    <label  for="male">Nam</label>
                                
                               
                                    <input class="sub-item" type="radio" id="female" name="gender" value="female">
                                    <label for="female">Nữ</label>
                                
                               
                                    <input class="sub-item" type="radio" id="other" name="gender" value="all">
                                    <label for="all">Tất cả</label>
                                
                            </div>
                        </div>
                        @endisset
                        <div class="item birth-day">
                            <p>Độ tuổi:</p>
                            <div id="range-slider2"></div>
                            <div class="select_birthday d-flex">
                                
                                <div id="min-birthday"> </div>
                                <p> - </p>
                                <div id="max-birthday"> </div>
                                <p> tuổi</p>
                            </div>
                        </div>
                        <div class="item select-stype">
                            <label for="stype">Tìm bạn theo:</label>
                            <div class="stype-options1">
                                
                                    <input class="sub-item" type="radio" id="all-stype" name="stype" value="all-stype" @if($user->select_type==="all-stype") @checked(true) @endif>
                                    <label for="all-stype">Tất cả mọi người</label>
                              
                                
                                    <input class="sub-item" type="radio" id="stype-interest" name="stype" value="follow_interest" @if($user->select_type==="follow_interest") @checked(true) @endif>
                                    <label for="follow_interest">Sở thích</label>
                                
                            </div>
                        </div>
                        <div class="item who-select">
                            <label for="stype">Ai có thể tìm thấy bạn:</label>
                            <div class="stype-options2">
                                
                                    
                                    <input class="sub-item" type="radio" id="all-stype" name="who" value="male-select" @if($user->who_select==='male-select') @checked(true) @endif>
                                    <label for="male-select">Nam</label>
                                
                                    <input class="sub-item" type="radio" id="stype" name="who" value="female-select" @if($user->who_select==='female-select') @checked(true) @endif>
                                    <label for="female-select">Nữ</label>
                                    <input class="sub-item" type="radio" id="all-stype" name="who" value="all-select" @if($user->who_select==='all-select') @checked(true) @endif>
                                    <label for="all-select">Tất cả</label>
                                
                            </div>
                        </div>
                        <div class="item erase-location">
                            <button>Xóa vị trí</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-right">
                <div class="content">
                    <div id="user-list">

                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/check-in.js') }}"></script>
    <script src="{{ asset('js/vi.js') }}"></script>
    
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    
   
    
        

    
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
    <script src="{{ asset('js/notifications.js') }}"></script>
    <script>
        var userId = $('#wapper').data('user-id');
                $.ajax({
                    url: '/select-user',
                    type:"GET",
                    dataType: 'json', // Kiểu dữ liệu trả về
                    data:{
                        user_id:userId,
                        '_token': '{{ csrf_token() }}'

                    },
                    success: function(response) {
                        // Xử lý dữ liệu trả về từ server
                        if (response.success) {
                            // Nếu thành công
                            if (response.status === 'addInterest') {
                                alert('Vui lòng thêm ít nhất 3 sở thích trước.');
                            } else {
                                var users = response.user;
                                var userAge = response.userage;
                                var statusFriend = response.statusFriendship;
                                $('#user-list').empty();

                                for (var i = 0; i < users.length; i++) {
                                    var user = users[i];
                                    var userage = userAge[user.id];
                                    var distance = user.distance.toFixed(1);
                                    var status = statusFriend[user.id];
                                    console.log(user.id);
                                    var userHtml = '<div class="box-user">' ;
                                    userHtml +='<div class="user">'+
                                    
                                        '<div class="avatar">';
                                            if (user.avatar !== null) {
                                                userHtml += '<a href="'+ '{{ url("profile/") }}'+'/' +  user.id +'"><li><img src="' + '{{ asset("storage/users_avatar/") }}' + '/' + user.avatar + '" alt="Avatar"></a>';
                                            } else {
                                                userHtml += '<a href="'+ '{{ url("profile/") }}'+'/' +  user.id +'"><li><img src="{{ asset("storage/users_avatar/guest-user-250x250.jpg") }}" alt="Avatar"></a>';
                                            }
                                    userHtml += '</div>'+
                                        '<div class="footer-user container">'+
                                            '<div class="information-user">'+
                                                '<div class="name"><a href="'+ '{{ url("profile/") }}'+'/' +  user.id +'"><li>' + user.first_name + ' ' + user.last_name + '</li></a></div>';
                                            
                                    if(user.gender === 'male'){
                                        userHtml += '<div class="gender">Nam</div>';
                                    }
                                    else if(user.gender ==='female'){
                                        userHtml += '<div class="gender">Nữ</div>';
                                    }
                                    else {
                                        userHtml += '<div class="gender">Bí mật</div>';
                                    }
                                    userHtml +='<p class="user-age">' + userage + 't</p>';
                                    
                                    
                                    userHtml += '</div>';
                                    userHtml += '<p class="user-distance">' + distance + ' km</p>';

                                    if (user.bigo !== null) {
                                        userHtml += '<p class="user-bigo">' + user.bigo + '</p>';
                                    }


                                    if (status === 'noFriend') {
                                        userHtml += '<div class="add-friends">' +
                                            '<i class="bx bxs-user-plus bx-flip-horizontal"></i>' +
                                            '<div class="title">Kết bạn</div>' +
                                            '</div>';
                                    } else if (status === 'Friend') {
                                        userHtml += '<div class="friend-accepted item d-flex">' +
                                            '<i class="bx bxs-user-check"></i>' +
                                            '<div class="title">Bạn bè</div>' +
                                            '</div>';
                                    } else if (status === 'friendPending') {
                                        userHtml += '<div class="friend-pending item d-flex">' +
                                            '<i class="bx bxs-user-x"></i>' +
                                            '<div class="title">Hủy lời mời</div>' +
                                            '</div>';
                                    }
                                    else if(status ==='acceptedFriend'){
                                        userHtml +='<div class="btn-friend">'+
                                                '<div class="accepted" data-user-id="" data-requester-id="">'+
                                                    '@csrf'+                                                   
                                                    '<button>Chấp nhập</button>'+
                                                '</div>'+
                                                '<div class="erase" data-user-id="" data-requester-id="">'+
                                                   '<button>Xóa</button>'+
                                                    '@csrf'+                                                
                                                '</div>'+
                                                '<div class="accept" style="display:none;">'+
                                                    '<button>Đã chấp nhận lời mời...</button>'+
                                                '</div>'+
                                                '<div class="erased" style="display:none;">'+
                                                    '<button>Đã từ chối lời mời...</button>'+
                                                '</div>'+
                                            '</div>';
                                    }
                                    userHtml += '</div>';
                                    userHtml += '</div>';
                                    $('#user-list').append(userHtml);
                                }
                            }
                        } else {
                            // Xử lý khi có lỗi từ server
                            alert('Có lỗi xảy ra. Vui lòng thử lại sau.');
                        }
                    },
                    error: function() {
                        // Xử lý khi có lỗi xảy ra trong quá trình gửi request
                        alert('Có lỗi xảy ra. Vui lòng thử lại sau.');
                    }
                })
    </script>
    <script>
        $(document).ready(function() {
            $('input[name="who"]').on('change', function() {
                var userId = $('#wapper').data('user-id');
                var whoselected = $(this).val();

                console.log('Giới tính được chọn: ' + whoselected);

                $.ajax({
                    url: '/save-whoselect',
                    type: 'POST',
                    data: {
                        user_id: userId,
                        who_selected: whoselected,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log('Đã gửi dữ liệu thành công');
                    },
                    error: function(xhr, status, error) {
                        console.log('Lỗi khi gửi dữ liệu: ' + error);
                    }
                });
                
            });
            $.ajax({
                    url: '/select-user',
                    type:"GET",
                    dataType: 'json', // Kiểu dữ liệu trả về
                    data:{
                        user_id:userId,
                        '_token': '{{ csrf_token() }}'

                    },
                    success: function(response) {
                        // Xử lý dữ liệu trả về từ server
                        if (response.success) {
                            // Nếu thành công
                            if (response.status === 'addInterest') {
                                alert('Vui lòng thêm ít nhất 3 sở thích trước.');
                            } else {
                                var users = response.user;
                                var userAge = response.userage;
                                var statusFriend = response.statusFriendship;
                                $('#user-list').empty();

                                for (var i = 0; i < users.length; i++) {
                                    var user = users[i];
                                    var userage = userAge[user.id];
                                    var distance = user.distance.toFixed(1);
                                    var status = statusFriend[user.id];
                                    
                                    var userHtml = '<div class="box-user">' ;
                                    userHtml +='<div class="user">'+
                                    
                                        '<div class="avatar">';
                                            if (user.avatar !== null) {
                                                userHtml += '<a href="'+ '{{ url("profile/") }}'+'/' +  user.id +'"><li><img src="' + '{{ asset("storage/users_avatar/") }}' + '/' + user.avatar + '" alt="Avatar"></a>';
                                            } else {
                                                userHtml += '<a href="'+ '{{ url("profile/") }}'+'/' +  user.id +'"><li><img src="{{ asset("storage/users_avatar/guest-user-250x250.jpg") }}" alt="Avatar"></a>';
                                            }
                                            userHtml += '</div>'+
                                        '<div class="footer-user container">'+
                                            '<div class="information-user">'+
                                                '<div class="name"><a href="'+ '{{ url("profile/") }}'+'/' +  user.id +'"><li>' + user.first_name + ' ' + user.last_name + '</li></a></div>';
                                            
                                    if(user.gender === 'male'){
                                        userHtml += '<div class="gender">Nam</div>';
                                    }
                                    else if(user.gender ==='female'){
                                        userHtml += '<div class="gender">Nữ</div>';
                                    }
                                    else {
                                        userHtml += '<div class="gender">Bí mật</div>';
                                    }
                                    userHtml +='<p class="user-age">' + userage + 't</p>';
                                    
                                    
                                    userHtml += '</div>';
                                    userHtml += '<p class="user-distance">' + distance + ' km</p>';

                                    if (user.bigo !== null) {
                                        userHtml += '<p class="user-bigo">' + user.bigo + '</p>';
                                    }
                                    
                                    if (status === 'noFriend') {
                                        userHtml += '<div class="add-friends">' +
                                            '<i class="bx bxs-user-plus bx-flip-horizontal"></i>' +
                                            '<div class="title">Kết bạn</div>' +
                                            '</div>';
                                    } else if (status === 'Friend') {
                                        userHtml += '<div class="friend-accepted item d-flex">' +
                                            '<i class="bx bxs-user-check"></i>' +
                                            '<div class="title">Bạn bè</div>' +
                                            '</div>';
                                    } else if (status === 'friendPending') {
                                        userHtml += '<div class="friend-pending item d-flex">' +
                                            '<i class="bx bxs-user-x"></i>' +
                                            '<div class="title">Hủy lời mời</div>' +
                                            '</div>';
                                    }
                                    else if(status ==='acceptedFriend'){
                                        userHtml +='<div class="btn-friend ">'+
                                                '<div class="accepted" data-user-id="{{ $id }}" data-requester-id="'+user.id+'">'+
                                                    '@csrf'+                                                   
                                                    '<button>Chấp nhập</button>'+
                                                '</div>'+
                                                '<div class="erase" data-user-id="{{ $id }}" data-requester-id="'+user.id+'">'+
                                                   '<button>Xóa</button>'+
                                                    '@csrf'+                                                
                                                '</div>'+
                                                '<div class="accept" style="display:none;">'+
                                                    '<button>Đã chấp nhận lời mời...</button>'+
                                                '</div>'+
                                                '<div class="erased" style="display:none;">'+
                                                    '<button>Đã từ chối lời mời...</button>'+
                                                '</div>'+
                                            '</div>';
                                    }
                                    userHtml += '</div>';
                                    userHtml += '</div>';
                                    $('#user-list').append(userHtml);
                                }
                            }
                        } else {
                            // Xử lý khi có lỗi từ server
                            alert('Có lỗi xảy ra. Vui lòng thử lại sau.');
                        }
                    },
                    error: function() {
                        // Xử lý khi có lỗi xảy ra trong quá trình gửi request
                        alert('Có lỗi xảy ra. Vui lòng thử lại sau.');
                    }
                })
        });
    </script>
    <script>

        $(document).ready(function() {
            $('input[name="stype"]').on('change', function() {
                var userId = $('#wapper').data('user-id');
                var selectedStype = $(this).val();

                console.log('Giới tính được chọn: ' + selectedStype);

                $.ajax({
                    url: '/save-stype',
                    type: 'POST',
                    data: {
                        user_id: userId,
                        stypeSelect: selectedStype,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log('Đã gửi dữ liệu thành công');
                    },
                    error: function(xhr, status, error) {
                        console.log('Lỗi khi gửi dữ liệu: ' + error);
                    }
                });

                $.ajax({
                    url: '/select-user',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        user_id: userId,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            if (response.status === 'addInterest') {
                                alert('Vui lòng thêm ít nhất 3 sở thích trước.');
                            } else {
                                var users = response.user;
                                var userAge = response.userage;
                                var statusFriend = response.statusFriendship;
                                $('#user-list').empty();

                                for (var i = 0; i < users.length; i++) {
                                    var user = users[i];
                                    var userage = userAge[user.id];
                                    var distance = user.distance.toFixed(1);
                                    var status = statusFriend[user.id];
                                    
                                    var userHtml = '<div class="box-user">' ;
                                    userHtml +='<div class="user">'+
                                    
                                        '<div class="avatar">';
                                            if (user.avatar !== null) {
                                                userHtml += '<a href="'+ '{{ url("profile/") }}'+'/' +  user.id +'"><li><img src="' + '{{ asset("storage/users_avatar/") }}' + '/' + user.avatar + '" alt="Avatar"></a>';
                                            } else {
                                                userHtml += '<a href="'+ '{{ url("profile/") }}'+'/' +  user.id +'"><li><img src="{{ asset("storage/users_avatar/guest-user-250x250.jpg") }}" alt="Avatar"></a>';
                                            }
                                    userHtml += '</div>'+
                                        '<div class="footer-user container">'+
                                            '<div class="information-user">'+
                                                '<div class="name"><a href="'+ '{{ url("profile/") }}'+'/' +  user.id +'"><li>' + user.first_name + ' ' + user.last_name + '</li></a></div>';
                                            
                                    if(user.gender === 'male'){
                                        userHtml += '<div class="gender">Nam</div>';
                                    }
                                    else if(user.gender ==='female'){
                                        userHtml += '<div class="gender">Nữ</div>';
                                    }
                                    else {
                                        userHtml += '<div class="gender">Bí mật</div>';
                                    }
                                    userHtml +='<p class="user-age">' + userage + 't</p>';
                                    
                                    
                                    userHtml += '</div>';
                                    userHtml += '<p class="user-distance">' + distance + ' km</p>';

                                    if (user.bigo !== null) {
                                        userHtml += '<p class="user-bigo">' + user.bigo + '</p>';
                                    }
                                    
                                    if (status === 'noFriend') {
                                        userHtml += '<div class="add-friends">' +
                                            '<i class="bx bxs-user-plus bx-flip-horizontal"></i>' +
                                            '<div class="title">Kết bạn</div>' +
                                            '</div>';
                                    } else if (status === 'Friend') {
                                        userHtml += '<div class="friend-accepted item d-flex">' +
                                            '<i class="bx bxs-user-check"></i>' +
                                            '<div class="title">Bạn bè</div>' +
                                            '</div>';
                                    } else if (status === 'friendPending') {
                                        userHtml += '<div class="friend-pending item d-flex">' +
                                            '<i class="bx bxs-user-x"></i>' +
                                            '<div class="title">Hủy lời mời</div>' +
                                            '</div>';
                                    }
                                    else if(status ==='acceptedFriend'){
                                        userHtml +='<div class="btn-friend ">'+
                                                '<div class="accepted" data-user-id="{{ $id }}" data-requester-id="'+user.id+'">'+
                                                    '@csrf'+                                                   
                                                    '<button>Chấp nhập</button>'+
                                                '</div>'+
                                                '<div class="erase" data-user-id="{{ $id }}" data-requester-id="'+user.id+'">'+
                                                   '<button>Xóa</button>'+
                                                    '@csrf'+                                                
                                                '</div>'+
                                                '<div class="accept" style="display:none;">'+
                                                    '<button>Đã chấp nhận lời mời...</button>'+
                                                '</div>'+
                                                '<div class="erased" style="display:none;">'+
                                                    '<button>Đã từ chối lời mời...</button>'+
                                                '</div>'+
                                            '</div>';
                                    }
                                    userHtml += '</div>';
                                    userHtml += '</div>';
                                    $('#user-list').append(userHtml);
                                }
                            }
                        } else {
                            alert('Có lỗi xảy ra. Vui lòng thử lại sau.');
                        }
                    },
                    error: function() {
                        alert('Có lỗi xảy ra. Vui lòng thử lại sau.');
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('input[name="gender"]').on('change', function() {
                var userId = $('#wapper').data('user-id');
                var selectedGender = $(this).val();

                console.log('Giới tính được chọn: ' + selectedGender);

                $.ajax({
                    url: '/save-gender',
                    type: 'POST',
                    data: {
                        user_id: userId,
                        gender: selectedGender,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log('Đã gửi dữ liệu thành công');
                    },
                    error: function(xhr, status, error) {
                        console.log('Lỗi khi gửi dữ liệu: ' + error);
                    }
                });
                $.ajax({
                    url: '/select-user',
                    type:"GET",
                    dataType: 'json', // Kiểu dữ liệu trả về
                    data:{
                        user_id:userId,
                        '_token': '{{ csrf_token() }}'

                    },
                    success: function(response) {
                        // Xử lý dữ liệu trả về từ server
                        if (response.success) {
                            // Nếu thành công
                            if (response.status === 'addInterest') {
                                alert('Vui lòng thêm ít nhất 3 sở thích trước.');
                            } else {
                                var users = response.user;
                                var userAge = response.userage;
                                var statusFriend = response.statusFriendship;
                                $('#user-list').empty();

                                for (var i = 0; i < users.length; i++) {
                                    var user = users[i];
                                    var userage = userAge[user.id];
                                    var distance = user.distance.toFixed(1);
                                    var status = statusFriend[user.id];
                                    
                                    var userHtml = '<div class="box-user">' ;
                                    userHtml +='<div class="user">'+
                                    
                                        '<div class="avatar">';
                                            if (user.avatar !== null) {
                                                userHtml += '<a href="'+ '{{ url("profile/") }}'+'/' +  user.id +'"><li><img src="' + '{{ asset("storage/users_avatar/") }}' + '/' + user.avatar + '" alt="Avatar"></a>';
                                            } else {
                                                userHtml += '<a href="'+ '{{ url("profile/") }}'+'/' +  user.id +'"><li><img src="{{ asset("storage/users_avatar/guest-user-250x250.jpg") }}" alt="Avatar"></a>';
                                            }
                                            userHtml += '</div>'+
                                        '<div class="footer-user container">'+
                                            '<div class="information-user">'+
                                                '<div class="name"><a href="'+ '{{ url("profile/") }}'+'/' +  user.id +'"><li>' + user.first_name + ' ' + user.last_name + '</li></a></div>';
                                            
                                    if(user.gender === 'male'){
                                        userHtml += '<div class="gender">Nam</div>';
                                    }
                                    else if(user.gender ==='female'){
                                        userHtml += '<div class="gender">Nữ</div>';
                                    }
                                    else {
                                        userHtml += '<div class="gender">Bí mật</div>';
                                    }
                                    userHtml +='<p class="user-age">' + userage + 't</p>';
                                    
                                    
                                    userHtml += '</div>';
                                    userHtml += '<p class="user-distance">' + distance + ' km</p>';

                                    if (user.bigo !== null) {
                                        userHtml += '<p class="user-bigo">' + user.bigo + '</p>';
                                    }
                                    
                                    if (status === 'noFriend') {
                                        userHtml += '<div class="add-friends">' +
                                            '<i class="bx bxs-user-plus bx-flip-horizontal"></i>' +
                                            '<div class="title">Kết bạn</div>' +
                                            '</div>';
                                    } else if (status === 'Friend') {
                                        userHtml += '<div class="friend-accepted item d-flex">' +
                                            '<i class="bx bxs-user-check"></i>' +
                                            '<div class="title">Bạn bè</div>' +
                                            '</div>';
                                    } else if (status === 'friendPending') {
                                        userHtml += '<div class="friend-pending item d-flex">' +
                                            '<i class="bx bxs-user-x"></i>' +
                                            '<div class="title">Hủy lời mời</div>' +
                                            '</div>';
                                    }
                                    else if(status ==='acceptedFriend'){
                                        userHtml +='<div class="btn-friend ">'+
                                                '<div class="accepted" data-user-id="{{ $id }}" data-requester-id="'+user.id+'">'+
                                                    '@csrf'+                                                   
                                                    '<button>Chấp nhập</button>'+
                                                '</div>'+
                                                '<div class="erase" data-user-id="{{ $id }}" data-requester-id="'+user.id+'">'+
                                                   '<button>Xóa</button>'+
                                                    '@csrf'+                                                
                                                '</div>'+
                                                '<div class="accept" style="display:none;">'+
                                                    '<button>Đã chấp nhận lời mời...</button>'+
                                                '</div>'+
                                                '<div class="erased" style="display:none;">'+
                                                    '<button>Đã từ chối lời mời...</button>'+
                                                '</div>'+
                                            '</div>';
                                    }
                                    userHtml += '</div>';
                                    userHtml += '</div>';
                                    $('#user-list').append(userHtml);
                                }
                            }
                        } else {
                            // Xử lý khi có lỗi từ server
                            alert('Có lỗi xảy ra. Vui lòng thử lại sau.');
                        }
                    },
                    error: function() {
                        // Xử lý khi có lỗi xảy ra trong quá trình gửi request
                        alert('Có lỗi xảy ra. Vui lòng thử lại sau.');
                    }
                })
            });
        });

    </script>
    <script>
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
                    return parseInt(value); // Chuyển giá trị thành số nguyên
                },
                from: function(value) {
                    return parseInt(value); // Chuyển giá trị thành số nguyên
                }
            }
        });

        slider_birthday.noUiSlider.on('update', function(values) {
            var minValue = parseInt(values[0]);
            var maxValue = parseInt(values[1]);
            
            // Cập nhật giá trị hiển thị ra HTML
            document.getElementById('min-birthday').textContent = ' '+  minValue + ' ';
            document.getElementById('max-birthday').textContent = ' '+ maxValue + ' ';
        });

        slider_birthday.noUiSlider.on('change', function(values) {
            var minValue = parseInt(values[0]);
            var maxValue = parseInt(values[1]);
            var userId = $('#wapper').data('user-id');
            
            console.log('Giá trị từ đầu bên này đến đầu bên kia: ' + minValue + ' - ' + maxValue);

            // Gửi giá trị khoảng cách lên server bằng Ajax
            $.ajax({
                url: '/save-birthday',
                type: 'POST',
                data: {
                    user_id: userId,
                    start_birthday: minValue,
                    end_birthday: maxValue,
                    '_token': '{{ csrf_token() }}',
                },
                success: function(response) {
                    console.log('Đã gửi giá trị thành công');
                },
                error: function(xhr, status, error) {
                    console.log('Lỗi khi gửi giá trị: ' + error);
                }
            });
            $.ajax({
                    url: '/select-user',
                    type:"GET",
                    dataType: 'json', // Kiểu dữ liệu trả về
                    data:{
                        user_id:userId,
                        '_token': '{{ csrf_token() }}'

                    },
                    success: function(response) {
                        // Xử lý dữ liệu trả về từ server
                        if (response.success) {
                            // Nếu thành công
                            if (response.status === 'addInterest') {
                                alert('Vui lòng thêm ít nhất 3 sở thích trước.');
                            } else {
                                var users = response.user;
                                var userAge = response.userage;
                                var statusFriend = response.statusFriendship;
                                $('#user-list').empty();

                                for (var i = 0; i < users.length; i++) {
                                    var user = users[i];
                                    var userage = userAge[user.id];
                                    var distance = user.distance.toFixed(1);
                                    var status = statusFriend[user.id];
                                    
                                    var userHtml = '<div class="box-user">' ;
                                    userHtml +='<div class="user">'+
                                    
                                        '<div class="avatar">';
                                            if (user.avatar !== null) {
                                                userHtml += '<a href="'+ '{{ url("profile/") }}'+'/' +  user.id +'"><li><img src="' + '{{ asset("storage/users_avatar/") }}' + '/' + user.avatar + '" alt="Avatar"></a>';
                                            } else {
                                                userHtml += '<a href="'+ '{{ url("profile/") }}'+'/' +  user.id +'"><li><img src="{{ asset("storage/users_avatar/guest-user-250x250.jpg") }}" alt="Avatar"></a>';
                                            }
                                            userHtml += '</div>'+
                                        '<div class="footer-user container">'+
                                            '<div class="information-user">'+
                                                '<div class="name"><a href="'+ '{{ url("profile/") }}'+'/' +  user.id +'"><li>' + user.first_name + ' ' + user.last_name + '</li></a></div>';
                                            
                                    if(user.gender === 'male'){
                                        userHtml += '<div class="gender">Nam</div>';
                                    }
                                    else if(user.gender ==='female'){
                                        userHtml += '<div class="gender">Nữ</div>';
                                    }
                                    else {
                                        userHtml += '<div class="gender">Bí mật</div>';
                                    }
                                    userHtml +='<p class="user-age">' + userage + 't</p>';
                                    
                                    
                                    userHtml += '</div>';
                                    userHtml += '<p class="user-distance">' + distance + ' km</p>';

                                    if (user.bigo !== null) {
                                        userHtml += '<p class="user-bigo">' + user.bigo + '</p>';
                                    }
                                    
                                    if (status === 'noFriend') {
                                        userHtml += '<div class="add-friends">' +
                                            '<i class="bx bxs-user-plus bx-flip-horizontal"></i>' +
                                            '<div class="title">Kết bạn</div>' +
                                            '</div>';
                                    } else if (status === 'Friend') {
                                        userHtml += '<div class="friend-accepted item d-flex">' +
                                            '<i class="bx bxs-user-check"></i>' +
                                            '<div class="title">Bạn bè</div>' +
                                            '</div>';
                                    } else if (status === 'friendPending') {
                                        userHtml += '<div class="friend-pending item d-flex">' +
                                            '<i class="bx bxs-user-x"></i>' +
                                            '<div class="title">Hủy lời mời</div>' +
                                            '</div>';
                                    }
                                    else if(status ==='acceptedFriend'){
                                        userHtml +='<div class="btn-friend ">'+
                                                '<div class="accepted" data-user-id="{{ $id }}" data-requester-id="'+user.id+'">'+
                                                    '@csrf'+                                                   
                                                    '<button>Chấp nhập</button>'+
                                                '</div>'+
                                                '<div class="erase" data-user-id="{{ $id }}" data-requester-id="'+user.id+'">'+
                                                   '<button>Xóa</button>'+
                                                    '@csrf'+                                                
                                                '</div>'+
                                                '<div class="accept" style="display:none;">'+
                                                    '<button>Đã chấp nhận lời mời...</button>'+
                                                '</div>'+
                                                '<div class="erased" style="display:none;">'+
                                                    '<button>Đã từ chối lời mời...</button>'+
                                                '</div>'+
                                            '</div>';
                                    }
                                    userHtml += '</div>';
                                    userHtml += '</div>';
                                    $('#user-list').append(userHtml);
                                }
                            }
                        } else {
                            // Xử lý khi có lỗi từ server
                            alert('Có lỗi xảy ra. Vui lòng thử lại sau.');
                        }
                    },
                    error: function() {
                        // Xử lý khi có lỗi xảy ra trong quá trình gửi request
                        alert('Có lỗi xảy ra. Vui lòng thử lại sau.');
                    }
                })
        });

    </script>
    
    <script>
        // Lấy phần tử chứa thanh x-ray
        var slider = document.getElementById('range-slider1');
        
        // Lấy giá trị bắt đầu từ server
        var startValue = {{ $user->resize }};
        
        // Khởi tạo thanh x-ray với một đầu trượt và giá trị bắt đầu từ server
        noUiSlider.create(slider, {
            start: startValue, // Giá trị ban đầu cho đầu trượt
            range: {
                'min': 0, // Giá trị tối thiểu
                'max': 100 // Giá trị tối đa
            }
            
        });
        
    
        // Xử lý sự kiện khi giá trị của thanh x-ray thay đổi
        slider.noUiSlider.on('change', function (values, handle) {
            var value = values[handle];
            var userId = $('#wapper').data('user-id');
            console.log('Giá trị: ' + value);
            // Gửi giá trị khoảng cách lên server bằng Ajax
            $.ajax({
                url: '/save-distance',
                type: 'POST',
                data: {
                    user_id: userId,
                    distance: value,
                    '_token': '{{ csrf_token() }}',
                },
                success: function(response) {
                    console.log('Đã gửi giá trị khoảng cách thành công');
                },
                error: function(xhr, status, error) {
                    console.log('Lỗi khi gửi giá trị khoảng cách: ' + error);
                }
            });
            $.ajax({
                    url: '/select-user',
                    type:"GET",
                    dataType: 'json', // Kiểu dữ liệu trả về
                    data:{
                        user_id:userId,
                        '_token': '{{ csrf_token() }}'

                    },
                    success: function(response) {
                        // Xử lý dữ liệu trả về từ server
                        if (response.success) {
                            // Nếu thành công
                            if (response.status === 'addInterest') {
                                alert('Vui lòng thêm ít nhất 3 sở thích trước.');
                            } else {
                                var users = response.user;
                                var userAge = response.userage;
                                var statusFriend = response.statusFriendship;
                                $('#user-list').empty();
                                if(users !== null){
                                for (var i = 0; i < users.length; i++) {
                                    var user = users[i];
                                    var userage = userAge[user.id];
                                    var distance = user.distance.toFixed(1);
                                    var status = statusFriend[user.id];
                                    
                                    var userHtml = '<div class="box-user">' ;
                                    userHtml +='<div class="user">'+
                                    
                                        '<div class="avatar">';
                                            if (user.avatar !== null) {
                                                userHtml += '<a href="'+ '{{ url("profile/") }}'+'/' +  user.id +'"><li><img src="' + '{{ asset("storage/users_avatar/") }}' + '/' + user.avatar + '" alt="Avatar"></a>';
                                            } else {
                                                userHtml += '<a href="'+ '{{ url("profile/") }}'+'/' +  user.id +'"><li><img src="{{ asset("storage/users_avatar/guest-user-250x250.jpg") }}" alt="Avatar"></a>';
                                            }
                                            userHtml += '</div>'+
                                        '<div class="footer-user container">'+
                                            '<div class="information-user">'+
                                                '<div class="name"><a href="'+ '{{ url("profile/") }}'+'/' +  user.id +'"><li>' + user.first_name + ' ' + user.last_name + '</li></a></div>';
                                            
                                    if(user.gender === 'male'){
                                        userHtml += '<div class="gender">Nam</div>';
                                    }
                                    else if(user.gender ==='female'){
                                        userHtml += '<div class="gender">Nữ</div>';
                                    }
                                    else {
                                        userHtml += '<div class="gender">Bí mật</div>';
                                    }
                                    userHtml +='<p class="user-age">' + userage + 't</p>';
                                    
                                    
                                    userHtml += '</div>';
                                    userHtml += '<p class="user-distance">' + distance + ' km</p>';

                                    if (user.bigo !== null) {
                                        userHtml += '<p class="user-bigo">' + user.bigo + '</p>';
                                    }
                                    
                                    if (status === 'noFriend') {
                                        userHtml += '<div class="add-friends">' +
                                            '<i class="bx bxs-user-plus bx-flip-horizontal"></i>' +
                                            '<div class="title">Kết bạn</div>' +
                                            '</div>';
                                    } else if (status === 'Friend') {
                                        userHtml += '<div class="friend-accepted item d-flex">' +
                                            '<i class="bx bxs-user-check"></i>' +
                                            '<div class="title">Bạn bè</div>' +
                                            '</div>';
                                    } else if (status === 'friendPending') {
                                        userHtml += '<div class="friend-pending item d-flex">' +
                                            '<i class="bx bxs-user-x"></i>' +
                                            '<div class="title">Hủy lời mời</div>' +
                                            '</div>';
                                    }
                                    else if(status ==='acceptedFriend'){
                                        userHtml +='<div class="btn-friend ">'+
                                                '<div class="accepted" data-user-id="{{ $id }}" data-requester-id="'+user.id+'">'+
                                                    '@csrf'+                                                   
                                                    '<button>Chấp nhập</button>'+
                                                '</div>'+
                                                '<div class="erase" data-user-id="{{ $id }}" data-requester-id="'+user.id+'">'+
                                                   '<button>Xóa</button>'+
                                                    '@csrf'+                                                
                                                '</div>'+
                                                '<div class="accept" style="display:none;">'+
                                                    '<button>Đã chấp nhận lời mời...</button>'+
                                                '</div>'+
                                                '<div class="erased" style="display:none;">'+
                                                    '<button>Đã từ chối lời mời...</button>'+
                                                '</div>'+
                                            '</div>';
                                    }
                                    userHtml += '</div>';
                                    userHtml += '</div>';
                                    $('#user-list').append(userHtml);
                                }
                            }
                            else{
                                '<div>Không có người dùng nào xung quanh bạn</div>'
                            }
                            }
                        } else {
                            // Xử lý khi có lỗi từ server
                            alert('Có lỗi xảy ra. Vui lòng thử lại sau.');
                        }
                    },
                    error: function() {
                        // Xử lý khi có lỗi xảy ra trong quá trình gửi request
                        alert('Có lỗi xảy ra. Vui lòng thử lại sau.');
                    }
                })
        });
    
        // Xử lý sự kiện khi giá trị của thanh trượt thay đổi
        slider.noUiSlider.on('update', function (values, handle) {
            var distance = values[handle];
            console.log('Khoảng cách: ' + distance);
        });
        // Xử lý sự kiện khi giá trị của thanh trượt thay đổi
        slider.noUiSlider.on('update', function (values, handle) {
            var value = values[handle];
            // Cập nhật giá trị hiển thị
            document.getElementById('distance-value').textContent = value + ' km';
        });
    </script>

    <script>

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(saveLocation, handleError);
    } else {
        console.log("Trình duyệt không hỗ trợ Geolocation.");
    }
}

function saveLocation(position) {
    var latitudeter = position.coords.latitude;
    var longitudeter = position.coords.longitude;
    var userId = $('#wapper').data('user-id');
    console.log(latitudeter,longitudeter,userId)
    // Gửi dữ liệu vị trí đến máy chủ sử dụng Ajax
    $.ajax({
        url: '/save-location',
        type: 'POST',
        data: {
            user_id: userId,
            latitude: latitudeter,
            longitude: longitudeter,
            '_token': '{{ csrf_token() }}',
        },
        success: function(response) {
            console.log(response);
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}

function handleError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            console.log("Người dùng từ chối yêu cầu vị trí.");
            // Hiển thị thông báo hoặc cung cấp tùy chọn thay thế
            break;
        case error.POSITION_UNAVAILABLE:
            console.log("Thông tin vị trí không khả dụng.");
            break;
        case error.TIMEOUT:
            console.log("Yêu cầu lấy vị trí đã hết thời gian.");
            break;
        case error.UNKNOWN_ERROR:
            console.log("Lỗi không xác định xảy ra.");
            break;
    }
}

$(document).ready(function() {
    getLocation(); // Gọi hàm getLocation() khi tài liệu đã sẵn sàng
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