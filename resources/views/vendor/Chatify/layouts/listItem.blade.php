{{-- -------------------- Saved Messages -------------------- --}}
@if($get == 'saved')

@php
  $user = Auth::user();  
@endphp
    <table class="messenger-list-item" data-contact="{{ Auth::user()->id }}">
        <tr data-action="0">
            {{-- Avatar side --}}
            <td>
            <div class="saved-messages avatar av-m">
                <img style="
                width: 100%;
            " src="{{ (!is_null($user->avatar) ? asset("storage/users_avatar/{$user->avatar}") : asset("storage/users_avatar/guest-user-250x250.jpg")) }}" alt="">
            </div>
            </td>
            {{-- center side --}}
            <td>
                <p data-id="{{ Auth::user()->id }}" data-type="user">{{ Auth::user()->first_name }} {{Auth::user()->last_name  }}</p>
                <span></span>
            </td>
        </tr>
    </table>
@endif

{{-- -------------------- Contact list -------------------- --}}
{{-- Contact friend  --}}
@if($get == 'users' && !!$lastMessage)
<?php
$lastMessageBody = mb_convert_encoding($lastMessage->body, 'UTF-8', 'UTF-8');
$lastMessageBody = strlen($lastMessageBody) > 30 ? mb_substr($lastMessageBody, 0, 30, 'UTF-8').'..' : $lastMessageBody;
?>
<table class="messenger-list-item" data-contact="{{ $user->id }}">
    <tr data-action="0">

        
        {{-- Avatar side --}}
        <td style="position: relative">
            @if($user->active_status)
                <span class="activeStatus"></span>
            @endif
        <div class="avatar av-m">
            <img style="
                width: 100%;
            " src="{{ (!is_null($user->avatar) ? asset("storage/users_avatar/{$user->avatar}") : asset("storage/users_avatar/guest-user-250x250.jpg")) }}" alt="">
        </div>
        </td>
        {{-- center side --}}
        <td>
        <p data-id="{{ $user->id }}" data-type="user">
            {{ $user->first_name }} {{ $user->last_name }}
            <span class="contact-item-time" data-time="{{$lastMessage->created_at}}">
                @php
                
                    $startDate = Carbon\Carbon::parse($lastMessage->created_at); // Sử dụng parse để chuyển đổi ngày tháng từ chuỗi hoặc timestamp
                    $endDate = Carbon\Carbon::now(); // Ngày đích, hiện tại
                    $diff = $startDate->diffForHumans($endDate); // Đảo ngày bắt đầu và ngày kết thúc để tính khoảng thời gian

                @endphp
                {{ $diff }}
            </span>
        </p>
        <span>
            {{-- Last Message user indicator --}}
            {!!
                $lastMessage->from_id == Auth::user()->id
                ? '<span class="lastMessageIndicator">Bạn:</span>'
                : ''
            !!}
            {{-- Last message body --}}
            @if($lastMessage->attachment == null)
            {!!
                $lastMessageBody
            !!}
            @else
            {!!
                $lastMessage->from_id == Auth::user()->id
                    ? '<span class="lastMessageIndicator"> Đã gửi một ảnh</span>'
                    : '<span class="lastMessageIndicator">'.Auth::user()->first_name.' '.Auth::user()->last_name.' đã gửi một ảnh</span>'
                !!}
            @endif
        </span>
        {{-- New messages counter --}}
            {!! $unseenCounter > 0 ? "<b>".$unseenCounter."</b>" : '' !!}
        </td>
    </tr>
