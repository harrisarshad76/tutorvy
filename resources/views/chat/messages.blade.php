@extends(Auth::user()->role == 2 ? 'tutor.layouts.app' : 'student.layouts.app' )

@section('content')
<?php
    function startsWith ($string, $startString)
    {
        $len = strlen($startString);
        return (substr($string, 0, $len) === $startString);
    }
  
?>
    <style>
        .box-main {
            height: 550px;
        }
        .chatLeft:hover {
            text-decoration: none;
        }

        .w-100 {
            width: 100%;
        }

        .rightChatIcon {
            font-size: 25px;
            padding-left: 9px;
            padding-top: 9px;
            padding-right: 19px;
            color: #00132D;
        }

        .rightChatIcon:hover {
            text-decoration: none;
        }

        .f-19 {
            font-size: 19px;
        }

        .sendRight {
            right: 12px;
            position: absolute;
            top: 2px;
            color: #00132D;
            font-size: 21px;
        }

        .sendLeft {
            left: 27px;
            position: absolute;
            z-index: 3;
            color: #00132D;
            top:1px;
        }

        .sendLeft i {
            font-size: 19px;
        }

        .chatArea {
            max-height: 471px;
            padding-left: 0px;
            margin-bottom: 8px;
            padding-right: 0;
            overflow-y: auto;
        }

        .headIcon {
            font-size: 28px;
            padding-top: 4px;
            padding-left: 16px;
            color: #00132D;
            font-weight: 400;
        }

        .activate {
            background: #fff;
        }

        .sender {
            float: right;
            display:grid;

        }
        .reciever {
            float: left;
            display:grid;
        }

        .reciever p,
        .sender p,
        .img-style,
        .reciever-img-style {
            min-width: 301px;
            /* border: 1px solid; */
            border: none;
            
            border-color: #D3D8DF;
            display:block;
            border-radius: 5px;
            padding: 5px;
            word-break:break-all;
            max-width:300px;
            
        }
        /* .sender p,
        .img-style{
            width: 400px;
        }
        .reciever-img-style{
            width: 400px;
        } */
        .reciever-img-style, .reciever p{
            /* border: 1px solid; */
            border: none;

            border-color:#6EAAFF;
        }

        .img-style:hover,
        .reciever p:hover,
        .sender p:hover {
            cursor: pointer;
        }

        .recDull {
    position: absolute;
    left: 28%;
    color: #BCC0C7;
}

        .dull {
            
            
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
            top: 30px;
            left: 40%;
            display: none;
        }

        .textMenu {
            color: #00132D;
            position: absolute;
            top: 28%;
            right: 40%;
            display:none;
        }

        .textMenu2 i,
        .textMenu i {
            font-size: 22px;
        }

        .search-box-icon {
            color: #00132D;
            font-size: 22px;
        }

        .activeDot {
            width: 14px;
            border: 2px solid #fff;
            position: relative;
            height: 14px;
            right: 9px;
            top: 39px;
            background: green;
            border-radius: 50%;
        }

        .offlice {
            background: gray !important;
        }

        .emojionearea.emojionearea-inline>.emojionearea-button {
            left: 3px !important;
        }

        .emojionearea.emojionearea-inline>.emojionearea-editor {
            height: 32px;
            min-height: 20px;
            overflow: hidden;
            white-space: nowrap;
            position: absolute;
            top: 0;
            left: 67px;
            right: 43px;
            padding: 6px 0;
        }

        .emojionearea .emojionearea-picker.emojionearea-picker-position-top {

            left: 5px;
            /* top: -10px; */
        }
        .dot{
            padding-top: 1px;
            padding-left: 6px;
        }
        #chat_form button{
            border:none;
            background:none;
        }
        .massage-client .emojioneemoji{
            width:15px;
            height:15px;
            margin-top:0;
        }
        .massage-client{
            width: 155px;
            line-height:1.5;
        }
        .msg_parent{
            overflow: hidden;
            height: 18px;
        }
        .senderText {
            width: 72%;
            word-break: break-all;

        }
        .time-chat,
        #name_main{
            margin-bottom:0 !important;
        }
        .chatAbout{
            width:35%;
            display:none;
        }
        .chatAbout .card{
            height:600px !important
        }
        #media{
             overflow: hidden;
        }
        .Disk{
            display:flex !important;
        }
        .Disk .chatHalf{
            width:65%;
        }
        .Disk .chatAbout{
            display:block;
            margin-left:15px;
            margin-right:15px;
        }
        .Disk .chatName{
            padding-left:6% !important;
        }
        .deadColor{
            background: rgb(0 0 0 / 40%);
            text-align: center;
            padding: 29% 3%;
            font-size: 10px;
        }
        .deadColor a{
            color:#fff;
            text-decoration:none;
        }
        .mediaHeight{
            overflow-y: auto !important;
        }
        .mediaHeight .mediaAttachments{
            height:auto;
            max-height: 415px;
            overflow: auto !important;
        }
        .mediaAttachments{
            height: 150px;
            overflow: hidden;
        }
        .mediaAttachments img{
            height:75px;   
        }
        .h-471{
            height:471px;
        }
      
    </style>

    <div class="content content-wrapper " style="width: 100%;background-color: #FBFBFB !important;">
        <div class="container-fluid">
            <p class="heading-first ml-4 ">Inbox </p>
            <div id="react"></div>
            <div class="row">
                <!-- <div class="col-md-12 mb-1 ">
                    <div class=" card  bg-toast infoCard">


                        <div class="card-body row">
                            <div class="col-md-1 text-center">
                                <i class="fa fa-info" aria-hidden="true"></i>
                            </div>
                            <div class="col-md-11 pl-0">
                                <small>
                                    ` Connect with your students to know more about their requirements <a href="#">Learn
                                        More</a>

                                </small>
                                <a href="#" class="cross" onclick="hideCard()">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="col-md-3" style="background-color: #F2F3F4;">
                    <div class="box-main pt-3 pb-3 pr-3">
                        <div class="input-box mr-0">
                            <input type="" placeholder="Search messeges">
                            <a href="#">
                                <i class="fa fa-search search-box-icon"></i>
                                <!-- <img src="../assets/img/ico/Search.png" class="search-box-icon"> -->
                            </a>
                        </div>
                        <div class="line-box"></div>
                        @foreach($users as $contact)
                            @if($contact->user != NULL)
                                <a type="button" class="chatLeft w-100" id="chatClient_{{$contact->user->id}}"
                                    onclick='selectUser(`{{$contact->user->id}}`,`{{$contact->user->first_name}} {{$contact->user->last_name}}`,`{{$contact->user->tagline}}`)' >
                                    <!-- <a href="#" class="chatLeft" id="chatClient_1" > -->
                                    <div class="container-fluid m-0 p-0 pb-2 img-chats">
                                        @if($contact->user->picture)
                                            <?php
                                                $path = Auth::user()->picture;
                                            ?>
                                            @if(file_exists( public_path($path) ))
                                                <img src="{{asset($contact->user->picture)}}" class="profile-img leftImg ml-1" id="img_{{$contact->user->id}}">
                                            @else
                                                <img class="leftImg ml-1 profile-img" src="{{asset('assets/images/ico/Square-white.jpg') }}" id="img_{{$contact->user->id}}">
                                            @endif
                                        @else
                                            <img class="leftImg ml-1 profile-img" src="{{asset('assets/images/ico/Square-white.jpg') }}" id="img_{{$contact->user->id}}">
                                        @endif    
                                        <span class="activeDot" id="activeDot_"></span>
                                        <div class="img-chat w-100">

                                            <div class="row">
                                                <div class="col-md-9">
                                                    <p id="name_main" class="name-client">{{$contact->user->first_name}} {{$contact->user->last_name}}</p>
                                                    <p class="tagline-client" style="display:none;">{{$contact->user->tagline}}</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <p class="time-chat"></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-9 msg_parent">
                                                    <p class="massage-client mt-0" id="recent_msg_{{$contact->user->id}}">
                                                                
                                                        @if($contact->last_talk != null)
                                                                <?php
                                                                    if(startsWith($contact->last_talk->message,"<"))
                                                                    $red = "True";
                                                                else
                                                                        $red = "False";
                                                                ?>
                                                            @if($contact->last_talk->type == 'file')
                                                                <i class="fa fa-picture-o"></i> image
                                                            @elseif($contact->last_talk->type == 'text' && $red == 'True')
                                                                <?php
                                                                    $string = $contact->last_talk->message;
                                                                    // echo $contact->last_talk->message;
                                                                    echo substr($string, 0,237);
                                                                ?>
                                                            @elseif($contact->last_talk->type == 'text' && $red == 'False')
                                                                <?php
                                                                    $string = $contact->last_talk->message;
                                                                    echo substr($string, 0, 14);
                                                                ?>
                                                            @endif
                                                        @else
                                                            Say Hi to 
                                                        @endif </p>

                                                </div>
                                                <div class="col-md-3">
                                                    @if($contact->unread_count == 0)
                                                        <span class="unread_co"  id="unseen_msg_cnt_{{$contact->user->id}}">
                                                            
                                                        </span>
                                                    @else
                                                        <span class="dot unread_co"  id="unseen_msg_cnt_{{$contact->user->id}}">
                                                            {{$contact->unread_count}}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endif
                            
                        @endforeach
                    </div>

                </div>
                <div class="col-md-9  chatSet " style="display:none;">
                    <div class="chatHalf"> 
                        <nav class="chatHead navbars navbar-light bg-white m-0 p-0 pl-3 pr-3 row">
                            <div class="col-md-6 col-6">
                                <a class="navbar-brand pb-0" href="#">
                                    <div class="container-fluid m-0 p-0 img-chats">

                                        <img  class="profile-img clientPic">

                                        <div class="img-chat">
                                            <div class="row">
                                                <div class="col-12">
                                                    <p class="name-client mb-2 clientName"></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="massage-client mb-0" style="position: relative;top: -5px;">Online
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-6 pt-3 text-right">
                                <input type="hidden" class="col-sm-9 form-control ">

                                <a href="#">
                                    <i class="fa fa-search headIcon"></i>
                                </a>
                                <!-- <a href="#">
                                    <i class="fa fa-ellipsis-v headIcon"></i>
                                </a> -->
                            </div>
                        </nav>
                        <div class="line-box2"></div>
                        <div class="h-471">
                            <div class="row chatArea ml-1 pb-2 mr-1" id="">
                                <div class='text-center col-md-12 mb-3'>
                                    <small>
                                        Your all communications will be monitored for maintaining quality, will not share your personal information. 
                                    </small>
                                    <small>
                                        <a href="#">View Privacy Policy</a>
                                    </small>
                                </div>
                            </div>

                        </div>
                        
                        <div class="container-fluid">
                            <div class="search-type ">
                                <div class="row">
                                    <div class="col-md-2 col-4">
                                    </div>
                                    <div class="col-md-10">
                                        <span class="text-muted" id="typingUser"></span>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-12 col-8 p-0">

                                        <form id="chat_form" >
                                            <button class="sendLeft" onclick="sendFileModal()" type="button">
                                                <i class="fa fa-paperclip rightChatIcon"></i>
                                            </button>
                                            <input type="search" id="msg" class="w-100" alt="message">
                                            <button  class="sendRight" type="submit">
                                                <i class="fa fa-paper-plane f-19"></i>
                                            </button>
                                        </form>
                                        <!-- <img src="../assets/img/ico/Icon material-send.png" style="position: relative;left: -35px;height: 25px;margin-top: 10px;"> -->
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                    <div class="chatAbout">
                        <div class="card mt-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 text-center" id="intro">
                                        <img  alt="profile-image" class="profile-card-img clientPic">
                                        <p class="heading-third mt-1 mb-0 clientName">
                                          
                                        </p>
                                        <p class="profile-tutor mt-0 mb-0 clientTag" style="">
                                            
                                        </p>
                                        <!-- <a class="schedule-btn w-100 mt-1 clientId" >
                                            Book class
                                        </a> -->
                                        <div class="star-icos">
                                            <p class="name-text1 paragraph-text1 mb-0">
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star "></span>
                                                <span class="paragraph-text1">0.0</span>
                                            </p>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="col-md-12" id="media">
                                        <p class="heading-third mt-1 mb-0">
                                            Shared Media
                                        </p>
                                        <div class="row pl-3 pr-3 mediaAttachments">
                                         
                                        </div>
                                        <div class="row pl-3 pr-3">
                                            <div class="col-md-4 p-1 ">
                                                <div class="deadColor hungama">
                                                    <a href="#" class="showMoreMedia">
                                                        Show More +
                                                    </a>
                                                </div>
                                                <div class="deadColor hungama2" style="display:none;">
                                                    <a class="showLessMedia text-white" onclick="showLess()">
                                                        Show Less 
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 chatDefault">
                    <img src="http://www.tutorvy.com/assets/images/comming/coming-soon.png" alt="" class="w-100">
                </div>
            </div>

        </div>
    </div>
        <!-- Send File Modal -->
    <div class="modal fade " id="sendFileCall" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Share File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="fileSendForm" enctype="multipart/form-data">
                    <div class="modal-body text-center ">
                    <h5></h5>
                    <input type="file" name="file" class="dropify"  accept="image/*" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-outline-general " data-dismiss="modal"> Cancel </button>
                        <button type="submit" class="btn-general " id="filesend"> Send </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Send File Modal -->
@endsection
@section('scripts')

@include('js_files.chat')

@endsection
