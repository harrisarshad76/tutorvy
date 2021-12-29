<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\General\GeneralController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;
use App\Models\Course;
use App\Models\CourseClass;
use App\Models\Classroom;
use App\Models\CourseLevel;
use App\Models\Activitylogs;
use App\Models\CourseOutline;
use App\Models\General\ClassTable;
use Illuminate\Support\Facades\URL;
use App\Models\User;
use Illuminate\Support\Carbon;

class CourseController extends Controller
{
    public  $days = array(
        array("id" => 1 , "day" => "Monday"),
        array("id" => 2 , "day" => "Tuesday"),
        array("id" => 3 , "day" => "Wednesday"),
        array("id" => 4 , "day" => "Thursday"),
        array("id" => 5 , "day" => "Friday"),
        array("id" => 6 , "day" => "Saturday"),
        array("id" => 7 , "day" => "Sunday"),
    );

    public function index()
    {
        
        $pen_course = Course::with('outline')->where('user_id',Auth::user()->id)->where('status',0)->get();
        $app_course = Course::with('outline')->where('user_id',Auth::user()->id)->where('status',1)->get();
        $rej_course = Course::with('outline')->where('user_id',Auth::user()->id)->where('status',2)->get();

        return view("tutor.pages.courses.index",compact('pen_course','app_course','rej_course'));
    }


    public function courseView($id)
    {
        $course = Course::with('outline')->find($id);
        $basic_classes = array();

        $cr_bs_dys = json_decode($course->basic_days);
        $cr_bs_clt = json_decode($course->basic_class_title,true);
        $cr_bs_clo = json_decode($course->basic_class_overview,true);
        $cr_bs_cst = json_decode($course->basic_class_start_time,true);
        $cr_bs_cet = json_decode($course->basic_class_end_time,true);



        for($i = 0 ; $i < sizeof($cr_bs_dys) ; $i++){
            $class = new ClassTable();
            $class->day = $cr_bs_dys[$i];
            $class->st_time = $cr_bs_cst != null ? $cr_bs_cst[$cr_bs_dys[$i]] : '';
            $class->et_time = $cr_bs_cet != null ? $cr_bs_cet[$cr_bs_dys[$i]] : '';
            $class->title = $cr_bs_clt != null ?  $cr_bs_clt[$cr_bs_dys[$i]] : '';
            $class->overview = $cr_bs_clo != null ? $cr_bs_clo[$cr_bs_dys[$i]] : '';

            array_push($basic_classes,$class);
        }
        $course->basic_classes = $basic_classes;
        // Standard Classes
        $standard_classes = array();

        $cr_std_dys = json_decode($course->standard_days);
        $cr_std_clt = json_decode($course->standard_class_title,true);
        $cr_std_clo = json_decode($course->standard_class_overview,true);
        $cr_std_cst = json_decode($course->standard_class_start_time,true);
        $cr_std_cet = json_decode($course->standard_class_end_time,true);
        if( $cr_std_dys != "" || $cr_std_dys != 0 ){

            for($i = 0 ; $i < sizeof($cr_std_dys) ; $i++){
                $class = new ClassTable();
                $class->day = $cr_std_dys[$i];
                $class->st_time =  $cr_std_cst != null ? $cr_std_cst[$cr_std_dys[$i]] : '';
                $class->et_time =  $cr_std_cet != null ? $cr_std_cet[$cr_std_dys[$i]] : '';
                $class->title = $cr_std_clt != null ?  $cr_std_clt[$cr_std_dys[$i]] : '';
                $class->overview =  $cr_std_clo != null ? $cr_std_clo[$cr_std_dys[$i]] : '';

                array_push($standard_classes,$class);
            }


        }
        $course->standard_classes = $standard_classes;
        // Advance Classes
        $advance_classes = array();

        $cr_ad_dys = json_decode($course->advance_days);
        $cr_ad_clt = json_decode($course->advance_class_title,true);
        $cr_ad_clo = json_decode($course->advance_class_overview,true);
        $cr_ad_cst = json_decode($course->advance_class_start_time,true);
        $cr_ad_cet = json_decode($course->advance_class_end_time,true);

        if( $cr_ad_dys != "" || $cr_ad_dys != 0 ){
            for($i = 0 ; $i < sizeof($cr_ad_dys) ; $i++){
                $class = new ClassTable();
                $class->day = $cr_ad_dys[$i];
                $class->ad_time =  $cr_ad_cst != null ? $cr_ad_cst[$cr_ad_dys[$i]] : '';
                $class->et_time =  $cr_ad_cet != null ? $cr_ad_cet[$cr_ad_dys[$i]] : '';
                $class->title = $cr_ad_clt != null ?  $cr_ad_clt[$cr_ad_dys[$i]] : '';
                $class->overview =  $cr_ad_clo != null ? $cr_ad_clo[$cr_ad_dys[$i]] : '';

                array_push($advance_classes,$class);
            }
        }

        $course->advance_classes = $advance_classes;
        return view('tutor.pages.courses.courseView',compact('course'));
    }

