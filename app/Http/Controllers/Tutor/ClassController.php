<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\Models\Activitylogs;
use App\Http\Controllers\General\NotifyController;
use App\Models\Classroom;
use App\Models\Booking;
use App\Models\User;
use App\Models\ClassroomLogs;
use DateTime;
use DateTimeZone;
use Carbon\Carbon;

class ClassController extends Controller
{
      /**
     *  Return Tutor Class Room view
     */

    public function index(){
        $bookings = DB::table("bookings")->where('status', 2)->get();

        foreach($bookings as $booking) {
            
            $student = User::where('id',$booking->user_id)->first();
            $class = DB::table("classroom")->where('booking_id',$booking->id)->first();
            $class_log = DB::table("class_room_logs")->where('class_room_id',$class->id)->first();

            $bookingDate = $booking->class_date;
            $date = Carbon::createFromFormat('Y-m-d', $bookingDate)->isPast();
            $todayDate = Carbon::now()->format('Y-m-d');
            
            if($date == 1  && $todayDate != $bookingDate){
                
                if($class_log != '') {
                    if($class_log->tutor_join_time != NULL){
                        if($class_log->student_join_time == NULL) {
                            DB::table("bookings")->where('id',$booking->id)->update([
                                "status" => 5,
                            ]);
                        }
                    }else{
                        DB::table("bookings")->where('id',$booking->id)->update([
                            "status" => 6,
                        ]);
                    }

                    // $admin = User::where('role',1)->first();
                    // $notification = new NotifyController();
                    // $sender_id = $booking->user_id;
                    // $reciever_id = $reciever->id;
                    // $slug = '-' ;
                    // $type = 'cancel_class';
                    // $data = 'data';
                    // $title = 'Class Cancel';
                    // $icon = 'fas fa-tag';
                    // $class = 'btn-success';
                    // $student_description = 'Class Cancelled Tutor is not available';
                    // $tutor_description ='Class Cancelled you did not join on time';
                    // $admin_description = 'Class Cancelled Tutor not join on time';

                    // $notification->GeneralNotifi(0, $sender_id , $slug ,  $type , $data , $title , $icon , $class ,$student_description);
                    // $notification->GeneralNotifi(0, $booking->booked_tutor , $slug ,  $type , $data , $title , $icon , $class ,$tutor_description);
                    // $notification->GeneralNotifi(0, $admin->id , $slug ,  $type , $data , $title , $icon , $class ,$admin_description);


                }else{
                    
                    DB::table("bookings")->where('id',$booking->id)->update([
                        "status" => 6,
                    ]);
                  
                    // $admin = User::where('role',1)->first();
                    // $notification = new NotifyController();
                    // $sender_id = $booking->user_id;
                    // $reciever_id = $reciever->id;
                    // $slug = '-' ;
                    // $type = 'cancel_class';
                    // $data = 'data';
                    // $title = 'Class Cancel';
                    // $icon = 'fas fa-tag';
                    // $class = 'btn-success';
                    // $student_description = 'Class Cancelled your not available';
                    // $tutor_description ='Class Cancelled Student did not join on time';
                    // $admin_description = 'Class Cancelled Student did not join on time';

                    // $notification->GeneralNotifi(0, $sender_id , $slug ,  $type , $data , $title , $icon , $class ,$student_description);
                    // $notification->GeneralNotifi(0, $booking->booked_tutor , $slug ,  $type , $data , $title , $icon , $class ,$tutor_description);
                    // $notification->GeneralNotifi(0, $admin->id , $slug ,  $type , $data , $title , $icon , $class ,$admin_description);


                }
            }else{
    
                $bookdt = $booking->class_date.' '.$booking->class_time;
                $ldate = date('Y-m-d H:i');
                
                $datetime = Carbon::createFromFormat('Y-m-d H:i', $ldate);
                $datetime->setTimezone($student->time_zone);

                if($datetime->lte($bookdt)){

                }else{

                    $booking_duration = $booking->duration * 60;

                    if($datetime->diffInMinutes($bookdt) >= $booking_duration){
                        if($class_log != '') {
                            if($class_log->tutor_join_time != NULL){
                                if($class_log->student_join_time != NULL) {
                                    DB::table("bookings")->where('id',$booking->id)->update([
                                        "status" => 5,
                                    ]);
                                }
                            }else{
                                DB::table("bookings")->where('id',$booking->id)->update([
                                    "status" => 6,
                                ]);
                            }
                        }else{
                            DB::table("bookings")->where('id',$booking->id)->update([
                                "status" => 6,
                            ]);
                        }
                    }else{
                        if($datetime->diffInMinutes($bookdt) >= 15){
                            if($class_log != '') {
                                if($class_log->tutor_join_time != NULL){
                                    if($class_log->student_join_time == NULL) {
                                        DB::table("bookings")->where('id',$booking->id)->update([
                                            "status" => 5,
                                        ]);
                                    }
                                }else{
                                    DB::table("bookings")->where('id',$booking->id)->update([
                                        "status" => 6,
                                    ]);
                                }
                            }else{
                                DB::table("bookings")->where('id',$booking->id)->update([
                                    "status" => 6,
                                ]);
                            }
                        }
                    }

                    
                }

            }

        }
        $classes = Booking::with(['classroom','user','tutor','subject','booking_payment'])
                    ->where('booked_tutor',Auth::user()->id)
                    ->whereIn('status',[2,5])->get();
        
        foreach($classes as $class) {
            if($class != null && $class->tutor != null && $class->tutor->time_zone != null) {
                date_default_timezone_set($class->tutor->time_zone);
                $date = date("h:i:sa");
                $class->actual_booking_time =  date("H:i", strtotime($date));
            }
        }
        // dd($classes);
        $user = User::where('id',Auth::user()->id)->first();
        $delivered_classess = DB::table("classroom")
        ->leftJoin('bookings', 'classroom.booking_id', '=', 'bookings.id')
        ->where('user_id',Auth::user()->id)
        ->count();
        
        return view('tutor.pages.classroom.index',compact('classes','user','delivered_classess'));
    }

    public function saveClassLogs(Request $request) {

        ClassroomLogs::create([
            "class_room_id" => $request->class_room_id, 
            "tutor_join_time" => $request->tutor_join_time,
        ]);

        $class = Classroom::where('id',$request->class_room_id)->first();
        $booking = Booking::where('id',$class->booking_id)->first();

        $name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        $slug = URL::to('/') . '/student/class/'. $class->classroom_id;

        $notification = new NotifyController();

        $reciever_id = $booking->user_id;
        $type = 'class_started';
        $data = 'data';
        $title = 'Class Started';
        $icon = 'fas fa-tag';
        $class = 'btn-success';
        $desc = $name . ' Started the class. Here is the link to join class. <a href='.$slug.'>Class Link</a> ' ;
        $pic = Auth::user()->picture;

        $notification->GeneralNotifi( $reciever_id , $slug ,  $type , $title , $icon , $class ,$desc,$pic);

        return response()->json([
            "message" => "Classroom logs saved",
            "status_code" => 200,
            "success" => true,
        ]);

    }
}
