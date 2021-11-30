@extends('tutor.layouts.app')
<link href="{{ asset('assets/css/registration.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/booknow.css') }}" rel="stylesheet">
<script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>
<link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/styles/default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/highlight.min.js"></script>
<script>hljs.highlightAll();</script>
<link rel="shortcut icon" href="https://raw.githubusercontent.com/muaz-khan/RTCMultiConnection/master/demos/logo.png">
  <!-- <link rel="stylesheet" type="text/css" href="https://raw.githubusercontent.com/muaz-khan/RTCMultiConnecti0on/master/demos/css/emojionearea.min.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.2.7/emojionearea.css">

  <script src="https://raw.githubusercontent.com/muaz-khan/RTCMultiConnection/master/demos/js/jquery.min.js"></script>
  <link href="https://raw.githubusercontent.com/muaz-khan/RTCMultiConnection/master/demos/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://rtcmulticonnection.herokuapp.com/node_modules/webrtc-adapter/out/adapter.js"></script>
  <script src="https://rtcmulticonnection.herokuapp.com/dist/RTCMultiConnection.min.js"></script>
  <script src="https://rtcmulticonnection.herokuapp.com/socket.io/socket.io.js"></script>
  <script src="https://rtcmulticonnection.herokuapp.com/node_modules/fbr/FileBufferReader.js"></script>

  <script src="https://rtcmulticonnection.herokuapp.com/node_modules/canvas-designer/dev/webrtc-handler.js"></script>
  <script src="https://rtcmulticonnection.herokuapp.com/node_modules/canvas-designer/canvas-designer-widget.js"></script>
  <!-- <script src="https://raw.githubusercontent.com/muaz-khan/RTCMultiConnection/master/demos/js/emojionearea.min.js"></script> -->

  
  <!-- <script src="/node_modules/multistreamsmixer/MultiStreamsMixer.js"></script> -->
  <style>
.extra-controls {
    position: absolute;
    right: 21%;
}

#btn-comments {
  color: red;
  margin-top: 5px;
  font-size: 24px;
  text-shadow: 1px 1px white;
}
/**Video Adjustment */


/* Call Video Student*/

#other-videos {
    position: relative;
}

#other-videos video {
    width: 100%;
    margin: 0;
    border: none;
    padding: 0;
    border-radius: 3px;
    position:absolute;
    top:0;
}


/* Call Video Student End*/


/*Call Main Video*/

#main-video {
    position: absolute;
    z-index: 9;
    width: 85%;
    margin-top: 0;
    /* border: 1px solid #121010; */
    border-radius: 3px;
    margin: 5px;
    display: block;
    padding: 1px;
}


/*Call main Video End*/


/**Video Adjustment */


#txt-chat-message {
    width: 100%;
    resize: vertical;
    margin: 5px;
    margin-right: 0;
    min-height: 30px;
}

#btn-chat-message {
    margin: 5px;
}


#conversation-panel {
    margin-bottom: 20px;
    text-align: left;
    max-height: 230px;
    /* overflow: auto; */
    /* border-top: 1px solid #E5E5E5; */
    /* width: 100%; */
}

#conversation-panel .message {
    /* border-bottom: 1px solid #E5E5E5; */
    /* padding: 5px 10px; */
    /* margin-right: 15px; */
}
.bg-chat-head{
    background-color:#fefefe !important;
}

#conversation-panel .message img, #conversation-panel .message video, #conversation-panel .message iframe {
    max-width: 100%;
}


hr {
    height: 1px;
    border: 0;
    background: #E5E5E5;
}

#btn-attach-file {
    width: 25px;
    vertical-align: middle;
    cursor: pointer;
    display: none;
}

#btn-share-screen {
    width: 25px;
    vertical-align: middle;
    cursor: pointer;
    display: none;
}

.checkmark {
    display:none;
    width: 15px;
    vertical-align: middle;
}

#screen-viewer {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999999999999;
    display: none;
}
.h-500{
    height:500px !important;
}
.h-200{
    height:220px !important;
    min-height: 65px !important;
}
   .container-police {
  display: grid;
  /* min-width: 1250px; */
  height: 100%;
  grid-template-areas: "infobox infobox infobox"
  "userlistbox chatbox camerabox"
  "empty-container chat-controls chat-controls";
  grid-template-columns: 10em 1fr 500px;
  grid-template-rows: 16em 1fr 5em;
  grid-gap: 1rem;
}

.infobox {
  grid-area: infobox;
  overflow: auto;
}

.userlistbox {
  grid-area: userlistbox;
  border: 1px solid black;
  margin:0;
  padding:1px;
  height:100%;
  list-style:none;
  line-height:1.1;
  overflow-y:auto;
  overflow-x:hidden;
}

.userlistbox li {
  cursor: pointer;
  padding: 1px;
}

.chatbox {
  grid-area: chatbox;
  border: 1px solid black;
  margin: 0;
  overflow-y: scroll;
  padding: 1px;
  padding: 0.1rem 0.5rem;
}

.camerabox {
  grid-area: camerabox;
  /* width: 500px; */
  width: 100%;
  height: 375px;
  border: 1px solid black;
  vertical-align: top;
  display: block;
  position:relative;
  overflow:auto;
}

#received_video {
  width: 100%;
  height: 100%;
  position:absolute;
}

/* The small "preview" view of your camera */
#local_video {
  width: 120px;
  height: 90px;
  position: absolute;
  top: 1rem;
  left: 1rem;
  border: 1px solid rgba(255, 255, 255, 0.75);
  box-shadow: 0 0 4px black;
}

