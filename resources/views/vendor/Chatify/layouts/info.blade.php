{{-- user info and avatar --}}
<div class="avatar av-l chatify-d-flex">
    <img src="" class="add-avatar-here" alt="">
</div>
<p class="info-name">{{ config('chatify.name') }}</p>

<div class="navbar-menu d-flex">
    <div class="profile-user">
        <div class="icon"><i class='bx bxs-user-circle'></i></div>
        <div class="title">Xem trang cá nhân</div>
    </div>
    <div class="search-message">
        <div class="icon"><i class='bx bx-search' ></i></div>
        <div class="title">TÌm kiếm</div>
    </div>
    <div class="report">
        <div class="icon"><i class='bx bxs-error-alt' ></i></div>
        <div class="title">Báo cáo</div>
    </div>
</div>
<div class="messenger-infoView-btns">
    <a href="#" class="danger delete-conversation">
        Xóa cuộc trò chuyện
    </a>
</div>
{{-- shared photos --}}
<div class="messenger-infoView-shared">
    <p class="messenger-title"><span>Ảnh</span></p>
    <div class="shared-photos-list"></div>
</div>
