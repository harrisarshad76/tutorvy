<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\Activitylogs;
use App\Models\ClassroomLogs;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Admin\sys_settings;
use App\Models\CourseClass;
use App\Models\CourseEnrollment;
use App\Models\Course;

class StudentClassController extends Controller
{
      /**
     *  Return Student Class Room view
     */

    public function index(){

        $classes = Booking::with(['classroom','user','tutor','subject'])->where('user_id',Auth::user()->id)->whereIn('status',[2,5])->get();

        foreach($classes as $class) {
            date_default_timezone_set($class->user->time_zone);
            $date = date("h:i:sa");
            $class->actual_booking_time =  date("H:i", strtotime($date));
        }

        $user = User::where('id',Auth::user()->id)->first();
        // return $classes;
        $booked_classes = Booking::with('user')->where('user_id',Auth::user()->id)->where('status',5)->get();
        $courses_enrolled = CourseEnrollment::where('user_id',\Auth::user()->id)->get();

        foreach($courses_enrolled as $course){
            $detail = Course::where('id',$course->course_id)->first();
            $class = CourseClass::where('course_id',$course->course_id)->where('class_status','!=',2)->orderBy('class_date','asc')->first();
            $classroom = Classroom::where('course_class_id',$class->id)->first();
            $course->classroom = $classroom;
            $course->enClass = $class;
            $course->detail = $detail;
        }
        // return $courses_enrolled;
        return view('student.pages.classroom.index',compact('classes','user','booked_classes','courses_enrolled'));
    }

    public function saveReview(Request $request) {

        Booking::where('id',$request->booking_id)->update([
            "student_review" => $request->review,
            "rating" => $request->star_rating,
            "is_reviewed" => 1,
            "status" => 5,
        ]);
        
        return response()->json([
            "message" => "Rating Saved Successfully",
            "status_code" => 200,
            "success" => true,
        ]);

    }


    public function saveClassLogs(Request $request) {

        $classRoomLogs = ClassroomLogs::where('class_room_id',$request->class_room_id)->first();

        if($classRoomLogs) {
            ClassroomLogs::where('class_room_id',$request->class_room_id)->update([
                "student_join_time" => $request->std_join_time
            ]);
        }

        return response()->json([
            "message" => "Classroom Logs Saved",
            "status_code" => 200,
            "success" => true,
        ]);

    }

    
    public function testMedia($booking_id){
       
        $booking = Booking::where('id',$booking_id)->first();
        $class = Classroom::where('booking_id',$booking_id)->first();
        $user = User::where('id',\Auth::user()->id)->first();
        return view('student.pages.classroom.testMedia',compact("user","class","booking"));
    }

}
