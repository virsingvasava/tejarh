<?php

namespace App\Http\Controllers\Frontend\Business;

use App\Http\Controllers\Controller;
use App\Jobs\SendReturnOrderAcceptJob;
use App\Jobs\SendReturnOrderDeclineJob;
use App\Models\AccessToken;
use App\Models\BoostItem;
use App\Models\Brand;
use App\Models\City;
use App\Models\Condition;
use App\Models\Item;
use App\Models\ItemsImages;
use App\Models\OrderDeliveryAddress;
use App\Models\OrderDeliveryCompany;
use App\Models\OrderItem;
use App\Models\OrderReturn;
use App\Models\Orders;
use App\Models\ShippingDeliveryCompany;
use App\Models\Store;
use App\Models\User;
use App\Models\UserDeliveryAddress;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerOrder extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = Orders::where('user_id', $user->id)
            ->where('order_status' , '!=' , ORDER_RETURN )
            ->orderby('id', 'desc')
            ->get()->toArray();

        $itemArray = [];
        foreach ($orders as $orderKey => $orderValue)
        {
            $itemArray[$orderKey] = $orderValue;

            $orderItems = OrderItem::where('order_id',$orderValue['id'])->first();
            $orderItemId = $orderItems->id;
            $itemArray[$orderKey]['orderItems'] = $orderItems; 
            $getAddressId = OrderDeliveryAddress::where('order_item_id', $orderItemId)->first();
            $addressID = $getAddressId->address_id;

            if(!empty($addressID)){
            $userAddress = UserDeliveryAddress::where('id', $addressID)->first();
            $itemArray[$orderKey]['userAddress'] = $userAddress;   
            } 

            $shippingDetails = ShippingDeliveryCompany::where('customer_id', $orderValue['customer_id'])
            ->where('item_id', $orderItems['item_id'])
            ->first();
            $itemArray[$orderKey]['shippingDetails'] = $shippingDetails;
        }
        return view('frontend.business.pages.order_sold.index', compact('itemArray'));
    }

    public function create_shipping(Request $request)
    {

        // $orderDeliveryCompanySave = new OrderDeliveryCompany;
        // $orderDeliveryCompanySave->order_id = $request->order_id;
        // $orderDeliveryCompanySave->item_id = $request->item_id;
        // $orderDeliveryCompanySave->customer_id = $request->customer_user_id;
        // $orderDeliveryCompanySave->delivery_option_id = $request->delivery_option_id;
        // $orderDeliveryCompanySave->save();

        $getAccessToken = AccessToken::latest()->first();
        $fetch_access_token = $getAccessToken->access_token;

        $curl = curl_init();

        $postData = [
            "orderId" => $request->order_id,
            "deliveryOptionId" => $request->delivery_option_id,
        ];

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.tryoto.com/rest/v2/createShipment',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($postData),
        CURLOPT_HTTPHEADER => array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization: Bearer '.$fetch_access_token
        ),
        ));

        $response = curl_exec($curl);

        dd($response);
        curl_close($curl);

        return redirect()->back()->with('success','Shipping Created Successfull');
    }

    public function orderFilter(Request $request)
    {
        $user = Auth::user();
        $orders = Orders::where('user_id', $user->id);
        
        if(isset($request->orderFilter) && !empty($request->orderFilter)){
            $orders->whereIn(DB::raw("year(created_at)"), $request->orderFilter);
        }

        $ordersData = $orders->where('order_status' , '!=' , ORDER_RETURN)
        ->orderby('id', 'desc')
        ->get()->toArray();
        $arrayFilter = [];
        foreach ($ordersData as $orderKey => $orderValue)
        {
            $arrayFilter[$orderKey] = $orderValue;

            $orderItems = OrderItem::where('order_id',$orderValue['id'])->first();
            $orderItemId = $orderItems->id;
            $arrayFilter[$orderKey]['orderItems'] = $orderItems; 
            $getAddressId = OrderDeliveryAddress::where('order_item_id', $orderItemId)->first();
            $addressID = $getAddressId->address_id;

            if(!empty($addressID)){
            $userAddress = UserDeliveryAddress::where('id', $addressID)->first();
            $arrayFilter[$orderKey]['userAddress'] = $userAddress;   
            } 

            $shippingDetails = ShippingDeliveryCompany::where('customer_id', $orderValue['customer_id'])
            ->where('item_id', $orderItems['item_id'])
            ->first();
            $arrayFilter[$orderKey]['shippingDetails'] = $shippingDetails;
        }
        return view('frontend.business.pages.order_sold.order_filter', compact('arrayFilter'));

    }

    public function last_30_DaysOrderFilter(Request $request){

        $user = Auth::user();
        
        $orders = Orders::where('user_id', $user->id);

        if(isset($request->last_30_days_orders[0]) && !empty($request->last_30_days_orders[0])){
            $orders->where('created_at', '>', now()->subDays(30)->endOfDay());
        }

        $ordersData = $orders->where('order_status' , '!=' , ORDER_RETURN)
        ->orderby('id', 'desc')
        ->get()->toArray();
        $arrayFilter = [];
        foreach ($ordersData as $orderKey => $orderValue)
        {
            $arrayFilter[$orderKey] = $orderValue;

            $orderItems = OrderItem::where('order_id',$orderValue['id'])->first();
            $orderItemId = $orderItems->id;
            $arrayFilter[$orderKey]['orderItems'] = $orderItems; 
            $getAddressId = OrderDeliveryAddress::where('order_item_id', $orderItemId)->first();
            $addressID = $getAddressId->address_id;

            if(!empty($addressID)){
            $userAddress = UserDeliveryAddress::where('id', $addressID)->first();
            $arrayFilter[$orderKey]['userAddress'] = $userAddress;   
            } 

            $shippingDetails = ShippingDeliveryCompany::where('customer_id', $orderValue['customer_id'])
            ->where('item_id', $orderItems['item_id'])
            ->first();
            $arrayFilter[$orderKey]['shippingDetails'] = $shippingDetails;
        }

        return view('frontend.business.pages.order_sold.order_filter', compact('arrayFilter'));

    }

    public function return_order()
    {
        $user = Auth::user();
        $orders = OrderReturn::where('user_id', $user->id);
        $ordersData = $orders->orderby('id', 'desc')
        ->get()->toArray();
        $itemArray = [];
        foreach($ordersData as $orderKey => $orderValue)
        {
            $itemArray[$orderKey] = $orderValue;

            $item = Item::where('id',$orderValue['item_id'])->withTrashed()->first();
            $itemArray[$orderKey]['item'] = $item;

            $itemsImage = ItemsImages::where('item_id',$item['id'])->withTrashed()->first();
            $itemArray[$orderKey]['item_pictures'] = $itemsImage;

            $user = User::where('id', $orderValue['customer_id'])->first();
            $itemArray[$orderKey]['user'] = $user;

            $getAddressId = OrderDeliveryAddress::where('order_item_id', $orderValue['order_id'])->first();
            $orderAddress = UserDeliveryAddress::where('id', $getAddressId->address_id)->first();
            $itemArray[$orderKey]['userAddress'] = $orderAddress;
            
        }
        return view('frontend.business.pages.order_sold.return_order', compact('itemArray'));
    }

    public function return_order_accept(Request $request)
    {
        $returnOrderid = $request->id;
        $mainOrderId = $request->main_order_id_accept;

        $orderStatus = Orders::where('id', $mainOrderId)->first();
        $orderStatus->notes = 'Order return approve';
        $orderStatus->save();

        $orderReturnStatus = OrderReturn::where('id', $returnOrderid)->first();
        $orderReturnStatus->status = 'approve';
        $orderReturnStatus->save();

        $getUserDetails = OrderReturn::where('id', $returnOrderid)->first();
        $customerId = $getUserDetails->customer_id;

        $user = User::where('id',$customerId)->first();
        $getEmail = $user->email;

        if ($orderReturnStatus->status == 'approve') {
            $details['email'] = $getEmail;
            dispatch(new SendReturnOrderAcceptJob($details));
            // dd($details);
        } else {
            // dd('hello_2');
        }

        return redirect()->back();
    }

    public function return_order_decline(Request $request)
    {
        $returnOrderid = $request->id;
        $mainOrderId = $request->main_order_id;

        $orderStatus = Orders::where('id', $mainOrderId)->first();
        $orderStatus->notes = 'Order return decline';
        $orderStatus->save();

        $orderReturnStatus = OrderReturn::where('id', $returnOrderid)->first();
        $orderReturnStatus->status = 'decline';
        $orderReturnStatus->save();

        $getUserDetails = OrderReturn::where('id', $returnOrderid)->first();
        $customerId = $getUserDetails->customer_id;

        $user = User::where('id',$customerId)->first();
        $getEmail = $user->email;

        if ($orderReturnStatus->status == 'decline') {
            $details['email'] = $getEmail;
            dispatch(new SendReturnOrderDeclineJob($details));
            // dd($details);
        } else {
            // dd('hello_2');
        }

        return redirect()->back();
    }
}
