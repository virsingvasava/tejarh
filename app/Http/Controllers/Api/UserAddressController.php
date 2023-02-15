<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CheckOutUserDetails;
use App\Models\UsersDeliveryAddress;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;

class UserAddressController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }
    public function myaddress(Request $request)
    {
        $user_token = $request->header('authorization');

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $validator = validator::make($request->all(), [
            'name' => 'required',
            'phone_number' => 'required',
            'pincode' => 'required',
            'locality' => 'required',
            'address' => 'required',
            'city' => 'required',
            'address_type' => 'required',
        ]);
        if ($validator->fails()) 
        {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }
        $usersDeliveryAddress = new UsersDeliveryAddress;
        $usersDeliveryAddress->user_id = $user_id;
        $usersDeliveryAddress->name = $request->name;
        $usersDeliveryAddress->phone_number = $request->phone_number;
        $usersDeliveryAddress->pincode = $request->pincode;
        $usersDeliveryAddress->locality = $request->locality;
        $usersDeliveryAddress->address = $request->address;
        $usersDeliveryAddress->city = $request->city;
        $usersDeliveryAddress->landmark = $request->landmark;
        $usersDeliveryAddress->alternate_phone = $request->alternate_phone;
        $usersDeliveryAddress->address_type = $request->address_type;
        $usersDeliveryAddress->save();

        $message = 'Address Add successfully';
        return SuccessResponse($message,200,$usersDeliveryAddress);
    }

    public function myaddresslisting(Request $request)
    {
        $user_token = $request->header('authorization');

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $userAddressDetail = UsersDeliveryAddress::where('user_id', '=', $user_id)->where('deleted_at', '=', NULL)->get();

        $message = 'Address Add successfully';
        return SuccessResponse($message,200,$userAddressDetail);
    }

    public function updateaddress(Request $request)
    {
        $user_token = $request->header('authorization');

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $validator = validator::make($request->all(), [
            'addressId' => 'required',
            'name' => 'required',
            'phone_number' => 'required',
            'pincode' => 'required',
            'locality' => 'required',
            'address' => 'required',
            'city' => 'required',
            'address_type' => 'required',
        ]);
        if ($validator->fails()) 
        {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }
        $userAddress = UsersDeliveryAddress::find($request->addressId);
        $userAddress->user_id = $user_id;
        $userAddress->name = $request->name;
        $userAddress->phone_number = $request->phone_number;
        $userAddress->pincode = $request->pincode;
        $userAddress->locality = $request->locality;
        $userAddress->address = $request->address;
        $userAddress->city = $request->city;
        $userAddress->landmark = $request->landmark;
        $userAddress->alternate_phone = $request->alternate_phone;
        $userAddress->address_type = $request->address_type;
        $userAddress->save();

        $message = 'Address Update successfully';
        return SuccessResponse($message,200,$userAddress);
    }

    public function selectaddress(Request $request)
    {
        $user_token = $request->header('authorization');

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $validator = validator::make($request->all(), [
            'addressId' => 'required',
            'item_id' => 'required',
        ]);
        if ($validator->fails()) 
        {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }
        $invoiceCreate = new CheckOutUserDetails;
        $invoiceCreate->user_id  = $user_id;
        $invoiceCreate->item_id  = $request->item_id;
        $invoiceCreate->address_id  = $request->addressId;
        $invoiceCreate->status = FALSE;
        $invoiceCreate->save();

        $message = 'Address Update successfully';
        return SuccessResponse($message,200,$invoiceCreate);
    }
}
