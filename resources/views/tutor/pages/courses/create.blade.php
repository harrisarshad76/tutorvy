@extends('tutor.layouts.app')

@section('content')
<link href="{{ asset('assets/css/course.css') }}" rel="stylesheet">

<style>
    .dropify-wrapper{
        height:120px;
    }
    .paid-text-1 a{
        text-decoration:none;
        color:#00132D ;
    }
    #Dushman{
        position: absolute;
        background: red;
        color: #fff;
        border: 1px solid red;
        padding: 6px 25px;
        border-radius: 9px;
        z-index: 9;
        left: 16px;
        top: 24px;
        display:none;
    }


</style>
  <!--section start  -->

  <div class="container-fluid pb-4">
    <h1 class="mt-5">
        Add Course </h1>
</div>
<div class="container-fluid mt-3">
    <form action="{{route('tutor.storecourse')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row container-bg ml-1 mr-1 pt-3 pb-3">
            <div class="col-md-12">
                <h3>
                    Course details
                </h3>
            </div>
            <div class="col-md-7">
                <div class="container-fluid mt-3">
                   
                    <div class=" mt-5">
                        <span class="heading-forth">Course Title</span>
                        <div class="input-serachs mt-2">
                            <input type="text" name="course_title" placeholder="How to create your online courses in 3 steps." required />
                        </div>
                        <div class="mt-3">
                            <span class="heading-forth">Subject</span>
                            <div class="input-options mt-2">
                                <select name="subject" required>
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
                                <textarea class="form-control texteara-s" name="about" rows="5" placeholder='Course Description' required></textarea>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 mt-5">

                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label heading-forth">Starting Date</label>
                        <div class="input-serachs ">
                            <input type="text" name="start_date" id="strt_date" class="" required="" placeholder="From" onfocus="(this.type='date')" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label heading-forth">Available Seats</label>
                        <div class="input-serachs ">
                            <input type="text" name="seats" class="" required placeholder="Seats" onfocus="(this.type='number')" required>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label class="form-label heading-forth">Intro Video URL</label>
                        <div class="input-serachs ">
                            <input type="url"  name="video" placeholder="https://www.youtube.com/channel/UCTv6Gbid3HeUSYyLtV5sFOw/videos" required />
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for=""  class="form-label heading-forth ">Course Thumbnail</label>
                        <div class="input-serachs ">
                            <input type="file" class="dropify" name="thumbnail" id="thumbnail" required >
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="container-fluid">
                    <h3 class="">Course Outline</h3>
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
                            <label for="" class="form-label heading-forth"> Course Duration <a href="#"  id="toro"  class="pull-right">
                                <i class="fa fa-question-circle-o" aria-hidden="true"></i></a>
                            </label>
                            <small id="Dushman">
                                This will only be enabled if start course date value is given
                            </small> 
                            <div class="input-options ">
                                <select name="basic_duration" id="basic_duration" disabled="disabled" style="padding:8px;">
                                    <option disabled selected required>Course Duration</option>
                                    <option value="1">1 week</option>
                                    <option value="2">2 week</option>
                                    <option value="3">3 week</option>
                                    <option value="4">4 week</option>
                                    <option value="5">5 week</option>
                                    <option value="6">6 week</option>
                                </select>
                            </div>
                        </div>
                           
                        <div class="col-md-4">
                            <label for="" class="form-label heading-forth"> Price</label>
                            <div class="input-options ">
                                <input type="number" name="basic_price" class="form-control" placeholder="Add course price">
                            </div>
                        </div>
                        <div class="col-md-12  " id="week_schedule">
                        </div>
                        
                        
                        <div class="col-md-2">
                            <div class="mt-3 row">
                                <div class="col-md-1 ">
                                    <span class="checkbox-edit"> <input type="checkbox" name="basic_home_work" id=""> </span>
                                </div>
                                <div class="col-md-10 ">
                                    <span class="paragraph-text"> Home work</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mt-3 row">
                                <div class="col-md-1">
                                    <span class="checkbox-edit"> <input type="checkbox" name="basic_quiz" id=""> </span>
                                </div>
                                <div class="col-md-10 ">
                                    <span class="paragraph-text"> Quiz</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mt-3 row">
                                <div class="col-md-1">
                                    <span class="checkbox-edit"> <input type="checkbox"  name="basic_final" id=""> </span>
                                </div>
                                <div class="col-md-10 ">
                                    <span class="paragraph-text"> Final test</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mt-3 row">
                                <div class="col-md-1">
                                    <span class="checkbox-edit"> <input type="checkbox"  name="basic_one_one" id=""> </span>
                                </div>
                                <div class="col-md-10 ">
                                    <span class="paragraph-text"> One to one session with tutor</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mt-3 row">
                                <div class="col-md-1">
                                    <span class="checkbox-edit"> <input type="checkbox"  name="basic_note" id=""> </span>
                                </div>
                                <div class="col-md-10 ">
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
    </form>
