<div >

    @foreach($users as $index)
        <div class="user d-flex">
            <div class="avatar">
                @isset($index->avatar)
                    <img width="40px" style="border-radius:50%;"  src="{{ asset('storage/users_avatar/'. $index->avatar) }}" alt="">
                @else
                    <img width="40px" style="border-radius:50%;" src="{{ asset('storage/users_avatar/guest-user-250x250.jpg') }}" alt="">
                @endisset
            </div>
            <div class="user-name">
                <h6>{{ $index->first_name }} {{ $index->last_name }}</h6>
            </div>
            <div class="btn-close" wire:click="delete({{ $index->id }})" id="close-user-history-search"></div>
        </div>
    @endforeach
    @if (count($users) == 0)
        <p>không có lịch sử tìm kiếm.</p>
    @endif
</div>
