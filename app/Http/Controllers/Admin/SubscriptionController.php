<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Jobs\MessageSendSubscribeUsersJob;
use App\Models\User;

class SubscriptionController extends Controller
{
    public function index() 
    { 
        $subscription = Subscription::get()->toArray();  
        return view('admin.subscription.index',compact('subscription'));
    }

    public function create()
    {
        return view('admin.subscription.create');
    }

    public function store(Request $request)
    { 
        $subscriptionAllUsers = Subscription::get()->toArray();  

        if (!empty($subscriptionAllUsers)) {
            foreach ($subscriptionAllUsers as $key => $value) {
                $to = $value['email'];
                $subject = $request->subject;
                $body_messages = $request->message;

                $message = Subscription::where('email', $value['email'])->first();
                $message->email = $value['email'];
                $message->heading_title = $request->heading_title;
                $message->subject = $request->subject;
                $message->body_message = $request->message;
                $message->status =true;
                $message->save();
                
                $subscriptionAllUsersArr = new MessageSendSubscribeUsersJob($to, $subject, $body_messages);
                dispatch($subscriptionAllUsersArr);
            }
        }

        return redirect()->route('admin.subscription.index')->with('success', __('messages.subscription.success.message_send_successfully'));
    }

    public function subscription_status_update(Request $request)
    {
        $status_update = Subscription::where('id',$request->subscription_user_id)->first();
        $status_update->status = $request->status;
        $status_update->save();
        return redirect()->route('admin.subscription.index')->with('success', __('messages.sub_category.success.sub_category_status_successfully'));
    }

}
