@extends('student.layouts.app')
<script src="https://rtcmulticonnection.herokuapp.com/dist/RTCMultiConnection.min.js"></script>
<script src="https://rtcmulticonnection.herokuapp.com/socket.io/socket.io.js"></script>
@section('content')
    <!-- top Fixed navbar End -->
    <style>
        .rating-stars ul {
            list-style-type: none;
            padding: 0;

            -moz-user-select: none;
            -webkit-user-select: none;
        }

        .rating-stars ul>li.star {
            display: inline-block;
        }

        .rating-stars ul>li.star>i.fa {
            font-size: 2.5em;
            /* Change the size of the stars */
            color: #ccc;
            /* Color on idle state */
        }

        .rating-stars ul>li.star.selected>i.fa {
            color: #FF912C;
        }

    </style>
    <div class="content-wrapper " style="overflow: hidden;">
        <section id="classroomsection" style="display: flex;">
            <div class="container-fluid m-0 p-0">
                <div class="row">
                    <div class="col-md-12">
                        <!-- <p id="sidenav-toggles" class="heading-first  mr-3 mb-2 ml-2">
                            Bookings
                        </p> -->
                        <p class="heading-first ml-3 mr-3">Classroom </p>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-md-12">
                        <div class="image-center-nobooking text-center mt-5">
                            <img src="../assets/images/ico/class-icon.png" alt="class-ico" style="width: 200px;">
                            <p class="nobooking-booking">Create New Classroom</p>
                            <P class="improve-booking">
                                It is a long established fact that a reader will be <br /> distracted by the
                                readable
                                content.</P>
                            <br />
                            <button data-toggle="modal" data-target="#exampleModalCenter" class="schedule-btn"
                                style="width: 180px;font-size: 14px;">

                                Create classroom
                            </button>
                        </div>
                        <div class="modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-heade mt-3 pb-3">
                                        <p class="modal-title text-center text-justify" id="exampleModalLongTitle">
                                            Bookings</p>
                                    </div>
                                    <div class="modal-body ">
                                        <div class="d-flex std-name">
                                            <img src="../assets/images/ico/Square-white.jpg" alt="boy" style="width: 30px;">
                                            <p class="heading-fifth ml-2">Harram Laraib</p>
                                            <p class="std-student">Student</p>
                                            <img src="../assets/images/ico/3dot.png" alt="dots"
                                                style="width: 20px;position: relative;left: 260px;">
                                        </div>
                                        <div class="container">
                                            <p class="heading-fifth mt-3"> Lorem ipsum dolor sit amet consectetur ?
                                            </p>
                                            <p class="paragraph-text"> Lorem ipsum, dolor sit amet consectetur
                                                adipisicing elit. Maxime facere quis deleniti, nam, vel dolore
                                                distinctio eum nesciunt explicabo exercitationem sint fuga ad soluta
                                                aspernatur nisi id doloremque? Optio, labore!
                                            </p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">

                                        <input id="curtainInput" type="button" value="Send Class Link"
                                            class="schedule-btn w-100" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="row bg-white ml-2 mr-2">
                    <div class="col-md-12 mb-1 ">
                        <div class=" card  bg-toast infoCard">


                            <div class="card-body row">
                                <div class="col-md-1 text-center">
                                    <i class="fa fa-info" aria-hidden="true"></i>
                                </div>
                                <div class="col-md-11 pl-0">
                                    <small>
                                        Classes Details and all about your schedule. <a href="#">Learn More</a>
                                    </small>
                                    <a href="#" class="cross" onclick="hideCard()">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <nav>
                            <div class="nav nav-stwich" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                                    role="tab" aria-controls="nav-home" aria-selected="true">
                                    All Classes
                                    <span class="counter-text bg-primary"> {{ count($classes) }} </span>
                                </a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                                    role="tab" aria-controls="nav-profile" aria-selected="false">
                                    Delivered Classes
                                    <span class="counter-text bg-success"> {{ count($booked_classes) }} </span>
                                </a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane tab-border-none tab-border-none-1 fade show active" id="nav-home"
                                role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table class="table table-bordered text-center">
                                            <thead>
                                                <tr
                                                    style="font-family: Poppins;font-size: 14px;color: #00132D; border-top: 1px solid #D6DBE2;border-bottom: 1px solid #D6DBE2;">
                                                    <th scope="col">Tutor</th>
                                                    <th scope="col">Subjects</th>
                                                    <th scope="col">Topic</th>
                                                    <!-- <th scope="col">Time</th>
                                                    <th scope="col">Duration</th> -->
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Starts In</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($classes != null && $classes != [] && $classes != '')
                                                    @foreach ($classes as $class)
                                                        @php
                                                            $date = $class->class_date;
                                                            $date = date("D, d-M-y", strtotime($date))
                                                        @endphp
                                                        <tr>
                                                            <td class="pt-3">
                                                                {{ $class->tutor->first_name }}
                                                                {{ $class->tutor->last_name }}
                                                            </td>
                                                            <td class="pt-3">
                                                                {{ $class != null ? $class->subject->name : '---' }}
                                                            </td>
                                                            <td class="pt-3">
                                                                {{ $class != null ? $class->topic : '---' }}
                                                            </td>
                              
                                                            <td class="pt-3">

                                                                @if ($class->status == 1)
                                                                    <span class="bg-color-apporve">
                                                                        Payment Pending
                                                                    </span>
                                                                @elseif($class->status == 2)
                                                                    <span class="bg-color-apporve1">
                                                                        Approved
                                                                    </span>
                                                                @elseif($class->status == 0)
                                                                    <span class="bg-color-apporve2">
                                                                        Pending
                                                                    </span>
                                                                @elseif ($class->status == 5)
                                                                    <span class="bg-color-apporve3">
                                                                        Delivered
                                                                    </span>
                                                                @endif
                                                            </td>
                                                            @if($class->status == 5 && $class->is_reviewed == 0)
                                                                <td style="text-align: center;padding-top:14px;">
                                                                    <button class="cencel-btn" type="button"  onclick="showReviewModal({{ $class->id }})"> Review Now
                                                                    </button>
                                                                </td>
                                                            @elseif($class->status != 5 && $class->is_reviewed == 0)
                                                            <td>
                                                                <span data-date="{{$class->class_date}}" data-id="{{$class->id}}" data-duration="{{$class->duration}}"
                                                                data-time="{{$class->class_tm}}" data-endtime="{{$class->class_end_tm}}" id="class_time_{{$class->id}}"
                                                                data-room="{{$class->classroom != null ? $class->classroom->classroom_id : ''}}" 
                                                                data-booking="{{$class->classroom != null ? $class->classroom->booking_id : ''}}"
                                                                class="current_time"> {{$date }} , {{$class->class_tm}} to {{$class->class_end_tm}}
                                                                    
                                                                </span>
                                                                
                                                            </td>
                                                            @else
                                                            <td class="pt-3">
                                                                ---
                                                            </td>
                                                            @endif
                                                            
                                                            <td style="text-align: center;padding-top:14px;">
                                                            <span id="class_time_btn_{{$class->id}}">

                                                                    </span>
                                                                <a class="schedule-btn"  href="{{route('student.booking-detail',[$class->id])}}"> View details
                                                            </a>
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td>
                                                            No Class Found
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane tab-border-none fade" id="nav-profile" role="tabpanel"
                                aria-labelledby="nav-profile-tab">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table class="table table-bordered ">
                                            <thead>
                                                <tr
                                                    style="font-family: Poppins;font-size: 14px;color: #00132D; border-top: 1px solid #D6DBE2;border-bottom: 1px solid #D6DBE2;">
                                                    <th scope="col">Tutor</th>
                                                    <th scope="col">Subjects</th>
                                                    <th scope="col">Topic</th>
                                                    <th scope="col">Time</th>
                                                    <th scope="col">Duration</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($booked_classes != null && $booked_classes != [] && $booked_classes != '')
                                                    @foreach ($booked_classes as $class)
                                                        <tr>
                                                            <td class="pt-3">
                                                                {{ $class->tutor->first_name }}
                                                                {{ $class->tutor->last_name }}
                                                            </td>
                                                            <td class="pt-3">
                                                                {{ $class != null ? $class->subject->name : '---' }}
                                                            </td>
                                                            <td class="pt-3">
                                                                {{ $class != null ? $class->topic : '---' }}
                                                            </td>
                                                            <td class="pt-3">
                                                                {{ $class->class_time }}
                                                                {{ date('g:i a', strtotime("$class->class_time UTC")) }}
                                                            </td>

                                                            <td class="pt-3">
                                                                {{ $class->duration }} Hour(s)
                                                            </td>
                                                            <td class="pt-3">
                                                                @if ($class->status == 5)
                                                                    <span class="bg-color-apporve3"> Delivered </span>
                                                                @endif
                                                            </td>


                                                            <td style="text-align: center;padding-top:14px;">
                                                                @if ($class->status == 5 && $class->is_reviewed == 0)
                                                                    <a type="button"
                                                                        onclick="showReviewModal('{{ $class->booking_id }}')"
                                                                        class="cencel-btn">
                                                                        Review Now
                                                                    </a>
                                                                @else 
                                                                    <a class="schedule-btn"  href="{{route('student.booking-detail',[$class->id])}}">
                                                                            View Details
                                                                        </a>
                                                                @endif
                                                               
                                                                
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td>
                                                            No Class Found
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!--Review Modal -->
    <div class="modal " id="reviewModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content pt-4 pb-4">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <input type="hidden" id="booking_id">
                            <div class="col-md-12">
                                <div class="iconss" style="text-align: center;">
                                    <img src="../assets/images/ico/submit-test.png" width="60px">
                                    <p
                                        style="font-size: 24px;color: #00132D;font-family: Poppins;font-weight: 500;margin-top: 10px;">
                                        Review Class</p>
                                    <p style="font-size: 15px;color: #00132D;font-family: Poppins;font-weight: 400;"
                                        class="ml-4 mr-4">
                                        Send review for class with a short note about why are you reviewing this to this
                                        class
                                    </p>
                                </div>
                                <div class="ml-4 mr-4">
                                    <form>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <input type="hidden" id="star_rating" value="5">
                                                <p class="star-review" id='stars'>
                                                <div class='rating-stars text-center'>
                                                    <ul id='stars'>
                                                        <li class='star selected' title='Poor' data-value='1'>
                                                            <i class="fa fa-star "></i>
                                                        </li>
                                                        <li class='star selected' title='Poor' data-value='2'>
                                                            <i class="fa fa-star"></i>
                                                        </li>
                                                        <li class='star selected' title='Poor' data-value='3'>
                                                            <i class="fa fa-star"></i>
                                                        </li>
                                                        <li class='star selected' title='Poor' data-value='4'>
                                                            <i class="fa fa-star"></i>
                                                        </li>
                                                        <li class='star selected' title='Poor' data-value='5'>
                                                            <i class="fa fa-star "></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                                </p>
                                            </div>
                                        </div>
                                        <textarea class="form-control mt-3" rows="6" cols="50" placeholder="Write reason"
                                            id="std_review" required="required"></textarea>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 mb-2" style="text-align: right;">
                        <button type="button" class="schedule-btn" id="send_review"
                            style="width: 130px;margin-right: 40px;">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="{{ asset('/admin/assets/js/jquery.js') }}"></script>