/* The "Hang up" button */
#hangup-button {
  display: block;
    width: 97px;
    height: 60px;
    margin-bottom: 50px;
    border-radius: 8px;
    position: relative;
    margin: auto;
    top: calc(100% - 80px);
    background-color: rgba(150, 0, 0, 0.7);
    border: 1px solid rgba(255, 255, 255, 0.7);
    box-shadow: 0px 0px 1px 2px rgb(0 0 0 / 40%);
    font-size: 14px;
    font-family: "Lucida Grande", "Arial", sans-serif;
    color: rgba(255, 255, 255, 1.0);
  cursor: pointer;
}

#hangup-button:hover {
  filter: brightness(150%);
  -webkit-filter: brightness(150%);
}

#hangup-button:disabled {
  filter: grayscale(50%);
  -webkit-filter: grayscale(50%);
  cursor: default;
}

.empty-container {
  grid-area: empty-container;
}

.chat-controls {
  grid-area: chat-controls;
  width: 100%;
  height: 100%;
}
.callNew{
  height:150px;
  width:100%;
  border:1px solid grey;
}

/* Chat Box */
.h-290{
  height:290px;
  overflow-y:auto;
}
.chatInput{
height:25px;
}
#canvas {
  /* background-image:url("../assets/images/ico/graph.png") */
}
#display{
    border: none;
    text-align: right;
    font-size: 50px;
}
.equal{
    background: #77AFFF;
}
.btnNum{
    background:#fff;
}
/* td input{
    width: 163px !important;
} */
.ck p{
    height:400px !important;
}

.w-20{
    width:20px;
}
.mk,
.vc{
    display:none;
}
.tech_weck-none{
    display:none !important;
}
.w-22{
    width:22%;
}

.h-35{
    height:35px;
}
.nav-whiteBoard-nav{
    border-bottom:2px solid #D6DBE2;
}
.switch {
    width: 50px !important;
    height: 30px !important;
}
.round {
    position: absolute;
    top: -15px !important;
    left: 10px;
    bottom: 25px !important;
}
.bright{
    position:absolute;
    right:0;
    top: 17px;
}
.bright input:checked+.slider {
    background-color: #1173ff;
}

/*End Call Button */
.endBtn{
    padding: 2px 11px 6px 9px;
}
.vid-btn {
    position: absolute !important;
    bottom: 12px;
    left: 7px;
    z-index: 99;
}
.btn-outline-danger{
    border:1px solid red;
}
/*End Call Button End*/

/**Code Editor style */
#editor2 { 
        height:500px;
        width:100%;
    }
/**Code Editor style */
/* Chat Box */
.sender{
            float:right;
            max-width: 75%;
        }
        .reciever {
            max-width: 75%;

        }
        .reciever p,
        .sender p {
            min-width: 100px;
            border: 1px solid #6EAAFF;
            border-radius: 5px;
            padding: 5px;
        }
        .sender p{
            border: 1px solid #D3D8DF;

        }
        .reciever p:hover,
        .sender p:hover {
            cursor: pointer;
        }
        .recDull{
            position: absolute;
            left: 34%;
            color: #BCC0C7;
        }
        .dull {
            /* position: absolute;
            right: 2%; */
            color: #BCC0C7;
        }
        .chatTime {
            float: right;
            font-size: 12px;
        }
        .line-box2 {
            border-bottom: 1px solid #D6DBE2;
            margin-bottom: 10px;
        }
        .textMenu2 {
            color: #00132D;
            position: absolute;
            top: 28%;
            left: 45%;
            display: none;
        }
        .textMenu {
            color: #00132D;
            position: absolute;
            top: 40%;
            right: 53%;
        }
        .textMenu2 i,
        .textMenu i {
            font-size: 22px;
        }
        /* Textarea */
        .emojionearea .emojionearea-editor{
            margin-right:51px !important;
        }
        /* Textarea End*/

        /*Chat Box End */

        /* No Cam Overlay */
.overlayCam{
    display:none;
    background-color:#00132D;
    position:absolute;
    top:0;
    bottom:0;
    left:0;
    right:0;
    z-index: 9999999999999999999999999999999999999999999999;
    
}

        /* No Cam Overlay End */

        /* Cam Modal */
        .w-62{
            width:62%;
        }
        /* Cam Modal */

</style>
@section('content')
 <!-- top Fixed navbar End -->
 <section>

 <!--  -->
    <input type="hidden" id="class_room_id" value="{{$class->id}}">
    <input type="hidden" id="class_date" value="{{$booking->class_date}}">
    <input type="hidden" id="class_time" value="{{$booking->class_time}}">
    <input type="hidden" id="class_total_duration" value="{{$booking->duration}}">

    <div class="content-wrapper " style="overflow: hidden;">
        <div class="container-fluid">
            <div class="row callDiv ml-2 mr-2 mt-4" >
                <div class="col-md-8 text-center rounded bg-dark ">
                    <video id="main-video2" class=" w-62" playsinline autoplay></video>

                    <!-- @if($user->picture)
                        @if(file_exists( public_path(). $user->picture))
                            <img src="{{asset($user->picture)}}" class="profile-img pg" alt="">
                        @else
                            <img src="{{asset('assets/images/ico/Square-white.jpg')}}"  class="profile-img pg" alt="">
                        @endif
                    @else
                        <img src="{{asset('assets/images/ico/Square-white.jpg')}}" class="profile-img pg" alt="">
                    @endif -->
                </div>
                <div class="col-md-4  mt-3">
                    <div class="m-2">
                        <p class="heading-fifth">Ideal Criterias: </p>
                        <ul style="list-style: disc;">
                            <li>Allow Notifications.</li>
                            <li>Audio device should be working properly.</li>
                            <li>Tutor Camera's compulsory for conducting a class.</li>
                            <li>If not working correctly, try to deactivate any third party extension.</li>
                            <li>Avoid Incognito Mode.</li>

                        </ul>
                        <div class="text-center">
                            <button type="button" role="button"  id="join_now"  class="schedule-btn ">
                                Start Class
                            </button>
                            <p class="hide" id="p1">/student/class/{{$class->classroom_id}}</p>
                            <button type="button" role="button" id="" onclick="copyToClipboard('p1')" class="cencel-btn ">
                                <i class="fa fa-clone" aria-hidden="true"></i> Copy Class Link
                            </button>
                            <input type="hidden" id="" placeholder="Paste here for test" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
 