</div>

<!-- end section -->
@endsection

<!-- Extra js to perfome function using ajax. -->
@section('js')
@include('js_files.tutor.course')
<script type="text/javascript">

$("#strt_date").change(function(){
    if($("#strt_date").val() != "" && $("#strt_date").val() != "[]" && $("#strt_date").val() != null){
        $("#basic_duration").removeAttr('disabled','disabled');
    }
    else{
        $("#basic_duration").attr('disabled','disabled');
    }
});
$("#thumbnail").change(
    function () {
    //Get reference of FileUpload.
    var fileUpload = document.getElementById("thumbnail");

    //Check whether the file is valid Image.
    var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png|.gif)$");
    if (regex.test(fileUpload.value.toLowerCase())) {

        //Check whether HTML5 is supported.
        if (typeof (fileUpload.files) != "undefined") {
            //Initiate the FileReader object.
            var reader = new FileReader();
            //Read the contents of Image File.
            reader.readAsDataURL(fileUpload.files[0]);
            reader.onload = function (e) {
                //Initiate the JavaScript Image object.
                var image = new Image();

                //Set the Base64 string return from FileReader as source.
                image.src = e.target.result;

                //Validate the File Height and Width.
                image.onload = function () {
                    var height = this.height;
                    var width = this.width;
                    if (height > 500 || width > 800) {
                        // toastr.warning("Height and Width must not exceed 100px.");
                        $("#fileUpload").val("");
                        return false;
                    }
                    $("#fileUpload").val();

                    // alert("Uploaded image has valid Height and Width.");
                    return true;
                };

            }
        } else {
            // toastr.warning("This browser does not support HTML5.");
            return false;
        }
    } else {
        // toastr.warning("Please select a valid Image file.");
        return false;
    }
}
);
$("#basic_duration").change(function(){
    
 let val = $(this).val();
 $("#week_schedule").html("");
 let hhtml = "";
    for(var i =1; i<= val; i++) {
        // hhtml =`<div class="col-md-4 mt-3">
        //             <h3>Select  week `+i+` Days </h3>
        //             <div class='input-options'>
        //                 <select class="js-multiSelect p-5" id="basic_day_`+i+`" name="basic_days[]" multiple="multiple" required onChange="check(`+i+`)">
        //                         <option value="1"  >Monday</option>
        //                         <option value="2">Tuesday</option>
        //                         <option value="3">Wednesday</option>
        //                         <option value="4">Thursday</option>
        //                         <option value="5">Friday</option>
        //                         <option value="6">Saturday</option>
        //                         <option value="7">Sunday</option>
        //                 </select>
        //             </div>
        //         </div>
        //         <div class="col-md-12 mt-2 mb-2">
        //             <div class="row" id="extraFields_`+i+`"></div>
        //         </div>`;

        hhtml = `<div class="d-flex mt-3 mb-2">
                    <div class="">
                        <label class="" for=""><b> Week `+i+` : </b></label>
                    </div>
                    <div class="ml-4 custom-control custom-switch">
                        <input type="checkbox" onclick="aleeert('monday_`+i+`',`+i+`,'monday',1)" class="custom-control-input" name="monday_`+i+`" id="monday_`+i+`">
                        <label class="custom-control-label" for="monday_`+i+`">Monday</label>
                    </div>
                    <div class="ml-4 custom-control custom-switch">
                        <input type="checkbox" onclick="aleeert('tuesday_`+i+`',`+i+`,'tuesday',2)" class="custom-control-input" name="tuesday_`+i+`" id="tuesday_`+i+`">
                        <label class="custom-control-label" for="tuesday_`+i+`">Tuesday</label>
                    </div>
                    <div class="ml-4 custom-control custom-switch">
                        <input type="checkbox" onclick="aleeert('wednesday_`+i+`',`+i+`,'wednesday',3)" class="custom-control-input" name="wednesday_`+i+`" id="wednesday_`+i+`">
                        <label class="custom-control-label" for="wednesday_`+i+`">Wednesday</label>
                    </div>
                    <div class="ml-4 custom-control custom-switch">
                        <input type="checkbox" onclick="aleeert('thursday_`+i+`',`+i+`,'thursday',4)" class="custom-control-input" name="thursday_`+i+`" id="thursday_`+i+`">
                        <label class="custom-control-label" for="thursday_`+i+`">Thursday</label>
                    </div>
                    <div class="ml-4 custom-control custom-switch">
                        <input type="checkbox" onclick="aleeert('friday_`+i+`',`+i+`,'friday',5)" class="custom-control-input" name="friday_`+i+`" id="friday_`+i+`">
                        <label class="custom-control-label" for="friday_`+i+`">Friday</label>
                    </div>
                    <div class="ml-4 custom-control custom-switch">
                        <input type="checkbox" onclick="aleeert('saturday_`+i+`',`+i+`,'saturday',6)" class="custom-control-input" name="saturday_`+i+`" id="saturday_`+i+`">
                        <label class="custom-control-label" for="saturday_`+i+`">Saturday</label>
                    </div>
                    <div class="ml-4 custom-control custom-switch">
                        <input type="checkbox" onclick="aleeert('sunday_`+i+`',`+i+`,'sunday',7)" class="custom-control-input" name="sunday_`+i+`" id="sunday_`+i+`">
                        <label class="custom-control-label" for="sunday_`+i+`">Sunday</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class=" mt-2 row" id="extraFields_`+i+`">

                    </div>

                </div>`;
        $("#week_schedule").append(hhtml);
        $('.js-multiSelect').select2(); 
    }     
})

