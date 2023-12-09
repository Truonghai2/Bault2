
        
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bault - Đăng nhập hoặc Đăng ký</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="{{ asset('img/bault_logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body>

    <div id="wapper">
        <div class="container d-flex">
            <div class="form-left">
                <div class="content-form">
                    <div class="logo d-flex">
                        <li><img  src="{{ asset('img/new_logo.png') }}"  alt=""></li>
                        <div class="Name"><h2>Bault</h2></div>
                    </div>
                    <div class="title">
                        <li><h4>Đăng nhập gần đây</h4></li>
                        <li><h7>Nhấp vào ảnh của bạn hoặc thêm tài khoản.</h7></li>
                    </div>
                    <div class="menu-item">
                        <div class="item">
                            <div class="avatar">
                                <img src="{{ asset('img/img-user/guest-user-250x250.jpg') }}" alt="">
                            </div>
                            <div class="name">
                                <li><p>name1</p></li>
                            </div>
                        </div>
                        <div class="item">
                            <div class="avatar">
                                <img src="{{ asset('img/img-user/guest-user-250x250.jpg') }}" alt="">
                            </div>
                            <div class="name">
                                <li><p>name2</p></li>
                            </div>
                        </div>
                        <div class="item">
                            <div class="avatar">
                                <i class='bx bx-add-to-queue'></i>

                            </div>
                            <div class="name">
                                <li><p>Thêm tài khoản</p></li>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            @yield('tsss')

            @yield('dmmm')
            
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script>
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("form-creater");
       
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
       
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
    
            
</body>
</html>