<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Validator;
use JWTAuth;
use Response;
use JWTFactory;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\JWTException;
use Mail;
use Illuminate\Support\Facades\Crypt;

class UsersRegisterController extends Controller
{

    public function user_register(Request $request){

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'phone_number' => ['required', 'digits:10'],
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'password' => 'required',              
            'profile_picture' => 'required|image',
        ]);

        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }
        $countryId = Country::where('id',$request->country_id)->first();
        if(empty($countryId)){

            $message = 'Country is not available our record';
            return InvalidResponse($message,101);
        }

        $stateId = State::where('id',$request->state_id)->first();
        if(empty($stateId)){

            $message = 'State is not available our record';
            return InvalidResponse($message,101);
        }

        $cityId = City::where('id',$request->city_id)->first();
        if(empty($cityId)){

            $message = 'City is not available our record';
            return InvalidResponse($message,101);
        }

        $email = $request->email;
        $email_check = User::where('email', $email)->first();
        if(!empty($email_check)){
            $message = 'This email already exists in our record';
            return InvalidResponse($message,101);
        }

      
            
        $regi = new User;
        $image = $request->profile_picture;
        
        if (!empty($image)) {
            $imagename = $request->profile_picture;        
            $destination = public_path("assets/users");
            if(!is_dir($destination)){
                mkdir($destination, 0777, true);
            }
            $name = 'profile_picture_' . time();
            $imageName = $name . '.' . $image->getClientOriginalExtension();
            $image->move($destination, $imageName);
            $regi->profile_picture = $imageName;
        }        
        $otp = generateRandomString(5);
        $regi->first_name = $request->first_name;
        $regi->last_name = $request->last_name;
        $regi->username = $request->username;
        $regi->email = $request->email;
        $regi->phone_code = $request->phone_code;
        $regi->phone_number = $request->phone_number;
        $regi->password = Hash::make($request->password);
        $regi->role = USER_ROLE;
        $regi->country_id = $request->country_id;
        $regi->state_id = $request->state_id;
        $regi->city_id = $request->city_id;
        $regi->status = false;
        $regi->is_confirm = false;
        $regi->otp = false;
        $regi->save();

        $message = 'Registration Successfully.';
        return SuccessResponse($message,200,$regi);  

    }
    public function register22(Request $request)
    {      
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'phone_number' => ['required', 'digits:10'],
            'password' => 'required',              
            'profile_picture' => 'required|image',
        ]);

        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }
        
        $user = User::where('email',$request->email)->orderBy('id')->first();

        if(!empty($user)){

            $message = 'This email already exists in our record';
            return InvalidResponse($message,101);

        } else {

            $otp = generateRandomString(5);
            $create_user = new User;
            $image = $request->profile_picture;

            if (!empty($image)) {
                $imagename = $request->profile_picture;        
                $destination = public_path("assets/users");
                if(!is_dir($destination)){
                    mkdir($destination, 0777, true);
                }
                $name = 'profile_picture_' . time();
                $imageName = $name . '.' . $image->getClientOriginalExtension();
                $image->move($destination, $imageName);
                $create_user->profile_picture = $imageName;
            }        
            $create_user->first_name = $request->first_name;
            $create_user->last_name = $request->last_name;
            $create_user->username = $request->username;
            $create_user->email = $request->email;
            $create_user->phone_code = $request->phone_code;
            $create_user->phone_number = $request->phone_number;
            $create_user->password = Hash::make($request->password);
            $create_user->role = USER_ROLE;
            $create_user->status = false;
            $create_user->is_confirm = false;
            $create_user->otp = (int)$otp;
            $create_user->save();

            $message = 'Registration Successfully.';
            return SuccessResponse($message,200,$create_user);  
        }
    }

    public function verify_otp(Request $request)
    {
        $inputData = $request->all();

        $header = $request->header('AuthorizationUser');
        if(empty($header))
        {
            $message = 'Authorisation required' ;
            return InvalidResponse($message,101);
        }

        $response = veriftyAPITokenData($header);
        $success = $response->original['success'];
        
        if (!$success) {
            return $response;
        }

        $validator = Validator::make($request->all(), [
            'phone_number' => 'required',
            'otp' => 'required',
        ]);

        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }

        $user = User::where('phone_number',$request->phone_number)->first();

        if(!empty($user)){
            
            if($user->otp == $request->otp){

                $user->otp = null;
                $user->is_confirm = true;
                $user->status = true;
                $user->activate = true;
                $user->save();

                $user_detail = User::where('id',$user->id)->first();
                $token = JWTAuth::fromUser($user_detail);
                $user_detail['token'] = $token;

                if(isset($request->device_token) && $request->device_token != "")
                {
                    UserDeviceToken::where('user_id',$user_detail['id'])->delete();
                    $addDeviceToken = new UserDeviceToken;
                    $addDeviceToken->user_id = $user_detail['id'];
                    $addDeviceToken->token = $request->device_token;
                    $addDeviceToken->save();
                }

                $message = 'User verified Successfully.';
                return SuccessResponse($message,200,$user_detail);
            } else {
                $message = 'Please enter valid OTP';
                return InvalidResponse($message,101);
            }
        } else {
            $message = 'This Phone number not exists in our record';
            return InvalidResponse($message,101);
        }
    }

    public function resend_otp(Request $request)
    {
        $inputData = $request->all();

        $header = $request->header('AuthorizationUser');
        if(empty($header))
        {
            $message = 'Authorisation required' ;
            return InvalidResponse($message,101);
        }

        $response = veriftyAPITokenData($header);
        $success = $response->original['success'];
        
        if (!$success) {
            return $response;
        }

        $validator = Validator::make($request->all(), [
            'phone_number' => ['required', 'digits:10'],
        ]);

        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }

        $user = User::where('phone_number',$request->phone_number)->first();

        if(!empty($user)){
            
            $otp = generateRandomString(4);
            $user->otp = $otp;
            $user->save();

            //sendOtp($user->phone_number,$otp);
            
            $message = 'OTP Send Successfully';
            return SuccessResponse($message,200,[]);
        } else {
            $message = 'This Phone number not exists in our record';
            return InvalidResponse($message,101);
        }
    }
}