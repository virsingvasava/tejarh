<?php

namespace App\Http\Controllers\Frontend\Users;

use App\Http\Controllers\Controller;
use App\Models\AccessToken;
use Illuminate\Http\Request;

use App\Models\Item;
use App\Models\Orders;
use App\Models\ItemsImages;
use App\Models\Category;
use App\Models\OrderDeliveryAddress;
use App\Models\OrderItem;
use App\Models\Store;
use App\Models\User;
use App\Models\ReviewRatings;
use App\Models\TicketDetail;
use App\Models\TicketMaster;
use App\Models\UserDeliveryAddress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Lang;
use Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Lang as FacadesLang;

class MyOrdersController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $orders = Orders::where('customer_id', $user->id)
            ->orderby('id', 'desc')
            ->get()->toArray();

        $itemArray = [];
        foreach ($orders as $orderKey => $orderValue)
        {
            $itemArray[$orderKey] = $orderValue;

            if($orderValue['return_order_id'] == NULL)
            {
                $orderItems = OrderItem::where('order_id',$orderValue['id'])->first();
                $orderItemId = $orderItems->id;
                $itemArray[$orderKey]['orderItems'] = $orderItems; 
                
                $getAddressId = OrderDeliveryAddress::where('order_item_id', $orderItemId)->first();
                $addressID = $getAddressId->address_id;
    
                if(!empty($addressID)){
                $userAddress = UserDeliveryAddress::where('id', $addressID)->first();
                $itemArray[$orderKey]['userAddress'] = $userAddress;   
                } 
            } 
            elseif($orderValue['return_order_id'] != NULL)
            {
                $getAddressReturnId = OrderDeliveryAddress::where('order_item_id', $orderValue['return_order_id'])->first();
                $addressIDReturn = $getAddressReturnId->address_id;
    
                if(!empty($addressIDReturn)){
                $userAddressReturn = UserDeliveryAddress::where('id', $addressIDReturn)->first();
                $itemArray[$orderKey]['userAddressReturn'] = $userAddressReturn;   
                } 
            } 
        }

        $orders_list = DB::table('orders')
            ->where('customer_id', $user->id)
            ->orderby('id', 'desc')
            ->select('order_status', 'created_at')
            ->get();

        $reviewRating = ReviewRatings::orderby('id', 'desc')->get()->toArray();

        $reviewRatingArray = [];
        foreach ($reviewRating as $key => $value) {

            $reviewRatingArray[$key] = $value;
            $user = User::where('id', $value['user_id'])->first();
            $reviewRatingArray[$key]['user'] = $user;
        }
        $randomNumber = random_int(100000, 999999);
        return view('frontend.users.my_orders.index', compact('itemArray', 'orders_list', 'reviewRatingArray','randomNumber'));
    }

    public function filter_ajax(Request $request)
    {
        if ($request->ajax() && isset($request->order_status)) {
            $user = Auth::user();
            $order_status = $request->order_status;
            $orders = DB::table('orders')->whereIN('order_status', explode(',', $order_status))->where('customer_id', $user->id)->orderby('id', 'desc')->paginate(6);
            $randomNumber = random_int(100000, 999999);
            return view('frontend.users.my_orders.filter_order', compact('orders','randomNumber'));
        } else {
            $user = Auth::user();
            $orders = DB::table('orders')->where('customer_id', $user->id)->orderby('id', 'desc')->paginate(6);
            $randomNumber = random_int(100000, 999999);
            return view('frontend.users.my_orders.filter_order', compact('orders','randomNumber'));
        }
    }

    public function orderFilter(Request $request){

        $user = Auth::user();

        $orders = Orders::where('customer_id', $user->id)
            ->orderby('id', 'desc');
        
        if(isset($request->orderFilter) && !empty($request->orderFilter)){
            $orders->whereIn(DB::raw("year(created_at)"), $request->orderFilter);
        }

        $ordersData = $orders->get()->toArray();
        $arrayFilter = [];
        foreach ($ordersData as $orderKey => $orderValue)
        {
            $arrayFilter[$orderKey] = $orderValue;

            if($orderValue['return_order_id'] == NULL)
            {
                $orderItems = OrderItem::where('order_id',$orderValue['id'])->first();
                $orderItemId = $orderItems->id;
                $arrayFilter[$orderKey]['orderItems'] = $orderItems;  

                $getAddressId = OrderDeliveryAddress::where('order_item_id', $orderItemId)->first();
                $addressID = $getAddressId->address_id;

                if(!empty($addressID)){
                $userAddress = UserDeliveryAddress::where('id', $addressID)->first();
                $arrayFilter[$orderKey]['userAddress'] = $userAddress;   
                } 
            }
            elseif($orderValue['return_order_id'] != NULL)
            {
                $getAddressReturnId = OrderDeliveryAddress::where('order_item_id', $orderValue['return_order_id'])->first();
                $addressIDReturn = $getAddressReturnId->address_id;
    
                if(!empty($addressIDReturn)){
                $userAddressReturn = UserDeliveryAddress::where('id', $addressIDReturn)->first();
                $arrayFilter[$orderKey]['userAddressReturn'] = $userAddressReturn;   
                } 
            }
        }
        $randomNumber = random_int(100000, 999999);
        return view('frontend.users.my_orders.order_filter_date', compact('arrayFilter','randomNumber'));

    }

    public function last_30_DaysOrderFilter(Request $request){

        $user = Auth::user();
        
        $orders = Orders::where('customer_id', $user->id)->orderby('id', 'desc');

        if(isset($request->last_30_days_orders[0]) && !empty($request->last_30_days_orders[0])){
            $orders->where('created_at', '>', now()->subDays(30)->endOfDay());
        }

        $ordersData = $orders->get()->toArray();
        $arrayFilter = [];
        foreach ($ordersData as $orderKey => $orderValue)
        {
            $arrayFilter[$orderKey] = $orderValue;

            if($orderValue['return_order_id'] == NULL)
            {
                $orderItems = OrderItem::where('order_id',$orderValue['id'])->first();
                $orderItemId = $orderItems->id;
                $arrayFilter[$orderKey]['orderItems'] = $orderItems;  

                $getAddressId = OrderDeliveryAddress::where('order_item_id', $orderItemId)->first();
                $addressID = $getAddressId->address_id;

                if(!empty($addressID)){
                $userAddress = UserDeliveryAddress::where('id', $addressID)->first();
                $arrayFilter[$orderKey]['userAddress'] = $userAddress;   
                } 
            }
            elseif($orderValue['return_order_id'] != NULL)
            {
                $getAddressReturnId = OrderDeliveryAddress::where('order_item_id', $orderValue['return_order_id'])->first();
                $addressIDReturn = $getAddressReturnId->address_id;
    
                if(!empty($addressIDReturn)){
                $userAddressReturn = UserDeliveryAddress::where('id', $addressIDReturn)->first();
                $arrayFilter[$orderKey]['userAddressReturn'] = $userAddressReturn;   
                } 
            }
        }
        $randomNumber = random_int(100000, 999999);
        return view('frontend.users.my_orders.order_filter_date', compact('arrayFilter','randomNumber'));

    }

    # Reviews Module Mothods#
    public function users_review_post_user_details(Request $request){
        $user = User::where('id', $request->userId)->first();
        return response()->json(['userData' => $user]);
    }
    public function users_review_post_store(Request $request){

        $new_user = new ReviewRatings;
        $image = $request->user_review_items_Image;
        if ($request->has('user_review_items_Image')) {
            $imagename = $request->user_review_items_Image;
            $destination = public_path('assets/review_items_Image');
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $name = 'images' . time();
            $imageName = $name . '.' . $image->getClientOriginalExtension();
            $image->move($destination, $imageName);
        } else {
            $imageName = null;
        }

        $new_user->user_id = $request->reviewer_userId;
        $new_user->item_id = $request->item_Ids;
        $new_user->rating_star = $request->rating_data;
        $new_user->review_description = $request->user_review_description;
        $new_user->review_picture = $imageName;
        $new_user->save();
        
        return response()->json(['code' => 200, 'success' => Lang::get('Review Post Successfully')], 200);
    
    }
    public function users_retrive_reviews(Request $request){

        $avg = ReviewRatings::Where('item_id', $request->itemId);
        $totalReviewAvg = $avg->avg('rating_star');
        $totalReviewAvg =  number_format($totalReviewAvg, 2);
    
        $totalReviewCount = ReviewRatings::where('item_id', $request->itemId)->count();
        $reviewRating = ReviewRatings::where('item_id', $request->itemId)->orderby('id', 'desc')->get()->toArray();

        $reviewRatingArray = [];
        foreach ($reviewRating as $key => $value) {

            $reviewRatingArray[$key] = $value;
            $user = User::where('id', $value['user_id'])->first();
            $reviewRatingArray[$key]['user'] = $user;

        }
        return view('frontend.users.my_orders.review_list', compact('reviewRatingArray', 'totalReviewAvg', 'totalReviewCount'));
    }
    # Reviews Module End#

    public function track_orders($id)
    {
        $getOrder = Orders::where('id',$id)->first();
        if($getOrder['return_order_id'] == NULL)
        {
            $getOrderItem = OrderItem::where('order_id',$id)->first();
            $orderId = OrderDeliveryAddress::where('order_item_id',$getOrderItem->id)->first();
            $getAddressId = $orderId->address_id;
            $getAddress = UserDeliveryAddress::where('id',$getAddressId)->first();
        }
        else{
            $orderId = OrderDeliveryAddress::where('order_item_id',$getOrder->return_order_id)->first();
            $getAddressId = $orderId->address_id;
            $getAddress = UserDeliveryAddress::where('id',$getAddressId)->first();
        }
        return view('frontend.users.my_orders.order_track',compact('getAddress'));
    }

    public function order_cancel(Request $request)
    {
        $id = $request->order_id;
        $orderStatus = Orders::where('id', $id)->first();
        $orderStatus->order_status = ORDER_CANCELED;
        $orderStatus->save();

        $orderItem = OrderItem::where('order_id', $id)->get();
        foreach($orderItem as $order)
        {
            $orderItem = OrderItem::where('order_id', $order['order_id'])->update(['status' => ORDER_CANCELED]);
        }
        
        $getAccessToken = AccessToken::latest()->first();
        $fetch_access_token = $getAccessToken->access_token;

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.tryoto.com/rest/v2/cancelOrder',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "orderId": "'.$id.'"
        }',
        CURLOPT_HTTPHEADER => array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization: Bearer '.$fetch_access_token
        ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return redirect()->back()->with('success', Lang::get('Order Cancel Successfully'));
    }

    public function store(Request $request)
    {
        $authId = Auth::user();
        $addTicket = new TicketMaster;
        $request->validate([
            'image' => 'mimes:jpeg,png,jpg,pdf|max:1024',
        ]);
        $image = $request->image;
        if ($request->has('image')) {
            $imagename = $request->image;
            $destination = public_path('assets/ticket');
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $name = 'images' . time();
            $imageName = $name . '.' . $image->getClientOriginalExtension();
            $image->move($destination, $imageName);
        } else {
            $imageName = null;
        }

        $addTicket->user_id = $request->user_id;
        $addTicket->ticket_user_id = $authId->id;
        $addTicket->subject = $request->subject;
        $addTicket->category = $request->support_cat_id;
        $addTicket->sku_id = $request->sku_id;
        $addTicket->save();

        $addTicketDetails = new TicketDetail;
        $addTicketDetails->ticket_master_id = $addTicket->id;
        $addTicketDetails->user_id = $authId->id;
        $addTicketDetails->message = $request->message;
        $addTicketDetails->image = $imageName;
        $addTicketDetails->save();

        return response()->json(['code' => 200, 'success' => FacadesLang::get('Ticket Added')], 200);
    }

    
}