function check(id){
    let text = "";
    let html = "";
    var n = 'basic_day_'+id;
    console.log(n,"n");
    let value = $("#"+n).val()
    // switch(value) {
    //     case 1:
    //         text = "Monday";
    //         break;
    //     case 2:
    //         text = "Tuesday";
    //         break;
    //     case 3:
    //         text = "Wednesday";
    //         break;
    //     case 4:
    //         text = "Thursday";
    //         break;
    //     case 5:
    //         text = "Friday";
    //         break;
    //     case 6:
    //         text = "Satureday";
    //         break;
    //     case 7:
    //         text = "Sunday";
    //         break;
    //     default:
    //         text = "---";
    // }
    if(value != ""){

        html += `<div class="col-md-3 " id="bas_` + value + `">
                    <div class="m-1 bg-price p-3">
                        <span class="heading-forth"> ` + text + `</span>
                        <div class="input-serachs mt-2">
                            <input type="txt" name="basic_class_title[` + value + `]" placeholder="Write Class Title" required />
                        </div>
                        <div class="input-serachs mt-2 mb-2">
                            

                            <textarea class="form-control texteara-s"
                                name="basic_class_overview[` + value + `]" rows="6" placeholder="Write Class Overview" required></textarea>
                            
                        </div>
                        <span class="heading-forth"> Timing</span>
                        <div class="input-options ">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" name="basic_class_start_time[` + value + `]" class="form-control texteara-s mt-2 pt-2 mb-2" required  placeholder="From"
                                    onfocus="(this.type='time')">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="basic_class_end_time[` + value + `]" class="form-control texteara-s mt-2 pt-2 mb-2" required placeholder="To"
                                        onfocus="(this.type='time')">
                                </div>
                            </div>
                        </div>
                    </div>
                
                </div>`;

        $("#extraFields_"+id).append(html);
    }
else{
  $("#extraFields_"+id).find(".col-md-3").remove();
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



</script>
@endsection