    public function create()
    {
        return view("tutor.pages.courses.create");
    }


    public function store(Request $request) {

        // return ($request);

        // if($request->hasFile('video')){
        //     $video_path = "storage/course/video/".$request->video->getClientOriginalName();
        //     $request->video->storeAs('course/video/',$request->video->getClientOriginalName(),'public');
        // }

        if($request->hasFile('thumbnail')){
            $thumbnail_path = "storage/course/thumbnail/".$request->thumbnail->getClientOriginalName();
            $request->thumbnail->storeAs('course/thumbnail/',$request->thumbnail->getClientOriginalName(),'public');
        }

        $courselevel = new Course();
        $courselevel->user_id            = Auth::user()->id;
        $courselevel->title              = $request->course_title;
        $courselevel->subject_id         = $request->subject;
        $courselevel->about              = $request->about;
        $courselevel->video              = $request->video;
        $courselevel->thumbnail          = $thumbnail_path ?? '';
        $courselevel->start_date         = $request->start_date;
        $courselevel->seats              = $request->seats;

        $courselevel->basic_home_work    = $request->basic_home_work;
        $courselevel->basic_quiz         = $request->basic_quiz;
        $courselevel->basic_one_one      = $request->basic_one_one;
        $courselevel->basic_final        = $request->basic_final;
        $courselevel->basic_note         = $request->basic_note;
        $courselevel->basic_duration     = $request->basic_duration;
        $courselevel->basic_days         = json_encode($request->basic_days);
        $courselevel->basic_class_title = json_encode($request->basic_class_title);
        $courselevel->basic_class_overview = json_encode($request->basic_class_overview);
        $courselevel->basic_class_start_time   = json_encode($request->basic_class_start_time);
        $courselevel->basic_class_end_time     = json_encode($request->basic_class_end_time);
        $courselevel->basic_price        = $request->basic_price;


        $courselevel->standard_home_work = $request->standard_home_work;
        $courselevel->standard_quiz      = $request->standard_quiz;
        $courselevel->standard_one_one   = $request->standard_one_one ;
        $courselevel->standard_final     = $request->standard_final ;
        $courselevel->standard_note      = $request->standard_note ;
        $courselevel->standard_duration  = $request->standard_duration ;
        $courselevel->standard_days      = json_encode($request->standard_days) ;
        $courselevel->standard_class_title = json_encode($request->standard_class_title);
        $courselevel->standard_class_overview = json_encode($request->standard_class_overview);
        $courselevel->standard_class_start_time= json_encode($request->standard_class_start_time) ;
        $courselevel->standard_class_end_time  = json_encode($request->standard_class_end_time) ;
        $courselevel->standard_price     = $request->standard_price;

        $courselevel->advance_home_work  = $request->advance_home_work;
        $courselevel->advance_quiz       = $request->advance_quiz;
        $courselevel->advance_one_one    = $request->advance_one_one;
        $courselevel->advance_final      = $request->advance_final;
        $courselevel->advance_note       = $request->advance_note;
        $courselevel->advance_duration   = $request->advance_duration;
        $courselevel->advance_days       = json_encode($request->advance_days);
        $courselevel->advance_class_title = json_encode($request->advance_class_title);
        $courselevel->advance_class_overview = json_encode($request->advance_class_overview);
        $courselevel->advance_class_start_time = json_encode($request->advance_class_start_time);
        $courselevel->advance_class_end_time   = json_encode($request->advance_class_end_time);
        $courselevel->advance_price      = $request->advance_price;

        $courselevel->save();

        $request->id = $courselevel->id;
        $this->basicOutline($request);
        $this->standardOutline($request);
        $this->advanceOutline($request);
        // return dd($request->all());
        $this->basicCourseClasses($request);
        $this->standardCourseClasses($request);
        $this->advanceCourseClasses($request);
        

        // activity logs
        $id = Auth::user()->id;
        $name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        $action_perform = '<a href="'.URL::to('/') . '/admin/tutor/profile/'. $id .'"> '.$name.' </a> Add new Course ';
        $activity_logs = new GeneralController();
        $activity_logs->save_activity_logs('New Course', "courses.id",$id, $action_perform, $request->header('User-Agent'), $id);

        return redirect()->route('tutor.course');
    }

