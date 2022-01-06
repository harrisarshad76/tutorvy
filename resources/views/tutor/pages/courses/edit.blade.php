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
                                    <input type="url"  name="video" data-default-file="{{asset($course->video)}}" value="{{$course->video}}" placeholder="https://www.youtube.com/channel/UCTv6Gbid3HeUSYyLtV5sFOw/videos" required />
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
                                        <select name="basic_duration" id="basic_duration" readonly style="padding:8px;">
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
                                            <input type="checkbox" onclick="aleeert('monday_{{$i}}',{{$i}},'monday',1)" class="custom-control-input" name="monday_{{$i}}" id="monday_{{$i}}">
                                            <label class="custom-control-label" for="monday_{{$i}}">Monday</label>
                                        </div>
                                        <div class="ml-4 custom-control custom-switch">
                                            <input type="checkbox" onclick="aleeert('tuesday_{{$i}}',{{$i}},'tuesday',2)" class="custom-control-input" name="tuesday_{{$i}}" id="tuesday_{{$i}}">
                                            <label class="custom-control-label" for="tuesday_{{$i}}">Tuesday</label>
                                        </div>
                                        <div class="ml-4 custom-control custom-switch">
                                            <input type="checkbox" onclick="aleeert('wednesday_{{$i}}',{{$i}},'wednesday',3)" class="custom-control-input" name="wednesday_{{$i}}" id="wednesday_{{$i}}">
                                            <label class="custom-control-label" for="wednesday_{{$i}}">Wednesday</label>
                                        </div>
                                        <div class="ml-4 custom-control custom-switch">
                                            <input type="checkbox" onclick="aleeert('thursday_{{$i}}',{{$i}},'thursday',4)" class="custom-control-input" name="thursday_{{$i}}" id="thursday_{{$i}}">
                                            <label class="custom-control-label" for="thursday_{{$i}}">Thursday</label>
                                        </div>
                                        <div class="ml-4 custom-control custom-switch">
                                            <input type="checkbox" onclick="aleeert('friday_{{$i}}',{{$i}},'friday',5)" class="custom-control-input" name="friday_{{$i}}" id="friday_{{$i}}">
                                            <label class="custom-control-label" for="friday_{{$i}}">Friday</label>
                                        </div>
                                        <div class="ml-4 custom-control custom-switch">
                                            <input type="checkbox" onclick="aleeert('saturday_{{$i}}',{{$i}},'saturday',6)" class="custom-control-input" name="saturday_{{$i}}" id="saturday_{{$i}}">
                                            <label class="custom-control-label" for="saturday_{{$i}}">Saturday</label>
                                        </div>
                                        <div class="ml-4 custom-control custom-switch">
                                            <input type="checkbox" onclick="aleeert('sunday_{{$i}}',{{$i}},'sunday',7)" class="custom-control-input" name="sunday_{{$i}}" id="sunday_{{$i}}">
                                            <label class="custom-control-label" for="sunday_{{$i}}">Sunday</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">

                                        <div class=" mt-2 row" id="extraFields_{{$i}}">
 
                                         
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
                        
                <!-- <div class="container-fluid mt-3 pb-5">
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
                    </div>
                </div> -->

            </form>

        </div>
    </div>
</section>

<!-- end section -->
@endsection

@section('scripts')
@include('js_files.tutor.course')

