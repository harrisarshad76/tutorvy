@extends('admin.layouts.app')
@section('content')


    <section>
        <div class="content-wrapper " style="overflow: hidden;">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                            <p class="mr-3 heading-first lead"> Booking Details </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-white pb-0"
                                style="border-bottom: 1px solid #D6DBE2; display: inline-flex;">
                                <p class="col-md-6 col-xs-12 class-ch"
                                    style="margin-top: 10px; text-align: left;color: #00132D;font-size: 22px;font-family: Poppins;font-weight: 500;">
                                    {{$booking->subject->name}} Class

                                    
                                    @if($booking->status == 0)
                                        <span style="display:inline-flex ;" class="bg-color-apporve3"> Pending</span>
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
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9">
                                            <div class="row image1 mt-3 ">

                                                <div class="col-md-1">
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
                                                <div class="col-md-12">
                                                    <div class="text1"
                                                        style="color: #00132D;font-size: 15px;font-family: Poppins;font-weight: 500;line-height: 2;">
                                                        {{$booking->question}}
                                                    </div>
                                                    <div class="text2"
                                                        style="color: #00132D;font-size: 14px;font-family: Poppins;font-weight: 400;">
                                                        {{$booking->brief}}
                                                    </div>
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
                                                                <span class="time-details">
                                                                    {{$booking->class_time}}
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <p
                                                    style="color: #00132D;font-size: 16px;font-family: Poppins;font-weight: 500;">
                                                    Attachments</p>
                                                </div>
                                            </div>
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
                                        @if($booking->is_reviewed == 1)
                                            <div class="col-md-3 bg-sky ">
                                                
                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <div class="row image1 mt-3 ">

                                                            <div class="col-md-3 text-center">
                                                                @if ($booking->tutor->picture)
                                                                    <img src="{{asset($booking->tutor->picture)}}" alt="profile-image"  class="profile-img" >
                                                                @else
                                                                    <img src="{{asset ('assets/images/ico/Square-white.jpg')}}"  alt="profile-image" class=" profile-img" >
                                                                @endif
                                                            </div>
                                                            <div class="col-md-9">
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
    </section>
@endsection
