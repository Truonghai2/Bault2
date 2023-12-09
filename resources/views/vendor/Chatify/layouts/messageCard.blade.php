<?php
$seenIcon = (!!$seen ? 'check-double' : 'check');
$startDate = Carbon\Carbon::parse($created_at); // Sử dụng parse để chuyển đổi ngày tháng từ chuỗi hoặc timestamp
                        $endDate = Carbon\Carbon::now(); // Ngày đích, hiện tại
                        $diff = $startDate->diffForHumans($endDate); // Đảo ngày bắt đầu và ngày kết thúc để tính khoảng thời gian
                        
                        
                     
$timeAndSeen = "<span data-time='$created_at' class='message-time'>
        ".($isSender ? "<span class='fas fa-$seenIcon' seen'></span>" : '' )."
    </span>";
?>

<div class="message-card @if($isSender) mc-sender @endif" data-id="{{ $id }}">
    {{-- Delete Message Button --}}
    @if ($isSender)
        <div class="actions">
            <i class="fas fa-trash delete-btn" data-id="{{ $id }}"></i>
        </div>
    @endif
    {{-- Card --}}
    <div class="message-card-content d-flex">
        
        
    
        @if (@$attachment->type != 'image' || $message)
            <div class="message">
                {!! ($message == null && $attachment != null && @$attachment->type != 'file') ? $attachment->title : nl2br($message) !!}
                {!! $timeAndSeen !!}
                {{-- If attachment is a file --}}
                @if(@$attachment->type == 'file')
                <a href="{{ route(config('chatify.attachments.download_route_name'), ['fileName'=>$attachment->file]) }}" class="file-download">
                @endif
            </div>
        @endif
        @if(@$attachment->type == 'image')
        <div class="image-wrapper" style="text-align: {{$isSender ? 'end' : 'start'}}">
            <div class="image-file chat-image" >
                <img style="
                width: 100%;
            " src="{{ asset('storage/attachments/' . $attachment->file) }}" alt="">

                
            </div>
            <div style="margin-bottom:5px">
                {!! $timeAndSeen !!}
            </div>
        </div>
        @endif
    </div>
</div>



