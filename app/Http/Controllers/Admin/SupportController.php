<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\tktCat;
use App\Models\General\TicketChat;
use App\Models\Admin\supportTkts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
class SupportController extends Controller
{
    public function index()
    {
        $tickets = supportTkts::with(['category','tkt_created_by'])->get();
        return view('admin.pages.support.index',compact('tickets'));
    }
    public function category()
    {
        $categories = tktCat::all();
        return view('admin.pages.support.category',compact('categories'));
    }

    public function ticket($id) {
        $ticket = supportTkts::where('ticket_no',$id)->with(['category','tkt_created_by'])->first();
        $ticket_replies = TicketChat::with(['sender','receiver'])->where('ticket_id',$ticket->id)->get();
        $staffs = User::where('role',4)->get();
        $idAdmin = Auth::user()->id;

        return view('admin.pages.support.ticket',compact('ticket','idAdmin','ticket_replies','staffs'));
    }
    public function ticketReply()
    {
        return view('admin.pages.support.ticketReply');
    }

    // save category
    public function saveCategory(Request $request) {

        if($request->id == '') {
            $data = tktCat::create(["title" => $request->title]);
            $message = 'Added';
        }else{
            tktCat::where('id',$request->id)->update(["title" => $request->title]);
            $message = 'Updated';
        }

        return response()->json([
            'status_code'=> 200,
            'message' => 'Category '.$message.' Successfully',
            'success' => true,
            'id' => $request->id == '' ? $data->id : $request->id,
            'response' => $message,
        ]);
    }

    // delete category
    public function deleteCategory(Request $request) {
        tktCat::where('id',$request->id)->delete();
        return response()->json([
            'status_code'=> 200,
            'message' => 'Category Deleted Successfully',
            'success' => true,
        ]);
    }
    public function ticketChat(Request $request){

        $data = $request->all();
        TicketChat::create($data);
        return response()->json([
            'status_code'=> 200,
            'message' => 'Message Sent Successfully',
            'success' => true,
            'data' => $data,
        ]);

    }

    public function assignTicket(Request $request)
    {
        $ticket = supportTkts::where('ticket_no',$request->ticket_id)->update([
                        "assign_to" => $request->user
                    ]);
        $user = User::where('id',$request->user)->first();

        return response()->json([
            'status'=> 200,
            'message' => 'Ticket has been successfully assigned to '.$user->first_name.''.$user->last_name ,
            'success' => true,
        ]);

    }
}
