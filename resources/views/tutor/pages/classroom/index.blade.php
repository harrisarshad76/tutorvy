@extends('tutor.layouts.app')

@section('content')
 <!-- top Fixed navbar End -->
 <section>
    <div class="content-wrapper " style="overflow: hidden;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                        <p class="mr-3 heading-first">
                             Classroom
                        </p>
                </div>
            </div>
            
            <div class="row bg-white ml-2 mr-2">
                <!-- <div class="col-md-12 mb-1 ">
                    <div class=" card  bg-toast infoCard">
                        

                        <div class="card-body row">
                            <div class="col-md-1 text-center">
                                <i class="fa fa-info" aria-hidden="true"></i>
                            </div>
                            <div class="col-md-11 pl-0">
                               <small>
                                   Every Details about your classes will be published here along with schedules for meetings <a href="#">Learn More</a>
                               </small> 
                               <a href="#" class="cross"  onclick="hideCard()"> 
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="col-md-12 mt-3">
                    <nav class="">
                        <div class="nav nav-stwich pb-0" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
                                href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">
                                All Classes
                                <span class="counter-text bg-primary"> {{count($classes)}} </span>
                            </a>
                            <a class="nav-item nav-link " id="nav-course-tab" data-toggle="tab" href="#nav-course"
                                role="tab" aria-controls="nav-course" aria-selected="true">
                                Course Classes
                                <span class="counter-text bg-primary"> 5 </span>
                            </a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab"
                                href="#nav-profile" role="tab" aria-controls="nav-profile"
                                aria-selected="false">
                                Delivered Classes
                                <span class="counter-text bg-success">{{count($deli_classes)}}</span>

                            </a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane tab-border-none tab-border-none-1 fade show active" id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                                <div class="container-fluid ">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <table class="table table-bordered ">
                                                <thead>
                                                    <tr
                                                        style="font-family: Poppins;font-size: 14px;color: #00132D; border-top: 1px solid #D6DBE2;border-bottom: 1px solid #D6DBE2;">
                                                        <th scope="col">Student</th>
                                                        <th scope="col">Subject</th>
                                                        <th scope="col">Topic</th>
                                                        <!-- <th scope="col">Time</th>
                                                        <th scope="col">Duration</th> -->
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Starts In</th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @if($classes != null && $classes != [] && $classes != "")
                                                    @foreach($classes as $class)
                                                        @if($class != null && $class != "")
                                                            @php
                                                                $date = $class->class_date;
                                                                $date = date("D, d-M-y", strtotime($date))
                                                            @endphp
                                                            <tr>
                                                                <td class="pt-4">
                                                                    @if($class->user != null && $class->user != "")
                                                                        <a href="{{route('tutor.student',[$class->user->id])}}">
                                                                            {{ $class->user->first_name }} {{ $class->user->last_name }}
                                                                        </a>
                                                                    @else
                                                                    <span> - </span>
                                                                    @endif
                                                                </td>
                                                                <td class="pt-4"> {{ $class->subject->name }} </td>
                                                                <td class="pt-4"> {{ $class->topic }} </td>
                                                                
                                                                <td class="pt-4">
                                                                @if($class->status == 1)
                                                                    <span class="bg-color-apporve3">
                                                                        Payment Pending
                                                                    </span>
                                                                @elseif($class->status == 2)
                                                                    <span class="bg-color-apporve1">
                                                                        Approved
                                                                    </span>
                                                                @elseif($class->status == 5)
                                                                    <span class="bg-color-apporve1">
                                                                        Delivered
                                                                    </span>
                                                                @elseif($class->status == 0)
                                                                    <span class="bg-color-apporve">
                                                                        Pending 
                                                                    </span>
                                                                @endif
                                                                </td>
                                                                <td>
                                                                    <span data-date="{{$class->class_date}}" data-id="{{$class->id}}" data-duration="{{$class->duration}}"
                                                                        data-time="{{$class->class_tm}}" data-endtime="{{$class->class_end_tm}}" id="class_time_{{$class->id}}"
                                                                        data-room="{{$class->classroom != null ? $class->classroom->classroom_id : ''}}"
                                                                        class="current_time text-center"> {{$date }} , {{$class->class_tm}} to {{$class->class_end_tm}}
                                                                    </span>
                                                                    
                                                                </td>
                                                                <td class="pt-4" style="text-align: center;">
                                                                    <span id="class_time_btn_{{$class->id}}">

                                                                    </span>
                                                                    <a class="cencel-btn" href="{{route('tutor.booking.detail',[$class->id])}}"> 
                                                                        View details 
                                                                    </a>                                                            
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @else
                                                        <td>
                                                            No Class Found
                                                        </td>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- end -->
                        </div>
                        <div class="tab-pane tab-border-none fade" id="nav-profile" role="tabpanel"
                            aria-labelledby="nav-profile-tab">
                                <div class="container-fluid ">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr
                                                        style="font-family: Poppins;font-size: 14px;color: #00132D; border-top: 1px solid #D6DBE2;border-bottom: 1px solid #D6DBE2;">
                                                        <th scope="col">Student</th>
                                                        <th scope="col">Subjects</th>
                                                        <th scope="col">Topic</th>
                                                        <th scope="col">Time</th>
                                                        <!-- <th scope="col">Duration</th> -->
                                                        <th scope="col">Status</th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @if($classes != null && $classes != [] && $classes != "")

                                                    @foreach($classes as $class)
                                                        @if($class != null && $class != "" )
                                                            @if($class->status == 5)
                                                                <tr>
                                                                    <td class="pt-4">
                                                                        @if($class->user != null && $class->user != "")
                                                                            <a href="{{route('tutor.student',[$class->user->id])}}">
                                                                                {{ $class->user->first_name }} {{ $class->user->last_name }}
                                                                            </a>
                                                                        @else
                                                                        <span> - </span>
                                                                        @endif
                                                                    </td>
                                                                    <td class="pt-4">
                                                                        {{ $class->subject->name }}
                                                                    </td>
                                                                    <td class="pt-4">
                                                                        {{ $class->topic }}
                                                                    </td>
                                                                    <td class="pt-4">
                                                                        {{ $class->class_time }}
                                                                        <!-- {{ date('g:i a', strtotime("$class->class_time UTC")) }} -->
                                                                        <!-- {{$class->class_time}} {{date("g:i a", strtotime("$class->class_time UTC"))}} -->
                                                                    </td>
                                                                    
                                                                    <td class="pt-4">
                                                                        {{ $class->duration }} Hour(s)
                                                                    </td>
                                                                    <td class="pt-4">
                                                                   
                                                                        <span class="bg-color-apporve1">
                                                                            Delivered
                                                                        </span>
                                                                  
                                                                    </td>

                                                                    <td class="pt-4"  style="text-align: center;">
                                                                        <a class="cencel-btn"  href="{{route('tutor.booking.detail',[$class->id])}}"> View details </a>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endif
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
                                <!-- end -->
                        </div>
                        <div class="tab-pane tab-border-none fade" id="nav-course" role="tabpanel"
                            aria-labelledby="nav-course-tab">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <table class="table table-bordered ">
                                        <thead>
                                            <tr
                                                style="font-family: Poppins;font-size: 14px;color: #00132D; border-top: 1px solid #D6DBE2;border-bottom: 1px solid #D6DBE2;">
                                                <th scope="col">Course Title</th>
                                                <th scope="col">Subject</th>
                                                <th scope="col">Class title</th>

                                                <th scope="col">Plan</th>
                                                <th scope="col">Class Time</th>
                                                <th scope="col">Status</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($courses_enrolled as $class)
                                                @if($class->enClass)
                                                @php
                                                    $date = $class->enClass->class_date;
                                                    $date = date("D, d-M-y", strtotime($date))
                                                @endphp
                                                <td class="pt-4">
                                                    {{ $class->title}}
                                                </td>
                                                <td class="pt-4">{{$class->subject_name}}</td>
                                                <td class="pt-4">{{$class->enClass->class_title}}</td>

                                                <td class="pt-4">
                                                    @if($class->enClass->class_plan == 1 )
                                                        Basic
                                                    @elseif($class->enClass->class_plan == 2)
                                                        Standard
                                                    @else
                                                        Advanced
                                                    @endif
                                                </td>
                                                <td class="pt-4">
                                                    <span data-date="{{$class->enClass->class_date}}" data-id="{{$class->id}}" data-duration="1"
                                                        data-time="{{$class->enClass->class_time}}" data-endtime="{{$class->enClass->class_end_time}}" id="class_time_{{$class->id}}"
                                                        data-room="{{$class->classroom != null ? $class->classroom->classroom_id : ''}}"
                                                        class="current_course_time text-center"> {{$date }} , {{$class->enClass->class_time}} to {{$class->enClass->class_end_time}}
                                                    </span>
                                                </td>
                                                <td class="pt-4">
                                                    Pending
                                                </td>
                                                
                                                <td class="pt-4">
                                                    <a href="{{route('tutor.start_class',[$class->classroom->classroom_id])}}"  class="schedule-btn"> Start Call </a>
                                                </td>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="line"></div>
    </div>
