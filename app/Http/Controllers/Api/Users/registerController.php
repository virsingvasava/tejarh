<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class registerController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_picture' => 'required|image',
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'phone_number' => 'required', 
            'password' => 'required',
            'country_id'=> 'required',
            'state_id' => 'required',
            'city_id' => 'required',

        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }
        $user = User::where('email',$request->email)->first();
        if(empty($user)){
            //$otp = generateRandomString(5);
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
                $create_user->email = $request->email;
                $create_user->phone_number = $request->phone_number;
                $create_user->password = Hash::make($request->password);
                $create_user->country_id = $request->country_id;
                $create_user->state_id = $request->state_id;
                $create_user->city_id = $request->city_id;
                $create_user->role = USER_ROLE;
                $create_user->status = 0;
                $create_user->is_confirm = 0;
                //$create_user->otp = (int)$otp;
                $create_user->save();

                $message = 'Registration Successfully.';
                return SuccessResponse($message,200,$user);
        }else {
            $message = 'This email already exists in our record';
            return InvalidResponse($message,101);
        }
    }
   
}
