

// cnt thông báo
var userId = $('#notifications').data('user-id');
            $.ajax({
                url:'/notifications',
                type:'GET',
                data: {
                    user_id: userId,
                    '_token': '{{ csrf_token() }}'
                    
                },
                success:function(response){
                    $('#cnt-notifications').text(response.cnt_notifications);
                    
                },
                error:function(response){
                    alert(response.error);
                }
            })