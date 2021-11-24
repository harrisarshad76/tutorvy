<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\General\GeneralController;
use App\Http\Controllers\General\NotifyController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Activitylogs;
use App\Models\Classroom;
use App\Models\Booking;
use App\Models\ClassroomLogs;
use App\Models\General\TicketChat;
use App\Models\Admin\tktCat;
use App\Models\Admin\supportTkts;
use App\Models\User;
use App\Models\Wallet;
use App\Models\TutorSlots;
use Illuminate\Support\Facades\URL;

class SettingController extends Controller
{
    /**
     *  Return Tutor setting view
     */

    public function index(){

        $user = User::where('id',\Auth::user()->id)->first();
        $paypal_payment = DB::table('payment_methods')->where('user_id',Auth::user()->id)->where('method','paypal')->first();
        $user_slots = TutorSlots::where('user_id',Auth::user()->id)->get();

        $slots = array(
          array("value" => "1 Hours"),
          array("value" => "2 Hours"),
          array("value" => "3 Hours"),
          array("value" => "4 Hours"),
          array("value" => "5 Hours"),
        );

        $days = array(
            array("id" => 1 , "day" => "Monday"),
            array("id" => 2 , "day" => "Tuesday"),
            array("id" => 3 , "day" => "Wednesday"),
            array("id" => 4 , "day" => "Thursday"),
            array("id" => 5 , "day" => "Friday"),
            array("id" => 6 , "day" => "Saturday"),
            array("id" => 7 , "day" => "Sunday"),
        );

        return view('tutor.pages.setting.index',compact('user','paypal_payment','days','slots','user_slots'));
    }