    public function edit($id)
    {
        $course = Course::with('outline')->find($id);
        $basic_classes = array();

        $cr_bs_dys = json_decode($course->basic_days);
        $cr_bs_clt = json_decode($course->basic_class_title,true);
        $cr_bs_clo = json_decode($course->basic_class_overview,true);
        $cr_bs_cst = json_decode($course->basic_class_start_time,true);
        $cr_bs_cet = json_decode($course->basic_class_end_time,true);



        for($i = 0 ; $i < sizeof($cr_bs_dys) ; $i++){
            $class = new ClassTable();
            $class->day = $cr_bs_dys[$i];
            $class->st_time = $cr_bs_cst != null ? $cr_bs_cst[$cr_bs_dys[$i]] : '';
            $class->et_time = $cr_bs_cet != null ? $cr_bs_cet[$cr_bs_dys[$i]] : '';
            $class->title = $cr_bs_clt != null ?  $cr_bs_clt[$cr_bs_dys[$i]] : '';
            $class->overview = $cr_bs_clo != null ? $cr_bs_clo[$cr_bs_dys[$i]] : '';

            array_push($basic_classes,$class);
        }
        $course->basic_classes = $basic_classes;
        // Standard Classes
        $standard_classes = array();

        $cr_std_dys = json_decode($course->standard_days);
        $cr_std_clt = json_decode($course->standard_class_title,true);
        $cr_std_clo = json_decode($course->standard_class_overview,true);
        $cr_std_cst = json_decode($course->standard_class_start_time,true);
        $cr_std_cet = json_decode($course->standard_class_end_time,true);
        if( $cr_std_dys != "" || $cr_std_dys != 0 ){

            for($i = 0 ; $i < sizeof($cr_std_dys) ; $i++){
                $class = new ClassTable();
                $class->day = $cr_std_dys[$i];
                $class->st_time =  $cr_std_cst != null ? $cr_std_cst[$cr_std_dys[$i]] : '';
                $class->et_time =  $cr_std_cet != null ? $cr_std_cet[$cr_std_dys[$i]] : '';
                $class->title = $cr_std_clt != null ?  $cr_std_clt[$cr_std_dys[$i]] : '';
                $class->overview =  $cr_std_clo != null ? $cr_std_clo[$cr_std_dys[$i]] : '';

                array_push($standard_classes,$class);
            }


        }
        $course->standard_classes = $standard_classes;
        // Advance Classes
        $advance_classes = array();

        $cr_ad_dys = json_decode($course->advance_days);
        $cr_ad_clt = json_decode($course->advance_class_title,true);
        $cr_ad_clo = json_decode($course->advance_class_overview,true);
        $cr_ad_cst = json_decode($course->advance_class_start_time,true);
        $cr_ad_cet = json_decode($course->advance_class_end_time,true);

        if( $cr_ad_dys != "" || $cr_ad_dys != 0 ){
            for($i = 0 ; $i < sizeof($cr_ad_dys) ; $i++){
                $class = new ClassTable();
                $class->day = $cr_ad_dys[$i];
                $class->ad_time =  $cr_ad_cst != null ? $cr_ad_cst[$cr_ad_dys[$i]] : '';
                $class->et_time =  $cr_ad_cet != null ? $cr_ad_cet[$cr_ad_dys[$i]] : '';
                $class->title = $cr_ad_clt != null ?  $cr_ad_clt[$cr_ad_dys[$i]] : '';
                $class->overview =  $cr_ad_clo != null ? $cr_ad_clo[$cr_ad_dys[$i]] : '';

                array_push($advance_classes,$class);
            }
        }

        $course->advance_classes = $advance_classes;
        return view('tutor.pages.courses.edit',compact('course'));
    }


