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

<style>
    #local-video, #remote-video {
    transform: scaleX(-1);
}

header{
    position: relative !important;
}

.your-camera {
  position: relative;
}

.main-camera video {
  width: 100%;
  height: 635px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

/* CSS cho video của đối phương */
.camera-user {
  position: absolute;

  bottom: 10px; /* Điều chỉnh vị trí video của đối phương */
  right: 20px; /* Điều chỉnh vị trí video của đối phương */
}

.camera-user video {
  max-width: 350px;
  width: auto;
  height: auto;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}
</style>
<body>
    

    <div id="wapper">

        {!! view('layout.header',['get' => 'header', 'user' => auth()->user()]) !!}
        

        <div class="main ">

            <div class="content-call position-relative container">
                <div class="your-camera position-relative ">
                    <div class="main-camera ">
                        <div id="received-video"></div>
                        <video id="local-video" autoplay></video>
                    </div>
                    <div class="camera-user position-absolute" style="">
                        <video id="remote-video" autoplay></video>
                    </div>

                </div>
                <div class="menu-btn">
                    <div class="btn-actions-matching    ">

                        <div class="icon"><i class='bx bxs-phone' id="call"></i></div>
                    </div>
                    <div class="btn" id="endCall">Click</div>
                </div>
            </div>
        
        </div>
    </div>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="{{ asset('js/call/call.js') }}"></script>
</body>
</html>