<div>
    @php
        // dd($listFriend)
    @endphp
    
        <div class="main-right" style="width: 350px;" >
                <div class="container content">
                    <div class="content-header support">
                        <div class="title"><h6>Được tài trợ</h6></div>
                    </div>
                    <div class="content-main" id= "company-support">
                        {{-- @foreach ($company_suport as $item)
                            <a href="{{ $item->link }}" class="d-flex">
                                <div class="img-bground" >
                                    <img src="{{ $item->img }}" alt="">
                                    
                                </div>
                                <div class="title">
                                    <div class="content"><h6>{{ $item->content }}</h6></div>
                                    <div class="link">{{ $item->link_web }}</div>
                                </div>
                            </a>

                        @endforeach --}}
                    </div>

                    <script>
                        
                        var companySupport = @json($company_suport);

                        var currentIndex = 0; // Chỉ số hiện tại của vị trí công ty hỗ trợ
                        var itemsPerBatch = 2; // Số lượng vị trí hiển thị trong mỗi lần

                        function displayCompanySupport() {
                            $('#company-support').empty(); // Xóa các vị trí cũ đi

                            for (var i = currentIndex; i < currentIndex + itemsPerBatch; i++) {
                                if (i >= companySupport.length) {
                                    currentIndex = 0; // Quay lại đầu nếu đã hiển thị hết danh sách
                                    i = currentIndex;
                                }
                                var item = companySupport[i];
                                var itemHtml = `
                                    <a href="${item.link}" class="d-flex">
                                        <div class="img-bground">
                                            <img src="${item.img}" alt="">
                                        </div>
                                        <div class="title">
                                            <div class="content"><h6>${item.content}</h6></div>
                                            <div class="link">${item.link_web}</div>
                                        </div>
                                    </a>
                                `;
                                $('#company-support').append(itemHtml);
                            }
                            currentIndex += itemsPerBatch;
                        }


                        // Hiển thị ban đầu
                        displayCompanySupport();

                        if (companySupport.length > itemsPerBatch) {
                            // Thiết lập interval để thay đổi sau mỗi 5 phút
                            setInterval(function () {
                                displayCompanySupport(); // Hiển thị vị trí mới và xóa vị trí cũ
                            }, 120000); 
                        }


                        
                    </script>
                    <div class="friend-ship">
                        
                        <div class="header-friend-ship d-flex">
                            <div class="title"><span>Lời mời kết bạn</span></div>
                            <div class="btn-select-all">
                                <span>Xem tất cả</span>
                            </div>
                        </div>
                        <div class="main-friend-ship">
                            <div class="list-friend-ship">
                                
                               @if (count($friend) > 0)
                                    @foreach ($friend as $user)
                                    @php
                
                                        $startDate = Carbon\Carbon::parse($user->created_at); // Sử dụng parse để chuyển đổi ngày tháng từ chuỗi hoặc timestamp
                                        $endDate = Carbon\Carbon::now(); // Ngày đích, hiện tại
                                        $diff = $startDate->diffForHumans($endDate); // Đảo ngày bắt đầu và ngày kết thúc để tính khoảng thời gian
                    
                                    @endphp
                                            <div class="hover-bg">
                                                <div class="user d-flex">
                                                    <div class="user-avatar">
                                                      
                                                        <a href="{{ route('profile',['id' => $user->getRequester->id]) }}">
                                                            <img style="width: 50px;" src="{{ (!is_null($user->getRequester->avatar) ? asset("storage/users_avatar/{$user->getRequester->avatar}") : asset("storage/users_avatar/guest-user-250x250.jpg")) }}" alt="">
                                                        </a>
                                                            
                                                       
                                                    </div>
                                                    <div class=information-user>
                                                        <div class="header-information-user d-flex">
                                                            <div class="user-name">
                                                               <a href="{{ route('profile',['id' => $user->getRequester->id]) }}">
                                                                    {{ $user->getRequester->first_name }} {{ $user->getRequester->last_name }}
                                                               </a>
                                                            </div>
                                                            <div class="time-send">
                                                                <span>{{ $diff }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="footer d-flex">
                                                            <div class="btn-accept">
                                                                <span data-id="{{ $user->getRequester->id }}">Chấp nhận</span>
                                                            </div>
                                                            <div class="btn-cancel">
                                                                <span data-id="{{ $user->getRequester->id }}">Xóa</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        @endforeach
                                        @else
                                        <span class="null">Không có lời mời mới nào</span>
                               @endif

                            </div>
                        </div>
                       
                        
                    </div>
                    <div class="list-friend">
                        <div class="header-list-friend d-flex">
                            <div class="title">
                                <span>Bạn bè</span>
                            </div>
                            <div class="btn-select-all">

                                <span>Xem tất cả</span>
                            </div>

                        </div>
                        <div class="render-list-friend">
                            @foreach ($listFriend as $user)
                                @if ($user->getRequester->id !== auth()->id())
                                    <a href="{{ route('profile',['id' => $user->getRequester->id]) }}">
                                        <div class="user d-flex select-user-active" data-user-id="{{ $user->getRequester->id }}">
                                            <div class="user-avatar">
                                                <img style="width: 50px;" src="{{ (!is_null($user->getRequester->avatar) ? asset("storage/users_avatar/{$user->getRequester->avatar}") : asset("storage/users_avatar/guest-user-250x250.jpg")) }}" alt="">

                                                <div class="status-active">
                                                    <div class="status-active-render d-flex">
                                                        <i class="bx bxs-circle"></i>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="user-name"><span>{{ $user->getRequester->first_name }} {{  $user->getRequester->last_name }}</span></div>
                                        </div>
                                    </a>
                                    @else
                                   <a href="{{ route('profile',['id' => $user->getRequested->id]) }}">
                                        <div class="user d-flex " data-user-id="{{ $user->getRequester->id }}">
                                            <div class="user-avatar d-flex select-user-active" data-user-id="{{ $user->getRequested->id }}">
                                                <img style="width: 50px;" src="{{ (!is_null($user->getRequested->avatar) ? asset("storage/users_avatar/{$user->getRequested->avatar}") : asset("storage/users_avatar/guest-user-250x250.jpg")) }}" alt="">
                                                <div class="status-active">
                                                    <div class="status-active-render-index d-flex">
                                                        <i class="bx bxs-circle"></i>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="user-name"><span>{{ $user->getRequested->first_name }} {{  $user->getRequested->last_name }}</span></div>
                                        </div>
                                   </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                
            </div>
</div>
