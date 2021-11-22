<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\General\NotifyController;
use Illuminate\Support\Facades\URL;
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
        $students = User::where('role',3)->paginate(15);
        $staff_members = User::whereNotIn('role', [1,2,3])->get();
        
        return view('admin.pages.students.index',compact('students','staff_members'));
    }

    public function profile($id){

        $student = User::where('role',3)->where('id',$id)->first();
        return view('admin.pages.students.profile',compact('student'));

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

        $message = $user->first_name.' '.$user->last_name. ' has been assigned to '.User::find($request->staff)->first_name.' '.User::find($request->staff)->last_name;
        $notify_msg = $user->first_name.' '.$user->last_name.' user is assigned to you';


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