@endsection
@section('scripts')
@include('js_files.whiteBoard')
<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.2.7/emojionearea.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://www.webrtc-experiment.com/DetectRTC.js"></script>
<script>


     // var timerInstance = new easytimer.Timer();
     var editor2 = ace.edit("editor2");
    editor2.setTheme("ace/theme/monokai");
    editor2.session.setMode("ace/mode/javascript");


    $(document).ready(function(){
        // $(".tech_weck").hide();
        $(".mk").hide();
        $(".vc").hide();
        // $("#callModal").modal("show");
        $("#main-video").attr("poster","{{asset('assets/images/ico/Mute-video.png')}}");
        // saveClassLogs();

    })

    // $("#join_now").click(function(){
    //     $(".tech_weck").show();;
    //     $("#callModal").modal("hide");
    //     joinClass();
    // })
    $(".no-mk").click(function(){
       
        $(".no-mk").hide();
        $(".mk").show();
    });
    $(".mk").click(function(){
       
        $(".no-mk").show();
        $(".mk").hide();
    });
    $(".no-vc").click(function(){
       
       $(".no-vc").hide();
       $(".vc").show();
   });
   $(".vc").click(function(){
      
       $(".vc").hide();
       $(".no-vc").show();
   });
   
    $("#conCam").click(function(){
        $(".overlayCam").css("display","none");
    })
</script>


<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
        function cheng(){
            var ter = $(this).html();
            // alert(ter);
            $('.language-html').text(ter);
        }
</script>

<script>


var connection = new RTCMultiConnection();
console.log(connection , "connection");
var roomid = '{{$class->classroom_id}}';
var fullName = '{{$booking->tutor->first_name}} {{$booking->tutor->last_name}}';
var deadline = '00:05:00'; 
var resced = '00:15:00'; 
var class_duration = {{$booking->duration}};
var class_id = {{$booking->id}};

// var class_duration = 20;
var timer = new Timer();

// connection.socket.to('3mdzdzm1a5d').emit("private message", "sdfsdfsdf")


(function() {
    var params = {},
        r = /([^&=]+)=?([^&]*)/g;

    function d(s) {
        return decodeURIComponent(s.replace(/\+/g, ' '));
    }
    var match, search = window.location.search;
    while (match = r.exec(search.substring(1)))
        params[d(match[1])] = d(match[2]);
    window.params = params;
})();

//connection.socketURL = '/';
// connection.socketURL = 'https://rtcmulticonnection.herokuapp.com:443/';

// connection.socketURL = 'https://tutorvy.herokuapp.com:443/';
connection.socketURL = 'https://tutorvy.herokuapp.com:443/';


connection.extra.userFullName = fullName;
if (connection.DetectRTC.isWebRTCSupported === false) {
    alert('Please try a WebRTC compatible web browser e.g. Chrome, Firefox or Opera.');
}
connection.DetectRTC.load(function() {
    console.log(connection.DetectRTC);
    if (connection.DetectRTC.hasMicrophone === true) {
        if(connection.DetectRTC.isWebsiteHasMicrophonePermissions === false){
           
            $(".overlayCam").css("display","block");
                $(".overlayCam").find("h3").text("Your Microphone is Blocked");
                $(".overlayCam").find("h5").text("Tutorvy needs access to your microphone. To get 100% result");
                $(".overlayCam").find("#conCam").hide();
        }else{
             // enable microphone
            connection.mediaConstraints.audio = true;
            connection.session.audio = true;
            // alert('attach true microphone')
            // $(".no-mk").show();
            $("#join_now").removeAttr("disabled","disabled" );
                $("#join_now").click(function(){
                    $(".tech_weck").removeClass("tech_weck-none");
                    $(".callDiv").hide();
                    // joinClass();

                    /** Javascript Timer */
                    // timer.start({countdown: true, startValues: {hours: class_duration}});

                    // $('#countdownExample .values').html(timer.getTimeValues().toString());

                    // timer.addEventListener('secondsUpdated', function (e) {

                    //     var ter =$('.values').text();
                        
                    //     if( ter == deadline ){
                            
                    //         $(".values").css("color","#dc3545");
                    //         // $(".Text-reck").text("Class will end in Five minutes sharp.");
                    //     }
                    //     else if( ter == resced ){
                    //         $(".values").css("color","#ffc107");
                    //         // let html = `<p class="mb-0">Do you want to reschedule another class? <a href="">Yes</a> or  <a href="">No</a> </p>`
                    //         // $(".Text-reck").html(html);
                    //     }
                    //     else if( ter >= resced ){
                    //         $(".values").css("color","#28a745");
                    //         // $(".Text-reck").text("Class will ends in: ");

                    //     }

                    //     $('#countdownExample .values').html(timer.getTimeValues().toString());
                    // });

                    // timer.addEventListener('targetAchieved', function (e) {
                    //     $('#endCall').modal("show");
                    // });
                    /* Javascript Timer ENd */
                })
        }
       
    }else{
        toastr.warning( "Audio Device is Mendatory ");
        $(".no-mk").hide();
    }

    if (connection.DetectRTC.hasWebcam === true) {

        // enable camera
        if(connection.DetectRTC.isWebsiteHasWebcamPermissions === false){

            $(".overlayCam").css("display","block");
        }
        if(connection.DetectRTC.videoInputDevices.length > 0){
            var varr = connection.DetectRTC.videoInputDevices;
            for(var v = 0 ; v < varr.length ; v++){
                if(varr[v].deviceId != undefined){
                    console.log(connection.DetectRTC)
                    connection.mediaConstraints.video = true;
                    connection.session.video = true;
                    // $(".overlayCam").css("display","none");
                    // alert('attach true camera');
                }else{
                    console.log(connection.DetectRTC)
                    // connection.dontCaptureUserMedia = true;
                    // connection.DetectRTC.isWebsiteHasWebcamPermissions
                    connection.mediaConstraints.video = false;
                    connection.session.video = false;
                    // alert('no camera')
                    // connection.dontCaptureUserMedia = true;
                    
                    // connection.mediaConstraints.video = true;
                    // connection.session.video = true;
                   
                }
            }
        }else{

        }

        
        $(".no-vc").show();


    }else{
        $(".no-vc").hide();

        // alert('attach Cam')
    }

    

    if (connection.DetectRTC.hasSpeakers === false) { // checking for "false"
        // alert('Please attach a speaker device. You will unable to hear the incoming audios.');
    }
});
// On mute Screen
connection.onmute = function (e) {
    if (e && e.mediaElement)
        if ("both" === e.muteType || "video" === e.muteType) {
            e.mediaElement.src = null;
            var paused = e.mediaElement.pause();
            "undefined" != typeof paused
                ? paused.then(function () {
                      e.mediaElement.poster = e.snapshot || "{{asset('assets/images/ico/Mute-video.png')}}";
                  })
                : (e.mediaElement.poster = e.snapshot || "{{asset('assets/images/ico/Mute-video.png')}}");
        } else "audio" === e.muteType && (e.mediaElement.muted = !0);
};

