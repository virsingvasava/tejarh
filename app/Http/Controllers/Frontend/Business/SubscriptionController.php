<?php

namespace App\Http\Controllers\Frontend\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\SendEmailJobSubscribe;
use App\Jobs\SubscribeEmail;
use App\Models\{
    Subscription,
    User,
};
use Str;
use Hash;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {
        $email = $request->email;
        $checkUsers = Subscription::where('email', $email)->first();

        if (!empty($checkUsers)) {
            
            $emailJobs = new SendEmailJobSubscribe($checkUsers);
            dispatch($emailJobs);
            
            $userCheckSubscription = Subscription::where('email', $checkUsers['email'])->first();

            if (!empty($userCheckSubscription)) {

                $update = Subscription::where('email', $userCheckSubscription['email'])->first();
                $update->email =  $userCheckSubscription['email'];
                $update->save();
                return redirect()->route('frontend.users.site.index')->with('success', 'You are already subscribed user our services!');    
                
            }else{
                $create = new Subscription;
                $create->heading_title = NULL;
                $create->subject = NULL;
                $create->body_message = NULL;
                $create->email_send_status =NULL;
                $create->status =true;
                $create->save();
               
                return redirect()->route('frontend.business.home.index')->with('success', 'You have been successfully subscribed..!');    
            }
           
        }else{

            $username = $request->email;
            $password = (Str::random(10));

            /*
            $user = new User;
            $user->first_name = NULL;
            $user->last_name = NULL;
            $user->name = NULL;
            $user->phone_code = NULL;
            $user->phone_number = NULL;
            $user->email = $request->email;
            $user->password = Hash::make($password);
            $user->role = BUSINESS_ROLE;
            $user->country_id = TRUE;
            $user->state_id = TRUE;
            $user->city_id = TRUE;
            $user->save();
            */
            
            $subscribe = new Subscription;
            $subscribe->heading_title = NULL;
            $subscribe->subject = NULL;
            $subscribe->body_message = NULL;
            $subscribe->email = $request->email;
            $subscribe->email_send_status =NULL;
            $subscribe->status =true;
            $subscribe->save();
           
            $subcribe_new = new SubscribeEmail($username, $password);
            dispatch($subcribe_new);
            
            return redirect()->route('frontend.business.home.index')->with('success', 'You have been successfully subscribed..!');
        }
    }
}
