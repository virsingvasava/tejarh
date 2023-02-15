<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class UserChatController extends Controller
{
    public function useriamges(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) 
        {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }

        $userId = $request->id;
        $user = User::where('id',$userId)->select('profile_picture')->first();
        $message = 'Fetch User Image successfully.';
        return SuccessResponse($message,200,$user);
    }
}