</table>
@endif
{{-- Contact No friend --}}
@if ($get === 'nofriend' && !!$lastMessage)
    @php
        $lastMessageBody = mb_convert_encoding($lastMessage->body, 'UTF-8', 'UTF-8');
        $lastMessageBody = strlen($lastMessageBody) > 30 ? mb_substr($lastMessageBody, 0, 30, 'UTF-8').'..' : $lastMessageBody;
    @endphp
    <table class="messenger-list-item" data-contact="{{ $user->id }}">
        <tr data-action="0">
            {{-- Avatar side --}}
            <td style="position: relative">
                @if($user->active_status)
                    <span class="activeStatus"></span>
                @endif
            <div class="avatar av-m">
                <img style="
                    width: 100%;
                " src="{{ (!is_null($user->avatar) ? asset("storage/users_avatar/{$user->avatar}") : asset("storage/users_avatar/guest-user-250x250.jpg")) }}" alt="">
            </div>
            </td>
            {{-- center side --}}
            <td>
            <p data-id="{{ $user->id }}" data-type="user">
                {{ $user->first_name }} {{ $user->last_name }}
                <span class="contact-item-time" data-time="{{$lastMessage->created_at}}">
                    @php
                    
                        $startDate = Carbon\Carbon::parse($lastMessage->created_at); // Sử dụng parse để chuyển đổi ngày tháng từ chuỗi hoặc timestamp
                        $endDate = Carbon\Carbon::now(); // Ngày đích, hiện tại
                        $diff = $startDate->diffForHumans($endDate); // Đảo ngày bắt đầu và ngày kết thúc để tính khoảng thời gian
    
                    @endphp
                    {{ $diff }}
                </span>
            </p>
            <span>
                {{-- Last Message user indicator --}}
                {!!
                    $lastMessage->from_id == Auth::user()->id
                    ? '<span class="lastMessageIndicator">Bạn:</span>'
                    : ''
                !!}
                {{-- Last message body --}}
                @if($lastMessage->attachment == null)
                {!!
                    $lastMessageBody
                !!}
                @else
                {!!
                    $lastMessage->from_id == Auth::user()->id
                        ? '<span class="lastMessageIndicator"> Đã gửi một ảnh</span>'
                        : '<span class="lastMessageIndicator">'.Auth::user()->first_name.' '.Auth::user()->last_name.' đã gửi một ảnh</span>'
                    !!}
                @endif
            </span>
            {{-- New messages counter --}}
               
            </td>
        </tr>
    </table>
@endif
@if ($get === 'Dating' && !!$lastMessage)
@php
$lastMessageBody = mb_convert_encoding($lastMessage->body, 'UTF-8', 'UTF-8');
$lastMessageBody = strlen($lastMessageBody) > 30 ? mb_substr($lastMessageBody, 0, 30, 'UTF-8').'..' : $lastMessageBody;
@endphp
<table class="messenger-list-item" data-contact="{{ $user->id }}">
    <tr data-action="0">
        {{-- Avatar side --}}
        <td style="position: relative">
            @if($user->active_status)
                <span class="activeStatus"></span>
            @endif
        <div class="avatar av-m">
            <img style="
                width: 100%;
            " src="{{ (!is_null($user->avatar) ? asset("storage/users_avatar/{$user->avatar}") : asset("storage/users_avatar/guest-user-250x250.jpg")) }}" alt="">
        </div>
        </td>
        {{-- center side --}}
        <td>
        <p data-id="{{ $user->id }}" data-type="user">
            {{ $user->first_name }} {{ $user->last_name }}
            <span class="contact-item-time" data-time="{{$lastMessage->created_at}}">
                @php
                
                    $startDate = Carbon\Carbon::parse($lastMessage->created_at); // Sử dụng parse để chuyển đổi ngày tháng từ chuỗi hoặc timestamp
                    $endDate = Carbon\Carbon::now(); // Ngày đích, hiện tại
                    $diff = $startDate->diffForHumans($endDate); // Đảo ngày bắt đầu và ngày kết thúc để tính khoảng thời gian

                @endphp
                {{ $diff }}
            </span>
        </p>
        <span>
            {{-- Last Message user indicator --}}
            {!!
                $lastMessage->from_id == Auth::user()->id
                ? '<span class="lastMessageIndicator">Bạn:</span>'
                : ''
            !!}
            {{-- Last message body --}}
            @if($lastMessage->attachment == null)
            {!!
                $lastMessageBody
            !!}
            @else
            {!!
                $lastMessage->from_id == Auth::user()->id
                    ? '<span class="lastMessageIndicator"> Đã gửi một ảnh</span>'
                    : '<span class="lastMessageIndicator">'.Auth::user()->first_name.' '.Auth::user()->last_name.' đã gửi một ảnh</span>'
                !!}
            @endif
        </span>
        {{-- New messages counter --}}
            {!! $unseenCounter > 0 ? "<b>".$unseenCounter."</b>" : '' !!}
        </td>
    </tr>
</table>
@endif

