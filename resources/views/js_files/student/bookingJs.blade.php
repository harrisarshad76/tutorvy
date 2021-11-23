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
})


function getDate(date) {
    const days = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
    let current_date = new Date(date);
    let day = days[current_date.getDay()];
    var duration = 1;
    var tutor_id = $("#tutor_id").val();
    getTutorSlots(tutor_id , day , date);

}

function getTutorSlots(id , day , date) {
    $.ajax({
        url: "{{route('student.getTutorSlots')}}",
        type:"POST",
        data: {id:id , day:day},
        dataType:'json',
        beforeSend:function(data) {
            
        },
        success:function(response){
            console.log(response);
            var obj = response.slots;
            if(response.status_code == 200 && response.success == true) {
                if(obj.wrk_from != null && obj.wrk_to != null) {
                    let ab = {
                        date: date,
                        from : obj.wrk_from , 
                        to : obj.wrk_to , 
                    }
                    time_slots.push(ab);
                }else{

                    toastr.error('Time Slot Not Available',{
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

function showTimeSlot(value) {

    if(time_slots.length == 0) {
        toastr.error('Time Slot Not Selected ... please Select',{
            position: 'top-end',
            icon: 'error',
            showConfirmButton: false,
            timer: 2500
        }); 
    }else{
        var date = time_slots[0].date;
        var from = time_slots[0].from;
        var to = time_slots[0].to;

        let from_new_date = date + ' ' + from;
        let to_new_date = date + ' ' + to;

        var fr = new Date(from_new_date);
        var too = new Date(to_new_date);

        let a = moment(fr).format('DD/MM/YYYY HH:mm:ss');
        let b = moment(too).format('DD/MM/YYYY HH:mm:ss');

        var ms = moment(b,"DD/MM/YYYY HH:mm:ss").diff(moment(a,"DD/MM/YYYY HH:mm:ss"));
        var d = moment.duration(ms);
        console.log(d.hours() , "d hours");
        var s = Math.floor(d.asHours()) + moment.utc(ms).format(":mm:ss");

        let remain_hours = d.hours();

        let check = remain_hours / value;
        console.log(check , "check");
        if(check <= 0 ||  check <= 0.0) {
            toastr.error('TimeSlot not available',{
                position: 'top-end',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            }); 
        }else{
            $("#booking_time").removeAttr('disabled');
            var time_html = ``;
            for(var i = 1 ; i <= check; i++ ) {
                console.log(i , "i");
                console.log(i + ':00' , "i");
                time_html += `<option value="`+ i +`:00"> `+ i +`:00</option>`;
            }
            $(".create_booking_time").html(time_html);

        }
        
        
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
