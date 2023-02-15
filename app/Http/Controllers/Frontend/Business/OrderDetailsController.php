<?php

namespace App\Http\Controllers\Frontend\Business;

use App\Http\Controllers\Controller;
use App\Models\AccessToken;
use App\Models\CheckOutUserDetails;
use App\Models\Item;
use Illuminate\Http\Request;

use App\Models\cardDetails;
use App\Models\CardToken;
use App\Models\Cart;
use App\Models\CheckoutDetails;
use App\Models\CheckOutPayment;
use App\Models\Orders;
use App\Models\User;
use App\Models\UserDeliveryAddress;
use Checkout\CheckoutApiException;
use Checkout\CheckoutAuthorizationException;
use Checkout\CheckoutSdk;
use Checkout\Common\Address;
use Checkout\Common\Country;
use Checkout\Common\Currency;
use Checkout\Common\CustomerRequest;
use Checkout\Common\Phone;
use Checkout\Environment;
use Checkout\OAuthScope;
use Checkout\Payments\Request\PaymentRequest;
use Checkout\Payments\Request\Source\RequestCardSource;
use Checkout\Payments\Sender\Identification;
use Checkout\Payments\Sender\IdentificationType;
use Checkout\Payments\Sender\PaymentIndividualSender;
use Illuminate\Support\Facades\Auth;

use App\Models\ItemsImages;
use App\Models\Condition;
use App\Models\Brand;
use App\Models\Store;
use App\Models\BoostItem;
use App\Models\BusinessUsers;
use App\Models\Category; 
use App\Models\City;
use App\Models\Country as ModelsCountry;
use App\Models\GpayInfo;
use App\Models\Inventory;
use App\Models\OrderDeliveryAddress;
use App\Models\OrderDeliveryCompany;
use App\Models\OrderItem;
use App\Models\OrderReturn;
use App\Models\PaymentSelectOption;
use App\Models\ReviewRatings;
use App\Models\ShippingDeliveryCompany;
use App\Models\stock;
use App\Models\StoreDistance;
use App\Models\UserLike;
use App\Models\VatPrice;
use App\Models\Wallet;
use App\Models\WalletUser;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PDF;

class OrderDetailsController extends Controller
{
    public function index($id) 
    {   
        $orderId = base64_decode($id);
        $orderDetails = Orders::where('id', $orderId)->first();
        if($orderDetails['return_order_id'] == NULL)
        {
            $orderGetUser = OrderItem::where('order_id', $orderDetails['id'])->first();
            $orderAmount = OrderItem::where('order_id', $orderDetails['id'])->sum('total_amount');
            $orderShippingPrice = OrderItem::where('order_id', $orderDetails['id'])->sum('shipping_price');
            $getAllOrders = OrderItem::where('order_id', $orderDetails['id'])->get()->toArray();
            $itemArray = [];
            foreach ($getAllOrders as $orderkey => $orderValue) {
                $itemArray[$orderkey] = $orderValue;

                $itemDetails = Item::where('id', $orderValue['item_id'])->withTrashed()->first();
                $itemArray[$orderkey]['itemDetails'] = $itemDetails;

                $itemImage = ItemsImages::where('item_id', $itemDetails->id)->withTrashed()->first();
                $itemArray[$orderkey]['itemImage'] = $itemImage;

                $orderItems = OrderItem::where('id', $orderValue['id'])->first();
                $itemArray[$orderkey]['orderItems'] = $orderItems;
            }
            $getAddressId = OrderDeliveryAddress::where('order_item_id', $orderGetUser['id'])->first();
            $orderAddress = UserDeliveryAddress::where('id', $getAddressId->address_id)->first();

        

            $reviewRating = ReviewRatings::orderby('id', 'desc')->get()->toArray();
        
            $reviewRatingArray = [];
            foreach ($reviewRating as $key => $value) {
                $reviewRatingArray[$key] = $value;
                $user = User::where('id', $value['user_id'])->first();
                $reviewRatingArray[$key]['user'] = $user;
            }
            return view('frontend.business.pages.order_details', compact('orderDetails',
                'orderAddress', 
                'reviewRatingArray',
                'orderGetUser',
                'orderAmount',
                'orderShippingPrice',
                'itemArray',
            ));
        }
        else{
            $orderGetUser = OrderItem::where('id', $orderDetails['return_order_id'])->first();
            $getOrderAmount = OrderItem::where('id', $orderDetails['return_order_id'])->first();
            $orderAmount = $getOrderAmount->price;
            $getOrderShippingPrice = OrderItem::where('id', $orderDetails['return_order_id'])->first();
            $orderShippingPrice = $getOrderShippingPrice->shipping_price;

            $getAllOrderReturn = OrderItem::where('id', $orderDetails['return_order_id'])->get()->toArray();
            $itemArrayReturn = [];
            foreach ($getAllOrderReturn as $orderReturnkey => $orderReturnValue) {
                $itemArrayReturn[$orderReturnkey] = $orderReturnValue;

                $itemDetails = Item::where('id', $orderReturnValue['item_id'])->withTrashed()->first();
                $itemArrayReturn[$orderReturnkey]['itemDetails'] = $itemDetails;

                $itemImage = ItemsImages::where('item_id', $itemDetails->id)->withTrashed()->first();
                $itemArrayReturn[$orderReturnkey]['itemImage'] = $itemImage;

                $orderItems = OrderItem::where('id', $orderReturnValue['id'])->first();
                $itemArrayReturn[$orderReturnkey]['orderItems'] = $orderItems;
            }
        }
        $getAddressId = OrderDeliveryAddress::where('order_item_id', $orderGetUser['id'])->first();
        $orderAddress = UserDeliveryAddress::where('id', $getAddressId->address_id)->first();

        

        $reviewRating = ReviewRatings::orderby('id', 'desc')->get()->toArray();
    
        $reviewRatingArray = [];
        foreach ($reviewRating as $key => $value) {
            $reviewRatingArray[$key] = $value;
            $user = User::where('id', $value['user_id'])->first();
            $reviewRatingArray[$key]['user'] = $user;
        }
        return view('frontend.business.pages.order_details', compact('orderDetails',
            'orderAddress', 
            'reviewRatingArray',
            'orderGetUser',
            'orderAmount',
            'orderShippingPrice',
            'itemArrayReturn'
        ));
    }

