<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Http\Controllers\General\GeneralController;
use App\Http\Controllers\General\NotifyController;
use Illuminate\Http\Request;
use App\Models\General\Degree;
use App\Models\General\Institute;
use App\Models\Admin\Subject;
use App\Models\Activitylogs;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\General\Education;
use App\Models\General\Professional;
use App\Models\Userdetail;
use App\Models\Booking;
use App\Models\subjectPlans;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
// use FFMpeg;

// use FFMpeg\Coordinate\Dimension;
// use FFMpeg\Format\Video\X264;

class ProfileController extends Controller
{
    /**
     *  Return Tutor Profile view
     */

    public function index(){

        $subjects = Subject::all();
        $degrees = Degree::all();
        $institutes = Institute::all();
        $user_files = DB::table("user_files")->where('user_id',Auth::user()->id)->get();
        return view('tutor.pages.profile.index',compact('subjects','degrees','institutes','user_files'));
    }


    public function profileUpdate(Request $request) {

        $date_of_birth = $request->year.'-'.$request->month.'-'.$request->day;
        
        $data =array(
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'tagline' => $request->tagline,
            'dob' => $date_of_birth,
            'phone' => $request->phone,
            'city' => $request->city,
            'country' => $request->country,
            'country_short' => $request->country_short,
            'language' => $request->language,
            'lang_short' => $request->lang_short,
            'gender' => $request->gender,
            'bio' => $request->bio,
        );
        

       
        User::where('id',$request->user_id)->update($data);

        $location = DB::table('search_locations')->where('name', $request->country)->first();

        if(empty($location)) {
            DB::table('search_locations')->insert([
                'name' => $request->country,
            ]);
        }

        // activity logs
        $id = Auth::user()->id;
        $name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        $action_perform = '<a href="'.URL::to('/') . '/admin/tutor/profile/'. $id .'"> '.$name.' </a> Update his Profile';
        $activity_logs = new GeneralController();
        $activity_logs->save_activity_logs("Profile Updated", "users.id", $id, $action_perform, $request->header('User-Agent'), $id);


        $general_profile = "profile";
        $user_general_profile = User::where('id',Auth::user()->id)->first();

        if(!str_contains($user_general_profile->profile_completion , "profile" )) {
            User::where('id',Auth::user()->id)->update(["profile_completion" => $user_general_profile->profile_completion . $general_profile .',']);
        }
        if(str_contains($user_general_profile->profile_completion , "profile,education,professional,verification," )){
            User::where('id',Auth::user()->id)->update(["profile_completed" => 1]);
        }

        return response()->json([
            "status_code" => 200,
            "success" => true,
            "message" => "Profile Updated Successfully",
            "path" => (array_key_exists("picture",$data) ? $data['picture'] : Auth::user()->picture ),
        ]);

    }

    public function updateProfileEdu($user_id ,Request $request) {

    //    return dd($request->all());
        $docs = [];

        if($request->hasFile('upload')){
            foreach($request->upload as $i => $upload){
                $path = 'storage/docs/'.$upload->getClientOriginalName();
                $upload->storeAs('docs',$upload->getClientOriginalName(),'public');
                array_push($docs,$path);
            }
        }

        Education::where('user_id',$user_id)->delete();

        for($i=0; $i < count($request->degree); $i++){
            Education::create([
                "user_id" => $user_id,
                "degree_id" => $request->degree[$i],
                "subject_id" => $request->major[$i],
                "institute_id" => $request->institute[$i],
                "year" => $request->graduate_year[$i],
                "docs" => $docs[$i] ?? '',
            ]);
        }

        // activity logs
        $id = Auth::user()->id;
        $name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        $action_perform = '<a href="'.URL::to('/') . '/admin/tutor/profile/'. $id .'"> '.$name.' </a> Update his Education Record';
        $activity_logs = new GeneralController();
        $activity_logs->save_activity_logs("Profile Updated", "education.id", $id, $action_perform, $request->header('User-Agent'), $id);

        $general_profile = "education";
        $user_general_profile = User::where('id',Auth::user()->id)->first();

        if(!str_contains($user_general_profile->profile_completion , "education" )) {
            User::where('id',Auth::user()->id)->update(["profile_completion" => $user_general_profile->profile_completion . $general_profile .',']);
        }
        if(str_contains($user_general_profile->profile_completion , "profile,education,professional,verification," )){
            User::where('id',Auth::user()->id)->update(["profile_completed" => 1]);
        }

        return response()->json([
            "status_code" => 200,
            "success" => true,
            "message" => "Record Saved Successfully",
        ]);
    }

