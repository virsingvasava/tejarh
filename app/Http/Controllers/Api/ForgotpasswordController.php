<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\PasswordReset;
use Auth;
// use Mail;
use Validator;
use Log;
use Exception;
use Illuminate\Support\Facades\Mail;

class ForgotpasswordController extends Controller
{
   
    public function forgot_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);

        if ($validator->fails()){
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }

        $email = $request->email;
        $credential = User::where('email',$email)->first();

        if(!empty($credential))
        {
            
            PasswordReset::where('email',$email)->delete();
            $token = generateRandomString(5);
            $reset = new PasswordReset;
            $reset->email = $email;
            $reset->token = $token;
            $reset->save();
            
            $credential->otp = $token;
            $credential->save();
            
            $from_address = env('MAIL_FROM_ADDRESS');
            $from_name = env('MAIL_FROM_NAME');

            $data = array('name'=> $credential->name, 'token' => $token);

            try {
                Mail::send('mails.reset_link_otp', $data, function($message) use($credential,$from_address,$from_name) {
                    $message->to($credential->email, $credential->name);
                    $message->subject('Password reset request');
                    $message->from($from_address,$from_name);
                });

            } catch (Exception $e) {
                Log::Info('mail_failed_reset_link_app',['error' => $e]);
            }
            
            $message = 'Check your mailbox for reset password link';
            return SuccessResponse($message,200,[]); 
        } 
        else 
        {
            $message = 'Entered details not found';
            return InvalidResponse($message,200);
        }
    }

    public function check_otp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'otp' => 'required',
        ]);

        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }

        $otp = $request->otp;
        $email = $request->email;

        $check_otp = User::where('otp',$otp)->where('email',$email)->first();

        if(!empty($check_otp)){

            $message = 'OTP is valid';
            return SuccessResponse($message,200,"");

        } else {

            $message = 'Entered OTP is invalid';
            return InvalidResponse($message,200);
        }
    }

    public function password_submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }

        $username = $request->username;
        $check_credential = User::where('email',$username)->orWhere('username',$username)->first();

        if(!empty($check_credential)){

            $check_credential->password = Hash::make($request->password);
            $check_credential->otp = null;
            $check_credential->save();

            $message = 'Password updated successfully!';
            return SuccessResponse($message,200,[]);

        } else {

            $message = 'Entered details not found';
            return InvalidResponse($message,101);
        }
    }
}
