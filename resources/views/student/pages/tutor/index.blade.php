@extends('student.layouts.app')
<link href="{{ asset('assets/css/registration.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/booknow.css') }}" rel="stylesheet">
@section('content')
<style>
    .mt-20{
        margin-top:20px;
    }
    .slotSet{
        color: #1173FF;
    text-align: center;
    border: 1px solid;
    border-color: #1173FF;
    border-radius: 21px;
    padding: 2px 1px 5px;
    margin-top: 15px;
    cursor:pointer;
    }
    .slotSet img{
        width:15px;
    }
    .slotSet .clockWhite{
        display:none;
    }
    .slotSet:hover .clockWhite{
        display:inline-flex;
    }
    .slotSet:hover .clockBlue{
        display:none ;
    }
    .slotSet:hover{
        background:#1173FF;
        color:#fff;
    }
    .activeSlot{
        background:#1173FF;
        color:#fff;
    }
    .activeSlot:hover{
       border-color:#fff;
    }
    .activeSlot .clockWhite{
        display:inline-flex !important;
    }
    .activeSlot .clockBlue{
        display:none !important;
    }
    .slotLine{
        margin-top: 1rem;
        margin-bottom: 1rem;
        border: 0;
        border-top: 1px solid #1173FF;
    }
    input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        background-color: #051731;
       border-radius: 50%;
        width: 14px;
        height: 14px;
    }
    input[type=range] {
    -webkit-appearance: none;
    background-color: #1173FF;
    width: 100px;
        height: 10px !important;
        padding:0;
        border-radius:9px;
    }
    .rating-stars ul > li{
    cursor: pointer;
}
.rating-stars ul > li.star.selected > i.fa {
  color:#FF912C;
}
.bigStar {
    font-size: x-large;
}

