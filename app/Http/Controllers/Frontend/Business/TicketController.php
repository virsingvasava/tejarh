<?php

namespace App\Http\Controllers\Frontend\Business;

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
        $authId = Auth::user();
        $getsupportCategory = SupportCategory::where('status',TRUE)->get();
        $getTicket = TicketMaster::where('ticket_user_id',$authId->id)->where('user_id', '=' , 1)->get()->toArray();
        $itemArray = [];
        if (!empty($getTicket) && count($getTicket) > 0) {
            foreach ($getTicket as $key => $value) {
                $itemArray[$key] = $value;

                $supportCategory = SupportCategory::where('id', $value['category'])->first();
                $itemArray[$key]['supportCategory'] = $supportCategory;
            }
        }
        $randomNumber = random_int(100000, 999999);
        return view('frontend.business.pages.ticket.index',compact('getsupportCategory','itemArray','randomNumber'));
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

        $addTicket->user_id = '1';
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
        return view('frontend.business.pages.ticket.details',compact('itemArray'));
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

        return response()->json(['code' => 200, 'success' => Lang::get('Ticket Added')], 200);
    }
}