    public function update(Request $request, $id) {

        if($request->hasFile('thumbnail')){
            $thumbnail_path = "storage/course/thumbnail/".$request->thumbnail->getClientOriginalName();
            $request->thumbnail->storeAs('course/thumbnail/',$request->thumbnail->getClientOriginalName(),'public');
        }


        $courselevel = Course::find($id);
        // return $courselevel;
        $courselevel->user_id            = Auth::user()->id;
        $courselevel->title              = $request->course_title ?? $courselevel->title;
        $courselevel->subject_id         = $request->subject ?? $courselevel->subject_id;
        $courselevel->about              = $request->about ?? $courselevel->about;
        $courselevel->video              = $video_path ?? $courselevel->video;
        $courselevel->thumbnail          = $thumbnail_path ?? $courselevel->thumbnail;
        $courselevel->start_date         = $start_date ?? $courselevel->start_date;
        $courselevel->seats              = $request->seats;

        $courselevel->basic_home_work    = $request->basic_home_work ?? $courselevel->basic_home_work;
        $courselevel->basic_quiz         = $request->basic_quiz ?? $courselevel->basic_quiz;
        $courselevel->basic_one_one      = $request->basic_one_one ??  $courselevel->basic_one_one ;
        $courselevel->basic_final        = $request->basic_final ?? $courselevel->basic_final ;
        $courselevel->basic_note         = $request->basic_note ?? $courselevel->basic_note;
        $courselevel->basic_duration     = $request->basic_duration ?? $courselevel->basic_duration;
        $courselevel->basic_days         = json_encode($request->basic_days) ?? json_encode($courselevel->basic_days) ;
        $courselevel->basic_class_title = json_encode($request->basic_class_title) ?? json_encode($courselevel->basic_class_title);
        $courselevel->basic_class_overview = json_encode($request->basic_class_overview) ?? json_encode($courselevel->basic_class_overview);
        $courselevel->basic_class_start_time   = json_encode($request->basic_class_start_time) ?? json_encode($courselevel->basic_class_start_time);
        $courselevel->basic_class_end_time     = json_encode($request->basic_class_end_time) ?? json_encode($courselevel->basic_class_end_time);
        $courselevel->basic_price        = $request->basic_price ?? $courselevel->basic_price;


        $courselevel->standard_home_work = $request->standard_home_work  ?? $courselevel->standard_home_work;
        $courselevel->standard_quiz      = $request->standard_quiz ?? $courselevel->standard_home_work;
        $courselevel->standard_one_one   = $request->standard_one_one  ?? $courselevel->standard_home_work;
        $courselevel->standard_final     = $request->standard_final ?? $courselevel->standard_home_work ;
        $courselevel->standard_note      = $request->standard_note  ?? $courselevel->standard_home_work;
        $courselevel->standard_duration  = $request->standard_duration  ?? $courselevel->standard_home_work;
        $courselevel->standard_days      = json_encode($request->standard_days)  ?? json_encode($courselevel->standard_home_work);
        $courselevel->standard_class_title = json_encode($request->standard_class_title) ?? json_encode($courselevel->standard_home_work);
        $courselevel->standard_class_overview = json_encode($request->standard_class_overview) ?? json_encode($courselevel->standard_home_work);
        $courselevel->standard_class_start_time= json_encode($request->standard_class_start_time)  ?? json_encode($courselevel->standard_home_work);
        $courselevel->standard_class_end_time  = json_encode($request->standard_class_end_time)  ?? json_encode($courselevel->standard_home_work);
        $courselevel->standard_price     = $request->standard_price;

        $courselevel->advance_home_work  = $request->advance_home_work  ?? $courselevel->advance_home_work;
        $courselevel->advance_quiz       = $request->advance_quiz  ?? $courselevel->advance_home_work;
        $courselevel->advance_one_one    = $request->advance_one_one  ?? $courselevel->advance_home_work;
        $courselevel->advance_final      = $request->advance_final  ?? $courselevel->advance_home_work;
        $courselevel->advance_note       = $request->advance_note  ?? $courselevel->advance_home_work;
        $courselevel->advance_duration   = $request->advance_duration  ?? $courselevel->advance_home_work;
        $courselevel->advance_days       = json_encode($request->advance_days)  ?? json_encode($courselevel->advance_home_work);
        $courselevel->advance_class_title = json_encode($request->advance_class_title)  ?? json_encode($courselevel->advance_home_work);
        $courselevel->advance_class_overview = json_encode($request->advance_class_overview)  ?? json_encode($courselevel->advance_home_work);
        $courselevel->advance_class_start_time = json_encode($request->advance_class_start_time)  ?? json_encode($courselevel->advance_home_work);
        $courselevel->advance_class_end_time   = json_encode($request->advance_class_end_time)  ?? json_encode($courselevel->advance_home_work);
        $courselevel->advance_price      = $request->advance_price  ?? $courselevel->advance_price;

        // $courselevel->basic_home_work    = $request->basic_home_work;
        // $courselevel->basic_quiz         = $request->basic_quiz;
        // $courselevel->basic_one_one      = $request->basic_one_one;
        // $courselevel->basic_final        = $request->basic_final;
        // $courselevel->basic_note         = $request->basic_note;
        // $courselevel->basic_duration     = $request->basic_duration;
        // $courselevel->basic_days         = json_encode($request->basic_days);
        // $courselevel->basic_class_title = json_encode($request->basic_class_title);
        // $courselevel->basic_class_overview = json_encode($request->basic_class_overview);
        // $courselevel->basic_class_start_time   = json_encode($request->basic_class_start_time);
        // $courselevel->basic_class_end_time     = json_encode($request->basic_class_end_time);
        // $courselevel->basic_price        = $request->basic_price;

        if($request->hasFile('thumbnail')){
            $thumbnail_path = "storage/course/thumbnail/".$request->thumbnail->getClientOriginalName();
            $request->thumbnail->storeAs('course/thumbnail/',$request->thumbnail->getClientOriginalName(),'public');
        }

        // if($request->hasFile('video')){
        //     $video_path = "storage/course/video/".$request->video->getClientOriginalName();
        //     $request->video->storeAs('course/video/',$request->video->getClientOriginalName(),'public');
        // }

        // if($request->hasFile('thumbnail')){
        //     $thumbnail_path = "storage/course/thumbnail/".$request->thumbnail->getClientOriginalName();
        //     $request->video->storeAs('course/thumbnail/',$request->thumbnail->getClientOriginalName(),'public');
        // }


        // $courselevel->user_id            = Auth::user()->id;
        // $courselevel->title              = $request->course_title ?? $courselevel->title;
        // $courselevel->subject_id         = $request->subject ?? $courselevel->subject_id;
        // $courselevel->about              = $request->about ?? $courselevel->about;
        // $courselevel->start_date         = $request->start_date ?? $courselevel->start_date;
        // $courselevel->seats              = $request->seats ?? $courselevel->seats;
        // $courselevel->video              = $video_path ?? $courselevel->video;
        // $courselevel->thumbnail          = $thumbnail_path ?? $courselevel->thumbnail;
        // $courselevel->basic_home_work    = $request->basic_home_work ?? $courselevel->basic_home_work;
        // $courselevel->basic_quiz         = $request->basic_quiz ?? $courselevel->basic_quiz;
        // $courselevel->basic_one_one      = $request->basic_one_one ?? $courselevel->basic_one_one;
        // $courselevel->basic_final        = $request->basic_final ?? $courselevel->basic_final;
        // $courselevel->basic_note         = $request->basic_note ?? $courselevel->basic_note;
        // $courselevel->basic_duration     = $request->basic_duration ?? $courselevel->basic_duration;
        // $courselevel->basic_days         = json_encode($request->basic_days) ?? $courselevel->basic_days;
        // $courselevel->basic_start_time   = $request->basic_start_time ?? $courselevel->basic_start_time;
        // $courselevel->basic_end_time     = $request->basic_end_time ?? $courselevel->basic_end_time;
        // $courselevel->basic_price        = $request->basic_price ?? $courselevel->basic_price;
        // $courselevel->standard_home_work = $request->standard_home_work ?? $courselevel->standard_home_work;
        // $courselevel->standard_quiz      = $request->standard_quiz ?? $courselevel->standard_quiz;
        // $courselevel->standard_one_one   = $request->standard_one_one ?? $courselevel->standard_one_one;
        // $courselevel->standard_final     = $request->standard_final ?? $courselevel->standard_final;
        // $courselevel->standard_note      = $request->standard_note ?? $courselevel->standard_note;
        // $courselevel->standard_duration  = $request->standard_duration ?? $courselevel->standard_duration;
        // $courselevel->standard_days      = json_encode($request->standard_days) ?? $courselevel->standard_days;
        // $courselevel->standard_start_time= $request->start_time ??  $courselevel->standard_start_time;
        // $courselevel->standard_end_time  = $request->end_time ?? $courselevel->standard_end_time;
        // $courselevel->standard_price     = $request->price ?? $courselevel->standard_price;
        // $courselevel->advance_home_work  = $request->advance_home_work ?? $courselevel->advance_home_work;
        // $courselevel->advance_quiz       = $request->advance_quiz ?? $courselevel->advance_quiz;
        // $courselevel->advance_one_one    = $request->advance_one_one ?? $courselevel->advance_one_one;
        // $courselevel->advance_final      = $request->advance_final ?? $courselevel->advance_final;
        // $courselevel->advance_note       = $request->advance_note ?? $courselevel->advance_note;
        // $courselevel->advance_duration   = $request->advance_duration ?? $courselevel->advance_duration;
        // $courselevel->advance_days       = json_encode($request->advance_days) ?? $courselevel->advance_days;
        // $courselevel->advance_start_time = $request->advance_start_time ?? $courselevel->advance_start_time;
        // $courselevel->advance_end_time   = $request->advance_end_time ?? $courselevel->advance_end_time;
        // $courselevel->advance_price      = $request->advance_price ?? $courselevel->advance_price;

        $courselevel->save();

        $request->id = $courselevel->id;

        if($courselevel->outline){
            $courselevel->outline->each(function($record) {
                $record->delete(); // <-- direct deletion
             });
        }

        $this->basicOutline($request);
        $this->standardOutline($request);
        $this->advanceOutline($request);
        
        $this->basicCourseClasses($request);
        $this->standardCourseClasses($request);
        $this->advanceCourseClasses($request);


        
        

        // activity logs
        $id = Auth::user()->id;
        $name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        $action_perform = '<a href="'.URL::to('/') . '/admin/tutor/profile/'. $id .'"> '.$name.' </a> Update Course ';
        $activity_logs = new GeneralController();
        $activity_logs->save_activity_logs('Course Updated', "courses.id",$id, $action_perform, $request->header('User-Agent'), $id);

        return redirect()->route('tutor.course');
    }

