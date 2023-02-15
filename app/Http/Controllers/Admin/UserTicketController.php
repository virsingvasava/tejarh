<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TicketDetail;
use App\Models\TicketMaster;
use App\Models\User;
use Illuminate\Http\Request;

class UserTicketController extends Controller
{
    public function index()
    {
        $getTicket = TicketMaster::where('user_id','!=','1')->get()->toArray();
        $itemArray = [];
        if (!empty($getTicket) && count($getTicket) > 0) {
            foreach ($getTicket as $key => $value) {
                $itemArray[$key] = $value;
            }
        }
        return view('admin.user_ticket.index',compact('itemArray'));
    }

    public function status_update(Request $request)
    {
        $status_update = TicketMaster::where('id',$request->ticket_id)->first();
        $status_update->status = $request->status;
        $status_update->save();
        return redirect()->route('admin.user_ticket.index')->with('success','Status updated successfully!');
    }

    public function view(Request $request)
    {
        $getTicket = TicketDetail::where('ticket_master_id',$request->id)->get()->toArray();
        $itemArray = [];
        if (!empty($getTicket) && count($getTicket) > 0) {
            foreach ($getTicket as $key => $value) {
                $itemArray[$key] = $value;

                $User = User::where('id', $value['user_id'])->first();
                $itemArray[$key]['User'] = $User;

                $ticketMaster = TicketMaster::where('id', $value['ticket_master_id'])->first();
                $itemArray[$key]['ticketMaster'] = $ticketMaster;
            }
        }
        return view('admin.user_ticket.view',compact('itemArray'));
    }

}
