<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Controllers\General\GeneralController;
use App\Http\Controllers\General\NotifyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\FavTutors;
use App\Models\Booking;
use App\Models\Activitylogs;
use App\Models\Classroom;
use App\Models\Admin\tktCat;
use App\Models\General\TicketChat;
use App\Models\Admin\supportTkts;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\General\ClassTable;
use App\Models\CourseClass;

class SettingController extends Controller
{
    /**
     *  Return Tutor setting view
     */

    public function index(){

        $user = User::where('id',\Auth::user()->id)->first();
        $setting = DB::table('payment_methods')->where('user_id',Auth::user()->id)->get();
        return view('student.pages.setting.index',compact('user','setting'));
    }


    public function paymentMethod(Request $request)
    {
        $setting = DB::table('payment_methods')->where('user_id',Auth::user()->id)->get();

        if($setting->whereIn('method',$request->payment_type)->count() == 0){
            DB::table('payment_methods')->insert([
                'user_id' => Auth::user()->id,
                'email' => $request->email,
                'method' => $request->payment_type,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        if($setting->count() == 1){
            DB::table('payment_methods')->where('user_id',Auth::user()->id)->update([
                'default' => 1,
            ]);
        }

        return redirect()->back();
    }

    public function setDefaultPayment(Request $request)
    {
        $payments = DB::table('payment_methods')
                    ->where('user_id',Auth::user()->id)
                    ->where('method','!=',$request->method)->update([
                        'default' => 0
                    ]);

        $payments = DB::table('payment_methods')
                    ->where('user_id',Auth::user()->id)
                    ->where('method',$request->method)->update([
                        'default' => 1
                    ]);

        return response()->json('success');
    }

    protected function validator(array $request)
    {
        return Validator::make($request, [
            'current_password'     => 'required',
            'new_password'     => 'required|min:6',
            'new_confirm_password' => 'required|same:new_password',
        ]);
    }

    public function changePassword(Request $request){

        $data = $request->all();

        $request->validate([
            'current_password'     => 'required',
            'new_password'     => 'required|min:6',
            'new_confirm_password' => 'required|same:new_password',
        ]);

        $user = User::find(auth()->user()->id);

        if(!\Hash::check($data['current_password'], $user->password)){
            // print_r('asd');exit;
            return back()->with('error','You have entered wrong password');

        }else{
            User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

            return redirect()->back('success','Password updated');
        }

    }

    public function call(){
        $users = User::where('role',2)->get();

        return view('student.pages.classroom.call',compact('users'));
    }

    public function whiteBoard(){
        $users = User::where('role',3)->get();

        return view('student.pages.classroom.classroom',compact('users'));

    }

    public function join_class($class_room_id){
        $class = Classroom::where('classroom_id',$class_room_id)->first();

        $course = '';
        $booking = '';
        $cs_en = '';
        if($class->type == 'course_class'){
            $course = Course::where('id',$class->course_id)->first();
            $cs_en = CourseClass::where('id',$class->course_class_id)->first();
            $course->class = $cs_en;
        }else{
            $booking = Booking::where('id',$class->booking_id)->first();
        }

        $user = User::where('id',\Auth::user()->id)->first();
        return view('student.pages.classroom.classroom',compact('class','user','booking','course'));
    }

    public function change_password(Request $request) {

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
            'new_confirm_password' => 'required',
        ]);

        if(Hash::check($request->current_password, \Auth::user()->password)) {

            User::find(\Auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

            // activity logs
            $id = Auth::user()->id;
            $name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
            $action_perform = '<a href="'.URL::to('/') . '/admin/student/profile/'. $id .'"> '.$name.' </a> Update his Password';
            $activity_logs = new GeneralController();
            $activity_logs->save_activity_logs("Password Changed", "users.id", $id, $action_perform, $request->header('User-Agent'), $id);

            return redirect()->back()->with(['success' => 'Password Change ...' , 'key' => 'password_changed']);
        }else{

            return redirect()->back()->with(['error' => 'You have entered wrong password', 'key' => 'password_changed']);

        }
    }


    public function getAllCategories() {
        $data = tktCat::all();

        return response()->json([
            "status_code" => 200,
            "categories" => $data,
        ]);

    }

    public function saveTicket(Request $request) {

        $length = 3;
        $string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $no = '1234567890';

        $ticket_no =  substr(str_shuffle($string),1,$length) . '-' . substr(str_shuffle($string),2,$length) . '-' . substr(str_shuffle($no),1,$length);

        $ticket = supportTkts::create([
            "subject" => $request->subject,
            "cat_id" => $request->category,
            "message" => $request->message,
            "user_id" => Auth::user()->id,
            "ticket_no" => $ticket_no,
        ]);

        // activity logs
        $id = Auth::user()->id;
        $name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        $action_perform = '<a href="'.URL::to('/') . '/admin/student/profile/'. $id .'"> '.$name.' </a> Create a New Ticket';
        $activity_logs = new GeneralController();
        $activity_logs->save_activity_logs("Ticket Created", "support_tkts.id", $ticket->id, $action_perform, $request->header('User-Agent'), $id);

        $admin = User::where('role',1)->first();
        $notification = new NotifyController();
        $slug = '-';
        $type = 'support_ticket';
        $data = 'data';
        $title = 'Support Ticket';
        $icon = 'fas fa-tag';
        $class = 'btn-success';
        $desc = $name . ' Create a Support Ticket';
        $pic = Auth::user()->picture;

        $notification->GeneralNotifi( $admin->id , $slug ,  $type , $title , $icon , $class ,$desc,$pic);

        return response()->json([
            "status_code" => 200,
            "message" => "Ticket Created .. Our Staff will contact us soon.",
            "success" => true,
        ]);
    }


    function favouriteTutor(Request $request) {

        $tutor = User::where('id',$request->id)->first();
        $tutor_name = $tutor->first_name . ' ' . $tutor->last_name;

        // activity logs
        $id = Auth::user()->id;
        $name = Auth::user()->first_name . ' ' . Auth::user()->last_name;

        if($request->status == "fav") {

            FavTutors::create([
                "user_id" => Auth::user()->id,
                "tutor_id" => $request->id,
            ]);

            $message = 'Tutor Added in Favourite List';

            $title = 'Favourite Tutor';
            $action_perform = '<a href="'.URL::to('/') . '/admin/student/profile/'. $id .'"> '.$name.' </a> Mark <a href="'.URL::to('/') . '/admin/tutor/profile/'. $id .'"> '.$tutor_name.' </a> Favourite ';


        }else{

            FavTutors::where("tutor_id",$request->id)->where("user_id",Auth::user()->id)->delete();

            $title = 'un-Favourite Tutor';
            $action_perform = '<a href="'.URL::to('/') . '/admin/student/profile/'. $id .'"> '.$name.' </a> Mark <a href="'.URL::to('/') . '/admin/tutor/profile/'. $id .'"> '.$tutor_name.' </a> Profile Un-Favourite ';

            $message = 'Tutor Removed form Favourite List';

        }

        // activity logs
        $activity_logs = new GeneralController();
        $activity_logs->save_activity_logs($title, "users.id", $request->id, $action_perform, $request->header('User-Agent'), $id);

        return response()->json([
            "status_code" => 200,
            "message" => $message,
            "success" => true,
        ]);

    }

    public function tickets($id) {
        $ticket = supportTkts::where('ticket_no',$id)->with(['category','tkt_created_by'])->first();
        $ticket_replies = TicketChat::with(['sender','receiver'])->where('ticket_id',$ticket->id)->get();
        $admin = User::where('role','1')->first();
        return view('student.pages.history.ticket_details',compact('ticket','ticket_replies','admin'));
    }


    public function ticketChat(Request $request){
        
        $data = $request->all();
        if(request()->has('file')){
            
            $filename = request('file')->store('ticket','public');
            // return $filename;
            $type = 'file';
            $message = TicketChat::create([
                'sender_id' => auth()->id(),
                'reciever_id' => $request->reciever_id,
                'text' => $filename,
                'type'=> $type,
                'ticket_id'=>$request->ticket_id,
            ]);
            $msg_type = 'file';
        }else{
            $type = 'text';
            $message = TicketChat::create([
                'sender_id' => auth()->id(),
                'reciever_id' => $request->reciever_id,
                'text' => $request->text,
                'type'=> $type,
                'ticket_id'=>$request->ticket_id,
            ]);
            $msg_type = 'text';
        }
        return response()->json([
            'data' => $message,
            'status_code' => 200,
            'message_type' => $msg_type,
            'message' => 'Message Sent Successfully',
            'success' => true
        ]);
    }






    // public function ticketChat(Request $request){

    //     $data = $request->all();
    //     if(request()->has('file')){
    //         $filename = request('file')->store('ticket','public');
    //         $type = 'file';
    //         $message = TicketChat::create([
    //             'sender_id' => auth()->id(),
    //             'reciever_id' => $request->reciever_id,
    //             'text' => $filename,
    //             'type'=> $type,
    //             'ticket_id'=>$request->ticket_id,
    //         ]);
    //         $msg_type = 'file';
    //     }else{
    //         $type = 'text';
    //         $message = TicketChat::create([
    //             'sender_id' => auth()->id(),
    //             'reciever_id' => $request->reciever_id,
    //             'text' => $request->text,
    //             'type'=> $type,
    //             'ticket_id'=>$request->ticket_id,
    //         ]);
    //         $msg_type = 'text';
    //     }
    //     return response()->json([
    //         'status_code' => 200,
    //         'message_type' => $msg_type,
    //         'message' => 'Message Sent Successfully',
    //         'success' => true
    //     ]);

    // }
    public function courses(){
        $courses = CourseEnrollment::where('user_id',Auth::user()->id)->get();
        return view('student.pages.course.index',compact('courses'));
    }
    public function courseDetails($id){

        $course = Course::with(['outline','enrolled'])->where('status',1)->where('id',$id)->first();
        $course_enrollment = CourseEnrollment::where('course_id',$course->id)->where('user_id',Auth::user()->id)->first();

        $commission = DB::table("sys_settings")->first();
        
        $basic_comm = $commission->commission / 100 * $course->basic_price;
        // Basic Classes
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
        $defaultPay = DB::table('payment_methods')->where('user_id',Auth::user()->id)->where('default',1)->first();

        return view('student.pages.course.course_detail',compact('course_enrollment','course','basic_comm','commission','defaultPay'));
    }


}
