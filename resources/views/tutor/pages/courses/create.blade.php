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
                            <input type="text" name="course_title" placeholder="How to create your online courses in 3 steps." />
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
                                <textarea class="form-control texteara-s" name="about" rows="5" placeholder='Course Description'></textarea>
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
                            <input type="text" name="start_date" class="" required="" placeholder="From" onfocus="(this.type='date')">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label heading-forth">Available Seats</label>
                        <div class="input-serachs ">
                            <input type="text" name="seats" class="" required placeholder="Seats" onfocus="(this.type='number')">
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label class="form-label heading-forth">Intro Video URL</label>
                        <div class="input-serachs ">
                            <input type="url"  name="video" placeholder="https://www.youtube.com/channel/UCTv6Gbid3HeUSYyLtV5sFOw/videos" />
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for=""  class="form-label heading-forth ">Course Thumbnail</label>
                        <div class="input-serachs ">
                            <input type="file" class="dropify" name="thumbnail" id="thumbnail"  >
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
                            <label for="" class="form-label heading-forth"> Course Duration</label>
                            <div class="input-options ">
                                <select name="basic_duration" id="basic_duration" style="padding:8px;">
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
                        <div class="col-md-12 pl-0" id="week_schedule">

                        </div>
                        <div class="col-md-12">
                            <div class=" mt-2 row" id="extraFields"></div>

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
        hhtml =`<div class="col-md-4 mt-3">
                    <h3>Select  week `+i+` Days </h3>
                    <div class='input-options'>
                        <select class="select2" id="basic_days_`+i+`" name="basic_days[`+i+`]" multiple>
                                <option value="1" >Monday</option>
                                <option value="2">Tuesday</option>
                                <option value="3">Wednesday</option>
                                <option value="4">Thursday</option>
                                <option value="5">Friday</option>
                                <option value="6">Saturday</option>
                                <option value="7">Sunday</option>
                        </select>
                    </div>
                </div>`;
        $("#week_schedule").append(hhtml);
        $('.select2').select2(); 
    }     
})
// $("#basic_days_1").on("click",function(e){
//     alert($(this).val());
// })
</script>
@endsection

