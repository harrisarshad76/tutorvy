<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Controllers\General\GeneralController;
use App\Http\Controllers\General\NotifyController;
use App\Models\Booking;
use App\Models\Classroom;
use App\Models\User;
use App\Models\TutorSlots;
use App\Models\Activitylogs;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\General\Teach;
use App\Models\Admin\tktCat;
use App\Models\Admin\supportTkts;
use App\Models\Admin\Subject;
use App\Models\Course;
use App\Models\OrphanBooking;
use App\Models\CourseEnrollment;
use App\Models\Payments;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;
use Redirect;
use Input;
use App\Models\subjectPlans;
use Illuminate\Contracts\Session\Session as SessionSession;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\PayerInfo;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Refund;
use PayPal\Api\RefundRequest;
use PayPal\Api\Sale;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use Obydul\LaraSkrill\SkrillClient;
use Obydul\LaraSkrill\SkrillRequest;
use App\Models\Wallet;
use DateTime;
use Illuminate\Support\Carbon;
use Carbon\CarbonPeriod;

class BookingController extends Controller
{

    private $_api_context, $skrilRequest,$pay_from_email;

    public function __construct()
    {

        $paypal_configuration = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['sandbox']['client_id'], $paypal_configuration['sandbox']['client_secret']));
        $this->_api_context->setConfig($paypal_configuration);


    }

    public function index()
    {

        $all = Booking::with(['tutor'])->where('user_id',Auth::user()->id)->get();
        $pending = Booking::with('tutor')->where('user_id',Auth::user()->id)->whereIn('status',[0,1])->get();
        $confirmed = Booking::with('tutor')->where('user_id',Auth::user()->id)->status(2)->get();

        $completed = Booking::with('tutor')->where('user_id',Auth::user()->id)->status(5)->get();
        $cancelled = Booking::with('tutor')->where('user_id',Auth::user()->id)->whereIn('status',[3,4,6])->get();

        $commission = DB::table("sys_settings")->first();
        $defaultPay = DB::table('payment_methods')->where('user_id',Auth::user()->id)->where('default',1)->first();

        return view('student.pages.booking.index',compact('confirmed','pending','completed','cancelled','all','commission','defaultPay'));
    }




    public function bookNow($t_id,$b_id){
        $subjects = Teach::where('user_id',$t_id)->with('subject_plans')->get();
        $user = User::with(['education','professional','teach'])->where('id',$t_id)->first();
        $op_booking = OrphanBooking::where('uuid',$b_id)->first();

        return view('student.pages.booking.book_now',compact('t_id','subjects','user','op_booking'));
    }

    public function book_now(Request $request) {
        
        $uuid = mt_rand(100000,999999);
        $op_booking = new OrphanBooking();
        $op_booking->uuid = $uuid;
        $op_booking->tutor_id = $request->tutor_id;
        $op_booking->user_id = \Auth::user()->id;
        $op_booking->day = $request->day;
        $op_booking->date = $request->date;
        $op_booking->slot = $request->time;
        $op_booking->timezone = \Auth::user()->timezone;
        $op_booking->save();

        $subjects = Teach::where('user_id',$request->tutor_id)->with('subject_plans')->get();
        $user = User::with(['education','professional','teach'])->where('id',$request->tutor_id)->first();

        // return view('student.pages.booking.book_now',compact('subjects','user','op_booking'));

        return redirect('/student/book-now/'.$request->tutor_id.'/'.$uuid );

        // return $request;

        // $subjects = Teach::where('user_id',$t_id)->with('subject_plans')->get();
        // $user = User::with(['education','professional','teach'])->where('id',$t_id)->first();
        // $attr = array( "slug" => $date , "time" => $time);
        // return view('student.pages.booking.book_now',compact('t_id','subjects','user','attr'));
    }


    public function getTutorSlots(Request $request) {

        $slots = TutorSlots::where('user_id',$request->id)->get();
        $user = User::where('id',$request->id)->first();
        $slots_partition = [];
        $center_slot = '';
        $end_slot = '';

        foreach($slots as $slot){

            $tm = date('Y-m-d') .' '. $slot->wrk_from;
            $date = new \DateTime($tm, new \DateTimeZone(auth()->user()->time_zone));
            $region_offset = $date->getOffset();

            // to
            $t_to = date('Y-m-d') . ' ' . $slot->wrk_to;
            $date2 = new \DateTime($t_to, new \DateTimeZone(auth()->user()->time_zone));

            $a = $date->format('Y-m-d H:i:s P');

            if(strpos($a , "+")) {
                $from = Carbon::parse($tm)->addSeconds($region_offset)->format('H:i');
                $to = Carbon::parse($t_to)->addSeconds($region_offset)->format('H:i');
            }else if(strpos($a , "-")){
                $from = Carbon::parse($tm)->subSeconds($region_offset)->format('H:i');
                $to = Carbon::parse($t_to)->subSeconds($region_offset)->format('H:i');
            }

            $period = new CarbonPeriod($from , '30 minutes', $to); 
            
            foreach($period as $item){

                $start = $item->format("H:i");
                $end = date('H:i',strtotime($start . ' +60 minutes'));
                
                $st_tmp = '';
                $end_tmp = '';


                if(strpos($a , "+")) {
                    $st_tmp = Carbon::parse($start)->subSeconds($region_offset)->format('H:i');
                    $end_tmp = Carbon::parse($end)->subSeconds($region_offset)->format('H:i');
                }else if(strpos($a , "-")){
                    $st_tmp = Carbon::parse($start)->addSeconds($region_offset)->format('H:i');
                    $end_tmp = Carbon::parse($end)->addSeconds($region_offset)->format('H:i');
                }
                // DB::enableQueryLog(); // Enable query log
                $booking = Booking::where('class_time',$st_tmp)
                ->where('class_booked_till',$end_tmp)
                ->where('class_date',$request->date)
                ->where('booked_tutor',$request->id)
                ->where('status','!=',3)
                ->where('status','!=',4)
                ->where('status','!=',6)
                ->where('status',2)
                ->first();
                // Your Eloquent query executed by using get()
                
                // dd(DB::getQueryLog()); // Show results of log
                
                            // return $booking;
                            // return dd($from .'-'. $to);
                if($center_slot != ''){
                    $center_slot = '';
                    continue;
                }
                if($end_slot != ''){
                    $end_slot = '';
                    continue;
                }

                
                if($booking){

                    $center_slot = date('H:i',strtotime($start . ' +30 minutes'));
                    $end_slot = $end;

                }else{
                    $start_check = date('H:i',strtotime($st_tmp . ' +30 minutes'));
                    $booking = Booking::where('class_time',$start_check)
                                ->where('class_date',$request->date)
                                ->where('booked_tutor',$request->id)
                                ->where('status','!=',3)
                                ->where('status','!=',4)
                                ->where('status','!=',6)
                                ->where('status','!=',2)

                                ->first();

                    if($booking){

                    }else{

                        if($item->format("H:i") == $to){
                            array_pop($slots_partition);
                        }elseif($item->format("H:i") == "00:00" && $to == "24:00"){
                            array_pop($slots_partition);
                        }else{
    
                            $_id = sprintf( '%04x%04x', mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), );
                         
                            $calculated_slot = new \stdClass();
                            $calculated_slot->id = $_id;
                            $calculated_slot->wrk_from = $item->format("H:i");
                            $calculated_slot->day = $slot->day;
                            array_push($slots_partition,$calculated_slot);
                        }
                    }
                    
                }
                
            }
        }
        // return $slots_partition;
        return response()->json([
            'status_code'=> 200,
            'success' => true,
            'slots' => $slots_partition,
            'tt_tmz' => $user->time_zone
        ]);
    }

    function getFilteredTimeSlot(Request $request)
    {

        $period = new CarbonPeriod('09:00', '30 minutes', '24:00'); // for create use 24 hours format later change format 
        $slots = [];
        foreach($period as $item){
            array_push($slots,$item->format("H:i"));
        }

        return $slots;
        // $interval = $request->interval * 60;
        // $start_time = $request->start_time;
        // $end_time = $request->end_time;
        // $date = $request->date;
        // $t_id = $request->t_id;

        // $start = new DateTime($start_time);
        // $end = new DateTime($end_time);
        // $startTime = $start->format('H:i');
        // $endTime = $end->format('H:i');

        // // $startTime = $start_time;
        // // $endTime = $end_time;
        // // return strtotime($startTime) .'---'.strtotime($endTime);
        // $i=0;
        // $slots = array();
        // // return strtotime($startTime) .' -- '. strtotime($endTime);
        // while(strtotime($startTime) < strtotime($endTime)){
        //     $start = $startTime;
        //     // return $start;
        //     $end = date('H:i',strtotime('+'. 30 ,strtotime($startTime)));
        //     $startTime = date('H:i',strtotime('+'. 30 ,strtotime($startTime)));
        //     $slot = new \stdClass();
        //     $booking = Booking::where('class_time',$start)->where('class_booked_till',$end)->where('class_date',$date)->where('booked_tutor',$t_id)->where('status','!=',3)->where('status','!=',4)->first();
        //     // return $startTime .'---'.$end ;
           
        //     if(strtotime($startTime) <= strtotime($endTime)){
        //         if($booking){
                    
        //         }else{
        //             $slot->slot_start_time = $start;
        //             $slot->slot_end_time = $end;
        //             array_push($slots,$slot);
        //         }
        //     }
        // }
        // return $time;
        return response()->json([
            'status_code'=> 200,
            'success' => true,
            'slots' => $slots,
        ]);
    }

    public function bookingDetail($id){

        $booking = Booking::with(['tutor','user','subject'])->where('id',$id)->first();
        return view('student.pages.booking.booking_detail',compact('booking'));
    }

    public function bookingNew(Request $request){

        $booking = Booking::with(['tutor','user','subject'])->where('id',$request->id)->first();
        $commission = $commission = DB::table("sys_settings")->first();

        return response()->json([
            'status_code'=>200,
            'success' => true,
            'booking' => $booking,
            'commission' => $commission,
        ]);

    }

    public function directBooking($id)
    {

        $tutor = User::with('teach')->find($id);
       return view('student.pages.booking.booking',compact('tutor'));
    }

    public function booked(Request $request)
    {
        $tm = $request->current_date . ' ' . $request->class_time;
        $ldate = date('Y-m-d H:i');
        $date = new \DateTime($tm, new \DateTimeZone(auth()->user()->time_zone));
        $region_offset = $date->getOffset();

        $a = $date->format('Y-m-d H:i:s P');
    
        if(strpos($a , "+")) {

            $converted_date =  Carbon::parse($tm)->subSeconds($region_offset)->format('Y-m-d H:i:s');
            $bk_time =  Carbon::parse($tm)->subSeconds($region_offset)->format('H:i');
            $bk_end_time =  Carbon::parse($tm)->subSeconds($region_offset)->addSeconds(3600)->format('H:i');

        }else if(strpos($a , "-")){

            $converted_date =  Carbon::parse($tm)->addSeconds($region_offset)->format('Y-m-d H:i:s');
            $bk_time =  Carbon::parse($tm)->addSeconds($region_offset)->format('H:i');
            $bk_end_time =  Carbon::parse($tm)->addSeconds($region_offset)->addSeconds(3600)->format('H:i');

        }



        // $timezone_offset_minutes = $request->offset;
        // $timezone_name = timezone_name_from_abbr("", $timezone_offset_minutes*60, false);
        // return $timezone_name;


        // $ldate = date('Y-m-d H:i');
        // return $ldate;
        // $date = new \DateTime();
        // $ldate = $request->current_date.' '.$request->class_time;
        // return $ldate;
        // $datetime = Carbon::createFromFormat('Y-m-d H:i', $ldate);
        
        // $datetime->setTimezone('Asia/Kabul');
        // return $datetime;
        // return date("H:i", strtotime($request->class_time));
        // return dd($request->all());
        $class_date = $request->current_date;
        // $class_time = explode("-",$request->time);
     
        // $from_time = explode(" ",$class_time[0]);
        // $from_time = $from_time[0];
        $from_time = date("H:i", strtotime( $request->class_time));

        // return Carbon::now($request->class_time);
       
        // $to_time = explode(" ",$class_time[1]);
        // $to_time = $to_time[0];
        $to_time = date("H:i", strtotime($request->class_end_time));
        // return $bk_time . ' - ' . $bk_end_time;
        $booking = Booking::where('class_time',$bk_time)->where('class_booked_till',$bk_end_time)->where('class_date',$class_date)->where('booked_tutor',$request->tutor_id)->where('status','!=',3)->where('status','!=',4)->where('status','!=',6)->get();
        // return $booking->count();
        // $booking = Booking::where('class_time',$from_time)->where('class_booked_till',$to_time)->where('class_date',$class_date)->where('booked_tutor',$request->tutor_id)->get();

        if($booking->count() <= 0){

            $attachments = [];
            $path = '';
            if($request->hasFile('upload')){
                $path = 'storage/booking/docs/'.$request->upload->getClientOriginalName();
                $request->upload->storeAs('booking/docs',$request->upload->getClientOriginalName(),'public');
            }

            $tutor = User::where('id',$request->tutor_id)->first();
            $price = $request->subject_plan * 1;

            $booking = Booking::create([
                'user_id' => Auth::user()->id,
                'uuid' => 'BK-'.$request->_id,
                'booked_tutor' => $request->tutor_id,
                'subject_id' =>$request->subject,
                'topic' => $request->topic,
                'question' => $request->question,
                'brief' => $request->brief,
                'attachments' => $path,
                'class_date' => $request->current_date,
                'class_time' => $bk_time,
                'class_booked_till' => $bk_end_time,
                'duration' => 1,
                'price' => $price,
                'server_time' => $converted_date,
            ]);

            OrphanBooking::where('uuid',$request->_id)->delete();

            $subject = Subject::where("id",$request->subject)->first();

            // activity logs
            $id = Auth::user()->id;
            $name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
            $action_perform = '<a href="'.URL::to('/') . '/admin/student/profile/'. $id .'"> '.$name.' </a> request for book a class of '.$subject->name ;
            $activity_logs = new GeneralController();
            $activity_logs->save_activity_logs("Class Booking", "bookings.id", $booking->id, $action_perform, $request->header('User-Agent'), $id);
            $reciever_ids = [];

            $reciever = User::where('role',1)->first();

            $notification = new NotifyController();
            $slug = URL::to('/') . '/tutor/booking-detail/'. $booking->id  ;
            $type = 'class_booking';
            $title = 'Class Booking Request';
            $icon = 'fas fa-tag';
            $class = 'btn-success';
            $desc = $name . ' request for book a class of '.$subject->name;
            $pic = Auth::user()->picture;

            // tutor notification
            $notification->GeneralNotifi($request->tutor_id,$slug,$type,$title,$icon,$class,$desc,$pic);

            // admin notification
            $notification->GeneralNotifi($reciever->id,$slug,$type,$title,$icon,$class,$desc,$pic);


            // timezone
            if($request->current_date != null && $request->current_date != "") {

                $booking_region =  substr($request->current_date ,25,50);

                if(Auth::user()->region != null && Auth::user()->region != "") {

                    if(Auth::user()->region != $booking_region) {
                        User::where('id', Auth::user()->id)->update([
                            "region" => $booking_region,
                        ]);
                    }

                }else{

                    User::where('id', Auth::user()->id)->update([
                        "region" => $booking_region,
                    ]);

                }

            }

            return response()->json([
                'status'=>200,
                'type' => 'success',
                'message' => 'Booking Added Successfully!'
            ]);

        }else{
            return response()->json([
                'status'=>400,
                'type' => 'error',
                'message' => 'Class is already booked between '.date("h:i A",strtotime($from_time)).' to '.date("h:i A",strtotime($to_time))
            ]);
        }
    }

    public function bookingPayment(Request $request,$id)
    {
        $total_price = 0;
        $booking = Booking::where('id',$request->id)->first();
        $commission = DB::table("sys_settings")->first();

        if($commission) {
            $comm = ($booking->price * $commission->commission) / 100;
            $total_price = $booking->price + $comm;
        }else{
            $total_price = $booking->price;
            $comm = 0;
        }

        Session::put('service_fee',$comm);

        if(!$booking){
            Session::flash('error','Unable to process booking not available.');
            return redirect()->route('student.bookings');
        }
        if($total_price == null || $total_price == 0.00 || $total_price == 0){
            Session::flash('error','Unable to process booking with invalid amount.');
            return redirect()->route('student.bookings');
        }

        //skrill payment method
        if($request->paymentMethod == 'skrill'){
            $redirectUrl = $this->skrillPayment($total_price,$commission,$comm,$booking,$request->id);
            return redirect()->to($redirectUrl);

        }elseif($request->paymentMethod == 'wallet'){

            $walletIn  = Wallet::where('user_id',Auth::user()->id)->where('type','in')->sum('amount');
            $walletOut = Wallet::where('user_id',Auth::user()->id)->where('type','out')->sum('amount');
            $balance   = $walletIn-$walletOut;

            if($balance >= $total_price){

                $booking_id = Session::get('bookingId');
                $booking = Booking::where('id',$booking_id)->first();

                $classroom_id = sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                    mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
                    mt_rand( 0, 0xffff ),
                    mt_rand( 0, 0x0C2f ) | 0x4000,
                    mt_rand( 0, 0x3fff ) | 0x8000,
                    mt_rand( 0, 0x2Aff ), mt_rand( 0, 0xffD3 ), mt_rand( 0, 0xff4B )
                );

                $subject = Subject::where('id',$booking->subject_id)->first();
                $booking->status = 2;
                $booking->service_fee =  Session::get('service_fee');
                $booking->save();

                Classroom::create([
                    'booking_id' => $booking_id,
                    'classroom_id' => $classroom_id
                ]);

                $id = Auth::user()->id;
                $name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
                $action_perform = '<a href="'.URL::to('/') . '/admin/student/profile/'. $id .'"> '.$name.' </a> Payment success';
                $activity_logs = new GeneralController();
                $activity_logs->save_activity_logs("Payment Success", "users.id", $id, $action_perform, $request->header('User-Agent'), $id);

                $admin = User::where('role',1)->first();

                $notification = new NotifyController();
                $slug = URL::to('/') . '/tutor/booking-detail/' . $booking->id;
                $type = 'booking_confirmed';
                $title = 'Booking Confirmed';
                $icon = 'fas fa-tag';
                $class = 'btn-success';
                $desc = $name . ' Paid for Class of ' . $subject->name;
                $pic = Auth::User()->picture;
                $notification->GeneralNotifi($booking->booked_tutor ,$slug,$type,$title,$icon,$class,$desc,$pic);

                // send to admin
                $admin_slug = URL::to('/') . '/admin/booking-detail/' . $booking->id;
                $notification->GeneralNotifi($admin->id,$admin_slug,$type,$title,$icon,$class,$desc,$pic);


                $transaction_id = Session::get('transaction_id');
                $total_price = Session::get('amount');

                Payments::create([
                    'user_id' => Auth::user()->id,
                    'type_id' => $booking->id,
                    'type' => 'Booked Class',
                    'transaction_id' =>  $transaction_id,
                    'amount'  => $total_price,
                    'service_fee'  => Session::get('service_fee'),
                    'method'  => 'wallet'
                ]);

                Wallet::create([
                    'user_id' => Auth::user()->id,
                    'amount' => $total_price,
                    'type' => 'out',
                ]);

            }
            Session::flash('error','You have insufficient balance');
            return redirect()->back();
        }else{
            //Payment Through Paypal
            $redirect_url = $this->paypalPayment($total_price,$booking,'booking');

            if(isset($redirect_url)) {
                return redirect()->away($redirect_url);
            }

            Session::flash('error','Unknown error occurred');

        }

    	return redirect()->route('student.bookings');

    }

    public function cancelBooking(Request $request,$id)
    {
        $booking = Booking::find($id);

        $refund_amount = $booking->price;
        $saleId = Payments::where('type_id',$booking->id)->first()->sale_id ?? '';

        if($saleId){
                $paymentValue =  (string) round($refund_amount,2); ;

                // ### Refund amount
                // Includes both the refunded amount (to Payer)
                // and refunded fee (to Payee). Use the $amt->details
                // field to mention fees refund details.
                $amt = new Amount();
                $amt->setCurrency('USD')
                    ->setTotal($paymentValue);

                // ### Refund object
                $refundRequest = new RefundRequest();
                $refundRequest->setAmount($amt);

                // ###Sale
                // A sale transaction.
                // Create a Sale object with the
                // given sale transaction id.
                $sale = new Sale();
                $sale->setId($saleId);
                try {
                    $refundedSale = $sale->refundSale($refundRequest, $this->_api_context);
                } catch (\Exception $ex) {

                    return redirect()->back()->with('error','Something went wrong!');

                }

                if($refundedSale->state == 'completed'){

                    Payments::create([
                        'user_id' => Auth::user()->id,
                        'type' => 'payment_refund',
                        'transaction_id' => $booking->payment->first()->transaction_id,
                        'sale_id' => $refundedSale->sale_id ?? '',
                        'amount'  => $refundedSale->amount->total,
                        'method'  => 'paypal'
                    ]);

                    $booking->status = 4;
                    $booking->save();
                }
                    return redirect()->route('student.bookings')->with('success', '$'.$refundedSale->amount->total.' amount has been refunded to your account successfully!');

        }else{

            $booking->status = 4;
            $booking->save();

        return redirect()->route('student.bookings')->with('success', 'Booking has been successfully!');
        }

    }

    public function coursePayment(Request $request,$id)
    {
        $course = Course::where('id',$id)->first();
        $commission = DB::table("sys_settings")->first();
        $tutor_fee = $request->amount - $request->comm ;
        $course->price = $tutor_fee;

        Session::put('service_fee',$request->comm);

        if($course->seats != 0){

            if($request->paymentMethod == 'skrill'){
                Session::put('plan',$request->plan);
                $redirectUrl = $this->skrillPayment($request->amount,$commission,$request->comm,$course,$id);
                return redirect()->to($redirectUrl);

            }elseif($request->paymentMethod == 'wallet'){

                $walletIn  = Wallet::where('user_id',Auth::user()->id)->where('type','in')->sum('amount');
                $walletOut = Wallet::where('user_id',Auth::user()->id)->where('type','out')->sum('amount');
                $balance   = $walletIn-$walletOut;

                if($balance >= $request->amount){

                    $course = Course::where('id',$id)->first();

                    $course->seats = $course->seats - 1;
                    $course->save();

                    CourseEnrollment::create([
                        'user_id' => Auth::user()->id,
                        'course_id' => $course->id,
                        'plan' => $request->plan,
                        'price' => $request->amount,
                        'service_fee' => $request->comm,
                        'status' => 1
                    ]);


                    $classroom_id = sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
                        mt_rand( 0, 0xffff ),
                        mt_rand( 0, 0x0C2f ) | 0x4000,
                        mt_rand( 0, 0x3fff ) | 0x8000,
                        mt_rand( 0, 0x2Aff ), mt_rand( 0, 0xffD3 ), mt_rand( 0, 0xff4B )
                    );

                    Classroom::create([
                        'course_id' => $course->id ?? null,
                        'classroom_id' => $classroom_id
                    ]);

                    $id = Auth::user()->id;
                    $name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
                    $action_perform = '<a href="'.URL::to('/') . '/admin/student/profile/'. $id .'"> '.$name.' </a> Payment success';
                    $activity_logs = new GeneralController();
                    $activity_logs->save_activity_logs("Payment Success", "users.id", $id, $action_perform, $request->header('User-Agent'), $id);

                    $admin = User::where('role',1)->first();


                    $notification = new NotifyController();
                    $slug = URL::to('/') . '/tutor/course-detail/' . $course->id;
                    $type = 'course_enrlled';
                    $title = 'Course Enrolled';
                    $icon = 'fas fa-tag';
                    $class = 'btn-success';
                    $desc = $name.' Paid for Course of '. $course->title;
                    $pic = Auth::User()->picture;
                    $notification->GeneralNotifi($course->booked_tutor ,$slug,$type,$title,$icon,$class,$desc,$pic);

                    // send to admin
                    $admin_slug = URL::to('/') . '/admin/course-detail/' . $course->id;
                    $notification->GeneralNotifi($admin->id,$admin_slug,$type,$title,$icon,$class,$desc,$pic);

                    $transaction_id = Session::get('transaction_id');

                    Payments::create([
                        'user_id' => Auth::User()->id,
                        'type_id' =>  $course->id,
                        'type' => 'course_enrollment',
                        'transaction_id' =>  $transaction_id,
                        'amount'  => $request->amount,
                        'service_fee'  => Session::get('service_fee'),
                        'method'  => 'skrill'
                    ]);

                    Wallet::create([
                        'user_id' => Auth::user()->id,
                        'amount' => $request->amount,
                        'type' => 'out',
                    ]);

                }
                Session::flash('error','You have sufficient balance');
                return redirect()->back();
            }else{
                //Payment Through Paypal
                Session::put('plan',$request->plan);
                $redirect_url = $this->paypalPayment($request->amount,$course,'course');
                if(isset($redirect_url)) {
                    return redirect()->away($redirect_url);
                }

                Session::flash('error','Unknown error occurred');

            }


            return redirect()->route('student.course');
        }elseif($course->seats == 0){
            Session::flash('error','Course Seats are filled, We are unabled to process course enrollment');
            return redirect()->back();
        }
        else{
            Session::flash('error','Unable to process booking with invalid amount.');
            return redirect()->back();
        }

        // dd($booking,$commission,$request->comm,$total_price);



    }

    private function paypalPayment($total_price,$booking,$type)
    {
            $payerEmail = DB::table('payment_methods')
                                ->where('user_id',Auth::user()->id)
                                ->where('method','paypal')
                                ->first();

            $payer = new Payer();
            $payer->setPaymentMethod('paypal');

            if(isset($payerEmail)):
                $payerInfo = new PayerInfo();
                $payerInfo->setEmail($payerEmail->email);
                $payer->setPayerInfo($payerInfo);
            endif;

            $item_1 = new Item();

            $item_1->setName('Online Class')
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice($total_price);

            $item_list = new ItemList();
            $item_list->setItems(array($item_1));

            $amount = new Amount();
            $amount->setCurrency('USD')
                ->setTotal($total_price);

            $transaction = new Transaction();
            $transaction->setAmount($amount)
                ->setItemList($item_list)
                ->setDescription('Enter Your transaction description');

            $redirect_urls = new RedirectUrls();
            $redirect_urls->setReturnUrl(URL::route('student.paymentstatus'))
                ->setCancelUrl(URL::route('student.paymentstatus'));

            $payment = new Payment();
            $payment->setIntent('Sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirect_urls)
                ->setTransactions(array($transaction));
            try {
                $payment->create($this->_api_context);
            } catch (\PayPal\Exception\PPConnectionException $ex) {
                if (\Config::get('app.debug')) {
                    Session::flash('error','Connection timeout');
                    return redirect()->route('student.bookings');
                } else {
                    Session::flash('error','Some error occur, sorry for inconvenient');
                    return redirect()->route('student.bookings');
                }
            }

            foreach($payment->getLinks() as $link) {
                if($link->getRel() == 'approval_url') {
                    $redirect_url = $link->getHref();
                    break;
                }
            }
            Session::put('booking_id', $booking->id);
            Session::put('booking_type', $type);
            Session::put('payment_id', $payment->getId());

            return $redirect_url;
    }

    public function paymentDone(Request $request){

        try{
            // Payments::create([
            //     'user_id' => Auth::user()->id,
            //     'type' => 'Deposit Balance',
            //     'transaction_id' => $request->paymentID,
            //     'amount'  => $request->amount,
            //     'method'  => $request->method
            // ]);
            $booking = '';
            $subject = '';
            $course = '';
            if($request->type == 'booking_class'){
                $booking = Booking::where('id',$request->type_id)->first();
                if($booking != null){
                    $subject = Subject::where('id',$booking->subject_id)->first();
                    $booking->status = 2;
                    $booking->service_fee =  $request->service_fee;
                    $booking->save();
                }
            }else if($request->type == 'course_enrollment'){

            }
            Payments::create([
                'user_id' => Auth::user()->id,
                'type_id' => $request->type_id ,
                // 'type' => ($booking != null) ? 'booking_class' : 'course_enrollment',
                'type' => $request->type,
                'transaction_id' => $request->paymentID,
                // 'sale_id' => $result->transactions[0]->related_resources[0]->sale->id ?? '',
                'amount'  => $request->amount,
                'service_fee' => $request->service_fee,
                'method'  => $request->method
            ]);

            $classroom_id = sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
                mt_rand( 0, 0xffff ),
                mt_rand( 0, 0x0C2f ) | 0x4000,
                mt_rand( 0, 0x3fff ) | 0x8000,
                mt_rand( 0, 0x2Aff ), mt_rand( 0, 0xffD3 ), mt_rand( 0, 0xff4B )
            );

            Classroom::create([
                'booking_id' => $booking->id ?? null,
                'classroom_id' => $classroom_id
            ]);

           


            $id = Auth::user()->id;
            $name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
            $action_perform = '<a href="'.URL::to('/') . '/admin/student/profile/'. $id .'"> '.$name.' </a> Payment success';
            $activity_logs = new GeneralController();
            $activity_logs->save_activity_logs("Payment Success", "users.id", $id, $action_perform, \Request::header('User-Agent'), $id);

            $admin = User::where('role',1)->first();

            $notification = new NotifyController();
            // $slug = ($booking != null) ? URL::to('/') . '/tutor/booking-detail/' . $booking->id : URL::to('/') . '/tutor/course-detail/' . $course->id;
            $slug =  URL::to('/') . '/tutor/booking-detail/' . $booking->id ;

            $type = ($booking != null) ? 'booking_confirmed' : 'course_enrlled';
            $title = ($booking != null) ? 'Booking Confirmed' : 'Course Enrolled';
            $icon = 'fas fa-tag';
            $class = 'btn-success';
            // $desc = ($booking != null) ? $name . ' Paid for Class of ' . $subject->name : $name.' Paid for Course of '. $course->title;
            $desc =  $name . ' Paid for Class of ' . $subject->name ;

            $pic = Auth::User()->picture;
            $notification->GeneralNotifi($booking->booked_tutor ?? $course->user_id,$slug,$type,$title,$icon,$class,$desc,$pic);

            // send to admin
            // $admin_slug = ($booking != null) ? URL::to('/') . '/admin/booking-detail/' . $booking->id : URL::to('/') . '/tutor/course-detail/' . $course->id;
            $admin_slug =  URL::to('/') . '/admin/booking-detail/' . $booking->id ;

            $notification->GeneralNotifi($admin->id,$admin_slug,$type,$title,$icon,$class,$desc,$pic);


            return response()->json([
                'status'=>'200',
                'message' => "Payment processed. Booking approved now u can join class on scheduled time."
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'status'=>'400',
                'message' => 'Something went wrong'
            ]);
        }

    }

    public function getPaymentStatus(Request $request)
    {
        $payment_id = Session::get('payment_id');
        $booking_type = Session::get('booking_type');
        $booking_id = Session::get('booking_id');

        Session::forget('payment_id');
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            \Session::flash('error','Payment failed');
            return Redirect::route('student.bookings');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {
            Session::flash('success','Payment success');

            $classroom_id = sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
                mt_rand( 0, 0xffff ),
                mt_rand( 0, 0x0C2f ) | 0x4000,
                mt_rand( 0, 0x3fff ) | 0x8000,
                mt_rand( 0, 0x2Aff ), mt_rand( 0, 0xffD3 ), mt_rand( 0, 0xff4B )
            );
            // return $red;
            $booking = null;

            if($booking_type == 'booking'):
                $booking = Booking::where('id',$booking_id)->first();
            elseif($booking_type == 'course'):

                $course = Course::where('id',$booking_id)->first();
            endif;

            if($booking != null){
                $subject = Subject::where('id',$booking->subject_id)->first();
                $booking->status = 2;
                $booking->service_fee =  Session::get('service_fee');
                $booking->save();
            }else{

                CourseEnrollment::create([
                    'user_id' => Auth::user()->id,
                    'course_id' => $course->id,
                    'plan' => Session::get('plan'),
                    'price' => $result->transactions[0]->amount->total,
                    'service_fee' => Session::get('service_fee'),
                    'status' => 1
                ]);

                $course->status = 1;
                $course->seats = $course->seats - 1;
                $course->save();
            }

            Payments::create([
                'user_id' => Auth::user()->id,
                'type_id' => ($booking != null) ? $booking->id : $course->id,
                'type' => ($booking != null) ? 'booking_class' : 'course_enrollment',
                'transaction_id' => $result->id,
                'sale_id' => $result->transactions[0]->related_resources[0]->sale->id ?? '',
                'amount'  => $result->transactions[0]->amount->total,
                'service_fee' => Session::get('service_fee'),
                'method'  => 'paypal'
            ]);

            Classroom::create([
                'booking_id' => $booking->id ?? null,
                'course_id' => $course->id ?? null,
                'classroom_id' => $classroom_id
            ]);


            $id = Auth::user()->id;
            $name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
            $action_perform = '<a href="'.URL::to('/') . '/admin/student/profile/'. $id .'"> '.$name.' </a> Payment success';
            $activity_logs = new GeneralController();
            $activity_logs->save_activity_logs("Payment Success", "users.id", $id, $action_perform, \Request::header('User-Agent'), $id);

            $admin = User::where('role',1)->first();

            $notification = new NotifyController();
            $slug = ($booking != null) ? URL::to('/') . '/tutor/booking-detail/' . $booking->id : URL::to('/') . '/tutor/course-detail/' . $course->id;
            $type = ($booking != null) ? 'booking_confirmed' : 'course_enrlled';
            $title = ($booking != null) ? 'Booking Confirmed' : 'Course Enrolled';
            $icon = 'fas fa-tag';
            $class = 'btn-success';
            $desc = ($booking != null) ? $name . ' Paid for Class of ' . $subject->name : $name.' Paid for Course of '. $course->title;
            $pic = Auth::User()->picture;
            $notification->GeneralNotifi($booking->booked_tutor ?? $course->user_id,$slug,$type,$title,$icon,$class,$desc,$pic);

            // send to admin
            $admin_slug = ($booking != null) ? URL::to('/') . '/admin/booking-detail/' . $booking->id : URL::to('/') . '/tutor/course-detail/' . $course->id;
            $notification->GeneralNotifi($admin->id,$admin_slug,$type,$title,$icon,$class,$desc,$pic);


            return redirect()->route('student.bookings');
        }
        Session::put('error','Payment failed !!');
		return redirect()->route('student.bookings');
    }

    public function skrillPaymentComplete()
    {
        $transaction_id = Session::get('transaction_id');
        $total_price = Session::get('amount');

        $booking_id = Session::get('bookingId');
        $booking_type = Session::get('booking_type');

        $booking = null;

        if($booking_type == 'booking'):
            $booking = Booking::where('id',$booking_id)->first();
        elseif($booking_type == 'course'):
            $course = Course::where('id',$booking_id)->first();
        endif;

        if($booking != null){
            $subject = Subject::where('id',$booking->subject_id)->first();
            $booking->status = 2;
            $booking->service_fee =  Session::get('service_fee');
            $booking->save();
        }else{
            CourseEnrollment::create([
                'user_id' => Auth::user()->id,
                'course_id' => $course->id,
                'plan' => Session::get('plan'),
                'price' => $total_price,
                'service_fee' => Session::get('service_fee'),
                'status' => 1
            ]);

            $course->status = 1;
            $course->seats = $course->seats - 1;
            $course->save();
        }


        $classroom_id = sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            mt_rand( 0, 0xffff ),
            mt_rand( 0, 0x0C2f ) | 0x4000,
            mt_rand( 0, 0x3fff ) | 0x8000,
            mt_rand( 0, 0x2Aff ), mt_rand( 0, 0xffD3 ), mt_rand( 0, 0xff4B )
        );

        Classroom::create([
            'booking_id' => $booking->id ?? null,
            'course_id' => $course->id ?? null,
            'classroom_id' => $classroom_id
        ]);

        $id = Auth::user()->id;
        $name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        $action_perform = '<a href="'.URL::to('/') . '/admin/student/profile/'. $id .'"> '.$name.' </a> Payment success';
        $activity_logs = new GeneralController();
        $activity_logs->save_activity_logs("Payment Success", "users.id", $id, $action_perform, \Request::header('User-Agent'), $id);

        $admin = User::where('role',1)->first();

        $notification = new NotifyController();
        $slug = ($booking != null) ? URL::to('/') . '/tutor/booking-detail/' . $booking->id : URL::to('/') . '/tutor/course-detail/' . $course->id;
        $type = ($booking != null) ? 'booking_confirmed' : 'course_enrlled';
        $title = ($booking != null) ? 'Booking Confirmed' : 'Course Enrolled';
        $icon = 'fas fa-tag';
        $class = 'btn-success';
        $desc = ($booking != null) ? $name . ' Paid for Class of ' . $subject->name : $name.' Paid for Course of '. $course->title;
        $pic = Auth::User()->picture;
        $notification->GeneralNotifi($booking->booked_tutor ?? $course->user_id,$slug,$type,$title,$icon,$class,$desc,$pic);

        // send to admin
        $admin_slug = ($booking != null) ? URL::to('/') . '/admin/booking-detail/' . $booking->id : URL::to('/') . '/tutor/course-detail/' . $course->id;
        $notification->GeneralNotifi($admin->id,$admin_slug,$type,$title,$icon,$class,$desc,$pic);


        Payments::create([
            'user_id' => Auth::User()->id,
            'type_id' => ($booking != null) ? $booking->id : $course->id,
            'type' => ($booking != null) ? 'booking_class' : 'course_enrollment',
            'transaction_id' =>  $transaction_id,
            'amount'  => $total_price,
            'service_fee'  => Session::get('service_fee'),
            'method'  => 'skrill'
        ]);

        return redirect()->route('student.bookings');
    }
 /**
     *  @param $total_price,$commission,$comm.$booking,$bookingID
     *  @return $redirectURL
     *
     *  Skrill Payment Method Integeration and redirect
     */
    private function skrillPayment($total_price,$commission,$comm,$booking,$bkid)
    {

        $payerEmail = DB::table('payment_methods')
        ->where('user_id',Auth::user()->id)
        ->where('method','skrill')
        ->first();

        $this->skrilRequest = new SkrillRequest();
        $this->skrilRequest->pay_to_email = 'skrill_user_test2@smart2pay.com';
        $this->skrilRequest->return_url =  URL::route('skrill.payment.complete');
        $this->skrilRequest->cancel_url =  URL::route('student.bookings');
        $this->skrilRequest->logo_url = 'https://naumanyasin.com/assets/images/logo/logo.png';
        $this->skrilRequest->pay_from_email = $payerEmail->email ?? '';
        $this->skrilRequest->transaction_id = 'SKRL-'.rand();
        $this->skrilRequest->amount = $total_price;
        $this->skrilRequest->currency = 'USD';
        $this->skrilRequest->language = 'EN';
        $this->skrilRequest->prepare_only = '1';
        $this->skrilRequest->merchant_fields = 'Tutorvy,'.Auth::user()->email;
        $this->skrilRequest->site_name = 'Tutorvy.com';
        $this->skrilRequest->customer_email = Auth::user()->email;
        $this->skrilRequest->detail1_description = 'Booking ID:';
        $this->skrilRequest->detail1_text = $booking->id;
        $this->skrilRequest->detail2_description = 'Tutor Fee:';
        $this->skrilRequest->detail2_text = '$'.$booking->price ?? $booking;
        $this->skrilRequest->detail3_description = 'Service Fee:'.$commission->commission.'%';
        $this->skrilRequest->detail3_text = '$'.$comm;

        Session::put('bookingId',$bkid);
        Session::put('transaction_id',$this->skrilRequest->transaction_id);
        Session::put('amount',$total_price);

        // create object instance of SkrillClient
        $client = new SkrillClient($this->skrilRequest);
        $sid = $client->generateSID(); //return SESSION ID

        // handle error
        $jsonSID = json_decode($sid);

        if ($jsonSID != null && $jsonSID->code == "BAD_REQUEST")
        return $jsonSID->message;
        // do the payment
        $redirectUrl= $client->paymentRedirectUrl($sid); //return redirect url

        return $redirectUrl;
    }

    public function history()
    {
        $tickets = supportTkts::where('user_id',Auth::user()->id)->with(['category','tkt_created_by'])->get();
        return view('student.pages.history.index',compact('tickets'));
    }

    public function tutorPlans(Request $request) {
        $plans = subjectPlans::where("user_id", $request->user_id)->where("subject_id",$request->subject_id)->get();

        return response()->json([
            "tutor_plans" => $plans,
            "status_code" => 200,
            "success" => true,
        ]);
    }

    public function rescheduleBooking(Request $request){

        $booking = Booking::where('id',$request->loId)->first();


        $booking->class_date = $request->date;
        $booking->class_time = $request->time;
        $booking->reschedule_note = $request->note;
        $booking->save();

        $admin = User::where('role',1)->first();
        $name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        $notification = new NotifyController();
        $slug = URL::to('/') . '/tutor/booking-detail/' . $booking->id;
        $type = 'booking_rescheduled';
        $title = 'Booking Rescheduled';
        $icon = 'fas fa-tag';
        $class = 'btn-success';
        $desc = $name . ' Rescheduled the booking.';
        $pic = Auth::User()->picture;
        $notification->GeneralNotifi($booking->booked_tutor ,$slug,$type,$title,$icon,$class,$desc,$pic);

        // send to admin
        $admin_slug = URL::to('/') . '/admin/booking-detail/' . $booking->id;
        $notification->GeneralNotifi($admin->id,$admin_slug,$type,$title,$icon,$class,$desc,$pic);

        return response()->json([
            "message" => "Meeting Rescheduled Successfully",
            "status_code" => 200,
            "success" => true,
        ]);
        // Session::flash('success','You have successfully reschedule this booking');

        // return redirect()->back();
    }

    public function checkDefaultPaymentMethod()
    {
        $defaultPay = DB::table('payment_methods')->where('user_id',Auth::user()->id)->where('default',1)->first();

        if(!$defaultPay):
            return response()->json(['success' => "You haven't select or add any default payment method yet, Please select by following this <a href='/student/settings'>Add Payment Method</a>"]);
        endif;
    }


}