<script>
   

    var course = {!! $course !!} ;

    let classes = course.basic_classes; 
    console.log(classes)       
    getClasses();          
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
  

    function getClasses(){
        var html2="";
        var text ="";
        var text1 ="";

        for(var i = 0 ; i < classes.length ; i++){
            
            switch(classes[i].day) {
            case 1:
                text = "Monday";
                text1 = "monday";

                break;
            case 2:
                text = "Tuesday";
                text1 = "tuesday";

                break;
            case 3:
                text = "Wednesday";
                text1 = "wednesday";

                break;
            case 4:
                text = "Thursday";
                text1 = "thursday";

                break;
            case 5:
                text = "Friday";
                text1 = "friday";

                break;
            case 6:
                text = "Saturday";
                text1 = "saturday";

                break;
            case 7:
                text = "Sunday";
                text1 = "sunday";

                break;
            default:
                text = "---";
                text1 = "---";

        }
        $('#'+text1+`_`+classes[i].class_week).prop("checked", true)
        html2 = `<div class="col-md-3 pl-0" id="bas_` + text1 + `_`+classes[i].class_week+`">
                    <div class="m-1 bg-price p-3">
                        <div class="row">
                            <div class="col-md-5 pt-2">
                                <span class="heading-forth "> `+text+`</span>
                            </div>
                            <div class="col-md-7">
                                <div class="input-serachs ">
                                    <input type="date" name="basic_class_date[` + classes[i].class_week + `][`+classes[i].day+`]" class="dateCourse" required="" placeholder="From" onfocus="(this.type='date')" value="`+classes[i].class_date+`">
                                </div>
                            </div>
                        </div>
                        <div class="input-serachs mt-2">
                            <input type="txt" name="basic_class_title[` + classes[i].class_week + `][`+classes[i].day+`]" placeholder="Write Class Title" required value="`+classes[i].class_title+`" />
                        </div>
                        <div class="input-serachs mt-2 mb-2">
                            <textarea class="form-control texteara-s"
                                name="basic_class_overview[` + classes[i].class_week + `][`+classes[i].day+`]" rows="6" placeholder="Write Class Overview" required>`+classes[i].class_overview+`</textarea>
                        </div>
                        <span class="heading-forth"> Timing</span>
                        <div class="input-options ">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" name="basic_class_start_time[` + classes[i].class_week + `][`+classes[i].day+`]" class="form-control texteara-s mt-2 pt-2 mb-2" required  placeholder="From"
                                    onfocus="(this.type='time')" value="`+classes[i].class_time+`">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="basic_class_end_time[` + classes[i].class_week + `][`+classes[i].day+`]" class="form-control texteara-s mt-2 pt-2 mb-2" required placeholder="To"
                                        onfocus="(this.type='time')" value="`+classes[i].class_end_time+`">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
                
                $("#extraFields_"+classes[i].class_week).append(html2);

        }
        
    }
    
    function aleeert(id,i,day,day_id){

var html2="";
var text ="";

$("#"+id).toggleClass("checked");

if($("#"+id).hasClass("checked")){
    
    switch(day) {
        case 'monday':
            text = "Monday";
            break;
        case "tuesday":
            text = "Tuesday";
            break;
        case "wednesday":
            text = "Wednesday";
            break;
        case 'thursday':
            text = "Thursday";
            break;
        case 'friday':
            text = "Friday";
            break;
        case 'saturday':
            text = "Saturday";
            break;
        case 'sunday':
            text = "Sunday";
            break;
        default:
            text = "---";
    }
    html2 += `<div class="col-md-3 pl-0" id="bas_` + id + `">
                <div class="m-1 bg-price p-3">
                    <div class="row">
                        <div class="col-md-5 pt-2">
                            <span class="heading-forth "> `+text+`</span>
                        </div>
                        <div class="col-md-7">
                            <div class="input-serachs ">
                                <input type="date" name="basic_class_date[` + i + `][`+day_id+`]" class="dateCourse" required="" placeholder="From" onfocus="(this.type='date')">
                            </div>
                        </div>
                    </div>
                    <div class="input-serachs mt-2">
                        <input type="txt" name="basic_class_title[` + i + `][`+day_id+`]" placeholder="Write Class Title" required />
                    </div>
                    <div class="input-serachs mt-2 mb-2">
                        <textarea class="form-control texteara-s"
                            name="basic_class_overview[` + i + `][`+day_id+`]" rows="6" placeholder="Write Class Overview" required></textarea>
                    </div>
                    <span class="heading-forth"> Timing</span>
                    <div class="input-options ">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="basic_class_start_time[` + i + `][`+day_id+`]" class="form-control texteara-s mt-2 pt-2 mb-2" required  placeholder="From"
                                onfocus="(this.type='time')">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="basic_class_end_time[` + i + `][`+day_id+`]" class="form-control texteara-s mt-2 pt-2 mb-2" required placeholder="To"
                                    onfocus="(this.type='time')">
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;
    $("#extraFields_"+i).append(html2);
    var tuna = $("#strt_date").val();
    $(".dateCourse")[0].setAttribute('min', tuna);
}
else{
    $("#extraFields_"+i).find("#bas_"+id).remove();
}
}
    // function aleeert(id,i,day){

    //     var html2="";
    //     var text ="";

    //     $("#"+id).toggleClass("checked");

    //     if($("#"+id).hasClass("checked")){
            
    //         switch(day) {
    //             case 'monday':
    //                 text = "Monday";
    //                 break;
    //             case "tuesday":
    //                 text = "Tuesday";
    //                 break;
    //             case "wednesday":
    //                 text = "Wednesday";
    //                 break;
    //             case 'thursday':
    //                 text = "Thursday";
    //                 break;
    //             case 'friday':
    //                 text = "Friday";
    //                 break;
    //             case 'saturday':
    //                 text = "Saturday";
    //                 break;
    //             case 'sunday':
    //                 text = "Sunday";
    //                 break;
    //             default:
    //                 text = "---";
    //         }
    //         html2 += `<div class="col-md-3 pl-0" id="bas_` + id + `">
    //                     <div class="m-1 bg-price p-3">
    //                         <div class="row">
    //                             <div class="col-md-5 pt-2">
    //                                 <span class="heading-forth "> `+text+`</span>
    //                             </div>
    //                             <div class="col-md-7">
    //                                 <div class="input-serachs ">
    //                                     <input type="date" name="" class="dateCourse" required="" placeholder="From" onfocus="(this.type='date')">
    //                                 </div>
    //                             </div>

    //                         </div>
                            
    //                         <div class="input-serachs mt-2">
    //                             <input type="txt" name="basic_class_title[` + i + `]" placeholder="Write Class Title" required />
    //                         </div>
    //                         <div class="input-serachs mt-2 mb-2">
                                

    //                             <textarea class="form-control texteara-s"
    //                                 name="basic_class_overview[` + i + `]" rows="6" placeholder="Write Class Overview" required></textarea>
                                
    //                         </div>
    //                         <span class="heading-forth"> Timing</span>
    //                         <div class="input-options ">
    //                             <div class="row">
    //                                 <div class="col-md-6">
    //                                     <input type="text" name="basic_class_start_time[` + i + `]" class="form-control texteara-s mt-2 pt-2 mb-2" required  placeholder="From"
    //                                     onfocus="(this.type='time')">
    //                                 </div>
    //                                 <div class="col-md-6">
    //                                     <input type="text" name="basic_class_end_time[` + i + `]" class="form-control texteara-s mt-2 pt-2 mb-2" required placeholder="To"
    //                                         onfocus="(this.type='time')">
    //                                 </div>
    //                             </div>
    //                         </div>
    //                     </div>
                    
    //                 </div>`;
    //         $("#extraFields_"+i).append(html2);
    //         var tuna = $("#strt_date").val();
    //         $(".dateCourse")[0].setAttribute('min', tuna);
    //     }
    //     else{
    //         $("#extraFields_"+i).find("#bas_"+id).remove();
    //     }
    // }



</script>
@endsection
