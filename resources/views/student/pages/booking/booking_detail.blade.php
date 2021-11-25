@extends('student.layouts.app')
<link href="{{ asset('assets/css/registration.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/booknow.css') }}" rel="stylesheet">

@section('content')
 <!-- top Fixed navbar End -->
 <div class="content-wrapper " style="overflow: hidden;">
    <section id="bookingDetailSection" style="display: flex;">
        <div class="container-fluid m-0 p-0">
            <a class="" href="">
                <div class="row">
                    <div class="col-md-12">
                        <!-- <p id="sidenav-toggles" class="heading-first  mr-3 mb-2 ml-2">
                            Bookings
                        </p> -->
                        <p class="heading-first ml-3 mr-3">Booking Details</p>
                    </div>
                </div>






            </a>
            @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show bg-danger" role="alert">
                    <strong>Error!</strong> {{Session::get('error')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>

            @endif

            <div class="container-fluid">


            @php

                $tz = get_local_time();
                $dt = new DateTime($booking->class_time, new DateTimeZone($tz)); //first argument "must" be a string
                $time = $dt->format('g:i a');
            @endphp
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-white pb-0"
                                style="border-bottom: 1px solid #D6DBE2; display: inline-flex;">
                                <p class="col-md-8 col-xs-12 class-ch"
                                    style="margin-top: 10px; text-align: left;color: #00132D;font-size: 22px;font-family: Poppins;font-weight: 500;">
                                    {{$booking->subject->name}} Class

                                    @if($booking->status == 0)
                                        <span style="display:inline-flex ;" class="bg-color-apporve2"> Pending</span>
                                    @elseif($booking->status == 1)
                                        <span style="display:inline-flex ;" class="bg-color-apporve3"> Payment Pending</span>
                                    @elseif($booking->status == 2)
                                        <span style="display:inline-flex ;" class="bg-color-apporve1"> Approved</span>
                                    @elseif($booking->status == 3)
                                        <span style="display:inline-flex ;" class="bg-color-apporve"> Cancelled by Tutor</span>
                                    @elseif($booking->status == 4)
                                        <span style="display:inline-flex ;" class="bg-color-apporve"> Cancelled by Student</span>
                                    @elseif($booking->status == 5)
                                        <span style="display:inline-flex ;" class="bg-color-apporve1"> Delivered</span>
                                    @elseif($booking->status == 6)
                                        <span style="display:inline-flex ;" class="bg-color-apporve"> Cancelled by System</span>
                                    @endif

                                </p>
                                <p style="text-align: right;" class="col-md-4 col-xs-12 class-btn-center">
                                    @if ($booking->status != 3 && $booking->status != 4 && $booking->status != 6 && $booking->status != 5)
                                        <button type="button" data-toggle="modal" data-target="#exampleModalCenter"
                                        class="cencel-btn mr-2" style="font-size: 12px;width: 150px;"> Cancel
                                        Booking
                                        </button>
                                    @endif
                                    @if ($booking->status == 0)
                                        <button type="button" data-toggle="modal" data-target="#exampleModalCente"
                                            class="schedule-btn mr-2" style="font-size: 12px;width: 150px;"> Re-schedule
                                            class
                                        </button>
                                    @elseif($booking->status == 2)

                                        <a  href="{{route('student.classroom')}}"
                                        class="schedule-btn no-decor"  style="font-size: 12px;width: 150px; text-align:center;padding: 15px;"> Go to Classroom
                                        </a>
                                    @elseif($booking->status == 1)

                                        <button type="button" onclick="pay_now({{$booking->id}})"
                                        class="schedule-btn" style="font-size: 12px;width: 150px;"> Pay Now
                                        </button>
                                        @endif
                                </p>
                            </div>
                            <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="row col-md-12 image1 mt-3 ">

                                                <div class="col-md-1 text-center">
                                                     @if ($booking->user->picture)
                                                        <img src="{{asset($booking->user->picture)}}" alt="profile-image"  class="profile-img" >
                                                    @else
                                                        <img src="{{asset ('assets/images/ico/Square-white.jpg')}}"  alt="profile-image" class=" profile-img" >
                                                    @endif
                                                </div>
                                                <div class="col-md-10">
                                                        <p style="color: #00132D; font-family: Poppins;font-size: 14px;font-weight: 500;"
                                                            class=" mt-1 mb-0"> {{$booking->user->full_name}} </p>
                                                        <p style="font-size: 12px;">
                                                        Student</p>
                                                </div>

                                            </div>
                                            <div class="col-md-12">
                                                <div class="text1"
                                                    style="color: #00132D;font-size: 15px;font-family: Poppins;font-weight: 500;line-height: 2;">
                                                    {{$booking->question}}
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="text2"
                                                    style="color: #00132D;font-size: 14px;font-family: Poppins;font-weight: 400;">
                                                    {{$booking->brief}}
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mt-4">
                                                    <div class="text3" style="display: flex;">
                                                        <span>
                                                            <img class="book-details" src="{{ asset('assets/images/ico/Group 4689.png') }}" alt="gros">
                                                            <span class="schedule">
                                                                Schedule Date:
                                                            </span>
                                                            <span class="time-details">
                                                                {{$booking->class_date}}
                                                            </span>
                                                        </span>
                                                        <span class="ml-3">
                                                            <img class="book-details"
                                                                src="{{ asset('assets/images/ico/Group 4689.png') }}" alt="gros">
                                                            <span class="schedule">

                                                                Schedule Time:
                                                            </span>
                                                            <span class="time-details" id="show_curr_region_time">
                                                                
                                                                </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-3">
                                                <p
                                                    style="color: #00132D;font-size: 16px;font-family: Poppins;font-weight: 500;">
                                                    Attachments</p>
                                                <div class="row">
                                                    @if($booking->attachments)
                                                        <div class="col-md-3 mt-1 mb-3">
                                                            <div class="card__corner">
                                                                <div class="card__corner-triangle"></div>
                                                            </div>
                                                            <div class="borderOne">
                                                                <span class="overlayAttach"></span>
                                                                <img src="{{ asset($booking->attachments) }}" alt="">
                                                                <!-- <span class="fileName">FileNameProplus.png</span> -->
                                                                <a href="{{asset($booking->attachments)}}" class="downFile"><i class="fa fa-download"></i></a>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="col-md-12">
                                                            <p>No attachments found</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @if($booking->is_reviewed == 1)
                                            <div class="col-md-3 bg-price ">
                                                
                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <div class="row image1 mt-3 ">

                                                            <div class="col-md-2 text-center">
                                                                @if ($booking->tutor->picture)
                                                                    <img src="{{asset($booking->tutor->picture)}}" alt="profile-image"  class="profile-img" >
                                                                @else
                                                                    <img src="{{asset ('assets/images/ico/Square-white.jpg')}}"  alt="profile-image" class=" profile-img" >
                                                                @endif
                                                            </div>
                                                            <div class="col-md-10">
                                                                    <p style="color: #00132D; font-family: Poppins;font-size: 14px;font-weight: 500;"
                                                                        class=" mt-1 mb-0"> {{$booking->tutor->first_name}} {{$booking->tutor->last_name}} </p>
                                                                    <p style="font-size: 12px;">
                                                                    {{$booking->tutor->tagline}}</p>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <h4>Reviews</h4>
                                                    </div>
                                                    
                                                    <div class="col-md-12">
                                                        <div class="star-icos">
                                                        @if($booking->rating == 1)
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star  ml-1"></span>
                                                                <span class="fa fa-star  ml-1"></span>
                                                                <span class="fa fa-star  ml-1"></span>
                                                                <span class="fa fa-star  ml-1"></span>
                                                            @elseif($booking->rating == 2)
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked  ml-1"></span>
                                                                <span class="fa fa-star  ml-1"></span>
                                                                <span class="fa fa-star  ml-1"></span>
                                                                <span class="fa fa-star  ml-1"></span>
                                                            @elseif($booking->rating == 3)
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked  ml-1"></span>
                                                                <span class="fa fa-star checked ml-1"></span>
                                                                <span class="fa fa-star  ml-1"></span>
                                                                <span class="fa fa-star  ml-1"></span>
                                                            @elseif($booking->rating == 4)
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked  ml-1"></span>
                                                                <span class="fa fa-star checked ml-1"></span>
                                                                <span class="fa fa-star checked ml-1"></span>
                                                                <span class="fa fa-star  ml-1"></span>
                                                            @elseif($booking->rating == 5)
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked  ml-1"></span>
                                                                <span class="fa fa-star checked ml-1"></span>
                                                                <span class="fa fa-star checked ml-1"></span>
                                                                <span class="fa fa-star checked ml-1"></span>
                                                            @endif
                                                        </div>
                                                    
                                                    </div>

                                                    <div class="col-md-12">
                                                        <p>
                                                        {{$booking->student_review}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-md-3"></div>
                                        @endif
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       <!-- no bookings -->
            <!-- Modal -->
            <div class="modal " id="exampleModalCente" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content pt-4 pb-4">
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="iconss" style="text-align: center;">
                                            <img src="{{asset('assets/images/ico/watchs.png')}}" width="60px">
                                            <p
                                                style="font-size: 24px;color: #00132D;font-family: Poppins;font-weight: 500;margin-top: 10px;">
                                                Re-schedule class</p>
                                            <p style="font-size: 15px;color: #00132D;font-family: Poppins;font-weight: 400;"
                                                class="ml-4 mr-4">
                                                Send new time for class with a short note about why are you rescheduling
                                                class
                                            </p>
                                        </div>
                                        <div class="ml-4 mr-4">
                                            <form id ="res-task">
                                                @csrf
                                                <div style="display: flex;">
                                                <input type="hidden" value="{{$booking->id}}" name="loId">
                                                    <input id="today2" name="date" class="inputtype mb-2" style="width: 170px;"
                                                        type="date">
                                                    <input type="time" name="time" class="inputtype ml-5 mb-2" class="times"
                                                        style="width: 170px;" value="13:00" step="900">
                                                </div>
                                                <textarea class="form-control mt-3" name="note" rows="6" cols="50"
                                                    placeholder="Write reason"></textarea>


                                            <div class="text-right mt-3">
                                                <input type="submit" class="schedule-btn"
                                                                 style="width: 130px" value="Send">
                                            </div>

                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- schulde class modal -->
            <div class="modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content pb-3">
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 pt-4">
                                        <div class="iconss" style="text-align: center;">
                                            <img src="{{asset('assets/images/ico/cross.png')}}" alt="cross" class="mb-2" width="80px">
                                            <p
                                                style=" font-size: 24px;color: #00132D;font-family: Poppins;font-weight: 600;margin-top: 10px;">
                                                Cancel Booking</p>
                                            <p style="font-size: 15px;color: #00132D;font-family: Poppins;font-weight: 400;line-height: 1.4;"
                                                class="ml-5 mr-5">
                                                @if($booking->status == 2)
                                                    Are you sure you want to cancel booking ? it will cost
                                                    ${{$booking->service_fee ?? 0}} for cancelling</p>
                                                @elseif ($booking->status == 0 || $booking->status == 1)
                                                    Are you sure you want to cancel booking ?
                                                @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="text-align: center;" class="mt-2 mb-2">
                                <form id="cancel-task">
                                    @csrf
                                    <input type="hidden" name="idid" value={{$booking->id}}" >
                                    <button type="submit" class="cencel-btn" style="width: 130px;">Yes, Cancel</button>
                                    &nbsp;&nbsp;
                                    <button type="button" class="schedule-btn" data-dismiss="modal"
                                        style="width: 130px;">No</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
              <!--Pay Now Class Modal -->
        <div class="modal " id="payModel" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content pt-4 pb-4">
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                        <div class="col-md-12">
                                            <div class="iconss" style="text-align: center;">

                                                <img src="{{asset ('admin/assets/img/ico/doollarss.png')}}" width="60px">
                                                <p
                                                    style="font-size: 24px;color: #00132D;font-family: Poppins;font-weight: 500;margin-top: 10px;">
                                                    Payment Details</p>
                                                <!-- <p style="font-size: 15px;color: #00132D;font-family: Poppins;font-weight: 400;"
                                                    class="ml-4 mr-4">
                                                    Send approved time for class.
                                                </p> -->
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h3>Class Details</h3>
                                        </div>
                                        <div class="col-md-6 col-6 col-sm-6 ">
                                            <p class="mb-0">Schedule Date: </p>
                                        </div>
                                        <div class="col-md-6 col-6 col-sm-6 text-right" >
                                            <strong id="scdule_date"></strong>
                                        </div>
                                        <div class="col-md-6 col-6 col-sm-6">
                                            <p class="mb-0">Schedule Time: </p>
                                        </div>
                                        <div class="col-md-6 col-6 col-sm-6 text-right" >
                                            <strong id="class_time"></strong>
                                        </div>
                                        <div class="col-md-6 col-6 col-sm-6">
                                             <p class="">Schedule Duration: </p>
                                        </div>
                                        <div class="col-md-6 col-6 col-sm-6 text-right" >
                                            <strong id="duration"></strong>
                                        </div>
                                        <div class="col-md-12">
                                            <h3>Payment Details</h3>
                                         </div>

                                        <div class="col-md-6 col-6 col-sm-6">
                                            <p class="mb-0">Tutor Fee: </p>
                                        </div>

                                        <div class="col-md-6 col-6 col-sm-6 text-right" >
                                            <strong id="price"></strong>
                                        </div>

                                        <div class="col-md-6 col-6 col-sm-6">
                                            <p class="mb-0">Service Fee: <span id="total_commision"></span>
                                            </p>
                                        </div>
                                        <div class="col-md-6 col-6 col-sm-6 text-right">
                                            <strong id="commission"></strong>
                                        </div>
                                        <div class="col-md-6 col-6 col-sm-6">
                                            <p class="mb-0">Total Fee: </p>
                                        </div>
                                        <div class="col-md-6 col-6 col-sm-6 text-right">
                                            <strong id="total_price"></strong>
                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>
                                        <div class="col-md-12">
                                            <h3>Payment Method</h3>
                                         </div>
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="text-center">
                                                        <img src="{{asset ('assets/images/payment-icon/paypal2.png')}}" class="w-50" alt="">
                                                        <span class="round">
                                                            <input type="radio" id="checkbox1" name="paymentRadio" checked />
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="text-center">
                                                        <img src="{{asset ('assets/images/payment-icon/skrill.png')}}" class="w-50" alt="">
                                                        <span class="round">
                                                            <input type="radio" id="checkbox2" name="paymentRadio" />

                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-12 text-right mt-3" id="show_pay_btn">
                                        </div> -->
                                        <div class="col-md-9"></div>
                                        <div class="col-md-3 text-right mt-3" id="show_pay_btn">
                                            <form action="{{url('/student/booking/payment')}}" id="payment" method="post" target="_blank">
                                                @csrf
                                                <div id="paytype"></div>
                                                <span></span>
                                            </form>
                                        </div>

                            </div>
                        </div>
                        <div class="mt-4 mb-2" style="text-align: right;">

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
</div>
@endsection

@section('scripts')
    @include('js_files.student.bookingJs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
        var time_zone = new Date().toLocaleString('en-US', { timeZone: "{{Auth::user()->time_zone}}" });
        let booking_time = "{{$booking->class_time}}";
        let curr_date = moment(time_zone).format('YYYY-MM-DD');
        let create_date = curr_date + ' ' + booking_time;
        let converted_time = moment(create_date).format('LT') ;
        $("#show_curr_region_time").text(converted_time);
    </script>
@endsection
