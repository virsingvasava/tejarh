<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;

class ChangesPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function changespassword(Request $request)
    {
        $user_token = $request->header('authorization');
        $jwt_user   = JWTAuth::parseToken()->authenticate($user_token);
        $user_id     = $jwt_user->id;

        $validator = validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }
        $user = User::where('id', $user_id)->first();
        $password = $request->current_password;

        if (isset($user) && !empty($user)) {
            $check_password = Hash::check($password, $user->password);
        }

        if (!$check_password) {
            $message = "Old password does not match!";
            return InvalidResponse($message, 101);
        } else {
            $user->password = Hash::make($request->new_password);
            $user->save();
            $message = 'Change Password successfully.';
            return SuccessResponse($message, 200, $user);
        }
    }
}
