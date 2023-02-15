<?php

namespace App\Http\Controllers\Frontend\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Stories;
use App\Models\Slider;
use App\Models\User;
use App\Models\Item;
use App\Models\ItemsImages;
use App\Models\Condition;
use App\Models\Brand;
use App\Models\Store;
use App\Models\BoostItem;
use App\Models\BusinessUsers;
use App\Models\cardDetails;
use App\Models\CardToken;
use App\Models\City;
use App\Models\Wishlist;
use Checkout\CheckoutSdk;
use Checkout\Common\Address;
use Checkout\Common\Phone;
use Checkout\Environment;
use Checkout\Common\Country;
use Checkout\Payments\Request\Source\RequestCardSource;
use Checkout\Common\Currency;
use Checkout\Common\CustomerRequest;
use Checkout\Payments\Request\PaymentRequest;
use Checkout\Payments\Sender\Identification;
use Checkout\Payments\Sender\IdentificationType;
use Checkout\Payments\Sender\PaymentIndividualSender;
use App\Models\CheckOutPayment;
use Checkout\CheckoutApiException;
use Checkout\CheckoutAuthorizationException;
use App\Models\CheckOutUserDetails;
use App\Models\Inventory;
use App\Models\UserLike;
use DateTime;
use Lang;
use Mail;
use DB;
use Illuminate\Support\Facades\Auth;

class BoostItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('frontend.business.pages.items.boost_item');
    }

    public function item_details($id)
    {
        $id = base64_decode($id);
        $itemsList = Item::where(['id' => $id, 'deleted_at' => NULL])
            ->where('status', '=', '1')
            ->orderBy('created_at', 'DESC')
            ->get()
            ->toArray();

        $itemArray = [];
        foreach ($itemsList as $key => $value) {
            $itemArray[$key] = $value;
            $itemsImage = ItemsImages::where('item_id', $value['id'])->first();
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

            $inventory = Inventory::where('item_id', $value['id'])->first();
            $itemArray[$key]['inventory'] = $inventory;

            $likelist = UserLike::where('item_id', $value['id'])->where('user_id', Auth::user()->id)->first();
            $itemArray[$key]['likelist'] = $likelist;

            $user = User::where('id', $value['user_id'])->first();
            $userCity = $user->city_id;
            $getCity = City::where('id', $userCity)->first();
            $itemArray[$key]['city'] = $getCity;
        }
        $boostItemArray = BoostItem::where('user_id', Auth::user()->id)->where('is_paid', '1')->take(3)->get();

        /* Related ads items start*/
        $get_category_id = $value['category_id'];
        $relatedAdsitemsList = Item::where('deleted_at', '=', NULL)->orderBy('created_at', 'DESC')
            ->where('category_id', '=', $get_category_id)
            ->where('status', '=', '1')
            ->orderBy('created_at', 'DESC')
            ->get()
            ->take(4)
            ->toArray();

        $relatedItemArray = [];
        foreach ($relatedAdsitemsList as $relatedAdskey => $relatedAdsvalue) {
            $relatedItemArray[$relatedAdskey] = $relatedAdsvalue;
            $itemsImage = ItemsImages::where('item_id', $relatedAdsvalue['id'])->first();
            $relatedItemArray[$relatedAdskey]['item_pictures'] = $itemsImage;

            $condition = Condition::where('id', $relatedAdsvalue['condition_id'])->first();
            $relatedItemArray[$relatedAdskey]['condition'] = $condition;

            $brand = Brand::where('id', $relatedAdsvalue['brand_id'])->first();
            $relatedItemArray[$relatedAdskey]['brand'] = $brand;

            $store = Store::where('id', $relatedAdsvalue['store_id'])->first();
            $relatedItemArray[$relatedAdskey]['store'] = $store;

            $boostItem = BoostItem::where('item_id', $relatedAdsvalue['id'])->where('is_paid', '1')->first();
            $relatedItemArray[$relatedAdskey]['boostItem'] = $boostItem;

            $wishlist = Wishlist::where('item_id', $relatedAdsvalue['id'])->first();
            $relatedItemArray[$relatedAdskey]['wishlist'] = $wishlist;

            $user = User::where('id', $relatedAdsvalue['user_id'])->first();
            $relatedItemArray[$relatedAdskey]['user'] = $user;

            $userCity = $user->city_id;
            $getCity = City::where('id', $userCity)->first();
            $relatedItemArray[$relatedAdskey]['city'] = $getCity;
        }
        /*Related ads items end*/
        return view('frontend.business.pages.items.boost_item', compact('itemArray', 'boostItemArray', 'relatedItemArray'));
    }
    public function boost_items_payment_details(Request $request)
    {
        $id = $request->payment_id;
        $itemBoostPrice = (int) $request->itemBoostPrice;
        $get_details = Item::where('id', $id)->where('status', '=', '1')->get();
        foreach ($get_details as $key => $value) {
            $order = new BoostItem;
            $order->user_id = Auth::user()->id;
            $order->item_id = $value->id;
            $order->boost_amount = $itemBoostPrice;
            $order->save();
        }
        return response()->json(['success' => 'Boost Item Payment successfully']);
    }

    public function boost_items_payment(Request $request, $id)
    {
        $boostId = ($id);
        $boostData = BoostItem::where('item_id', $boostId)->Latest('item_id')->first();  
        $monthArray = array(
            "1" => "January", "2" => "February", "3" => "March", "4" => "April",
            "5" => "May", "6" => "June", "7" => "July", "8" => "August",
            "9" => "September", "10" => "October", "11" => "November", "12" => "December",
            );
        return view('frontend.business.pages.b_boost_item_payment', compact('boostData','monthArray'));
    }

    public function boost_items_payment_info(Request $request)
    {
        $save_token = new cardDetails();
        $save_token->user_id  = Auth::id();
        $save_token->holder_name  = $request->holder_name;
        $save_token->card_number  = $request->card_number;
        $save_token->expiry_month  = $request->expiry_month;
        $save_token->expiry_year  = $request->expiry_year;
        $save_token->cvv  = $request->cvv;
        $save_token->save();

        $token = $request->token;
        $save_token = new CardToken();
        $save_token->user_id  = Auth::id();
        $save_token->card_token  = $token;
        $save_token->save();

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

        $user_boost = BoostItem::where('user_id', $user->id)->Latest('id')->first();
        $user_item = $user_boost->item_id;
        $user_boost_amount = $user_boost->boost_amount;

        $user_item_details = Item::where('id', $user_item)->first();
        $item_id = $user_item_details->id;
        $item_price = $user_item_details->price;

        $card_details = cardDetails::where('user_id', Auth::id())->Latest('id')->first();
        $business_user_details = BusinessUsers::where('user_id', Auth::id())->Latest('id')->first();
        $city_name = City::where('id', $business_user_details->city_id)->first();

        $phone = new Phone();
        $phone->country_code = $user->phone_code;
        $phone->number = $user->phone_number;

        $address = new Address();
        $address->address_line1 = $business_user_details->store_location;
        $address->address_line2 = $city_name->name;
        $address->city = $city_name->name;
        // $address->state = "London";
        $address->zip = "";
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
        $request->reference = "Test-Data-Boost";
        $request->amount = $user_boost_amount;
        $request->currency = Currency::$USD;
        $request->customer = $customerRequest;
        $request->sender = $paymentIndividualSender;

        try {
            $response = $api->getPaymentsClient()->requestPayment($request);
            // p($response['id']);
            // $data['id'] = $response['id'];

            $save_checkout_details = new CheckOutPayment;
            $save_checkout_details->user_id  = Auth::id();
            $save_checkout_details->item_id  = $item_id;
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
            return redirect()->back()->with('success', __('Payment SuccessFull'));
        } catch (CheckoutApiException $e) {
            // API error
            $error_details = $e->error_details;
            return redirect()->back()->with('danger', __('Payment UnsuccessFull'));

            dd($error_details);

            $http_status_code = isset($e->http_metadata) ? $e->http_metadata->getStatusCode() : null;
        } catch (CheckoutAuthorizationException $e) {
            // Bad Invalid authorization
        }
    }
}