$("#join_now").click(function (){
    
    if(connection.DetectRTC.isWebsiteHasMicrophonePermissions === false){
        
        $("#permissionCall").modal("show");
    }
    else if(connection.DetectRTC.isWebsiteHasWebcamPermissions === false){
        $("#permissionCall").modal("show");
    }
    else{
                $(".tech_weck").removeClass("tech_weck-none");
                $(".callDiv").hide();
                // joinClass();
                /** Javascript Timer */
                //  timer = new Timer();
                //     timer.start({countdown: true, startValues: {seconds: 30}});

                //     $('#countdownExample .values').html(timer.getTimeValues().toString());

                //     timer.addEventListener('secondsUpdated', function (e) {
                //         $('#countdownExample .values').html(timer.getTimeValues().toString());
                //     });

                //     timer.addEventListener('targetAchieved', function (e) {
                //         $('#countdownExample .values').html('Class Time has Ended!!');
                //     });
                /* Javascript Timer ENd */
    }
});
$(".no-ph").click(function(){
    // $("#endCall").modal("show");
    // toastr.success("Student has ended the call!");
    toastr.success('Please wait while we are confirming from student if he needs anything else.', {
        position: 'top-end',
        icon: 'success',
        showConfirmButton: false,
        timer: 4500,
    });
    connection.send({
        call_confirmation: true
    });
});
// On mute Screen End

/// make this room public
connection.publicRoomIdentifier = '';

connection.socketMessageEvent = 'canvas-dashboard-demo';

// keep room opened even if owner leaves
// connection.autoCloseEntireSession = true;

// https://www.rtcmulticonnection.org/docs/maxParticipantsAllowed/
// connection.maxParticipantsAllowed = 1000;
// set value 2 for one-to-one connection
connection.maxParticipantsAllowed = 2;

// here goes canvas designer
var designer = new CanvasDesigner();

// you can place widget.html anywhere
designer.widgetHtmlURL = "{{route('whiteBoard.canvas')}}";
designer.widgetJsURL = "{{asset('assets/js/widget.min.js').'?ver='.rand()}}";

designer.addSyncListener(function(data) {
    connection.send(data);
});

designer.setSelected('pencil');

designer.setTools({
        pencil: true,
        text: true,
        image: false,
        pdf: false,
        eraser: true,
        line: true,
        arrow: false,
        dragSingle: true,
        dragMultiple: true,
        arc: true,
        rectangle: true,
        quadratic: false,
        bezier: false,
        marker: false,
        zoom: false,
        lineWidth: false,
        colorsPicker: false,
        extraOptions: false,
        code: false,
        undo: true,
    });

// here goes RTCMultiConnection
connection.sessionid = roomid;
connection.isInitiator = true;
connection.chunkSize = 16000;
connection.enableFileSharing = true;

connection.session.data =  true;

connection.sdpConstraints.mandatory = {
    OfferToReceiveAudio: true,
    OfferToReceiveVideo: false
};

connection.onUserStatusChanged = function(event) {
    
    var infoBar = document.getElementById('onUserStatusChanged');
    var names = [];
    // console.log(connection.getAllParticipants())
    connection.getAllParticipants().forEach(function(pid) {
        // alert(getFullName(pid))
        names.push(getFullName(pid));
        // if(fullName != getFullName(pid)){
        //     toastr.success(getFullName(pid) + " Joined the class.");
        // }
        if ($('#other-videos').contents().length == 0){
            let vhtml = `<video poster="{{asset('assets/images/ico/Mute-video.png')}}"></video>`;
            $("#other-videos").append(vhtml);
            $("#main-video").css("width","30%");
        }
    });

    if (!names.length) {
        names = ['Only You'];
    } else {
        names = [connection.extra.userFullName || 'You'].concat(names);
    }
    // infoBar.innerHTML = '<b>Active users:</b> ' + names.join(', ');
};

connection.onopen = function(event) {
    // connection.onUserStatusChanged(event);

    if (designer.pointsLength <= 0) {
        // make sure that remote user gets all drawings synced.
        setTimeout(function() {
            connection.send('plz-sync-points');
        }, 1000);
    }

    document.getElementById('btn-chat-message').disabled = false;
    document.getElementById('btn-attach-file').style.display = 'inline-block';
    // document.getElementById('btn-share-screen').style.display = 'inline-block';
};
// connection.leave();

