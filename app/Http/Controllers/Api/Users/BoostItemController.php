<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;
use App\Models\BoostItem;
use Validator;
use JWTAuth;
use Response;
use JWTFactory;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\JWTException;

class BoostItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

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

    public function boostItemDetail(Request $request)
    {
        $inputData = $request->all();

        $header = $request->header('AuthorizationUser');
        $user_token = $request->header('authorization');

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
            'item_id' => 'required',
        ]);
        
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $itemId = $request->item_id;

        $boost_item = Product::where(['id' => $itemId, 'user_id' => $user_id, 'status' => true])->first();        

        if(empty($boost_item)){
            $message = "Boost item not found";
            return InvalidResponse($message,101);
        }

        $message = 'Fetch boost item successfully.';
        return SuccessResponse($message,200,$boost_item);
    }

    public function boostItemPrice(Request $request)
    {
        $inputData = $request->all();
        
        $header = $request->header('AuthorizationUser');
        $user_token = $request->header('authorization');

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
            'item_id' => 'required',
            'boost_item_price' => 'required',
        ]);
        
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;
        
        $boost_price = new Offer;
        $boost_price->user_id = $user_id;
        $boost_price->item_id = $request->item_id;
        $boost_price->boost_item_price = $request->boost_item_price;
        $boost_price->save();

        $message = 'Boost items Successfully.';
        return SuccessResponse($message,200,$boost_price);
    }
}
