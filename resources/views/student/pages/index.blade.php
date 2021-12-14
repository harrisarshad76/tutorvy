@extends('student.layouts.app')

@section('content')
<style>
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
    .slotSet:hover .clockBLue{
        display:none;
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
    .activeSlot .clockBLue{
        display:none !important;
    }
    .slotLine{
        margin-top: 1rem;
        margin-bottom: 1rem;
        border: 0;
        border-top: 1px solid #1173FF;
    }
    .f-40{
    font-size:40px;
}
.tutorAbout{
    line-height: 1.4;
    font-weight: 500;
    font-size: 12px;
    color: grey;
}
.vid23{
    max-height:240px;
}
.fav{
    z-index:999;
}
</style>
  <!-- top Fixed navbar End -->
  <div class="content-wrapper " style="overflow: hidden;">
  <input type="hidden" id="timeZone" value="{{Auth::user()->time_zone}}">
    <section id="homesection" >
        <!-- dashborad home -->
        <div class="container-fluid m-0 p-0">

            <div class="row ">
                <div class="col-md-12">
                    <p class="heading-first ml-3 mr-3">Dashboard    </p>

                </div>
            </div>
            <div class="row ml-2 mr-2">
                <div class="col-md-8">
                    <div class="row infoCard">
                        <div class="col-md-12 mb-3 ">
                            <div class=" card mt-0 bg-toast ">
                                <div class="card-body row">
                                    <div class="col-md-1 text-center">
                                        <i class="fa fa-info" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-md-11 pl-0">
                                        <small>
                                            Dashboard have all the stats of your need including class details, upcoming classes, earning stats <a href="#">Learn More</a>
                                        </small>
                                        <a href="#" class="cross"  onclick="hideCard()"> 
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </a>
                                       <p><a class="btn start-tour" href="#">Start Tour</a></p>

                                        <!-- <span class="custom-element" data-target="el-1">Element 1 </span>   
                                        <span class="custom-element" data-target="el-2">Element 2 </span>   
                                        <span class="custom-element" data-target="el-3">Element 3 </span> -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($user->profile_completed == 0)

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="card mt-0">
                                    <div class="card-body">
                                        
                                        <p class="mb-2 ">Profile Strength: <strong class="text-success">
                                            @php 
                                                $default = 10;
                                                $default = Auth::user()->profile_completed == 1 ? ($default + 40) :  $default;
                                                $default = Auth::user()->picture != null ? ($default + 20) : $default;
                                                $default = $education_profile > 0 ? ($default + 30) : $default;
                                                echo $default .'%';
                                            @endphp         
                                        </strong>
                                        <small class="pull-right"><a href="{{route('student.profile')}}"> View Profile </a></small>
                                    </p>
                                        <div class="progress">
                                            <div class="bg-dead bg-levelTwo" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                            <div class="bg-dead {{$default >= 30  ? 'bg-levelThree' : ''}} ml-1" role="progressbar" style="width: 15%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                            <div class="bg-dead {{$default >= 30  ? 'bg-levelThree' : ''}} ml-1" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                            <div class="bg-dead {{$default >= 60 ? 'bg-levelFour' : '' }} ml-1" role="progressbar" style="width: 15%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                            <div class="bg-dead {{$default >= 80 ? 'bg-levelFive' : ''}} ml-1" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                            <div class="bg-dead {{$default > 90 ? 'bg-levelFive' : ''}} ml-1" role="progressbar" style="width: 20%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <p class="text-mute mt-1 mb-0"> <i class="fa fa-check text-success"></i> Tutors with complete profile tends to have more students than the other tutors.</p>
                                        <p class="text-mute mb-0"> <i class="fa fa-check text-success"></i> Tutors with complete profile get verified sooner than others.</p>
                                        <p class="text-mute mb-0"> <i class="fa fa-check text-success"></i> Complete profile helps a tutor to earn more.</p>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    @endif
                    @if($user->profile_completed == 1) 
                        <div class="bg-homeimage2 ">
                            <div class="row">
                                <div class="col-md-7 text-white pl-4">
                                    <div class="text mt-5 ml-2 ">
                                        <h2 class="text-white ">
                                            We have upgraded the classroom.
                                        </h2>
                                        <p >
                                            Register yourself on Tutorvy and learn or teach anything from
                                            anywhere. 
                                        </p>
                                        <a href=""class="text-white ">
                                            Learn More
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-5  ">
                                    <div class="home-image">
                                        <img src="{{asset('assets/images/backgrounds/home.svg')}}" alt="home-image"
                                            style="width: 100%;">
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    @else
                        <div class="bg-homeimage1">
                            <div class="row">
                                <div class="col-md-7 text-white pl-4">
                                    <div class="text mt-5 ml-2">
                                        <p class="res-textup">
                                            Welcome to Tutorvy
                                        </p>
                                        <p class="res-textup1">
                                        Register yourself on Tutorvy and learn or teach anything
                                        from anywhere.
                                        </p>
                                        <a href=""class="text-white res-textup">
                                            Learn More
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-5  ">
                                    <div class="home-image">
                                        <img src="{{asset('assets/images/backgrounds/home-main.png')}}" alt="home-image"
                                            style="width: 100%;">
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    @endif

                


                    <div class="row">
                        <div class="col-md-12">
                            <p class="heading-third mt-4 mb-0">
                                Statistics
                            </p>
                        </div>
                        <div class="col-md-12 stats">
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="{{route('student.classroom')}}">
                                        <div class="container-fluid card 1">
                                            <div class="text-home">
                                                <p class="number-booking">
                                                    {{$delivered_count}}
                                                </p>
                                                <p class="class-booking mt-4">
                                                    Delivered classes
                                                </p>
                                            </div>
                                            <div class="iconside">
                                                <img class="card-ico" src="{{asset('assets/images/ico/blue-ico.png')}}"
                                                    alt="blue-ico">
                                            </div>
                                        </div>
                                    </a>
                                    
                                </div>
                                <div class="col-md-3">
                                    <a href="{{route('student.classroom')}}">
                                        <div class="container-fluid card 1">
                                            <div class="text-home">
                                                <p class="number-booking">
                                                    {{$upcoming_count}}
                                                </p>
                                                <p class="class-booking mt-4">
                                                    Upcomming class
                                                </p>
                                            </div>
                                            <div class="iconside">
                                                <img class="card-ico1" src="{{asset('assets/images/ico/red-ico.png')}}"
                                                    alt="red-ico">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{route('student.bookings')}}">
                                        <div class="container-fluid card 1">
                                            <div class="text-home">
                                                <p class="number-booking">
                                                    {{$pending_count}}
                                                </p>
                                                <p class="class-booking mt-4">
                                                    Pending Bookings
                                                </p>
                                            </div>
                                            <div class="iconside">
                                                <img class="card-ico" src="{{asset('assets/images/ico/ico-blue.png')}}"
                                                    alt="ico-blue">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{route('student.bookings')}}">
                                        <div class="container-fluid card 1">
                                            <div class="text-home">
                                                <p class="number-booking">
                                                    {{$subject_count}}
                                                </p>
                                                <p class="class-booking mt-4">
                                                    Total Subjects
                                                </p>
                                            </div>
                                            <div class="iconside">
                                                <img class="card-ico1" src="{{asset('assets/images/ico/yellow-ico.png')}}"
                                                    alt="yellow-ico">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="heading-third pt-4 mb-3">
                                        Favourite Tutors</p>
                                </div>
                                    @if($favorite_tutors != "[]")
                                        <div class="col-md-12 scrollable h-666" id="Fav_tutor">
                                            @foreach($favorite_tutors as $tutor)
                                                <!-- <div class="card">
                                                    <div class="card-body">
                                                        
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                <div class="row">
                                                                    <div class="col-md-10">
                                                                        <div class="row">
                                                                            
                                                                            <div class="col-md-2 col-6 pr-0 div-center">
                                                                                <a href="{{route('student.tutor.show',[$tutor->id])}}">
                                                                                    @if($tutor->picture != null)
                                                                                        <img src="{{asset($tutor->picture)}}" alt="" class="profile-img  " style="height:63px;width:63px;">
                                                                                    @else
                                                                                        <img src="{{asset ('assets/images/ico/Square-white.jpg')}}" alt="" class="profile-img  " style="height:63px;width:63px;">
                                                                                    @endif                                                        
                                                                                </a>
                                                                            
                                                                            </div>
                                                                            <div class="col-md-4 col-6">
                                                                                <a href="{{route('student.tutor.show',[$tutor->id])}}" class="decoration-none">
                                                                                    <h3 class="mb-0">{{$tutor->first_name}} {{$tutor->last_name}}</h3>
                                                                                </a>
                                                                                <p class="mb-0">
                                                                                    <small>
                                                                                        <img src="../assets/images/ico/red-icon.png" alt="" class="">  {{$tutor->designation ?? '---'}}
                                                                                    </small>
                                                                                </p>
                                                                                <p class="mb-0">
                                                                                    <small>
                                                                                        <img src="../assets/images/ico/location-pro.png" alt="" class="">{{ $tutor->city != NULL ? $tutor->city.' , ' : '---' }} {{ $tutor->country != NULL ? $tutor->country: '---' }}
                                                                                    </small>
                                                                                </p>
                                                                            </div>
                                                                            <div class="col-md-6 col-12">
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
                                                                                <p>
                                                                                    <small>
                                                                                         3 hours tutoring in (this subject) 
                                                                                    </small>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        @if($tutor->rank == 1)
                                                                            <p class="text-right"><span class="text-green ">New</span> <span class="rank_icon"><img src="../assets/images/ico/bluebadge.png" alt=""></span> </p>
                                                                        @elseif($tutor->rank == 2)
                                                                            <p class="text-right"><span class="text-green ">Emerging</span> <span class="rank_icon"><img src="../assets/images/ico/yellow-rank.png" alt=""></span> </p>
                                                                        @elseif($tutor->rank == 3)
                                                                            <p class="text-right"><span class="text-green ">Top Rank</span> <span class="rank_icon"><img src="../assets/images/ico/rank.png" alt=""></span> </p>
                                                                        @endif
                                                                    

                                                                    </div>
                                                                </div>
                                                                <div class="row mt-4">
                                                                    <div class="col-md-4">
                                                                        @php

                                                                            $sub = explode(',',$tutor->subject_names);
                                                                            $ter = sizeof($sub);
                                                                        @endphp
                                                                        <p class="mb-2">Subject</p>
                                                                        <p>
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
                                                                        <p class="mb-2">Languages</p>
                                                                        <p>
                                                                            <span class="info-1 info lingo">{{$tutor->lang_short ?? ''}}</span>
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                    <p class="mb-2">Education</p>
                                                                        @php
                                                                            $inst = explode(',',$tutor->insti_names);
                                                                        @endphp
                                                                        <p>
                                                                        @for ($i=0 ; $i < sizeof($inst); $i++)
                                                                        <span class="info-1 info edu">{{$inst[$i]}}</span>
                                                                        @endfor
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-2">
                                                                    <div class="col-md-12 find_tutor">
                                                                        <p><strong> About Tutor </strong></p>
                                                                        <p class="">
                                                                            {{Str::limit($tutor->bio, 100, $end='')}}
                                                                            @if(strlen($tutor->bio) > 100)
                                                                                <a href="{{route('student.tutor.show',[$tutor->id])}}">Read more...</a>
                                                                            @endif
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 bg-price text-center">
                                                                <div class="row mt-30">
                                                                    
                                                                        <a type="button" onclick="favourite_tutor({{$tutor->id}},'un_fav')" class="fav" title="Favourite">
                                                                            <i class="fa fa-star text-yellow" id="favorite_start_{{$tutor->id}}"></i>
                                                                        </a>
                                                                    <div class="col-md-12">
                                                                        
                                                                        <p>starting from</p>
                                                                        <h1 class="f-60">${{$tutor->hourly_rate}}</h1>
                                                                        <p>per hour</p>
                                                                        <button type="button" class=" cencel-btn w-100">
                                                                                &nbsp; Message &nbsp;
                                                                        </button>
                                                                        <button type="button" onclick="checkBookingSlots({{$tutor->id}})" class=" btn-general w-100 mt-2" >
                                                                                &nbsp; Book Class &nbsp;
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div> -->
                                                <div class="row">
                                               
                                                    <div class="col-md-12 pl-0">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-md-3 pr-0">
                                                                        <div class="topImage">
                                                                                @if($tutor->rank == 1)
                                                                                    <p class="mb-0 pt-1 pb-1 text-center bg-success"> <span class="rank_icon"><img src="../assets/images/ico/loki.png" alt=""></span> <span class="text-white bold ">New</span></p>
                                                                                @elseif($tutor->rank == 2)
                                                                                    <p class="mb-0 pt-1 pb-1 text-center bg-success"> <span class="rank_icon"><img src="../assets/images/ico/yellow-rank.png" alt=""></span> <span class="text-white bold ">Emerging</span></p>
                                                                                @elseif($tutor->rank == 3)
                                                                                    <p class="mb-0 pt-1 pb-1 text-center bg-success"> <span class="rank_icon"><img src="../assets/images/ico/rank.png" alt=""></span> <span class="text-white bold ">Top Rank</span></p>
                                                                                    @else
                                                                                    <p class="mb-0 pt-1 pb-1 text-center bg-success"> <span class="text-white bold ">No Badge Yet</span></p>
                                                                                @endif
                                                                        </div>
                                                                        <div class="imgPart">
                                                                                @if($tutor->picture != null)
                                                                                    <img src="{{asset($tutor->picture)}}" class="w-100" alt="">
                                                                                @else
                                                                                    <img src="{{asset ('assets/images/ico/Square-white.jpg')}}" class="w-100" alt="">
                                                                                @endif    
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="row">
                                                                                    <div class="col-md-8 col-6  pr-0">
                                                                                        <a href="{{route('student.tutor.show',[$tutor->id])}}" class="decoration-none"><h3 class="mb-0">{{$tutor->first_name}} {{$tutor->last_name}}</h3></a>
                                                                                        <!-- <p class="mb-0"><img src="../assets/images/ico/red-icon.png" alt="" class="">  {{$tutor->designation ?? '---'}}</p> -->
                                                                                        <p class="mb-0"><img src="../assets/images/ico/location-pro.png" alt="" class="">{{ $tutor->city != NULL ? $tutor->city.' , ' : '---' }} {{ $tutor->country != NULL ? $tutor->country: '---' }}</p>
                                                                                    </div>
                                                                                    <div class="col-md-4 col-12 text-right">
                                                                                        <p class="mb-0">
                                                                                            @if($tutor->rating == 1)
                                                                                            <i class="fa fa-star text-yellow"> 1.0
                                                                                            @elseif($tutor->rating == 2)
                                                                                            <i class="fa fa-star text-yellow"></i>  2.0
                                                                                            @elseif($tutor->rating == 3)
                                                                                            <i class="fa fa-star text-yellow"></i> 3.0
                                                                                            @elseif($tutor->rating == 4)
                                                                                            <i class="fa fa-star text-yellow"></i> 4.0
                                                                                            @elseif($tutor->rating == 5)
                                                                                            <i class="fa fa-star text-yellow"></i> 5.0
                                                                                            @else
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
                                                                    <div class="col-md-3 bg-price text-center">
                                                                        <div class="row mt-2">
                                                                                <a type="button" onclick="favourite_tutor({{$tutor->id}},'un_fav')" class="fav" title="Favourite">
                                                                                    <i class="fa fa-star text-yellow" id="favorite_start_{{$tutor->id}}"></i>
                                                                                </a>
                                                                            <div class="col-md-12 mb-1">
                                                                            
                                                                                <p class="mb-1 mt-2">starting from</p>
                                                                                <h1 class="f-40 mb-1">${{$tutor->hourly_rate != null ? $tutor->hourly_rate : 0}}</h1>
                                                                                <p class="mb-1">per hour</p>
                                                                            
                                                                                <button type="button" class=" cencel-btn w-100" onclick="chat({{$tutor->id}})">
                                                                                        &nbsp; Message &nbsp;
                                                                                </button>
                                                                            
                                                                                <button type="button" onclick="checkBookingSlots({{$tutor->id}})" class=" schedule-btn w-100 mt-2" >
                                                                                        &nbsp; Book Class &nbsp;
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- <div class="col-md-3">
                                                                        <video loop autoplay muted controls class="vid23 w-100">
                                                                            <source src="{{asset('storage/profile/kin123.mp4')}}" type="video/mp4">
                                                                        </video>
                                                                    </div> -->
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="col-md-12">
                                            <div class="card mt-0">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            No Favourite Tutor Added Yet
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                
                            </div>
                        </div>
                
                    </div>
                </div>
            
                <div class="col-md-4">
                    <div class="row ">
                        <!-- <div class="col-md-12 mb-3">
                            <div class="card mt-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            @if($user->picture)
                                                <img src="{{asset ($user->picture)}}" alt=""  class="db_img">
                                            @else
                                                <img src="{{asset ('assets/images/ico/Square-white.jpg')}}" alt="" class="db_img">
                                            @endif
                                        </div>
                                        <div class="col-md-8">
                                            <p class="mb-0"><strong>{{$user->first_name}} {{$user->last_name}}</strong></p>
                                            <p class="text-mute mb-0">Student ID# 548{{$user->id}}09 </p>
                                            <label class="text-mute">Profile Completion</label>
                                            <div class="progress">
                                                
                                                <div class="progress-bar bg-tutorvy progress-bar-striped progress-bar-animated" role="progressbar"  style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">70%</div>
                                            </div>
                                            <a href="{{route('student.profile')}}" class="pull-right"><small>Complete Profile</small> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-md-12">
                            <div class="card mt-0">
                                <div class="card-body">

                                    <div class="row mt-2">
                                        <div class="col-md-8">
                                                <p class="heading-forth">
                                                    Today Bookings
                                                </p>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="{{route('student.bookings')}}" class="view-bookings">
                                                View all 
                                            </a>
                                        </div>
                                    </div>
                                        @if($today_bookings != "[]")
                                            @foreach($today_bookings as $booking)
                                                <a href="{{route('student.bookings')}}" class="decoration-none">
                                                    <div class="row mt-2 bg-bookings">
                                                        <div class="col-md-3 text-center div-center">
                                                            @if($booking->tutor->picture)
                                                                    <img src="{{asset ($booking->tutor->picture)}}" alt=""  class="profile-img book_dash">
                                                            @else
                                                                <img src="{{asset ('assets/images/ico/Square-white.jpg')}}" alt="" class="profile-img book_dash">
                                                            @endif
                                                        </div>
                                                        <div class="col-md-9 pl-0">
                                                            <p class="  mb-1 chemistry-tex1">
                                                            {{$booking->subject->name}}
                                                            </p>
                                                            <p class=" mb-0 chemistry-tex1">
                                                                Class: {{$booking->topic}}

                                                            </p>
                                                            <p class="chemistry-tex2 pt-2 pb-2 mb-0">
                                                                {{ \Illuminate\Support\Str::limit($booking->brief, $limit = 50, $end = '...') }}
                                                            </p>
                                                            <p class="time-chemistry mb-0">
                                                                <img src="{{asset('assets/images/ico/watch-icon.png') }}" alt="watch" class=" "> 
                                                                <span class="pt-1 pl-1">  {{date("g:i a", strtotime("$booking->class_time UTC"))}} - {{$booking->class_date }} </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        @else
                                            
                                        <div class="text-center" style="min-height:113px;">
                                            <img src="{{asset('assets/images/ico/clander.png')}}" alt="" style="width:33%;"> 
                                            <p class="mb-5"> No Bookings for Today</p>

                                        </div>
                                        @endif
                                    <div class="row mt-2">
                                        <div class="col-md-9">
                                                <p class="heading-forth">
                                                    Upcoming Bookings
                                                </p>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="{{route('student.bookings')}}" class="view-bookings">
                                                View all
                                            </a>
                                        </div>
                                    </div>
                                    @if($upcoming_bookings != "[]")
                                            @foreach($upcoming_bookings as $booking)

                                                <a href="{{route('student.bookings')}}" class="decoration-none">
                                                    <div class="row mt-2 bg-bookings">
                                                        <div class="col-md-3 text-center div-center">
                                                            @if($booking->tutor->picture)
                                                                    <img src="{{asset ($booking->tutor->picture)}}" alt=""  class="profile-img book_dash">
                                                            @else
                                                                <img src="{{asset ('assets/images/ico/Square-white.jpg')}}" alt="" class="profile-img book_dash">
                                                            @endif
                                                        </div>
                                                        <div class="col-md-9 pl-0">
                                                            <p class="  mb-1 chemistry-tex1">
                                                            {{$booking->subject->name}}
                                                            </p>
                                                            <p class=" mb-0 chemistry-tex1">
                                                                Class: {{$booking->topic}}

                                                            </p>
                                                            <p class="chemistry-tex2 pt-2 pb-2 mb-0">
                                                                {{ \Illuminate\Support\Str::limit($booking->brief, $limit = 50, $end = '...') }}
                                                            </p>
                                                            <p class="time-chemistry mb-0">
                                                                <img src="{{asset('assets/images/ico/watch-icon.png') }}" alt="watch" class=" "> 
                                                                <span class="pt-1 pl-1">  {{date("g:i a", strtotime("$booking->class_time UTC"))}} - {{$booking->class_date }} </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        @else
                                        <div class="text-center" style="min-height:113px;">
                                            <img src="{{asset('assets/images/ico/clander.png')}}" alt="" style="width:33%;"> 
                                            <p class="mb-5"> No Upcoming Bookings found</p>

                                        </div>
                                        @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12  ">
                            <!-- <div class="card">
                                <div class="card-body"> -->
                                    <div class="card bg-ad">
                                        <div class="card-body">
                                            <div>
                                                <a href="{{route('student.bookings')}}">
                                                        <img src="{{asset('assets/images/ico/playStore.png')}}" class="w-45" alt="">
                                                </a>
                                            </div>
                                            <div class="mt-2">
                                                <a href="">
                                                        <img src="{{asset('assets/images/ico/appStore.png')}}" class="w-45" alt="">
                                                </a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                
                                <!-- </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Button trigger modal -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body"
                        style="padding-top: 100px;padding-bottom: 100px;">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="box">
                                        <select class="selectpicker w-100 select-o"
                                            data-size="4">
                                            <option value="">Select Custom</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select class="w-100 select-o">
                                        <option value="">hello</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="w-100 select-o">
                                        <option value="">hello</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="w-100 select-o">
                                        <option value="">hello</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                    <button class="schedule-btn" id="request_booking_btn"> Confirm Booking </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <div class="line"></div>
</div>
<script>
 
</script>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@include('js_files.student.dashboardJS')
@include('js_files.student.tutorJs')
<script>

    var checkTimeZone = $("#timeZone").val(); 
    // checkTimeZone.length == 0 ? saveTimeZone() : '';
    saveTimeZone();
    function saveTimeZone() {
        const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        var date = new Date();
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: "{{route('student.timeZone')}}",
            type: "POST",
            data: {zone: timezone , date :date},
            success:function(response){
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
    }
    
</script>
@endsection