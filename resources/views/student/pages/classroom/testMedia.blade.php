@extends('student.layouts.app')
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

<link href="{{ asset('assets/css/modal.css') }}" rel="stylesheet">
  
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

#conversation-panel .message img, #conversation-panel .message video, #conversation-panel .message iframe {
    max-width: 100%;
}

.bg-chat-head{
    background-color:#fefefe !important;
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
    max-height:230px !important;
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
  background-image:url("../assets/images/ico/graph.png")
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
.cust_vid{
    height: 132px;
    padding-top: 16%; 
    border-radius:4px;
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
/*Whiteboard nav Border */
.nav .nav-item {
    text-align: left !important;
    color: #00132D;
    font-size: 16px;
    opacity: 0.51;
    font-weight: 600;
}
.nav-whiteBoard-nav{
    border-bottom:2px solid #D6DBE2;
}

/**Nav Border */
/**Switch */
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
.rating-stars ul > li{
    cursor: pointer;
}
.rating-stars ul > li.star.selected > i.fa {
  color:#FF912C;
}


/*Switch End */
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
            /* min-width: 100px; */
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

/**Video Adjustment */
    /* Call Video Student*/

    
    #other-videos video {
        width: 30%;
        margin: 0;
        border: none;
        padding: 0;
        border-radius: 3px;
    }
    
    #other-videos {
        position: absolute;
        top: 0;
        margin-top: 5px;
        margin-left: 5px;
    }

    #other-videos2 video {
        width: 60%;
        margin: 0;
        border: none;
        padding: 0;
    }
    /* Call Video Student End*/
    /*Call Main Video*/
    
    #main-video {
        width: 100%;
        margin-top: 0;
        /* border: 1px solid #121010; */
        border-radius: 3px;
        display: block;
        padding: 0;
    }
    /*Call main Video End*/
/*Video Adjustment end */

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

/* Call off Modal */
.timer-group {
  height: 400px;
  margin: 0 auto;
  position: relative;
  width: 400px;
}

.timer {
  border-radius: 50%;
  height: 100px;
  overflow: hidden;
  position: absolute;
  width: 100px;
}

.timer:after {
  background: #111 url(https://codepen.io/images/classy_fabric.png);
  border-radius: 50%;
  content: "";
  display: block;
  height: 80px;
  left: 10px;
  position: absolute;
  width: 80px;
  top: 10px;
}

.timer .hand {
  float: left;
  height: 100%;
  overflow: hidden;
  position: relative;
  width: 50%;
}

.timer .hand span {
  border: 50px solid rgba(0, 255, 255, .4);
  border-bottom-color: transparent;
  border-left-color: transparent;
  border-radius: 50%;
  display: block;
  height: 0;
  position: absolute;
  right: 0;
  top: 0;
  transform: rotate(225deg);
  width: 0;
}

.timer .hand:first-child {
  transform: rotate(180deg);
}

.timer .hand span {
  animation-duration: 4s;
  animation-iteration-count: infinite;
  animation-timing-function: linear;
}

.timer .hand:first-child span {
  animation-name: spin1;
}

.timer .hand:last-child span {
  animation-name: spin2; 
}

.timer.hour {
  background: rgba(0, 0, 0, .3);
  height: 400px;
  left: 0;
  width: 400px;
  top: 0;
}

.timer.hour .hand span {
  animation-duration: 3600s;
  border-top-color: rgba(255, 0, 255, .4);
  border-right-color: rgba(255, 0, 255, .4);
  border-width: 200px;
}

.timer.hour:after {
  height: 360px;
  left: 20px;
  width: 360px;
  top: 20px;
}

.timer.minute {
  background: rgba(0, 0, 0, .2);
  height: 350px;
  left: 25px;
  width: 350px;
  top: 25px;
}

.timer.minute .hand span {
  animation-duration: 60s;
  border-top-color: #1173ff;
  border-right-color: #1173ff;
  border-width: 175px;
}

.timer.minute:after {
  height: 310px;
  left: 20px;
  width: 310px;
  top: 20px;
}

.timer.second {
  background: rgba(0, 0, 0, .2);
  height: 300px;
  left: 50px;
  width: 300px;
  top: 50px;
}

