<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;
use App\Models\BoostItem;
use App\Models\Orders;
use Validator;
use JWTAuth;
use Response;
use JWTFactory;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\JWTException;

class OrderSummaryController extends Controller
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

    /* Order Summary */
    public function orderSummary(Request $request)
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
             'customer_id' => 'required',
             'item_id' => 'required',
             'item_price' => 'required',
             'sell_tax' => 'required',
             'shipping_charge' => 'required',
             'discount' => 'required',
             'payable_amount' => 'required',
         ]);
         
         if ($validator->fails()) {
             $message = $validator->messages()->first();
             return InvalidResponse($message,101);
         }
 
         $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
         $user_id = $jwt_user->id;

         $order_summary = new Orders;
         $order_summary->user_id = $user_id;
         $order_summary->customer_id = $request->customer_id;
         $order_summary->item_id = $request->item_id;
         $order_summary->item_price = $request->item_price;
         $order_summary->sell_tax = $request->sell_tax;
         $order_summary->shipping_charge = $request->shipping_charge;
         $order_summary->payable_amount = $request->payable_amount;
         $order_summary->save();

         $message = 'Fetch order summary successfully.';
         return SuccessResponse($message,200,$order_summary);
    }

     /* My Orders */
     public function myOrders(Request $request)
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
            //'item_id' => 'required',
            'customer_id' => 'required',
            //'user_id' => 'required',
        ]);
        
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;
        
        $myOrders = Orders::where(['user_id' => $user_id, 'customer_id' => $request->customer_id])->get();

        if(empty($myOrders)){
            $message = "Order not found";
            return InvalidResponse($message,101);
        }

        $message = 'Fetch my orders successfully.';
        return SuccessResponse($message,200,$myOrders);
     }

      /* Order Details */
    public function orderDetails(Request $request)
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
            'customer_id' => 'required',
            'order_id' => 'required',

        ]);
        
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }
        
        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        //$user_story = Orders::where('user_id',$user_id)->first();        
        $orderDetails = Orders::where(['id' => $request->order_id, 'user_id' => $user_id, 'customer_id' => $request->customer_id])->first();

        if(empty($orderDetails)){
            $message = "Order details not found";
            return InvalidResponse($message,101);
        }

        $message = 'Fetch order details successfully.';
        return SuccessResponse($message,200,$orderDetails);
    }

     /* Return Item */
     public function returnItem(Request $request)
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
             'customer_id' => 'required',
             'order_id' => 'required',
 
         ]);
         
         if ($validator->fails()) {
             $message = $validator->messages()->first();
             return InvalidResponse($message,101);
         }
         
         $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
         $user_id = $jwt_user->id;
 
         //$user_story = Orders::where('user_id',$user_id)->first();        
         $orderDetails = Orders::where(['id' => $request->order_id, 'user_id' => $user_id, 'customer_id' => $request->customer_id])->first();
 
         if(empty($orderDetails)){
             $message = "Return item not found";
             return InvalidResponse($message,101);
         }
 
         $message = 'Fetch return item details successfully.';
         return SuccessResponse($message,200,$orderDetails);
     }
}