@if ($get === 'user' && !!$lastMessage)
@php
$lastMessageBody = mb_convert_encoding($lastMessage->body, 'UTF-8', 'UTF-8');
$lastMessageBody = strlen($lastMessageBody) > 30 ? mb_substr($lastMessageBody, 0, 30, 'UTF-8').'..' : $lastMessageBody;
@endphp

        <div class="route-layout" data-contact="{{ $user->id }}" onclick="layout({{ $user->id }})">
            <div class="content-messenger d-flex">
                <div class="user d-flex">
                    <div class="avatar">
                        <img src="{{ (!is_null($user->avatar) ? asset("storage/users_avatar/{$user->avatar}") : asset("storage/users_avatar/guest-user-250x250.jpg")) }}" alt="">
                    </div>
                    <div class="box">
                        @php
                
                        $startDate = Carbon\Carbon::parse($lastMessage->created_at); // Sử dụng parse để chuyển đổi ngày tháng từ chuỗi hoặc timestamp
                        $endDate = Carbon\Carbon::now(); // Ngày đích, hiện tại
                        $diff = $startDate->diffForHumans($endDate); // Đảo ngày bắt đầu và ngày kết thúc để tính khoảng thời gian
 
                    @endphp
                        <div class="username"><h6>{{ $user->first_name }} {{ $user->last_name }}</h6></div>
                        <div class="messege {{ ($lastMessage->seen === 0 && $lastMessage->from_id !== auth()->id()) ? 'active' : '' }} d-flex">
                            <span>
                                
                                 {{-- Last Message user indicator --}}
                                {!!
                                    $lastMessage->from_id == Auth::user()->id
                                    ? '<span class="lastMessageIndicator">Bạn:</span>'
                                    : ''
                                !!}
                                {{-- Last message body --}}
                                @if($lastMessage->attachment == null)
                                {!!
                                    $lastMessageBody
                                !!}
                                @else
                                {!!
                                    $lastMessage->from_id == Auth::user()->id
                                        ? '<span class="lastMessageIndicator"> Đã gửi một ảnh</span>'
                                        : '<span class="lastMessageIndicator">'.Auth::user()->first_name.' '.Auth::user()->last_name.' đã gửi một ảnh</span>'
                                    !!}
                                @endif
                            </span>
                            <div class="space"> . </div>
                            <div class="time">
                                <span>{{ $diff }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="status {{ ($lastMessage->seen === 0 ? '' : 'd-none') }}">
                    @if ($lastMessage->seen === 0 && $lastMessage->from_id !== auth()->id())
                        <i class="bx bxs-circle"></i>
                    @endif
                </div>
            </div>
        </div>
  
@endif
@if ($get === 'nofriends' && !!$lastMessage)
@php
$lastMessageBody = mb_convert_encoding($lastMessage->body, 'UTF-8', 'UTF-8');
$lastMessageBody = strlen($lastMessageBody) > 30 ? mb_substr($lastMessageBody, 0, 30, 'UTF-8').'..' : $lastMessageBody;
@endphp

        <div class="route-layout" data-contact="{{ $user->id }}" onclick="layout({{ $user->id }})">
            <div class="content-messenger d-flex">
                <div class="user d-flex">
                    <div class="avatar">
                        <img src="{{ (!is_null($user->avatar) ? asset("storage/users_avatar/{$user->avatar}") : asset("storage/users_avatar/guest-user-250x250.jpg")) }}" alt="">
                    </div>
                    <div class="box">
                        @php
                
                        $startDate = Carbon\Carbon::parse($lastMessage->created_at); // Sử dụng parse để chuyển đổi ngày tháng từ chuỗi hoặc timestamp
                        $endDate = Carbon\Carbon::now(); // Ngày đích, hiện tại
                        $diff = $startDate->diffForHumans($endDate); // Đảo ngày bắt đầu và ngày kết thúc để tính khoảng thời gian
 
                    @endphp
                        <div class="username"><h6>{{ $user->first_name }} {{ $user->last_name }}</h6></div>
                        <div class="messege {{ ($lastMessage->seen === 0 && $lastMessage->from_id !== auth()->id()) ? 'active' : '' }} d-flex">
                            <span>
                                
                                 {{-- Last Message user indicator --}}
                                {!!
                                    $lastMessage->from_id == Auth::user()->id
                                    ? '<span class="lastMessageIndicator">Bạn:</span>'
                                    : ''
                                !!}
                                {{-- Last message body --}}
                                @if($lastMessage->attachment == null)
                                {!!
                                    $lastMessageBody
                                !!}
                                @else
                                {!!
                                    $lastMessage->from_id == Auth::user()->id
                                        ? '<span class="lastMessageIndicator"> Đã gửi một ảnh</span>'
                                        : '<span class="lastMessageIndicator">'.Auth::user()->first_name.' '.Auth::user()->last_name.' đã gửi một ảnh</span>'
                                    !!}
                                @endif
                            </span>
                            <div class="space"> . </div>
                            <div class="time">
                                <span>{{ $diff }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="status">
                    @if ($lastMessage->seen === 0 && $lastMessage->from_id !== auth()->id())
                        <i class="bx bxs-circle"></i>
                    @endif
                </div>
            </div>
        </div>
   
@endif
@if ($get === 'Datings' && !!$lastMessage)
@php
$lastMessageBody = mb_convert_encoding($lastMessage->body, 'UTF-8', 'UTF-8');
$lastMessageBody = strlen($lastMessageBody) > 30 ? mb_substr($lastMessageBody, 0, 30, 'UTF-8').'..' : $lastMessageBody;
@endphp

        <div class="route-layout" data-contact="{{ $user->id }}" onclick="layout({{ $user->id }})">
            <div class="content-messenger d-flex">
                <div class="user d-flex">
                    <div class="avatar">
                        <img src="{{ (!is_null($user->avatar) ? asset("storage/users_avatar/{$user->avatar}") : asset("storage/users_avatar/guest-user-250x250.jpg")) }}" alt="">
                    </div>
                    <div class="box">
                        @php
                
                        $startDate = Carbon\Carbon::parse($lastMessage->created_at); // Sử dụng parse để chuyển đổi ngày tháng từ chuỗi hoặc timestamp
                        $endDate = Carbon\Carbon::now(); // Ngày đích, hiện tại
                        $diff = $startDate->diffForHumans($endDate); // Đảo ngày bắt đầu và ngày kết thúc để tính khoảng thời gian
 
                    @endphp
                        <div class="username"><h6>{{ $user->first_name }} {{ $user->last_name }}</h6></div>
                        <div class="messege {{ ($lastMessage->seen === 0 && $lastMessage->from_id !== auth()->id()) ? 'active' : '' }} d-flex">
                            <span>
                                
                                 {{-- Last Message user indicator --}}
                                {!!
                                    $lastMessage->from_id == Auth::user()->id
                                    ? '<span class="lastMessageIndicator">Bạn:</span>'
                                    : ''
                                !!}
                                {{-- Last message body --}}
                                @if($lastMessage->attachment == null)
                                {!!
                                    $lastMessageBody
                                !!}
                                @else
                                {!!
                                    $lastMessage->from_id == Auth::user()->id
                                        ? '<span class="lastMessageIndicator"> Đã gửi một ảnh</span>'
                                        : '<span class="lastMessageIndicator">'.Auth::user()->first_name.' '.Auth::user()->last_name.' đã gửi một ảnh</span>'
                                    !!}
                                @endif
                            </span>
                            <div class="space"> . </div>
                            <div class="time">
                                <span>{{ $diff }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="status">
                    @if ($lastMessage->seen === 0 && $lastMessage->from_id !== auth()->id())
                        <i class="bx bxs-circle"></i>
                    @endif
                </div>
            </div>
        </div>
   
@endif

{{-- -------------------- Search Item -------------------- --}}
@if($get == 'search_item')
<table class="messenger-list-item" data-contact="{{ $user->id }}">
    <tr data-action="0">
        {{-- Avatar side --}}
        <td>
        <div class="avatar av-m">
            <img style="
                width: 100%;
            " src="{{ (!is_null($user->avatar) ? asset("storage/users_avatar/{$user->avatar}") : asset("storage/users_avatar/guest-user-250x250.jpg")) }}" alt="">
        </div>
        </td>
        {{-- center side --}}
        <td>
            <p data-id="{{ $user->id }}" data-type="user">
                {{ $user->first_name }} {{ $user->last_name }}
        </td>

    </tr>
</table>
@endif

{{-- -------------------- Shared photos Item -------------------- --}}
@if($get == 'sharedPhoto')
<div class="shared-photo chat-image" style="background-image: url('{{ $image }}')"></div>
@endif


