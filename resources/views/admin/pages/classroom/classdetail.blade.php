@extends('admin.layouts.app')

@section('content')
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-6">
            <h1>
                < Class details
            </h1>
        </div>
        <div class="col-md-6">
        </div>
    </div>
</div>

<!-- tutor request bookings  table start-->
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card cards">
                <div class="card-header bg-white pb-0"
                    style="border-bottom: 1px solid #D6DBE2; display: inline-flex;">
                    <p class="col-md-6 col-xs-12 class-ch heading-thirds">{{$class->booking->topic}}</p>
                    <p class="col-md-6">

                    </p>
                </div>
                <card class="body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row image1 mt-3 ml-1">
                                    <p> <img src="../assets/img/ico/profile-boy.png" alt="text-image">
                                    <p class="ml-3 mt-1 heading-forth">
                                        {{$class->booking->user->first_name}}
                                        {{$class->booking->user->last_name}}
                                    </p>
                                    <p class="paragraph-text std-name-1">
                                        Student
                                    </p>
                                    </p>
                                </div>
                                <div class="heading-fifth mt-1">
                                    {{$class->booking->question}}

                                </div>
                                <div class="text2 paragraph-texts mt-1">
                                    {{$class->booking->brief}}
                                </div>

                                <div class="text3">
                                    <div style="display: flex;margin-left: -10px;">
                                        <p>
                                            <img src="../assets/img/ico/Group.png" class="watch-group-image"
                                                alt="group-image">
                                        <p class="time-text">
                                            Schedule time : </p>
                                        <p class="ml-2 time-text-1">
                                            {{date('d, M Y',strtotime($class->booking->class_date))}}
                                            {{date('h:i A',strtotime($class->booking->class_time))}}
                                        </p>
                                        </p>
                                        <p><img src="../assets/img/ico/Group.png" class="watch-group-image"
                                                alt="group-image">
                                        <p class="time-text">
                                            Schedule time :
                                        </p>
                                        <p class="ml-2 time-text-1">
                                            {{date('d, M Y',strtotime($class->booking->class_date))}}
                                            {{date('h:i A',strtotime($class->booking->class_booked_till))}}
                                        </p>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="container-fluid" style="margin-left: -10px;">
                                <div class="col-md-12">
                                    <p class="heading-fifth">
                                        1 attachments</p>
                                    <dov class="row">
                                        @if ($class->booking->attachments != null)
                                        <div class="col-md-3 col-sm-12  bg-light " style="height: 100px;">
                                            <div class="container-fluid">
                                                <div class="text-home mt-3" style="display: flex;">
                                                    <a href="{{asset($class->booking->attachments)}}" download>
                                                        <img src="{{asset($class->booking->attachments)}}" >
                                                      </a>
                                                </div>

                                            </div>
                                        </div>
                                        @endif


                                </div>
                                <div class="container-fluid">
                                    <div class="pb-4 mt-4">
                                        <a href="">
                                            <h3>
                                                < Student review
                                            </h3>
                                        </a>
                                    </div>
                                    <div class="container-fluid pb-5 mt-3">
                                        <div class="row container-center bg-color-1 mb-3">
                                            <div class="col-md-6">
                                                <div class="container-fluid">
                                                    <div class="row mt-3">
                                                        <div class="col-md-2">
                                                            <img src="../assets/img/ico/profile-boy.png" />
                                                        </div>
                                                        <div class="col-md-10 m-0 p-0">
                                                            <span class="heading-forth">Harram Laraib</span>
                                                            <p class="paragraph-text  ">Student</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <span class="view-date mt-3">02 March 2021</span>
                                            </div>
                                            <div class="container-fluid mt-3">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <div class="star-fa1 ml-3 mt-0">
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="paragraph-text1">4.0</span>
                                                        </div>
                                                        <p class="paragraph-texts mt-2 ml-3">
                                                            It is a long established fact that a reader will be distracted by the readable
                                                            content of a page when looking at0 its lyout. The point
                                                            of using Lorem Ipsum is that it has more-or-less normal distribution of letters,
                                                            as opposed to using Content here, content ere'
                                                            making it look like readable English.
                                                        </p>
                                                    </div>

                                                </div>
                                                <hr />
                                            </div>

                                        </div>
                                        <!-- tutor reply -->
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-11 container-center pt-3 bg-white">
                                                    <div class="container-fluid">
                                                        <span class="heading-fifth">Tutor replied</span>
                                                        <hr />
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="container-fluid">
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <img src="../assets/img/ico/profile-boy.png" />
                                                                        </div>
                                                                        <div class="col-md-10 mt-1">
                                                                            <span class="heading-forth">Ali Raza</span>
                                                                            <p class="paragraph-text">Tutor</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <span class="view-date mt-3 mr-3">02 March 2021</span>
                                                            </div>
                                                            <div class="container-fluid mt-2">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="star-fa1 ml-3 mt-0">
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star"></span>
                                                                            <span class="paragraph-text1">4.0</span>
                                                                        </div>
                                                                        <p class="paragraph-texts col-md-12 mt-2">
                                                                           Thank you for your reply

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- 2nd -->


                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4"></div>
                    </div>

            </div>
        </div>
    </div>
</div>
@endsection