</section>

<script src="{{asset('/admin/assets/js/jquery.js')}}"></script>
<script src="{{asset('/admin/assets/js/jquery-ui.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script>
    $(document).ready(function() {

        const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        setInterval(() => {
            $( ".current_time" ).each(function() {

                    var id = $(this).data('id');
                    var booking_time = $(this).data('time');
                    var booking_end_time = $(this).data('endtime');
                    var booking_date = $(this).data('date');
                    var duration = $(this).data('duration');
                    var room = $(this).data('room');

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

                    let start_call = `<a href="{{url('tutor/class')}}/`+ room +`"  class="schedule-btn"> Start Call </a>`;

                    if(current_date.getTime()  < strt_date.getTime() ) {
                        // $("#class_time_"+id).text(dt_format);
                    }else{
                        if(current_date.getTime()  > strt_date.getTime() && current_date.getTime() < end_date.getTime()) {
                            if(room != null && room != "") {
                                $("#class_time_btn_"+id).html(start_call);
                            }else{
                                // $("#class_time_"+id).html("-");
                                $("#class_time_btn_"+id).html("");
                            }
                        }else {
                            // $("#class_time_"+id).html("-");
                            $("#class_time_btn_"+id).html("");
                        } 
                    }
                });
        }, 1000);

        setInterval(() => {
            $( ".current_course_time" ).each(function() {

                var id = $(this).data('id');
                var booking_time = $(this).data('time');
                var booking_end_time = $(this).data('endtime');
                var booking_date = $(this).data('date');
                var duration = $(this).data('duration');
                var room = $(this).data('room');

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

                let start_call = `<a href="{{url('tutor/class')}}/`+ room +`"  class="schedule-btn"> Start Call </a>`;
            

                if(current_date.getTime()  < strt_date.getTime() ) {
                }else{
                    if(current_date.getTime()  > strt_date.getTime() && current_date.getTime() < end_date.getTime()) {
                        if(room != null && room != "") {
                            $("#class_time_btn_"+id).html(start_call);
                        }else{
                            $("#class_time_btn_"+id).html("");
                        }
                    }else {
                        $("#class_time_btn_"+id).html("");
                    } 
                }
            });
        }, 1000);

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
      

    });
</script>
@endsection