<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use App\Models\General\Message;
use Illuminate\Support\Facades\DB;
class GenChatController extends Controller
{
    /**
     *  Return Student Chat view
     */
    public function index()
    {
        $users = Contact::with('user')->where('user_id',\Auth::user()->id)->get();
        // return $users;
        return view('chat.messages',compact('users'));
    }
    public function sendMessage(Request $request){

        $msg_type = '';

        $contact = Contact::where('contact_id',$request->user)->first();

        if($contact){

        }else{

            $new_contact = new Contact();
            $new_contact->user_id = \Auth::user()->id;
            $new_contact->contact_id = $request->user;
            $new_contact->save();

            $new_contact = new Contact();
            $new_contact->user_id = $request->user;
            $new_contact->contact_id = \Auth::user()->id;
            $new_contact->save();
            
        }
        if(request()->has('file')){
            $filename = request('file')->store('chat','public');
            $message = Message::create([
                'user_id' => auth()->id(),
                'receiver_id' => $request->user,
                'message' => $filename,
                'type'=>'file',
            ]);
            $msg_type = 'file';

        }else{
            $message = Message::create([
                'user_id' => auth()->id(),
                'receiver_id' => $request->user,
                'type'=>'text',
                'message' => $request->msg
            ]);
            $msg_type = 'text';

        }

        $notification = new NotifyController();
        $slug = '';
        $type = 'chat-message';
        $msg_type = 'chat-message';
        $msg = $request->msg;
        $title = 'Message';
        $icon = 'fas fa-tag';
        $class = 'btn-success';
        $desc = Auth::User()->first_name.' texted you.';
        $pic = Auth::User()->picture;
        $notification->GeneralNotifi($request->user,$slug,$type,$title,$icon,$class,$desc,$pic,$msg_type,$request->msg);


        return response()->json([
            'status' => 200,
            $message
        ]);

    }

    public function contactTutor($id)
    {
        $new_contact = new Contact();
        $new_contact->user_id = \Auth::user()->id;
        $new_contact->contact_id = $id;
        $new_contact->save();

        $new_contact = new Contact();
        $new_contact->user_id = $id;
        $new_contact->contact_id = \Auth::user()->id;
        $new_contact->save();
        $redirect = (Auth::user()->role == 3) ? 'student.chat' : 'tutor.chat' ;
        return redirect()->route($redirect);
    }

    public function markAllSeen($id){
        $chatts = Message::where('is_seen',0)->where('user_id',$id)->Where('receiver_id',Auth::user()->id)->update(['is_seen' => 1]);
        return response()->json([
            'status' => 200,
            'success' => true
        ]);
    }

    public function chatContact()
    {
        $chatts = Message::where('sender_id',Auth::user()->id)->orWhere('recipient_id',Auth::user()->id)->get();
        $chats = User::whereIn('id',$chatts->pluck('recipient_id')->unique()->flatten())
                    ->orWhereIn('id',$chatts->pluck('sender_id')->unique()->flatten())->get();
        return response()->json($chats);
    }

    public function fetchMessages($to)
    {

        $id = Auth::user()->id;
        $messages = DB::select('select * from `messages` where (`sender_id` = ? or `recipient_id` = ?) and (`recipient_id` = ? or `sender_id` = ?)', [$id,$id,$to,$to]);

        return response()->json([$messages,User::find($to)]);


    }


    public function messages_between($id)
    {
        $user = User::where('id',$id)->first();

        $messages = auth()->user()->messages_between($user);

        return response()->json($messages);
    }

    public function sendSignal(Request $request){
        $message = $request->msg;
        broadcast(new CallSignal($message))->toOthers();
        // auth()->user()->markMessagesSeen($user);
        return response()->json([
            'status' => 200
        ]);

    }

}