.timer.second .hand span {
  animation-duration: 1s;
  border-top-color: rgba(255, 255, 255, .15);
  border-right-color: rgba(255, 255, 255, .15);
  border-width: 150px;
}

.timer.second:after {
  height: 296px;
  left: 2px;
  width: 296px;
  top: 2px;
}

.face {
  background: #00132D;
  border-radius: 50%;
  height: 296px;
  left: 52px;
  padding: 165px 40px 0;
  position: absolute;
  width: 296px;
  text-align: center;
  top: 52px;
}

.face h2 {
  font-weight: 300; 
}

.face p {
    border-radius: 20px;
    font-size: 76px;
    font-weight: 400;
    position: absolute;
    top: 86px;
    color: #fff;
    width: 260px;
    left: 9px;
}

@keyframes spin1 {
  0% {
    transform: rotate(225deg);
  }
  50% {
    transform: rotate(225deg);
  }
  100% {
    transform: rotate(405deg);
  }
}

@keyframes spin2 {
  0% {
    transform: rotate(225deg);
  }
  50% {
    transform: rotate(405deg);
  }
  100% {
    transform: rotate(405deg);
  }
}

/* Call of Modal End */
</style>
@section('content')
 <!-- top Fixed navbar End -->
 <section>
    <input type="hidden" id="class_room_id" value="{{$class->id}}">
    <input type="hidden" id="class_date" value="{{$booking->class_date}}">
    <input type="hidden" id="class_time" value="{{$booking->class_time}}">
    <input type="hidden" id="class_total_duration" value="{{$booking->duration}}">
    <input type="hidden" id="sbooking_id" value="{{$class->booking_id}}">
    <input type="hidden" id="classroom_id" value="{{$class->classroom_id}}">
    <div class="content-wrapper " style="overflow: hidden;">

        <div class="container-fluidd">
            
            <div class="row callDiv mt-4 mr-2 ml-2" >
                <div class="col-md-8 text-center rounded bg-dark ">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="other-videos2"  playsinline autoplay>
                               
                            </div>

                            <!-- @if($user->picture)
                                @if(file_exists( public_path(). $user->picture))
                                    <img src="{{asset($user->picture)}}" class="profile-img pg" alt="">
                                @else
                                    <img src="{{asset('assets/images/ico/Square-white.jpg')}}"  class="profile-img pg" alt="">
                                @endif
                            @else
                                <img src="{{asset('assets/images/ico/Square-white.jpg')}}"  class="profile-img pg" alt="">
                            @endif -->
                        </div>
                        <div class="col-md-12 " style="position: absolute;bottom: 22px;">
                            <a  class="callSet vc">
                                <img src="{{asset('assets/images/ico/vc.png')}}" title="Without Video" alt="">
                            </a>
                            <a  class="callSet no-vc">
                                <img src="{{asset('assets/images/ico/no-vc.png')}}" title="With Video" alt="">
                            </a>
                            <a  class="callSet mk" >
                                <img src="{{asset('assets/images/ico/mike.png')}}" title="Without Audio" alt="">
                            </a>
                            <a  class="callSet no-mk">
                                <img src="{{asset('assets/images/ico/no-mike.png')}}" title="With Audio" alt="">
                            </a>
                        </div>
                    </div>
                   
                </div>
                <div class="col-md-4  mt-3">
                    <div class="m-2">
                        <p class="heading-fifth">Ideal Criterias: </p>
                        <ul style="list-style: disc;">
                            <li>Allow notifications.</li>
                            <li>Allow audio video Permissions.</li>
                            <li>Audio device is compulsory.</li>
                            <li>Tutor Camera's compulsory for conducting a class.</li>
                            <li>If not working correctly, deactivate any third party extension.</li>
                            <li>Avoid Incognito mode for better experience.</li>
                        </ul>
                        <div class="text-center">
                            <button type="button" role="button" onclick="joinClass('{{$class->classroom_id}}')" class="schedule-btn ">
                                Join Class Now
                            </button>
                            <p class="hide" id="p1">/tutor/class/{{$class->classroom_id}}</p>
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
    // var timerInstance = new easytimer.Timer();
    var editor2 = ace.edit("editor2");
    editor2.setTheme("ace/theme/monokai");
    editor2.session.setMode("ace/mode/javascript");
    var checkConnectionSeq  = 0;
    $(document).ready(function(){
       
        // $(".tech_weck").hide();
     
        // $("#callModal").modal("show");
        $("#main-video").attr("poster","{{asset('assets/images/ico/Mute-video.png')}}");
        });
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
   $(".no-ph").click(function(){
        $("#endCall").modal("show");
        callOnModal();
    });
    $("#reviewLater").click(function(){
        window.location.href="{{route('student.classroom')}}";
    });

    $('#stars-ul li').on('click', function(){
        var onStar = parseInt($(this).data('value'), 10);
        var stars = $(this).parent().children('li.star');
        
        for (i = 0; i < stars.length; i++) {
            $(stars[i]).removeClass('selected');
        }
        
        for (i = 0; i < onStar; i++) {
            $(stars[i]).addClass('selected');
        }
        
        var ratingValue = parseInt($('#stars-ul li.selected').last().data('value'), 10);
        $("#star_rating").val(ratingValue);
        
    });

    $("#send_review").click(function() {
        var star_rating = $("#star_rating").val();
        var review = $("#std_review").val();
        var booking_id = $("#sbooking_id").val();

        var form_data = {
            review:review, 
            star_rating:star_rating,
            booking_id:booking_id,
        }
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('student.save.review')}}",
            type: "POST",
            data: form_data, 
            dataType: 'json',
            success:function(response){
                console.log(response , "data");
                if(response.status_code == 200 && response.success == true) {
                    toastr.success(response.message,{
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2500
                    });
                    $("#reviewModal").modal('hide');
                    $("#classOffModal").modal("hide");

                    window.location.href = "{{route('student.classroom')}}";
                }else{
                    toastr.error(response.message,{
                        position: 'top-end',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2500
                    });
                }
            },
            error:function(e) {
                console.log(e)
            }
        });

    });
   
