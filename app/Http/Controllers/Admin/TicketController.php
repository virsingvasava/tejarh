<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportCategory;
use App\Models\TicketDetail;
use App\Models\TicketMaster;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class TicketController extends Controller
{
    public function index()
    {
        $getTicket = TicketMaster::where('user_id','=','1')->get()->toArray();
        $itemArray = [];
        if (!empty($getTicket) && count($getTicket) > 0) {
            foreach ($getTicket as $key => $value) {
                $itemArray[$key] = $value;

                $supportCategory = SupportCategory::where('id', $value['category'])->first();
                $itemArray[$key]['supportCategory'] = $supportCategory;
            }
        }
        return view('admin.ticket.index',compact('itemArray'));
    }

    public function status_update(Request $request)
    {
        $status_update = TicketMaster::where('id',$request->ticket_id)->first();
        $status_update->status = $request->status;
        $status_update->save();
        return redirect()->route('admin.ticket.index')->with('success','Status updated successfully!');
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
        return view('admin.ticket.view',compact('itemArray'));
    }

    public function reply(Request $request)
    {
        $authId = Auth::user();
        $request->validate([
            'image' => 'mimes:jpeg,png,jpg,pdf|max:1024',
        ]);
        $image = $request->image;
        if ($request->has('image')) {
            $imagename = $request->image;
            $destination = public_path('assets/ticket');
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $name = 'images' . time();
            $imageName = $name . '.' . $image->getClientOriginalExtension();
            $image->move($destination, $imageName);
        } else {
            $imageName = null;
        }

        $addTicketDetails = new TicketDetail;
        $addTicketDetails->ticket_master_id = $request->ticket_master_id;
        $addTicketDetails->user_id = $authId->id;
        $addTicketDetails->message = $request->message;
        $addTicketDetails->image = $imageName;
        $addTicketDetails->save();

        return redirect()->back();
    }
}
