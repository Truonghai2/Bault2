<div id="modal-show-profile" class="modal" style="z-index:20005;">
    <div class="content-modal justify-content-center bg-white top-50 w-100 position-relative" style="transform: translateY(-50%); max-width: 500px; margin:0 auto; border-radius:10px; height: 700px;
    overflow: inherit;">
        <div class="header-modal d-flex justify-content-between aligin-item-center" style="padding: 10px; align-items:center; ">
            <div class="title">
                <h5 class="add-name-user" style="font-weight: 600;">Thông tin của <h5 class="nameusers"></h5></h5>
            </div>
            <div class="btn-close" id="btn-close-modal-information"></div>
        </div>
        <div class="modal-main" id="content-main-modal-information" style="background-color: #e8e8e8;">
            <div class="content-header-main" style="    background-color: #fff;
            position: relative;
            padding-bottom: 10px;">
                <div class="img-bg bg-user-matching">


                    <img src="http://127.0.0.1:8082/img/test_bg.jpg" width="100%" alt="">
                   
                    
                </div>

                
                <div class="avt avatar-user-matching" style="position: absolute;
                top: 259px;
                left: 20px;">
                                                            <img style="    width: 130px;
                                                            border: 5px solid #d0d0d0;
                                                            border-radius: 50%;" src="http://127.0.0.1:8082/storage/users_avatar/guest-user-250x250.jpg">
                                                          
                </div>
               
                <div class="name name-user-matching" style="    margin-top: 43px;
                font-weight: 600;
                font-size: 20px;
                margin-left: 10px;">Trương Tuấn Hải</div>
                <div class="bigo bigo-user-matching" style="margin-left: 15px;
                cursor: pointer;">
                        test
                </div>

                <div class="menu-btn d-flex w-100 m-t-10" style="margin-top: 10px">
                    <div class="btn-part-user item-btn">
                        <div class="title">Bỏ qua</div>
                    </div>
                    <div class="btn-like-user-matching item-btn">
                        <div class="title">Thích</div>
                    </div>
                    <div class="btn-accept-like-matching item-btn d-none">
                        <div class="title ">Phản hồi</div>
                    </div>
                   
                    <div class="btn-unlike-user-matching item-btn d-none">
                        <div class="title">Bỏ thích</div>
                    </div>
                </div>
                <div class="dropdown  w-100" id="dropdown-accepted-matching" style="display: none;">
                    <div class="content-dropdown menu-btn d-flex w-98" >
                        <div class="item-btn accept-matching-user">
                            <div class="title">
                                Chấp nhận
                            </div>
                        </div>
                        <div class="item-btn btn-reject-matching">
                            <div class="title">Từ chối</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-main-main ">
                <div class="information-user container">
                    <div class="title">
                        <h4>Chi tiết</h4>

                    </div>
                    <div class="information-render">
                        <div class="lever  item-render " id="lever-user-matching">
                            
                        </div>
                        <div class="school d-flex item-render" id="school-user-matching">
                        </div>
                      
                        <div class="address-user d-flex item-render" id="address-user-matching">
                        </div>
                        <div class="work d-flex item-render" id="work-user-matching">                      
                                                                        </div> 
                        
                        
                        <div class="money d-flex item-render" id="salary-user-matching">
                        </div> 
                        
                        
                        <div class="zodiac-user d-flex item-render" id="zodiac-user-matching">
                        </div>
                        
                        
                        <div class="interest-user " id= "interest-user-matching">
                                                                                <div class="row">
                                                                                            
                                        
                                                                                            
                                        <div class="box-interest d-flex">
                                            <li class="icon"><img width="40px" src="http://127.0.0.1:8082/img/icon/icon-food.png" alt="Icon"></li>
                                            <li class="title">Ăn uống</li>
                                        </div>
                                                                                        </div>
                                                                        </div>
                      
                    </div>
                </div>
                
                <div class="social_network container">
                    <div class="title">
                        <h4>Mạng xã hội</h4>

                    </div>
                    <div class="main-social-network ">
                        <div class="zalo d-flex item-render" id="zalo-use-matching">
                                                                                <div class="d-flex" style="flex: 1;">
                                    <i class="bx bxs-phone"></i>
                                    <li class="not_null">Zalo: <span>0344885035</span></li>
                                </div>
                                <div class="edit-number-zalo" style="flex: 0;"></div>
                            
                        </div>
                        

                        
                        <div class="instargram d-flex item-render" id="instagram-user-matching">
                                                                                
                                                                        </div>
                        
                       
                        <div class="facebook d-flex item-render" id="facebook-user-matching">
                                                                                
                                                                        </div>
                       
                        <div class="email item-render" id="email-user-matching">
                            <i class="bx bxs-envelope"></i>
                            <a class="not_null" href="mailto:truonghai222@gmail.com">Email: <span>truonghai222@gmail.com</span></a>
                        </div>
                    </div>
                  
                    
                </div>
                                                    <div class="album-user">
                    <div class="header d-flex">
                        <div class="title"><h4>Ảnh</h4></div>
                        <div class="see">Xem tất cả ảnh</div>
                    </div>
                    <div class="main-album-user" id="album-user-matching">
         
                                                                </div>
                </div>
                <div class="friend-user">
                    <div class="header d-flex">
                        <div class="title"><h4>Bạn bè</h4></div>
                        <div class="see">Xem tất cả bạn bè</div>
                    </div>
                    <div class="main-friend-user" id="friend-user-matching">
                   
                    </div>
                </div>
                <div class="post container bg-white"  style="margin-top: 15px;padding:10px;">

                    <div class="title">
                        <h4 style="font-weight: 600;">Bài viết</h4>
                    </div>
                    <div class="main-post-user-matching">
                        <div class=""></div>
                    </div>
                </div>
            </div>
        </div>
    
    </div>
