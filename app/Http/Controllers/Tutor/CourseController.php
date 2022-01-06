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
        // Basic Classes

        $classes = CourseClass::where('course_id',$id)->get();

        foreach($classes as $class){
            $input = $class->class_date;
            $date = strtotime($input);
            $date = date('l', $date);
            if($date == 'Monday'){
                $date = 1;
            }elseif($date == 'Tuesday'){
                $date = 2;
            }elseif($date == 'Wednesday'){
                $date = 3;
            }elseif($date == 'Thursday'){
                $date = 4;
            }elseif($date == 'Friday'){
                $date = 5;
            }elseif($date == 'Satureday'){
                $date = 6;
            }elseif($date == 'Sunday'){
                $date = 7;
            }
            $class->day = $date;
        }
        $course->basic_classes = $classes;
        return view('tutor.pages.courses.courseView',compact('course'));
    }

    public function create()
    {
        return view("tutor.pages.courses.create");
    }


    public function store(Request $request) {


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
        // $this->basicOutline($request);
        // $this->standardOutline($request);
        // $this->advanceOutline($request);
        // return dd($request->all());

        $this->basicCourseClasses($request);
        // $this->standardCourseClasses($request);
        // $this->advanceCourseClasses($request);
   
        

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

        $cr_bs_duration = $course->basic_duration;
        $class_titles = json_decode($course->basic_class_title,true);
        $class_overviews = json_decode($course->basic_class_overview,true);
        $bs_st_tt = json_decode($course->basic_class_start_time,true);
        $bs_end_tt = json_decode($course->basic_class_end_time,true);
        $bs_date = json_decode($course->basic_class_date,true);

        $classes = CourseClass::where('course_id',$id)->get();

        foreach($classes as $class){
            $input = $class->class_date;
            $date = strtotime($input);
            $date = date('l', $date);
            if($date == 'Monday'){
                $date = 1;
            }elseif($date == 'Tuesday'){
                $date = 2;
            }elseif($date == 'Wednesday'){
                $date = 3;
            }elseif($date == 'Thursday'){
                $date = 4;
            }elseif($date == 'Friday'){
                $date = 5;
            }elseif($date == 'Satureday'){
                $date = 6;
            }elseif($date == 'Sunday'){
                $date = 7;
            }
            $class->day = $date;
        }
        $course->basic_classes = $classes;

        // return $course;
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

        // dd($request->basic_class_date);exit;
        $start_date = $request->start_date;
        $weeks = $request->basic_duration;
        $days = $this->days;

        $class_titles = $request->basic_class_title;
        $class_overviews = $request->basic_class_overview;
        // $class_titles = json_decode($request->basic_class_title);
        $bs_st_tt = $request->basic_class_start_time;
        $bs_end_tt = $request->basic_class_end_time;
        $bs_date = $request->basic_class_date;

        for($i = 1 ; $i <= $weeks ; $i++){
            
            $lessons_titles = $class_titles[$i];
            $lessons_overviews = $class_overviews[$i];
            $lessons_st_time = $bs_st_tt[$i];
            $lessons_ed_time = $bs_end_tt[$i];
            $lessons_date = $bs_date[$i];

            $ccc = 1;
            for($c = 1 ;$ccc <= sizeof($lessons_titles);$c++){
                // dd($lessons_titles[$c]);exit;
                
                for($d = 0 ; $d < sizeof($days) ; $d++){
                    if($days[$d]['id'] == $c){
                        // echo $days[$d]['day'];

                        if(array_key_exists($c,$lessons_titles)){
                            // echo $days[$d]['id'];
                            $ccc++;
                            // print_r($lessons_titles[$c]);
                            // If $date is Monday, return $date. Otherwise, add days until next Monday.
                            //$sdate = $sdate->is($days[$d]['day']) == 1 ? $sdate : $sdate->next($days[$d]['day']);
                            
                            // echo $days[$d]['day'];

                            // $dd = $sdate;
                            // if($date->isPast()){
                                

                            // }else{
                                
                                $class = CourseClass::where('class_date',$lessons_date[$c])->where('course_id',$request->id)->where('class_time',$lessons_st_time[$c])->where('class_end_time',$lessons_ed_time[$c])->first();
                                if($class){
                                    $class->course_id = $request->id;
                                    $class->class_date = $lessons_date[$c];
                                    $class->class_plan = 1;
                                    $class->class_time = $lessons_st_time[$c];
                                    $class->class_end_time = $lessons_ed_time[$c];
                                    $class->class_status = 0;
                                    $class->class_title = $lessons_titles[$c];
                                    $class->class_overview = $lessons_overviews[$c];
                                    $class->class_week = $i;

                                    $class->save();
                                }else{
                                    $courseclass = new CourseClass();
                                    $courseclass->course_id = $request->id;
                                    $courseclass->class_date = $lessons_date[$c];
                                    $courseclass->class_plan = 1;
                                    $courseclass->class_time = $lessons_st_time[$c];
                                    $courseclass->class_end_time = $lessons_ed_time[$c];
                                    $courseclass->class_status = 0;
                                    $courseclass->class_title = $lessons_titles[$c];
                                    $courseclass->class_overview = $lessons_overviews[$c];
                                    $courseclass->class_week = $i;

                                    $courseclass->save();
                                }
                            // }
                        }
                    }
                }
                // echo $sdate;
            }
            // $date = $sdate->addDays(7);
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
