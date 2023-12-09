// const { find } = require("lodash");

const csrfToken = $('meta[name= csrf-token]').attr('content');
const getUserID = () => $('meta[name = id]').attr('content');
const setUserId = (id) => $('meta[name=id]').attr('content',id);

const containerQueue = $('.main-left');
const test = containerQueue.find('.main-content-left');
const containerMenu = $('.main-rigth');
// const displayMenu = 
// get user id

const user_id = $('meta[name= user-id]').attr('content');

// connections pusher

    const pusher = new Pusher('44462a9ee7a77a4ed9b3', {
        cluster: 'ap1',
       
    });
// check connect pusher
    pusher.connection.bind('connected', function() {
        console.log('ok');
    });


    pusher.connection.bind('disconnected', function(){
        console.log('mất kết nối');
    })

    pusher.connection.bind('error',function(err){
        console.log(err);
    })

    
// end check connect

// subscribe to the channel 

    const channelName = "call-video";
    var channel = pusher.subscribe(`${channelName}.${user_id}`);
    var clientSendChannel;
    var clientListenChannel;


    function initClientChannelCall(){
        if(getUserID()){
            clientSendChannel = pusher.subscribe(`${channelName}.${getUserID()}`);
            clientListenChannel = pusher.subscribe(`${channelName}.${user_id}`);
        }
        
    }
 

// call functions



// event click btn actions random


// function request data to controller
function requestData(){
    fetch('/find-match', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken, // Token Laravel CSRF
        },
        body: JSON.stringify({}) // Gửi yêu cầu tìm đối tác ghép cặp
    })
    .then(response => {
        // Xử lý response nếu cần
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// listening event matching 

const testEvent = pusher.subscribe(`matching.${user_id}`);

testEvent.bind('success-matching', function(data){
    test.empty();
    test.append(data.render);
    clickMatching();
    // notifyUser(data.to_id, data.from_id, 'success-matching');/
    
});


// listening even  cancal matching

testEvent.bind('cancel-matching',function(data){
    test.empty();
     test.append(data.matching);

});


// listening  event queue matching

testEvent.bind('queue-Matching',function(data){
    test.empty();
     test.append(data.matching);
});


testEvent.bind('accept-Matching',function(data){

});
//  func event click 

function clickMatching(){
    $('.btn-accept').click(function(){
        accepteMatching();
    })
    $('.btn-cancel').click(function(){
        cancelMatching();
    })
}


// functions chấp nhận ghép
function accepteMatching(){
    $.ajax({
        url: 'acceptRandomMatching',
        method: 'GET',
        data:{
            '_token': csrfToken,
        },
        
    })
}

function cancelMatching(){
    $.ajax({
        url:'cancelRandomMatching',
        method:'GET',
    })
}