</div>


<script>
    $('#btn-close-modal-information').click(function(){
        $('#modal-show-profile').css('display','none');
    })
    $('.btn-accept-like-matching').click(function(){
        $('#dropdown-accepted-matching').toggle();
    })
</script>



<div class="modal" id="modal-like-user" style="z-index:20005;">
    <div class="content-modal justify-content-center  bg-white top-50 w-100 position-relative"  style="transform: translateY(-50%); max-width: 500px; margin:0 auto; border-radius:10px; height: 700px;
    overflow: inherit;">
        <div class="header-modal d-flex align-items-center justify-content-center" style="padding:10px 20px 10px 20px; border-bottom: 1px solid #d0d0d0; ">
            <div class="title" style="flex:5;">
                <h5 style="text-align:center; font-weight:600;">Những người bạn đã thích</h5>
            </div>
            <div class="btn-close" id="btn-close-modal-like" style="flex:0.4;"></div>
        </div>
        <div class="main-modal" id="main-modal-like-user">
            
        </div>
    </div>
</div>


<div class="modal">
    <div class="content-modal justify-content-center bg-white top-50 w-100 position-relative" style="transform: translateY(-50%); max-width: 500px; margin:0 auto; border-radius:10px; height: 700px;
    overflow: inherit;">
        <div class="header-modal "></div>
    </div>
</div>
<script>
    $('.box-like-you').click(function () {
    $('#modal-like-user').addClass('d-block');
    $('#main-modal-like-user').empty();
    $.ajax({
        url: 'select-compatible',
        method: 'GET',
        success: function (data) {
            var promises = []; // Mảng chứa các promise từ các yêu cầu AJAX
            var html = '';
            
            if (data.length > 0) {
                for (var i = 0; i < data.length; i++) {
                    // Tạo promise cho mỗi yêu cầu AJAX
                    var promise = new Promise(function (resolve, reject) {
                        $.ajax({
                            url: 'search-user',
                            method: 'GET',
                            data: {
                                user_id: data[i].requested_id,
                            },
                            success: function (response) {
                                var user = response.user;
                                var avatar = '{{ asset("storage/users_avatar") }}' + '/';
                                if (user.avatar !== null) {
                                    avatar += user.avatar;
                                } else {
                                    avatar += 'guest-user-250x250.jpg';
                                }
                                var userHtml = `<div class="user d-flex">
                                                    <div class="information d-flex">
                                                        <div class="avatar">
                                                            <img src="${avatar}" alt="">
                                                        </div>
                                                        <div class="nameuser">
                                                            <div class="name">
                                                                <span>${user.first_name} ${user.last_name}</span>
                                                            </div>
                                                            <div class="bigo">
                                                                <span>${user.bigo}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="btn-unlike-user">
                                                        <span data-user-id= "${user.id}">Bỏ thích</span>
                                                    </div>
                                                </div>`;
                                resolve(userHtml); // Gọi hàm resolve để trả về kết quả cho promise
                            },
                            error: function (error) {
                                reject(error); // Gọi hàm reject nếu có lỗi
                            }
                        });
                    });

                    promises.push(promise); // Thêm promise vào mảng promises
                }

                // Sử dụng Promise.all để đợi tất cả các promise hoàn thành
                Promise.all(promises)
                    .then(function (results) {
                        html = results.join(''); // Kết hợp các kết quả thành một chuỗi HTML
                        $('#main-modal-like-user').append(html);
                    })
                    .catch(function (error) {
                        console.error('Error:', error);
                    });
            }
        }
    });
});

    $('#btn-close-modal-like').click(function(){
        $('#modal-like-user').removeClass('d-block');
    })
</script>