    public function updateProfileProfession($user_id , Request $request) {
       
        Professional::where('user_id',$user_id)->delete();
        
        for($i=0; $i < count($request->designation); $i++){
            if($request->working == 'on'){
                $endy = "2021";
            }
            else {   
                $endy = $request->degree_end[$i];}   
            Professional::create([
                "user_id" => $user_id,
                "designation" => $request->designation[$i],
                "organization" => $request->organization[$i],
                "start_date" => $request->degree_start[$i],
                "end_date" => $endy,
            ]);
        }

        // activity logs
        $id = Auth::user()->id;
        $name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        $action_perform = '<a href="'.URL::to('/') . '/admin/tutor/profile/'. $id .'"> '.$name.' </a> Update his Professional Record';
        $activity_logs = new GeneralController();
        $activity_logs->save_activity_logs("Profile Updated", "professionals.id", $id, $action_perform, $request->header('User-Agent'), $id);
        
        $general_profile = "professional";
        $user_general_profile = User::where('id',Auth::user()->id)->first();

        if(!str_contains($user_general_profile->profile_completion , "professional" )) {
            User::where('id',Auth::user()->id)->update(["profile_completion" => $user_general_profile->profile_completion . $general_profile .',']);
        }
        if(str_contains($user_general_profile->profile_completion , "profile,education,professional,verification," )){
            User::where('id',Auth::user()->id)->update(["profile_completed" => 1]);
        }
        return response()->json([
            "status_code" => 200,
            "success" => true,
            "message" => "Record Saved Successfully",
        ]);

    }

    // public function uploadVideo($user_id ,Request $request){

    //     ini_set('max_execution_time', 780);
    //     if($request){
    //         $file = $request->video;                                       //get file from request 
    //         $arrayFileName = explode(".", file($file)->getClientOriginalName());         
                                                                                           
    //         $filename =  $file->getClientOriginalName();            //to get existing name  of file
    //         $storage_path_full = '/'.$filename;                            //to make path
    //         $localVideo =  Storage::disk('public')->put('tutor/videos/'.$storage_path_full, file_get_contents($file));      
    //         //to save the file in your public folder

    //         $lowBitrateFormat = (new \FFMpeg\Format\Video\X264('libmp3lame', 'libx264'))->setKiloBitrate(387);
	// 	    FFMpeg::fromDisk('videos')
	// 		->open($filename)
            
	// 	    ->export()
	// 	    ->toDisk('videos')
	// 	    ->inFormat($lowBitrateFormat)
	// 	    ->save('kaushik.mp4');
    //     }else{
    //         return response()->json([
    //             "status_code" => 404,
    //             "success" => false,
    //             "message" => "No video attached.",
    //         ]);
    //     }

    //     return response()->json([
    //         "status_code" => 200,
    //         "success" => true,
    //         "message" => "Video saved.",
    //     ]);

    // }

    public function uploadPic($user_id ,  Request $request){

        if($request){
            
            $image = $request->filepond; // your base64 encoded
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $random = Str::random(10).".png";
            $imageName = $random;
            
            $data['picture'] = 'storage/profile/'.$imageName;
            Storage::disk('public')->put('profile/'.$imageName, base64_decode($image));
                // $data['picture'] = 'storage/profile/'.$request->filepond->getClientOriginalName();
                // $request->filepond->storeAs('profile',$request->filepond->getClientOriginalName(),'public');
            User::where('id',$user_id)->update($data);
                return response()->json([
                    "status_code" => 200,
                    "success" => true,
                    "message" => "Image saved.",
                    "path" => (array_key_exists("picture",$data) ? $data['picture'] : Auth::user()->picture ),
                ]);
        }else{
            return response()->json([
                "status_code" => 404,
                "success" => false,
                "message" => "No image attached.",
            ]);
        }

        


    }

