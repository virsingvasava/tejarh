<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserDeviceToken;
use Validator;
use JWTAuth;
use Response;
use JWTFactory;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Crypt;

use Auth;
use Mail;
use Log;
use Exception;


class VerificationOtpController extends Controller
{
    public function verify_otp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'otp' => 'required',
            'device_token',
        ]);

        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }

        $email = $request->email;
        $user = User::where('email',$email)->first();
        
        if(!empty($user)){

            $updateDeviceToken = User::where('email',$email)->first();
            $updateDeviceToken->device_token = $request->device_token;
            $updateDeviceToken->save();

            if($user->otp == $request->otp){

                $user->otp = null;
                $user->is_confirm = true;
                $user->status = true;
                $user->activate = true;
                $user->save();

                $user_detail = User::where('id',$user->id)->first();
                $token = JWTAuth::fromUser($user_detail);
                $user_detail['token'] = $token;

                $message = 'User verified Successfully.';
                return SuccessResponse($message,200,$user_detail);

            } else {
                
                $message = 'Please enter valid OTP';
                return InvalidResponse($message,101);
            }

        }else{
            $message = 'This email address not exists in our record';
            return InvalidResponse($message,101);
        }
    }

    public function resend_otp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }

        $user = User::where('email',$request->email)->first();

        if(!empty($user)){
            
            $otp = generateRandomString(5);
            $user->otp = $otp;
            $user->save();

            $from_address = env('MAIL_FROM_ADDRESS');
            $from_name = env('MAIL_FROM_NAME');
            $data = array('name'=> $user->name, 'otp' => $otp);

            try {
                Mail::send('mails.login_varification_code', $data, function($message) use($user,$from_address,$from_name) {
                    $message->to($user->email, $user->name);
                    $message->subject('Verified OTP');
                    $message->from($from_address,$from_name);
                });
            } catch (Exception $e) {
                Log::Info('Resend OPT',['error' => $e]);
            }

            $message = 'OTP Send Successfully';
            return SuccessResponse($message,200,[]);

        } else {

            $message = 'This email not exists in our record';
            return InvalidResponse($message,101);
        }
    }
}