</script>

<script>
$("#conCam").click(function(){
    let html = `<img src="{{asset('assets/images/ico/Square-white.jpg')}}" class="profile-card-img"  alt="" style="margin-top:12%;">`;
                    $("#other-videos2").html(html);
    $(".overlayCam").hide();
});
var connection = new RTCMultiConnection();
var roomid = '{{$class->classroom_id}}';
var fullName = '{{$user->first_name}} {{$user->last_name}}';
var timer = new Timer();
var deadline = '00:05:00'; 
var resced = '00:15:00'; 
var class_duration = {{$booking->duration}};

console.log(connection.socket)
// var class_duration = 20;




    function joinClass(id) {
        var connection = new RTCMultiConnection();
        var roomid = id;
        var fullName = '---';
        connection.socketURL = 'https://tutorvy.herokuapp.com:443/';

        connection.checkPresence(roomid, function(isRoomExist, roomid, error) {
            if (isRoomExist === true) {
                window.location.href = `{{ url('student/class') }}/` + id;
            } else {
                toastr.warning('Tutor not joined yet.', {
                    position: 'top-end',
                    icon: 'warning',
                    showConfirmButton: false,
                    timer: 2500
                });
            }
        });
    }

$("#join_now").click(function(){
                // $(".tech_weck").removeClass("tech_weck-none");
                // $(".callDiv").hide();
                //     connection.onstream = function(event) {
                //         if (event.stream.isScreen && !event.stream.canvasStream) {
                //             $('#screen-viewer').get(0).srcObject = event.stream;
                //             $('#screen-viewer').hide();
                //         }
                //         else if (event.extra.roomOwner === true) {
                //             var video = document.getElementById('main-video');
                //             video.setAttribute('data-streamid', event.streamid);
                //             // video.style.display = 'none';
                //             if(event.type === 'local') {
                //                 video.muted = true;
                //                 video.volume = 0;
                //             }
                //             video.srcObject = event.stream;
                //             $('#main-video').show();
                //         } else {
                //             event.mediaElement.controls = false;

                //             var otherVideos = document.querySelector('#other-videos');
                //             otherVideos.appendChild(event.mediaElement);
                //         }

                //         // connection.onUserStatusChanged(event);
                //     };
                
                //     // timer.start({countdown: true, startValues: {hours: class_duration}});

                //     // $('#countdownExample .values').html(timer.getTimeValues().toString());

                //     // timer.addEventListener('secondsUpdated', function (e) {
                //     //     $('#countdownExample .values').html(timer.getTimeValues().toString());
                //     // });

                //     //     var ter =$('.values').text();
                        
                //     //     if( ter == deadline ){
                            
                //     //         $(".blink").css("background","#dc3545");
                //     //         $(".Text-reck").text("Class will end in Five minutes sharp.");
                //     //     }
                //     //     else if( ter == resced ){
                //     //         $(".blink").css("background","#ffc107");
                //     //         let html = `<p class="mb-0">Do you want to reschedule another class? <a href="#" data-toggle="modal" data-target="#resced">Yes</a> or  <a href="">No</a> </p>`
                //     //         $(".Text-reck").html(html);
                //     //     }
                //     //     else if( ter >= resced ){
                //     //         $(".blink").css("background","#28a745");
                //     //         $(".Text-reck").text("Class will ends in: ");

                //     //     }

                //     // timer.addEventListener('targetAchieved', function (e) {
                //     //     // $('#countdownExample .values').html('');
                //     //     $('#reviewModal').modal("show");

                //     // });
                // /* Javascript Timer ENd */
            });
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
connection.socketURL = 'https://tutorvy.herokuapp.com:443/';