    private function basicCourseClasses($request){

        $start_date = $request->start_date;
        $days = $this->days;
        $bs_st_tt = json_encode($request->basic_class_start_time);
        $bs_st_tt = json_decode($bs_st_tt,true);
        $bs_end_tt = json_encode($request->basic_class_end_time);
        $bs_end_tt = json_decode($bs_end_tt,true);
        // return $bs_st_tt;
        for($i = 0 ;$i < sizeof($request->basic_days) ; $i++){
            for($d = 0 ; $d < sizeof($days) ; $d++){
                if($days[$d]['id'] == $request->basic_days[$i]){
                    
                    $date = Carbon::parse($start_date);
                    // If $date is Monday, return $date. Otherwise, add days until next Monday.
                    $date = $date->is($days[$d]['day']) == 1 ? $date : $date->next($days[$d]['day']);
                    $dd = $date;
                    if($date->isPast()){

                    }else{
                        $class = CourseClass::where('class_date',$date)->where('course_id',$request->id)->where('class_time',$bs_st_tt[$request->basic_days[$i]])->where('class_end_time',$bs_end_tt[$request->basic_days[$i]])->first();
                        if($class){
                            $class->course_id = $request->id;
                            $class->class_date = $date;
                            $class->class_plan = 1;
                            $class->class_time = $bs_st_tt[$request->basic_days[$i]];
                            $class->class_end_time = $bs_end_tt[$request->basic_days[$i]];
                            $class->class_status = 0;
                            $class->save();
                        }else{
                            $courseclass = new CourseClass();
                            $courseclass->course_id = $request->id;
                            $courseclass->class_date = $date;
                            $courseclass->class_plan = 1;
                            $courseclass->class_time = $bs_st_tt[$request->basic_days[$i]];
                            $courseclass->class_end_time = $bs_end_tt[$request->basic_days[$i]];
                            $courseclass->class_status = 0;
                            $courseclass->save();
                        }
                    }
                    
                    for($w = 1 ; $w < $request->basic_duration ; $w++){
                        $dd = $dd->addDays(7);
                        if($date->isPast()){

                        }else{
                            $class = CourseClass::where('class_date',$dd)->where('course_id',$request->id)->where('class_time',$bs_st_tt[$request->basic_days[$i]])->where('class_end_time',$bs_end_tt[$request->basic_days[$i]])->first();
                            if($class){
                                $class->course_id = $request->id;
                                $class->class_date = $dd;
                                $class->class_plan = 1;
                                $class->class_time = $bs_st_tt[$request->basic_days[$i]];
                                $class->class_end_time = $bs_end_tt[$request->basic_days[$i]];
                                $class->class_status = 0;
                                $class->save();
                            }else{
                                $courseclass = new CourseClass();
                                $courseclass->course_id = $request->id;
                                $courseclass->class_date = $dd;
                                $courseclass->class_plan = 1;
                                $courseclass->class_time = $bs_st_tt[$request->basic_days[$i]];
                                $courseclass->class_end_time = $bs_end_tt[$request->basic_days[$i]];
                                $courseclass->class_status = 0;
                                $courseclass->save();
                            }
                        }
                    }
                }
            }
        }

        return ;
    }

