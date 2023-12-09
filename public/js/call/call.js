// import SimplePeer from 'simple-peer';


//  element config


const auth_id = $('meta[name="user-id"]').attr('content');
// const user_id = $('meta[name = id ]').attr('content');
const csrfToken = $('meta[name= csrf-token]').attr('content');
const localVideo = $('#local-video');
const remoteVideo = $('#remote-video');
// connections pusher

const getUserID = () => $('meta[name = id]').attr('content');
const setUserId = (id) => $('meta[name=id]').attr('content',id);

if(auth_id == 2){
  setUserId(1);
}
else{
  setUserId(2);
}

const user_id = $('meta[name = id ]').attr('content');
const pusher = new Pusher('44462a9ee7a77a4ed9b3', {
    cluster: 'ap1',
    auth: {
        headers: {
          "X-CSRF-TOKEN": csrfToken,
        },
    },

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


// 
var usersOnline, id, users = [],
        sessionDesc,
        currentcaller,  caller, localUserMedia;



const channelName = 'presence-videocall';


    
    const channel = pusher.subscribe(`${channelName}`);

    channel.bind('pusher:subscription_succeeded', (members) => {
    //    channel.trigger('client-test',{members});

    })

    channel.bind('pusher:member_added', (member) => {
// users.push(member.id)    
        
    });

    //To iron over browser implementation anomalies like prefixes
    GetRTCPeerConnection();
    GetRTCSessionDescription();
    GetRTCIceCandidate();
    prepareCaller();
    function prepareCaller() {
        // Initializing a peer connection
        caller = new window.RTCPeerConnection();
    
        // Listen for ICE Candidates and send them to remote peers
        caller.onicecandidate = function(evt) {
            if (!evt.candidate) return;

            const remoteVideo = document.getElementById("remote-video");
            // remoteVideo.classList.add('d-none');
            console.log("onicecandidate called");
            onIceCandidate(evt);
        };
    
        // onaddstream handler to receive remote feed and show in remoteview video element
        caller.ontrack = function(evt) {
            console.log("ontrack called");
            const remoteVideo = document.getElementById("remote-video");
            // remoteVideo.classList.remove('d-none');
            // Check if the element supports srcObject
            if ('srcObject' in remoteVideo) {
                remoteVideo.srcObject = evt.streams[0];
            } else {
                // Fallback for older browsers (not recommended)
                remoteVideo.src = URL.createObjectURL(evt.streams[0]);
            }
        };
    }
    
    function getCam() {
        //Get local audio/video feed and show it in selfview video element 
        return navigator.mediaDevices.getUserMedia({
            video: true,
            audio: true
        });
    }

    function GetRTCIceCandidate() {
        window.RTCIceCandidate = window.RTCIceCandidate || window.webkitRTCIceCandidate ||
            window.mozRTCIceCandidate || window.msRTCIceCandidate;

        return window.RTCIceCandidate;
    }
// config webRTC 
    function GetRTCPeerConnection() {
        window.RTCPeerConnection = window.RTCPeerConnection || window.webkitRTCPeerConnection ||
            window.mozRTCPeerConnection || window.msRTCPeerConnection;
        return window.RTCPeerConnection;
    }

    function GetRTCSessionDescription() {
        window.RTCSessionDescription = window.RTCSessionDescription || window.webkitRTCSessionDescription ||
            window.mozRTCSessionDescription || window.msRTCSessionDescription;
        return window.RTCSessionDescription;
    }

    //Create and send offer to remote peer on button click
    function callUser(user) {
        getCam()
            .then(stream => {
                const localVideo = document.getElementById("local-video");
                if ('srcObject' in localVideo) {
                    localVideo.srcObject = stream;
                } else {
                    localVideo.src = URL.createObjectURL(stream);
                }
                localVideo.play();
    
                // toggleEndCallButton();
    
                caller.addStream(stream);
                localUserMedia = stream;
    
                caller.createOffer().then(function(desc) {
                    caller.setLocalDescription(new RTCSessionDescription(desc));
                    // TriggerPusher(`${channelName}.${auth_id}`, 'sdp',desc);
                    console.log(desc);
                    channel.trigger('client-sdp',{
                        'from' : auth_id,
                        'user_id' : user,
                        'sdp' :desc,
                    });
                    
                });
            })
            .catch(error => {
                console.log('an error occurred', error);
            });
    }

callUser(user_id);
    function endCall(){
        setUserId('');
        caller.close();
        for (let track of localUserMedia.getTracks()) { track.stop() }
        prepareCaller();
        toggleEndCallButton();
    }

    function endCurrentCall(){
        
        channel.trigger("client-endcall", {
            "user_id": user_id
        });

        endCall();
    }

    //Send the ICE Candidate to the remote peer
    function onIceCandidate( evt) {
        // console.log(evt.candidate);
        if (evt.candidate) {
            channel.trigger("client-candidate", {
                "candidate": evt.candidate,
                "user_id": user_id
            });
        }
    }

    function toggleEndCallButton(){
        if(document.getElementById("endCall").style.display == 'block'){
            document.getElementById("endCall").style.display = 'none';
        }else{
            document.getElementById("endCall").style.display = 'block';
        }
    }



    //Listening for the candidate message from a peer sent from onicecandidate handler
    channel.bind("client-candidate", function(msg) {
        if(msg.user_id == user_id){
            console.log("candidate received");
            caller.addIceCandidate(new RTCIceCandidate(msg.candidate));
        }
    });



    //Listening for Session Description Protocol message with session details from remote peer
    channel.bind("client-sdp", function(msg) {
        // console.log(msg)
        if (msg.user_id == auth_id) {
            console.log("SDP received");
            confirm('có thằng muốn gọi cho mày');
            
            getCam()
                .then(stream => {
                    localUserMedia = stream;
                    const localVideo = document.getElementById("local-video");
    
                    if ('srcObject' in localVideo) {
                        localVideo.srcObject = stream;
                    } else {
                        localVideo.src = URL.createObjectURL(stream); // Update this line
                    }
                    
                    caller.addStream(stream);
                    var sessionDesc = new RTCSessionDescription(msg.sdp);
                    
                    caller.setRemoteDescription(sessionDesc)
                        .then(() => {
                            return caller.createAnswer();
                        })
                        .then(sdp => {
                            return caller.setLocalDescription(new RTCSessionDescription(sdp));
                        })
                        .then(() => {
                            channel.trigger("client-answer", {
                                "sdp": caller.localDescription,
                                "user_id": user_id
                            });
                        })
                        .catch(error => {
                            console.log('An error occurred:', error);
                        });
                })
                .catch(error => {
                    console.log('An error occurred:', error);
                });
        }
    });
        


    //Listening for answer to offer sent to remote peer
    channel.bind("client-answer", function(answer) {
        if(answer.user_id==user_id){
            console.log("answer received");
            caller.setRemoteDescription(new RTCSessionDescription(answer.sdp));
        }
        
    });

    channel.bind("client-reject", function(answer) {
        if(answer.user_id==user_id){
            console.log("Call declined");
            alert("call to " + answer.rejected + "was politely declined");
            endCall();
        }
        
    });

     channel.bind("client-endcall", function(answer) {
        if(answer.user_id==user_id){
            console.log("Call Ended");
            endCall();
            
        }
        
    });



    function TriggerPusher(){

    }


    // var btnCall = document.getElementById('call');

    // btnCall.addEventListener('click', function() {
    //     // Call the callUser function passing the user_id
    //     callUser(user_id);
    // });
    