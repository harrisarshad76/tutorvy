<script type="text/javascript">
/* Booking Insert */
var time_slots = [];
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $( '#book_tutor_form' ).on( 'submit', function(e) {
        event.preventDefault();

        $('#tutor_id').val("{{$t_id ?? '' }}");
        // let _token   = $('meta[name="csrf_token"]').attr('content');
        var tutor_subjects = $("#tutor_subjects").val();

        if(tutor_subjects != "Select Subject") {
            $.ajax({
                url: "{{route('student.booked.tutor')}}",
                type:"POST",
                data:new FormData( this ),
                cache: false,
                contentType: false,
                processData: false,
                beforeSend:function(data) {
                    $("#finish").hide();
                    $("#proBtn").show();
                },
                success:function(response){
                    // console.log(response);
                    if(response.status == 200) {
                        toastr.success(response.message,{
                            position: 'top-end',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2500
                        });

                        setInterval(function(){
                            window.location.href = "{{ route('student.bookings') }}";
                        }, 1500);

                    } else if(response.status == 400) {
                            toastr.error(response.message,{
                            position: 'top-end',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 2500
                        });

                        setInterval(function(){}, 1500);
                    }
                },
                complete:function(data) {
                    $("#finish").show();
                    $("#proBtn").hide();
                },
                error:function(e){
                    $("#finish").show();
                    $("#proBtn").hide();
                    toastr.error('Something Went Wrong',{
                        position: 'top-end',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2500
                    });
                }
            });
        }else{
            toastr.error('Subject Field is required',{
                position: 'top-end',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
        }


    });


    $("#tutor_subjects").on('change', function() {
        var subject_id = $(this).val();
        var user_id =  $('#tutor_subjects option:selected').attr('data');

        if(subject_id != 'Select Subject') {
            $.ajax({
                url: "{{route('student.tutor.plans')}}",
                type:"POST",
                data:{
                    user_id:user_id,
                    subject_id:subject_id,
                },
                success:function(data){

                    var options = ``;

                    for(var i = 0; i< data.tutor_plans.length; i++) {
                        options += `<option value="`+data.tutor_plans[i].rate+`">
                                <div class="d-flex justify-content-between">
                                    <span> `+data.tutor_plans[i].experty_title+` </span> --
                                    <span> ($`+data.tutor_plans[i].rate+`) </span>
                                </div>
                            </option>`;
                    }

                    $("#subject_plans").html(options);
                    console.log(data);
                },
            });
        }
    });

    $("#amount").change(function(){

        amount = $(this).val();
        if(amount != null){
            $("#paypal-button-container").html('')

            //show div block on enter payment
            $("#paymntbtn").click(function(){
                $("#paymentBlock").css('display','block');
                $("#paymntbtn").css('display','none');
            });

            $("#skrillPayment").click(function(){
                skrill(amount);
            });


        }
    });
});


function getDate(date) {
    const days = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
    let current_date = new Date(date);
    let day = days[current_date.getDay()];
    var duration = 1;
    var tutor_id = $("#tutor_id").val();
    getTutorSlots(tutor_id , day , date , duration);
}

