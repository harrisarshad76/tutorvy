@extends('tutor.layouts.app')

@section('content')
<link href="{{ asset('assets/css/course.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
<style>
    .dropify-wrapper {
        height: 120px;
    }

</style>

<section>
    <div class="content-wrapper " style="overflow: hidden;">
        <div class="container-fluid ">
            <div class="row">
                <div class="col-md-12">
                    <p class="mr-3 heading-first">
                        < Edit Courses
                    </p>
                </div>
            </div>
            <form action="{{route('tutor.course.update',[$course->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row container-bg ml-1 mr-1 pt-3 pb-3">
                    <div class="col-md-12">
                        <h3 class="pt-2 pl-3">
                            Course details
                        </h3>
                    </div>
                    <div class="col-md-7">
                        <div class="container-fluid mt-3">
                          
                            <div class=" mt-3">
                                <span class="heading-forth">Course Title</span>
                                <div class="input-serachs mt-2">
                                    <input type="search" name="course_title" value="{{$course->title}}" placeholder="How to create your online courses in 3 steps." />
                                </div>
                                <div class="mt-3">
                                    <span class="heading-forth">Subject</span>
                                    <div class="input-options mt-2">
                                        <select name="subject">
                                            <option disabled selected>Subject</option>
                                            @foreach (Auth::user()->teach as $teach)
                                            <option value="{{$teach->subject_id}}" @if($teach->subject_id == $teach->subject->id) selected @endif>{{$teach->subject->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="mb-3">
                                        <label class="form-label heading-forth">About course</label>
                                        <textarea class="form-control texteara-s" name="about" rows="5">{{$course->about}}</textarea>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 mt-3">

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label heading-forth">Starting Date</label>
                                <div class="input-serachs ">
                                    <input type="text" name="start_date" id="strt_date" class="" required="" value="{{date('m/d/Y',strtotime($course->start_date))}}" onfocus="(this.type='date')">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label heading-forth">Available Seats</label>
                                <div class="input-serachs ">
                                    <input type="text" name="seats" class="" required value="{{$course->seats}}" placeholder="Seats" onfocus="(this.type='number')">
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label heading-forth">Intro Video URL</label>
                                <div class="input-serachs ">
                                    <input type="url"  name="video" data-default-file="{{asset($course->video)}}" placeholder="https://www.youtube.com/channel/UCTv6Gbid3HeUSYyLtV5sFOw/videos" required />
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for=""  class="form-label heading-forth ">Course Thumbnail</label>
                                <div class="input-serachs ">
                                    <input type="file" class="dropify" name="thumbnail" id="thumbnail" data-default-file="{{asset($course->thumbnail)}}"  >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="container-fluid">
                            <h3 class="">Course levels</h3>
                            <p class="paragraph-text">
                                There are many variations of passages of Lorem Ipsum available, but the majority have
                                suffered
                                alteration in some form, by injected humour, or randomized
                            </p>
                        </div>
                    </div>
                    <div class="col-md-5"></div>
                    <div class="col-md-12   mb-1">
                        <div class="container-fluid">
                            <div class="row">
                            
                                <div class="col-md-4">
                                    <label for="" class="form-label heading-forth"> Course Duration 
                                    </label>
                                    <div class="input-options ">
                                        <select name="basic_duration" id="basic_duration" disabled="disabled" style="padding:8px;">
                                            <option disabled selected>Course duration</option>
                                            <option @if($course->basic_duration == 1) selected @endif value="1">1 week</option>
                                            <option @if($course->basic_duration == 2) selected @endif value="2">2 week</option>
                                            <option @if($course->basic_duration == 3) selected @endif value="3">3 week</option>
                                            <option @if($course->basic_duration == 4) selected @endif value="4">4 week</option>
                                            <option @if($course->basic_duration == 5) selected @endif value="5">5 week</option>
                                            <option @if($course->basic_duration == 6) selected @endif value="6">6 week</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="form-label heading-forth"> Price</label>
                                    <div class="input-options ">
                                            <input type="number" name="basic_price" class="form-control" value="{{$course->basic_price}}" placeholder="Add course price">
                                    </div>
                                </div>
                                <div class="col-md-12  " id="week_schedule">
                                    <?php
                                     $round = $course->basic_duration;
                                     for($i = 1;$i<=$round;$i++){

                                   
                                    ?>
                                    <div class="d-flex mt-3 mb-2">
                                        <div class="">
                                            <label class="" for=""><b> Week {{$i}} : </b></label>
                                        </div>
                                        <div class="ml-4 custom-control custom-switch">
                                            <input type="checkbox" onclick="aleeert('monday_{{$i}}',{{$i}},'monday')" class="custom-control-input" name="monday_{{$i}}" id="monday_{{$i}}">
                                            <label class="custom-control-label" for="monday_{{$i}}">Monday</label>
                                        </div>
                                        <div class="ml-4 custom-control custom-switch">
                                            <input type="checkbox" onclick="aleeert('tuesday_{{$i}}',{{$i}},'tuesday')" class="custom-control-input" name="tuesday_{{$i}}" id="tuesday_{{$i}}">
                                            <label class="custom-control-label" for="tuesday_{{$i}}">Tuesday</label>
                                        </div>
                                        <div class="ml-4 custom-control custom-switch">
                                            <input type="checkbox" onclick="aleeert('wednesday_{{$i}}',{{$i}},'wednesday')" class="custom-control-input" name="wednesday_{{$i}}" id="wednesday_{{$i}}">
                                            <label class="custom-control-label" for="wednesday_{{$i}}">Wednesday</label>
                                        </div>
                                        <div class="ml-4 custom-control custom-switch">
                                            <input type="checkbox" onclick="aleeert('thursday_{{$i}}',{{$i}},'thursday')" class="custom-control-input" name="thursday_{{$i}}" id="thursday_{{$i}}">
                                            <label class="custom-control-label" for="thursday_{{$i}}">Thursday</label>
                                        </div>
                                        <div class="ml-4 custom-control custom-switch">
                                            <input type="checkbox" onclick="aleeert('friday_{{$i}}',{{$i}},'friday')" class="custom-control-input" name="friday_{{$i}}" id="friday_{{$i}}">
                                            <label class="custom-control-label" for="friday_{{$i}}">Friday</label>
                                        </div>
                                        <div class="ml-4 custom-control custom-switch">
                                            <input type="checkbox" onclick="aleeert('saturday_{{$i}}',{{$i}},'saturday')" class="custom-control-input" name="saturday_{{$i}}" id="saturday_{{$i}}">
                                            <label class="custom-control-label" for="saturday_{{$i}}">Saturday</label>
                                        </div>
                                        <div class="ml-4 custom-control custom-switch">
                                            <input type="checkbox" onclick="aleeert('sunday_{{$i}}',{{$i}},'sunday')" class="custom-control-input" name="sunday_{{$i}}" id="sunday_{{$i}}">
                                            <label class="custom-control-label" for="sunday_{{$i}}">Sunday</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">

                                        <div class=" mt-2 row" id="extraFields_{{$i}}">

                                            <div class="col-md-3 pl-0" id="bas_monday_{{$i}}">
                                                <div class="m-1 bg-price p-3">
                                                    <div class="row">
                                                        <div class="col-md-5 pt-2">
                                                            <span class="heading-forth "> Monday</span>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <div class="input-serachs ">
                                                                <input type="date" name="" class="dateCourse" required="" placeholder="From" onfocus="(this.type='date')" min="2022-01-13">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    
                                                    <div class="input-serachs mt-2">
                                                        <input type="txt" name="basic_class_title[1]" placeholder="Write Class Title" required="">
                                                    </div>
                                                    <div class="input-serachs mt-2 mb-2">
                                                        

                                                        <textarea class="form-control texteara-s" name="basic_class_overview[1]" rows="6" placeholder="Write Class Overview" required=""></textarea>
                                                        
                                                    </div>
                                                    <span class="heading-forth"> Timing</span>
                                                    <div class="input-options ">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input type="text" name="basic_class_start_time[1]" class="form-control texteara-s mt-2 pt-2 mb-2" required="" placeholder="From" onfocus="(this.type='time')">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="text" name="basic_class_end_time[1]" class="form-control texteara-s mt-2 pt-2 mb-2" required="" placeholder="To" onfocus="(this.type='time')">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                            </div>
                                        </div>

                                    </div>

                                    <?php
                                   }

                                   
                                    ?>

                                </div>
                                
                                
                                <div class="col-md-2">
                                    <div class="mt-3 row">
                                        <div class="col-md-1 ">
                                            <span class="checkbox-edit"> <input type="checkbox" @if($course->basic_home_work != null) checked @endif  name="basic_home_work" id=""> </span>
                                        </div>
                                        <div class="col-md-10 m-0 p-0 pl-2">
                                            <span class="paragraph-text"> Home work</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mt-3 row">
                                        <div class="col-md-1">
                                            <span class="checkbox-edit"> <input type="checkbox"  @if($course->basic_quiz != null) checked @endif name="basic_quiz" id=""> </span>
                                        </div>
                                        <div class="col-md-10 m-0 p-0 pl-2">
                                            <span class="paragraph-text"> Quiz</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mt-3 row">
                                        <div class="col-md-1">
                                            <span class="checkbox-edit"> <input type="checkbox" @if($course->basic_final != null) checked @endif   name="basic_final" id=""> </span>
                                        </div>
                                        <div class="col-md-10 m-0 p-0 pl-2">
                                            <span class="paragraph-text"> Final test</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mt-3 row">
                                        <div class="col-md-1">
                                            <span class="checkbox-edit"> <input type="checkbox" @if($course->basic_one_one != null) checked @endif name="basic_one_one" id=""> </span>
                                        </div>
                                        <div class="col-md-10 m-0 p-0 pl-2">
                                            <span class="paragraph-text"> One to one session with tutor</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mt-3 row">
                                        <div class="col-md-1">
                                            <span class="checkbox-edit"> <input type="checkbox" @if($course->basic_note != null) checked @endif name="basic_note" id=""> </span>
                                        </div>
                                        <div class="col-md-10 m-0 p-0 pl-2">
                                            <span class="paragraph-text"> Note</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="text-right mt-4 mb-4">
                            <input type="submit" class="btn-general pt-3 pb-3" value="Submit course" />
                        </div>
                    </div>
                </div>
                        
                <div class="container-fluid mt-3 pb-5">
                    <div class="row">
                        <div class="col-md-12 mb-1">
                                <div class="adddivs-1" id="basicNew">
                                    @forelse ($course->outline->where('level',1) as $i=>$basic)
                                        <div class="input-serachs mt-2">
                                            <input type="search" name="basic_title[]" value="{{$basic->title}}" placeholder="Write course outline" />
                                        </div>
                                        <textarea class="form-control texteara-s mt-2 pt-2 mb-2"
                                        name="basic_explain[]" rows="6">{{$basic->explain}}</textarea>
                                    @empty
                                        <div class="input-serachs mt-2">
                                            <input type="search" name="basic_title[1]" value="Title" placeholder="Write course outline" />
                                        </div>
                                        <textarea class="form-control texteara-s mt-2 pt-2 mb-2"
                                        name="basic_explain[1]" rows="6">Explain</textarea>
                                    @endforelse
                                </div>
                                <div class="text-center basicMore paid-text-1 btn w-100 mt-3 buttonAdd-1">
                                    <a href="#basicNew"> + Add more </a>
                                </div>

                                <div class="w-100 border-bottom">&nbsp;</div>

                                <h3 class="mt-3 pb-2">
                                    Timing 
                                </h3>
                                
                                <div class="input-options">
                                    <select class="js-multiSelect" id="basic_day" name="basic_days[]" multiple="multiple">
                                        <option value="1" {{(str_contains($course->basic_days , '1')) ? 'selected' : 0}} >Monday</option>
                                        <option value="2" {{(str_contains($course->basic_days , '2')) ? 'selected' : 0}}>Tuesday</option>
                                        <option value="3" {{(str_contains($course->basic_days , '3')) ? 'selected' : 0}}>Wednesday</option>
                                        <option value="4" {{(str_contains($course->basic_days , '4')) ? 'selected' : 0}}>Thursday</option>
                                        <option value="5" {{(str_contains($course->basic_days , '5')) ? 'selected' : 0}}>Friday</option>
                                        <option value="6" {{(str_contains($course->basic_days , '6')) ? 'selected' : 0}}>Saturday</option>
                                        <option value="7" {{(str_contains($course->basic_days , '7')) ? 'selected' : 0}}>Sunday</option>
                                    </select>
                                </div>
                                @if($course->basic_classes != null && $course->basic_classes != "" && $course->basic_classes!= []) 
                                    @foreach($course->basic_classes as $basic )
                                    <div id="bas_{{$basic->day}}">
                                        <span class="heading-forth"> {{$basic->day}}  </span>
                                        <div class="input-serachs mt-2">
                                            <input type="txt" name="basic_class_title[{{$basic->day}}]" value="{{$basic->title != null ? $basic->title : ''}}" placeholder="Write Class Title" required />
                                        </div>
                                        <div class="input-serachs mt-2 mb-2">
                                            <input type="txt" name="basic_class_overview[{{$basic->day}}]" value="{{$basic->overview != null ? $basic->overview : ''}}" placeholder="Write Class Overview" value="" required />
                                        </div>
                                        <span class="heading-forth"> Timing</span>
                                        <div class="input-options ">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" name="basic_class_start_time[{{$basic->day}}]" value="{{$basic->st_time != null ? $basic->st_time : ''}}" class="form-control texteara-s mt-2 pt-2 mb-2" required  placeholder="From"
                                                    onfocus="(this.type='time')"> 
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="basic_class_end_time[{{$basic->day}}]" value="{{$basic->et_time != null ? $basic->et_time : ''}}" class="form-control texteara-s mt-2 pt-2 mb-2" required placeholder="To"
                                                        onfocus="(this.type='time')">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                                <div class=" mt-2" id="extraFields"></div>



                        </div>

                        <!-- <div class="col-md-4 border-right mb-1">

                            <div class="text-center heading-forth">
                                standard
                            </div>
                            <div class="adddivs-1" id="standardNew">

                                @forelse ($course->outline->where('level',2) as $standard)
                                <div class="input-serachs mt-2">
                                    <input type="search" name="standard_title[]" value="{{$standard->title}}" placeholder="Write course outline" />
                                </div>
                                <textarea class="form-control texteara-s mt-2 pt-2 mb-2"
                                name="standard_explain[]" rows="6">{{$standard->explain}}</textarea>
                                @empty
                                <div class="input-serachs mt-2">
                                    <input type="search" name="standard_title[]" value="Title" placeholder="Write course outline" />
                                </div>
                                <textarea class="form-control texteara-s mt-2 pt-2 mb-2"
                                name="standard_explain[]" rows="6">Explain</textarea>
                                @endforelse
                            </div>

                            <div class="text-center standardMore paid-text-1 btn w-100 mt-3 buttonAdd-1">
                                <a href="#standardNew"> + Add more </a>
                            </div>

                            <div class="w-100 border-bottom">&nbsp;</div>

                            <div class="mt-3 row">
                                <div class="col-md-1 ">
                                    <span class="checkbox-edit"> <input type="checkbox" @if($course->standard_home_work != null) checked @endif  name="standard_home_work" id=""> </span>
                                </div>
                                <div class="col-md-11 m-0 p-0 pl-2">
                                    <span class="paragraph-text"> Home work</span>
                                </div>
                            </div>
                            <div class="mt-3 row">
                                <div class="col-md-1">
                                    <span class="checkbox-edit"> <input type="checkbox" @if($course->standard_quiz != null) checked @endif name="standard_quiz"  id=""> </span>
                                </div>
                                <div class="col-md-11 m-0 p-0 pl-2">
                                    <span class="paragraph-text"> Quiz</span>
                                </div>
                            </div>
                            <div class="mt-3 row">
                                <div class="col-md-1">
                                    <span class="checkbox-edit"> <input type="checkbox" @if($course->standard_final != null) checked @endif  name="standard_final" id=""> </span>
                                </div>
                                <div class="col-md-11 m-0 p-0 pl-2">
                                    <span class="paragraph-text"> Final test</span>
                                </div>
                            </div>
                            <div class="mt-3 row">
                                <div class="col-md-1">
                                    <span class="checkbox-edit"> <input type="checkbox"  @if($course->standard_one_one != null) checked @endif name="standard_one_one" id=""> </span>
                                </div>
                                <div class="col-md-11 m-0 p-0 pl-2">
                                    <span class="paragraph-text"> One to one session with tutor</span>
                                </div>
                            </div>
                            <div class="mt-3 row">
                                <div class="col-md-1">
                                    <span class="checkbox-edit"> <input type="checkbox" @if($course->standard_note != null) checked @endif name="standard_note" id=""> </span>
                                </div>
                                <div class="col-md-11 m-0 p-0 pl-2">
                                    <span class="paragraph-text"> Note</span>
                                </div>
                            </div>
                            <div class="input-options mt-3">
                                <select name="standard_duration">
                                    <option disabled selected>Course duration</option>
                                    <option @if($course->standard_duration == 1) selected @endif value="1">1 week</option>
                                    <option @if($course->standard_duration == 2) selected @endif value="2">2 week</option>
                                    <option @if($course->standard_duration == 3) selected @endif value="3">3 week</option>
                                    <option @if($course->standard_duration == 4) selected @endif value="4">4 week</option>
                                    <option @if($course->standard_duration == 5) selected @endif value="5">5 week</option>
                                    <option @if($course->standard_duration == 6) selected @endif value="6">6 week</option>
                                </select>
                            </div>

                            <h3 class="mt-3 pb-2">
                                Timing
                            </h3>
                            <div class="input-options">
                                <select class="js-multiSelect" id="standard_day" name="standard_days[]" multiple="multiple">
                                    <option value="1" {{(str_contains($course->standard_days , '1')) ? 'selected' : 0}} >Monday</option>
                                    <option value="2" {{(str_contains($course->standard_days , '2')) ? 'selected' : 0}}>Tuesday</option>
                                    <option value="3" {{(str_contains($course->standard_days , '3')) ? 'selected' : 0}}>Wednesday</option>
                                    <option value="4" {{(str_contains($course->standard_days , '4')) ? 'selected' : 0}}>Thursday</option>
                                    <option value="5" {{(str_contains($course->standard_days , '5')) ? 'selected' : 0}}>Friday</option>
                                    <option value="6" {{(str_contains($course->standard_days , '6')) ? 'selected' : 0}}>Saturday</option>
                                    <option value="7" {{(str_contains($course->standard_days , '7')) ? 'selected' : 0}}>Sunday</option>
                                </select>
                            </div>

                            @if($course->standard_classes != null && $course->standard_classes != "" && $course->standard_classes!= []) 
                                @foreach($course->standard_classes as $standard )
                                <div id="standard_{{$standard->day}}">
                                    <span class="heading-forth"> {{$standard->day}}  </span>
                                    <div class="input-serachs mt-2">
                                        <input type="txt" name="standard_class_title[{{$standard->day}}]" value="{{$standard->title}}" placeholder="Write Class Title" required />
                                    </div>
                                    <div class="input-serachs mt-2 mb-2">
                                        <input type="txt" name="standard_class_overview[{{$standard->day}}]" value="{{$standard->overview}}" placeholder="Write Class Overview" value="" required />
                                    </div>
                                    <span class="heading-forth"> Timing</span>
                                    <div class="input-options ">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" name="standard_class_start_time[{{$standard->day}}]" value="{{$standard->st_time}}" class="form-control texteara-s mt-2 pt-2 mb-2" required  placeholder="From"
                                                onfocus="(this.type='time')">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="standard_class_end_time[{{$standard->day}}]" value="{{$standard->et_time}}" class="form-control texteara-s mt-2 pt-2 mb-2" required placeholder="To"
                                                    onfocus="(this.type='time')">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                            
                            
                            <div class=" mt-2" id="standard_extraFields"></div>

                            <div class="input-options mt-2">
                                
                                <h3 class="mt-3 pb-2">
                                    Price
                                </h3>
                                <div class="input-options mt-2">
                                <input type="number" name="standard_price" class="form-control" value="{{$course->standard_price}}" placeholder="Add course price">
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <input type="submit" class="schedule-btn w-50 " value="Update course" />
                            </div>

                        </div>

                        <div class="col-md-4 border-right mb-1">

                            <div class="text-center heading-forth">
                                advance
                            </div>
                            <div class="adddivs-1" id="advNew">
                                @forelse ($course->outline->where('level',3) as $advance)
                                <div class="input-serachs mt-2">
                                    <input type="search" name="advance_title[]" value="{{$advance->title}}" placeholder="Write course outline" />
                                </div>
                                <textarea class="form-control texteara-s mt-2 pt-2 mb-2"
                                name="advance_explain[]" rows="6">{{$advance->explain}}</textarea>
                                @empty
                                <div class="input-serachs mt-2">
                                    <input type="search" name="advance_title[]" value="Title" placeholder="Write course outline" />
                                </div>
                                <textarea class="form-control texteara-s mt-2 pt-2 mb-2"
                                name="advance_explain[]" rows="6">Explain</textarea>
                                @endforelse
                            </div>
                            <div class="text-center paid-text-1 advMore btn w-100 mt-3 buttonAdd-1">
                                <a href="#advNew"> + Add more </a>
                            </div>
                            <div class="adddiv-1"></div>
                            <div class="w-100 border-bottom">&nbsp;</div>

                            <div class="mt-3 row">
                                <div class="col-md-1 ">
                                    <span class="checkbox-edit"> <input type="checkbox"  @if($course->advance_home_work != null) checked @endif name="advance_home_work" id=""> </span>
                                </div>
                                <div class="col-md-11 m-0 p-0 pl-2">
                                    <span class="paragraph-text"> Home work</span>
                                </div>
                            </div>
                            <div class="mt-3 row">
                                <div class="col-md-1">
                                    <span class="checkbox-edit"> <input type="checkbox" @if($course->advance_quiz != null) checked @endif name="advance_quiz" id=""> </span>
                                </div>
                                <div class="col-md-11 m-0 p-0 pl-2">
                                    <span class="paragraph-text"> Quiz</span>
                                </div>
                            </div>
                            <div class="mt-3 row">
                                <div class="col-md-1">
                                    <span class="checkbox-edit"> <input type="checkbox" @if($course->advance_final != null) checked @endif name="advance_final" id=""> </span>
                                </div>
                                <div class="col-md-11 m-0 p-0 pl-2">
                                    <span class="paragraph-text"> Final test</span>
                                </div>
                            </div>
                            <div class="mt-3 row">
                                <div class="col-md-1">
                                    <span class="checkbox-edit">
                                        <input type="checkbox" @if($course->advance_one_one != null) checked @endif  name="advance_one_one" id="">
                                    </span>
                                </div>
                                <div class="col-md-11 m-0 p-0 pl-2">
                                    <span class="paragraph-text"> One to one session with tutor</span>
                                </div>
                            </div>
                            <div class="mt-3 row">
                                <div class="col-md-1">
                                    <span class="checkbox-edit">
                                        <input type="checkbox" @if($course->advance_note != null) checked @endif name="advance_note" id="">
                                    </span>
                                </div>
                                <div class="col-md-11 m-0 p-0 pl-2">
                                    <span class="paragraph-text"> Note</span>
                                </div>
                            </div>
                            <div class="input-options mt-3">
                                <select name="advance_duration">
                                    <option disabled selected>Course duration</option>
                                    <option @if($course->advance_duration == 1) selected @endif value="1">1 week</option>
                                    <option @if($course->advance_duration == 2) selected @endif value="2">2 week</option>
                                    <option @if($course->advance_duration == 3) selected @endif value="3">3 week</option>
                                    <option @if($course->advance_duration == 4) selected @endif value="4">4 week</option>
                                    <option @if($course->advance_duration == 5) selected @endif value="5">5 week</option>
                                    <option @if($course->advance_duration == 6) selected @endif value="6">6 week</option>
                                </select>
                            </div>


                            <h3 class="mt-3 pb-2">
                                Timing
                            </h3>
                            <div class="input-options">
                                <select class="js-multiSelect" id="advance_day" name="advance_days[]" multiple="multiple">
                                    <option value="1" {{(str_contains($course->advance_days , '1')) ? 'selected' : 0}} >Monday</option>
                                    <option value="2" {{(str_contains($course->advance_days , '2')) ? 'selected' : 0}}>Tuesday</option>
                                    <option value="3" {{(str_contains($course->advance_days , '3')) ? 'selected' : 0}}>Wednesday</option>
                                    <option value="4" {{(str_contains($course->advance_days , '4')) ? 'selected' : 0}}>Thursday</option>
                                    <option value="5" {{(str_contains($course->advance_days , '5')) ? 'selected' : 0}}>Friday</option>
                                    <option value="6" {{(str_contains($course->advance_days , '6')) ? 'selected' : 0}}>Saturday</option>
                                    <option value="7" {{(str_contains($course->advance_days , '7')) ? 'selected' : 0}}>Sunday</option>
                                </select>
                            </div>

                            @if($course->advance_classes != null && $course->advance_classes != "" && $course->advance_classes!= []) 
                                @foreach($course->advance_classes as $advance)
                                <div id="advance_{{$advance->day}}">
                                    <span class="heading-forth"> {{$advance->day}} </span>
                                    <div class="input-serachs mt-2">
                                        <input type="txt" name="advance_class_title[{{$advance->day}}]"  value="{{$advance->title}}" placeholder="Write Class Title" required />
                                    </div>
                                    <div class="input-serachs mt-2 mb-2">
                                        <input type="txt" name="advance_class_overview[{{$advance->day}}]" value="{{$advance->overview}}" placeholder="Write Class Overview" required />
                                    </div>
                                    <span class="heading-forth"> Timing</span>
                                    <div class="input-options ">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" name="advance_class_start_time[{{$advance->day}}]" value="{{$advance->ad_time}}" class="form-control texteara-s mt-2 pt-2 mb-2" required  placeholder="From"
                                                onfocus="(this.type='time')">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="advance_class_end_time[{{$advance->day}}]" value="{{$advance->et_time}}" class="form-control texteara-s mt-2 pt-2 mb-2" required placeholder="To"
                                                    onfocus="(this.type='time')">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                            <div class=" mt-2" id="advance_extraFields"></div>

                            <div class="input-options mt-2">
                                <h3 class="mt-3 pb-2">
                                    Price
                                </h3>
                                <div class="input-options mt-2">
                                    <input type="number" name="advance_price" class="form-control" value="{{$course->advance_price}}" placeholder="Add course price">
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>

            </form>

        </div>
    </div>
</section>

<!-- end section -->
@endsection

@section('scripts')
@include('js_files.tutor.course')

<script>
   


    var counter = {{$course->outline->count() - 2}};
    var counter2 = 1;
    var counter3 = 1;
    $(".basicMore").click(function() {
        counter++;
        var html = `
                    <div class="input-serachs mt-2">
                        <input type="search" name="basic_title[]" value="title" placeholder="Write course outline" />
                    </div>
                    <textarea class="form-control texteara-s mt-2 pt-2 mb-2"
                    name="basic_explain[]" rows="6">Explain</textarea>`

        $('#basicNew').append(html);
    });
    $(".standardMore").click(function() {
        counter2++;
        var html = ` <div class="adddivs-1" id="rec_` + counter2 + `">
                    <div class="input-serachs mt-2">
                        <input type="search" name="standard_title[` + counter2 + `]"  placeholder="Write course outline" />
                    </div>
                    <textarea class="form-control texteara-s mt-2 pt-2 mb-2"
                    name="standard_explain[` + counter2 + `]" rows="6">Explaine</textarea>
                </div>`

        $('#standardNew').append(html);
    });
    $(".advMore").click(function() {
        counter3++;
        var html = ` <div class="adddivs-1" id="rec_` + counter3 + `">
                    <div class="input-serachs mt-2">
                        <input type="search" name="advance_title[` + counter3 + `]"  placeholder="Write course outline" />
                    </div>
                    <textarea class="form-control texteara-s mt-2 pt-2 mb-2"
                    name="advance_explain[` + counter3 + `]" rows="6">Explaine</textarea>
                </div>`

        $('#advNew').append(html);
    });


$(document).ready(function(){
    
})

</script>
@endsection