.f-40{
    font-size:40px;
}
.tutorAbout{
    line-height: 1.4;
    /* font-weight: 500; */
    /* font-size: 12px; */
    color: grey;
}
.vid23{
    max-height:240px;
}
.fav{
    z-index:999;
}
.scrolly{
    height:700px;
    overflow-y:auto;
}
.scrolly::-webkit-scrollbar{
    display:none;
}
</style>
 <!-- top Fixed navbar End -->
 <div class="content-wrapper " style="overflow: hidden;">
    <section id="findTutorsection" style="display: flex;">

        <div class="container-fluid m-0 p-0">
            <p class="heading-first ml-3 mr-3">Find a Tutor</p>
         
                    <div class="row ml-2 mr-2">
                        <div class="card filter">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2 pr-0">
                                        <label for="">Subject</label>
                                        <select class="w-100 form-control accSelect2" id="subjects-list">
                                            <option value="">Search Subject</option>
                                            @foreach ($subjects as $subject)
                                            <option value="{{$subject->id}}"> {{$subject->name}}</option>
                                            @endforeach
                                        </select>
                                        
                                    </div>
                                    <div class="col-md-2 pr-0">
                                        <label for="">Location</label>
                                        <select class="w-100 form-control accSelect2" id="location">
                                            <option value="">Any Location</option>
                                            @foreach ($locations as $location)
                                            <option value="{{$location->name}}"> {{$location->name}}</option>
                                            @endforeach
                                        </select>
                                        
                                    </div>
                                    <div class="col-md-2">
                                        <label for="">Price</label>
                                        <!-- <select class="w-100 form-control accSelect2" id="range" name="my_range">
                                            <option value="">Any hourly rate</option>
                                            <option value="$10">$10 & below</option>
                                            <option value="$30">$10 - $30</option>
                                            <option value="$60">$30 - $60</option>
                                            <option value="$100">$60 & above</option>
                                        </select> -->
                                        <div class="row">
                                            <div class="col-md-6 pr-0">
                                                <input type="number" placeholder="min" class="form-control pr-2 pl-2">
                                            </div>
                                            <div class="col-md-6 pr-0">
                                             <input type="number" placeholder="max" class="form-control pr-2 pl-2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 pr-0">
                                        <label for="">Availability</label>
                                        <select class="w-100 form-control accSelect2" id="gender" name="gender">
                                            <option value="">Any</option>
                                            <option value="">Online</option>
                                            <option value="">Offline</option>
                                        </select>
                                        
                                    </div>
                                    <div class="col-md-2">
                                        <label for="" class="mb-1 no-opacity">Availability</label>
                                        <p class="mb-0">
                                            <a href="#">
                                                <i class="fa fa-sliders"></i> Advance Search
                                            </a>
                                        </p>
                                        <p class="mb-0">
                                            <a href="#">
                                                <i class="fa fa-refresh" aria-hidden="true"></i> Reset Search
                                            </a>
                                        </p>
                                        
                                    </div>
                                    <div class="col-md-2 ">
                                        <label for=""> <i class="fa fa-sort-amount-asc" aria-hidden="true"></i> Sort</label>
                                        <select class="w-100 form-control accSelect2" id="sort">
                                            <option value="">Sort by Availability</option>
                                            <option value="">Sort by Date</option>
                                            <option value="">Sort by Price</option>
                                            <option value="">Sort by Gender</option>
                                        </select>
                                    </div>
                                    <!-- <div class="col-md-2">
                                        <label for="">Gender</label>
                                        <select class="w-100 form-control accSelect2" id="gender" name="gender">
                                            <option value="">Any</option>
                                            <option value="">Male</option>
                                            <option value="">Female</option>
                                        </select>
                                        
                                    </div>
                                    <div class="col-md-2">
                                        <label for="">Language</label>
                                        <select class="w-100 form-control accSelect2" id="languages-list">
                                        </select>
                                    </div> -->

                                </div>
                            </div>
                        </div>
                    </div>
            <div class="row ml-2 mr-2 scrolly">
                <div class="col-md-12 " >
                    <div class="row">
                        
                        <div class="col-md-12" id="number-booking">
                            <h3  class="mb-0  mt-4">  {{ sizeof($available_tutors) }}  Tutors Available</h3>
                        </div>
                       
                        
                        <div class="col-md-12" id="tutors-list">
                            @if(sizeof($available_tutors) == 0 || $available_tutors == '[]' )
                                <div class="card">
                                    <div class="card-body text-center">
                                        <img src="{{asset('assets/images/ico/no-tutor.svg')}}" alt="" width="200">
                                        <h1 class="">No Tutor Found For Your Search</h1>
                                        <h3 class="">Try a new search for your subject from</h3>
                                            <h3>  our community of tutors.</h3>
                                    </div>
                                </div>
                            @else
                                @foreach ($available_tutors as $tutor)
                                   

                                            <div class="row">
                                               
                                                <div class="col-md-12 pl-0">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-2 pr-0">
                                                                    <div class="topImage">
                                                                            @if($tutor->rank == 1)
                                                                                <p class="mb-0 pt-1 pb-1 text-center bg-success"> <span class="text-white bold ">New</span></p>
                                                                            @elseif($tutor->rank == 2)
                                                                                <p class="mb-0 pt-1 pb-1 text-center bg-success">  <span class="text-white bold ">Emerging</span></p>
                                                                            @elseif($tutor->rank == 3)
                                                                                <p class="mb-0 pt-1 pb-1 text-center bg-success">  <span class="text-white bold ">Top Rank</span></p>
                                                                                @else
                                                                                <p class="mb-0 pt-1 pb-1 text-center bg-success"> <span class="text-white bold ">No Badge Yet</span></p>
                                                                            @endif
                                                                    </div>
                                                                    <div class="imgPart">
                                                                        <img src="{{asset($tutor->picture)}}" class="w-100" alt="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="row">

                                                                                <!-- <div class="col-md-2 col-6 pr-0 div-center">
                                                                                    <a href="{{route('student.tutor.show',[$tutor->id])}}">
                                                                                        @if($tutor->picture != null)
                                                                                            <?php
                                                                                                $path = $tutor->picture;
                                                                                            ?>
                                                                                            @if(file_exists( public_path($path) ))
                                                                                                <img src="{{asset($tutor->picture)}}" alt="" class="profile-img " style="height:70px; width:70px;">
                                                                                            @else
                                                                                                <img src="{{asset ('assets/images/ico/Square-white.jpg')}}" alt="" class="profile-img " style="height:70px; width:70px;">   
                                                                                            @endif
                                                                                        @else
                                                                                            <img src="{{asset ('assets/images/ico/Square-white.jpg')}}" alt="" class="profile-img " style="height:70px; width:70px;">
                                                                                        @endif
                                                                                    </a>

                                                                                </div> -->
                                                                                <div class="col-md-6 col-6  pr-0">
                                                                                    <a href="{{route('student.tutor.show',[$tutor->id])}}" class="decoration-none"><h3 class="mb-0">{{$tutor->first_name}} {{$tutor->last_name}}</h3></a>
                                                                                    <!-- <p class="mb-0"><img src="../assets/images/ico/red-icon.png" alt="" class="">  {{$tutor->designation ?? '---'}}</p> -->
                                                                                    <p class="mb-0"><img src="../assets/images/ico/location-pro.png" alt="" class="">{{ $tutor->city != NULL ? $tutor->city.' , ' : '---' }} {{ $tutor->country != NULL ? $tutor->country: '---' }}</p>
                                                                                </div>
                                                                                <div class="col-md-6 col-12 text-right">
                                                                                    <p class="mb-0">
                                                                                        @if($tutor->rating == 1)
                                                                                        <i class="fa fa-star text-yellow"></i>
                                                                                        <i class="fa fa-star "></i>
                                                                                        <i class="fa fa-star "></i>
                                                                                        <i class="fa fa-star "></i>
                                                                                        <i class="fa fa-star "></i> 1.0
                                                                                        @elseif($tutor->rating == 2)
                                                                                        <i class="fa fa-star text-yellow"></i>
                                                                                        <i class="fa fa-star text-yellow"></i>
                                                                                        <i class="fa fa-star "></i>
                                                                                        <i class="fa fa-star "></i>
                                                                                        <i class="fa fa-star "></i>  2.0
                                                                                        @elseif($tutor->rating == 3)
                                                                                        <i class="fa fa-star text-yellow"></i>
                                                                                        <i class="fa fa-star text-yellow"></i>
                                                                                        <i class="fa fa-star text-yellow"></i>
                                                                                        <i class="fa fa-star "></i>
                                                                                        <i class="fa fa-star "></i>  3.0
                                                                                        @elseif($tutor->rating == 4)
                                                                                        <i class="fa fa-star text-yellow"></i>
                                                                                        <i class="fa fa-star text-yellow"></i>
                                                                                        <i class="fa fa-star text-yellow"></i>
                                                                                        <i class="fa fa-star text-yellow"></i>
                                                                                        <i class="fa fa-star "></i>4.0
                                                                                        @elseif($tutor->rating == 5)
                                                                                        <i class="fa fa-star text-yellow"></i>
                                                                                        <i class="fa fa-star text-yellow"></i>
                                                                                        <i class="fa fa-star text-yellow"></i>
                                                                                        <i class="fa fa-star text-yellow"></i>
                                                                                        <i class="fa fa-star text-yellow"></i>  5.0
                                                                                        @else
                                                                                        <i class="fa fa-star "></i>
                                                                                        <i class="fa fa-star "></i>
                                                                                        <i class="fa fa-star "></i>
                                                                                        <i class="fa fa-star "></i>
                                                                                        <i class="fa fa-star "></i>  0.0
                                                                                        @endif

                                                                                        <small class="text-grey">(0 reviews)</small>
                                                                                    </p>
                                                                                    <!-- <p class="mb-0">
                                                                                        <small>
                                                                                            3 hours tutoring in (this subject)
                                                                                        </small>
                                                                                    </p> -->
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-3">
                                                                        <div class="col-md-4">
                                                                            @php

                                                                                $sub = explode(',',$tutor->subject_names);
                                                                                $ter = sizeof($sub);

                                                                            @endphp
                                                                            <p class="mb-1">Subject</p>
                                                                            <p class="mb-1">
                                                                                @for ($i=0 ; $i < 1; $i++)
                                                                                    <span class="info-1 info">{{$sub[$i]}}</span>

                                                                                    @if($ter > 1)
                                                                                    <small>
                                                                                        <a href="#" class="text-dark decoration-none">
                                                                                            @php
                                                                                                    $one = 1;
                                                                                                    $check = $ter - $one;
                                                                                            @endphp
                                                                                            +{{$check}} Others
                                                                                        </a>
                                                                                    </small>
                                                                                    @endif
                                                                                @endfor
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <p class="mb-1">Languages</p>
                                                                            <p class="mb-1">
                                                                                <span class="info-1 info lingo">{{$tutor->lang_short ?? ''}}</span>
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <p class="mb-1">Education</p>
                                                                            @php
                                                                                $inst = explode(',',$tutor->insti_names);
                                                                            @endphp
                                                                            <p class="mb-1">
                                                                            @for ($i=0 ; $i < sizeof($inst); $i++)
                                                                                <span class="info-1 info edu">{{$inst[$i]}}</span>
                                                                            @endfor
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-1">
                                                                        <div class="col-md-12 find_tutor">
                                                                            <p class="mb-0"><strong> About Tutor </strong></p>
                                                                            <p class="mb-0 tutorAbout">
                                                                                {{Str::limit($tutor->bio, 240, $end='')}}
                                                                                @if(strlen($tutor->bio) > 240)
                                                                                    <a href="{{route('student.tutor.show',[$tutor->id])}}">Read more...</a>
                                                                                @endif

                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2 bg-price text-center">
                                                                    <div class="row mt-2">
                                                                        @if($tutor->is_favourite != null && $tutor->is_favourite != "")
                                                                            <a type="button" onclick="favourite_tutor({{$tutor->id}},'un_fav')" class="fav" title="Favourite">
                                                                                <i class="fa fa-star text-yellow" id="favorite_start_{{$tutor->id}}"></i>
                                                                            </a>
                                                                        @else
                                                                            <a type="button" onclick="favourite_tutor({{$tutor->id}},'fav')" class="fav" title="Favourite">
                                                                                <i class="fa fa-star" id="favorite_start_{{$tutor->id}}"></i>
                                                                            </a>
                                                                        @endif
                                                                        <div class="col-md-12 mb-1">
                                                                        
                                                                            <p class="mb-1 mt-2">starting from</p>
                                                                            <h1 class="f-40 mb-1">${{$tutor->hourly_rate != null ? $tutor->hourly_rate : 0}}</h1>
                                                                            <p class="mb-1">per hour</p>
                                                                        
                                                                            <button type="button" class=" cencel-btn w-100" onclick="chat({{$tutor->id}})">
                                                                                    &nbsp; Message &nbsp;
                                                                            </button>
                                                                        
                                                                            <button type="button" onclick="checkBookingSlots({{$tutor->id}})" class=" btn-general w-100 mt-2" >
                                                                                    &nbsp; Book Class &nbsp;
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <video loop autoplay muted controls class="vid23 w-100 h-100">
                                                                        <source src="{{asset('storage/profile/loki2.mp4')}}" type="video/mp4">
                                                                    </video>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                               
                                            
                                            </div>

                                @endforeach
                            @endif
                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="tutorModal" tabindex="-1" role="dialog"
    aria-labelledby="tutorModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
            </div>
            <form id="chat_form" >
                <div class="modal-body h-auto  card-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <img  src="{{asset('assets/images/tutor.png')}}" />
                        </div>
                        <div class="col-md-12 text-center mt-3">
                            <h3> Send Message </h3>
                            <p>Type your queries here to let the tutor know what's the main reason of your contact</p>
                        </div>
                        <div class="col-md-12  mt-2">
                            <textarea name="msg" class="form-control" id="msg" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer ">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="cencel-btn" data-dismiss="modal">
                                Cancel Message
                            </button>
                            <button class="schedule-btn " type="submit">
                                Send Message
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalSlot" tabindex="-1" role="dialog"
    aria-labelledby="tutorModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="bookingSlotForm" class="mb-0" method = 'POST' action = "{{route('student.book-slot')}}">
                @csrf
                <input type="hidden" name="tutor_id" id="tutor_id">
                <input type="hidden" name="time" id="booking_time">
                <input type="hidden" name="day" id="booking_day">

                <div class="modal-body h-auto  card-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <img  src="{{asset('assets/images//ico/icon1.png')}}" />
                        </div>
                        <div class="col-md-12 text-center mt-3">
                            <h3> Book a Class </h3>
                            <p> Select a date and respective slot to make a booking request </p>
                        </div>
                        <div class="col-md-4 text-center mt-2">
                            <label for=""> Select Date </label>
                        </div>
                        <div class="col-md-8 ">
                            <input type="date" class="form-control" onchange="getDate(this.value)" id="get_date" name="date"   placeholder="Class Date" required>
                        </div>
                        <div class="col-md-6">
                            <hr class="slotLine">
                        </div>
                        <div class="col-md-12">
                            <h3 id="show_response" class="show_response">Available Slots</h3>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="row show_all_slots" id="show_all_slots">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer ">
                    <div class="row">
                        <div class="col-md-6">
                            <small>Your current time zone region is {{Auth::User()->region}}</small>
                        </div>
                        <div class="col-md-6 text-right">
                            <button class="schedule-btn" id="request_booking_btn" disabled> Confirm Booking </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection


@section('scripts')
@include('js_files.student.tutorJs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

    $('#stars-ul li').on('click', function(){
     
        var onStar = parseInt($(this).data('value'), 10);
        var stars = $(this).parent().children('li.star');
    
        for (i = 0; i < stars.length; i++) {
            $(stars[i]).removeClass('selected');
        }
        
        for (i = 0; i < onStar; i++) {
            $(stars[i]).addClass('selected');
        }
        
        var ratingValue = parseInt($('#stars-ul li.selected').last().data('value'), 10);
        $("#star_rating").val(ratingValue);
        
    });
</script>
@endsection