function getTutorSlots(id , day , date, duration) {
    console.log(time_slots , "time_slots 123123");
    $.ajax({
        url: "{{route('student.getTutorSlots')}}",
        type:"POST",
        data: {id:id , day:day},
        dataType:'json',
        async:false,
        beforeSend:function(data) {
            
        },
        success:function(response){
            console.log(response);
            var obj = response.slots;
            if(response.status_code == 200 && response.success == true) {
                if(obj == null){
                    toastr.error('Time slot Not Available',{
                        position: 'top-end',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2500
                    });  
                }else{
                    if(obj.wrk_from != null && obj.wrk_to != null) {
                        if(obj.day_off == 1){
                            toastr.error('Tutor is off today.',{
                                position: 'top-end',
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 2500
                            }); 
                        }else{
                            let ab = {
                                date: date,
                                from : obj.wrk_from , 
                                to : obj.wrk_to , 
                            }
                            if(time_slots.length == 0){
                                time_slots.push(ab)
                            }else{

                                time_slots[0].date = date;
                                time_slots[0].from = obj.wrk_from;
                                time_slots[0].to = obj.wrk_to;

                            }
                            // time_slots.push(ab);                           
                        }
                        showTimeSlot(duration);
                    }else{

                        toastr.error('Time Slot Not Available',{
                            position: 'top-end',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 2500
                        });    
                    }
                }
                
            }else{
                toastr.error('Something went wrong',{
                    position: 'top-end',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2500
                });
            }
        },
        complete:function(data) {
           
        },
        error:function(e){
            toastr.error('Something went wrong',{
                position: 'top-end',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
        }
    });


}

function showTimeSlot(value) {
    console.log(time_slots ,"sssssss");
    if(time_slots.length == 0 ) {
        toastr.error('Time Slot Not Selected ... please Select',{
            position: 'top-end',
            icon: 'error',
            showConfirmButton: false,
            timer: 2500
        }); 
    }else{
        var date = $('#get_date').val(); 
        var t_id = $('#tutor_id').val();
        $.ajax({
            url: "{{route('student.getFilteredTutorSlots')}}",
            type:"POST",
            data: {t_id:t_id,date:date,interval:value , start_time:time_slots[0].from,end_time:time_slots[0].to},
            dataType:'json',
            async:false,
            beforeSend:function(data) {
                
            },
            success:function(response){
                console.log(response);
                if(response.status_code == 200 && response.success == true) {
                    if(response.slots.length > 0){
                        var time_html = ``;
                        var slots = response.slots;
                        console.log(slots.length)
                        $(".create_booking_time").html('')

                        

                        for(var i = 0 ; i < slots.length; i++ ) {
                            var date = $('#get_date').val(); 
                            var from  = slots[i].slot_start_time ; 
                            var to =  slots[i].slot_end_time; 
                            var st_slot = date+' '+from;
                            var fn_slot = date+' '+to;

                            st_slot = new Date(st_slot).toLocaleString('en-US', { timeZone: '{{\Auth::user()->time_zone}}' });
                            st_slot = moment(st_slot).format('hh:mm')
                            console.log(st_slot);

                            fn_slot = new Date(fn_slot).toLocaleString('en-US', { timeZone: '{{\Auth::user()->time_zone}}' });
                            fn_slot = moment(fn_slot).format('hh:mm')
                            console.log(fn_slot);

                            time_html += `<option value="`+ st_slot +`-`+ fn_slot +`"> `+ st_slot +`-`+ fn_slot +`</option>`;
                        }
                        $(".create_booking_time").html(time_html);
                    }else{
                        toastr.error('No Slots available kindly select other tutor.',{
                            position: 'top-end',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 2500
                        });
                    }
                    

                }else{
                    toastr.error('Something went wrong',{
                        position: 'top-end',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2500
                    });
                }
            },
            complete:function(data) {
            
            },
            error:function(e){
                toastr.error('Something went wrong',{
                    position: 'top-end',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2500
                });
            }
        });
    }
    
}


function pay_now(id) {
    $.ajax({
        url: "{{route('student.book-new')}}",
        type:"post",
        data: {_token:"{{csrf_token()}}",id:id},
        dataType:'json',
        beforeSend:function(data) {
            $('#pay_now_btn_'+id).hide();
            $('#pay_now_loader_'+id).show();
        },
        success:function(response){
            var obj = response.booking;
            var comm = response.commission;

            if(response.status_code == 200 && response.success == true) {
                let price_calcualtion = "";

                let class_date = obj.class_date != null ? obj.class_date : '' ;
                let class_times = obj.class_time != null ? obj.class_time : '' ;
                let class_time = tConvert (class_times);
                let duration = obj.duration != null ? obj.duration : '' ;
                let price = obj.price != null ? obj.price : '' ;

                var commission = '0';

                if(comm != null && comm != "" && comm != []) {

                    commission = comm.commission != null ? comm.commission : '0' ;

                }else{
                    commission = '0';
                }

                // let commission = comm.commission != null ? comm.commission : '0' ;
                if(commission == '0' || commission == null ){
                    price_calcualtion = '0';
                }
                else{
                    price_calcualtion = (price * commission) / 100;
                }
                let total_price = parseFloat(price) + parseFloat(price_calcualtion);
                total_price = total_price.toString()
    
                $("#scdule_date").text(class_date);
                $("#class_time").text(class_time);
                $("#duration").text(duration + 'Hour(s)');
                $("#price").text('$'+price);
                $("#commission").text('$'+price_calcualtion);
                $("#total_commision").text(commission + '%');
                $("#total_price").text('$'+total_price);

                var origin   = window.location.origin;
                var url = origin + '/student/booking/payment/'+ obj.id;

                $("#payment").attr("action",url)
                let btn = `<input type="submit" class="schedule-btn btn w-30" value="Pay Now" />`;
                $("#show_pay_btn #payment span").html(btn);

                $("#payModel").modal('show');
                $("#paypal-button-container").html('');
                paypal.Button.render({
                    // selection for sandbox or production
                    env: 'sandbox', // sandbox | production
                    // PayPal Client IDs, these are the example defaults - replace with your own
                    client: {
                        sandbox: "{{ Config::get('paypal')['sandbox']['client_id'] }}",
                        production: '<insert production client id>'
                    },
                    // Show the buyer a 'Pay Now' button in the checkout flow
                    commit: true,
                    // payment() is called when the button is clicked
                    payment: function(data, actions) {
                        // Make a call to the REST api to create the payment
                        return actions.payment.create({
                            transactions: [{
                                amount: {
                                    total: total_price,
                                    currency: 'USD'
                                },
                                description: 'Deposit Money',
                                payment_options: {
                                    allowed_payment_method: 'INSTANT_FUNDING_SOURCE'
                                },
                            }]
                        });
                        
                    },
                    onAuthorize: function(data, actions) {
                        // Make a call to the REST api to execute the payment
                        return actions.payment.execute().then(function() {
                            // If the transaction is successful on Paypal, you can then Post to a script to run actions on your site like emailing the user etc
                            return actions.request.post("{{route('student.payment-success')}}", {
                                _token: "{{csrf_token()}}",
                                paymentID: data.paymentID,
                                payerID: data.payerID,
                                amount: total_price,
                                method: 'paypal',
                                type_id:id,
                                type:'booking_class',
                                service_fee:price_calcualtion
                            }).then(function(response) {
                                if(response.status == 200) {
                                    toastr.success(response.message,{
                                        position: 'top-end',
                                        icon: 'success',
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                    location.reload();

                                } else if(response.status == 400) {
                                        toastr.error(response.message,{
                                        position: 'top-end',
                                        icon: 'error',
                                        showConfirmButton: false,
                                        timer: 2000
                                    });

                                }

                            });
                        });

                    },
                    onCancel: function(data, actions) {
                        // Show an alert if user cancels
                        window.alert('Canceled by user');
                    },
                    onError: function(err) {
                        // Show an alert with error
                        window.alert('Error: ' + err);
                    },
                    style: {
                        // layout:  'vertical',
                        size:    'small',
                        color:   'white',
                        shape:   'rect',
                        label:   'paypal',
                        tagline: 'false',
                        height:     45
                    }


                }, '#paypal-button-container');

            }else{

            }
        },
        complete:function(data) {
            $('#pay_now_btn_'+id).show();
            $('#pay_now_loader_'+id).hide();
        },
        error:function(e){
            console.log(e);
            $('#pay_now_btn_'+id).show();
            $('#pay_now_loader_'+id).hide();
            toastr.error('Something went wrong',{
                position: 'top-end',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
        }
    });
}

function openPayNow() {
    alert("cliadf");
}

function tConvert (time) {
  // Check correct time format and split into components
  time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

  if (time.length > 1) { // If time format correct
    time = time.slice (1);  // Remove full string match value
    time[5] = +time[0] < 12 ? 'AM' : 'PM'; // Set AM/PM
    time[0] = +time[0] % 12 || 12; // Adjust hours
  }
  return time.join (''); // return adjusted time or original string
}

let val = $('input[name="paytype"]:checked').val();

if(val){
    let input = "<input type='hidden' name='paymentMethod' value='"+val+"' />"
    $("#payment #paytype").html(input)
}

function paymentMethod(value){

    let input = "<input type='hidden' name='paymentMethod' value='"+value+"' />"
    $("#payment #paytype").html(input)
}

$( '#res-task' ).on( 'submit', function(e) {
    event.preventDefault();

        $.ajax({
            url: '{{route("student.booking.reschedule")}}',
            type:'post',
            data:new FormData( this ),
            cache: false,
            contentType: false,
            processData: false,
            success:function(response){
                // console.log(response);
                if(response.status_code == 200) {
                    toastr.success(response.message,{
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2500
                    });
                    $("#exampleModalCente").modal('hide');
                    location.reload();

                } else if(response.status == 400) {
                        toastr.error(response.message,{
                        position: 'top-end',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2500
                    });

                }
            },
            error:function(e){
                toastr.error('Something Went Wrong',{
                    position: 'top-end',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2500
                });
            }
        });


});

$( '#cancel-task' ).on( 'submit', function(e) {
    event.preventDefault();

        $.ajax({
            url: "{{route('student.booking.cancel')}}",
            type:'post',
            data:new FormData( this ),
            cache: false,
            contentType: false,
            processData: false,
            success:function(response){
                // console.log(response);
                if(response.status_code == 200) {
                    toastr.success(response.message,{
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2500
                    });
                    $("#exampleModalCenter").modal('hide');
                    location.reload();

                } else if(response.status == 400) {
                        toastr.error(response.message,{
                        position: 'top-end',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2500
                    });

                }
            },
            error:function(e){
                toastr.error('Something Went Wrong',{
                    position: 'top-end',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2500
                });
            }
        });


});




</script>