    protected function validator(array $request) {
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

            // activity logs
            $id = Auth::user()->id;
            $name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
            $action_perform = '<a href="'.URL::to('/') . '/admin/tutor/profile/'. $id .'"> '.$name.' </a> Change his Password';
            $activity_logs = new GeneralController();
            $activity_logs->save_activity_logs("Change Password", "users.id", $id, $action_perform, $request->header('User-Agent'), $id);

            return redirect()->back('success','Password updated');
        }

    }

    public function call(){
        $users = User::where('role',3)->get();

        return view('tutor.pages.classroom.call',compact('users'));

    }

    public function whiteBoard(){
        $users = User::where('role',3)->get();

        return view('tutor.pages.classroom.classroom',compact('users'));

    }

    public function start_class($class_room_id){

        $class = Classroom::where('classroom_id',$class_room_id)->first();
        $booking = Booking::where('id',$class->booking_id)->first();

        // $class = Classroom::with('booking')->where('classroom_id',$class_room_id)->first();
        $user = User::where('id',Auth::user()->id)->first();
        // dd($class);
        return view('tutor.pages.classroom.classroom',compact('class','user','booking'));

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
            $action_perform = '<a href="'.URL::to('/') . '/admin/tutor/profile/'. $id .'"> '.$name.' </a> Change his Password';
            $activity_logs = new GeneralController();
            $activity_logs->save_activity_logs("Change Password", "users.id", $id, $action_perform, $request->header('User-Agent'), $id);

            $reciever = User::where('role',1)->first();
            $notification = new NotifyController();
            $reciever_id = $reciever->id;
            $slug = '-';
            $type = 'user_logout';
            $data = 'data';
            $title = 'User Logout';
            $icon = 'fas fa-tag';
            $class = 'btn-success';
            $desc = $name . ' Logout from System.';
            $pic = Auth::user()->picture;

            $notification->GeneralNotifi( $reciever_id , $slug ,  $type , $title , $icon , $class ,$desc,$pic);

            return redirect()->back()->with(['success' => 'Password Change ...' , 'key' => 'password_changed']);
        }else{


            return redirect()->back()->with(['error' => 'You have entered wrong password', 'key' => 'password_changed']);

        }
    }

    public function getAllCategories() {
        // $data = tktCat::all();

        $data = DB::table('tkt_cat')->get();
        return response()->json([
            "status_code" => 200,
            "categories" => $data,
        ]);

    }

    public function saveTicket(Request $request) {

        $length = 3;
        $string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $no = '1234567890';

        $ticket_no =  substr(str_shuffle($string),2,$length) . '-' . substr(str_shuffle($string),3,$length) . '-' . substr(str_shuffle($no),2,$length);

        supportTkts::create([
            "subject" => $request->subject,
            "cat_id" => $request->category,
            "message" => $request->message,
            "user_id" => Auth::user()->id,
            "ticket_no" => $ticket_no,
        ]);

        $name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
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

    public function ticket($id) {
        $ticket = supportTkts::where('ticket_no',$id)->with(['category','tkt_created_by'])->first();
        $ticket_replies = TicketChat::with(['sender','receiver'])->where('ticket_id',$ticket->id)->get();
        $admin = User::where('role','1')->first();
        // dd($ticket_replies);

        return view('tutor.pages.history.ticket_details',compact('ticket','ticket_replies','admin'));
       
    }

    public function ticketChat(Request $request){
        // $data = $request->all();
        // TicketChat::create($data);
        // return response()->json([
        //     'status_code'=> 200,
        //     'message' => 'Message Sent Successfully',
        //     'success' => true,
        //     'data' => $data,
        // ]);
        $data = $request->all();

        if(request()->has('file')){
            return "file";
            $filename = request('file')->store('ticket','public');
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
            'status_code' => 200,
            'message_type' => $msg_type,
            'message' => 'Message Sent Successfully',
            'success' => true
        ]);
    }

    public function saveTimeZone(Request $request) {

        $region =  substr($request->date ,25,50);
        User::where('id',Auth::user()->id)->update([
            "time_zone" => $request->zone,
            "region" => $region,
        ]);
        return response()->json([
            'status_code'=> 200,
            'message' => 'TimeZone Saved Successfully',
            'success' => true,
        ]);
    }

    public function saveSlots(Request $request) {
              
        $slots = TutorSlots::where('user_id',Auth::user()->id)->count();
        $message = '';

        if($slots  == 0) {
            for($i = 0; $i < count($request->day); $i++) {

                $data = array(
                    'user_id' => Auth::user()->id , 
                    'day' => $request->day[$i] ,
                    'wrk_from' => ($request->from[$i] ?? NULL) ,
                    'wrk_to' => ($request->to[$i] ?? NULL) ,
                );
                
                TutorSlots::create($data);
            }

            if($request->day_off != null && $request->day_off != "") {
                $days_oof = explode(',', $request->day_off);

                $all_slots = TutorSlots::where('user_id' , Auth::user()->id)->get();

                $z = 0;
                foreach($all_slots as $slot) {
                    $slot->day_off = $days_oof[$z];
                    $slot->save();
                    $z++;
                } 
            }
        }else{
            TutorSlots::where('user_id' , Auth::user()->id)->delete();

            for($i = 0; $i < count($request->day); $i++) {

                $data = array(
                    'user_id' => Auth::user()->id , 
                    'day' => $request->day[$i] ,
                    'wrk_from' => ($request->from[$i] ?? NULL) ,
                    'wrk_to' => ($request->to[$i] ?? NULL) ,
                );
                
                TutorSlots::create($data);
            }

            if($request->day_off != null && $request->day_off != "") {
                $days_oof = explode(',', $request->day_off);

                $all_slots = TutorSlots::where('user_id' , Auth::user()->id)->get();

                $z = 0;
                foreach($all_slots as $slot) {
                    $slot->day_off = $days_oof[$z];
                    $slot->save();
                    $z++;
                } 
            }
        }

        return response()->json([
            'status_code'=> 200,
            'message' => 'Time Slots Saved Successfully',
            'success' => true,
        ]);
    }


}
