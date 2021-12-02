@extends('student.layouts.app')
<link href="{{ asset('assets/css/registration.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/booknow.css') }}" rel="stylesheet">
@section('content')
<style>
    input[type="date"]::-webkit-calendar-picker-indicator {
    background: transparent;
    bottom: 0;
    color: transparent;
    cursor: pointer;
    height: auto;
    left: 0;
    position: absolute;
    right: 0;
    top: 0;
    width: auto;
}
input[type="time"]::-webkit-calendar-picker-indicator {
    background: transparent;
    bottom: 0;
    color: transparent;
    cursor: pointer;
    height: auto;
    left: 0;
    position: absolute;
    right: 0;
    top: 0;
    width: auto;
}
</style>
 <!-- top Fixed navbar End -->
 <section>

    <div class="container">
        <p id="sidenav-toggles" class="heading-first  mr-3 mb-4 ml-2">
            Bookings
        </p>
    </div>
    <div class="container">
        <div class="col-md-12">
            <p class="heading-third mt-3">Personal information</p>
            <form enctype="multipart/form-data" id="book_tutor_form">
                <input type="hidden" name="current_date" id="current_date">
                <input type="hidden" name="class_time" id="class_time">
                <input type="hidden" name="class_end_time" id="class_end_time">
                <input type="hidden" name="_id" id="_id">

                <input type="hidden" name="offset" id="offset">

                <div class="row mt-5">
                        <div class=" col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <select name="subject" id="tutor_subjects" class="form-select form-select-lg w-100"
                                        aria-label=".form-select-lg example" required>
                                        <option selected="selected" value="Select Subject">Select Subject</option>
                                        @foreach($subjects as $subject)
                                        <option value="{{$subject->subject_id}}" data="{{$subject->user_id}}">{{$subject->sub_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <input type="text" class="form-control " name="topic"
                                    placeholder="Type your Topic" value="" required>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <select name="subject_plan" id="subject_plans" class="form-select form-select-lg w-100"
                                        aria-label=".form-select-lg example" required>
                                        <option value="Select Subject">Select Plans</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-block">
                            <div class="card mt-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="row">
                                                <div class="col-md-2 col-6">
                                                    @if($user->picture == "" || $user->picture == null)
                                                        <img src="{{asset ('assets/images/ico/Square-white.jpg')}}" alt="" class="profile-img">
                                                    @else
                                                        <img src="{{asset($user->picture)}}"  alt="" class="profile-img">
                                                    @endif
                                                </div>
                                                <div class="col-md-10 col-6">
                                                    <h3 class="mb-0">{{$user->first_name}}  {{$user->last_name}}</h3>
                                                    <p class="mb-0 "><img src="{{asset('assets/images/ico/red-icon.png')}}" alt="" class="pr-2">{{$user->professional->last()->designation ?? '---'}} at {{$user->professional->last()->organization}}</p>
                                                    <p class="mb-0 "><img src="{{asset('assets/images/ico/location-pro.png')}}" alt="" class="pr-2">{{ $user->city != NULL ? $user->city.' , ' : '---' }} {{ $user->country != NULL ? $user->country: '---' }}</p>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <p class="text-right mb-0">
                                                @if($user->rank == 0)
                                                <a class="ab_right" href="#" data-toggle="modal"
                                                    data-target="#rankModal">New <img src="/assets/images/ico/bluebadge.png" class="wd-30" alt="" width="25">
                                                </a>
                                                @elseif($user->rank == 1)
                                                <a class="ab_right" href="#" data-toggle="modal"
                                                    data-target="#rankModal">Emerging <img src="/assets/images/ico/yellow-rank.png" class="wd-30" alt="" width="25">
                                                </a>
                                                @elseif($user->rank == 2)
                                                <a class="ab_right" href="#" data-toggle="modal"
                                                    data-target="#rankModal">Top Rank <img src="/assets/images/ico/rank.png" class="wd-30" alt="" width="25">
                                                </a>
                                                @else
                                                <a class="ab_right" href="#" data-toggle="modal"
                                                    data-target="#rankModal">Upgrade badge <img src="/assets/images/ico/rank.png" class="wd-30" alt="" width="25">
                                                </a>
                                                @endif
                                            </p>
                                       
                                            <p class="text-right mb-0">
                                                @if($user->rating == 1)
                                                <i class="fa fa-star text-yellow"></i>
                                                <i class="fa fa-star "></i>
                                                <i class="fa fa-star "></i>
                                                <i class="fa fa-star "></i> 1.0
                                                @elseif($user->rating == 2)
                                                <i class="fa fa-star text-yellow"></i>
                                                <i class="fa fa-star text-yellow"></i>
                                                <i class="fa fa-star "></i>
                                                <i class="fa fa-star "></i>  2.0
                                                @elseif($user->rating == 3)
                                                <i class="fa fa-star text-yellow"></i>
                                                <i class="fa fa-star text-yellow"></i>
                                                <i class="fa fa-star text-yellow"></i>
                                                <i class="fa fa-star "></i>  3.0
                                                @elseif($user->rating == 4)
                                                <i class="fa fa-star text-yellow"></i>
                                                <i class="fa fa-star text-yellow"></i>
                                                <i class="fa fa-star text-yellow"></i>
                                                <i class="fa fa-star text-yellow"></i>  4.0
                                                @else
                                                <i class="fa fa-star "></i>
                                                <i class="fa fa-star "></i>
                                                <i class="fa fa-star "></i>
                                                <i class="fa fa-star "></i>  0.0
                                                @endif

                                                <small class="text-grey">(0 reviews)</small>
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                         <hr>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="show_booking_text"></div>
                                            <small class="text-grey">Time is purely based on your current region i.e. {{Auth::User()->region}} </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-text col-md-6 d-block">
                            <input type="text" class="form-control " hidden name="tutor_id" id="tutor_id"
                               >
                        </div>
                    </div>
                    <!-- <div class="row mt-3"> -->
                        <!-- <div class="col-md-4"> -->
                            <!-- <label for=""><b> Class Date </b></label> -->
                            <!-- <input type="date" class="form-control" name="date"  onfocus="(this.type='date')" placeholder="Class Date" required> -->
                            <!-- <input type="date" class="form-control" onchange="getDate(this.value)" id="get_date" name="date"   placeholder="Class Date" required> -->
                        
                            <!-- <input id="classDate" class="form-control"  name="date"  placeholder="Class Date"> -->
                        <!-- </div> -->
                        <!--<div class=" col-md-4">
                            <label for=""><b> Class Duration </b></label>
                            <select name="duration" onchange="showTimeSlot(this.value)" class="form-control form-select" id="">
                                <option value="">Select Duration of slot</option>    
                                <option value="1">1 Hour</option>
                                <option value="2">2 Hour</option>
                                <option value="3">3 Hour</option>
                                <option value="4">4 Hour</option>
                                <option value="5">5 Hour</option>
                            </select>
                              <input type="number" min="1" max="24" class="form-control" name="duration" placeholder="Class Duration (in hours)" required>  
                        </div>-->
                        <!-- <div class=" col-md-4">
                            <label for=""><b> Class Time </b></label> -->
                            <!-- <input type="" class="form-control" name="time" onfocus="(this.type='time')"  placeholder="Class Time" required> -->
                            <!-- <input type="time" class="form-control" name="time" form-select placeholder="Class Time" required disabled> -->
                            <!-- <select name="time" id="booking_time" class="form-control create_booking_time form-select" required > </select>
                        </div>

                    </div> -->
                    <div class="row mt-3">
                        <div class="input-text col-md-12">
                            <input type="text"class="form-control " name="question"
                                placeholder="What is the Question?" value="" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="input-text col-md-12 ">
                            <textarea name="brief" id="brief" cols="30" rows="5" class="form-control" placeholder="Write brief about your question" required></textarea>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="" class="col-md-12 pl-0"><b>Upload any attachment if you want</b></label>
                            <input type="file" class="form-control dropify" name="upload" id="" >
                        </div>
                    </div>
                   
                    <div class="row mt-3">
                        <div class="col-12" >

                            <button id="finish" type="submit"class="btn-general pull-right  mb-3">  Send Request </button>
                            <button type="button" role="button" type="button" id="proBtn" disabled class="btn btn-primary pull-right mb-3 mr-2" style="width:140px; display:none">
                                <i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw"></i> <span class="sr-only">Loading...</span> Processing </button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    <div class="modal " id="paymentModal" tabindex="-1"
        role="dialog" aria-labelledby="paymentModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-body ml-3 mr-3">
                    <div class="text-center pt-4 pb-3">
                        <img src="{{asset ('assets/images/ico/payment-dollar.png')}}"
                            style="width: 70px;">
                        <p
                            style=" font-size: 24px;color: #00132D;font-family: Poppins;font-weight: 600;margin-top: 10px;">
                            Payment</p>
                        <p style="font-size: 15px;color: #00132D;font-family: Poppins;font-weight: 400;line-height: 1.4;"
                            class="ml-5 mr-5">
                            Please add a payment account before
                            requesting a payout.
                    </div>
                    <div class="mt-2">
                        <select class="form-select">
                            <option selected>Select Payment Method</option>
                            <option value="1">Language</option>
                            <option value="2" >English</option>
                            <option value="3">Urdu</option>
                            <option value="4">English</option>

                        </select>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <input type="number"
                                    placeholder="Card number"  class="form-control">
                            </div>

                            <div class="col-md-12 mt-3">
                                <input type="text"
                                    placeholder="Card holder name"  class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <input type="text" placeholder="Exp. month"  class="form-control">
                            </div>

                            <div class="col-md-6">
                                <input type="" placeholder="Exp. year"  class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12 -m-0 p-0 mt-3">
                            <input type="number" placeholder="CVS number"  class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                        class="schedule-btn mr-3 w-25 mb-3"
                        data-dismiss="modal">Done</button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var data = {!! json_encode($op_booking) !!};
    console.log(data)
    if(data != null && data != "") {
        // var parse_date = new Date(parseInt(array.slug));
        var converted_date = moment(data.date).format('YYYY-MM-DD');

        let create_date = moment(data.date).format('DD MMMM');

        var time = data.slot;
        
        var new_date_time = new Date(converted_date + ' ' + time);
        var start = moment(new_date_time).format("hh:mm a");

        var class_end_time = moment(new_date_time).add(1, 'hours').format("hh:mm a");
        
        $('.show_booking_text').text("Selected slot is on " + create_date + ", from " + start + " to " + class_end_time);

        $("#current_date").val(converted_date);
        $("#class_time").val(time);
        $("#class_end_time").val(class_end_time);
        $("#_id").val(data.uuid);
        $('#tutor_id').val(data.tutor_id)

    }else{
        $('.show_booking_text').text("");
    }

    var timezone_offset_minutes = new Date().getTimezoneOffset();
    timezone_offset_minutes = timezone_offset_minutes == 0 ? 0 : -timezone_offset_minutes;

    // Timezone difference in minutes such as 330 or -360 or 0
    console.log(timezone_offset_minutes , "timezone_offset_minutes"); 
    $("#offset").val(timezone_offset_minutes);
</script>
@include('js_files.student.bookingJs')
@endsection
