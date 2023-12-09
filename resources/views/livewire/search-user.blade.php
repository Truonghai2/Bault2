<div> 
    
        <div class="container">
            <div class="header-dropdown">
                <div class="d-flex">
                    <div class="icon-out"><i class='bx bx-left-arrow-alt'></i></div>
                    <div class="ip-search">
                        <input wire:model="search" class="livewire-input" type="text" placeholder="Tìm kiếm Trên Bault" />

                    </div>
                </div>
            </div>
            <div class="main-dropdown">
               
               @if($search)
                    <ul>
                        @foreach($users as $user)
                            <a href="{{ route('profile',['id' => $user->id]) }}" wire:click="add({{ $user->id }})">
                                <div class="user">
                                    <div class="avatar">
                                        @isset($user->avatar)
                                            <img width="40px" style="border-radius:50%;"  src="{{ asset('storage/users_avatar/'. $user->avatar) }}" alt="">
                                        @else
                                            <img width="40px" style="border-radius:50%;" src="{{ asset('storage/users_avatar/guest-user-250x250.jpg') }}" alt="">
                                        @endisset
                                    </div>
                                    <div class="user-name">
                                        <h6>{{ $user->first_name }} {{ $user->last_name }}</h6>
                                    </div>

                                </div>
                            </a>
                        @endforeach
                    </ul>
                @else
                    @livewire('history-search')
                @endif
            </div>
        </div>
      
    @livewireScripts
</div>
