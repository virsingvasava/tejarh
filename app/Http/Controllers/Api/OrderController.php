<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemsImages;
use App\Models\OrderDeliveryAddress;
use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\ReviewRatings;
use App\Models\User;
use App\Models\UserDeliveryAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function myorder(Request $request)
    {
        $user_token = $request->header('authorization');

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $validator = validator::make($request->all(), [
            'user_id' => 'required',
        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message, 101);
        }
        $orders = Orders::where('customer_id', $user_id)
            ->orderby('id', 'desc')
            ->get()->toArray();
            $itemArray = [];
        foreach ($orders as $key => $value) {

            $itemArray[$key] = $value;

            $orderItems = OrderItem::where('order_id', $value['id'])->first();
            $orderItemId = $orderItems->id;

            $getAddressId = OrderDeliveryAddress::where('order_item_id', $orderItemId)->first();
            $addressID = $getAddressId->address_id;

            if (!empty($addressID)) {
                $userAddress = UserDeliveryAddress::where('id', $addressID)->first();
                $itemArray[$key]['userAddress'] = $userAddress;
            }
            $itemArray[$key]['estimated delivery'] = $value['created_at'];
        }
        $message = 'My Order Listing.';
        return SuccessResponse($message, 200, $itemArray);
    }

    public function myorderdetail(Request $request)
    {
        $user_token = $request->header('authorization');

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $validator = validator::make($request->all(), [
            'order_id' => 'required',
        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message, 101);
        }
        $orderDetails = Orders::where('id', $request->order_id)->first();

        if ($orderDetails['return_order_id'] == NULL) {
            $getAllOrders = OrderItem::where('order_id', $orderDetails['id'])->get()->toArray();
            $itemArray = [];
            foreach ($getAllOrders as $orderkey => $orderValue) {
                $itemArray[$orderkey] = $orderValue;

                $user = User::where('id', $orderDetails['user_id'])->select(['id', 'first_name', 'last_name', 'profile_picture'])->first();
                $itemArray[$orderkey]['Userseller'] = $user;

                $orderGetUser = OrderItem::where('order_id', $orderDetails['id'])->first();
                $itemArray[$orderkey]['orderGetUser'] = $orderGetUser;
                $orderAmount = OrderItem::where('order_id', $orderDetails['id'])->sum('total_amount');
                $itemArray[$orderkey]['orderAmount'] = $orderAmount;
                $orderShippingPrice = OrderItem::where('order_id', $orderDetails['id'])->sum('shipping_price');
                $itemArray[$orderkey]['orderShippingPrice'] = $orderShippingPrice;


                $itemDetails = Item::where('id', $orderValue['item_id'])->withTrashed()->first();
                $itemArray[$orderkey]['itemDetails'] = $itemDetails;

                $itemImage = ItemsImages::where('item_id', $itemDetails->id)->withTrashed()->first();
                $itemArray[$orderkey]['itemImage'] = $itemImage;

                $orderItems = OrderItem::where('id', $orderValue['id'])->first();
                $itemArray[$orderkey]['orderItems'] = $orderItems;

                $getAddressId = OrderDeliveryAddress::where('order_item_id', $orderGetUser['id'])->first();
                $itemArray[$orderkey]['getAddress'] = $getAddressId;
                $orderAddress = UserDeliveryAddress::where('id', $getAddressId->address_id)->first();
                $itemArray[$orderkey]['orderAddress'] = $orderAddress;
            }
        }
        $message = 'My Order Listing.';
        return SuccessResponse($message, 200, $itemArray);
    }
}
