<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
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

class UsersListController extends Controller
{
    public function postRefreshToken(Request $request) 
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
        
        if (!$success) 
        {
            return $response;
        }
    }

    public function getUsersList(Request $request)
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
        
        $users_list = User::where('role', USER_ROLE)->get();        

        if(empty($users_list)){
            $message = "Users not found";
            return InvalidResponse($message,101);
        }
        $message = 'Fetch users listing successfully.';
        return SuccessResponse($message,200,$users_list);
    }
}
