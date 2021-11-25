<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Activitylogs;
use App\Models\Admin\supportTkts;
use App\Models\Admin\tktCat;
use App\Events\NewNotification;
use App\Models\Notification;
use App\Models\User;
use App\Charts\MonthlyUsersChart;

class HomeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Admin Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles admin dashboard and other view pages as
    | well.
    |
    */

    public function index(MonthlyUsersChart $chart)
    {

        //event(new NewNotification('Hello this is test mesage'));
        $tutors_count = User::where('role',2)->count();
        $students_count = User::where('role',3)->count();

        $all_users = User::where('role','!=',1)->count();

        $new_requests = DB::table('users')
        ->select('users.*','assessments.id as assessment_id','assessments.status as assessment_status','subjects.name as subject_name')
        ->leftJoin('assessments', 'users.id', '=', 'assessments.user_id')
        ->leftJoin('subjects', 'subjects.id', '=', 'assessments.subject_id')
        // ->where('assessments.status','!=',1)
        ->where('users.role',2)
        ->whereIn('users.status', [0, 1, 2])
        ->paginate(5);

        $activity_logs = Activitylogs::paginate(5);
        if(Auth::user()->role == 1):
            $tickets = supportTkts::with(['category','tkt_created_by'])->get();
        else:
            $tickets = supportTkts::with(['category','tkt_created_by'])->where('assign_to',Auth::id())->get();
        endif;

        $notifications = Notification::where('read_at',null)->orderBy('id','desc')->take(3)->get();
        $chart = $chart->build();

        return view('admin.dashboard',compact('tutors_count','students_count','all_users','new_requests','tickets','activity_logs','notifications','chart'));
    }

    public function graphData()
    {
        $tutor = DB::select(DB::raw("select Date(created_at),MONTHNAME(created_at),count(*) from users WHERE role=2 group by Date(created_at),MONTHNAME(created_at) order by Date(created_at),MONTHNAME(created_at)"));
        $student = DB::select(DB::raw("select Date(created_at),MONTHNAME(created_at),count(*) from users WHERE role=3 group by Date(created_at),MONTHNAME(created_at) order by Date(created_at),MONTHNAME(created_at)"));
        $staff = DB::select(DB::raw("select Date(created_at),MONTHNAME(created_at),count(*) from users WHERE role=4 group by Date(created_at),MONTHNAME(created_at) order by Date(created_at),MONTHNAME(created_at)"));

        $collection = collect($tutor);
        $collection1 = collect($student);
        $collection2 = collect($staff);

        $users = $collection->pluck('count(*)')->sum() + $collection1->pluck('count(*)')->sum() + $collection2->pluck('count(*)')->sum();

        return response()->json([
                                'tutor' => $collection->pluck('count(*)')->toArray(),
                                'student' => $collection1->pluck('count(*)')->toArray(),
                                'staff' => $collection2->pluck('count(*)')->toArray(),
                                'month' => $collection->pluck('MONTHNAME(created_at)')->toArray(),
                                'year' => $collection->pluck('Date(created_at)')->toArray(),
                                'users' => $users,
                                'tutorCount' => $collection->pluck('count(*)')->sum(),
                                'studentCount' => $collection1->pluck('count(*)')->sum(),
                                'staffCount' => $collection2->pluck('count(*)')->sum(),
                            ]);
    }
}