    private function standardCourseClasses($request){

        $start_date = $request->start_date;
        $days = $this->days;
        $bs_st_tt = json_encode($request->standard_class_start_time);
        $bs_st_tt = json_decode($bs_st_tt,true);
        $bs_end_tt = json_encode($request->standard_class_end_time);
        $bs_end_tt = json_decode($bs_end_tt,true);
       
        if($request->standard_days != '' && !empty($request->standard_days)){
            for($i = 0 ;$i < sizeof($request->standard_days) ; $i++){
                for($d = 0 ; $d < sizeof($days) ; $d++){
                    if($days[$d]['id'] == $request->standard_days[$i]){
                        $date = Carbon::parse($start_date);
                        // If $date is Monday, return $date. Otherwise, add days until next Monday.
                        $date = $date->is($days[$d]['day']) == 1 ? $date : $date->next($days[$d]['day']);
    
                        $class = CourseClass::where('class_date',$date)->where('course_id',$request->id)->where('class_time',$bs_st_tt[$request->standard_days[$i]])->where('class_end_time',$bs_end_tt[$request->standard_days[$i]])->first();
                        if($class){
                            $class->course_id = $request->id;
                            $class->class_date = $date;
                            $class->class_plan = 2;
                            $class->class_time = $bs_st_tt[$request->standard_days[$i]];
                            $class->class_end_time = $bs_end_tt[$request->standard_days[$i]];
                            $class->class_status = 0;
                            $class->save();
                        }else{
                            $courseclass = new CourseClass();
                            $courseclass->course_id = $request->id;
                            $courseclass->class_date = $date;
                            $courseclass->class_plan = 2;
                            $courseclass->class_time = $bs_st_tt[$request->standard_days[$i]];
                            $courseclass->class_end_time = $bs_end_tt[$request->standard_days[$i]];
                            $courseclass->class_status = 0;
                            $courseclass->save();
                        }
                        
    
                    }
                }
            }
        }
        

        return ;
    }