connection.onclose = connection.onerror = connection.onleave = function(event) {

    // toastr.success("Student has ended the call!");
    $("#main-video").css("width","85%")
    // connection.onUserStatusChanged(event);
};

connection.onmessage = function(event) {
    console.log(event)
    if(event.data.showMainVideo) {
        // $('#main-video').show();
        $('#screen-viewer').css({
            top: $('#widget-container').offset().top,
            left: $('#widget-container').offset().left,
            width: $('#widget-container').width(),
            height: $('#widget-container').height()
        });
        $('#screen-viewer').show();
        return;
    }

    if(event.data.hideMainVideo) {
        // $('#main-video').hide();
        $('#screen-viewer').hide();
        return;
    }

    if(event.data.typing === true) {
        $('#key-press').show().find('span').html(event.extra.userFullName + ' is typing');
        return;
    }

    if(event.data.typing === false) {
        $('#key-press').hide().find('span').html('');
        return;
    }

    if(event.data.call_ended === true){
        toastr.success("Class has Ended.");
        window.location.href="{{route('tutor.classroom')}}";
    }
    if(event.data.class_joined === true){
        toastr.success(event.extra.userFullName + ' Joined the class.');
        console.log(timer)
        connection.send({
            is_timer:true,
            time_value:timer
        })
    }

    if (event.data.chatMessage) {
        appendChatMessage(event);
        return;
    }

    if (event.data.checkmark === 'received') {
        var checkmarkElement = document.getElementById(event.data.checkmark_id);
        if (checkmarkElement) {
            checkmarkElement.style.display = 'inline';
        }
        return;
    }

    if (event.data === 'plz-sync-points') {
        designer.sync();
        return;
    }

    designer.syncData(event.data);
};

// extra code

connection.onstream = function(event) {
    if (event.stream.isScreen && !event.stream.canvasStream) {
        $('#screen-viewer').get(0).srcObject = event.stream;
        $('#screen-viewer').hide();
        
    }
    else if (event.extra.roomOwner === true) {

        var video = document.getElementById('main-video');
        var video2 = document.getElementById('main-video2');
        video.setAttribute('data-streamid', event.streamid);
        video2.setAttribute('data-streamid', event.streamid);
        video.style.display = 'none';
        if(event.type === 'local') {
            video.muted = true;
            video.volume = 0;
            video2.muted = true;
            video2.volume = 0;
        }
        video.srcObject = event.stream;
        $('#main-video').show();
        video2.srcObject = event.stream;
        $('#main-video2').show();
    } 
    else {
        event.mediaElement.controls = false;
        $("#main-video").css("width","30%");
        var otherVideos = document.querySelector('#other-videos');
        otherVideos.appendChild(event.mediaElement);
    }
    // connection.onUserStatusChanged(event);
};

connection.onstreamended = function(event) {
    var video = document.querySelector('video[data-streamid="' + event.streamid + '"]');
    if (!video) {
        video = document.getElementById(event.streamid);
        if (video) {
            video.parentNode.removeChild(video);
            return;
        }
    }
    if (video) {
        video.srcObject = null;
        video.style.display = 'none';
    }
};
// $(".no-vc").click(function(){
//     // alert("No vc");
//     var localStream = connection.attachStreams[0];
//     localStream.mute('video');
// })
// $(".vc").click(function(){
//     // alert("Vc");
//     var localStream = connection.attachStreams[0];
//     localStream.unmute('video'); 
    
// })
// $(".no-mk").click(function(){
//     // alert("No mk");
//     var localStream = connection.attachStreams[0];
//     localStream.mute('audio');
// })
// $(".mk").click(function(){
//     // alert("mk");
//     var localStream = connection.attachStreams[0];
//     localStream.unmute('audio'); 
    
// })
$("#endCallYes").click(function(){
    // connection.leave();
    connection.send({
        call_ended: true
    });
    $("#endCall").modal("hide");
    $(".content-wrapper").css("display",'none');

    toastr.success("Class has Ended.");

    window.location.href="{{route('tutor.classroom')}}";

});
var conversationPanel = document.getElementById('conversation-panel');

function appendChatMessage(event, checkmark_id) {
    var div = document.createElement('div');

    div.className = 'message col-md-12';

    if (event.data) {
        // div.innerHTML = '<b>' + (event.extra.userFullName || event.userid) + ':</b><br>' + event.data.chatMessage;
        div.innerHTML = `<div class="reciever pull-left">
                            <small>From `+ (event.extra.userFullName || event.userid) +`</small>
                            <p class="senderText mb-0">`+event.data.chatMessage+`</p>
                            <small class="dull">1min ago</small>
                        </div>`
        if (event.data.checkmark_id) {
            connection.send({
                checkmark: 'received',
                checkmark_id: event.data.checkmark_id
            });
        }
    } else {
        // div.innerHTML = '<b>You:</b> <img class="checkmark" id="' + checkmark_id + '" title="Received" src="https://www.webrtc-experiment.com/images/checkmark.png"><br>' + event;
        // div.style.background = '#cbffcb';
        div.innerHTML =    `<div class="sender">
                                            <small>From Me <img class="checkmark" id="' + checkmark_id + '" title="Received" src="https://www.webrtc-experiment.com/images/checkmark.png"></small>
                                            <p class="senderText mb-0">`+ event+` </p>
                                            <small class="dull">1min ago</small>
                                        </div>`
    }

    conversationPanel.appendChild(div);

    conversationPanel.scrollTop = conversationPanel.clientHeight;
    conversationPanel.scrollTop = conversationPanel.scrollHeight - conversationPanel.scrollTop;
};