<script src="{{ asset('/admin/assets/js/jquery-ui.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
    $(document).ready(function() {
        const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        $('#stars li').on('click', function() {
            var onStar = parseInt($(this).data('value'), 10); // The star currently selected
            var stars = $(this).parent().children('li.star');

            for (i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass('selected');
            }

            for (i = 0; i < onStar; i++) {
                $(stars[i]).addClass('selected');
            }

            var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
            $("#star_rating").val(ratingValue);

        });

        $("#send_review").click(function() {
            var star_rating = $("#star_rating").val();
            var review = $("#std_review").val();
            var booking_id = $("#booking_id").val();

            var form_data = {
                review: review,
                star_rating: star_rating,
                booking_id: booking_id,
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('student.save.review') }}",
                type: "POST",
                data: form_data,
                dataType: 'json',
                success: function(response) {
                    console.log(response, "data");
                    if (response.status_code == 200 && response.success == true) {
                        toastr.success(response.message, {
                            position: 'top-end',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2500
                        });
                        $("#reviewModal").modal('hide');
                        location.reload();
                    } else {
                        toastr.error(response.message, {
                            position: 'top-end',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 2500
                        });
                    }
                },
                error: function(e) {
                    console.log(e)
                }
            });

        });


        setInterval(() => {
            $(".current_time").each(function() {
            var id = $(this).data('id');
            var booking_time = $(this).data('time');
            var booking_end_time = $(this).data('endtime');
            var booking_date = $(this).data('date');
            var duration = $(this).data('duration');
            var room = $(this).data('room');
            var booking = $(this).data('booking');

            const days = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
            let get_day_in_no = moment(booking_date).day();
            let day = days[get_day_in_no];        
            
            var current_date = new Date();
            
            let strt_date = new Date(booking_date + ' ' + booking_time);
            let end_date = new Date(booking_date + ' ' + booking_end_time);

            let convert_date = moment(booking_date).format('DD MMMM');
            
            let start_date = moment(strt_date).format("hh:mm A");
            let ed_date = moment(end_date).format("hh:mm A");

            var dt_format = day +','+convert_date+', ' + start_date + ' - ' + ed_date;

            let join_btn = `<a onclick="joinClass('`+room+`','`+booking+`')" class="schedule-btn"> Join Class </a>`;
            $("#class_time_"+id).text(dt_format);

            // let a =  {
            //     current_date : current_date.getTime() ,
            //     strt_date : strt_date.getTime() ,
            //     end_date : end_date.getTime() ,
            // }

            // console.table(a);

            if(current_date.getTime()  < strt_date.getTime() ) {
                // $("#class_time_"+id).text(dt_format);
            }else{
                if(current_date.getTime()  > strt_date.getTime() && current_date.getTime() < end_date.getTime()) {
                    if(room != null && room != "") {
                        $("#class_time_btn_"+id).html(join_btn);
                    }else{
                        $("#class_time_btn_"+id).html("");
                    }
                }else {
                    $("#class_time_btn_"+id).html("");
                } 
            }

            // console.log(day +','+convert_date+', ' + start_date + ' - ' + end_date , "convert_date");

            // let user_region = "{{Auth::user()->time_zone}}";

            // if(user_region != null && user_region != "") {

            //     var current_user_time_zone = new Date().toLocaleString('en-US', { timeZone: user_region });

            //     let create_date_format = new Date(booking_date + ' ' + booking_time);
            //     let start_date = moment(create_date_format).format("hh:mm A");
            
            //     let end_date = moment(create_date_format).add(1, 'hours').format("hh:mm A");
            //     let end_date_booking = new Date(booking_date + ' ' + end_date);
                
            //     var show_date_time = day + ',' + convert_date + ',' + start_date + ' - ' + end_date;

            //     $("#class_time_"+id).text(show_date_time);
                
            //     let timezoneTime = new Date(current_user_time_zone);

            //     let join_btn = `<a onclick="joinClass('`+room+`','`+booking+`')" class="schedule-btn"> Join Class </a>`;

            //     if(timezoneTime.getTime()  < create_date_format.getTime() ) {
            //         $("#class_time_"+id).text(show_date_time);
            //     }else{
            //         if(timezoneTime.getTime()  > create_date_format.getTime() && timezoneTime.getTime() < end_date_booking.getTime()) {
            //             if(room != null && room != "") {
            //                 $("#class_time_"+id).html(join_btn);
            //             }else{
            //                 $("#class_time_"+id).html("-");
            //             }
            //         }else {
            //             $("#class_time_"+id).html("-");
            //         } 
            //     }
            // }
            // var now = moment();
            // const date1 = moment(booking_date).format('YYYY-MM-DD').valueOf()
            // const date2 = moment().format('YYYY-MM-DD').valueOf();

            // if (date1 < date2) {
            //     $("#join_class_"+attr_id).html("");
            //     $("#class_time_"+attr_id).html("Class Time Over");
            // } else {
            //     var date = new Date();
            //     var remain_time = (booking_seconds_time - HmsToSeconds(moment(date).format('HH:mm:ss')));

            //     var std_time_in_seconds = HmsToSeconds(moment(date).format('HH:mm:ss'));

            //     var region_booking_time = moment(date).add(remain_time,'s').format("LT");
            //     var booking_time = new Date(booking_date + ' ' +  region_booking_time);

            //     var class_end_time = moment(date).add(remain_time,'s').add(duration, 'h').format("LT");
            //     var class_end_date = new Date(booking_date + ' ' +  class_end_time);


            //     let join_btn = `<a onclick="joinClass('`+room_id+`')" class="schedule-btn"> Join Class </a>`;

            //     timer.start({countdown: true, startValues: {seconds: remain_time}});
            //     timer.addEventListener('secondsUpdated', function (e) {
            //         if( parseInt(remain_time) > 0)  {
            //             $("#class_time_"+attr_id).html(timer.getTimeValues().toString());
            //             var current_time_text =  $("#class_time_"+attr_id).text();
            //             if($.trim(current_time_text) == "00:00:00") {
            //                 $(".join_class_"+attr_id).html(join_btn);
            //                 $("#class_time_"+attr_id).html("");
            //             }
            //         }else{
            //             $(".join_class_"+attr_id).html("");
            //             $("#class_time_"+attr_id).html("Class Time Over");
            //         }

            //     });

            //     timer.addEventListener('targetAchieved', function (e) {
            //         var current_time_text =  $("#class_time_"+attr_id).text();

            //         if( parseInt(remain_time) > 0) {
            //             if($.trim(current_time_text)  == "00:00:00") {
            //                 $(".join_class_"+attr_id).html(join_btn);
            //                 $("#class_time_"+attr_id).html("");
            //             }
            //         }else{
            //             $(".join_class_"+attr_id).html("");
            //             $("#class_time_"+attr_id).html("Class Time Over");
            //         }
            //     });

            //     if(date.getTime() > booking_time.getTime() &&  date.getTime() < class_end_date.getTime()) {
            //         if(review == 0) {
            //             if(Math.abs(remain_time) > 0) {
            //                 $(".join_class_"+attr_id).html(join_btn);
            //                 $("#class_time_"+attr_id).html("");
            //             }else{
            //                 $(".join_class_"+attr_id).html("");
            //                 $("#class_time_"+attr_id).html("Class Time Over");
            //             }
            //         }
            //     }else {
            //         $(".join_class_"+attr_id).html("");
            //         $("#class_time_"+attr_id).html("Class Time Over");
            //     }
            // }

        });    
        }, 1000);
        
    });


    function HmsToSeconds(hms) {
        // var hms = '02:04:33';
        var a = hms.split(':'); // split it at the colons

        // minutes are worth 60 seconds. Hours are worth 60 minutes.
        var seconds = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]);
        return seconds;
    }

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

    // function joinClass(id,booking) {
    //     var connection = new RTCMultiConnection();
    //     var roomid = id;
    //     var booking = booking;
        
    //     var fullName = '---';
    //     connection.socketURL = 'https://tutorvy.herokuapp.com:443/';

    //     connection.checkPresence(roomid, function(isRoomExist, roomid, error) {
    //         if (isRoomExist === true) {

    //             window.location.href = `{{ url('student/testmedia') }}/` + booking;
    //         } else {
    //             toastr.warning('Tutor not joined yet.', {
    //                 position: 'top-end',
    //                 icon: 'warning',
    //                 showConfirmButton: false,
    //                 timer: 2500
    //             });
    //         }
    //     });
    // }


    function showReviewModal(id) {
        $("#booking_id").val(id);
        // $(".content-wrapper").css("display","none");
        $("#reviewModal").modal('show');
    }
    function randstr(prefix)
{
    return Math.random().toString(36).replace('0.',prefix || '');
}
</script>
