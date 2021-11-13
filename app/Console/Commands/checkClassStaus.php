<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\General\NotifyController;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\URL;

class checkClassStaus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:check_class_status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        
        // $bookings = DB::table("bookings")->where('status', 2)->where('class_date',date('Y-m-d'))->get();
        $bookings = DB::table("bookings")->where('status', 2)->get();

        foreach($bookings as $booking) {
            
            $student = User::where('id',$booking->user_id)->first();
            $class = DB::table("classroom")->where('booking_id',$booking->id)->first();
            $class_log = DB::table("class_room_logs")->where('class_room_id',$class->id)->first();

            $bookingDate = $booking->class_date;
            $date = Carbon::createFromFormat('Y-m-d', $bookingDate)->isPast();
            $todayDate = Carbon::now()->format('Y-m-d');
            
            $admin = User::where('role',1)->first();
            $student_id = $booking->user_id;
            $std_slug = URL::to('/') . '/student/booking-detail/'. $booking->id ;
            $tutor_slug = URL::to('/') . '/tutor/booking-detail/'. $booking->id ;
            $admin_slug = URL::to('/') . '/admin/booking-detail/'. $booking->id ;

            $type = 'cancel_class';
            $data = 'data';
            $icon = 'fas fa-tag';
            $class = 'btn-success';
            $pic = '';

            if($date == 1  && $todayDate != $bookingDate){
                
                if($class_log != '') {
                    if($class_log->tutor_join_time != NULL){
                        if($class_log->student_join_time == NULL) {
                            DB::table("bookings")->where('id',$booking->id)->update([
                                "status" => 5,
                            ]);

                            $title = 'Class Delievered Automatically!';
                            $student_description = 'Class Delivered you did not joined.';
                            $tutor_description ='Class Delivered automatically as student unable to join.';
                            $admin_description = 'Class Delivered automatically as student unable to join at time.';

                            sendNotification($student_id , $std_slug ,  $type , $title , $icon , $class ,$student_description,$pic);
                            sendNotification($booking->booked_tutor , $tutor_slug ,  $type  , $title , $icon , $class ,$tutor_description,$pic);
                            sendNotification($admin->id , $admin_slug ,  $type  , $title , $icon , $class ,$admin_description,$pic);

                        }
                    }else{
                        DB::table("bookings")->where('id',$booking->id)->update([
                            "status" => 6,
                        ]);

                        $title = 'Class Cancelled Automatically!';
                        $student_description = 'Class Cancelled Tutor is not available.';
                        $tutor_description ='Class Cancelled you did not join on time.';
                        $admin_description = 'Class Cancelled Tutor not join on time';

                        sendNotification($student_id , $std_slug ,  $type , $title , $icon , $class ,$student_description,$pic);
                        sendNotification($booking->booked_tutor , $tutor_slug ,  $type  , $title , $icon , $class ,$tutor_description,$pic);
                        sendNotification($admin->id , $admin_slug ,  $type , $title , $icon , $class ,$admin_description,$pic);

                    }


                }else{
                    
                    DB::table("bookings")->where('id',$booking->id)->update([
                        "status" => 6,
                    ]);
                  
                    $title = 'Class Cancelled Automatically!';
                    $student_description = 'Class Cancelled Tutor is not available.';
                    $tutor_description ='Class Cancelled you did not join on time.';
                    $admin_description = 'Class Cancelled Tutor not join on time';
                    sendNotification($student_id , $std_slug ,  $type , $title , $icon , $class ,$student_description,$pic);
                    sendNotification($booking->booked_tutor , $tutor_slug ,  $type , $title , $icon , $class ,$tutor_description,$pic);
                    sendNotification($admin->id , $admin_slug ,  $type , $title , $icon , $class ,$admin_description,$pic);

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

                                    $title = 'Class Delievered Automatically!';
                                    $student_description = 'Class Delivered you did not joined.';
                                    $tutor_description ='Class Delivered automatically as student unable to join.';
                                    $admin_description = 'Class Delivered automatically as student unable to join at time.';

                                    sendNotification($student_id , $std_slug ,  $type , $title , $icon , $class ,$student_description,$pic);
                                    sendNotification($booking->booked_tutor , $tutor_slug ,  $type  , $title , $icon , $class ,$tutor_description,$pic);
                                    sendNotification($admin->id , $admin_slug ,  $type  , $title , $icon , $class ,$admin_description,$pic);

                                }
                            }else{
                                DB::table("bookings")->where('id',$booking->id)->update([
                                    "status" => 6,
                                ]);
                                $title = 'Class Cancelled Automatically!';
                                $student_description = 'Class Cancelled Tutor is not available.';
                                $tutor_description ='Class Cancelled you did not join on time.';
                                $admin_description = 'Class Cancelled Tutor not join on time';
                                sendNotification($student_id , $std_slug ,  $type , $title , $icon , $class ,$student_description,$pic);
                                sendNotification($booking->booked_tutor , $tutor_slug ,  $type , $title , $icon , $class ,$tutor_description,$pic);
                                sendNotification($admin->id , $admin_slug ,  $type , $title , $icon , $class ,$admin_description,$pic);

                            }
                        }else{
                            DB::table("bookings")->where('id',$booking->id)->update([
                                "status" => 6,
                            ]);
                            $title = 'Class Cancelled Automatically!';
                            $student_description = 'Class Cancelled Tutor is not available.';
                            $tutor_description ='Class Cancelled you did not join on time.';
                            $admin_description = 'Class Cancelled Tutor not join on time';
                            sendNotification($student_id , $std_slug ,  $type , $title , $icon , $class ,$student_description,$pic);
                            sendNotification($booking->booked_tutor , $tutor_slug ,  $type , $title , $icon , $class ,$tutor_description,$pic);
                            sendNotification($admin->id , $admin_slug ,  $type , $title , $icon , $class ,$admin_description,$pic);

                        }
                    }else{
                        if($datetime->diffInMinutes($bookdt) >= 15){
                            if($class_log != '') {
                                if($class_log->tutor_join_time != NULL){
                                    if($class_log->student_join_time == NULL) {
                                        DB::table("bookings")->where('id',$booking->id)->update([
                                            "status" => 5,
                                        ]);
                                        $title = 'Class Delievered Automatically!';
                                        $student_description = 'Class Delivered you did not joined.';
                                        $tutor_description ='Class Delivered automatically as student unable to join.';
                                        $admin_description = 'Class Delivered automatically as student unable to join at time.';

                                        sendNotification($student_id , $std_slug ,  $type , $title , $icon , $class ,$student_description,$pic);
                                        sendNotification($booking->booked_tutor , $tutor_slug ,  $type  , $title , $icon , $class ,$tutor_description,$pic);
                                        sendNotification($admin->id , $admin_slug ,  $type  , $title , $icon , $class ,$admin_description,$pic);

                                    }
                                }else{
                                    DB::table("bookings")->where('id',$booking->id)->update([
                                        "status" => 6,
                                    ]);
                                    $title = 'Class Cancelled Automatically!';
                                    $student_description = 'Class Cancelled Tutor is not available.';
                                    $tutor_description ='Class Cancelled you did not join on time.';
                                    $admin_description = 'Class Cancelled Tutor not join on time';
                                    sendNotification($student_id , $std_slug ,  $type , $title , $icon , $class ,$student_description,$pic);
                                    sendNotification($booking->booked_tutor , $tutor_slug ,  $type , $title , $icon , $class ,$tutor_description,$pic);
                                    sendNotification($admin->id , $admin_slug ,  $type , $title , $icon , $class ,$admin_description,$pic);

                                }
                            }else{
                                DB::table("bookings")->where('id',$booking->id)->update([
                                    "status" => 6,
                                ]);
                                $title = 'Class Cancelled Automatically!';
                                $student_description = 'Class Cancelled Tutor is not available.';
                                $tutor_description ='Class Cancelled you did not join on time.';
                                $admin_description = 'Class Cancelled Tutor not join on time';
                                sendNotification($student_id , $std_slug ,  $type , $title , $icon , $class ,$student_description,$pic);
                                sendNotification($booking->booked_tutor , $tutor_slug ,  $type , $title , $icon , $class ,$tutor_description,$pic);
                                sendNotification($admin->id , $admin_slug ,  $type , $title , $icon , $class ,$admin_description,$pic);

                            }
                        }
                    }
                }
            }
        }
    }

    public function sendNotification($reciever_id , $slug ,  $type , $title , $icon , $class ,$desc,$pic){

        $admin = User::where('role',1)->first();
        $notification = new NotifyController();
        $student_id = $booking->user_id;
        $reciever_id = $reciever->id;
        $std_slug = URL::to('/') . '/student/booking-detail/'. $booking->id ;
        $tutor_slug = URL::to('/') . '/tutor/booking-detail/'. $booking->id ;
        $admin_slug = URL::to('/') . '/admin/booking-detail/'. $booking->id ;

        $type = 'cancel_class';
        $data = 'data';
        $title = 'Class Cancel';
        $icon = 'fas fa-tag';
        $class = 'btn-success';
        $student_description = 'Class Cancelled Tutor is not available';
        $tutor_description ='Class Cancelled you did not join on time';
        $admin_description = 'Class Cancelled Tutor not join on time';

        $notification->GeneralNotifi($student_id , $slug ,  $type , $title , $icon , $class ,$student_description,$pic);
        $notification->GeneralNotifi($booking->booked_tutor , $slug ,  $type  , $title , $icon , $class ,$tutor_description,$pic);
        $notification->GeneralNotifi($admin->id , $slug ,  $type  , $title , $icon , $class ,$admin_description,$pic);

    }
}
