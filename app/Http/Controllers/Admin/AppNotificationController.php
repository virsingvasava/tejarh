<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BroadCastNotificationDetail;
use App\Models\BroadCastNotificationMaster;
use App\Models\GroupNotification;
use App\Models\GroupNotificationDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Mpdf\Tag\Input;

class AppNotificationController extends Controller
{
    public function index()
    {
        $getGroupNotification = GroupNotification::get();
        return view('admin.app_notification.index', compact('getGroupNotification'));
    }

    public function create(Request $request)
    {
        $getUsers = User::where('device_token', '!=', Null)->get();
        return view('admin.app_notification.create', compact('getUsers'));
    }

    public function store(Request $request)
    {
        $createGroup = new GroupNotification;
        $createGroup->names = json_encode($request->names);
        $createGroup->save();

        if ($request->names) {
            foreach ($request->names as $key => $val) {
                $adddetails = new GroupNotificationDetail;
                $adddetails->group_id = $createGroup->id;
                $adddetails->user_id = $request->names[$key];
                $adddetails->save();
            }
        }

        return redirect()->route('admin.app-notification.index');
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $groupNoti = GroupNotification::where('id', $id)->delete();
        $notidetails = GroupNotificationDetail::where('group_id', $id)->delete();
        return redirect()->route('admin.app-notification.index')->with('error', __('messages.category.success.category_deleted_successfully'));
    }

    public function broad_cast_notification()
    {
        $getDetails = BroadCastNotificationDetail::get()->toArray();
        $itemArray = [];
        foreach ($getDetails as $Key => $Value)
        {
            $itemArray[$Key] = $Value;

            $user = User::where('id',$Value['user_id'])->first();
            $itemArray[$Key]['user'] = $user; 

            $broadcastMaster = BroadCastNotificationMaster::where('id',$Value['broadcast_id'])->first();
            $itemArray[$Key]['broadcastMaster'] = $broadcastMaster; 

        }
        return view('admin.app_notification.broadcast_index',compact('itemArray'));
    }

    public function broad_cast_create()
    {
        $getGroup = GroupNotification::get();
        $getUsers = User::where('device_token', '!=', Null)->get();
        return view('admin.app_notification.broadcast_create', compact('getGroup', 'getUsers'));
    }

    public function broad_cast_individual_store(Request $request)
    {
        $createBroadCast = new BroadCastNotificationMaster;
        $createBroadCast->type = 'individual';
        $createBroadCast->user_id_array = json_encode($request->user_id);
        $createBroadCast->save();

        if ($request->user_id) {
            foreach ($request->user_id as $key => $val) {
                $adddetails = new BroadCastNotificationDetail;
                $adddetails->broadcast_id = $createBroadCast->id;
                $adddetails->user_id = $request->user_id[$key];
                $adddetails->notification_title = $request->notification_title;
                $adddetails->notification_message = $request->notification_message;
                $adddetails->save();
            }
        }
        return redirect()->route('admin.app-notification.broad_cast_notification');
    }

    public function broad_cast_group_store(Request $request)
    {
        $createBroadCast = new BroadCastNotificationMaster;
        $createBroadCast->type = 'group';
        $createBroadCast->group_id = $request->group_id;
        $createBroadCast->save();

        $getGroupUsers = GroupNotificationDetail::where('group_id', $createBroadCast->group_id)->get()->toArray();
        if (!empty($getGroupUsers) && count($getGroupUsers) > 0) {
            foreach ($getGroupUsers as $key => $val) {
                $adddetails = new BroadCastNotificationDetail;
                $adddetails->broadcast_id = $createBroadCast->id;
                $adddetails->user_id = $val['user_id'];
                $adddetails->notification_title = $request->notification_title_group;
                $adddetails->notification_message = $request->notification_message_group;
                $adddetails->save();
            }
        }
        return redirect()->route('admin.app-notification.broad_cast_notification');
    }

    public function broad_cast_all_store(Request $request)
    {
        $createBroadCast = new BroadCastNotificationMaster;
        $createBroadCast->type = 'all';
        $createBroadCast->save();

        $userId = User::where('device_token', '!=', Null)->get();
        if (!empty($userId)) {
            foreach ($userId as $key => $val) {
                $tokenStr = $val->device_token;
                $adddetails = new BroadCastNotificationDetail;
                $adddetails->broadcast_id = $createBroadCast->id;
                $adddetails->user_id = $val['id'];
                $adddetails->notification_title = $request->notification_title_all;
                $adddetails->notification_message = $request->notification_message_all;
                $adddetails->save();

                $url = 'https://fcm.googleapis.com/fcm/send';

                $notification = ['title' => $adddetails->notification_title, 'body' => $adddetails->notification_message, 'sound' => 'android\app\src\main\res\raw\cuckoo_sms.mp3'];

                $server_key = 'AAAAG-nXEUo:APA91bFgc7vb2AuL6hYZAeJD80N3fw6aU-ABN5ydyhrk6wp_14aAZCyCNxiIxkLHF8xYuZIqoOFsv5PaRgikK3zxRSzzRx8cyxfsDn9TO2n7kkSG448SiAHJkR2pUfBkmPZukRq60Cqx';

                $extraNotificationData = ["message" => $notification, "moredata" => 'dd'];

                $fcmNotification = [
                    'to'  => $tokenStr,
                    'notification' => $notification,
                    'data' => $extraNotificationData
                ];

                $fields = json_encode($fcmNotification);

                $headers = array(
                    'Authorization: key=' . $server_key,
                    'Content-Type: application/json'
                );

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

                $result = curl_exec($ch);
                //echo $result;
                curl_close($ch);
            }
        }
        return redirect()->route('admin.app-notification.broad_cast_notification');
    }
}