var keyPressTimer;
var numberOfKeys = 0;
$('#txt-chat-message').emojioneArea({
    pickerPosition: "top",
    filtersPosition: "bottom",
    tones: false,
    autocomplete: true,
    inline: true,
    hidePickerOnBlur: true,
    events: {
        focus: function() {
            $('.emojionearea-category').unbind('click').bind('click', function() {
                $('.emojionearea-button-close').click();
            });
        },
        keyup: function(e) {
            var chatMessage = $('.emojionearea-editor').html();
            if (!chatMessage || !chatMessage.replace(/ /g, '').length) {
                connection.send({
                    typing: false
                });
            }


            clearTimeout(keyPressTimer);
            numberOfKeys++;

            if (numberOfKeys % 3 === 0) {
                connection.send({
                    typing: true
                });
            }

            keyPressTimer = setTimeout(function() {
                connection.send({
                    typing: false
                });
            }, 1200);
        },
        blur: function() {
            // $('#btn-chat-message').click();
            connection.send({
                typing: false
            });
        }
    }
});

window.onkeyup = function(e) {
    var code = e.keyCode || e.which;
    if (code == 13) {
        $('#btn-chat-message').click();
    }
};

document.getElementById('btn-chat-message').onclick = function() {
    var chatMessage = $('.emojionearea-editor').html();
    $('.emojionearea-editor').html('');

    if (!chatMessage || !chatMessage.replace(/ /g, '').length) return;

    var checkmark_id = connection.userid + connection.token();

    appendChatMessage(chatMessage, checkmark_id);

    connection.send({
        chatMessage: chatMessage,
        checkmark_id: checkmark_id
    });

    connection.send({
        typing: false
    });
};

var recentFile;
document.getElementById('btn-attach-file').onclick = function() {
    var file = new FileSelector();
    file.selectSingleFile(function(file) {
        recentFile = file;

        if(connection.getAllParticipants().length >= 1) {
            recentFile.userIndex = 0;
            connection.send(file, connection.getAllParticipants()[recentFile.userIndex]);
        }
    });
};

function getFileHTML(file) {
    var url = file.url || URL.createObjectURL(file);
    var attachName= '<a href="' + url + '" target="_blank" download="' + file.name + '" style="color:inherit;"><small>' + file.name + '</small></a>';
    var attachment = '';

    if (file.name.match(/\.jpg|\.png|\.jpeg|\.gif/gi)) {
        attachment += `<img crossOrigin="anonymous" src="` + url + `">
        `+attachName+` `;
    } else if (file.name.match(/\.wav|\.mp3/gi)) {
        attachment += `<audio src="` + url + `" controls></audio>
        `+attachName+``;
    } else if (file.name.match(/\.pdf|\.js|\.txt|\.sh/gi)) {
        attachment += `<iframe class="inline-iframe" src="` + url + `"></iframe></a>
        `+attachName+``;
    }
    return attachment;
};

function getFullName(userid) {
    var _userFullName = userid;
    if (connection.peers[userid] && connection.peers[userid].extra.userFullName) {
        _userFullName = connection.peers[userid].extra.userFullName;
    }
    return _userFullName;
};

connection.onFileEnd = function(file) {
    var html = getFileHTML(file);
    var div = progressHelper[file.uuid].div;

    if (file.userid === connection.userid) {
        // div.innerHTML = '<b>You:</b><br>' + html;
        // div.style.background = '#cbffcb';
        div.innerHTML =   `<div class="sender">
                            <small>From me</small>
                            <p class="senderText mb-0 text-center">
                                `+html+`
                            </p>
                            <small class="dull">1min ago</small>
                        </div>`;

        if(recentFile) {
            recentFile.userIndex++;
            var nextUserId = connection.getAllParticipants()[recentFile.userIndex];
            if(nextUserId) {
                connection.send(recentFile, nextUserId);
            }
            else {
                recentFile = null;
            }
        }
        else {
            recentFile = null;
        }
    } else {
        // div.innerHTML = '<b>' + getFullName(file.userid) + ':</b><br>' + html;
        div.innerHTML =   `<div class="reciever pull-left">
                            <small>From `+getFullName(file.userid) + `</small>
                            <p class="senderText mb-0 text-center">
                                `+html+`
                            </p>
                            <small class="dull">1min ago</small>
                        </div>`;
    }
};

// to make sure file-saver dialog is not invoked.
connection.autoSaveToDisk = false;

var progressHelper = {};

connection.onFileProgress = function(chunk, uuid) {
    var helper = progressHelper[chunk.uuid];
    helper.progress.value = chunk.currentPosition || chunk.maxChunks || helper.progress.max;
    updateLabel(helper.progress, helper.label);
};

connection.onFileStart = function(file) {
    var div = document.createElement('div');
    div.className = 'message col-md-12';

    if (file.userid === connection.userid) {
        var userFullName = file.remoteUserId;
        if(connection.peersBackup[file.remoteUserId]) {
            userFullName = connection.peersBackup[file.remoteUserId].extra.userFullName;
        }

        // div.innerHTML = '<b>You (to: ' + userFullName + '):</b><br><label>0%</label> <progress></progress>';
        // div.style.background = '#cbffcb';
        div.innerHTML = `<div class="sender">
                            <small>From me</small>
                            <p class="senderText mb-0">
                                <label>0%</label> <progress></progress>
                            </p>
                            <small class="dull">3min ago</small>
                        </div>`;
    } else {
        // div.innerHTML = '<b>' + getFullName(file.userid) + ':</b><br><label>0%</label> <progress></progress>';
        div.innerHTML = `<div class="reciever pull-left">
                            <small>`+getFullName(file.userid) +`</small>
                            <p class="senderText mb-0">
                                <label>0%</label> <progress></progress>
                            </p>
                            <small class="dull">3min ago</small>
                        </div>`
    }

    div.title = file.name;
    conversationPanel.appendChild(div);
    progressHelper[file.uuid] = {
        div: div,
        progress: div.querySelector('progress'),
        label: div.querySelector('label')
    };
    progressHelper[file.uuid].progress.max = file.maxChunks;

    conversationPanel.scrollTop = conversationPanel.clientHeight;
    conversationPanel.scrollTop = conversationPanel.scrollHeight - conversationPanel.scrollTop;
};

