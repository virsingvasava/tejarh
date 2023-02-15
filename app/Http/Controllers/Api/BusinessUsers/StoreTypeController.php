<?php

namespace App\Http\Controllers\Api\BusinessUsers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\Branch;
use App\Models\User;
use App\Models\StoreType;
use Validator;
use JWTAuth;
use Response;
use JWTFactory;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\JWTException;
use Mail; 

class StoreTypeController extends Controller
{

    public function getStoreTypeList(Request $request)
    { 
        $storeType_list = StoreType::all(); 

        if(count($storeType_list) > 0){

            $message = 'Fetch store type listing successfully.';
            return SuccessResponse($message,200,$storeType_list);

        }else {
            $message = "Store type not found";
            return InvalidResponse($message,101);
        }
    }
}