    private function advanceCourseClasses($request){

        $start_date = $request->start_date;
        $days = $this->days;
        $bs_st_tt = json_encode($request->advance_class_start_time);
        $bs_st_tt = json_decode($bs_st_tt,true);
        $bs_end_tt = json_encode($request->advance_class_end_time);
        $bs_end_tt = json_decode($bs_end_tt,true);
       
        if($request->advance_days != '' && !empty($request->advance_days)){
            for($i = 0 ;$i < sizeof($request->advance_days) ; $i++){
                for($d = 0 ; $d < sizeof($days) ; $d++){
                    if($days[$d]['id'] == $request->advance_days[$i]){
                        $date = Carbon::parse($start_date);
                        // If $date is Monday, return $date. Otherwise, add days until next Monday.
                        $date = $date->is($days[$d]['day']) == 3 ? $date : $date->next($days[$d]['day']);
    
                        $class = CourseClass::where('class_date',$date)->where('course_id',$request->id)->where('class_time',$bs_st_tt[$request->advance_days[$i]])->where('class_end_time',$bs_end_tt[$request->advance_days[$i]])->first();
                        if($class){
                            $class->course_id = $request->id;
                            $class->class_date = $date;
                            $class->class_plan = 3;
                            $class->class_time = $bs_st_tt[$request->advance_days[$i]];
                            $class->class_end_time = $bs_end_tt[$request->advance_days[$i]];
                            $class->class_status = 0;
                            $class->save();
                        }else{
                            $courseclass = new CourseClass();
                            $courseclass->course_id = $request->id;
                            $courseclass->class_date = $date;
                            $courseclass->class_plan = 1;
                            $courseclass->class_time = $bs_st_tt[$request->advance_days[$i]];
                            $courseclass->class_end_time = $bs_end_tt[$request->advance_days[$i]];
                            $courseclass->class_status = 0;
                            $courseclass->save();
                        }
                        
    
                    }
                }
            }
        }
        

        return ;
    }


