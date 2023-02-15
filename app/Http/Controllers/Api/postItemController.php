<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\attribute;
use App\Models\AttributeVariant;
use App\Models\BoostItem;
use App\Models\Brand;
use App\Models\cardDetails;
use App\Models\Cart;
use App\Models\Category;
use App\Models\CheckOutPayment;
use App\Models\City;
use App\Models\Commission;
use App\Models\Condition;
use App\Models\DeliveryType;
use App\Models\HoldAnOffer;
use App\Models\Inventory;
use App\Models\Item;
use App\Models\ItemsImages;
use App\Models\MakeAnOffer;
use App\Models\ShipMode;
use App\Models\stock;
use App\Models\Store;
use App\Models\SubCategory;
use App\Models\User;
use App\Models\UserDeliveryAddress;
use App\Models\UserLike;
use App\Models\Wishlist;
use Checkout\CheckoutSdk;
use Checkout\Common\Address;
use Checkout\Common\Phone;
use Checkout\Environment;
use Checkout\Payments\Previous\Source\RequestCardSource;
use Illuminate\Http\Request;
use Checkout\Common\Currency;
use Checkout\Common\Country;
use Checkout\Common\CustomerRequest;
use Checkout\Payments\Request\PaymentRequest;
use Checkout\Payments\Sender\Identification;
use Checkout\Payments\Sender\IdentificationType;
use Checkout\Payments\Sender\PaymentIndividualSender;
use Checkout\CheckoutApiException;
use Checkout\CheckoutAuthorizationException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;
use File;

class postItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth')->except(['getbrand','getattribute','getattributevariants','getcondition','getdeliverytype']);
    }
    public function getbrand(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'sub_category_id' => 'required',
        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message, 101);
        }
        $categoryItemList = $request->category_id;
        $subcategoryId = $request->sub_category_id;
        $brand_list = Brand::where([['category_id',$categoryItemList],['sub_category_id',$subcategoryId]])
        ->where('status', '=', '1')
        ->orderBy('created_at', 'DESC')->get()->toArray();       
    
        if(empty($brand_list)){
            $message = "Barand not found";
            return InvalidResponse($message,101);
        }
        $message = 'Fetch Barand listing successfully.';
        return SuccessResponse($message,200,$brand_list);
    }

    public function getattribute(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message, 101);
        }
        $categoryItemList = $request->category_id;
        $attribute_list = attribute::where([['category_id',$categoryItemList]])
        ->where('status', '=', '1')
        ->orderBy('created_at', 'DESC')->get()->toArray();      
    
        if(empty($attribute_list)){
            $message = "Attribute not found";
            return InvalidResponse($message,101);
        }
        $message = 'Fetch Attribute listing successfully.';
        return SuccessResponse($message,200,$attribute_list);   
    }

    public function getattributevariants(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'attribute_id' => 'required',
        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message, 101);
        }
        $attributeList = $request->attribute_id;
        $attributevariant_list = AttributeVariant::where([['attribute_id',$attributeList]])
        ->orderBy('created_at', 'DESC')->get()->toArray();      
    
        if(empty($attributevariant_list)){
            $message = "Attribute Variants not found";
            return InvalidResponse($message,101);
        }
        $message = 'Fetch Attribute Variants listing successfully.';
        return SuccessResponse($message,200,$attributevariant_list);  
    }

    public function getcondition(Request $request)
    {
        $condition_list = Condition::where('status',1)
        ->orderBy('created_at', 'DESC')->get()->toArray();        
    
        if(empty($condition_list)){
            $message = " Condition not found";
            return InvalidResponse($message,101);
        }
        $message = 'Fetch Condition listing successfully.';
        return SuccessResponse($message,200,$condition_list); 
    }

    public function getdeliverytype(Request $request)
    {
        $deliverytype_list = DeliveryType::where('status',1)
        ->orderBy('created_at', 'DESC')->get()->toArray();        
    
        if(empty($deliverytype_list)){
            $message = " Condition not found";
            return InvalidResponse($message,101);
        }
        $message = 'Fetch Condition listing successfully.';
        return SuccessResponse($message,200,$deliverytype_list); 
    }

    public function postAnItem(Request $request)
    {
        $user_token = $request->header('authorization');

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $validator = validator::make($request->all(), [
            'item_picture1' => 'required',
            'sku' => 'required',
            'what_are_you_selling' => 'required',
            'describe_your_items' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'brand_id' => 'required',
            'condition_id' => 'required',
            'weight' => 'required',
            'quantity' => 'required',
            'address' => 'required',
            'delivery_type' => 'required',
            'pay_shipping' => 'required',
            'price' => 'required',
            'price_type'=> 'required',
        ]);
        
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }

        // $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        // $user_id = $jwt_user->id;

        $commission_data = Commission::where('type','commission_user')->first();
        if(!empty($commission_data)){
            $commission_user = $commission_data->name;            
        }
    
        $items_add = new Item;
        $items_add->user_id  = $user_id;
        $items_add->what_are_you_selling  = $request->what_are_you_selling;
        $items_add->describe_your_items  = $request->describe_your_items;
        $items_add->category_id  = $request->category_id;
        $items_add->sub_category_id  = $request->sub_category_id;
        $items_add->brand_id  = $request->brand_id;
        $items_add->condition_id  = $request->condition_id;
        $items_add->weight  = $request->weight;
        $items_add->width  = $request->width;
        $items_add->length  = $request->length;
        $items_add->height  = $request->height;
        $items_add->quantity  = $request->quantity;
        $items_add->address  = $request->address;
        $items_add->latitude  = $request->latitude;
        $items_add->longitude  = $request->longitude;
        // $items_add->ship_mode_id  = $request->ship_mode_id;
        $items_add->delivery_type  = $request->delivery_type;
        $items_add->pay_shipping  = $request->pay_shipping;
        $items_add->price_type  = $request->price_type;
        $items_add->total_amount  = $request->price;
        $items_add->commission_charge  = $commission_user;
        $items_add->sku  = 'Sku-'.$request->sku;
        $items_add->status = '1';
        $items_add->attributes = $request->attribute_id;
        $items_add->choice_options = $request->attribute_variants_id;
        $price = $request->price; 
        $commision_data = $commission_user; 
        $comissionPrice = (($price/100) * $commision_data);
        $totalPrice = $price - $comissionPrice;
        $items_add->price = $totalPrice;
        $items_add->save();

        $item_image = new ItemsImages;
        $item_image->user_id  =  $user_id;
        $item_image->item_id  = $items_add->id;
        if ($request->hasFile('item_picture1')) {
            $picture1 = $request->file('item_picture1');
            $name = 'item_picture1_' . time() . '.' . $picture1->getClientOriginalExtension();
            $destinationPath = public_path(USERS_ITEMS_POST_FOLDER);
            $picture1->move($destinationPath, $name);
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $item_image->item_picture1 = $name;
        }

        if ($request->hasFile('item_picture2')) {
            $picture2 = $request->file('item_picture2');
            $name = 'item_picture2_' . time() . '.' . $picture2->getClientOriginalExtension();
            $destinationPath = public_path(USERS_ITEMS_POST_FOLDER);
            $picture2->move($destinationPath, $name);
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $item_image->item_picture2 = $name;
        }

        if ($request->hasFile('item_picture3')) {
            $picture3 = $request->file('item_picture3');
            $name = 'item_picture3_' . time() . '.' . $picture3->getClientOriginalExtension();
            $destinationPath = public_path(USERS_ITEMS_POST_FOLDER);
            $picture3->move($destinationPath, $name);
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $item_image->item_picture3 = $name;
        }

        if ($request->hasFile('item_picture4')) {
            $picture4 = $request->file('item_picture4');
            $name = 'item_picture4_' . time() . '.' . $picture4->getClientOriginalExtension();
            $destinationPath = public_path(USERS_ITEMS_POST_FOLDER);
            $picture4->move($destinationPath, $name);
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $item_image->item_picture4 = $name;
        }

        if ($request->hasFile('item_picture5')) {
            $picture5 = $request->file('item_picture5');
            $name = 'item_picture5_' . time() . '.' . $picture5->getClientOriginalExtension();
            $destinationPath = public_path(USERS_ITEMS_POST_FOLDER);
            $picture5->move($destinationPath, $name);
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $item_image->item_picture5 = $name;
        }

        if ($request->hasFile('item_picture6')) {
            $picture6 = $request->file('item_picture6');
            $name = 'item_picture6_' . time() . '.' . $picture6->getClientOriginalExtension();
            $destinationPath = public_path(USERS_ITEMS_POST_FOLDER);
            $picture6->move($destinationPath, $name);
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $item_image->item_picture6 = $name;
        }
        $item_image->status  = true;
        //dd($item_image);
        $item_image->save();

        $storeInventory = new Inventory;
        $storeInventory->user_id            = $user_id;
        $storeInventory->store_id           = $items_add->store_id;
        $storeInventory->item_id            = $items_add->id;
        $storeInventory->total_stock        = $items_add->quantity;
        $storeInventory->stock_remaining    = $items_add->quantity;
        $storeInventory->save();

        $storeStock = new stock;
        $storeStock->user_id            = $user_id;
        $storeStock->item_id            = $items_add->id;
        $storeStock->quantity           = $items_add->quantity;
        $storeStock->item_upload_status = 'single';
        $storeStock->stock_status       = TRUE;
        $storeStock->save();

        $message = 'Post an item successfully.';
        $items_details = Item::with('itemImage')->where('id',$items_add->id)->get();
        
        return SuccessResponse($message,200,$items_details);
    }

    public function getpostitem(Request $request)
    {
        $user_token = $request->header('authorization');

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $validator = Validator::make($request->all(), [
            'item_id',
        ]);
        $itemId = $request->item_id;
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message, 101);
        }
        // $view_post = Item::where('id', $itemId)->where('user_id',$user_id)->where('status','=','1')->first();
        // $post_image = $view_post->id;
        // $view_post_image = ItemsImages::where('item_id', $post_image)->first();
        // $category = Category::where('deleted_at', '=', NULL)->orderBy('category_name', 'ASC')->get();
        // $sub_category = SubCategory::where('deleted_at', '=', NULL)->orderBy('sub_cate_name', 'ASC')->get();
        // $brands = Brand::where('deleted_at', '=', NULL)->orderBy('name', 'ASC')->get();
        // $attribute_id = $view_post->attributes;
        // $attributes_id = attribute::where('id',$attribute_id)->first();
        // $condition = Condition::where('deleted_at', '=', NULL)->orderBy('name', 'ASC')->get();
        // $ship_mode = ShipMode::where('deleted_at', '=', NULL)->orderBy('name', 'ASC')->get();
        // $stores = Store::where('deleted_at', '=', NULL)->get();
        // $city = City::orderBy('name', 'ASC')->get();
        // $delivery_type = DeliveryType::get();
    }

    public function updatepostitem(Request $request)
    {
        $user_token = $request->header('authorization');

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $validator = Validator::make($request->all(), [
            'item_id',
        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message, 101);
        }
        $itemId = $request->item_id;
        $view_post = Item::where('id',$itemId)->where('user_id',$user_id)->where('status','=','1')->first();
        $post_image = $view_post->id;

        $view_post->sku= $request->sku;
        $view_post->what_are_you_selling= $request->what_are_you_selling;
        $view_post->describe_your_items = $request->describe_your_items;
        $view_post->category_id         = $request->category_id;
        $view_post->sub_category_id     = $request->subcat_id;
        $view_post->brand_id            = $request->brand_id;
        $view_post->condition_id        = $request->condition_id;
        // $view_post->ship_mode_id        = $request->ship_mode_id;
        $view_post->width               = $request->width;
        $view_post->length              = $request->length;
        $view_post->height              = $request->height;
        $view_post->weight              = $request->weight;
        $view_post->quantity = $request->quantity;
        $view_post->address             = $request->address;
        $view_post->latitude            = $request->lat;
        $view_post->longitude           = $request->lng;
        $view_post->pay_shipping        = $request->pay_shipping;
        $view_post->price_type          = $request->price_type;
        $view_post->delivery_type       = $request->delivery_type;
        $view_post->price               = $request->price;
        $view_post->save();

        $view_post_image = ItemsImages::where('item_id', $post_image)->first();
        if ($request->hasFile('item_picture1')) 
        {
            $item_picture1 = $request->file('item_picture1');
            $name = time().'.'.$item_picture1->getClientOriginalExtension();
            $destinationPath = public_path('/assets/post');
            $item_picture1->move($destinationPath, $name);
            $view_post_image->item_picture1 = $name;
        }
        if ($request->hasFile('item_picture2')) 
        {
            $item_picture2 = $request->file('item_picture2');
            $name = time().'.'.$item_picture2->getClientOriginalExtension();
            $destinationPath = public_path('/assets/post');
            $item_picture2->move($destinationPath, $name);
            $view_post_image->item_picture2 = $name;
        }
        if ($request->hasFile('item_picture3')) 
        {
            $item_picture3 = $request->file('item_picture3');
            $name = time().'.'.$item_picture3->getClientOriginalExtension();
            $destinationPath = public_path('/assets/post');
            $item_picture3->move($destinationPath, $name);
            $view_post_image->item_picture3 = $name;
        }
        if ($request->hasFile('item_picture4')) 
        {
            $item_picture4 = $request->file('item_picture4');
            $name = time().'.'.$item_picture4->getClientOriginalExtension();
            $destinationPath = public_path('/assets/post');
            $item_picture4->move($destinationPath, $name);
            $view_post_image->item_picture4 = $name;
        }
        if ($request->hasFile('item_picture5')) 
        {
            $item_picture5 = $request->file('item_picture5');
            $name = time().'.'.$item_picture5->getClientOriginalExtension();
            $destinationPath = public_path('/assets/post');
            $item_picture5->move($destinationPath, $name);
            $view_post_image->item_picture5 = $name;
        }
        if ($request->hasFile('item_picture6')) 
        {
            $item_picture6 = $request->file('item_picture6');
            $name = time().'.'.$item_picture6->getClientOriginalExtension();
            $destinationPath = public_path('/assets/post');
            $item_picture6->move($destinationPath, $name);
            $view_post_image->item_picture6 = $name;
        }
        $view_post_image->save();

        $message = 'Post an item Update successfully.';
        $items_details = Item::with('itemImage')->where('id',$view_post->id)->get();
        
        return SuccessResponse($message,200,$items_details);
    }

    public function boostitem(Request $request)
    {    
        $user_token = $request->header('authorization');

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $validator = Validator::make($request->all(), [
            'item_id',
        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message, 101);
        }
        $itemId = $request->item_id;
        $price = $request ->price;
        $total_amount = $price;
        $boosted_price = round(10/100 * $total_amount);
        $itemBoostPrice = (int) $boosted_price;
        $get_details = Item::where('id', $itemId)->where('status', '=', '1')->get();
        foreach ($get_details as $key => $value) {
            $order = new BoostItem;
            $order->user_id = $user_id;
            $order->item_id = $value->id;
            $order->boost_amount = $itemBoostPrice;
            $order->save();
        }

        $save_token = new cardDetails;
        $save_token->user_id  = $user_id;
        $save_token->holder_name  = $request->holder_name;
        $save_token->card_number  = $request->card_number;
        $save_token->expiry_month  = $request->expiry_month;
        $save_token->expiry_year  = $request->expiry_year;
        $save_token->cvv  = $request->cvv;
        $save_token->save();

        $api = CheckoutSdk::builder()->staticKeys()
            ->environment(Environment::sandbox())
            ->secretKey("sk_sbox_kxgkyhqokicx6oll6dzvf7zdxqk")
            ->build();

        $api = CheckoutSdk::builder()->oAuth()
            ->clientCredentials("ack_4vesek7j37ne5l73rfg5pxolzy", "cCJYVaOdkJLU72BRCOagBxQivblDEIW0LxsZyeQ3sPsW_w_buLocD9e0A20dkkpF_B7OjY3LzM3FR51cuDJnOg")
            ->scopes(['gateway'])
            ->environment(Environment::sandbox())
            ->build();

        $user_address = UserDeliveryAddress::where('user_id', $user_id)->first();
        $user = User::where('id', $user_id)->first(); 
        $phone = new Phone();
        $phone->country_code = $user->phone_code;
        $phone->number = $user->phone_number;

        $address = new Address();
        $address->address_line1 = 'Address Line 1';
        $address->address_line2 = 'Address Line 2';
        $address->city = 'Ahemdabad';
        // $address->state = "London";
        $address->zip = '123456';
        $address->country = Country::$GB;

        $requestCardSource = new RequestCardSource();
        $requestCardSource->name = $request->holder_name;
        $requestCardSource->number = $request->card_number;
        $requestCardSource->expiry_month = $request->expiry_month;
        $requestCardSource->expiry_year = $request->expiry_year;
        $requestCardSource->cvv = $request->cvv;
        $requestCardSource->billing_address = $address;
        $requestCardSource->phone = $phone;

        $customerRequest = new CustomerRequest();
        $customerRequest->email = $user->email;
        $customerRequest->name =  $user->name;

        $identification = new Identification();
        $identification->issuing_country = Country::$GT;
        $identification->number = "1234";
        $identification->type = IdentificationType::$drivingLicence;

        $paymentIndividualSender = new PaymentIndividualSender();
        $paymentIndividualSender->fist_name = "FirstName";
        $paymentIndividualSender->last_name = "LastName";
        $paymentIndividualSender->address = $address;
        $paymentIndividualSender->identification = $identification;

        $request = new PaymentRequest();
        $request->source = $requestCardSource;
        $request->capture = true;
        $request->reference = "Test-Data-Boost-User";
        $request->amount = $itemBoostPrice   ;
        $request->currency = Currency::$USD;
        $request->customer = $customerRequest;
        $request->sender = $paymentIndividualSender;

        try {
            $response = $api->getPaymentsClient()->requestPayment($request);
            // p($response['id']);
            // $data['id'] = $response['id'];

            $save_checkout_details = new CheckOutPayment;
            $save_checkout_details->user_id  = $user_id;
            $save_checkout_details->item_id  = $itemId;
            $save_checkout_details->payment_id  = $response['id'];
            $save_checkout_details->action_id  = $response['action_id'];
            $save_checkout_details->amount  = $response['amount'];
            $save_checkout_details->status  = $response['approved'];
            $save_checkout_details->currency  = $response['currency'];
            $save_checkout_details->type  = 'item';
            $save_checkout_details->save();

            $user_boost = BoostItem::where('user_id', $user->id)->Latest('id')->first();
            $user_boost->is_paid  = 1;
            $user_boost->save();

            // return $response;
            $message = 'BoostItem Payment Successfully.';   
            return SuccessResponse($message,200,'');
            // return redirect()->back()->with('success', __('Payment SuccessFull'));
        } catch (CheckoutApiException $e) {
            // API error
            $error_details = $e->error_details;
            dd($error_details);
            $message = ' BoostItem  Payment UnsuccessFull.';   
            return SuccessResponse($message,200,'');
            // return redirect()->back()->with('danger', __('Payment UnsuccessFull'));

            // dd($error_details);

            $http_status_code = isset($e->http_metadata) ? $e->http_metadata->getStatusCode() : null;
        } catch (CheckoutAuthorizationException $e) {
            // Bad Invalid authorization
        }

        

    }
    
    public function boostitemperice(Request $request)
    {

        // $itemId = $request->item_id;
        $price = $request ->price;
        // $get_details = Item::where('id', $itemId)->where('status', '=', '1')->get();
        // dd($get_details);
        $total_amount = $price;
        $boosted_price = round(10/100 * $total_amount);
        $itemBoostPrice = (int) $boosted_price;
        $message = 'BoostItem price.';
        return SuccessResponse($message,200,$itemBoostPrice);

    }

    public function deletepostitem(Request $request)
    {
        $user_token = $request->header('authorization');

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $validator = Validator::make($request->all(), [
            'item_id',
        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message, 101);
        }
        $itemId = $request->item_id;

        BoostItem::where('item_id', $itemId)->delete();
        Cart::where('item_id',$itemId)->delete();
        HoldAnOffer::where('item_id',$itemId)->delete();
        MakeAnOffer::where('item_id',$itemId)->delete();
        Wishlist::where('item_id',$itemId)->delete();
        UserLike::where('item_id',$itemId)->delete();
        ItemsImages::where('item_id', $itemId)->delete();
        Inventory::where('item_id', $itemId)->delete();
        stock::where('item_id', $itemId)->delete();
        Item::where('id', $itemId)->where('status', '=', '1')->delete();

        $message = 'Item Delete Successfully.';   
        return SuccessResponse($message,200,'');
        
    }
}
