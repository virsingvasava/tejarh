<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\BusinessUsers;
use App\Models\UserDeviceToken;
use Validator;
use JWTAuth;
use Response;
use JWTFactory;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Crypt;
use Auth;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $validator = validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message, 101);
        }

        $username = $request->username;
        $check_credential = User::where('email', $username)->orWhere('username', $username)->first();

        if (!empty($check_credential)) {

            $password = $request->password;
            $check_password = Hash::check($password, $check_credential['password']);
            if ($check_password) {
                if ($check_credential->role == USER_ROLE) {
                    $role = USER_ROLE;
                    if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
                        $otp = generateRandomString(5);
                        $check_credential->otp = $otp;
                        $check_credential->save();
                        //dd($check_credential);

                        // $token = Auth::fromUser($check_credential);
                        // dd($token);
                        // $check_credential['token'] = $token;

                        $from_address = env('MAIL_FROM_ADDRESS');
                        $from_name = env('MAIL_FROM_NAME');
                        $data = array('name' => $check_credential->name, 'otp' => $otp);

                        try {
                            Mail::send('mails.login_varification_code', $data, function ($message) use ($check_credential, $from_address, $from_name) {
                                $message->to($check_credential->email, $check_credential->name);
                                $message->subject('Login OTP');
                                $message->from($from_address, $from_name);
                            });
                        } catch (Exception $e) {
                            Log::Info('Login OPT', ['error' => $e]);
                        }

                        $message = 'Login successfully';
                        return SuccessResponse($message, 200, $check_credential, $role);
                    } else {
                        $otp = generateRandomString(5);
                        $check_credential->otp = $otp;
                        $check_credential->save();
                        //dd($check_credential);

                        // $token = Auth::fromUser($check_credential);
                        // dd($token);
                        // $check_credential['token'] = $token;

                        $from_address = env('MAIL_FROM_ADDRESS');
                        $from_name = env('MAIL_FROM_NAME');
                        $data = array('name' => $check_credential->name, 'otp' => $otp);

                        try {
                            Mail::send('mails.login_varification_code', $data, function ($message) use ($check_credential, $from_address, $from_name) {
                                $message->to($check_credential->email, $check_credential->name);
                                $message->subject('Login OTP');
                                $message->from($from_address, $from_name);
                            });
                        } catch (Exception $e) {
                            Log::Info('Login OPT', ['error' => $e]);
                        }

                        $message = 'Login successfully';
                        return SuccessResponse($message, 200, $check_credential, $role);
                    }
                }
                if ($check_credential->role == BUSINESS_ROLE) {
                    $role = BUSINESS_ROLE;
                    if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
                        $otp = generateRandomString(5);
                        $check_credential->otp = $otp;
                        $check_credential->save();
                        //dd($check_credential);

                        // $token = Auth::fromUser($check_credential);
                        // dd($token);
                        // $check_credential['token'] = $token;

                        $from_address = env('MAIL_FROM_ADDRESS');
                        $from_name = env('MAIL_FROM_NAME');
                        $data = array('name' => $check_credential->name, 'otp' => $otp);

                        try {
                            Mail::send('mails.login_varification_code', $data, function ($message) use ($check_credential, $from_address, $from_name) {
                                $message->to($check_credential->email, $check_credential->name);
                                $message->subject('Login OTP');
                                $message->from($from_address, $from_name);
                            });
                        } catch (Exception $e) {
                            Log::Info('Login OPT', ['error' => $e]);
                        }

                        $message = 'Login successfully';
                        return SuccessResponse($message, 200, $check_credential, $role);
                    } else {
                        $otp = generateRandomString(5);
                        $check_credential->otp = $otp;
                        $check_credential->save();
                        //dd($check_credential);

                        // $token = Auth::fromUser($check_credential);
                        // dd($token);
                        // $check_credential['token'] = $token;

                        $from_address = env('MAIL_FROM_ADDRESS');
                        $from_name = env('MAIL_FROM_NAME');
                        $data = array('name' => $check_credential->name, 'otp' => $otp);

                        try {
                            Mail::send('mails.login_varification_code', $data, function ($message) use ($check_credential, $from_address, $from_name) {
                                $message->to($check_credential->email, $check_credential->name);
                                $message->subject('Login OTP');
                                $message->from($from_address, $from_name);
                            });
                        } catch (Exception $e) {
                            Log::Info('Login OPT', ['error' => $e]);
                        }

                        $message = 'Login successfully';
                        return SuccessResponse($message, 200, $check_credential, $role);
                    }
                }
                if ($check_credential->role == STORE_ROLE) {
                    $role = STORE_ROLE;
                    if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
                        $otp = generateRandomString(5);
                        $check_credential->otp = $otp;
                        $check_credential->save();
                        //dd($check_credential);

                        // $token = Auth::fromUser($check_credential);
                        // dd($token);
                        // $check_credential['token'] = $token;

                        $from_address = env('MAIL_FROM_ADDRESS');
                        $from_name = env('MAIL_FROM_NAME');
                        $data = array('name' => $check_credential->name, 'otp' => $otp);

                        try {
                            Mail::send('mails.login_varification_code', $data, function ($message) use ($check_credential, $from_address, $from_name) {
                                $message->to($check_credential->email, $check_credential->name);
                                $message->subject('Login OTP');
                                $message->from($from_address, $from_name);
                            });
                        } catch (Exception $e) {
                            Log::Info('Login OPT', ['error' => $e]);
                        }

                        $message = 'Login successfully';
                        return SuccessResponse($message, 200, $check_credential, $role);
                    } else {
                        $otp = generateRandomString(5);
                        $check_credential->otp = $otp;
                        $check_credential->save();
                        //dd($check_credential);

                        // $token = Auth::fromUser($check_credential);
                        // dd($token);
                        // $check_credential['token'] = $token;

                        $from_address = env('MAIL_FROM_ADDRESS');
                        $from_name = env('MAIL_FROM_NAME');
                        $data = array('name' => $check_credential->name, 'otp' => $otp);

                        try {
                            Mail::send('mails.login_varification_code', $data, function ($message) use ($check_credential, $from_address, $from_name) {
                                $message->to($check_credential->email, $check_credential->name);
                                $message->subject('Login OTP');
                                $message->from($from_address, $from_name);
                            });
                        } catch (Exception $e) {
                            Log::Info('Login OTP', ['error' => $e]);
                        }

                        $message = 'Login successfully';
                        return SuccessResponse($message, 200, $check_credential, $role);
                    }
                }
            } else {
                $message = "Please enter valid credentials";
                return InvalidResponse($message, 101);
            }
        } else {

            $message = "Please enter valid credentials";
            return InvalidResponse($message, 101);
        }
    }


    public function verify_otp_without_auth(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'otp' => 'required',
        ]);

        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message, 101);
        }

        $email = $request->email;
        $user = User::where('email', $email)->first();

        if (!empty($user)) {

            if ($user->otp == $request->otp) {

                $user->otp = null;
                $user->is_confirm = true;
                $user->status = true;
                $user->activate = true;
                $user->save();

                $user_detail = User::where('id', $user->id)->first();
                $token = Auth::fromUser($user_detail);
                $user_detail['token'] = $token;

                $message = 'User verified Successfully.';
                return SuccessResponse($message, 200, $user_detail);
            } else {

                $message = 'Please enter invalid OTP';
                return InvalidResponse($message, 101);
            }
        } else {
            $message = 'This email address not exists in our record';
            return InvalidResponse($message, 101);
        }
    }



    public function resend_otp_without_auth(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message, 101);
        }

        $user = User::where('email', $request->email)->first();

        if (!empty($user)) {

            $otp = generateRandomString(5);
            $user->otp = $otp;
            $user->save();

            $from_address = env('MAIL_FROM_ADDRESS');
            $from_name = env('MAIL_FROM_NAME');
            $data = array('name' => $user->name, 'otp' => $otp);

            try {
                \Mail::send('mails.login_varification_code', $data, function ($message) use ($user, $from_address, $from_name) {
                    $message->to($user->email, $user->name);
                    $message->subject('Verified OTP');
                    $message->from($from_address, $from_name);
                });
            } catch (Exception $e) {
                Log::Info('Resend OTP', ['error' => $e]);
            }

            $message = 'OTP Send Successfully';
            return SuccessResponse($message, 200, []);
        } else {

            $message = 'This email not exists in our record';
            return InvalidResponse($message, 101);
        }
    }

    public function auto_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message, 101);
        }
        $checkRole = $request->role;
        $userId = $request->user_id;

        if ($checkRole == USER_ROLE) {
            $user = User::where('id', $request->user_id)->first();
        } else {
            $user = BusinessUsers::with('user')->where('user_id', $userId)->get();
        }

        if (!empty($user)) {
            $message = "Login successfully";
            return SuccessResponse($message, 200, $user);
        } else {
            $message = "Entered details not found on our records!";
            return InvalidResponse($message, 101);
        }
    }
}