    private function basicOutline($request){
        foreach($request->basic_title as $i => $data){
            CourseOutline::create([
                'course_id' => $request->id,
                'title' => $request->basic_title[$i],
                'explain' => $request->basic_explain[$i],
                'level' => 1,
            ]);
        }

    }

    private function standardOutline($request){
        foreach($request->standard_title as $i=>$data){
            CourseOutline::create([
                'course_id' => $request->id,
                'title' => $request->standard_title[$i],
                'explain' => $request->standard_explain[$i],
                'level' => 2,
            ]);
        }
    }


    private function advanceOutline($request){
        foreach($request->advance_title as $i=>$data){
            CourseOutline::create([
                'course_id' => $request->id,
                'title' => $request->advance_title[$i],
                'explain' => $request->advance_explain[$i],
                'level' => 3,
            ]);
        }
    }

    public function start_course_class(){
        $class_room_id = 'd0f2c93f-1026-444a-b80a-16e65e0dec15';
        $class = Classroom::where('classroom_id',$class_room_id)->first();
        $booking = Booking::where('id',$class->booking_id)->first();

        // $class = Classroom::with('booking')->where('classroom_id',$class_room_id)->first();
        $user = User::where('id',Auth::user()->id)->first();
        // dd($class);
        return view('tutor.pages.courses.courseClassroom',compact('class','user','booking'));
    }

}