function updateLabel(progress, label) {
    if (progress.position == -1) return;
    var position = +progress.position.toFixed(2).split('.')[1] || 100;
    label.innerHTML = position + '%';
};

// if(!!params.password) {
//     connection.password = params.password;
// }

designer.appendTo(document.getElementById('widget-container'), function() {
    // if (params.open === true || params.open === 'true') {
    var tempStreamCanvas = document.getElementById('temp-stream-canvas');
    var tempStream = tempStreamCanvas.captureStream();
    tempStream.isScreen = true;
    tempStream.streamid = tempStream.id;
    tempStream.type = 'local';
    connection.attachStreams.push(tempStream);
    window.tempStream = tempStream;

    connection.extra.roomOwner = true;

    connection.openOrJoin(roomid, function(isRoomOpened, roomid, error) {
        if (error) {
            if (error === connection.errors.ROOM_NOT_AVAILABLE) {
                alert('Someone already created this room. Please either join or create a separate room.');
                return;
            }
            alert(error);
        }

        var class_date = $("#class_date").val();
        var class_time = $("#class_time").val();
        var class_total_duration = $("#class_total_duration").val();

        var bookings = new Date(class_date + ' ' + class_time);
        var booking_seconds = HmsToSeconds(moment(bookings).format('HH:mm:ss')) ;

        var today_date = new Date();
        var today_date_seconds = HmsToSeconds(moment(today_date).format('HH:mm:ss'));


        var class_end = moment(bookings).add(class_total_duration,'h').format("HH:mm:ss");
        var create_class_end_date = new Date(class_date + ' ' + class_end);
        var class_end_seconds = HmsToSeconds(moment(create_class_end_date).format('HH:mm:ss'));

        var remain_seconds = class_end_seconds - today_date_seconds;

        /** Javascript Timer */
        timer.start({countdown: true, startValues: {seconds: remain_seconds}});

        $('#countdownExample .values').html(timer.getTimeValues().toString());
        // timer.addEventListener('secondsUpdated', function (e) {

        //     var ter = $('.values').text();
            
        //     if( ter < deadline ){
                
        //         $(".values").css("color","#dc3545");
        //         // $(".Text-reck").text("Class will end in Five minutes sharp.");
        //     }
        //     else if( ter == resced || ter < resced && ter > deadline){
        //         $(".values").css("color","#ffc107");
        //         // let html = `<p class="mb-0">Do you want to reschedule another class? <a href="">Yes</a> or  <a href="">No</a> </p>`
        //         // $(".Text-reck").html(html);
        //     }
        //     else if( ter >= resced ){
        //         $(".values").css("color","#28a745");
        //         // $(".Text-reck").text("Class will ends in: ");

        //     }

        //     $('#countdownExample .values').html(timer.getTimeValues().toString());
        // });
        timer.addEventListener('secondsUpdated', function (e) {
            $('#countdownExample .values').html(timer.getTimeValues().toString());
            ter = $('.values').text();
            if( ter < deadline ){
                $(".blink").css("background","#dc3545");
                $(".Text-reck").text("Class will end in Five minutes sharp.");
            }
            else if( ter == resced || ter < resced && ter > deadline ){
                $(".blink").css("background","#ffc107");
                let html = `<p class="mb-0">Want to reschedule another class? Its the time! </p>`
                $(".Text-reck").html(html);
            }
            else if( ter > resced ){
                $(".blink").css("background","#28a745");
                $(".Text-reck").text("Class will ends in: ");

            }
            
        });

        timer.addEventListener('targetAchieved', function (e) {
          
            // endclass();
            // $('#endCall').modal("show");
          
        });
        /* Javascript Timer ENd */

        if(today_date_seconds > class_end_seconds) {
            $('#countdownExample .values').html("Class Time Over");
            // $('#endCall').modal("show");
            // endclass();
          
        }

        // start timer here
        var video = document.getElementById('main-video');
        video.setAttribute('data-streamid', event.streamid);
            saveClassLogs();
            connection.socket.on('disconnect', function() {
                location.reload();
        });
    });
    
});

function addStreamStopListener(stream, callback) {
    stream.addEventListener('ended', function() {
        callback();
        callback = function() {};
    }, false);

    stream.addEventListener('inactive', function() {
        callback();
        callback = function() {};
        
    }, false);

    stream.getTracks().forEach(function(track) {
        track.addEventListener('ended', function() {
            callback();
            callback = function() {};
        }, false);

        track.addEventListener('inactive', function() {
            callback();
            callback = function() {};
        }, false);
    });
};

function replaceTrack(videoTrack, screenTrackId) {
    if (!videoTrack) return;
    if (videoTrack.readyState === 'ended') {
        alert('Can not replace an "ended" track. track.readyState: ' + videoTrack.readyState);
        return;
    }
    connection.getAllParticipants().forEach(function(pid) {
        var peer = connection.peers[pid].peer;
        if (!peer.getSenders) return;
        var trackToReplace = videoTrack;
        peer.getSenders().forEach(function(sender) {
            if (!sender || !sender.track) return;
            if(screenTrackId) {
                if(trackToReplace && sender.track.id === screenTrackId) {
                    sender.replaceTrack(trackToReplace);
                    trackToReplace = null;
                }
                return;
            }

            if(sender.track.id !== tempStream.getTracks()[0].id) return;
            if (sender.track.kind === 'video' && trackToReplace) {
                sender.replaceTrack(trackToReplace);
                trackToReplace = null;
            }
        });
    });
};