connection.extra.userFullName = fullName;

connection.DetectRTC.load(function() {
    console.log(connection.DetectRTC,"Kick");
    connection.onMediaError=function(error,constraints){
        console.log(error)
        console.log(constraints)

        if(error == 'NotReadableError: Could not start video source'){
            alert('Unable to get camera. Please check camera is not used by any other program or and refresh the page again to start the class.')
            $("#join_now").hide();
        }
        
    }
    if(connection.DetectRTC.isWebsiteHasWebcamPermissions === false && connection.DetectRTC.isWebsiteHasMicrophonePermissions === false){
        connection.dontCaptureUserMedia = true;
    }


    console.log(connection.DetectRTC);
    if (connection.DetectRTC.hasMicrophone === true) {
        // enable microphone
        if(connection.DetectRTC.isWebsiteHasMicrophonePermissions === false){

                $(".overlayCam").css("display","block");
               $(".overlayCam").find("h3").text("Your Microphone is Blocked");
               $(".overlayCam").find("h5").text("Tutorvy needs access to your microphone. To get 100% result");
               $(".overlayCam").find("#conCam").text("Continue without Microphone");
       }
       else{
       // enable microphone

        connection.mediaConstraints.audio = true;
        connection.session.audio = true;
        // alert('attach true microphone')
        $(".no-mk").show();
            $("#join_now").click(function(){
                
                $(".tech_weck").removeClass("tech_weck-none");
                $(".callDiv").hide();
                    connection.onstream = function(event) {
                        if (event.stream.isScreen && !event.stream.canvasStream) {
                            $('#screen-viewer').get(0).srcObject = event.stream;
                            $('#screen-viewer').hide();
                        }
                        else if (event.extra.roomOwner === true) {
                            var video = document.getElementById('main-video');
                            video.setAttribute('data-streamid', event.streamid);
                            // video.style.display = 'none';
                            if(event.type === 'local') {
                                video.muted = true;
                                video.volume = 0;
                            }
                            video.srcObject = event.stream;
                            $('#main-video').show();
                        } else {
                            event.mediaElement.controls = false;

                            var otherVideos = document.querySelector('#other-videos');
                            otherVideos.appendChild(event.mediaElement);
                        }

                        // connection.onUserStatusChanged(event);
                    };
                
                    // timer.start({countdown: true, startValues: {hours: class_duration}});

                    // $('#countdownExample .values').html(timer.getTimeValues().toString());

                    // timer.addEventListener('secondsUpdated', function (e) {
                    //     $('#countdownExample .values').html(timer.getTimeValues().toString());
                    // });

                    //     var ter =$('.values').text();
                        
                    //     if( ter == deadline ){
                            
                    //         $(".blink").css("background","#dc3545");
                    //         $(".Text-reck").text("Class will end in Five minutes sharp.");
                    //     }
                    //     else if( ter == resced ){
                    //         $(".blink").css("background","#ffc107");
                    //         let html = `<p class="mb-0">Do you want to reschedule another class? <a href="">Yes</a> or  <a href="">No</a> </p>`
                    //         $(".Text-reck").html(html);
                    //     }
                    //     else if( ter >= resced ){
                    //         $(".blink").css("background","#28a745");
                    //         $(".Text-reck").text("Class will ends in: ");

                    //     }

                    // timer.addEventListener('targetAchieved', function (e) {
                    //     // $('#countdownExample .values').html('');
                    //     $('#reviewModal').modal("show");

                    // });
                /* Javascript Timer ENd */
            })
       }
        
    }else{
        toastr.warning( "Audio Device is Mendatory ");
        $(".no-mk").hide();
        $(".overlayCam").css("display","block");
        $(".overlayCam").find("h3").text("Your Microphone is Blocked");
        $(".overlayCam").find("h5").text("Tutorvy needs access to your microphone. To get 100% result");
              
    }

    if (connection.DetectRTC.hasWebcam === true) {
        // enable camera
        if(connection.DetectRTC.isWebsiteHasWebcamPermissions === false){

                $(".overlayCam").css("display","block");
                let vhtml = `<video poster="{{asset('assets/images/ico/Mute-video.png')}}"></video>`;
                $("#other-videos").html(vhtml);


                connection.mediaConstraints.video = false;
                connection.session.video = false;
                $("#other-videos2").attr("poster","{{asset('assets/images/ico/Mute-video.png')}}");
                $("#other-videos video").attr("poster","{{asset('assets/images/ico/Mute-video.png')}}");

       }
       else{
       // enable microphone
            if(connection.DetectRTC.videoInputDevices.length > 0){
                var varr = connection.DetectRTC.videoInputDevices;
                for(var v = 0 ; v < varr.length ; v++){
                    if(varr[v].deviceId != undefined){
                        
                        console.log(connection.DetectRTC+'in video if')
                        connection.mediaConstraints.video = true;
                        connection.session.video = true;
                        $(".overlayCam").css("display","none");
                        $(".no-vc").show();
                        // alert('attach true camera');
                    }else{
                        console.log(connection.DetectRTC+'in video else')
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

       }
        
       
    }
    else{
        $(".no-vc").hide();
        $(".overlayCam").css("display","block");
        // alert('attach Cam First');
        connection.mediaConstraints.video = false;
        connection.session.video = false;
    }

    if (connection.DetectRTC.hasSpeakers === false) { // checking for "false"
        // alert('Please attach a speaker device. You will unable to hear the incoming audios.');
    }
});


/// make this room public
connection.publicRoomIdentifier = '';

connection.socketMessageEvent = 'canvas-dashboard-demo';

// keep room opened even if owner leaves
// connection.autoCloseEntireSession = true;

// https://www.rtcmulticonnection.org/docs/maxParticipantsAllowed/
// connection.maxParticipantsAllowed = 1000;
// set value 2 for one-to-one connection
connection.maxParticipantsAllowed = 2;
// connection.autoCloseEntireSession = true;

// here goes canvas designer
var designer = new CanvasDesigner();

// you can place widget.html anywhere
designer.widgetHtmlURL = "{{ route('whiteBoard.canvas')}}";
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

connection.chunkSize = 16000;
connection.enableFileSharing = true;

connection.session.data =  true;

connection.sdpConstraints.mandatory = {
    OfferToReceiveAudio: true,
    OfferToReceiveVideo: false
};

connection.onUserStatusChanged = function(event) {
    console.log(event)
    var infoBar = document.getElementById('onUserStatusChanged');
    var names = [];


    connection.getAllParticipants().forEach(function(pid) {
        names.push(getFullName(pid));
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
    // timer.resume();
    //conection joined
    let x= 1;
    checkConnectionSeq = checkConnectionSeq+x;
    $("#classOffModal").modal("hide");

    
  
    if(checkConnectionSeq == 1)
    {
        toastr.success(checkConnectionSeq+" Student refreshes the window");
    }
    if(checkConnectionSeq > 1)
    {

        toastr.success(checkConnectionSeq+" Tutor refreshes the window");
        location.reload();
        $(".tech_weck").removeClass("tech_weck-none");
        $(".callDiv").css("display","none !important");
        checkConnectionSeq = 0;
    }
    
    connection.send({
        class_joined: true,
    
    });
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

var usersLeft = {};
connection.onleave = function(event) {
    toastr.success("Tutor Disconnected. Please wait...");
    $("#callDisconnectModal").modal("show");
    callOffModal();
    console.log(event.extra)
    // timer.pause();
    
};

connection.onclose = connection.onerror  = function(event) {
console.log(event)
    // connection.onUserStatusChanged(event);

};

connection.onmessage = function(event) {

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
        toastr.success("Tutor ended the class.");
        $(".content-wrapper").css("display","none !important");
        $("#reviewModal").modal("show");
    $("#classOffModal").modal("hide");

    }
    if(event.data.call_confirmation === true){
        // toastr.success("Tutor ended the class.");
        // $(".content-wrapper").css("display","none !important");
        $("#callEndConfirmationModal").modal("show");
        $("#classOffModal").modal("hide");

    }
    if(event.data.is_timer === true){
        console.log(event.data.time_value)
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
    callOnModal();

    if (event.stream.isScreen && !event.stream.canvasStream) {
        $('#screen-viewer').get(0).srcObject = event.stream;
        $('#screen-viewer').hide();
    }
    else if (event.extra.roomOwner === true) {
        var video = document.getElementById('main-video');
        console.log(event.streamid+" Stream Id");
        video.setAttribute('data-streamid', event.streamid);
        // video.style.display = 'none';
        if(event.type === 'local') {
            video.muted = true;
            video.volume = 0;
        }
        video.srcObject = event.stream;
        $('#main-video').show();
    } else {
        event.mediaElement.controls = false;
        var otherVideos = document.querySelector('#other-videos');
        otherVideos.appendChild(event.mediaElement);
        $("#classOffModal").modal("hide");
        


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
$(".no-vc").click(function(){
    // alert("No vc");
    if (connection.DetectRTC.hasWebcam === true) {
        // enable camera
        if(connection.DetectRTC.videoInputDevices.length > 0){

            var varr = connection.DetectRTC.videoInputDevices;
            for(var v = 0 ; v < varr.length ; v++){
                if(varr[v].deviceId != undefined){
                    console.log(connection.DetectRTC)
                    connection.mediaConstraints.video = true;
                    connection.session.video = true;
                    $(".overlayCam").css("display","none");
                   
                  
                    // alert('attach true 2 camera');
                    var localStream = connection.attachStreams[0];
    
                    localStream.mute('video');
                    $("#other-videos video").attr("poster","{{asset('assets/images/ico/Mute-video.png')}}");
                    // $("#other-videos2 video").attr("poster","{{asset('assets/images/ico/Mute-video.png')}}");
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

    }else if (connection.DetectRTC.hasWebcam === false) {
        // alert("No Blovk");
        $(".no-vc").hide();
        $(".overlayCam").css("display","block");
        // alert('attach Cam First');
    }
});
$(".vc").click(function(){
    // alert("Vc");
    var localStream = connection.attachStreams[0];
    localStream.unmute('video'); 
    
})
$(".no-mk").click(function(){
    // alert("No mk");
    var localStream = connection.attachStreams[0];
    localStream.mute('audio');
})
$(".mk").click(function(){
    // alert("mk");
    var localStream = connection.attachStreams[0];
    localStream.unmute('audio'); 
    connection.streamEvents.selectFirst('local').mediaElement.muted=true;
    connection.streamEvents.selectFirst('local').mediaElement.volume=0;
    
})
$("#endCallYes").click(function(){
    connection.send({
        call_ended: true
    });
    toastr.success("Class has Ended.");
    $("#endCall").modal("hide");
    $("#reviewModal").modal("show");
    $("#classOffModal").modal("hide");


    $(".content-wrapper").css("display",'none');
    
});
$("#endCallYes2").click(function(){
    connection.send({
        call_ended: true
    });
    toastr.success("Class has Ended.");
    $("#callEndConfirmationModal").modal("hide");
    $("#reviewModal").modal("show");
    $("#classOffModal").modal("hide");


    $(".content-wrapper").css("display",'none');
    
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
        // div.innerHTML = '<b>From me:</b> <br> <span>' + event+ '</span>';
        // div.style.background = '#cbffcb';
        div.innerHTML =    `<div class="sender">
                                            <small>From Me <img class="checkmark" id="' + checkmark_id + '" title="Received" src="https://www.webrtc-experiment.com/images/checkmark.png"></small>
                                            <p class="senderText mb-0">`+ event+` </p>
                                            <small class="dull">1min ago</small>
                                        </div>`
    }

    conversationPanel.appendChild(div);
    // conversationPanel.scrollTop('300');
    conversationPanel.scrollTop = conversationPanel.scrollHeight;
    // conversationPanel.scrollTop = conversationPanel.scrollHeight - conversationPanel.scrollTop;
}

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
}

function getFullName(userid) {
    var _userFullName = userid;
    if (connection.peers[userid] && connection.peers[userid].extra.userFullName) {
        _userFullName = connection.peers[userid].extra.userFullName;
    }
    return _userFullName;
}

connection.onFileEnd = function(file) {
    var html = getFileHTML(file);
    var div = progressHelper[file.uuid].div;

    if (file.userid === connection.userid) {
        // div.innerHTML = '<b>You:</b><br>' + html;
        div.innerHTML =   `<div class="sender">
                            <small>From me</small>
                            <p class="senderText mb-0 text-center">
                                `+html+`
                            </p>
                            <small class="dull">1min ago</small>
                        </div>`;
        // div.style.background = '#cbffcb';

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
        div.innerHTML = `<div class="sender">
                            <small>From me</small>
                            <p class="senderText mb-0">
                                <label>0%</label> <progress></progress>
                            </p>
                            <small class="dull">3min ago</small>
                        </div>`;
        // div.style.border = '1px solid #cbffcb';
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
}

// if(!!params.password) {
//     connection.password = params.password;
// }
console.log(connection)


designer.appendTo(document.getElementById('widget-container'), function() {
    
    // if (params.open === true || params.open === 'true') {
    //         var tempStreamCanvas = document.getElementById('temp-stream-canvas');
    //         var tempStream = tempStreamCanvas.captureStream();
    //         tempStream.isScreen = true;
    //         tempStream.streamid = tempStream.id;
    //         tempStream.type = 'local';
    //         connection.attachStreams.push(tempStream);
    //         window.tempStream = tempStream;

    //         connection.extra.roomOwner = true;
    //         connection.open(params.sessionid, function(isRoomOpened, roomid, error) {
    //             if (error) {
    //                 if (error === connection.errors.ROOM_NOT_AVAILABLE) {
    //                     alert('Someone already created this room. Please either join or create a separate room.');
    //                     return;
    //                 }
    //                 alert(error);
    //             }

    //             connection.socket.on('disconnect', function() {
    //                 location.reload();
    //             });
    //         });
    // } else {
        connection.join(roomid, function(isRoomJoined, roomid, error) {
            //First time joining
            // alert('in join')
            $("#classOffModal").modal("hide");

            if (error) {
                console.log(error)
                if (error === connection.errors.ROOM_NOT_AVAILABLE) {
                    alert('This room does not exist. Please either create it or wait for moderator to enter in the room.');
                    window.location.href="{{route('student.classroom')}}";
                    
                    return;
                }
                if (error === connection.errors.ROOM_FULL) {
                    window.location.href="{{route('student.classroom')}}";
                    alert('Room is full.');
                    return;
                }
                if (error === connection.errors.INVALID_PASSWORD) {
                    connection.password = prompt('Please enter room password.') || '';
                    if(!connection.password.length) {
                        alert('Invalid password.');
                        return;
                    }
                    connection.join(roomid, function(isRoomJoined, roomid, error) {
                        if(error) {
                            window.location.href="{{route('student.classroom')}}";
                            alert(error);
                        }
                    });
                    return;
                }
                alert(error);
            }
            var ter = "";
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

            timer.addEventListener('secondsUpdated', function (e) {
                $('#countdownExample .values').html(timer.getTimeValues().toString());
                ter = $('.values').text();
                if( ter < deadline ){
                    $(".blink").css("background","#dc3545");
                    $(".Text-reck").text("Class will end in Five minutes sharp.");
                }
                else if( ter == resced || ter < resced && ter > deadline ){
                    $(".blink").css("background","#ffc107");
                    let html = `<p class="mb-0">Do you want to reschedule another class? <a href="">Yes</a> or  <a href="">No</a> </p>`
                    $(".Text-reck").html(html);
                }
                else if( ter > resced ){
                    $(".blink").css("background","#28a745");
                    $(".Text-reck").text("Class will ends in: ");

                }
                
            });

                // var deadline = '00:05:00'; 
                // var resced = '00:15:00';               

            timer.addEventListener('targetAchieved', function (e) {
                // $('#countdownExample .values').html('');
                $('#reviewModal').modal("show");
             
                $("#classOffModal").modal("hide");

                $(".content-wrapper").css("display","none");

            });
            /* Javascript Timer ENd */

            if(today_date_seconds > class_end_seconds) {
                $('#countdownExample .values').html("Class Time Over");
                $('#reviewModal').modal("show");
                $(".content-wrapper").css("display","none");
                $("#classOffModal").modal("hide");

            }


            saveClassLogs();
            connection.socket.on('disconnect', function() {
                location.reload();
            });
        });
    // }
});

function addStreamStopListener(stream, callback) {
    stream.addEventListener('ended', function() {
        callback();
        // alert("check");
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
}

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
}

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
        $('#btn-share-screen').hide();
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
}

$('#btn-share-screen').click(function() {
    if(!window.tempStream) {
        alert('Screen sharing is not enabled.');
        return;
    }

    $('#btn-share-screen').hide();

    if(navigator.mediaDevices.getDisplayMedia) {
        navigator.mediaDevices.getDisplayMedia(screen_constraints).then(stream => {
            replaceScreenTrack(stream);
        }, error => {
            alert('Please make sure to use Edge 17 or higher.');
        });
    }
    else if(navigator.getDisplayMedia) {
        navigator.getDisplayMedia(screen_constraints).then(stream => {
            replaceScreenTrack(stream);
        }, error => {
            alert('Please make sure to use Edge 17 or higher.');
        });
    }
    else {
        alert('getDisplayMedia API is not available in this browser.');
    }
});

function saveClassLogs() {

    var current_date_time = moment(new Date()).format('YYYY-MM-DD h:m:s');
    var class_room_id = $("#class_room_id").val();

    var form_data = {
        std_join_time : current_date_time, 
        class_room_id : class_room_id,
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{route('student.classlogs')}}",
        type: "POST",
        data:form_data,
        success:function(response){
            console.log(response);
        },
        error:function(e) {
            console.log(e)
        }
    });

}

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

}


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
}

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
}

$(".s_status").change(function(){
    if($(this).prop("checked") == true){
        if(!window.tempStream) {
        alert('Screen sharing is not enabled.');
        return;
    }

    $('#btn-share-screen').hide();

    if(navigator.mediaDevices.getDisplayMedia) {
        navigator.mediaDevices.getDisplayMedia(screen_constraints).then(stream => {
            replaceScreenTrack(stream);
        }, error => {
            alert('Please make sure to use Edge 17 or higher.');
        });
    }
    else if(navigator.getDisplayMedia) {
        navigator.getDisplayMedia(screen_constraints).then(stream => {
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
function callOnModal(){

    $("#classOffModal").modal("hide");
    // alert("Junk");
};
function callOffModal(){
    $("#classOffModal").modal("show");
    var defaults = {}
  , one_second = 1000
  , one_minute = one_second * 60
  , one_hour = one_minute * 60
  , one_day = one_hour * 24
  , startDate = new Date()
  , face = document.getElementById('lazy');

// http://paulirish.com/2011/requestanimationframe-for-smart-animating/
var requestAnimationFrame = (function() {
  return window.requestAnimationFrame       || 
         window.webkitRequestAnimationFrame || 
         window.mozRequestAnimationFrame    || 
         window.oRequestAnimationFrame      || 
         window.msRequestAnimationFrame     || 
         function( callback ){
           window.setTimeout(callback, 1000 / 60);
         };
}());

tick();

function tick() {

  var now = new Date()
    , elapsed = now - startDate
    , parts = [];

  parts[0] = '' + Math.floor( elapsed / one_hour );
  parts[1] = '' + Math.floor( (elapsed % one_hour) / one_minute );
  parts[2] = '' + Math.floor( ( (elapsed % one_hour) % one_minute ) / one_second );

  parts[0] = (parts[0].length == 1) ? '0' + parts[0] : parts[0];
  parts[1] = (parts[1].length == 1) ? '0' + parts[1] : parts[1];
  parts[2] = (parts[2].length == 1) ? '0' + parts[2] : parts[2];

  face.innerText = parts.join(':');
  
  requestAnimationFrame(tick);
  
}
}
</script>
@endsection