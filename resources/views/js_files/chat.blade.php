
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
       $('.emojionearea-editor').html();
        event.preventDefault();
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
            if(response.status == 200) {
                $(".emojionearea-editor").html('');
                

                var message = `<p class="senderText mb-0">` + msg + ` </p>`;
                            
                let html = `<div class="col-md-12">
                                <div class="sender">
                                    <small>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</small>
                                    `+message+`
                                    <small class="dull">1min ago</small>
                                    <a href="#" class="textMenu"><i class="fa fa-ellipsis-h"></i></a>
                                </div>
                            </div>`;
                $('#chatArea_'+tt_id).append(html);
                $(".msg").val('');
            }
            },
        });
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
            
            if(response.status == 200) {
                var message = '';
                $('#sendFileCall').modal('hide');
                $('.dropify-clear').click();
                if (response.message.message.match(/\.jpg|\.png|\.jpeg|\.gif/gi)) {
                    message += `<img class="img-style"  crossOrigin="anonymous" src="{{asset('storage/` + response.message.message + `')}}">`;
                }
                 
                let html = `<div class="col-md-12">
                                <div class="sender">
                                    <small>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</small>
                                    `+message+`
                                    <small class="dull">1min ago</small>
                                    <a href="#" class="textMenu"><i class="fa fa-ellipsis-h"></i></a>
                                </div>
                            </div>`;
                $('#chatArea_'+tt_id).append(html);
                
                $(".msg").val('');

            }
            },
        });
    });

    function selectUser(id,name){

        allSeen(id);
        // alert(name);
        var pic = $("#img_"+id).attr('src');
        $(".chatDefault").css("display","none");
        $('.chatSet').css("display","block");
        $("#clientName").text(name);
        $("#clientPic").attr('src',pic);
        $(".chatArea").attr("id","chatArea_"+id);
        tt_id = id;
        tt_n = name;

        // $('.name-client').text(name)
        let url = "{{route('user.chat', ':id')}}";
        url = url.replace(':id', id);

        $.ajax({
            url: url,
            type:"get",

            success:function(response){
                $auth = "{{Auth::user()->id}}";
                var attachment = '';
                $('#chatArea_'+id).html('');
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
                        }
                        else{
                            attachment = `<p class="senderText mb-0">` + response[i].message + ` </p>`;
                            }
                        let msg = `<div class="col-md-12">
                                        <div class="sender">
                                            <small>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</small>
                                            `+attachment+`
                                            <small class="dull">1min ago</small>
                                            <a href="#" class="textMenu"><i class="fa fa-ellipsis-h"></i></a>
                                        </div>
                                    </div>`;

                        $('#chatArea_'+id).append(msg);

                    }else{
                        var type = response[i].type;
                      if(type == 'file'){
                        if (response[i].message.match(/\.jpg|\.png|\.jpeg|\.gif/gi)) {
                            attachment += `<img class="reciever-img-style"  crossOrigin="anonymous" src="{{asset('storage/` + response[i].message + `')}}">`;
                            }
                        }
                        else{
                            attachment = `<p class="senderText mb-0">` + response[i].message + ` </p>`;
                            }
                        let msg = `<div class="col-md-12">
                                        <div class="col-md-12 ">
                                            <div class="reciever">
                                                <small>From `+name+`</small>
                                                `+attachment+`
                                                <small class="recDull">1min ago</small>
                                                <a href="#" class="textMenu2"><i class="fa fa-ellipsis-h"></i></a>
                                            </div>
                                        </div>
                                    </div>    `;
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
            },
            failure: function(errMsg) {
                console.log(errMsg);
            }
        });
            
    };
    function sendFileModal(){
        $("#sendFileCall").modal("show");
    }

</script>
