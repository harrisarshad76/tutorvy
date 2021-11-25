<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\General\ClassTable;
use App\Http\Controllers\General\GeneralController;
use App\Http\Controllers\General\NotifyController;
use App\Models\User;
use Illuminate\Support\Facades\URL;

class CourseController extends Controller
{
      /*
    |--------------------------------------------------------------------------
    | Admin -- CourseController
    |--------------------------------------------------------------------------
    |
    | This controller handles Courses from admin side
    |
    |
    */

    public function index()
    {
        if(Auth::user()->role == 1):
            $approved_courses = Course::whereIn('status',[0,2])->get();
            $requested_courses = Course::where('status',0)->get();
        else:
            $approved_courses = Course::whereIn('status',[0,2])->where('assign_to',Auth::id())->get();
            $requested_courses = Course::where('status',0)->where('assign_to',Auth::id())->get();
        endif;

        $staff_members = User::whereNotIn('role', [1,2,3])->get();

        return view('admin.pages.courses.index',compact('approved_courses','requested_courses','staff_members'));
    }
    public function courseRequest($id)
    {
        $course = Course::with('outline')->where('status',0)->where('id',$id)->first();

        // Basic Classes
        $basic_classes = array();

        $cr_bs_dys = json_decode($course->basic_days);
        $cr_bs_clt = json_decode($course->basic_class_title,true);
        $cr_bs_clo = json_decode($course->basic_class_overview,true);
        $cr_bs_cst = json_decode($course->basic_class_start_time,true);
        $cr_bs_cet = json_decode($course->basic_class_end_time,true);

        for($i = 0 ; $i < sizeof($cr_bs_dys) ; $i++){
            $class = new ClassTable();
            $class->day = $cr_bs_dys[$i];
            $class->st_time = $cr_bs_cst[$cr_bs_dys[$i]];
            $class->et_time = $cr_bs_cet[$cr_bs_dys[$i]];
            $class->title = $cr_bs_clt[$cr_bs_dys[$i]];
            $class->overview = $cr_bs_clo[$cr_bs_dys[$i]];

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
                $class->st_time = $cr_std_cst[$cr_std_dys[$i]];
                $class->et_time = $cr_std_cet[$cr_std_dys[$i]];
                $class->title = $cr_std_clt[$cr_std_dys[$i]];
                $class->overview = $cr_std_clo[$cr_std_dys[$i]];

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
                $class->ad_time = $cr_ad_cst[$cr_ad_dys[$i]];
                $class->et_time = $cr_ad_cet[$cr_ad_dys[$i]];
                $class->title = $cr_ad_clt[$cr_ad_dys[$i]];
                $class->overview = $cr_ad_clo[$cr_ad_dys[$i]];

                array_push($advance_classes,$class);
            }


        }

