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
                                        <span style="display:inline-flex ;" class="bg-success"> Delivered</span>
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

                                        </div>
                                        
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <p
                                            style="color: #00132D;font-size: 16px;font-family: Poppins;font-weight: 500;">
                                            Attachments</p>
                                        <div class="row">
                                            <!-- <div class="col-md-3 col-sm-12 card bg-light mb-3"
                                                style="">
                                                <div class="container-fluid m-0 p-0">
                                                <div class="text-home mt-3" style="display: flex;">
                                                        <p>
                                                            <input style="display: none;" type="file"
                                                                id="fileinput" />
                                                            <img src="{{ asset($booking->attachments) }}"
                                                                alt="word" width="100" height="100">
                                                        </p>
                                                        <p class="ml-3 mr-3">
                                                            Image</p>
                                                    </div>
                                                    <div class="text-home mt-3" style="display: flex;">
                                                        <p>
                                                            <input style="display: none;" type="file"
                                                                id="fileinput" />
                                                            <img src="{{ asset('assets/images/ico/word.png') }}"
                                                                alt="word">
                                                        </p>
                                                        <p class="ml-3 mr-3">
                                                            Word Files</p>
                                                    </div>
                                                    <div class="iconside">
                                                        <img src="{{ asset('assets/images/ico/download.png') }}" alt="o"
                                                            id='btnLoad' value='download'
                                                            onclick='downloadFile();'
                                                            style="width: 30px;position: absolute;top: 10px;right: 10px;">
                                                    </div>
                                                </div>
                                            </div> &nbsp;&nbsp;
                                            <div class="col-md-3 col-xs-12 bg-light  card mb-3"
                                                style="">
                                                <div class="container-fluid m-0 p-0">
                                                    <div class="text-home mt-3" style="display: flex;">
                                                        <p><img src="{{ asset('assets/images/ico/pptx.png') }}" alt="ga">
                                                        </p>
                                                        <p class="ml-3 mr-3">
                                                            PPTX Files</p>
                                                    </div>

                                                    <div class="iconside">
                                                        <img src="{{ asset('assets/images/ico/download.png') }}" alt="ag"
                                                            style="width: 30px;position: absolute;top: 10px;right: 10px;">
                                                    </div>
                                                </div>
                                            </div> -->
                                            @if($booking->attachments)
                                                <div class="col-md-2 mt-1 mb-3">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
