<div class="favorite-list-item">
    @if($user)
        <div data-id="{{ $user->id }}" data-action="0" class="avatar av-m">

            <img style="
                width: 100%;
            " src="{{ (!is_null($user->avatar) ? asset("storage/users_avatar/{$user->avatar}") : asset("storage/users_avatar/guest-user-250x250.jpg")) }}" alt="">
        </div>
        <p>{{ $user->first_name }} {{ $user->last_name }}</p>
    @endif
</div>
