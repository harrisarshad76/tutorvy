@extends(Auth::user()->role == 2 ? 'tutor.layouts.app' : 'student.layouts.app' )

@section('content')
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
            height: 470px;
            padding-left: 0px;
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
        }
        .reciever {
            float: left;
        }

        .reciever p,
        .sender p,
        .img-style {
            min-width: 219px;
            border: 1px solid ;
            border-color: #D3D8DF;
            display:block;
            border-radius: 5px;
            padding: 5px;
            max-width:509px;
            
        }
        .sender p,
        .img-style{
            width: 400px;
        }
        .reciever-img-style{
            width: 400px;
        }
        .reciever-img-style, .reciever p{
            border: 1px solid;
            border-color:#6EAAFF;
        }

        .img-style:hover,
        .reciever p:hover,
        .sender p:hover {
            cursor: pointer;
        }

        .recDull {
            position: absolute;
            left: 34%;
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
            left: 45%;
            /* display: none; */
        }

        .textMenu {
            color: #00132D;
            position: absolute;
            top: 28%;
            right: 45%;
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
    </style>

    <div class="content content-wrapper " style="width: 100%;background-color: #FBFBFB !important;">
        <div class="container-fluid">
            <p class="heading-first ml-4 ">Inbox </p>
            <div id="react"></div>
            <div class="row">
                <div class="col-md-12 mb-1 ">
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
                </div>
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
                            <?php
                           
                            
                            ?>
                            <a type="button" class="chatLeft w-100" id="chatClient_{{$contact->user->first_name}}"
                                onclick='selectUser(`{{$contact->user->id}}`,`{{$contact->user->first_name}} {{$contact->user->last_name}}`)' >
                                <!-- <a href="#" class="chatLeft" id="chatClient_1" > -->
                                <div class="container-fluid m-0 p-0 img-chats">
                                    <img src="{{asset($contact->user->picture)}}" class="leftImg ml-1" id="img_{{$contact->user->id}}">
                                    <span class="activeDot" id="activeDot_"></span>
                                    <div class="img-chat w-100">

                                        <div class="row">
                                            <div class="col-9">
                                                <p id="name_main" class="name-client">{{$contact->user->first_name}} {{$contact->user->last_name}}</p>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="time-chat">11:25</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <p class="massage-client" id="recent_msg_">{{$contact->last_talk->message != null ? $contact->last_talk->message : "Say Hi to "}} </p>

                                            </div>
                                            <div class="col-md-3">
                                                <span class="dot  " id="unseen_msg_cnt_">{{$contact->unread_count}}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                </div>
                <div class="col-md-9  chatSet" style="display:none;">
                    <nav class="chatHead navbars navbar-light bg-white m-0 p-0 pl-3 pr-3 row">
                        <div class="col-md-6 col-6">
                            <a class="navbar-brand pb-0" href="#">
                                <div class="container-fluid m-0 p-0 img-chats">

                                    <img  id="clientPic">

                                    <div class="img-chat">
                                        <div class="row">
                                            <div class="col-12">
                                                <p class="name-client" id="clientName"></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="massage-client" style="position: relative;top: -5px;">Online
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
                            <a href="#">
                                <i class="fa fa-ellipsis-v headIcon"></i>
                            </a>
                        </div>
                    </nav>
                    <div class="line-box2"></div>

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
                    <div class="container-fluid mb-3">
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
                    <input type="file" name="file" class="dropify"  >
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

<script>
    // $(document).ready(function(){
      
    // });
    // $(".emojionearea-editor"). (function(){
    //     alert();
    // })
    // $(".chatLeft").click(function(){
    //     $(this).find(".img-chats").css("background","#ffffff");
    //     $(".chatSet").css("display","block");
    //     $(".chatDefault").css("display","none");
    // });
</script>
@include('js_files.chat')

@endsection