    public function updateProfileVerfication($user_id , Request $request) {
        User::where('id', $user_id)->update([
            "type" => $request->security,
            "cnic_security" => $request->document_no,
            "status" => 1,
        ]);

        $data = [];

        if($request->security == 1) {

            if($request->hasFile('id_card_pic')){
                $filename = 'storage/verifcation/'.$request->id_card_pic->getClientOriginalName();
                array_push($data , $filename);
                $request->id_card_pic->storeAs('verifcation',$request->id_card_pic->getClientOriginalName(),'public');
            }

            if($request->hasFile('id_card_pic2')){
                $filename = 'storage/verifcation/'.$request->id_card_pic2->getClientOriginalName();
                array_push($data , $filename);
                $request->id_card_pic2->storeAs('verifcation',$request->id_card_pic2->getClientOriginalName(),'public');
            }


        }else if($request->security == 2) {
            if($request->hasFile('license_pic')){
                $filename = 'storage/verifcation/'.$request->license_pic->getClientOriginalName();
                array_push($data , $filename);
                $request->license_pic->storeAs('verifcation',$request->license_pic->getClientOriginalName(),'public');
            }

            if($request->hasFile('license_pic2')){
                $filename = 'storage/verifcation/'.$request->license_pic2->getClientOriginalName();
                array_push($data , $filename);
                $request->license_pic2->storeAs('verifcation',$request->license_pic2->getClientOriginalName(),'public');
            }
        }else{

            if($request->hasFile('passport_pic')){
                $filename = 'storage/verifcation/'.$request->passport_pic->getClientOriginalName();
                array_push($data , $filename);
                $request->passport_pic->storeAs('verifcation',$request->passport_pic->getClientOriginalName(),'public');
            }

        }
    
     

        foreach($data as $file) {
            DB::table("user_files")->insert([
                "user_id" => $user_id,
                "type" => $request->security,
                "files" => $file,
            ]);
        }

        $name = Auth::user()->first_name . ' ' . Auth::user()->last_name;

        $reciever = User::where('role',1)->first();

        $notification = new NotifyController();
        $slug = URL::to('/') . '/admin/tutor/request/'. Auth::user()->id;
        $type = 'doc_verification';
        $title = 'Document Verfication';
        $icon = 'fas fa-tag';
        $class = 'btn-success';
        $desc = $name . ' Submit Documents for Verfication';
        $pic = $reciever->picture;
        $notification->GeneralNotifi($reciever->id ,$slug,$type,$title,$icon,$class,$desc,$pic);


        // activity logs
        $id = Auth::user()->id;
        $action_perform = '<a href="'.URL::to('/') . '/admin/tutor/profile/'. $id .'"> '.$name.' </a> Upload his documents for verification';
        $activity_logs = new GeneralController();
        $activity_logs->save_activity_logs("Profile Updated", "user_files.user_id", $id, $action_perform, $request->header('User-Agent'), $id);

        $general_profile = "verification";
        $user_general_profile = User::where('id',Auth::user()->id)->first();

        if(!str_contains($user_general_profile->profile_completion , "verification" )) {
            User::where('id',Auth::user()->id)->update(["profile_completion" => $user_general_profile->profile_completion . $general_profile .',']);
        }
        if(str_contains($user_general_profile->profile_completion , "profile,education,professional,verification," )){
            User::where('id',Auth::user()->id)->update(["profile_completed" => 1]);
        }

        
        return response()->json([
            "status_code" => 200,
            "success" => true,
            "message" => "Documents Saved. Please wait for Administrator approval",
        ]);
    }

    public function educationUpdate(Request $request) {


        if(Auth::user()->education){
            Auth::user()->education->each(function($record) {
                $record->delete(); // <-- direct deletion
             });
        }

        for($i=0; $i<count($request->degree); $i++){
            Education::updateOrCreate(['user_id' => Auth::user()->id],[
                "degree_id" => $request->degree[$i],
                "subject_id" => $request->major[$i],
                "institute" => $request->institute[$i],
                "year" => $request->graduate_year[$i],
                "docs" => $docs[$i] ?? null,
            ],['user_id']);
        }
    }
    public function professionUpdate(Request $request) {
        if($request->filled('designation')){
            for($i=0; $i<count($request->designation); $i++){
                Professional::updateOrCreate(['user_id' => Auth::user()->id],[
                    'designation' => $request->designation[$i],
                    'organization' => $request->organization[$i],
                    'start_date' => $request->degree_start[$i],
                    'end_date' => $request->degree_end[$i],
                ]);
            }
        }
        return redirect()->back()->with('message','Your Profession has been successfully updated');

    }

    public function profile($id)
    {

        $tutor = User::with(['education','professional','teach','course'])->find($id);
        $delivered_classes = Booking::where('booked_tutor',$id)->where('status',5)->count();
        return view('tutor.pages.profile.profile',compact('tutor','delivered_classes'));
    }

    public function show($id)
    {
        $student = User::with(['education','professional','teach','course'])->find($id);
        $subjects = Subject::where('id',$student->std_subj)->first();
        $classes = Booking::where('user_id',$student->id)->where('status',5)->count();
        $reviews = Booking::where('user_id',$student->id)->where('student_review','!=',NULL)->count();
        $price = Booking::where('user_id',$student->id)->where('status',2)->sum('price');
        // dd($reviews);
        return view('tutor.pages.student.index',compact('student','subjects','classes','price','reviews'));
    }

    // show tutor plans
    public function showTutorPlans(Request $request) {
        $plans = subjectPlans::where("user_id", $request->user_id)->where("subject_id",$request->subject_id)->get();

        return response()->json([
            "tutor_plans" => $plans,
            "status_code" => 200,
            "success" => true,
        ]);
    }


}
