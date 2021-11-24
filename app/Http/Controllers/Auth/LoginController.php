<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\General\GeneralController;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\URL;
use App\Models\Admin\Subject;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login(Request $request)
    {

        $user = User::where('email',$request->email)->where('role','!=',1)->first();

        if($user){
            return view('auth.login',compact('user'));
        }

        /*
        *  After validating email show only Password field
        *  and set value of valid_email,role in hidden input
        */

        if($request->filled('valid_email','password','role')){
            if(Auth::attempt(['email' => $request->valid_email, 'password' => $request->password,'role'=>$request->role ])){
                if($request->role == 2){

                    // activity logs
                    $id = Auth::user()->id;
                    $name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
                    $action_perform = '<a href="'.URL::to('/') . '/admin/tutor/profile/'. $id .'"> '.$name.' </a> Logged into system';
                    $activity_logs = new GeneralController();
                    $activity_logs->save_activity_logs("Login", "users", $id, $action_perform, $request->header('User-Agent'), $id);

                    if(Auth::user()->time_zone == null && Auth::user()->time_zone == "") {
                        User::where('id',Auth::user()->id)->update(["time_zone" => $request->time_zone]);
                    }


                    return redirect()->route('tutor.dashboard');
                }
                if($request->role == 3){

                    // activity logs
                    $id = Auth::user()->id;
                    $name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
                    $action_perform = '<a href="'.URL::to('/') . '/admin/student/profile/'. $id .'"> '.$name.' </a> Logged into system';
                    $activity_logs = new GeneralController();
                    $activity_logs->save_activity_logs("Login", "users", $id, $action_perform, $request->header('User-Agent'), $id);

                    $value = "";
                    if(isset($_COOKIE['t_id'])){
                        $value = $_COOKIE['t_id'];
                        \Cookie::queue(\Cookie::forget('t_id'));

                    }
                    if($value != ''){
                        return redirect()->route('student.book-now',[$value]);
                    }

                    if(isset($_COOKIE['s_link'])){
                        $value = $_COOKIE['s_link'];
                        \Cookie::queue(\Cookie::forget('s_link'));

                    }
                    if($value != ''){

                        $subject = $value;

                        $query = DB::table('users')
                        ->select('view_tutors_data.*')
                        ->leftJoin('teachs', 'users.id', '=', 'teachs.user_id')
                        ->leftJoin('view_tutors_data', 'view_tutors_data.id', '=', 'users.id')
                        ->where('users.role',2)
                        ->where('users.status',2)
                        ->where('view_tutors_data.subject_names','!=',null);
                        $query->where(function($query2) use ($subject)
                        {
                            if($subject != null && $subject != ''){
                                $query2->where('teachs.subject_id', $subject);
                            }

                        });

                        $available_tutors = $query->orderByRaw('rating DESC')->groupByRaw('users.id')->get();

                        foreach($available_tutors as $tutor) {
                            $tutor->is_favourite = DB::table("fav_tutors")->where("user_id",Auth::user()->id)->where("tutor_id",$tutor->id)->first();
                            // $tutor->tutor_subject_rate = DB::table("subject_plans")->where("user_id",$tutor->id)->min('rate');
                        }

                        $subjects = Subject::all();
                        $locations = DB::table('search_locations')->get();
                        return redirect()->route('student.tutor')->with(['available_tutors'=> $available_tutors, 'subjects' => $subjects, 'locations' => $locations ]);

                    }


                    if(Session::get('redirectUrlCourse')){
                        return redirect()->route('student.course-details',[Session::get('redirectUrlCourse')]);
                        Session::flush(Session::get('redirectUrlCourse'));
                    }

                    if(Auth::user()->time_zone == null && Auth::user()->time_zone == "") {
                        User::where('id',Auth::user()->id)->update(["time_zone" => $request->time_zone]);
                    }

                    return redirect()->route('student.dashboard');
                }
                Session::put('user',$request->valid_email);
            }
            else{
                $user = User::where('email',$request->valid_email)->where('role','!=',1)->first();
                $error = 'Wrong! Password ';
                return view('auth.login',compact('user','error'));
            }
        }



        return redirect()->back()->with('error','Wrong! Email Address');

    }

    public function logged(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password,'role'=>$request->role])){
            Session::put('user',$request->email);
        }

        return redirect()->back()->with('error','Wrong Password');
    }

    public function redirectGoogle($id)
    {
        Session::put('c_id',$id);
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $c_id = Session::get('c_id');

        $user = Socialite::driver('google')->user();

        $user->user['provider'] = 'google';

        $data = $this->_registerOrLogin($user->user,$c_id);

        if($data == false || $data == ''){

            if($c_id == 2) {
                return redirect()->route('tutor.register')->with('error','Unable to login with this email.');
            }else if($c_id == 3) {
                return redirect()->route('student.register')->with('error','Unable to login with this email.');
            }else if($c_id == 0) {
                return redirect()->route('login')->with('error','Google account is not attached with any account.');
            }else{
                return redirect()->to('/');
            }
            // return redirect()->back()->with('error','Unable to login with this email.');
        }
        Auth::login($data);

        if($data->role == 2){
            return redirect()->route('tutor.dashboard');
        }

        if($data->role == 3){
            return redirect()->route('student.dashboard');
        }

        if(!$data->role){
            return redirect('role');
        }
    }

    public function redirectFacebook($id)
    {
        Session::put('c_id',$id);
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $c_id = Session::get('c_id');

        $user = Socialite::driver('facebook')->user();
        $user->user['provider'] = 'facebook';

        $data = $this->_registerOrLogin($user->user,$c_id);

        if($data == false || $data == ''){

            if($c_id == 2) {
                return redirect()->route('tutor.register')->with('error','Unable to login with this email.');
            }else if($c_id == 3) {
                return redirect()->route('student.register')->with('error','Unable to login with this email.');
            }else if($c_id == 0) {
                return redirect()->route('login')->with('error','Facebook account is not attached with any account.');
            }else{
                return redirect()->to('/');
            }
            // return redirect()->back()->with('error','Unable to login with this email.');
        }
        Auth::login($data);

        if($data->role == 2){
            return response(['status' => 200,'url'=>'tutor/dashboard']);
        }

        if($data->role == 3){
            return response(['status' => 200,'url'=>'student/dashboard']);
        }

        if(!$data->role){
            return redirect('role');
        }
    }

     /*
    *  Register User if not exist in db and if exist will login
    *  and redirect to dashboard
    */
    private function _registerOrLogin($data,$r)
    {

        try{
            // $user = User::where('email', $data['email'])->where('provider',$data['provider'])->first();
            // if(!$user && $r == 0){
            //     return false;
            // }

            // if(!$user){
            $user = User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'picture' => $data['picture'],
                'provider' => 'google',
                'role'=> $r
            ]);
            // }else{
            //     if($user->role != $r){
            //         return false;
            //     }
            // }

            return $user;

        }catch(Exception $e){
            return $errorCode = $e->errorInfo;
        }

    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $cur_unnid = Session::get('unnid');
        $tokens = array();

        $tokens_obj = $user->token;

        if($tokens_obj != NULL){

            $tokens_obj = json_decode($tokens_obj);
            for($i = 0; $i < sizeof($tokens_obj) ; $i++ ){
                if($cur_unnid != $tokens_obj[$i]->token){
                    $fcm_data['token'] = $tokens_obj[$i]->token;
                    $fcm_data['device'] = 'Windows';
                    array_push($tokens,$fcm_data);
                }

            }
            if(sizeof($tokens) == 0 || $tokens == [] || $tokens == '[]'){
                $tokens = NULL;
                $user->token = $tokens;
                $user->save();
            }else{
                $user->token = json_encode($tokens);
                $user->save();
            }

        }

        Auth::logout();
        Session::flush();
        return redirect('/');
    }

    public function googleLoggin(Request $request)
    {

            $c_id = $request->role;
            $user = User::where('email', $request->email)->first();

            $asRegiser = ($user->role == 3) ? 'Student' : 'Tutor';

            $data = $this->_registerOrLogin($request->all(),$c_id);

            if($data == false || $data == ''){

                if($c_id == 2) {
                    return redirect()->route('tutor.register')->with('error','Unable to login with this email.');
                }else if($c_id == 3) {
                    return redirect()->route('student.register')->with('error','Unable to login with this email.');
                }
            }

            if($data[1] == 1062){
                return response([
                            'status' => 400,
                            'message' =>'This email '.$request->email .' is already registered as a '.$asRegiser.', please choose another'
                        ]);
            }

            Auth::login($data);

            if($data->role == 2){
                return response(['status' => 200,'url'=>'/tutor/dashboard']);
            }

            if($data->role == 3){
                return response(['status' => 200,'url'=>'/student/dashboard']);
            }
            if(!$data->role){
                return redirect('role');
            }




    }

    public function checkLogin(Request $request)
    {
        try{
            $user = User::where('email', $request->email)->where('provider',$request->provider)->first();
            if(!$user){
                return response([
                        'status' => 400,
                        'message'=>'No '.ucfirst($request->provider).' account is asscociated with this '.$request->email.' email'
                    ]);
            }

            Auth::login($user);

            if($user->role == 2){
                return response(['status' => 200,'url'=>'/tutor/dashboard']);
            }

            if($user->role == 3){
                return response(['status' => 200,'url'=>'/student/dashboard']);
            }
            if(!$user->role){
                return redirect('role');
            }

        }catch(Exception $e){

            dd($e->getMessage());
        }

    }

}
