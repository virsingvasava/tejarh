<?php

namespace App\Http\Controllers\Frontend\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;

class ContactUsController extends Controller
{
    public function seedMessageForContactUs(Request $request)
    {
        $contactUs = new ContactUs;
        $contactUs->first_name  = $request->first_name;
        $contactUs->last_name  = $request->last_name;
        $contactUs->email  = $request->email;
        $contactUs->phone_number  = $request->phoneNumber;
        $contactUs->subject  = $request->subject;
        $contactUs->message  = $request->message;
        $contactUs->save();

        return redirect()->route('frontend.users.site.index')->with('success', __('messages.support.success.message_send_successfully'));

    }
}