        $course->advance_classes = $advance_classes;
        // return $course;
        return view('admin.pages.courses.course_req',compact('course'));
    }
    public function courseProfile($id)
    {
        $course = Course::with('outline')->where('id',$id)->first();
        // Basic Classes


        $basic_classes = array();

        $cr_bs_dys = json_decode($course->basic_days);
        $cr_bs_clt = json_decode($course->basic_class_title,true);
        $cr_bs_clo = json_decode($course->basic_class_overview,true);
        $cr_bs_cst = json_decode($course->basic_class_start_time,true);
        $cr_bs_cet = json_decode($course->basic_class_end_time,true);


        for($i = 0 ; $i < sizeof($cr_bs_dys) ; $i++){
            $class = new ClassTable();
            $class->day = $cr_bs_dys[$i];
            $class->st_time = $cr_bs_cst[$cr_bs_dys[$i]];
            $class->et_time = $cr_bs_cet[$cr_bs_dys[$i]];
            $class->title = $cr_bs_clt[$cr_bs_dys[$i]];
            $class->overview = $cr_bs_clo[$cr_bs_dys[$i]];

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
                $class->st_time = $cr_std_cst[$cr_std_dys[$i]];
                $class->et_time = $cr_std_cet[$cr_std_dys[$i]];
                $class->title = $cr_std_clt[$cr_std_dys[$i]];
                $class->overview = $cr_std_clo[$cr_std_dys[$i]];

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
                $class->ad_time = $cr_ad_cst[$cr_ad_dys[$i]];
                $class->et_time = $cr_ad_cet[$cr_ad_dys[$i]];
                $class->title = $cr_ad_clt[$cr_ad_dys[$i]];
                $class->overview = $cr_ad_clo[$cr_ad_dys[$i]];

                array_push($advance_classes,$class);
            }


        }

        $course->advance_classes = $advance_classes;
        // return $course;
        return view('admin.pages.courses.course_profile',compact('course'));
    }
    public function editCourseProfile($id)
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
        return view('admin.pages.courses.course_edit',compact('course'));
    }

    public function update(Request $request, $id) {

        // return dd($request->all());
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

        if($request->hasFile('thumbnail')){
            $thumbnail_path = "storage/course/thumbnail/".$request->thumbnail->getClientOriginalName();
            $request->thumbnail->storeAs('course/thumbnail/',$request->thumbnail->getClientOriginalName(),'public');
        }


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

        // activity logs
        $id = Auth::user()->id;
        $name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        $action_perform = '<a href="'.URL::to('/') . '/admin/tutor/profile/'. $id .'"> '.$name.' </a> Update Course ';
        $activity_logs = new GeneralController();
        $activity_logs->save_activity_logs('Course Updated', "courses.id",$id, $action_perform, $request->header('User-Agent'), $id);

        return redirect()->route('tutor.course');
    }


    public function courseStatus(Request $request){

        $course = Course::where('id',$request->id)->first();
        $course->status = $request->status;
        $course->reject_note = $request->reason;

        $course->save();

        $message = '';
        if($request->status == 1){
            $message = 'Course Status Enabled.';
            $action_perform = 'Admin Change Course Status to Enabled';
        }elseif($request->status == 3){
            $message = 'Course Rejected.';
            $action_perform = 'Admin Reject the Course';
        }elseif($request->status == 0){
            $message = 'Course Status Disabled.';
            $action_perform = 'Admin Change Course Status to Disbaled';
        }

        // activity logs
        $id = Auth::user()->id;
        $name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        $action_perform = 'You (admin)  ';
        $activity_logs = new GeneralController();
        $activity_logs->save_activity_logs($message, "courses.id",$request->id, $action_perform, $request->header('User-Agent'), $id);

        return response()->json([
            'status'=>'200',
            'message' => $message
        ]);

    }

    public function deleteCourse(Request $request){
        $course = Course::where('id',$request->id)->first();
        $course->status = $request->status;
        $course->save();
        // return $course;
        return response()->json([
            'status'=>'200',
            'message' => 'Course Deleted successfully'
        ]);

    }

    public function assignCourse(Request $request)
    {
        // dd($request->all());
        $user = User::find($request->satff);
        Course::where('id',$request->course)->update([
            'assign_to' => $request->staff
        ]);

                // dd($user);

        $message = 'Course has been assigned to '.User::find($request->staff)->name;
        $notify_msg = 'Course is assigned to you';


        $notification = new NotifyController();
        $reciever_id = $request->user_id;
        $slug = URL::to('/') . '/tutor/subjects';
        $type = 'tutor_assigned';
        $data = 'data';
        $title = 'Tutor Assigned';
        $icon = 'fas fa-tag';
        $class = 'btn-success';
        $desc = $notify_msg ;
        $pic = Auth::user()->picture;

        $notification->GeneralNotifi( $reciever_id , $slug ,  $type , $title , $icon , $class ,$desc,$pic);

        return response()->json([
            'status'=>'200',
            'message' => $message
        ]);
    }
}
