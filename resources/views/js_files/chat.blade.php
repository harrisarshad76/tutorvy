
   <script src="https://rtcmulticonnection.herokuapp.com/dist/RTCMultiConnection.min.js"></script>
  <script src="https://rtcmulticonnection.herokuapp.com/socket.io/socket.io.js"></script>
  <script src="https://rtcmulticonnection.herokuapp.com/node_modules/fbr/FileBufferReader.js"></script>
 <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });
    </script>
<script type="text/javascript">
$(document).ready(function(){
  
  
    $("#msg").focus(function(){
        alert();
    });
});  
    let tt_id;
    let tt_n;


    // Channel to get active users status and leaving users status

    // window.Echo.join('chat')
    // .here(activeUsers => {
    //     this.activeUsers = activeUsers
    // })
    // .joining(user => {
    //     console.log('joining'+user.first_name)
    //     $('#activeDot_'+user.id).removeClass('offlice');

    //     this.activeUsers.push(user)
    // })
    // .leaving(user => {
    //     console.log('leaving'+user)
    //     $('#activeDot_'+user.id).addClass('offlice');

    //     this.activeUsers = this.activeUsers.filter(u => u.id != user.id);
    // })



    // Channel to send & listen message

    // Echo.join(`App.User.{{Auth::user()->id}}`).here( users => {

    // })
    // .listen('NewMessage', (event) => {
    //     console.log(event)
    //     // if (this.chatWith && event.message.sender_id == this.chatWith.id) {
    //         // User A , B , C -- if B send to A # B -> A
    //         // it will appear that C and B send the same message to A # B -> A & C -> A
    //         // this if statement avoid this # only B -> A
    //         if("{{Auth::user()->id}}" == event.message.sender_id){
    //             let msg = `<div class="col-md-12">
    //                             <div class="sender">
    //                                 <small>From Smith</small>
    //                                 <p class="senderText mb-0">`+event.message.content+` </p>
    //                                 <small class="dull">1min ago</small>
    //                                 <a href="#" class="textMenu"><i class="fa fa-ellipsis-h"></i></a>
    //                             </div>
    //                         </div>`;

    //             $('#chatArea').append(msg);
    //         }else{
    //             let msg = `<div class="col-md-12">
    //                             <div class="col-md-12 ">
    //                                 <div class="reciever">
    //                                     <small>From Smith</small>
    //                                     <p class="senderText mb-0">`+event.message.content+`</p>
    //                                     <small class="recDull">1min ago</small>
    //                                     <a href="#" class="textMenu2"><i class="fa fa-ellipsis-h"></i></a>
    //                                 </div>
    //                             </div>
    //                         </div>    `;
    //             $('#chatArea').append(msg);

    //         }
    //         incrementUnseenMessagesCount(event.message.sender_id)

    //     // }
    //             // this.incrementUnseenMessagesCount(event.message.sender_id)
    //             // this.fireNotification()
    //  }).listenForWhisper('typing', user => {

    //     this.typingUser = user;
    //     if(this.typingUser){
    //         $('#typingUser').html(this.typingUser + ' is typing...')
    //     }else{
    //         $('#typingUser').html('')
    //     }

    //     setTimeout(() => {
    //         this.typingUser =  null;

    //     }, 1500);
    // })

    // function sendTypingEvent(){
    //     if($('#msg').val() != ''){
    //         Echo.join(`App.User.`+tt_id).whisper('typing', '{{Auth::user()->first_name}} {{Auth::user()->last_name}}');
    //     }else{
    //         Echo.join(`App.User.`+tt_id).whisper('typing', '');
    //     }
    // }
    window.onkeyup = function(e) {
        var code = e.keyCode || e.which;
        if (code == 13) {
            $('.sendRight').click();
        }
    };

    $( '#chat_form' ).on( 'submit', function(e) {
       event.preventDefault();
       let ter = $('.emojionearea-editor').html();

       if(ter != ""){
        let msg =  $('.emojionearea-editor').html();
        
        let receiver = tt_id;
        // let _token   = $('meta[name="csrf_token"]').attr('content');

        $.ajax({
            url: "{{route('store.text')}}",
            type:"POST",
            data:{
                msg:msg,
                user:receiver
            },
            success:function(response){
            // console.log(response);
            $(".chatArea").animate({ scrollTop: 20000000 }, "slow");

            if(response.status == 200) {
                $(".emojionearea-editor").html('');
                

                var message = `<p class="senderText mb-0">` + msg + ` </p>`;
                            
                let html = `<div class="col-md-12 mt-3">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <img src="{{asset(Auth::user()->picture)}}" class="profile-img" alt="">
                                            </div>
                                            <div class="col-md-11 chatName">
                                                <div class="">
                                                    <p class="mb-0"><b> {{Auth::user()->first_name}} {{Auth::user()->last_name}}</b></p>
                                                    <small class="dull pull-right">1min ago</small>
                                                    `+message+`
                                                    
                                                    <a href="#" class="textMenu"><i class="fa fa-ellipsis-h"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </div>`;
                $('#chatArea_'+tt_id).append(html);
                $(".msg").val('');
            }
            },
        });
       }
       else{
        toastr.error("Can't send empty message");
       }
       
      
    });

    $( '#fileSendForm' ).on( 'submit', function(e) {

        event.preventDefault();
        let msg = $(".msg").val();
        let receiver = tt_id;
        // let _token   = $('meta[name="csrf_token"]').attr('content');
        var formData = new FormData($(this)[0]);
        formData.append('user', receiver);
        $.ajax({
            url: "{{route('store.text')}}",
            type:"POST",
            data:formData,
            processData: false,
            contentType: false,
            cache: false,
            enctype:'multipart/form-data',
            success:function(response){
                $(".chatArea").animate({ scrollTop: 20000000 }, "slow");
            if(response.status == 200) {
                var message = '';
                $('#sendFileCall').modal('hide');
                $('.dropify-clear').click();
                if (response.message.message.match(/\.jpg|\.png|\.jpeg|\.gif/gi)) {
                    message += `<img class="img-style"  crossOrigin="anonymous" src="{{asset('storage/` + response.message.message + `')}}">`;
                    
                    let media_attachment = `   <div class="col-md-4 p-1">
                                                <a href="{{asset('storage/` + response.message.message + `')}}" target="_blank"><img src="{{asset('storage/` + response.message.message + `')}}" class="w-100" alt=""></a>
                                            </div>`
                            $('#mediaAttachments_'+tt_id).prepend(media_attachment);
                }
                 
                let html = `
                            <div class="col-md-12 mt-3">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <img src="{{asset(Auth::user()->picture)}}" class="profile-img" alt="">
                                            </div>
                                            <div class="col-md-11 chatName">
                                                <div class="">
                                                    <p class="mb-0"><b> {{Auth::user()->first_name}} {{Auth::user()->last_name}}</b></p>
                                                    <small class="dull pull-right">1min ago</small>
                                                    `+message+`
                                                    <a href="#" class="textMenu"><i class="fa fa-ellipsis-h"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </div>`;
                $('#chatArea_'+tt_id).append(html);
                
                $(".msg").val('');

            }
            },
        });
    });
    function selectUser(id,name,tagline){
        allSeen(id);
        // alert(name);
        var pic = $("#img_"+id).attr('src');
        var urlId = "{{route('student.book-now',':id')}}";
        urlId = urlId.replace(':id', id);
       
        $(".chatDefault").css("display","none");
        $('.chatSet').css("display","block");
        $(".clientName").text(name);
        $(".clientPic").attr('src',pic);
        $(".clientTag").text(tagline);
        $(".clientId").attr("href",urlId);
        $(".chatArea").attr("id","chatArea_"+id);  
        $(".mediaAttachments").attr("id","mediaAttachments_"+id);
        tt_id = id;
        tt_n = name;

        // $('.name-client').text(name)
        let url = "{{route('user.chat', ':id')}}";
        url = url.replace(':id', id);

        $.ajax({
            url: url,
            type:"get",

            success:function(response){
                // $(".chatArea").animate({ scrollTop: $(document).height() }, 1000);
                $(".chatArea").animate({ scrollTop: 20000000 }, "slow");
                $auth = "{{Auth::user()->id}}";
                var attachment = '';
                $('#chatArea_'+id).html('');
                $("#mediaAttachments_"+id).html('');
                for(let i = 0 ; i<response.length;i++){
                    var attachment = '';
                        // if (response[i].message.match(/\.jpg|\.png|\.jpeg|\.gif/gi)) {
                        //     attachment += `<img  crossOrigin="anonymous" src="` + response[i].message + `">
                        //     `;
                        // }
                        //  else if (response[i].message.match(/\.wav|\.mp3/gi)) {
                        //     attachment += `<audio class="senderText mb-0" src="` + response[i].message + `" controls></audio>
                        //     `;
                        // } else if (response[i].message.match(/\.pdf|\.js|\.txt|\.sh/gi)) {
                        //     attachment += `<iframe class="inline-iframe senderText mb-0" src="` + response[i].message + `"></iframe></a>
                        //     `;
                        // }

                    if("{{Auth::user()->id}}" == response[i].user_id){
                      var type = response[i].type;
                      if(type == 'file'){
                        if (response[i].message.match(/\.jpg|\.png|\.jpeg|\.gif/gi)) {
                                attachment += `<img class="img-style"  crossOrigin="anonymous" src="{{asset('storage/` + response[i].message + `')}}">`;
                            }
                            let media_attachment = `   <div class="col-md-4 p-1">
                                                <a href="{{asset('storage/` + response[i].message + `')}}" target="_blank"><img src="{{asset('storage/` + response[i].message + `')}}" class="w-100" alt=""></a>
                                            </div>`
                            $('#mediaAttachments_'+id).prepend(media_attachment);
                        }
                        else{
                            attachment = `<p class="senderText mb-0">` + response[i].message + ` </p>`;
                        }
                        let msg = `<div class="col-md-12 mt-3">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <img src="{{asset(Auth::user()->picture)}}" class="profile-img" alt="">
                                            </div>
                                            <div class="col-md-11 chatName">
                                                <div class="">
                                                    <p class="mb-0"><b> {{Auth::user()->first_name}} {{Auth::user()->last_name}}</b></p>
                                                    <small class="dull pull-right">1min ago</small>
                                                    `+attachment+`
                                                    
                                                    <a href="#" class="textMenu"><i class="fa fa-ellipsis-h"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </div>`;

                        $('#chatArea_'+id).append(msg);

                    }else{
                        var type = response[i].type;
                      if(type == 'file'){
                            if (response[i].message.match(/\.jpg|\.png|\.jpeg|\.gif/gi)) {
                                attachment += `<img class="reciever-img-style"  crossOrigin="anonymous" src="{{asset('storage/` + response[i].message + `')}}">`;
                                let media_attachment = `   <div class="col-md-4 p-1">
                                                <a href="{{asset('storage/` + response[i].message + `')}}" target="_blank"><img src="{{asset('storage/` + response[i].message + `')}}" class="w-100" alt=""></a>
                                            </div>`
                            $('#mediaAttachments_'+id).prepend(media_attachment);
                            
                            }
                        }
                        else{
                            attachment = `<p class="senderText mb-0">` + response[i].message + ` </p>`;
                        }
                        // let msg = `<div class="col-md-12 mt-3">
                        //                 <div class="col-md-12 ">
                        //                     <div class="reciever">
                        //                         <small>From `+name+`</small>
                        //                         `+attachment+`
                        //                         <small class="recDull">1min ago</small>
                        //                         <a href="#" class="textMenu2"><i class="fa fa-ellipsis-h"></i></a>
                        //                     </div>
                        //                 </div>
                        //             </div>    `;
                        let msg = `<div class="col-md-12 mt-3">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <img src="`+pic+`" class="profile-img" alt="">
                                            </div>
                                            <div class="col-md-11 chatName">
                                                <div class="">
                                                    <p class="mb-0"><b> `+name+`</b></p>
                                                    <small class="dull pull-right">1min ago</small>
                                                    `+attachment+`
                                                    <a href="#" class="textMenu"><i class="fa fa-ellipsis-h"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </div>`
                        $('#chatArea_'+id).append(msg);

                    }

                }
            },
        });

    }

    function incrementUnseenMessagesCount(sender_id){



    }

    function allSeen(id){
        event.preventDefault();
        let url = "{{route('markAllSeen', ':id')}}";
        url = url.replace(':id', id);
        $.ajax({
            url: url,
            type: "get",
            dataType: 'json',
            cache: false,
            async:false,
            success: function(data) {
                // $('.message-item').remove();
                $(".unread_co").removeClass("dot");
                $(".unread_co").html("");

                if(data.data == 0){
                    $(".show_message_counts").css("display","none");
                    $('.show_message_counts').text(0)
                }
                else{
                    $(".show_message_counts").addClass("notification-text");
                    $('.show_message_counts').text(data.data);
                }

            },
            failure: function(errMsg) {
                console.log(errMsg);
            }
        });
            
    };
    function sendFileModal(){
        $("#sendFileCall").modal("show");
    }

    $(".clientName").click(function(){
        $(".chatSet").toggleClass("Disk");
        showLess();
    });

    $(".showMoreMedia").click(function(){
        // alert("");
        $("#intro").hide("slow");
        $("#media").addClass("mediaHeight");
        $(".hungama").css("display","none");
        $(".hungama2").css("display","block");
    });
    function showLess(){
    
        $("#intro").show("slow");
        $("#media").removeClass("mediaHeight");
        $(".hungama2").css("display","none");
        $(".hungama").css("display","block");
    };
</script>
