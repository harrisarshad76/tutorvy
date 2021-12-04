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
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class SettingController extends Controller
{
    /**
     *  Return Tutor setting view
     */

    public function index(){

        $user = User::where('id',\Auth::user()->id)->first();
        $paypal_payment = DB::table('payment_methods')->where('user_id',Auth::user()->id)->where('method','paypal')->first();
        $user_slots = TutorSlots::where('user_id',Auth::user()->id)->get()->toArray();

        if(sizeOf($user_slots) > 0) {
            for($i = 0; $i < sizeOf($user_slots); $i++) {

                if($user_slots[$i]['wrk_from'] && $user_slots[$i]['wrk_to']) {
                    $tm = date('Y-m-d') .' '. $user_slots[$i]['wrk_from'];
                    $date = new \DateTime($tm, new \DateTimeZone(auth()->user()->time_zone));
                    $region_offset = $date->getOffset();
        
                    // to
                    $t_to = date('Y-m-d') . ' ' . $user_slots[$i]['wrk_to'];
                    $date2 = new \DateTime($t_to, new \DateTimeZone(auth()->user()->time_zone));
        
                    $a = $date->format('Y-m-d H:i:s P');
        
                    if(strpos($a , "+")) {
                        $from = Carbon::parse($tm)->addSeconds($region_offset)->format('H:i');
                        $to = Carbon::parse($t_to)->addSeconds($region_offset)->format('H:i');
                    }else if(strpos($a , "-")){
                        $from = Carbon::parse($tm)->subSeconds($region_offset)->format('H:i');
                        $to = Carbon::parse($t_to)->subSeconds($region_offset)->format('H:i');
                    }
        
                    $user_slots[$i]['wrk_from'] = $from;
                    $user_slots[$i]['wrk_to'] = $to;
                }    
            }
        }
        
        // dd($user_slots);

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

        $timezones = array(
            '(GMT-12:00) International Date Line West' => 'Pacific/Kwajalein',
            '(GMT-11:00) Midway Island' => 'Pacific/Midway',
            '(GMT-11:00) Samoa' => 'Pacific/Apia',
            '(GMT-10:00) Hawaii' => 'Pacific/Honolulu',
            '(GMT-09:00) Alaska' => 'America/Anchorage',
            '(GMT-08:00) Pacific Time (US & Canada)' => 'America/Los_Angeles',
            '(GMT-08:00) Tijuana' => 'America/Tijuana',
            '(GMT-07:00) Arizona' => 'America/Phoenix',
            '(GMT-07:00) Mountain Time (US & Canada)' => 'America/Denver',
            '(GMT-07:00) Chihuahua' => 'America/Chihuahua',
            '(GMT-07:00) La Paz' => 'America/Chihuahua',
            '(GMT-07:00) Mazatlan' => 'America/Mazatlan',
            '(GMT-06:00) Central Time (US & Canada)' => 'America/Chicago',
            '(GMT-06:00) Central America' => 'America/Managua',
            '(GMT-06:00) Guadalajara' => 'America/Mexico_City',
            '(GMT-06:00) Mexico City' => 'America/Mexico_City',
            '(GMT-06:00) Monterrey' => 'America/Monterrey',
            '(GMT-06:00) Saskatchewan' => 'America/Regina',
            '(GMT-05:00) Eastern Time (US & Canada)' => 'America/New_York',
            '(GMT-05:00) Indiana (East)' => 'America/Indiana/Indianapolis',
            '(GMT-05:00) Bogota' => 'America/Bogota',
            '(GMT-05:00) Lima' => 'America/Lima',
            '(GMT-05:00) Quito' => 'America/Bogota',
            '(GMT-04:00) Atlantic Time (Canada)' => 'America/Halifax',
            '(GMT-04:00) Caracas' => 'America/Caracas',
            '(GMT-04:00) La Paz' => 'America/La_Paz',
            '(GMT-04:00) Santiago' => 'America/Santiago',
            '(GMT-03:30) Newfoundland' => 'America/St_Johns',
            '(GMT-03:00) Brasilia' => 'America/Sao_Paulo',
            '(GMT-03:00) Buenos Aires' => 'America/Argentina/Buenos_Aires',
            '(GMT-03:00) Georgetown' => 'America/Argentina/Buenos_Aires',
            '(GMT-03:00) Greenland' => 'America/Godthab',
            '(GMT-02:00) Mid-Atlantic' => 'America/Noronha',
            '(GMT-01:00) Azores' => 'Atlantic/Azores',
            '(GMT-01:00) Cape Verde Is.' => 'Atlantic/Cape_Verde',
            '(GMT) Casablanca' => 'Africa/Casablanca',
            '(GMT) Dublin' => 'Europe/London',
            '(GMT) Edinburgh' => 'Europe/London',
            '(GMT) Lisbon' => 'Europe/Lisbon',
            '(GMT) London' => 'Europe/London',
            '(GMT) Monrovia' => 'Africa/Monrovia',
            '(GMT+01:00) Amsterdam' => 'Europe/Amsterdam',
            '(GMT+01:00) Belgrade' => 'Europe/Belgrade',
            '(GMT+01:00) Berlin' => 'Europe/Berlin',
            '(GMT+01:00) Bern' => 'Europe/Berlin',
            '(GMT+01:00) Bratislava' => 'Europe/Bratislava',
            '(GMT+01:00) Brussels' => 'Europe/Brussels',
            '(GMT+01:00) Budapest' => 'Europe/Budapest',
            '(GMT+01:00) Copenhagen' => 'Europe/Copenhagen',
            '(GMT+01:00) Ljubljana' => 'Europe/Ljubljana',
            '(GMT+01:00) Madrid' => 'Europe/Madrid',
            '(GMT+01:00) Paris' => 'Europe/Paris',
            '(GMT+01:00) Prague' => 'Europe/Prague',
            '(GMT+01:00) Rome' => 'Europe/Rome',
            '(GMT+01:00) Sarajevo' => 'Europe/Sarajevo',
            '(GMT+01:00) Skopje' => 'Europe/Skopje',
            '(GMT+01:00) Stockholm' => 'Europe/Stockholm',
            '(GMT+01:00) Vienna' => 'Europe/Vienna',
            '(GMT+01:00) Warsaw' => 'Europe/Warsaw',
            '(GMT+01:00) West Central Africa' => 'Africa/Lagos',
            '(GMT+01:00) Zagreb' => 'Europe/Zagreb',
            '(GMT+02:00) Athens' => 'Europe/Athens',
            '(GMT+02:00) Bucharest' => 'Europe/Bucharest',
            '(GMT+02:00) Cairo' => 'Africa/Cairo',
            '(GMT+02:00) Harare' => 'Africa/Harare',
            '(GMT+02:00) Helsinki' => 'Europe/Helsinki',
            '(GMT+02:00) Istanbul' => 'Europe/Istanbul',
            '(GMT+02:00) Jerusalem' => 'Asia/Jerusalem',
            '(GMT+02:00) Kyev' => 'Europe/Kiev',
            '(GMT+02:00) Minsk' => 'Europe/Minsk',
            '(GMT+02:00) Pretoria' => 'Africa/Johannesburg',
            '(GMT+02:00) Riga' => 'Europe/Riga',
            '(GMT+02:00) Sofia' => 'Europe/Sofia',
            '(GMT+02:00) Tallinn' => 'Europe/Tallinn',
            '(GMT+02:00) Vilnius' => 'Europe/Vilnius',
            '(GMT+03:00) Baghdad' => 'Asia/Baghdad',
            '(GMT+03:00) Kuwait' => 'Asia/Kuwait',
            '(GMT+03:00) Moscow' => 'Europe/Moscow',
            '(GMT+03:00) Nairobi' => 'Africa/Nairobi',
            '(GMT+03:00) Riyadh' => 'Asia/Riyadh',
            '(GMT+03:00) St. Petersburg' => 'Europe/Moscow',
            '(GMT+03:00) Volgograd' => 'Europe/Volgograd',
            '(GMT+03:30) Tehran' => 'Asia/Tehran',
            '(GMT+04:00) Abu Dhabi' => 'Asia/Muscat',
            '(GMT+04:00) Baku' => 'Asia/Baku',
            '(GMT+04:00) Muscat' => 'Asia/Muscat',
            '(GMT+04:00) Tbilisi' => 'Asia/Tbilisi',
            '(GMT+04:00) Yerevan' => 'Asia/Yerevan',
            '(GMT+04:30) Kabul' => 'Asia/Kabul',
            '(GMT+05:00) Ekaterinburg' => 'Asia/Yekaterinburg',
            '(GMT+05:00) Islamabad' => 'Asia/Karachi',
            '(GMT+05:00) Karachi' => 'Asia/Karachi',
            '(GMT+05:00) Tashkent' => 'Asia/Tashkent',
            '(GMT+05:30) Chennai' => 'Asia/Kolkata',
            '(GMT+05:30) Kolkata' => 'Asia/Kolkata',
            '(GMT+05:30) Mumbai' => 'Asia/Kolkata',
            '(GMT+05:30) New Delhi' => 'Asia/Kolkata',
            '(GMT+05:45) Kathmandu' => 'Asia/Kathmandu',
            '(GMT+06:00) Almaty' => 'Asia/Almaty',
            '(GMT+06:00) Astana' => 'Asia/Dhaka',
            '(GMT+06:00) Dhaka' => 'Asia/Dhaka',
            '(GMT+06:00) Novosibirsk' => 'Asia/Novosibirsk',
            '(GMT+06:00) Sri Jayawardenepura' => 'Asia/Colombo',
            '(GMT+06:30) Rangoon' => 'Asia/Rangoon',
            '(GMT+07:00) Bangkok' => 'Asia/Bangkok',
            '(GMT+07:00) Hanoi' => 'Asia/Bangkok',
            '(GMT+07:00) Jakarta' => 'Asia/Jakarta',
            '(GMT+07:00) Krasnoyarsk' => 'Asia/Krasnoyarsk',
            '(GMT+08:00) Beijing' => 'Asia/Hong_Kong',
            '(GMT+08:00) Chongqing' => 'Asia/Chongqing',
            '(GMT+08:00) Hong Kong' => 'Asia/Hong_Kong',
            '(GMT+08:00) Irkutsk' => 'Asia/Irkutsk',
            '(GMT+08:00) Kuala Lumpur' => 'Asia/Kuala_Lumpur',
            '(GMT+08:00) Perth' => 'Australia/Perth',
            '(GMT+08:00) Singapore' => 'Asia/Singapore',
            '(GMT+08:00) Taipei' => 'Asia/Taipei',
            '(GMT+08:00) Ulaan Bataar' => 'Asia/Irkutsk',
            '(GMT+08:00) Urumqi' => 'Asia/Urumqi',
            '(GMT+09:00) Osaka' => 'Asia/Tokyo',
            '(GMT+09:00) Sapporo' => 'Asia/Tokyo',
            '(GMT+09:00) Seoul' => 'Asia/Seoul',
            '(GMT+09:00) Tokyo' => 'Asia/Tokyo',
            '(GMT+09:00) Yakutsk' => 'Asia/Yakutsk',
            '(GMT+09:30) Adelaide' => 'Australia/Adelaide',
            '(GMT+09:30) Darwin' => 'Australia/Darwin',
            '(GMT+10:00) Brisbane' => 'Australia/Brisbane',
            '(GMT+10:00) Canberra' => 'Australia/Sydney',
            '(GMT+10:00) Guam' => 'Pacific/Guam',
            '(GMT+10:00) Hobart' => 'Australia/Hobart',
            '(GMT+10:00) Melbourne' => 'Australia/Melbourne',
            '(GMT+10:00) Port Moresby' => 'Pacific/Port_Moresby',
            '(GMT+10:00) Sydney' => 'Australia/Sydney',
            '(GMT+10:00) Vladivostok' => 'Asia/Vladivostok',
            '(GMT+11:00) Magadan' => 'Asia/Magadan',
            '(GMT+11:00) New Caledonia' => 'Asia/Magadan',
            '(GMT+11:00) Solomon Is.' => 'Asia/Magadan',
            '(GMT+12:00) Auckland' => 'Pacific/Auckland',
            '(GMT+12:00) Fiji' => 'Pacific/Fiji',
            '(GMT+12:00) Kamchatka' => 'Asia/Kamchatka',
            '(GMT+12:00) Marshall Is.' => 'Pacific/Fiji',
            '(GMT+12:00) Wellington' => 'Pacific/Auckland',
            '(GMT+13:00) Nuku\'alofa' => 'Pacific/Tongatapu'
        );

        
        $times = array(
            // array("value" => "00:00"),
            array("value" => "01:00"),
            array("value" => "02:00"),
            array("value" => "03:00"),
            array("value" => "04:00"),
            array("value" => "05:00"),
            array("value" => "06:00"),
            array("value" => "07:00"),
            array("value" => "08:00"),
            array("value" => "09:00"),
            array("value" => "10:00"),
            array("value" => "11:00"),
            array("value" => "12:00"),
            array("value" => "13:00"),
            array("value" => "14:00"),
            array("value" => "15:00"),
            array("value" => "16:00"),
            array("value" => "17:00"),
            array("value" => "18:00"),
            array("value" => "19:00"),
            array("value" => "20:00"),
            array("value" => "21:00"),
            array("value" => "22:00"),
            array("value" => "23:00"),
            array("value" => "24:00"),

        );

        return view('tutor.pages.setting.index',compact('user','paypal_payment','days','slots','user_slots','times','timezones'));
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
            for($i = 0; $i < sizeOf($request->from); $i++) {

                $tm = date('Y-m-d') . ' ' . $request->from[$i];
                $date = new \DateTime($tm, new \DateTimeZone(auth()->user()->time_zone));
                $region_offset = $date->getOffset();

                // to
                $t_to = date('Y-m-d') . ' ' . $request->to[$i];
                $date2 = new \DateTime($t_to, new \DateTimeZone(auth()->user()->time_zone));

                $a = $date->format('Y-m-d H:i:s P');

                if(strpos($a , "+")) {
                    $from = Carbon::parse($tm)->subSeconds(abs($region_offset))->format('H:i');
                    $to = Carbon::parse($t_to)->subSeconds(abs($region_offset))->format('H:i');
                }else if(strpos($a , "-")){
                    $from = Carbon::parse($tm)->addSeconds(abs($region_offset))->format('H:i');
                    $to = Carbon::parse($t_to)->addSeconds(abs($region_offset))->format('H:i');
                }

                $data = array(
                    'user_id' => Auth::user()->id , 
                    'day' => $request->day,
                    'wrk_from' => $from ,
                    'wrk_to' => $to ,
                    'day_off' => ($request->d_off ?? NULL) ,
                );
                
                TutorSlots::create($data);
            }
        }else{
            TutorSlots::where('user_id' , Auth::user()->id)->where('day',$request->day)->delete();

            for($i = 0; $i < sizeOf($request->from); $i++) {

                $tm = date('Y-m-d') . ' ' . $request->from[$i];
                $date = new \DateTime($tm, new \DateTimeZone(auth()->user()->time_zone));
                $region_offset = $date->getOffset();

                // to
                $t_to = date('Y-m-d') . ' ' . $request->to[$i];
                $date2 = new \DateTime($t_to, new \DateTimeZone(auth()->user()->time_zone));

                $a = $date->format('Y-m-d H:i:s P');

                if(strpos($a , "+")) {
                    $from = Carbon::parse($tm)->subSeconds($region_offset)->format('H:i');
                    $to = Carbon::parse($t_to)->subSeconds($region_offset)->format('H:i');
                }else if(strpos($a , "-")){
                    $from = Carbon::parse($tm)->addSeconds($region_offset)->format('H:i');
                    $to = Carbon::parse($t_to)->subSeconds($region_offset)->format('H:i');
                }

                $data = array(
                    'user_id' => Auth::user()->id , 
                    'day' => $request->day,
                    'wrk_from' => $from ,
                    'wrk_to' => $to ,
                    'day_off' => ($request->d_off ?? NULL) ,
                );
                
                TutorSlots::create($data);
            }
        }

        return response()->json([
            'status_code'=> 200,
            'message' => 'Time Slots Saved Successfully',
            'success' => true,
        ]);
    }


    public function deleteSlots(Request $request) {
        TutorSlots::where('id' , $request->id)->where('day',$request->day)->delete();

        return response()->json([
            'status_code'=> 200,
            'message' => 'Time Slots Deleted Successfully',
            'success' => true,
        ]);
    } 

    public function testMedia($class_room_id){
       
        $class = Classroom::where('classroom_id',$class_room_id)->first();
        $booking = Booking::where('id',$class->booking_id)->first();

        // $class = Classroom::with('booking')->where('classroom_id',$class_room_id)->first();
        $user = User::where('id',Auth::user()->id)->first();
        // dd($class);
        return view('tutor.pages.classroom.testmedia',compact('class','user','booking'));
    }

}
