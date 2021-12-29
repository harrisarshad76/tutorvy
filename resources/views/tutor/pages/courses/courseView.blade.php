@extends('tutor.layouts.app')
<link rel="stylesheet" href="{{ asset('assets/css/courseView.css') }}">
<style>
     .circlechart {
            float: left;
            padding: 20px;
        }

        .div-1 {
            width: 3px;
            overflow-x: auto;
            white-space: nowrap;
        }

        .div-1::-webkit-scrollbar {
            width: 4px;
            height: 4px;
        }

        .div-1::-webkit-scrollbar-track {
            border-radius: 4px;
            /* -webkit-box-shadow: inset 0 0 6px red; */
        }

        .div-1::-webkit-scrollbar-thumb {
            /* border-radius: 10px; */
            background-color: #1173FF;
            /* outline: 1px solid #1173FF; */
        }

        .div-1::-webkit-scrollbar:vertical {
            display: none;
        }
        .view-bookings{
            text-align:center;
            font-size:30px !important;
        }
        .card{
            height:auto !important;
        }
        .stuList{
            max-height:387px;
            overflow-x:hidden;
            overflow-y:auto;
        }
        .stuList::-webkit-scrollbar{
            display: none;
        }
</style>
@section('content')
 <!--section start  -->
 <div class="container-fluid pb-4">
            <a href="">
                <a href="./report.html">
                    <h1 class="heading-first mt-5">
                         Course Detail </h1>
                </a>
            </a>
        </div>
        <div class="container-fluid">
            <div class="row ml-1 mr-1">
                <div class="col-md-5 bg-white pb-5">
                    <div class=" mt-4">
                        <h3 class="">
                                {{$course->title}}
                        </h3>
                        <p class="paragraph-text-1">{{$course->subject_name}} course</p>
                        @if($course->video != null && $course->video != '')
                        <iframe width="100%" height="345" src="https://www.youtube.com/embed/tgbNymZ7vqY"
                            style="border-radius: 8px;">
                        </iframe>
                        @elseif($course->thumbnail != null && $course->thumbnail != '')
                            <img width="100%" height="345" src="{{ asset($course->thumbnail) }}"></img>
                        @else
                            <img width="100%" height="345" src="{{ asset('admin/assets/img/login-image/loginImage.png') }}"></img>

                        @endif
                        <div class="row pb-3 border-bottom mt-1">
                            <div class="col-md-12">
                                <p class="heading-fifth heading-fifth-0 mt-4">
                                    Next batch is starting from
                                    <span class="paragraph-text-1">
                                        <?php 
                                            $date= strtotime($course->start_date);
                                            $date = date('d M,Y', $date);
                                        ?>
                                        {{$date}}
                                    </span>
                                </p>
                            </div>
                            <!-- <div class="col-md-6 col-xs-6 col-sm-6 col-6 text-center mt-2">
                                <div class="progress blue mb-1 mt-4">
                                            <span class="progress-left">
                                                <span class="progress-bar"></span>
                                            </span>
                                            <span class="progress-right">
                                                <span class="progress-bar"></span>
                                            </span>
                                            <div class="progress-value">
                                                <span>{{$course->seats}}</span>
                                                <span>Seats Left</span>
                                            </div>
                                        </div>
                                        <small class="leftText">Seats Left</small>
                            </div> -->
                        </div>
                        <h3 class="mt-4">About course</h3>
                        <p class="paragraph-text-2 mt-2 mb-0">
                            {{$course->about}}
                        </p>
                        
                    </div>

                    <div class="row container-center pb-3">
                        <div class="col-md-8 mt-4">
                            <h3>Enrolled Students</h3>
                        </div>
                        <div class="col-md-4 mt-4 text-right">
                            <h3> 53 </h3>
                        </div>
                    </div>
                    <div class="row stuList">
                        
                        <div class="col-md-6 mt-3 mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="#">
                                            <img src="http://127.0.0.1:8000/storage/profile/nPLFusrMCq.png" class=" profile-img" alt="" style="height:70px; width:70px;">
                                    </a>
                                </div>
                                <div class="col-md-8 pl-0 pt-1">
                                    <a href="#">
                                        <p class=" mb-0 text-dark">  <b>  Azad Chaiwala  </b> </p>
                                    </a>
                                    <p class=" mb-0">  Plan: Standard </p>

                                    <p class="mb-0"> <small><img src="http://127.0.0.1:8000/assets/images/ico/location-pro.png" alt="" class=""> Barcelona ,  Pakistan (‫پاکستان‬‎)</small> </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3 mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="#">
                                            <img src="http://127.0.0.1:8000/storage/profile/nPLFusrMCq.png" class=" profile-img" alt="" style="height:70px; width:70px;">
                                    </a>
                                </div>
                                <div class="col-md-8 pl-0 pt-1">
                                    <a href="#">
                                        <p class=" mb-0 text-dark">  <b>  Azad Chaiwala  </b> </p>
                                    </a>
                                    <p class=" mb-0">  Plan: Standard </p>

                                    <p class="mb-0"> <small><img src="http://127.0.0.1:8000/assets/images/ico/location-pro.png" alt="" class=""> Barcelona ,  Pakistan (‫پاکستان‬‎)</small> </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3 mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="#">
                                            <img src="http://127.0.0.1:8000/storage/profile/nPLFusrMCq.png" class=" profile-img" alt="" style="height:70px; width:70px;">
                                    </a>
                                </div>
                                <div class="col-md-8 pl-0 pt-1">
                                    <a href="#">
                                        <p class=" mb-0 text-dark">  <b>  Azad Chaiwala  </b> </p>
                                    </a>
                                    <p class=" mb-0">  Plan: Standard </p>

                                    <p class="mb-0"> <small><img src="http://127.0.0.1:8000/assets/images/ico/location-pro.png" alt="" class=""> Barcelona ,  Pakistan (‫پاکستان‬‎)</small> </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3 mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="#">
                                            <img src="http://127.0.0.1:8000/storage/profile/nPLFusrMCq.png" class=" profile-img" alt="" style="height:70px; width:70px;">
                                    </a>
                                </div>
                                <div class="col-md-8 pl-0 pt-1">
                                    <a href="#">
                                        <p class=" mb-0 text-dark">  <b>  Azad Chaiwala  </b> </p>
                                    </a>
                                    <p class=" mb-0">  Plan: Standard </p>

                                    <p class="mb-0"> <small><img src="http://127.0.0.1:8000/assets/images/ico/location-pro.png" alt="" class=""> Barcelona ,  Pakistan (‫پاکستان‬‎)</small> </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3 mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="#">
                                            <img src="http://127.0.0.1:8000/storage/profile/nPLFusrMCq.png" class=" profile-img" alt="" style="height:70px; width:70px;">
                                    </a>
                                </div>
                                <div class="col-md-8 pl-0 pt-1">
                                    <a href="#">
                                        <p class=" mb-0 text-dark">  <b>  Azad Chaiwala  </b> </p>
                                    </a>
                                    <p class=" mb-0">  Plan: Standard </p>

                                    <p class="mb-0"> <small><img src="http://127.0.0.1:8000/assets/images/ico/location-pro.png" alt="" class=""> Barcelona ,  Pakistan (‫پاکستان‬‎)</small> </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3 mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="#">
                                            <img src="http://127.0.0.1:8000/storage/profile/nPLFusrMCq.png" class=" profile-img" alt="" style="height:70px; width:70px;">
                                    </a>
                                </div>
                                <div class="col-md-8 pl-0 pt-1">
                                    <a href="#">
                                        <p class=" mb-0 text-dark">  <b>  Azad Chaiwala  </b> </p>
                                    </a>
                                    <p class=" mb-0">  Plan: Standard </p>

                                    <p class="mb-0"> <small><img src="http://127.0.0.1:8000/assets/images/ico/location-pro.png" alt="" class=""> Barcelona ,  Pakistan (‫پاکستان‬‎)</small> </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3 mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="#">
                                            <img src="http://127.0.0.1:8000/storage/profile/nPLFusrMCq.png" class=" profile-img" alt="" style="height:70px; width:70px;">
                                    </a>
                                </div>
                                <div class="col-md-8 pl-0 pt-1">
                                    <a href="#">
                                        <p class=" mb-0 text-dark">  <b>  Azad Chaiwala  </b> </p>
                                    </a>
                                    <p class=" mb-0">  Plan: Standard </p>

                                    <p class="mb-0"> <small><img src="http://127.0.0.1:8000/assets/images/ico/location-pro.png" alt="" class=""> Barcelona ,  Pakistan (‫پاکستان‬‎)</small> </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3 mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="#">
                                            <img src="http://127.0.0.1:8000/storage/profile/nPLFusrMCq.png" class=" profile-img" alt="" style="height:70px; width:70px;">
                                    </a>
                                </div>
                                <div class="col-md-8 pl-0 pt-1">
                                    <a href="#">
                                        <p class=" mb-0 text-dark">  <b>  Azad Chaiwala  </b> </p>
                                    </a>
                                    <p class=" mb-0">  Plan: Standard </p>

                                    <p class="mb-0"> <small><img src="http://127.0.0.1:8000/assets/images/ico/location-pro.png" alt="" class=""> Barcelona ,  Pakistan (‫پاکستان‬‎)</small> </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3 mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="#">
                                            <img src="http://127.0.0.1:8000/storage/profile/nPLFusrMCq.png" class=" profile-img" alt="" style="height:70px; width:70px;">
                                    </a>
                                </div>
                                <div class="col-md-8 pl-0 pt-1">
                                    <a href="#">
                                        <p class=" mb-0 text-dark">  <b>  Azad Chaiwala  </b> </p>
                                    </a>
                                    <p class=" mb-0">  Plan: Standard </p>

                                    <p class="mb-0"> <small><img src="http://127.0.0.1:8000/assets/images/ico/location-pro.png" alt="" class=""> Barcelona ,  Pakistan (‫پاکستان‬‎)</small> </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3 mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="#">
                                            <img src="http://127.0.0.1:8000/storage/profile/nPLFusrMCq.png" class=" profile-img" alt="" style="height:70px; width:70px;">
                                    </a>
                                </div>
                                <div class="col-md-8 pl-0 pt-1">
                                    <a href="#">
                                        <p class=" mb-0 text-dark">  <b>  Azad Chaiwala  </b> </p>
                                    </a>
                                    <p class=" mb-0">  Plan: Standard </p>

                                    <p class="mb-0"> <small><img src="http://127.0.0.1:8000/assets/images/ico/location-pro.png" alt="" class=""> Barcelona ,  Pakistan (‫پاکستان‬‎)</small> </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3 mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="#">
                                            <img src="http://127.0.0.1:8000/storage/profile/nPLFusrMCq.png" class=" profile-img" alt="" style="height:70px; width:70px;">
                                    </a>
                                </div>
                                <div class="col-md-8 pl-0 pt-1">
                                    <a href="#">
                                        <p class=" mb-0 text-dark">  <b>  Azad Chaiwala  </b> </p>
                                    </a>
                                    <p class=" mb-0">  Plan: Standard </p>

                                    <p class="mb-0"> <small><img src="http://127.0.0.1:8000/assets/images/ico/location-pro.png" alt="" class=""> Barcelona ,  Pakistan (‫پاکستان‬‎)</small> </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3 mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="#">
                                            <img src="http://127.0.0.1:8000/storage/profile/nPLFusrMCq.png" class=" profile-img" alt="" style="height:70px; width:70px;">
                                    </a>
                                </div>
                                <div class="col-md-8 pl-0 pt-1">
                                    <a href="#">
                                        <p class=" mb-0 text-dark">  <b>  Azad Chaiwala  </b> </p>
                                    </a>
                                    <p class=" mb-0">  Plan: Standard </p>

                                    <p class="mb-0"> <small><img src="http://127.0.0.1:8000/assets/images/ico/location-pro.png" alt="" class=""> Barcelona ,  Pakistan (‫پاکستان‬‎)</small> </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3 mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="#">
                                            <img src="http://127.0.0.1:8000/storage/profile/nPLFusrMCq.png" class=" profile-img" alt="" style="height:70px; width:70px;">
                                    </a>
                                </div>
                                <div class="col-md-8 pl-0 pt-1">
                                    <a href="#">
                                        <p class=" mb-0 text-dark">  <b>  Azad Chaiwala  </b> </p>
                                    </a>
                                    <p class=" mb-0">  Plan: Standard </p>

                                    <p class="mb-0"> <small><img src="http://127.0.0.1:8000/assets/images/ico/location-pro.png" alt="" class=""> Barcelona ,  Pakistan (‫پاکستان‬‎)</small> </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3 mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="#">
                                            <img src="http://127.0.0.1:8000/storage/profile/nPLFusrMCq.png" class=" profile-img" alt="" style="height:70px; width:70px;">
                                    </a>
                                </div>
                                <div class="col-md-8 pl-0 pt-1">
                                    <a href="#">
                                        <p class=" mb-0 text-dark">  <b>  Azad Chaiwala  </b> </p>
                                    </a>
                                    <p class=" mb-0">  Plan: Standard </p>

                                    <p class="mb-0"> <small><img src="http://127.0.0.1:8000/assets/images/ico/location-pro.png" alt="" class=""> Barcelona ,  Pakistan (‫پاکستان‬‎)</small> </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3 mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="#">
                                            <img src="http://127.0.0.1:8000/storage/profile/nPLFusrMCq.png" class=" profile-img" alt="" style="height:70px; width:70px;">
                                    </a>
                                </div>
                                <div class="col-md-8 pl-0 pt-1">
                                    <a href="#">
                                        <p class=" mb-0 text-dark">  <b>  Azad Chaiwala  </b> </p>
                                    </a>
                                    <p class=" mb-0">  Plan: Standard </p>

                                    <p class="mb-0"> <small><img src="http://127.0.0.1:8000/assets/images/ico/location-pro.png" alt="" class=""> Barcelona ,  Pakistan (‫پاکستان‬‎)</small> </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3 mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="#">
                                            <img src="http://127.0.0.1:8000/storage/profile/nPLFusrMCq.png" class=" profile-img" alt="" style="height:70px; width:70px;">
                                    </a>
                                </div>
                                <div class="col-md-8 pl-0 pt-1">
                                    <a href="#">
                                        <p class=" mb-0 text-dark">  <b>  Azad Chaiwala  </b> </p>
                                    </a>
                                    <p class=" mb-0">  Plan: Standard </p>

                                    <p class="mb-0"> <small><img src="http://127.0.0.1:8000/assets/images/ico/location-pro.png" alt="" class=""> Barcelona ,  Pakistan (‫پاکستان‬‎)</small> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                       
                </div>
                <div class="col-md-7">
                    <div class="container-fluid bg-color  pt-4">
                        <div class="warpper">
                            <input class="radio" id="one" name="group" type="radio" checked>
                            <input class="radio" id="two" name="group" type="radio">
                            <input class="radio" id="three" name="group" type="radio">
                            <div class="tabs pb-3">
                                <label class="tab" id="one-tab" for="one">Basic</label>
                                <label class="tab" id="two-tab" for="two">Standard</label>
                                <label class="tab" id="three-tab" for="three">Advance</label>
                            </div>
                            <div class="panels">
                                <div class="panel " id="one-panel">
                                    <div class="container-fluid ">
                                    <div class="panel-title">Course outline</div>
                                        @if($course->basic_class_title == "null")
                                            <div class="row mt-3">
                                                <div class="col-md-12 text-center mt-5">
                                                    <h3 class="">No basic package added yet</h3>
                                                </div>
                                            </div>
                                        @else
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <!-- <span class="heading-forth ml-2">Course outline</span> -->

                                                    <div id="main">
                                                        <!-- first -->
                                                        <div class="container-fluid m-0 p-0 border-bottom pb-3">
                                                            @foreach($course->outline as $outline)
                                                                @if($outline->level == 1)
                                                                    @if($outline->title == '' && $outline->explain == '')
                                                                    <p>No Course Outline added.</p>
                                                                    @else
                                                                    <div class="accordion active" id="faq">
                                                                            <div class="card m-0 p-0">

                                                                                    <div class="card-header" id="outlinehead{{$outline->id}}">
                                                                                        <a href="#"
                                                                                            class=" bg-color btn-header-link collapsed"
                                                                                            data-toggle="collapse" data-target="#outline{{$outline->id}}"
                                                                                            aria-expanded="true" aria-controls="outline{{$outline->id}}">
                                                                                            <img class="mr-2"
                                                                                                src="{{asset('admin/assets/img/ico/round.png')}}" />
                                                                                            {{$outline->title}}</a>
                                                                                    </div>
                                                                                    <div id="outline{{$outline->id}}" class="collapse show border-radius"
                                                                                        aria-labelledby="{{$outline->id}}" data-parent="#outline{{$outline->id}}">
                                                                                        <div class="card-body">
                                                                                            {{$outline->explain}}
                                                                                        </div>
                                                                                    </div>

                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <span class="heading-fifth" style="font-weight: 600;">Timing</span>
                                                    <p class="paragraph-text-2 mt-1">{{ $course->basic_duration != null ? $course->basic_duration : 0 }} weeks ({{ $course->course_basic_days != null ? $course->course_basic_days : '---' }})</p>
                                                </div>
                                            </div>
                                            <div class="row ">
                                                <div class="col-md-12 scrollable">
                                                    <table class="table table-borderless">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"></th>
                                                                <th scope="col w-150">Mon</th>
                                                                <th scope="col w-150">Tue </th>
                                                                <th scope="col w-150">Wed</th>
                                                                <th scope="col w-150">Thu</th>
                                                                <th scope="col w-150">Fri</th>
                                                                <th scope="col w-150">Sat</th>
                                                                <th scope="col w-150">Sun</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!-- classes table time and topics -->
                                                                @foreach($course->basic_classes as $class)
                                                                <tr class="wordBreak">
                                                                    <td class="pt-4">
                                                                        <div class="w-150">
                                                                            <span>{{date("g:i a", strtotime("$class->st_time UTC"))}} </span>
                                                                            <p class="mt-5">{{date("g:i a", strtotime("$class->et_time UTC"))}}</p>
                                                                        </div>
                                                                    </td>

                                                                    @if($class->day == 1)
                                                                    <td class="m-0 p-0 pt-4">
                                                                        <div class="bg-color-apporve pl-2 pr-3 m-0 p-0 w-150">
                                                                            <span class="heading-fifth">
                                                                            {{$class->title}}
                                                                            </span>
                                                                            <p class="paragraph-text-1 mb-1">
                                                                            <small>{{date("g:i a", strtotime("$class->st_time UTC"))}}</small>
                                                                            </p>
                                                                            <p class="paragraph-text">
                                                                            {{$class->overview}}
                                                                            </p>
                                                                        </div>
                                                                    </td>
                                                                    @else
                                                                    <td class="pt-4 pb-0">---</td>
                                                                    @endif

                                                                    @if($class->day == 2)
                                                                    <td class="m-0 p-0 pt-4">
                                                                        <div class="bg-color-apporve1 pl-2 pr-3 m-0 p-0 w-150 w-150">
                                                                            <span class="heading-fifth">
                                                                            {{$class->title}}
                                                                            </span>
                                                                            <p class="paragraph-text-1 mb-1">
                                                                            <small>{{date("g:i a", strtotime("$class->st_time UTC"))}}</small>
                                                                            </p>
                                                                            <p class="paragraph-text">
                                                                            {{$class->overview}}
                                                                            </p>
                                                                        </div>
                                                                    </td>
                                                                    @else
                                                                    <td class="pt-4 pb-0">---</td>
                                                                    @endif

                                                                    @if($class->day == 3)
                                                                    <td class="m-0 p-0 pt-4">
                                                                        <div class="bg-color-apporve3 pl-2 pr-3 m-0 p-0 w-150">
                                                                            <span class="heading-fifth">
                                                                            {{$class->title}}
                                                                            </span>
                                                                            <p class="paragraph-text-1 mb-1">
                                                                            <small>{{date("g:i a", strtotime("$class->st_time UTC"))}}</small>
                                                                            </p>
                                                                            <p class="paragraph-text">
                                                                            {{$class->overview}}
                                                                            </p>
                                                                        </div>
                                                                    </td>
                                                                    @else
                                                                    <td class="pt-4 pb-0">---</td>
                                                                    @endif

                                                                    @if($class->day == 4)
                                                                    <td class="m-0 p-0 pt-4">
                                                                        <div class="bg-color-apporve pl-2 pr-3 m-0 p-0 w-150">
                                                                            <span class="heading-fifth">
                                                                            {{$class->title}}
                                                                            </span>
                                                                            <p class="paragraph-text-1 mb-1">
                                                                            <small>{{date("g:i a", strtotime("$class->st_time UTC"))}}</small>
                                                                            </p>
                                                                            <p class="paragraph-text">
                                                                            {{$class->overview}}
                                                                            </p>
                                                                        </div>
                                                                    </td>
                                                                    @else
                                                                    <td class="pt-4 pb-0">---</td>
                                                                    @endif

                                                                    @if($class->day == 5)
                                                                    <td class="m-0 p-0 pt-4">
                                                                        <div class="bg-color-apporve1 pl-2 pr-3 m-0 p-0 w-150">
                                                                            <span class="heading-fifth">
                                                                            {{$class->title}}
                                                                            </span>
                                                                            <p class="paragraph-text-1 mb-1">
                                                                            <small>{{date("g:i a", strtotime("$class->st_time UTC"))}}</small>
                                                                            </p>
                                                                            <p class="paragraph-text">
                                                                            {{$class->overview}}
                                                                            </p>
                                                                        </div>
                                                                    </td>
                                                                    @else
                                                                    <td class="pt-4 pb-0">---</td>
                                                                    @endif

                                                                    @if($class->day == 6)
                                                                    <td class="m-0 p-0 pt-4">
                                                                        <div class="bg-color-apporve3 pl-2 pr-3 m-0 p-0 w-150">
                                                                            <span class="heading-fifth">
                                                                            {{$class->title}}
                                                                            </span>
                                                                            <p class="paragraph-text-1 mb-1">
                                                                            <small>{{date("g:i a", strtotime("$class->st_time UTC"))}}</small>
                                                                            </p>
                                                                            <p class="paragraph-text">
                                                                            {{$class->overview}}
                                                                            </p>
                                                                        </div>
                                                                    </td>
                                                                    @else
                                                                    <td class="pt-4 pb-0">---</td>
                                                                    @endif

                                                                    @if($class->day == 7)
                                                                    <td class="m-0 p-0 pt-4">
                                                                        <div class="bg-color-apporve pl-2 pr-3 m-0 p-0 w-150">
                                                                            <span class="heading-fifth">
                                                                            {{$class->title}}
                                                                            </span>
                                                                            <p class="paragraph-text-1 mb-1">
                                                                            <small>{{date("g:i a", strtotime("$class->st_time UTC"))}}</small>
                                                                            </p>
                                                                            <p class="paragraph-text">
                                                                            {{$class->overview}}
                                                                            </p>
                                                                        </div>
                                                                    </td>
                                                                    @else
                                                                    <td class="pt-4 pb-0">---</td>
                                                                    @endif
                                                                </tr>
                                                                @endforeach

                                                            </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row mt-5 pb-5">
                                                <div class="col-md-4">
                                                    <div class="d-flex pb-3">
                                                        <span>
                                                            @if($course->basic_home_work == 'on')
                                                            <img height="19px" class="mt-2" src="{{asset('admin/assets/img/ico/circle-outline.png')}}" alt="ico" />
                                                            @else
                                                            <img height="19px" class="mt-2" src="{{asset('admin/assets/img/ico/circle-outline-cross.png')}}" alt="ico" />
                                                            @endif
                                                        </span>
                                                        <span class="ml-3 heading-fifth mt-1">Home Work</span>
                                                    </div>
                                                    <div class="d-flex pb-3">
                                                        <span>
                                                            @if($course->basic_quiz == 'on')
                                                            <img height="19px" class="mt-2" src="{{asset('admin/assets/img/ico/circle-outline.png')}}" alt="ico" />
                                                            @else
                                                            <img height="19px" class="mt-2" src="{{asset('admin/assets/img/ico/circle-outline-cross.png')}}" alt="ico" />
                                                            @endif
                                                        </span>
                                                        <span class="ml-3 heading-fifth mt-1">Quiz</span>
                                                    </div>
                                                    <div class="d-flex pb-3">
                                                        <span>
                                                        @if($course->basic_note == 'on')
                                                            <img height="19px" class="mt-2" src="{{asset('admin/assets/img/ico/circle-outline.png')}}" alt="ico" />
                                                            @else
                                                            <img height="19px" class="mt-2" src="{{asset('admin/assets/img/ico/circle-outline-cross.png')}}" alt="ico" />
                                                            @endif
                                                        </span>
                                                        <span class="ml-3 heading-fifth mt-1">Note</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="d-flex pb-3">
                                                        <span>
                                                            @if($course->basic_one_one == 'on')
                                                            <img height="19px" class="mt-2" src="{{asset('admin/assets/img/ico/circle-outline.png')}}" alt="ico" />
                                                            @else
                                                            <img height="19px" class="mt-2" src="{{asset('admin/assets/img/ico/circle-outline-cross.png')}}" alt="ico" />
                                                            @endif
                                                        </span>
                                                        <span class="ml-3 heading-fifth mt-1">One to One session</span>
                                                    </div>
                                                    <div class="d-flex pb-3">
                                                        <span>
                                                            @if($course->basic_final == 'on')
                                                            <img height="19px" class="mt-2" src="{{asset('admin/assets/img/ico/circle-outline.png')}}" alt="ico" />
                                                            @else
                                                            <img height="19px" class="mt-2" src="{{asset('admin/assets/img/ico/circle-outline-cross.png')}}" alt="ico" />
                                                            @endif
                                                        </span>
                                                        <span class="ml-3 heading-fifth mt-1">Final test</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="view-bookings" >
                                                        ${{$course->basic_price ?? 0 }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="panel" id="two-panel">

                                    <div class="container-fluid ">
                                        <div class="panel-title">Course Outline</div>
                                        @if($course->standard_class_title == "null")
                                            <div class="row mt-3">
                                                <div class="col-md-12 text-center mt-5">
                                                    <h3 class="">No standard package added yet</h3>
                                                </div>
                                            </div>
                                        @else
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <span class="heading-forth ml-2">Course outline</span>
                                                    <div id="main">
                                                        <div class="container-fluid m-0 p-0 border-bottom pb-3">
                                                            @foreach($course->outline as $outline)
                                                                @if($outline->level == 2)
                                                                    @if($outline->title == '' && $outline->explain == '')
                                                                        <p>No Course Outline added.</p>
                                                                    @else
                                                                    <div class="accordion" id="faq">
                                                                        <div class="card m-0 p-0">
                                                                            <div class="card-header" id="faqhead">
                                                                                <a href="#"
                                                                                    class="bg-color btn-header-link collapsed"
                                                                                    data-toggle="collapse" data-target="#faq11"
                                                                                    aria-expanded="true" aria-controls="faq11">
                                                                                    <img class="mr-2"
                                                                                        src="{{asset('admin/assets/img/ico/round.png')}}" />
                                                                                        {{$outline->title}}
                                                                                </a>
                                                                            </div>
                                                                            <div id="faq11" class="collapse show border-radius"
                                                                                aria-labelledby="faqhead3" data-parent="#faq11">
                                                                                <div class="card-body">
                                                                                {{$outline->explain}}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <span class="heading-fifth" style="font-weight: 600;">Timing</span>
                                                    <p class="paragraph-text-2 mt-1">{{ $course->standard_duration != null ? $course->standard_duration : 0 }} weeks ({{ $course->course_standard_days != null ? $course->course_standard_days : '---' }}) - {{date("g:i a", strtotime("$course->standard_start_time UTC"))}} to
                                                    {{date("g:i a", strtotime("$course->standard_end_time UTC"))}}</p>
                                                </div>
                                            </div>
                                            <div class="row mt-0 w-100 div-1">
                                                <div class="col-md-12">
                                                    <table class="table table-borderless">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"></th>
                                                                <th scope="col w-150">Mon</th>
                                                                <th scope="col w-150">Tue </th>
                                                                <th scope="col w-150">Wed</th>
                                                                <th scope="col w-150">Thu</th>
                                                                <th scope="col w-150">Fri</th>
                                                                <th scope="col w-150">Sat</th>
                                                                <th scope="col w-150">Sun</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <!-- classes table time and topics -->
                                                            @foreach($course->standard_classes as $class)
                                                            <tr class="wordBreak">
                                                                <td class="pt-4">
                                                                    <div class="w-150">
                                                                        <span>{{date("g:i a", strtotime("$class->st_time UTC"))}} </span>
                                                                        <p class="mt-5">{{date("g:i a", strtotime("$class->et_time UTC"))}}</p>
                                                                    </div>
                                                                </td>

                                                                @if($class->day == 1)
                                                                <td class="m-0 p-0 pt-4">
                                                                    <div class="bg-color-apporve pl-2 pr-3 m-0 p-0 w-150">
                                                                        <span class="heading-fifth">
                                                                        {{$class->title}}
                                                                        </span>
                                                                        <p class="paragraph-text-1 mb-1">
                                                                        <small>{{date("g:i a", strtotime("$class->st_time UTC"))}}</small>
                                                                        </p>
                                                                        <p class="paragraph-text">
                                                                        {{$class->overview}}
                                                                        </p>
                                                                    </div>
                                                                </td>
                                                                @else
                                                                <td class="pt-4 pb-0">---</td>
                                                                @endif

                                                                @if($class->day == 2)
                                                                <td class="m-0 p-0 pt-4">
                                                                    <div class="bg-color-apporve1 pl-2 pr-3 m-0 p-0 w-150 w-150">
                                                                        <span class="heading-fifth">
                                                                        {{$class->title}}
                                                                        </span>
                                                                        <p class="paragraph-text-1 mb-1">
                                                                        <small>{{date("g:i a", strtotime("$class->st_time UTC"))}}</small>
                                                                        </p>
                                                                        <p class="paragraph-text">
                                                                        {{$class->overview}}
                                                                        </p>
                                                                    </div>
                                                                </td>
                                                                @else
                                                                <td class="pt-4 pb-0">---</td>
                                                                @endif

                                                                @if($class->day == 3)
                                                                <td class="m-0 p-0 pt-4">
                                                                    <div class="bg-color-apporve3 pl-2 pr-3 m-0 p-0 w-150">
                                                                        <span class="heading-fifth">
                                                                        {{$class->title}}
                                                                        </span>
                                                                        <p class="paragraph-text-1 mb-1">
                                                                        <small>{{date("g:i a", strtotime("$class->st_time UTC"))}}</small>
                                                                        </p>
                                                                        <p class="paragraph-text">
                                                                        {{$class->overview}}
                                                                        </p>
                                                                    </div>
                                                                </td>
                                                                @else
                                                                <td class="pt-4 pb-0">---</td>
                                                                @endif

                                                                @if($class->day == 4)
                                                                <td class="m-0 p-0 pt-4">
                                                                    <div class="bg-color-apporve pl-2 pr-3 m-0 p-0 w-150">
                                                                        <span class="heading-fifth">
                                                                        {{$class->title}}
                                                                        </span>
                                                                        <p class="paragraph-text-1 mb-1">
                                                                        <small>{{date("g:i a", strtotime("$class->st_time UTC"))}}</small>
                                                                        </p>
                                                                        <p class="paragraph-text">
                                                                        {{$class->overview}}
                                                                        </p>
                                                                    </div>
                                                                </td>
                                                                @else
                                                                <td class="pt-4 pb-0">---</td>
                                                                @endif

                                                                @if($class->day == 5)
                                                                <td class="m-0 p-0 pt-4">
                                                                    <div class="bg-color-apporve1 pl-2 pr-3 m-0 p-0 w-150">
                                                                        <span class="heading-fifth">
                                                                        {{$class->title}}
                                                                        </span>
                                                                        <p class="paragraph-text-1 mb-1">
                                                                        <small>{{date("g:i a", strtotime("$class->st_time UTC"))}}</small>
                                                                        </p>
                                                                        <p class="paragraph-text">
                                                                        {{$class->overview}}
                                                                        </p>
                                                                    </div>
                                                                </td>
                                                                @else
                                                                <td class="pt-4 pb-0">---</td>
                                                                @endif

                                                                @if($class->day == 6)
                                                                <td class="m-0 p-0 pt-4">
                                                                    <div class="bg-color-apporve3 pl-2 pr-3 m-0 p-0 w-150">
                                                                        <span class="heading-fifth">
                                                                        {{$class->title}}
                                                                        </span>
                                                                        <p class="paragraph-text-1 mb-1">
                                                                        <small>{{date("g:i a", strtotime("$class->st_time UTC"))}}</small>
                                                                        </p>
                                                                        <p class="paragraph-text">
                                                                        {{$class->overview}}
                                                                        </p>
                                                                    </div>
                                                                </td>
                                                                @else
                                                                <td class="pt-4 pb-0">---</td>
                                                                @endif

                                                                @if($class->day == 7)
                                                                <td class="m-0 p-0 pt-4">
                                                                    <div class="bg-color-apporve pl-2 pr-3 m-0 p-0 w-150">
                                                                        <span class="heading-fifth">
                                                                        {{$class->title}}
                                                                        </span>
                                                                        <p class="paragraph-text-1 mb-1">
                                                                        <small>{{date("g:i a", strtotime("$class->st_time UTC"))}}</small>
                                                                        </p>
                                                                        <p class="paragraph-text">
                                                                        {{$class->overview}}
                                                                        </p>
                                                                    </div>
                                                                </td>
                                                                @else
                                                                <td class="pt-4 pb-0">---</td>
                                                                @endif
                                                            </tr>
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row mt-5 pb-5">
                                                <div class="col-md-4">
                                                    <div class="d-flex pb-3">
                                                        <span>
                                                            @if($course->standard_home_work == 'on')
                                                            <img height="19px" class="mt-2" src="{{asset('admin/assets/img/ico/circle-outline.png')}}" alt="ico" />
                                                            @else
                                                            <img height="19px" class="mt-2" src="{{asset('admin/assets/img/ico/circle-outline-cross.png')}}" alt="ico" />
                                                            @endif
                                                        </span>
                                                        <span class="ml-3 heading-fifth mt-1">Home Work</span>
                                                    </div>
                                                    <div class="d-flex pb-3">
                                                        <span>
                                                            @if($course->standard_quiz == 'on')
                                                            <img height="19px" class="mt-2" src="{{asset('admin/assets/img/ico/circle-outline.png')}}" alt="ico" />
                                                            @else
                                                            <img height="19px" class="mt-2" src="{{asset('admin/assets/img/ico/circle-outline-cross.png')}}" alt="ico" />
                                                            @endif
                                                        </span>
                                                        <span class="ml-3 heading-fifth mt-1">Quiz</span>
                                                    </div>
                                                    <div class="d-flex pb-3">
                                                        <span>
                                                        @if($course->standard_note == 'on')
                                                            <img height="19px" class="mt-2" src="{{asset('admin/assets/img/ico/circle-outline.png')}}" alt="ico" />
                                                            @else
                                                            <img height="19px" class="mt-2" src="{{asset('admin/assets/img/ico/circle-outline-cross.png')}}" alt="ico" />
                                                            @endif
                                                        </span>
                                                        <span class="ml-3 heading-fifth mt-1">Note</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="d-flex pb-3">
                                                        <span>
                                                            @if($course->standard_one_one == 'on')
                                                            <img height="19px" class="mt-2" src="{{asset('admin/assets/img/ico/circle-outline.png')}}" alt="ico" />
                                                            @else
                                                            <img height="19px" class="mt-2" src="{{asset('admin/assets/img/ico/circle-outline-cross.png')}}" alt="ico" />
                                                            @endif
                                                        </span>
                                                        <span class="ml-3 heading-fifth mt-1">One to One session</span>
                                                    </div>
                                                    <div class="d-flex pb-3">
                                                        <span>
                                                            @if($course->standard_final == 'on')
                                                            <img height="19px" class="mt-2" src="{{asset('admin/assets/img/ico/circle-outline.png')}}" alt="ico" />
                                                            @else
                                                            <img height="19px" class="mt-2" src="{{asset('admin/assets/img/ico/circle-outline-cross.png')}}" alt="ico" />
                                                            @endif
                                                        </span>
                                                        <span class="ml-3 heading-fifth mt-1">Final test</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="view-bookings" >
                                                        ${{$course->standard_price ?? 0 }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                                <div class="panel" id="three-panel">

                                    <div class="container-fluid ">
                                        <div class="panel-title">Course Outline</div>
                                        @if($course->advance_class_title == "null")
                                            <div class="row mt-3">
                                                <div class="col-md-12 text-center mt-5">
                                                    <h3 class="">No advance package added yet</h3>
                                                </div>
                                            </div>
                                        @else
                                            <div class="row mt-3">
                                                <div class="col-md-12 pl-0">
                                                    <span class="heading-forth ml-2">Course outline</span>
                                                    <div id="main">
                                                        <div class="container-fluid m-0 p-0 border-bottom pb-3">
                                                        @foreach($course->outline as $outline)
                                                                @if($outline->level == 2)
                                                                    @if($outline->title == '' && $outline->explain == '')
                                                                        <p>No Course Outline added.</p>
                                                                    @else
                                                                    <div class="accordion" id="faq">
                                                                        <div class="card m-0 p-0">
                                                                            <div class="card-header" id="faqhead">
                                                                                <a href="#"
                                                                                    class="bg-color btn-header-link collapsed"
                                                                                    data-toggle="collapse" data-target="#faq121"
                                                                                    aria-expanded="true" aria-controls="faq121">
                                                                                    <img class="mr-2"
                                                                                        src="{{asset('admin/assets/img/ico/round.png')}}" />
                                                                                        {{$outline->title}}
                                                                                </a>
                                                                            </div>
                                                                            <div id="faq121" class="collapse show border-radius"
                                                                                aria-labelledby="faqhead3" data-parent="#faq121">
                                                                                <div class="card-body">
                                                                                {{$outline->explain}}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <span class="heading-fifth" style="font-weight: 600;">Timing</span>
                                                    <p class="paragraph-text-2 mt-1">{{ $course->advance_duration != null ? $course->advance_duration : 0 }} weeks ({{ $course->course_advance_days != null ? $course->course_advance_days : '---' }}) - {{date("g:i a", strtotime("$course->advance_start_time UTC"))}} to
                                                    {{date("g:i a", strtotime("$course->advance_end_time UTC"))}}</p>
                                                </div>
                                            </div>
                                            <div class="row mt-0 w-100 div-1">
                                                <div class="col-md-12">
                                                <table class="table table-borderless">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"></th>
                                                                <th scope="col w-150">Mon</th>
                                                                <th scope="col w-150">Tue </th>
                                                                <th scope="col w-150">Wed</th>
                                                                <th scope="col w-150">Thu</th>
                                                                <th scope="col w-150">Fri</th>
                                                                <th scope="col w-150">Sat</th>
                                                                <th scope="col w-150">Sun</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <!-- classes table time and topics -->
                                                            @foreach($course->advance_classes as $class)
                                                            <tr class="wordBreak">
                                                                <td class="pt-4">
                                                                    <div class="w-150">
                                                                        <span>{{date("g:i a", strtotime("$class->st_time UTC"))}} </span>
                                                                        <p class="mt-5">{{date("g:i a", strtotime("$class->et_time UTC"))}}</p>
                                                                    </div>
                                                                </td>

                                                                @if($class->day == 1)
                                                                <td class="m-0 p-0 pt-4">
                                                                    <div class="bg-color-apporve pl-2 pr-3 m-0 p-0 w-150">
                                                                        <span class="heading-fifth">
                                                                        {{$class->title}}
                                                                        </span>
                                                                        <p class="paragraph-text-1 mb-1">
                                                                        <small>{{date("g:i a", strtotime("$class->st_time UTC"))}}</small>
                                                                        </p>
                                                                        <p class="paragraph-text">
                                                                        {{$class->overview}}
                                                                        </p>
                                                                    </div>
                                                                </td>
                                                                @else
                                                                <td class="pt-4 pb-0">---</td>
                                                                @endif

                                                                @if($class->day == 2)
                                                                <td class="m-0 p-0 pt-4">
                                                                    <div class="bg-color-apporve1 pl-2 pr-3 m-0 p-0 w-150 w-150">
                                                                        <span class="heading-fifth">
                                                                        {{$class->title}}
                                                                        </span>
                                                                        <p class="paragraph-text-1 mb-1">
                                                                        <small>{{date("g:i a", strtotime("$class->st_time UTC"))}}</small>
                                                                        </p>
                                                                        <p class="paragraph-text">
                                                                        {{$class->overview}}
                                                                        </p>
                                                                    </div>
                                                                </td>
                                                                @else
                                                                <td class="pt-4 pb-0">---</td>
                                                                @endif

                                                                @if($class->day == 3)
                                                                <td class="m-0 p-0 pt-4">
                                                                    <div class="bg-color-apporve3 pl-2 pr-3 m-0 p-0 w-150">
                                                                        <span class="heading-fifth">
                                                                        {{$class->title}}
                                                                        </span>
                                                                        <p class="paragraph-text-1 mb-1">
                                                                        <small>{{date("g:i a", strtotime("$class->st_time UTC"))}}</small>
                                                                        </p>
                                                                        <p class="paragraph-text">
                                                                        {{$class->overview}}
                                                                        </p>
                                                                    </div>
                                                                </td>
                                                                @else
                                                                <td class="pt-4 pb-0">---</td>
                                                                @endif

                                                                @if($class->day == 4)
                                                                <td class="m-0 p-0 pt-4">
                                                                    <div class="bg-color-apporve pl-2 pr-3 m-0 p-0 w-150">
                                                                        <span class="heading-fifth">
                                                                        {{$class->title}}
                                                                        </span>
                                                                        <p class="paragraph-text-1 mb-1">
                                                                        <small>{{date("g:i a", strtotime("$class->st_time UTC"))}}</small>
                                                                        </p>
                                                                        <p class="paragraph-text">
                                                                        {{$class->overview}}
                                                                        </p>
                                                                    </div>
                                                                </td>
                                                                @else
                                                                <td class="pt-4 pb-0">---</td>
                                                                @endif

                                                                @if($class->day == 5)
                                                                <td class="m-0 p-0 pt-4">
                                                                    <div class="bg-color-apporve1 pl-2 pr-3 m-0 p-0 w-150">
                                                                        <span class="heading-fifth">
                                                                        {{$class->title}}
                                                                        </span>
                                                                        <p class="paragraph-text-1 mb-1">
                                                                        <small>{{date("g:i a", strtotime("$class->st_time UTC"))}}</small>
                                                                        </p>
                                                                        <p class="paragraph-text">
                                                                        {{$class->overview}}
                                                                        </p>
                                                                    </div>
                                                                </td>
                                                                @else
                                                                <td class="pt-4 pb-0">---</td>
                                                                @endif

                                                                @if($class->day == 6)
                                                                <td class="m-0 p-0 pt-4">
                                                                    <div class="bg-color-apporve3 pl-2 pr-3 m-0 p-0 w-150">
                                                                        <span class="heading-fifth">
                                                                        {{$class->title}}
                                                                        </span>
                                                                        <p class="paragraph-text-1 mb-1">
                                                                        <small>{{date("g:i a", strtotime("$class->st_time UTC"))}}</small>
                                                                        </p>
                                                                        <p class="paragraph-text">
                                                                        {{$class->overview}}
                                                                        </p>
                                                                    </div>
                                                                </td>
                                                                @else
                                                                <td class="pt-4 pb-0">---</td>
                                                                @endif

                                                                @if($class->day == 7)
                                                                <td class="m-0 p-0 pt-4">
                                                                    <div class="bg-color-apporve pl-2 pr-3 m-0 p-0 w-150">
                                                                        <span class="heading-fifth">
                                                                        {{$class->title}}
                                                                        </span>
                                                                        <p class="paragraph-text-1 mb-1">
                                                                        <small>{{date("g:i a", strtotime("$class->st_time UTC"))}}</small>
                                                                        </p>
                                                                        <p class="paragraph-text">
                                                                        {{$class->overview}}
                                                                        </p>
                                                                    </div>
                                                                </td>
                                                                @else
                                                                <td class="pt-4 pb-0">---</td>
                                                                @endif
                                                            </tr>
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row mt-5 pb-5">
                                                <div class="col-md-4">
                                                    <div class="d-flex pb-3">
                                                        <span>
                                                            @if($course->advance_home_work == 'on')
                                                            <img height="19px" class="mt-2" src="{{asset('admin/assets/img/ico/circle-outline.png')}}" alt="ico" />
                                                            @else
                                                            <img height="19px" class="mt-2" src="{{asset('admin/assets/img/ico/circle-outline-cross.png')}}" alt="ico" />
                                                            @endif
                                                        </span>
                                                        <span class="ml-3 heading-fifth mt-1">Home Work</span>
                                                    </div>
                                                    <div class="d-flex pb-3">
                                                        <span>
                                                            @if($course->advance_quiz == 'on')
                                                            <img height="19px" class="mt-2" src="{{asset('admin/assets/img/ico/circle-outline.png')}}" alt="ico" />
                                                            @else
                                                            <img height="19px" class="mt-2" src="{{asset('admin/assets/img/ico/circle-outline-cross.png')}}" alt="ico" />
                                                            @endif
                                                        </span>
                                                        <span class="ml-3 heading-fifth mt-1">Quiz</span>
                                                    </div>
                                                    <div class="d-flex pb-3">
                                                        <span>
                                                        @if($course->advance_note == 'on')
                                                            <img height="19px" class="mt-2" src="{{asset('admin/assets/img/ico/circle-outline.png')}}" alt="ico" />
                                                            @else
                                                            <img height="19px" class="mt-2" src="{{asset('admin/assets/img/ico/circle-outline-cross.png')}}" alt="ico" />
                                                            @endif
                                                        </span>
                                                        <span class="ml-3 heading-fifth mt-1">Note</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="d-flex pb-3">
                                                        <span>
                                                            @if($course->advance_one_one == 'on')
                                                            <img height="19px" class="mt-2" src="{{asset('admin/assets/img/ico/circle-outline.png')}}" alt="ico" />
                                                            @else
                                                            <img height="19px" class="mt-2" src="{{asset('admin/assets/img/ico/circle-outline-cross.png')}}" alt="ico" />
                                                            @endif
                                                        </span>
                                                        <span class="ml-3 heading-fifth mt-1">One to One session</span>
                                                    </div>
                                                    <div class="d-flex pb-3">
                                                        <span>
                                                            @if($course->advance_final == 'on')
                                                            <img height="19px" class="mt-2" src="{{asset('admin/assets/img/ico/circle-outline.png')}}" alt="ico" />
                                                            @else
                                                            <img height="19px" class="mt-2" src="{{asset('admin/assets/img/ico/circle-outline-cross.png')}}" alt="ico" />
                                                            @endif
                                                        </span>
                                                        <span class="ml-3 heading-fifth mt-1">Final test</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="view-bookings" >
                                                        ${{$course->advance_price ?? 0 }}
                                                    </div>
                                                </div>
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
        <!-- end section -->
               <!-- Modal reject-->
               <div class="modal fade" id="rejectCourseModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body  modal-bodys" style="height: 450px;">
                                <div class="container-fluid text-center pb-3 pt-3">
                                    <img src="{{asset('admin/assets/img/ico/cross-icon.png')}}" alt="verfiy" />
                                    <h3 class="mt-3 ">
                                        Why are you rejecting course?
                                    </h3>
                                    <p class="paragraph-text">
                                        Write allegation that why are you rejecting course
                                    </p>
                                    <textarea class="form-control" rows="5" placeholder="Write reason" id="c_reject_reason"></textarea>
                                    <div class="mt-4 d-flex" style="position: absolute;right: 30px;">
                                        <button class="cencel-btn w-150 mr-4" data-dismiss="modal">Cancel</button>
                                        <button class="schedule-btn w-150" onclick="changeCourseStatus(`{{$course->id}}`,2)">Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

@endsection