function replaceScreenTrack(stream) {
    stream.isScreen = true;
    stream.streamid = stream.id;
    stream.type = 'local';

    // connection.attachStreams.push(stream);
    connection.onstream({
        stream: stream,
        type: 'local',
        streamid: stream.id,
        // mediaElement: video
    });

    var screenTrackId = stream.getTracks()[0].id;
    addStreamStopListener(stream, function() {
        connection.send({
            hideMainVideo: true
        });

        // $('#main-video').hide();
        $('#screen-viewer').hide();
        $('#btn-share-screen').show();
        replaceTrack(tempStream.getTracks()[0], screenTrackId);
    });

    stream.getTracks().forEach(function(track) {
        if(track.kind === 'video' && track.readyState === 'live') {
            replaceTrack(track);
        }
    });

    connection.send({
        showMainVideo: true
    });

    // $('#main-video').show();
    $('#screen-viewer').css({
            top: $('#widget-container').offset().top,
            left: $('#widget-container').offset().left,
            width: $('#widget-container').width(),
            height: $('#widget-container').height()
        });
    $('#screen-viewer').show();
};

$('#btn-share-screen').click(function() {
    if(!window.tempStream) {
        alert('Screen sharing is not enabled.');
        return;
    }

    $('#btn-share-screen').hide();

    if(navigator.mediaDevices.getDisplayMedia) {
        navigator.mediaDevices.getDisplayMedia(mediaConstraints).then(stream => {
            replaceScreenTrack(stream);
        }, error => {
            alert('Please make sure to use Edge 17 or higher.');
        });
    }
    else if(navigator.getDisplayMedia) {
        navigator.getDisplayMedia(mediaConstraints).then(stream => {
            replaceScreenTrack(stream);
        }, error => {
            alert('Please make sure to use Edge 17 or higher.');
        });
    }
    else {
        alert('getDisplayMedia API is not available in this browser.');
    }
});

var count = 2;

/* Add New Board Section */

$("#addNewBoard").click(function(){
    var techno = `
        <a class="nav-item white-item nav-link board-nav active" id="nav-whiteboard-`+count+`" data-toggle="tab" href="#nav-home-`+count+`" role="tab" aria-controls="nav-profile" aria-selected="false">Board `+count+` <i class="pl-2 fa fa-times text-dark"></i></a>
    `;
    var tech = `
            <div class="tab-pane fade show active whitePane" id="nav-home-`+count+`" role="tabpanel" aria-labelledby="nav-home-tab">                                                    
                <div class="row">
                    <div class="col-md-12 h-500 mb-5">
                        <div class="" id="widget-container" style=""></div>
                        <video id="screen-viewer"  playsinline ></video>
                    </div>
                </div>
            </div>`;
    $(".board-nav").removeClass("active");
    $(".whitePane").removeClass("show");
    $(".newTabs").prepend(techno);
    $(".newWhite").append(tech);
    // alert("New Board Added");
    count++;
});

function saveClassLogs() {

    var current_date_time = moment(new Date()).format('YYYY-MM-DD h:m:s');
    var class_room_id = $("#class_room_id").val();

    var form_data = {
        tutor_join_time : current_date_time, 
        class_room_id : class_room_id,
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{route('tutor.class.logs')}}",
        type: "POST",
        data:form_data,
        success:function(response){
            console.log(response);
        },
        error:function(e) {
            console.log(e)
        }
    });

};
function copyToClipboard(elementId) {

    // Create a "hidden" input
    var aux = document.createElement("input");

    // Assign it the value of the specified element
    aux.setAttribute("value", document.getElementById(elementId).innerHTML);

    // Append it to the body
    document.body.appendChild(aux);
   
    // Highlight its content
    aux.select();

    // Copy the highlighted text
    document.execCommand("copy");

    // Remove it from the body
    document.body.removeChild(aux);

    toastr.success("Link Copied Successfully");

};
/* Add New Board Section */


// seconds to hms
function secondsToHms(secs) {
    var sec_num = parseInt(secs, 10);
    var hours = Math.floor(sec_num / 3600);
    var minutes = Math.floor(sec_num / 60) % 60;
    var seconds = sec_num % 60;

    var h = hours < 10 ? "0" + hours : hours;
    var m = minutes < 10 ? "0" + minutes : minutes;
    var s = seconds < 10 ? "0" + seconds : seconds;

    var fin = h + ":" + m + ":" + s;
    return fin;
};

// hms to seconds
function HmsToSeconds(hms) {
    // var hms = '02:04:33';
    var a = hms.split(':'); // split it at the colons

    // minutes are worth 60 seconds. Hours are worth 60 minutes.
    var seconds = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]);
    return seconds;
}
if ($("#reviewModal").hasClass("show")) {
  $(".content-wrapper").css("display","none");
};

$(".s_status").change(function(){
    if($(this).prop("checked") == true){
        if(!window.tempStream) {
        alert('Screen sharing is not enabled.');
        return;
    }

    $('#btn-share-screen').hide();

    if(navigator.mediaDevices.getDisplayMedia) {
        navigator.mediaDevices.getDisplayMedia(mediaConstraints).then(stream => {
            replaceScreenTrack(stream);
        }, error => {
            alert('Please make sure to use Edge 17 or higher.');
        });
    }
    else if(navigator.getDisplayMedia) {
        navigator.getDisplayMedia(mediaConstraints).then(stream => {
            replaceScreenTrack(stream);
        }, error => {
            alert('Please make sure to use Edge 17 or higher.');
        });
    }
    else {
        alert('getDisplayMedia API is not available in this browser.');
    }
    }else{
       //run code
       alert('unchecked')

    }
});

function endclass(){

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{route('tutor.class.end')}}",
        type: "POST",
        data:{id:class_id},
        success:function(response){
            console.log(response);
            if(response.status_code == 200){
                toastr.success(response.message,{
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2500
            });
            setInterval(function(){
                        window.location.href = "{{ route('tutor.booking') }}";
                    }, 1500);
            }
            
        },
        error:function(e) {
            console.log(e)
        }
    });

}

</script>


@endsection