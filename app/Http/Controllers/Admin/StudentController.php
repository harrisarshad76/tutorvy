<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\General\NotifyController;
use Illuminate\Support\Facades\URL;
use App\Models\Activitylogs;
use App\Models\Admin\supportTkts;
use App\Models\Booking;
use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\FavTutors;
use App\Models\Payments;
use App\Models\Admin\Subject;
use App\Models\Admin\SubjectCategory;
use App\Models\General\Degree;
use App\Models\General\Institute;

class StudentController extends Controller
{
     /*
    |--------------------------------------------------------------------------
    | Admin -- StudentController
    |--------------------------------------------------------------------------
    |
    | This controller handles Student from admin side
    |
    |
    */

    public function index()
    {
        $students = User::where('role',3)->get();
        $staff_members = User::whereNotIn('role', [1,2,3])->get();


        return view('admin.pages.students.index',compact('students','staff_members'));
    }

    public function profile($id)
    {

        $student = User::with('favtutor')->where('role',3)->where('id',$id)->first();

        if(Auth::user()->role == 1):
            $tickets = supportTkts::with(['category','tkt_created_by'])->get();
        else:
            $tickets = supportTkts::with(['category','tkt_created_by'])->where('assign_to',Auth::id())->get();
        endif;

        $courseEnrolled = CourseEnrollment::where('user_id',$id)->get();
        $classroom = Booking::with('classroom')->where('user_id',$id)->get()->pluck('classroom');
        $payments = Payments::where('user_id',$id)->where('type','!=','payment_refund')->get();
        $staff_members = User::whereNotIn('role', [1,2,3])->get();
        $tickets = supportTkts::with('assignedUser')->where('user_id',$id)->get();

        return view('admin.pages.students.profile',compact('student','tickets','courseEnrolled','classroom','tickets','payments','staff_members'));

    }

    public function editProfile($id)
    {

        $subjects = Subject::all();
        $degrees = Degree::all();
        $institutes = Institute::all();
        $subject_cat = SubjectCategory::all();
        $student = User::with('favtutor')->where('role',3)->where('id',$id)->first();

        $user_files = DB::table("user_files")->where('user_id',$student->id)->where('type',$student->type)->get()->toArray();

        return view('admin.pages.students.edit',compact('subjects','degrees','institutes','subject_cat','student','user_files'));

    }

    public function studentStatus(Request $request){

        $student = User::where('id',$request->id)->first();
        $student->status = $request->status;
        $student->reject_note = $request->reason;
        $student->save();

        $message = '';
        if($request->status == 1){
            $message = 'Student Status Enabled.';
        }elseif($request->status == 0){
            $message = 'Student Status Disabled.';
        }

        return response()->json([
            'status'=>'200',
            'message' => $message
        ]);

    }

    public function deleteStudent(Request $request){

        $student = User::where('id',$request->id)->delete();
        return response()->json([
            'status'=>'200',
            'message' => 'Student Deleted successfully'
        ]);

    }

    public function assignStudent(Request $request)
    {
        // dd($request->all());
        $user = User::find($request->tutor);
        User::where('id',$request->tutor)->update([
            'assign_to' => $request->staff
        ]);

                // dd($user);

        $message = $user->name. ' has been assigned to '.User::find($request->staff)->name;
        $notify_msg = $user->name.' user is assigned to you';


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

    public function activitylog($id)
    {
        $activity_logs = Activitylogs::where('ref_id',$id)->paginate(15);
        return view('admin.pages.students.activitylog',compact('activity_logs'));
    }

    public function paidPayments($id)
    {
        $payments = Payments::where('user_id',$id)->get();
        return view('admin.pages.students.payments',compact('payments'));
    }
    public function reports($id)
    {
        // $payments = Payments::where('user_id',$id)->get();
        return view('admin.pages.students.reports');
    }

}