    public function checkout(Request $request, $id)
    {
        $AuthUserId = Auth::User()->id;
        $checkCart = Cart::where('customer_id',$AuthUserId)->get();
            if (!empty($checkCart) && count($checkCart) > 0){
            $checkOutUserId = CheckOutUserDetails::where('id', $id)->first();
            $userAddressDetail = UserDeliveryAddress::where(['id' => $checkOutUserId['address_id']])->where('deleted_at','=',NULL)->first();

            $cartData = Cart::where('customer_id',$AuthUserId)->pluck('item_id')->toArray();

            $itemsList = Item::whereIn('id',$cartData)->where('status', '=', '1')->orderBy('created_at', 'DESC')->withTrashed()->get()->toArray();
        
            $itemArray = [];
            $choice_optionsarray = [];
            $test = [];
            $grand_total = 0;
            foreach ($itemsList as $key => $value) {
                $itemArray[$key] = $value;
                $itemsImage = ItemsImages::where('item_id', $value['id'])->withTrashed()->first();
                $itemArray[$key]['item_pictures'] = $itemsImage;

                $condition = Condition::where('id', $value['condition_id'])->first();
                $itemArray[$key]['condition'] = $condition;

                $brand = Brand::where('id', $value['brand_id'])->first();
                $itemArray[$key]['brand'] = $brand;

                $store = Store::where('id', $value['store_id'])->first();
                $itemArray[$key]['store'] = $store;

                $boostItem = BoostItem::where('item_id', $value['id'])->where('is_paid', '1')->first();
                $itemArray[$key]['boostItem'] = $boostItem;

                $category = Category::where('id', $value['category_id'])->first();
                $itemArray[$key]['category'] = $category;

                $wishlist = Wishlist::where('item_id', $value['id'])->first();
                $itemArray[$key]['wishlist'] = $wishlist;

                $users = User::where('id', $value['user_id'])->first();
                $itemArray[$key]['user'] = $users;

                $likelist = UserLike::where('item_id', $value['id'])->first();
                $itemArray[$key]['likelist'] = $likelist;

                $cartlist = Cart::where('item_id', $value['id'])->where('customer_id',$AuthUserId)->first();
                $itemArray[$key]['cartlist'] = $cartlist;

                $grand_total = $grand_total + $value['price'];

                $weight = $value['weight'];
                $height = $value['height'];
                $width = $value['width'];
                $length = $value['length'];

                $lat = $value['latitude'];
                $long = $value['longitude'];

                $geocode=file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBtaxhnhdFp0QXoWnKkn-tyjaoX5YIsjx0&latlng='.$lat.','.$long.'&sensor=false');
                $output= json_decode($geocode);
                for($j=0;$j<count($output->results[0]->address_components);$j++){
                    $cn=array($output->results[0]->address_components[$j]->types[0]);
                    if(in_array("locality", $cn))
                    {
                    $city= $output->results[0]->address_components[$j]->long_name;
                    }
                } 
                $userAddressCity = UserDeliveryAddress::where(['id' => $checkOutUserId['address_id']])->first();
                if(!empty($userAddressCity)){
                    $returnCity = $userAddressCity->city;
                }
                else{
                    $userCity = User::where('id',Auth::user()->id)->first();
                    $getCity = $userCity->city_id;
                    $city12 = City::where('id', $getCity)->first();
                    $returnCity = $city12->name;
                }

                $getAccessToken = AccessToken::latest()->first();
                $fetch_access_token = $getAccessToken->access_token;

                $curl = curl_init();
                $postData = [            
                    "weight" => $weight,     
                    "originCity" => $city,
                    "destinationCity" => $returnCity,                       
                    "totalDue" => 0,                       
                    "height" => $height,                       
                    "width" => $width,                       
                    "length" => $length,                       
                ]; 

                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.tryoto.com/rest/v2/checkOTODeliveryFee',
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
                curl_close($curl);
                $json = json_decode($response, true);
                if(json_encode($json['deliveryCompany'] ?? " ") == "[]") {
                    echo "Delivery not Available";
                }
                elseif(($json['success'] ) == "0") {
                    echo "Delivery not Available";
                }

                else{
                    $checkShippingDeliveryCompany = ShippingDeliveryCompany::where('user_id',$value['user_id'])
                                                    ->where('item_id',$value['id'])
                                                    ->where('customer_id',Auth::user()->id)
                                                    ->first();
                    if(!empty($checkShippingDeliveryCompany)){
                        $updateShippingDeliveryCompany =  ShippingDeliveryCompany::where('user_id',$value['user_id'])
                                                        ->where('item_id',$value['id'])
                                                        ->where('customer_id',Auth::user()->id)
                                                        ->first();
                        $updateShippingDeliveryCompany->user_id              = $value['user_id'];
                        $updateShippingDeliveryCompany->item_id              = $value['id'];
                        $updateShippingDeliveryCompany->customer_id          = Auth::user()->id;
                        $updateShippingDeliveryCompany->serviceType          = $json['deliveryCompany'][0]['serviceType'];
                        $updateShippingDeliveryCompany->deliveryOptionName   = $json['deliveryCompany'][0]['deliveryOptionName'];
                        $updateShippingDeliveryCompany->trackingType         = $json['deliveryCompany'][0]['trackingType'];
                        $updateShippingDeliveryCompany->codCharge            = $json['deliveryCompany'][0]['codCharge'];
                        $updateShippingDeliveryCompany->maxOrderValue        = $json['deliveryCompany'][0]['maxOrderValue'];
                        $updateShippingDeliveryCompany->insurancePolicy      = $json['deliveryCompany'][0]['insurancePolicy'];
                        $updateShippingDeliveryCompany->deliveryOptionId     = $json['deliveryCompany'][0]['deliveryOptionId'];
                        $updateShippingDeliveryCompany->extraWeightPerKg     = $json['deliveryCompany'][0]['extraWeightPerKg'];
                        $updateShippingDeliveryCompany->deliveryCompanyName  = $json['deliveryCompany'][0]['deliveryCompanyName'];
                        $updateShippingDeliveryCompany->pickupCutoffTime     = $json['deliveryCompany'][0]['pickupCutoffTime'];
                        $updateShippingDeliveryCompany->avgDeliveryTime      = $json['deliveryCompany'][0]['avgDeliveryTime'];
                        $updateShippingDeliveryCompany->returnFee            = $json['deliveryCompany'][0]['returnFee'];
                        $updateShippingDeliveryCompany->maxFreeWeight        = $json['deliveryCompany'][0]['maxFreeWeight'];
                        $updateShippingDeliveryCompany->price                = $json['deliveryCompany'][0]['price'];
                        $updateShippingDeliveryCompany->logo                 = $json['deliveryCompany'][0]['logo'];
                        $updateShippingDeliveryCompany->pickupDropoff        = $json['deliveryCompany'][0]['pickupDropoff'];
                        $updateShippingDeliveryCompany->save();
                    }
                    else{
                        $storeShippingDeliveryCompany = new ShippingDeliveryCompany;
                        $storeShippingDeliveryCompany->user_id              = $value['user_id'];
                        $storeShippingDeliveryCompany->item_id              = $value['id'];
                        $storeShippingDeliveryCompany->customer_id          = Auth::user()->id;
                        $storeShippingDeliveryCompany->serviceType          = $json['deliveryCompany'][0]['serviceType'];
                        $storeShippingDeliveryCompany->deliveryOptionName   = $json['deliveryCompany'][0]['deliveryOptionName'];
                        $storeShippingDeliveryCompany->trackingType         = $json['deliveryCompany'][0]['trackingType'];
                        $storeShippingDeliveryCompany->codCharge            = $json['deliveryCompany'][0]['codCharge'];
                        $storeShippingDeliveryCompany->maxOrderValue        = $json['deliveryCompany'][0]['maxOrderValue'];
                        $storeShippingDeliveryCompany->insurancePolicy      = $json['deliveryCompany'][0]['insurancePolicy'];
                        $storeShippingDeliveryCompany->deliveryOptionId     = $json['deliveryCompany'][0]['deliveryOptionId'];
                        $storeShippingDeliveryCompany->extraWeightPerKg     = $json['deliveryCompany'][0]['extraWeightPerKg'];
                        $storeShippingDeliveryCompany->deliveryCompanyName  = $json['deliveryCompany'][0]['deliveryCompanyName'];
                        $storeShippingDeliveryCompany->pickupCutoffTime     = $json['deliveryCompany'][0]['pickupCutoffTime'];
                        $storeShippingDeliveryCompany->avgDeliveryTime      = $json['deliveryCompany'][0]['avgDeliveryTime'];
                        $storeShippingDeliveryCompany->returnFee            = $json['deliveryCompany'][0]['returnFee'];
                        $storeShippingDeliveryCompany->maxFreeWeight        = $json['deliveryCompany'][0]['maxFreeWeight'];
                        $storeShippingDeliveryCompany->price                = $json['deliveryCompany'][0]['price'];
                        $storeShippingDeliveryCompany->logo                 = $json['deliveryCompany'][0]['logo'];
                        $storeShippingDeliveryCompany->pickupDropoff        = $json['deliveryCompany'][0]['pickupDropoff'];
                        $storeShippingDeliveryCompany->save();

                    }
                    $checkUser = $value['user_id'];
                    $user = User::where('id',$checkUser)->first();

                    $address1 = $userAddressDetail->city;
                    $url1 = "https://maps.google.com/maps/api/geocode/json?key=AIzaSyBtaxhnhdFp0QXoWnKkn-tyjaoX5YIsjx0&address=".urlencode($address1);

                    $ch1 = curl_init();
                    curl_setopt($ch1, CURLOPT_URL, $url1);
                    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);    
                    $responseJson1 = curl_exec($ch1);
                    curl_close($ch1);

                    $response1 = json_decode($responseJson1);

                    if ($response1->status == 'OK') {
                        $latitude1 = $response1->results[0]->geometry->location->lat;
                        $longitude1 = $response1->results[0]->geometry->location->lng;

                    } else {
                        echo $response1->status;
                        var_dump($response1);
                    }

                    if($user->role == BUSINESS_ROLE){
                        $checkStore = Store::where('user_id',$checkUser)->get();
                        $store = [];
                        foreach($checkStore as $storekey => $storeValue){
                            $address = $storeValue->store_location;
                            $url = "https://maps.google.com/maps/api/geocode/json?key=AIzaSyBtaxhnhdFp0QXoWnKkn-tyjaoX5YIsjx0&address=".urlencode($address);

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
                            $responseJson = curl_exec($ch);
                            curl_close($ch);

                            $response = json_decode($responseJson);

                            if ($response->status == 'OK') {
                                $latitude = $response->results[0]->geometry->location->lat;
                                $longitude = $response->results[0]->geometry->location->lng;

                            } else {
                                echo $response->status;
                                var_dump($response);
                            }
                            if (($latitude1 == $latitude) && ($longitude1 == $longitude)) 
                            {
                                // echo 'hi';
                                $user_latitude   = 0;
                                $user_longitude  = 0;
                                $store_latitude  = 0;
                                $store_longitude = 0;  
                                $distance = 0;      

                            }
                            else 
                            {
                                $user_latitude   = $latitude1;
                                $user_longitude  = $longitude1;
                                $store_latitude  = $latitude;
                                $store_longitude = $longitude;
                        
                                $distance = round((((acos(sin(($user_latitude*pi()/180)) * sin(($store_latitude*pi()/180))+cos(($user_latitude*pi()/180)) * cos(($store_latitude*pi()/180)) * cos((($user_longitude- $store_longitude)*pi()/180))))*180/pi())*60*1.1515*1.609344), 2);
                                $store[$key] = $distance; 
                            }
                            $checkDistance = StoreDistance::where('user_id',$userAddressDetail->user_id)
                                                            ->where('store_id',$storeValue->id)
                                                            ->where('item_id',$value['id'])
                                                            ->first();
                            if(!empty($checkDistance)){
                                $checkDistanceUpdate = StoreDistance::where('user_id',$userAddressDetail->user_id)
                                ->where('store_id',$storeValue->id)->where('item_id',$value['id'])->first();
                                $checkDistanceUpdate->user_id           = $userAddressDetail->user_id;
                                $checkDistanceUpdate->store_id          = $storeValue->id;
                                $checkDistanceUpdate->item_id           = $value['id'];
                                $checkDistanceUpdate->user_latitude     = $latitude1;
                                $checkDistanceUpdate->user_longitude    = $longitude1;
                                $checkDistanceUpdate->store_latitude    = $latitude;
                                $checkDistanceUpdate->store_longitude   = $longitude;
                                $checkDistanceUpdate->distance          = $distance;
                                $checkDistanceUpdate->save();
                            }
                            else{
                                $storeDistance = new StoreDistance;
                                $storeDistance->user_id         = $userAddressDetail->user_id;
                                $storeDistance->store_id        = $storeValue->id;
                                $storeDistance->item_id         = $value['id'];
                                $storeDistance->user_latitude   = $user_latitude;
                                $storeDistance->user_longitude  = $user_longitude;
                                $storeDistance->store_latitude  = $latitude;
                                $storeDistance->store_longitude = $longitude;
                                $storeDistance->distance        = $distance;
                                $storeDistance->save();
                            }
                        }
                    }
                }
                $sum[$key] = ShippingDeliveryCompany::where('user_id',$value['user_id'])->where('item_id',$value['id'])->where('customer_id',Auth::user()->id)->sum('price');   
                
                $sumPrice = array_sum($sum);
            }
            $monthArray = array(
                "1" => "January", "2" => "February", "3" => "March", "4" => "April",
                "5" => "May", "6" => "June", "7" => "July", "8" => "August",
                "9" => "September", "10" => "October", "11" => "November", "12" => "December",
                );
            
                $grand_total = numberFormat($grand_total);
                // dd($sumShippingCharge);
            return view('frontend.business.pages.checkout.index', compact('checkCart','itemArray','json', 'monthArray','grand_total','userAddressDetail','checkOutUserId','sumPrice'));
        }
        else
        {
            return redirect()->route('frontend.business.order-details.checkout_empty');
        }
    }

    public function checkout_empty()
    {
        return view('frontend.business.pages.checkout.index');
    }

    public function card_details($id)
    {
        $paramsData = ($id);
        $itemId = CheckOutUserDetails::where('id', $paramsData)->first();
        $items  = Item::where(['id' => $itemId['item_id']])->where('status', '=', '1')->withTrashed()->first();
        $cart_price  = Cart::where(['item_id' => $itemId['item_id']])->first();

        return view('frontend.business.pages.order_card_add' , compact('items','cart_price'));
    }

    public function order_placed(Request $request)
    {
        $authUser = Auth::User();

        $save_token = new cardDetails;
        $save_token->user_id  = Auth::id();
        $save_token->holder_name  = $request->holder_name;
        $save_token->card_number  = $request->card_number;
        $save_token->expiry_month = $request->cardExpMonth;
        $save_token->expiry_year  = $request->cardExpYear;
        $save_token->cvv          = $request->cvv;
        $save_token->save();
        
        // $token = $request->token;
        // $save_token = new CardToken;
        // $save_token->user_id        = Auth::id();
        // $save_token->card_token     = $token;
        // $save_token->save();

        $api = CheckoutSdk::builder()->staticKeys()
            ->environment(Environment::sandbox())
            ->secretKey(env('CHECKOUT_SECRET_KEY'))
            ->build();

        $api = CheckoutSdk::builder()->oAuth()
            ->clientCredentials(env('CHECKOUT_ACCESS_KEY_ID'), env('CHECKOUT_ACCESS_KEY_VALUE'))
            ->scopes(['gateway'])
            ->environment(Environment::sandbox())
            ->build();

        $user = User::where('id', Auth::id())->first();
        $user_id = $user->id;
        $user_address = UserDeliveryAddress::where('user_id', $user_id)->first();
        $user_invoice = CheckOutUserDetails::where('user_id', $user_id)->Latest('id')->first();
        $user_item = $user_invoice->item_id;

        $user_item_details = Item::where('id', $user_item)->withTrashed()->first();
        $item_id = $user_item_details->id;
        $item_user_id = $user_item_details->user_id;
        $item_price = $user_item_details->price;

        $card_details = cardDetails::where('user_id',Auth::id())->Latest('id')->first();

        $totalAmount =  DB::table('cart')
        ->where('customer_id', Auth::id())
        ->sum('cart.total_amount');

        $getVat = VatPrice::first();
        $vatPrice = $getVat->vat_price;
        $vat = (($totalAmount/100) * $vatPrice);
        $totalPrice = $totalAmount + $vat;
        $total_amount_result = $totalPrice;
        $roundAmount = round($total_amount_result);

        $phone = new Phone();
        $phone->country_code = $user->phone_code;
        $phone->number = $user_address->phone_number;

        $address = new Address();
        $address->address_line1 = $user_address->locality;
        $address->address_line2 = $user_address->address;
        $address->city = $user_address->city;
        // $address->state = "London";
        $address->zip = $user_address->pincode;
        $address->country = Country::$GB;

        $requestCardSource = new RequestCardSource();
        $requestCardSource->name = $card_details->holder_name;
        $requestCardSource->number = $card_details->card_number;
        $requestCardSource->expiry_year = $card_details->expiry_year;
        $requestCardSource->expiry_month = $card_details->expiry_month;
        $requestCardSource->cvv = $card_details->cvv;
        $requestCardSource->billing_address = $address;
        $requestCardSource->phone = $phone;

        $customerRequest = new CustomerRequest();
        $customerRequest->email = $user->email;
        $customerRequest->name =  $user_address->name;

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
        $request->reference = "Test-Data";
        $request->amount = $roundAmount;
        $request->currency = Currency::$USD;
        $request->customer = $customerRequest;
        $request->sender = $paymentIndividualSender;

        try {
            $response = $api->getPaymentsClient()->requestPayment($request);
            // p($response);
            // $data['id'] = $response['id'];

            $save_checkout_details = new CheckOutPayment;
            $save_checkout_details->user_id     = Auth::id();
            $save_checkout_details->item_id     = $item_id;
            $save_checkout_details->payment_id  = $response['id'];
            $save_checkout_details->action_id   = $response['action_id'];
            $save_checkout_details->amount      = $response['amount'];
            $save_checkout_details->status      = $response['approved'];
            $save_checkout_details->currency    = $response['currency'];
            $save_checkout_details->type        = 'item';
            $save_checkout_details->save();

            $getCart = Cart::select('store_id')->where('customer_id', $authUser->id)->groupBy('store_id')->get()->toArray();

            if(!empty($getCart) && count($getCart) > 0)
            {
                foreach($getCart as $k => $v)
                {
                    if($v['store_id'] != "")
                    {
                        $StoreWiseItems = Cart::where('customer_id', $authUser->id)->where('store_id',$v['store_id'])->get()->toArray();
                        $total_amount = Cart::where('customer_id', $authUser->id)->where('store_id',$v['store_id'])->sum('total_amount');
                        $vat = (($total_amount/100) * $vatPrice);
                        $totalPrice = $total_amount + $vat;
                        $total_amount_result = $totalPrice;
                        $roundAmount = round($total_amount_result);
                    }
                    else{
                        $StoreWiseItems = Cart::where('customer_id', $authUser->id)->where('store_id',null)->get()->toArray();
                        $total_amount = Cart::where('customer_id', $authUser->id)->where('store_id',null)->sum('total_amount');
                        $vat = (($total_amount/100) * $vatPrice);
                        $totalPrice = $total_amount + $vat;
                        $total_amount_result = $totalPrice;
                        $roundAmount = round($total_amount_result);
                    }
                    
                    $cart_user_id = Cart::select('user_id')->where('customer_id', $authUser->id)->groupBy('user_id')->get()->toArray();
                    if(!empty($cart_user_id) && count($cart_user_id) > 0)
                    {
                        foreach($cart_user_id as $cart_userkey => $cart_user)
                        {
                            $save_order = new Orders;
                            $save_order->user_id            = $cart_user['user_id'];
                            $save_order->customer_id        = $authUser->id;
                            $save_order->store_id           = null;
                            if($v['store_id'] != "")
                            {
                                $save_order->store_id       = $v['store_id'];
                            }
                            $save_order->order_number       = $save_checkout_details->payment_id;
                            $save_order->grand_total        = $roundAmount;
                            $save_order->is_paid            = 1;
                            $save_order->order_status       = '0';
                            $save_order->payable_amount     = $roundAmount;
                            $save_order->sell_tax           = $vatPrice;
                            $save_order->payment_method     = 'card';
                            $save_order->save();
                        }
                    }
                    
                    $itemArr = [];
                    if(!empty($StoreWiseItems) && count($StoreWiseItems) > 0)
                    {
                        foreach($StoreWiseItems as $key => $cart)
                        {
                            $itemArr[] = $cart['item_id'];
                            $cart_item_amount       = $cart['price'];
                            $cart_item_id           = $cart['item_id'];
                            $cart_userId            = $cart['user_id'];
                            $cart_customer_id       = $cart['customer_id'];
                            $cart_item_quantity     = $cart['quantity'];
                            $cart_total_amount      = $cart['total_amount'];
                            $cart_shipping_price    = $cart['shipping_price'];

                            $saveOrderItems = new OrderItem;
                            $saveOrderItems->order_id       = $save_order->id;
                            $saveOrderItems->item_id        = $cart_item_id;
                            $saveOrderItems->user_id        = $cart_userId;
                            $saveOrderItems->customer_id    = $cart_customer_id;
                            $saveOrderItems->quantity       = $cart_item_quantity;
                            $saveOrderItems->price          = $cart_item_amount;
                            $saveOrderItems->total_amount   = $cart_total_amount;
                            $saveOrderItems->shipping_price = $cart_shipping_price;
                            $saveOrderItems->save();

                            $saveUserOrderDeliveryAddress = new OrderDeliveryAddress;
                            $saveUserOrderDeliveryAddress->user_id       = $cart_customer_id;
                            $saveUserOrderDeliveryAddress->item_id       = $cart_item_id;
                            $saveUserOrderDeliveryAddress->order_item_id = $saveOrderItems->id;
                            $saveUserOrderDeliveryAddress->address_id    = $user_invoice->address_id;
                            $saveUserOrderDeliveryAddress->save();
                        }
                    }

                    $postDataItem = [];
                    $fetchItem = Item::whereIn('id',$itemArr)->get();
                    if(!empty($fetchItem) && count($fetchItem) > 0)
                    {
                        foreach($fetchItem as $k => $item)
                        {
                            $productId      = $item['id'];
                            $itemName       = $item['what_are_you_selling'];
                            $itemPrice      = $item['price'];
                            $itemQuantity   = $item['quantity'];
                            $itemSku        = $item['sku'];
                            $itemUser       = $item['user_id'];
                            
                            $postDataItem[] = [
                                "productId" => $productId,
                                "name" => $itemName,
                                "price" => $itemPrice,
                                "rowTotal" => "",
                                "taxAmount" => "",
                                "quantity" => $cart_item_quantity,
                                "sku" => $itemSku,
                                "image" => "",
                            ];
                        }
                    }

                    $checkOutUser = CheckOutUserDetails::where('user_id', $authUser->id)->Latest('id')->first();
                    $getUserAddress = $checkOutUser->address_id;
                    
                    $fetchUserAddress = UserDeliveryAddress::where('id',$getUserAddress)->first();
                    $userId = $fetchUserAddress->user_id;
                    
                    $fetchUser = User::where('id',$userId)->first();
                    $cityId = $fetchUser->city_id;
                    $countryId = $fetchUser->country_id;
                    
                    $fetchCity = City::where('id',$cityId)->first();
                    $cityName = $fetchCity->name;
                    
                    $fetchCountry = ModelsCountry::where('id',$countryId)->first();
                    $countryName = $fetchCountry->name;

                    $fetchDeliveryOptionId = ShippingDeliveryCompany::where('customer_id', Auth::id())->whereIn('item_id',$itemArr)->get();

                    if(!empty($fetchDeliveryOptionId) && count($fetchDeliveryOptionId) > 0)
                    {
                        foreach($fetchDeliveryOptionId as $deliveryOptionIdData)
                        {
                            $deliveryOptionId = $deliveryOptionIdData['deliveryOptionId'];
                            $serviceType = $deliveryOptionIdData['serviceType'];
                            $shipping_amount = $deliveryOptionIdData['price'];
            
                            $postDataCustomer = [
                                "name" => $fetchUserAddress->name,
                                "email" => $fetchUser->email,
                                "mobile" => $fetchUserAddress->phone_number,
                                "address" => $fetchUserAddress->address,
                                "district" => $fetchUserAddress->locality,
                                "city" => $cityName,
                                "country" => $countryName,
                                "postcode" => $fetchUserAddress->pincode,
                                "lat" => "",
                                "lon" => "",
                            ];
                        }
                    }
        
                    $getAccessToken = AccessToken::latest()->first();
                    $fetch_access_token = $getAccessToken->access_token;
        
                    $curl = curl_init();
                    $postData = [
                        "orderId" => $save_order->id,
                        "ref1" => "",
                        "pickupLocationCode" => "",
                        "deliveryOptionId" => $deliveryOptionId,
                        "serviceType" => $serviceType,
                        "createShipment" => "true",
                        "storeName" => "",
                        "payment_method" => "paid",
                        "amount" => $roundAmount,
                        "amount_due" => 0,
                        "customsValue" => "",
                        "customsCurrency" => "USD",
                        "shippingAmount" => $shipping_amount,
                        "subtotal" => $roundAmount,
                        "currency" => "SAR",
                        "shippingNotes" => "be careful. it is fragile",
                        "packageSize" => "small",
                        "packageCount" => 2,
                        "packageWeight" => 1,
                        "boxWidth" => 10,
                        "boxLength" => 10,
                        "boxHeight" => 10,
                        "orderDate" => "",
                        "deliverySlotDate" => "",
                        "deliverySlotTo" => "",
                        "deliverySlotFrom" => "",
                        "senderName" => "",
                        "customer" => $postDataCustomer,
                        "items" => $postDataItem            
                    ];
        
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://api.tryoto.com/rest/v2/createOrder',
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
                    curl_close($curl);

                    $cart_qty = Cart::where('customer_id', $authUser->id)->get();
                    if(!empty($cart_qty) && count($cart_qty) > 0)
                    {
                        foreach($cart_qty as $q => $qty)
                        {
                            $quantity      = $qty['quantity'];
                        }
                        $updateInventory = Inventory::whereIn('item_id',$itemArr)->get();
                    
                        if(!empty($updateInventory) && count($updateInventory) > 0)
                        {
                            foreach($updateInventory as $i => $inventory)
                            {
                                $productIds      = $inventory['item_id'];
                                $total_stock    = $inventory['total_stock'];

                                $remainingStock =  $total_stock - $quantity;

                                $inventory = Inventory::where('item_id',$productIds)->first();
                                $inventory['stock_out'] = $quantity;
                                $inventory['stock_remaining'] = $remainingStock;
                                $inventory->save();

                                $insertStock = new stock;
                                $insertStock->user_id = $itemUser;
                                $insertStock->item_id = $productIds;
                                $insertStock->store_id = $v['store_id'];
                                $insertStock->quantity = $quantity;
                                $insertStock->stock_status = 0;
                                $insertStock->save();
                            }
                        }
                    }
                }
            }

            Cart::where('customer_id', $authUser->id)->delete();
            CheckOutUserDetails::where('user_id', $authUser->id)->delete();
            PaymentSelectOption::where('user_id', $authUser->id)->delete();
            cardDetails::where('user_id', $authUser->id)->delete();

            // return $response;
            return view('frontend.business.pages.order_placed_successful')->with('success', __('Payment SuccessFull'));
        } catch (CheckoutApiException $e) {
            // API error
            $error_details = $e->error_details;
            return redirect()->back()->with('danger', __('Payment UnsuccessFull'));
            $http_status_code = isset($e->http_metadata) ? $e->http_metadata->getStatusCode() : null;
        } catch (CheckoutAuthorizationException $e) {
            // Bad Invalid authorization
        }
    }

    public function addToCart(Request $request) 
    {
        $items_data  = Item::where(['id' => $request->item_id])->first();

        $update  = new Cart;
        $update->user_id        = $items_data->user_id;
        $update->customer_id    = Auth::id();
        $update->item_id        = $items_data->id;
        $update->store_id        = $items_data->store_id;
        $update->price          = $items_data->price;
        $update->quantity       = TRUE;
        $update->total_amount   = $items_data->price;
        $update->save();

        $checkOut = CheckOutUserDetails::where('user_id',Auth::User()->id)->orderBy('id','DESC')->first();


        if(!empty($checkOut))
        {
            $cart = Cart::where('customer_id', Auth::id())->count();
    
            $arrResponse['count'] = $cart;
            $arrResponse['id'] = null;
            if (!empty($checkOut)) {
                $arrResponse['id'] = $checkOut->id;
            }
        }
        else{
            $cart = Cart::where('customer_id', Auth::id())->count();
    
            $arrResponse['count'] = 0;
            $arrResponse['id'] = null;
            if (!empty($checkOut)) {
                $arrResponse['id'] = $checkOut->id;
            }
        }


        return response()->json(['data' => $arrResponse]);

    }

    public function qtyAddMinus(Request $request)
    {
        $get_item  = Item::where(['id' => $request->item_id])->first();
        $getUserId = $get_item->user_id;

        $requestedQty = $request->quantity;

        $getInventory = Inventory::where(['item_id' => $request->item_id])->first();

        $inventoryStock = 0;
        if(!empty($getInventory))
        {
            $inventoryStock = $getInventory->stock_remaining;
        }

        if((int)$inventoryStock < (int)$requestedQty)
        {
            return response()->json(['total_amount' => 0, 'grand_total' => 0, 'in_stock' => 0]);
        }

        $itemsListAddress = Item::where(['id' => $request->item_id, 'deleted_at' => NULL])
        ->where('status', '=', '1')
        ->orderBy('created_at', 'DESC')
        ->first();

        $weight = $itemsListAddress['weight'];
        $height = $itemsListAddress['height'];
        $width = $itemsListAddress['width'];
        $length = $itemsListAddress['length'];

        $lat = $itemsListAddress['latitude'];
        $long = $itemsListAddress['longitude'];

        $geocode=file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBtaxhnhdFp0QXoWnKkn-tyjaoX5YIsjx0&latlng='.$lat.','.$long.'&sensor=false');
            // dd($geocode);

            $output= json_decode($geocode);
            for($j=0;$j<count($output->results[0]->address_components);$j++){
                $cn=array($output->results[0]->address_components[$j]->types[0]);
                if(in_array("locality", $cn))
                {
                $city= $output->results[0]->address_components[$j]->long_name;
                }
            }                               
            $itemId = CheckOutUserDetails::where('user_id', Auth::User()->id)->first();
            $userAddressCity = UserDeliveryAddress::where(['id' => $itemId['address_id']])->first();
            if(!empty($userAddressCity)){
                $returnCity = $userAddressCity->city;
            }
            else{
                $userCity = User::where('id',Auth::user()->id)->first();
                $getCity = $userCity->city_id;
                $city12 = City::where('id', $getCity)->first();
                $returnCity = $city12->name;
            }
            $getAccessToken = AccessToken::latest()->first();
            $fetch_access_token = $getAccessToken->access_token;

            $curl = curl_init();
            $postData = [            
                "weight" => $weight,     
                "originCity" => $city,
                "destinationCity" => $returnCity,                       
                "totalDue" => 0,                       
                "height" => $height,                       
                "width" => $width,                       
                "length" => $length,                       
            ]; 

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.tryoto.com/rest/v2/checkOTODeliveryFee',
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
            curl_close($curl);
            $json = json_decode($response, true);
            // dd($json['deliveryCompany'][0]['price']);
            if(json_encode($json['deliveryCompany'] ?? " ") == "[]") {
                $shippingPrice = 0;
            }
            elseif(($json['success'] ) == "0") {
                $shippingPrice = 0;
            }
            else{
                $shippingPrice = $json['deliveryCompany'][0]['price'];
            }
        
        $data  = Cart::where(['id' => $request->cart_id])->first();
        if (!empty($data)) {
            $update  = Cart::where(['id' => $request->cart_id])->first();
            $update->user_id        = $getUserId;
            $update->customer_id    = Auth::id();
            $update->item_id        = $request->item_id;
            $update->quantity       = $request->quantity;
            $update->price          = $request->price;
            $update->shipping_price = $shippingPrice;
            $update->total_amount   = ($request->price * $request->quantity + $shippingPrice);
            $update->save();
        } else {
            $qty_update  = new Cart;
            $qty_update->user_id        = $getUserId;
            $qty_update->customer_id    = Auth::id();
            $qty_update->item_id        = $request->item_id;
            $qty_update->price          = $request->price;
            $qty_update->quantity       = $request->quantity;
            $qty_update->shipping_price = $shippingPrice;
            $qty_update->total_amount   =  ($request->price * $request->quantity + $shippingPrice);
            $qty_update->save();
        }


        $price = $request->price;
        $quantity = $request->quantity;
        $total_amount = ($price * $quantity);

        $itemsIds = $request->session()->put('session_item_id', $request->item_id);
        $userIds = $request->session()->put('session_user_id',  $request->user_id);

        $quantity = $request->session()->put('session_quantity', $request->quantity);
        $price = $request->session()->put('session_price', $request->price);

        $session_quantity = $request->session()->get('session_quantity');
        $session_price = $request->session()->get('session_price');

        $total_amount = ($session_price * $session_quantity);
        $grand_total = ($session_price * $session_quantity + $shippingPrice). " ".env('CURRENCY_TAG');

        $total_amount = numberFormat($total_amount);

        // $grand_total = ($session_price * $session_quantity). " ".env('CURRENCY_TAG');


        return response()->json(['total_amount' => $total_amount, 'grand_total' => $grand_total, 'in_stock' => 1]);
    }

    public function orderPaymentChoose($id){
        $itemId = CheckOutUserDetails::where('id', $id)->first();
        if(!empty($itemId))
        {
        $userAddressDetail = UserDeliveryAddress::where(['id' => $itemId['address_id']])->where('deleted_at','=',NULL)->first();
        $total_amount =  DB::table('cart')
        ->where('customer_id', Auth::id())
        ->sum('cart.total_amount'); 
        $total_shipping =  DB::table('cart')
        ->where('customer_id', Auth::id())
        ->sum('cart.shipping_price'); 
        $userCartDetail = Cart::where(['customer_id' => $itemId['user_id']])->where('deleted_at','=',NULL)->first(); 
        $monthArray = array(
            "1" => "January", "2" => "February", "3" => "March", "4" => "April",
            "5" => "May", "6" => "June", "7" => "July", "8" => "August",
            "9" => "September", "10" => "October", "11" => "November", "12" => "December",
            );

        $getCart = Cart::where(['customer_id' => $itemId['user_id']])->where('deleted_at','=',NULL)->get()->toArray();
        $itemsArray = [];
        foreach($getCart as $cartKey => $cart)
        {
            $itemsArray[$cartKey] = $cart;
            $itemsList = Item::where(['id' => $cart['item_id'], 'deleted_at' => NULL])
            ->where('status', '=', '1')
            ->first();
            $itemsArray[$cartKey]['itemsList'] = $itemsList;

            $cartList = Cart::where(['item_id' => $cart['item_id'], 'deleted_at' => NULL])
            ->first();
            $itemsArray[$cartKey]['cartList'] = $cartList;
        } 

        $authId = Auth::user()->id;
        $userWallet = Wallet::where('user_id', $authId)->first();

        if(!empty($userWallet)){
            $walletTotal = $userWallet->total_amount;
        }
        else{
            $walletTotal = 0;
        }

        $checkPaymentModeCheck = PaymentSelectOption::where('user_id',Auth::id())->first();
        if(!empty($checkPaymentModeCheck)){
            $checkPaymentMode = PaymentSelectOption::where('user_id',Auth::id())->first();
            return view('frontend.business.pages.order_payment',compact('total_shipping','itemsArray','walletTotal','checkPaymentMode','total_amount','userAddressDetail','userCartDetail','monthArray','itemsList'));
        }

        return view('frontend.business.pages.order_payment',compact('total_shipping','itemsArray','walletTotal','total_amount','userAddressDetail','userCartDetail','monthArray','itemsList'));
    }
    else{
        return redirect()->route('frontend.business.home.index');
    }
    }

    public function orderPaymentCOD()
    {
        $authUser = Auth::User();

        $user = User::where('id', $authUser->id)->first();
        $user_id = $user->id;
        $user_invoice = CheckOutUserDetails::where('user_id', $user_id)->Latest('id')->first();
        $user_item = $user_invoice->item_id;

        $user_item_details = Item::where('id', $user_item)->first();
        $item_id = $user_item_details->id;
        $item_user_id = $user_item_details->user_id;
        $item_price = $user_item_details->price;

        $totalAmount =  DB::table('cart')
        ->where('customer_id', $authUser->id)
        ->sum('cart.total_amount');

        $getVat = VatPrice::first();
        $vatPrice = $getVat->vat_price;
        $vat = (($totalAmount/100) * $vatPrice);
        $totalPrice = $totalAmount + $vat;
        $total_amount_result = $totalPrice;
        $roundAmount = round($total_amount_result);

        $order_number_generate = random_int(100000, 999999);
        $order_number_generate = 'COD-'.$order_number_generate;

        $getCart = Cart::select('store_id')->where('customer_id', $authUser->id)->groupBy('store_id')->get()->toArray();
        
        if(!empty($getCart) && count($getCart) > 0)
        {
            foreach($getCart as $k => $v)
            {
                if($v['store_id'] != "")
                {
                    $StoreWiseItems = Cart::where('customer_id', $authUser->id)->where('store_id',$v['store_id'])->get()->toArray();
                    $total_amount = Cart::where('customer_id', $authUser->id)->where('store_id',$v['store_id'])->sum('total_amount');
                    $vat = (($total_amount/100) * $vatPrice);
                    $totalPrice = $total_amount + $vat;
                    $total_amount_result = $totalPrice;
                    $roundAmount = round($total_amount_result);
                }
                else{
                    $StoreWiseItems = Cart::where('customer_id', $authUser->id)->where('store_id',null)->get()->toArray();
                    $total_amount = Cart::where('customer_id', $authUser->id)->where('store_id',null)->sum('total_amount');
                    $vat = (($total_amount/100) * $vatPrice);
                    $totalPrice = $total_amount + $vat;
                    $total_amount_result = $totalPrice;
                    $roundAmount = round($total_amount_result);
                }
                
                $cart_user_id = Cart::select('user_id')->where('customer_id', $authUser->id)->groupBy('user_id')->get()->toArray();
                    if(!empty($cart_user_id) && count($cart_user_id) > 0)
                    {
                        foreach($cart_user_id as $cart_userkey => $cart_user)
                        {
                        $save_order = new Orders;
                        $save_order->user_id            = $cart_user['user_id'];
                        $save_order->customer_id        = $authUser->id;
                        $save_order->store_id           = null;
                        if($v['store_id'] != "")
                        {
                            $save_order->store_id       = $v['store_id'];
                        }
                        $save_order->order_number       = $order_number_generate;
                        $save_order->grand_total        = $roundAmount;
                        $save_order->is_paid            = 1;
                        $save_order->order_status       = '0';
                        $save_order->payable_amount     = $roundAmount;
                        $save_order->sell_tax           = $vatPrice;
                        $save_order->payment_method     = 'cod';
                        $save_order->save();
                    }
                }
                
                $itemArr = [];
                if(!empty($StoreWiseItems) && count($StoreWiseItems) > 0)
                {
                    foreach($StoreWiseItems as $key => $cart)
                    {
                        $itemArr[] = $cart['item_id'];
                        $cart_item_amount       = $cart['price'];
                        $cart_item_id           = $cart['item_id'];
                        $cart_userId            = $cart['user_id'];
                        $cart_customer_id       = $cart['customer_id'];
                        $cart_item_quantity     = $cart['quantity'];
                        $cart_total_amount      = $cart['total_amount'];
                        $cart_shipping_price    = $cart['shipping_price'];

                        $saveOrderItems = new OrderItem;
                        $saveOrderItems->order_id       = $save_order->id;
                        $saveOrderItems->item_id        = $cart_item_id;
                        $saveOrderItems->user_id        = $cart_userId;
                        $saveOrderItems->customer_id    = $cart_customer_id;
                        $saveOrderItems->quantity       = $cart_item_quantity;
                        $saveOrderItems->price          = $cart_item_amount;
                        $saveOrderItems->total_amount   = $cart_total_amount;
                        $saveOrderItems->shipping_price = $cart_shipping_price;
                        $saveOrderItems->save();

                        $saveUserOrderDeliveryAddress = new OrderDeliveryAddress;
                        $saveUserOrderDeliveryAddress->user_id       = $cart_customer_id;
                        $saveUserOrderDeliveryAddress->item_id       = $cart_item_id;
                        $saveUserOrderDeliveryAddress->order_item_id = $saveOrderItems->id;
                        $saveUserOrderDeliveryAddress->address_id    = $user_invoice->address_id;
                        $saveUserOrderDeliveryAddress->save();
                    }
                }

                $postDataItem = [];
                $fetchItem = Item::whereIn('id',$itemArr)->get();
                if(!empty($fetchItem) && count($fetchItem) > 0)
                {
                    foreach($fetchItem as $k => $item)
                    {
                        $productId      = $item['id'];
                        $itemName       = $item['what_are_you_selling'];
                        $itemPrice      = $item['price'];
                        $itemQuantity   = $item['quantity'];
                        $itemSku        = $item['sku'];
                        $itemUser       = $item['user_id'];
                        $itemQty        = $item['quantity'];
                        
                        $postDataItem[] = [
                            "productId" => $productId,
                            "name" => $itemName,
                            "price" => $itemPrice,
                            "rowTotal" => "",
                            "taxAmount" => "",
                            "quantity" => $cart_item_quantity,
                            "sku" => $itemSku,
                            "image" => "",
                        ];
                    }
                }

                $checkOutUser = CheckOutUserDetails::where('user_id', $authUser->id)->Latest('id')->first();
                $getUserAddress = $checkOutUser->address_id;
                
                $fetchUserAddress = UserDeliveryAddress::where('id',$getUserAddress)->first();
                $userId = $fetchUserAddress->user_id;
                
                $fetchUser = User::where('id',$userId)->first();
                $cityId = $fetchUser->city_id;
                $countryId = $fetchUser->country_id;
                
                $fetchCity = City::where('id',$cityId)->first();
                $cityName = $fetchCity->name;
                
                $fetchCountry = ModelsCountry::where('id',$countryId)->first();
                $countryName = $fetchCountry->name;

                $fetchDeliveryOptionId = ShippingDeliveryCompany::where('customer_id', Auth::id())->whereIn('item_id',$itemArr)->get();

                if(!empty($fetchDeliveryOptionId) && count($fetchDeliveryOptionId) > 0)
                {
                    foreach($fetchDeliveryOptionId as $deliveryOptionIdData)
                    {
                        $deliveryOptionId = $deliveryOptionIdData['deliveryOptionId'];
                        $serviceType = $deliveryOptionIdData['serviceType'];
                        $shipping_amount = $deliveryOptionIdData['price'];
        
                        $postDataCustomer = [
                            "name" => $fetchUserAddress->name,
                            "email" => $fetchUser->email,
                            "mobile" => $fetchUserAddress->phone_number,
                            "address" => $fetchUserAddress->address,
                            "district" => $fetchUserAddress->locality,
                            "city" => $cityName,
                            "country" => $countryName,
                            "postcode" => $fetchUserAddress->pincode,
                            "lat" => "",
                            "lon" => "",
                        ];
                    }
                }
    
                $getAccessToken = AccessToken::latest()->first();
                $fetch_access_token = $getAccessToken->access_token;
    
                $curl = curl_init();
                $postData = [
                    "orderId" => $save_order->id,
                    "ref1" => "",
                    "pickupLocationCode" => "",
                    "deliveryOptionId" => $deliveryOptionId,
                    "serviceType" => $serviceType,
                    "createShipment" => "true",
                    "storeName" => "",
                    "payment_method" => "cod",
                    "amount" => $roundAmount,
                    "amount_due" => 0,
                    "customsValue" => "",
                    "customsCurrency" => "USD",
                    "shippingAmount" => $shipping_amount,
                    "subtotal" => $roundAmount,
                    "currency" => "SAR",
                    "shippingNotes" => "be careful. it is fragile",
                    "packageSize" => "small",
                    "packageCount" => 2,
                    "packageWeight" => 1,
                    "boxWidth" => 10,
                    "boxLength" => 10,
                    "boxHeight" => 10,
                    "orderDate" => "",
                    "deliverySlotDate" => "",
                    "deliverySlotTo" => "",
                    "deliverySlotFrom" => "",
                    "senderName" => "",
                    "customer" => $postDataCustomer,
                    "items" => $postDataItem            
                ];
    
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.tryoto.com/rest/v2/createOrder',
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
                curl_close($curl);

                $cart_qty = Cart::where('customer_id', $authUser->id)->get();
                if(!empty($cart_qty) && count($cart_qty) > 0)
                {
                    foreach($cart_qty as $q => $qty)
                    {
                        $quantity      = $qty['quantity'];
                    }
                    $updateInventory = Inventory::whereIn('item_id',$itemArr)->get();
                
                    if(!empty($updateInventory) && count($updateInventory) > 0)
                    {
                        foreach($updateInventory as $i => $inventory)
                        {
                            $productIds      = $inventory['item_id'];
                            $total_stock    = $inventory['total_stock'];

                            $remainingStock =  $total_stock - $quantity;

                            $inventory = Inventory::where('item_id',$productIds)->first();
                            $inventory['stock_out'] = $quantity;
                            $inventory['stock_remaining'] = $remainingStock;
                            $inventory->save();

                            $insertStock = new stock;
                            $insertStock->user_id = $itemUser;
                            $insertStock->item_id = $productIds;
                            $insertStock->store_id = $v['store_id'];
                            $insertStock->quantity = $quantity;
                            $insertStock->stock_status = 0;
                            $insertStock->save();
                        }
                    }
                }
            }
        }

        Cart::where('customer_id', $authUser->id)->delete();
        CheckOutUserDetails::where('user_id', $authUser->id)->delete();
        PaymentSelectOption::where('user_id', $authUser->id)->delete();
        cardDetails::where('user_id', $authUser->id)->delete();
        return view('frontend.business.pages.order_placed_successful')->with('success', __('Order Placed SuccessFull'));

    }

    public function pdf_download_invoice($id)
    {
        $order = Orders::where('id', $id)->first();
        $getAllOrders = OrderItem::where('order_id', $order['id'])->get()->toArray();
        $itemArray = [];
        foreach ($getAllOrders as $orderkey => $orderValue) {
            $itemArray[$orderkey] = $orderValue;

            $itemDetails = Item::where('id', $orderValue['item_id'])->withTrashed()->first();
            $itemArray[$orderkey]['itemDetails'] = $itemDetails;

            $orderItem = OrderItem::where('item_id', $itemDetails['id'])->first();
            $itemArray[$orderkey]['orderItem'] = $orderItem;
        }
        $itemUser = User::where('id', $order->user_id)->first();
        $userId = $itemUser->id;
        $cityId = $itemUser->city_id;
        $countryId = $itemUser->country_id;

        $city = City::where('id', $cityId)->first();
        $country = ModelsCountry::where('id', $countryId)->first();

        $orderGetUser = OrderItem::where('order_id', $order['id'])->first();
        $getAddressId = OrderDeliveryAddress::where('order_item_id', $orderGetUser['id'])->first();
        $getUserAddress = UserDeliveryAddress::where('id', $getAddressId->address_id)->first();

        if ($itemUser->role == BUSINESS_ROLE) {
            $businessUser = BusinessUsers::where('user_id', $userId)->first();
        } else {
            $businessUser = "";
        }
        return Pdf::loadView('frontend.business.pages.orders.download_invoice', [
            'order' => $order,
            'itemArray' => $itemArray,
            'itemUser' => $itemUser,
            'businessUser' => $businessUser,
            'city' => $city,
            'country' => $country,
            'getUserAddress' => $getUserAddress,
        ], [], [])->download('order.pdf');
    }

    public function orderPaymentSelect(Request $request)
    {
        $authUser = Auth::User();

        $checkPaymentMode = PaymentSelectOption::where('user_id',$authUser->id)->first();
        if($checkPaymentMode)
        {
            $updatePaymentMode = PaymentSelectOption::where('user_id',$authUser->id)->first();
            $updatePaymentMode->user_id = $authUser->id;
            $updatePaymentMode->payment_mode = $request->card_types;
            $updatePaymentMode->save();
        }
        else{
            $savePaymentMode = new PaymentSelectOption;
            $savePaymentMode->user_id = $authUser->id;
            $savePaymentMode->payment_mode = $request->card_types;
            $savePaymentMode->save();
        }
    }

    public function orderPaymentgpay(Request $request)
    {
        $authUser = Auth::User();

        $gpayStore = new GpayInfo;
        $gpayStore->user_id = $authUser->id;
        $gpayStore->amount = $request->total_amount;
        $gpayStore->token = $request->paymentData['paymentMethodData']['tokenizationData']['token'];
        $gpayStore->type = $request->paymentData['paymentMethodData']['tokenizationData']['type'];
        $gpayStore->address1 = $request->paymentData['shippingAddress']['address1'];
        $gpayStore->administrativeArea = $request->paymentData['shippingAddress']['administrativeArea'];
        $gpayStore->countryCode = $request->paymentData['shippingAddress']['countryCode'];
        $gpayStore->locality = $request->paymentData['shippingAddress']['locality'];
        $gpayStore->name = $request->paymentData['shippingAddress']['name'];
        $gpayStore->phoneNumber = $request->paymentData['shippingAddress']['phoneNumber'];
        $gpayStore->postalCode = $request->paymentData['shippingAddress']['postalCode'];
        $gpayStore->shippingOptionData = $request->paymentData['shippingOptionData']['id'];
        $gpayStore->save();

        $user = User::where('id', $authUser->id)->first();
        $user_id = $user->id;
        $user_invoice = CheckOutUserDetails::where('user_id', $user_id)->Latest('id')->first();

        $totalAmount =  DB::table('cart')
        ->where('customer_id', $authUser->id)
        ->sum('cart.total_amount');

        $getVat = VatPrice::first();
        $vatPrice = $getVat->vat_price;
        $vat = (($totalAmount/100) * $vatPrice);
        $totalPrice = $totalAmount + $vat;
        $total_amount_result = $totalPrice;
        $roundamount = round($total_amount_result);

        $order_number_generate = random_int(100000, 999999);
        $order_number_generate = 'GPAY-'.$order_number_generate;

        $getCart = Cart::select('store_id')->where('customer_id', $authUser->id)->groupBy('store_id')->get()->toArray();
        
        if(!empty($getCart) && count($getCart) > 0)
        {
            foreach($getCart as $k => $v)
            {
                if($v['store_id'] != "")
                {
                    $StoreWiseItems = Cart::where('customer_id', $authUser->id)->where('store_id',$v['store_id'])->get()->toArray();
                    $total_amount = Cart::where('customer_id', $authUser->id)->where('store_id',$v['store_id'])->sum('total_amount');
                    $vat = (($total_amount/100) * $vatPrice);
                    $totalPrice = $total_amount + $vat;
                    $total_amount_result = $totalPrice;
                    $roundamount = round($total_amount_result);
                }
                else{
                    $StoreWiseItems = Cart::where('customer_id', $authUser->id)->where('store_id',null)->get()->toArray();
                    $total_amount = Cart::where('customer_id', $authUser->id)->where('store_id',null)->sum('total_amount');
                    $vat = (($total_amount/100) * $vatPrice);
                    $totalPrice = $total_amount + $vat;
                    $total_amount_result = $totalPrice;
                    $roundamount = round($total_amount_result);
                }
                
                $cart_user_id = Cart::select('user_id')->where('customer_id', $authUser->id)->groupBy('user_id')->get()->toArray();
                    if(!empty($cart_user_id) && count($cart_user_id) > 0)
                    {
                        foreach($cart_user_id as $cart_userkey => $cart_user)
                        {
                        $save_order = new Orders;
                        $save_order->user_id            = $cart_user['user_id'];
                        $save_order->customer_id        = $authUser->id;
                        $save_order->store_id           = null;
                        if($v['store_id'] != "")
                        {
                            $save_order->store_id       = $v['store_id'];
                        }
                        $save_order->order_number       = $order_number_generate;
                        $save_order->grand_total        = $roundamount;
                        $save_order->is_paid            = 1;
                        $save_order->order_status       = '0';
                        $save_order->payable_amount     = $roundamount;
                        $save_order->sell_tax           = $vatPrice;
                        $save_order->payment_method     = 'gpay';
                        $save_order->save();
                    }
                }
                
                $itemArr = [];
                if(!empty($StoreWiseItems) && count($StoreWiseItems) > 0)
                {
                    foreach($StoreWiseItems as $key => $cart)
                    {
                        $itemArr[] = $cart['item_id'];
                        $cart_item_amount       = $cart['price'];
                        $cart_item_id           = $cart['item_id'];
                        $cart_userId            = $cart['user_id'];
                        $cart_customer_id       = $cart['customer_id'];
                        $cart_item_quantity     = $cart['quantity'];
                        $cart_total_amount      = $cart['total_amount'];
                        $cart_shipping_price    = $cart['shipping_price'];

                        $saveOrderItems = new OrderItem;
                        $saveOrderItems->order_id       = $save_order->id;
                        $saveOrderItems->item_id        = $cart_item_id;
                        $saveOrderItems->user_id        = $cart_userId;
                        $saveOrderItems->customer_id    = $cart_customer_id;
                        $saveOrderItems->quantity       = $cart_item_quantity;
                        $saveOrderItems->price          = $cart_item_amount;
                        $saveOrderItems->total_amount   = $cart_total_amount;
                        $saveOrderItems->shipping_price = $cart_shipping_price;
                        $saveOrderItems->save();

                        $saveUserOrderDeliveryAddress = new OrderDeliveryAddress;
                        $saveUserOrderDeliveryAddress->user_id       = $cart_customer_id;
                        $saveUserOrderDeliveryAddress->item_id       = $cart_item_id;
                        $saveUserOrderDeliveryAddress->order_item_id = $saveOrderItems->id;
                        $saveUserOrderDeliveryAddress->address_id    = $user_invoice->address_id;
                        $saveUserOrderDeliveryAddress->save();
                    }
                }

                $postDataItem = [];
                $fetchItem = Item::whereIn('id',$itemArr)->get();
                if(!empty($fetchItem) && count($fetchItem) > 0)
                {
                    foreach($fetchItem as $k => $item)
                    {
                        $productId      = $item['id'];
                        $itemName       = $item['what_are_you_selling'];
                        $itemPrice      = $item['price'];
                        $itemQuantity   = $item['quantity'];
                        $itemSku        = $item['sku'];
                        $itemUser       = $item['user_id'];
                        $itemQty        = $item['quantity'];
                        
                        $postDataItem[] = [
                            "productId" => $productId,
                            "name" => $itemName,
                            "price" => $itemPrice,
                            "rowTotal" => "",
                            "taxAmount" => "",
                            "quantity" => $cart_item_quantity,
                            "sku" => $itemSku,
                            "image" => "",
                        ];
                    }
                }

                $checkOutUser = CheckOutUserDetails::where('user_id', $authUser->id)->Latest('id')->first();
                $getUserAddress = $checkOutUser->address_id;
                
                $fetchUserAddress = UserDeliveryAddress::where('id',$getUserAddress)->first();
                $userId = $fetchUserAddress->user_id;
                
                $fetchUser = User::where('id',$userId)->first();
                $cityId = $fetchUser->city_id;
                $countryId = $fetchUser->country_id;
                
                $fetchCity = City::where('id',$cityId)->first();
                $cityName = $fetchCity->name;
                
                $fetchCountry = ModelsCountry::where('id',$countryId)->first();
                $countryName = $fetchCountry->name;

                $fetchDeliveryOptionId = ShippingDeliveryCompany::where('customer_id', Auth::id())->whereIn('item_id',$itemArr)->get();

                if(!empty($fetchDeliveryOptionId) && count($fetchDeliveryOptionId) > 0)
                {
                    foreach($fetchDeliveryOptionId as $deliveryOptionIdData)
                    {
                        $deliveryOptionId = $deliveryOptionIdData['deliveryOptionId'];
                        $serviceType = $deliveryOptionIdData['serviceType'];
                        $shipping_amount = $deliveryOptionIdData['price'];
        
                        $postDataCustomer = [
                            "name" => $fetchUserAddress->name,
                            "email" => $fetchUser->email,
                            "mobile" => $fetchUserAddress->phone_number,
                            "address" => $fetchUserAddress->address,
                            "district" => $fetchUserAddress->locality,
                            "city" => $cityName,
                            "country" => $countryName,
                            "postcode" => $fetchUserAddress->pincode,
                            "lat" => "",
                            "lon" => "",
                        ];
                    }
                }
    
                $getAccessToken = AccessToken::latest()->first();
                $fetch_access_token = $getAccessToken->access_token;
    
                $curl = curl_init();
                $postData = [
                    "orderId" => $save_order->id,
                    "ref1" => "",
                    "pickupLocationCode" => "",
                    "deliveryOptionId" => $deliveryOptionId,
                    "serviceType" => $serviceType,
                    "createShipment" => "true",
                    "storeName" => "",
                    "payment_method" => "gpay",
                    "amount" => $roundamount,
                    "amount_due" => 0,
                    "customsValue" => "",
                    "customsCurrency" => "USD",
                    "shippingAmount" => $shipping_amount,
                    "subtotal" => $roundamount,
                    "currency" => "SAR",
                    "shippingNotes" => "be careful. it is fragile",
                    "packageSize" => "small",
                    "packageCount" => 2,
                    "packageWeight" => 1,
                    "boxWidth" => 10,
                    "boxLength" => 10,
                    "boxHeight" => 10,
                    "orderDate" => "",
                    "deliverySlotDate" => "",
                    "deliverySlotTo" => "",
                    "deliverySlotFrom" => "",
                    "senderName" => "",
                    "customer" => $postDataCustomer,
                    "items" => $postDataItem            
                ];
    
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.tryoto.com/rest/v2/createOrder',
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
                curl_close($curl);

                $cart_qty = Cart::where('customer_id', $authUser->id)->get();
                if(!empty($cart_qty) && count($cart_qty) > 0)
                {
                    foreach($cart_qty as $q => $qty)
                    {
                        $quantity      = $qty['quantity'];
                    }
                    $updateInventory = Inventory::whereIn('item_id',$itemArr)->get();
                
                    if(!empty($updateInventory) && count($updateInventory) > 0)
                    {
                        foreach($updateInventory as $i => $inventory)
                        {
                            $productIds      = $inventory['item_id'];
                            $total_stock    = $inventory['total_stock'];

                            $remainingStock =  $total_stock - $quantity;

                            $inventory = Inventory::where('item_id',$productIds)->first();
                            $inventory['stock_out'] = $quantity;
                            $inventory['stock_remaining'] = $remainingStock;
                            $inventory->save();

                            $insertStock = new stock;
                            $insertStock->user_id = $itemUser;
                            $insertStock->item_id = $productIds;
                            $insertStock->store_id = $v['store_id'];
                            $insertStock->quantity = $quantity;
                            $insertStock->stock_status = 0;
                            $insertStock->save();
                        }
                    }
                }
            }
        }

        Cart::where('customer_id', $authUser->id)->delete();
        CheckOutUserDetails::where('user_id', $authUser->id)->delete();
        PaymentSelectOption::where('user_id', $authUser->id)->delete();
        cardDetails::where('user_id', $authUser->id)->delete();
        return view('frontend.business.pages.order_placed_successful')->with('success', __('Order Placed SuccessFull'));
    }

    public function order_successfull()
    {
        return view('frontend.business.pages.order_placed_successful')->with('success', __('Order Placed SuccessFull'));
    }

    public function order_wallet()
    {
        $authId = Auth::user()->id;
        $userWallet = Wallet::where('user_id', $authId)->first();
        $walletTotal = $userWallet->total_amount;

        $totalAmount =  DB::table('cart')
        ->where('customer_id', $authId)
        ->sum('cart.total_amount');

        $getVat = VatPrice::first();
        $vatPrice = $getVat->vat_price;
        $vat = (($totalAmount/100) * $vatPrice);
        $totalPrice = $totalAmount + $vat;
        $total_amount_result = $totalPrice;
        $roundamount = round($total_amount_result);

        $remainingAmount = $walletTotal - $roundamount;

        $updateWallet = Wallet::where('user_id', $authId)->first();
        $updateWallet->total_amount = $remainingAmount;
        $updateWallet->total_withdrawal = $roundamount;
        $updateWallet->save();

        $userWallet = new WalletUser;
        $userWallet->user_id = $authId;
        $userWallet->amount = $roundamount;
        $userWallet->status = FALSE;
        $userWallet->is_paid = TRUE;
        $userWallet->save();

        $user = User::where('id', $authId)->first();
        $user_id = $user->id;
        $user_invoice = CheckOutUserDetails::where('user_id', $user_id)->Latest('id')->first();

        $totalAmount =  DB::table('cart')
        ->where('customer_id', $authId)
        ->sum('cart.total_amount');

        $order_number_generate = random_int(100000, 999999);
        $order_number_generate = 'Wallet-'.$order_number_generate;

        $getCart = Cart::select('store_id')->where('customer_id', $authId)->groupBy('store_id')->get()->toArray();
        
        if(!empty($getCart) && count($getCart) > 0)
        {
            foreach($getCart as $k => $v)
            {
                if($v['store_id'] != "")
                {
                    $StoreWiseItems = Cart::where('customer_id', $authId)->where('store_id',$v['store_id'])->get()->toArray();
                    $total_amount = Cart::where('customer_id', $authId)->where('store_id',$v['store_id'])->sum('total_amount');
                    $vat = (($total_amount/100) * $vatPrice);
                    $totalPrice = $total_amount + $vat;
                    $total_amount_result = $totalPrice;
                    $roundamount = round($total_amount_result);
                }
                else{
                    $StoreWiseItems = Cart::where('customer_id', $authId)->where('store_id',null)->get()->toArray();
                    $total_amount = Cart::where('customer_id', $authId)->where('store_id',null)->sum('total_amount');
                    $vat = (($total_amount/100) * $vatPrice);
                    $totalPrice = $total_amount + $vat;
                    $total_amount_result = $totalPrice;
                    $roundamount = round($total_amount_result);
                }
                
                $cart_user_id = Cart::select('user_id')->where('customer_id', $authId)->groupBy('user_id')->get()->toArray();
                    if(!empty($cart_user_id) && count($cart_user_id) > 0)
                    {
                        foreach($cart_user_id as $cart_userkey => $cart_user)
                        {
                        $save_order = new Orders;
                        $save_order->user_id            = $cart_user['user_id'];
                        $save_order->customer_id        = $authId;
                        $save_order->store_id           = null;
                        if($v['store_id'] != "")
                        {
                            $save_order->store_id       = $v['store_id'];
                        }
                        $save_order->order_number       = $order_number_generate;
                        $save_order->grand_total        = $roundamount;
                        $save_order->is_paid            = 1;
                        $save_order->order_status       = '0';
                        $save_order->payable_amount     = $roundamount;
                        $save_order->sell_tax           = $vatPrice;
                        $save_order->payment_method     = 'wallet';
                        $save_order->save();
                    }
                }
                
                $itemArr = [];
                if(!empty($StoreWiseItems) && count($StoreWiseItems) > 0)
                {
                    foreach($StoreWiseItems as $key => $cart)
                    {
                        $itemArr[] = $cart['item_id'];
                        $cart_item_amount       = $cart['price'];
                        $cart_item_id           = $cart['item_id'];
                        $cart_userId            = $cart['user_id'];
                        $cart_customer_id       = $cart['customer_id'];
                        $cart_item_quantity     = $cart['quantity'];
                        $cart_total_amount      = $cart['total_amount'];
                        $cart_shipping_price    = $cart['shipping_price'];

                        $saveOrderItems = new OrderItem;
                        $saveOrderItems->order_id       = $save_order->id;
                        $saveOrderItems->item_id        = $cart_item_id;
                        $saveOrderItems->user_id        = $cart_userId;
                        $saveOrderItems->customer_id    = $cart_customer_id;
                        $saveOrderItems->quantity       = $cart_item_quantity;
                        $saveOrderItems->price          = $cart_item_amount;
                        $saveOrderItems->total_amount   = $cart_total_amount;
                        $saveOrderItems->shipping_price = $cart_shipping_price;
                        $saveOrderItems->save();

                        $saveUserOrderDeliveryAddress = new OrderDeliveryAddress;
                        $saveUserOrderDeliveryAddress->user_id       = $cart_customer_id;
                        $saveUserOrderDeliveryAddress->item_id       = $cart_item_id;
                        $saveUserOrderDeliveryAddress->order_item_id = $saveOrderItems->id;
                        $saveUserOrderDeliveryAddress->address_id    = $user_invoice->address_id;
                        $saveUserOrderDeliveryAddress->save();
                    }
                }

                $postDataItem = [];
                $fetchItem = Item::whereIn('id',$itemArr)->get();
                if(!empty($fetchItem) && count($fetchItem) > 0)
                {
                    foreach($fetchItem as $k => $item)
                    {
                        $productId      = $item['id'];
                        $itemName       = $item['what_are_you_selling'];
                        $itemPrice      = $item['price'];
                        $itemQuantity   = $item['quantity'];
                        $itemSku        = $item['sku'];
                        $itemUser       = $item['user_id'];
                        $itemQty        = $item['quantity'];
                        
                        $postDataItem[] = [
                            "productId" => $productId,
                            "name" => $itemName,
                            "price" => $itemPrice,
                            "rowTotal" => "",
                            "taxAmount" => "",
                            "quantity" => $cart_item_quantity,
                            "sku" => $itemSku,
                            "image" => "",
                        ];
                    }
                }

                $checkOutUser = CheckOutUserDetails::where('user_id', $authId)->Latest('id')->first();
                $getUserAddress = $checkOutUser->address_id;
                
                $fetchUserAddress = UserDeliveryAddress::where('id',$getUserAddress)->first();
                $userId = $fetchUserAddress->user_id;
                
                $fetchUser = User::where('id',$userId)->first();
                $cityId = $fetchUser->city_id;
                $countryId = $fetchUser->country_id;
                
                $fetchCity = City::where('id',$cityId)->first();
                $cityName = $fetchCity->name;
                
                $fetchCountry = ModelsCountry::where('id',$countryId)->first();
                $countryName = $fetchCountry->name;

                $fetchDeliveryOptionId = ShippingDeliveryCompany::where('customer_id', Auth::id())->whereIn('item_id',$itemArr)->get();

                if(!empty($fetchDeliveryOptionId) && count($fetchDeliveryOptionId) > 0)
                {
                    foreach($fetchDeliveryOptionId as $deliveryOptionIdData)
                    {
                        $deliveryOptionId = $deliveryOptionIdData['deliveryOptionId'];
                        $serviceType = $deliveryOptionIdData['serviceType'];
                        $shipping_amount = $deliveryOptionIdData['price'];
        
                        $postDataCustomer = [
                            "name" => $fetchUserAddress->name,
                            "email" => $fetchUser->email,
                            "mobile" => $fetchUserAddress->phone_number,
                            "address" => $fetchUserAddress->address,
                            "district" => $fetchUserAddress->locality,
                            "city" => $cityName,
                            "country" => $countryName,
                            "postcode" => $fetchUserAddress->pincode,
                            "lat" => "",
                            "lon" => "",
                        ];
                    }
                }
    
                $getAccessToken = AccessToken::latest()->first();
                $fetch_access_token = $getAccessToken->access_token;
    
                $curl = curl_init();
                $postData = [
                    "orderId" => $save_order->id,
                    "ref1" => "",
                    "pickupLocationCode" => "",
                    "deliveryOptionId" => $deliveryOptionId,
                    "serviceType" => $serviceType,
                    "createShipment" => "true",
                    "storeName" => "",
                    "payment_method" => "wallet",
                    "amount" => $roundamount,
                    "amount_due" => 0,
                    "customsValue" => "",
                    "customsCurrency" => "USD",
                    "shippingAmount" => $shipping_amount,
                    "subtotal" => $roundamount,
                    "currency" => "SAR",
                    "shippingNotes" => "be careful. it is fragile",
                    "packageSize" => "small",
                    "packageCount" => 2,
                    "packageWeight" => 1,
                    "boxWidth" => 10,
                    "boxLength" => 10,
                    "boxHeight" => 10,
                    "orderDate" => "",
                    "deliverySlotDate" => "",
                    "deliverySlotTo" => "",
                    "deliverySlotFrom" => "",
                    "senderName" => "",
                    "customer" => $postDataCustomer,
                    "items" => $postDataItem            
                ];
    
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.tryoto.com/rest/v2/createOrder',
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
                curl_close($curl);

                $cart_qty = Cart::where('customer_id', $authId)->get();
                if(!empty($cart_qty) && count($cart_qty) > 0)
                {
                    foreach($cart_qty as $q => $qty)
                    {
                        $quantity      = $qty['quantity'];
                    }
                    $updateInventory = Inventory::whereIn('item_id',$itemArr)->get();
                
                    if(!empty($updateInventory) && count($updateInventory) > 0)
                    {
                        foreach($updateInventory as $i => $inventory)
                        {
                            $productIds      = $inventory['item_id'];
                            $total_stock    = $inventory['total_stock'];

                            $remainingStock =  $total_stock - $quantity;

                            $inventory = Inventory::where('item_id',$productIds)->first();
                            $inventory['stock_out'] = $quantity;
                            $inventory['stock_remaining'] = $remainingStock;
                            $inventory->save();

                            $insertStock = new stock;
                            $insertStock->user_id = $itemUser;
                            $insertStock->item_id = $productIds;
                            $insertStock->store_id = $v['store_id'];
                            $insertStock->quantity = $quantity;
                            $insertStock->stock_status = 0;
                            $insertStock->save();
                        }
                    }
                }
            }
        }

        Cart::where('customer_id', $authId)->delete();
        CheckOutUserDetails::where('user_id', $authId)->delete();
        PaymentSelectOption::where('user_id', $authId)->delete();
        cardDetails::where('user_id', $authId)->delete();
        return view('frontend.business.pages.order_placed_successful')->with('success', __('Order Placed SuccessFull'));
    }

    public function removedItem($id)
    {
        $AuthUserId = Auth::User()->id;
        if (!empty($AuthUserId)) {
            Cart::where('customer_id', $AuthUserId)->where('item_id', $id)->delete();
            return redirect()->back()->with('success','Item removed from cart');
        }
        else
        {
            return redirect('frontend.business.order-details.checkout_empty');
        }
    }

    public function order_return(Request $request)
    {
        $authUser = Auth::User();

        $ids = $request->ids;
        $orderId = explode(",", $ids);
        $getOrderItem =  OrderItem::whereIn('id', $orderId)->get()->toArray();
        if (!empty($getOrderItem) && count($getOrderItem) > 0) {
            foreach ($getOrderItem as $orderkey => $orderValue) {
                $orderReturn = new OrderReturn;
                $orderReturn->order_id = $orderValue['id'];
                $orderReturn->customer_id = $authUser['id'];
                $orderReturn->user_id = $orderValue['user_id'];
                $orderReturn->item_id = $orderValue['item_id'];
                $orderReturn->price = $orderValue['price'];
                $orderReturn->quantity = $orderValue['quantity'];
                $orderReturn->shipping_price = $orderValue['shipping_price'];
                $orderReturn->total_amount = $orderValue['total_amount'];
                $orderReturn->save();

                $order_number_generate = random_int(100000, 999999);
                $order_number_generate = 'RETURN-' . $order_number_generate;

                $save_order = new Orders;
                $save_order->user_id            = $orderValue['user_id'];
                $save_order->customer_id        = $authUser->id;
                $save_order->return_order_id    = $orderReturn->order_id;
                $save_order->item_id            = $orderValue['item_id'];
                $save_order->order_number       = $order_number_generate;
                $save_order->grand_total        = $orderValue['total_amount'];
                $save_order->is_paid            = 0;
                $save_order->order_status       = '0';
                $save_order->payable_amount     = $orderValue['total_amount'];
                $save_order->payment_method     = '';
                $save_order->order_status       = ORDER_RETURN;
                $save_order->save();

                $getOrder = Orders::whereIn('return_order_id', $orderId)->get();
                foreach ($getOrder as $orderMainkey => $orderMainValue) {
                    $orderReturn = OrderReturn::where('order_id', $orderMainValue->return_order_id)->first();
                    $orderReturn->main_order_id = $orderMainValue->id;
                    $orderReturn->save();

                    $orderItem = OrderItem::where('id', $orderMainValue->return_order_id)->first();
                    $orderItem->status = ORDER_RETURN;
                    $orderItem->save();
                }

                $orderQty = $orderValue['quantity'];

                $postDataItem = [];
                $fetchItem = Item::where('id', $orderValue['item_id'])->withTrashed()->get();
                if (!empty($fetchItem) && count($fetchItem) > 0) {
                    foreach ($fetchItem as $k => $item) {
                        $productId      = $item['id'];
                        $itemName       = $item['what_are_you_selling'];
                        $itemPrice      = $item['price'];
                        $itemSku        = $item['sku'];

                        $postDataItem[] = [
                            "productId" => $productId,
                            "name" => $itemName,
                            "price" => $itemPrice,
                            "rowTotal" => "",
                            "taxAmount" => "",
                            "quantity" => $orderQty,
                            "sku" => $itemSku,
                            "image" => "",
                        ];
                    }
                }

                $userAddress = OrderDeliveryAddress::where('order_item_id', $orderValue['id'])->first();
                $getUserAddress = $userAddress->address_id;

                $fetchUserAddress = UserDeliveryAddress::where('id', $getUserAddress)->first();
                $userId = $fetchUserAddress->user_id;

                $fetchUser = User::where('id', $userId)->first();
                $cityId = $fetchUser->city_id;
                $countryId = $fetchUser->country_id;

                $fetchCity = City::where('id', $cityId)->first();
                $cityName = $fetchCity->name;

                $fetchCountry = ModelsCountry::where('id', $countryId)->first();
                $countryName = $fetchCountry->name;

                $fetchDeliveryOptionId = ShippingDeliveryCompany::where('customer_id', Auth::id())->where('item_id', $orderValue['item_id'])->get();

                if (!empty($fetchDeliveryOptionId) && count($fetchDeliveryOptionId) > 0) {
                    foreach ($fetchDeliveryOptionId as $deliveryOptionIdData) {
                        $deliveryOptionId = $deliveryOptionIdData['deliveryOptionId'];
                        $serviceType = $deliveryOptionIdData['serviceType'];
                        $shipping_amount = $deliveryOptionIdData['price'];

                        $postDataCustomer = [
                            "name" => $fetchUserAddress->name,
                            "email" => $fetchUser->email,
                            "mobile" => $fetchUserAddress->phone_number,
                            "address" => $fetchUserAddress->address,
                            "district" => $fetchUserAddress->locality,
                            "city" => $cityName,
                            "country" => $countryName,
                            "postcode" => $fetchUserAddress->pincode,
                            "lat" => "",
                            "lon" => "",
                        ];
                    }
                }

                $getAccessToken = AccessToken::latest()->first();
                $fetch_access_token = $getAccessToken->access_token;

                $curl = curl_init();
                $postData = [
                    "orderId" => $save_order->id,
                    "ref1" => "",
                    "pickupLocationCode" => "",
                    "deliveryOptionId" => $deliveryOptionId,
                    "serviceType" => $serviceType,
                    "createShipment" => "true",
                    "storeName" => "",
                    "payment_method" => "return",
                    "amount" => $save_order->grand_total,
                    "amount_due" => 0,
                    "customsValue" => "",
                    "customsCurrency" => "USD",
                    "shippingAmount" => $shipping_amount,
                    "subtotal" => $save_order->grand_total,
                    "currency" => "SAR",
                    "shippingNotes" => "be careful. it is fragile",
                    "packageSize" => "small",
                    "packageCount" => 2,
                    "packageWeight" => 1,
                    "boxWidth" => 10,
                    "boxLength" => 10,
                    "boxHeight" => 10,
                    "orderDate" => "",
                    "deliverySlotDate" => "",
                    "deliverySlotTo" => "",
                    "deliverySlotFrom" => "",
                    "senderName" => "",
                    "customer" => $postDataCustomer,
                    "items" => $postDataItem
                ];

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.tryoto.com/rest/v2/createOrder',
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
                        'Authorization: Bearer ' . $fetch_access_token
                    ),
                ));

                $response = curl_exec($curl);
                curl_close($curl);
            }
        }
        return response()->json(['status'=>true,'message'=>"Category deleted successfully."]);   

    }
}
