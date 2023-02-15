<?php

namespace App\Http\Controllers\Frontend\Users;

use App\Http\Controllers\Controller;
use App\Models\SupportCategory;
use App\Models\TicketDetail;
use App\Models\TicketMaster;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class UserTicketController extends Controller
{
    public function index()
    {
        $authId = Auth::user();
        $getTicket = TicketMaster::where('ticket_user_id',$authId->id)->where('user_id', '!=' , 1)->get()->toArray();
        $itemArray = [];
        if (!empty($getTicket) && count($getTicket) > 0) {
            foreach ($getTicket as $key => $value) {
                $itemArray[$key] = $value;
            }
        }
        return view('frontend.users.user_ticket.index',compact('itemArray'));
    }

    public function store(Request $request)
    {
        $authId = Auth::user();
        $addTicket = new TicketMaster;
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

        $addTicket->user_id = $request->user_id;
        $addTicket->ticket_user_id = $authId->id;
        $addTicket->subject = $request->subject;
        $addTicket->category = $request->support_cat_id;
        $addTicket->sku_id = $request->sku_id;
        $addTicket->save();

        $addTicketDetails = new TicketDetail;
        $addTicketDetails->ticket_master_id = $addTicket->id;
        $addTicketDetails->user_id = $authId->id;
        $addTicketDetails->message = $request->message;
        $addTicketDetails->image = $imageName;
        $addTicketDetails->save();

        return response()->json(['code' => 200, 'success' => Lang::get('Ticket Added')], 200);
    }

    public function ticket_details(Request $request)
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
        return view('frontend.users.user_ticket.details',compact('itemArray'));
    }

    public function add_reply(Request $request)
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

        return response()->json(['code' => 200, 'success' => Lang::get('Reply Given Successfully')], 200);
    }

    public function reaquested_list()
    {
        $authId = Auth::user();
        $getTicket = TicketMaster::where('user_id',$authId->id)->where('user_id', '!=' , 1)->get()->toArray();
        $itemArray = [];
        if (!empty($getTicket) && count($getTicket) > 0) {
            foreach ($getTicket as $key => $value) {
                $itemArray[$key] = $value;
            }
        }
        return view('frontend.users.user_ticket.requested_list',compact('itemArray'));
    }

    public function received_details(Request $request)
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
        return view('frontend.users.user_ticket.received_details',compact('itemArray'));
    }
}
