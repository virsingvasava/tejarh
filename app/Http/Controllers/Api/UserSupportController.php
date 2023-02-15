<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SupportCategory;
use App\Models\TicketDetail;
use App\Models\TicketMaster;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserSupportController extends Controller
{
    public function suppoetlist(Request $request)
    {
        $user_token = $request->header('authorization');

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;
        $limit = 10;
        $page_no = 1;
        if (isset($request->page) && $request->page != "") {
            $page_no = $request->page;
        }
        $start_from = ($page_no - 1) * $limit;
        $getTicket = TicketMaster::where('ticket_user_id',$user_id)->where('user_id', '!=' , 1)->skip($start_from)->take($limit)->get()->toArray();
        $itemArray = [];
        if (!empty($getTicket) && count($getTicket) > 0) {
            foreach ($getTicket as $key => $value) {
                $itemArray[$key] = $value;
            }
        }
        $message = 'suppoet list.';
        return SuccessResponse($message,200,$itemArray);
    }



    public function Addsupport(Request $request)
    {
        $user_token = $request->header('authorization');

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $validator = Validator::make($request->all(), [
            'subject' => 'required',
            'message'=>'required',
            'sku_id' => 'required',
        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message, 101);
        }
        $addTicket = new TicketMaster;
        $request->validate([
            'image' => 'mimes:jpeg,png,jpg,pdf|max:1024',
        ]);
        $image = $request->image;
        if ($request->hasFile('image')) {
            $picture1 = $request->file('image');
            $name = 'item_picture1_' . time() . '.' . $picture1->getClientOriginalExtension();
            $destinationPath = public_path(USERS_TICKET);
            $picture1->move($destinationPath, $name);
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
        }

        $addTicket->user_id = $request->user_id;
        $addTicket->ticket_user_id = $user_id;
        $addTicket->subject = $request->subject;
        $addTicket->sku_id = $request->sku_id;
        $addTicket->save();

        $addTicketDetails = new TicketDetail;
        $addTicketDetails->ticket_master_id = $addTicket->id;
        $addTicketDetails->user_id = $user_id;
        $addTicketDetails->message = $request->message;
        $addTicketDetails->image = $name;
        $addTicketDetails->save();

        $message = 'Add successfully.';
        $items_details = TicketMaster::with('TicketDetail')->where('id',$addTicket->id)->get();
        
        return SuccessResponse($message,200,$items_details);

    }
    public function Supportdetails(Request $request)
    {
        $user_token = $request->header('authorization');

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $validator = Validator::make($request->all(), [
            'ticket_master_id' => 'required',
        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message, 101);
        }

        $getTicket = TicketDetail::where('ticket_master_id',$request->ticket_master_id)->get()->toArray();
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
        $message = 'Support Details.';
        return SuccessResponse($message,200,$itemArray);
    }
    public function Addreply(Request $request)
    {
        $user_token = $request->header('authorization');

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $validator = Validator::make($request->all(), [
            'ticket_master_id' => 'required',
        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message, 101);
        }
        $request->validate([
            'image' => 'mimes:jpeg,png,jpg,pdf|max:1024',
        ]);
        $addTicketDetails = new TicketDetail;
        $image = $request->image;
        if ($request->hasFile('image')) {
            $picture1 = $request->file('image');
            $name = 'item_picture1_' . time() . '.' . $picture1->getClientOriginalExtension();
            $destinationPath = public_path(USERS_TICKET);
            $picture1->move($destinationPath, $name);
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
        }
        $addTicketDetails->ticket_master_id = $request->ticket_master_id;
        $addTicketDetails->user_id = $user_id;
        $addTicketDetails->message = $request->message;
        $addTicketDetails->image = $name;
        $addTicketDetails->save();

        $message = 'Reply successfully.';
        $items_details = TicketDetail::where('id',$addTicketDetails->id)->get();
        return SuccessResponse($message,200,$items_details);
    }
    public function requestlist(Request $request)
    {
        $user_token = $request->header('authorization');

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $getTicket = TicketMaster::where('user_id',$user_id)->where('user_id', '!=' , 1)->get()->toArray();
        $itemArray = [];
        if (!empty($getTicket) && count($getTicket) > 0) {
            foreach ($getTicket as $key => $value) {
                $itemArray[$key] = $value;
            }
        }
        $message = 'received list.';
        return SuccessResponse($message,200,$itemArray);
    }
    public function requestdetails(Request $request)
    {
        $user_token = $request->header('authorization');

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $validator = Validator::make($request->all(), [
            'ticket_master_id' => 'required',
        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message, 101);
        }
        $getTicket = TicketDetail::where('ticket_master_id',$request->ticket_master_id)->get()->toArray();
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
        $message = 'Received Details.';
        return SuccessResponse($message,200,$itemArray);
    }

}
