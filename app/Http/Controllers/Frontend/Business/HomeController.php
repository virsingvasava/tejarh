<?php

namespace App\Http\Controllers\Frontend\Business;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
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
use App\Models\cardDetails;
use App\Models\CheckOutPayment;
use App\Models\City;
use App\Models\General;
use App\Models\WhyUse;
use App\Models\ShortBanner;
use App\Models\StoryPrice;
use App\Models\UserStory;
use App\Models\WholesaleGeneral;
use App\Models\Wishlist;
use App\Models\ReviewRatings;
use App\Models\CustomerSupport;
use DateTime;
use Lang;
use Mail;

use Checkout\CheckoutApiException;
use Checkout\CheckoutAuthorizationException;
use Checkout\CheckoutSdk;
use Checkout\Common\Address;
use Checkout\Common\Country as checkoutCountry;
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

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $sliderImage = Slider::where('status', ACTIVE)->where('deleted_at', '=', NULL)->get();
        $category =  Category::where('status', ACTIVE)->where('deleted_at', '=', NULL)->limit(7)->get();

        $AllCategoryCount =  Category::where('status', ACTIVE)->where('deleted_at', '=', NULL)->count();

        $story_price_data = StoryPrice::select('story_price')->pluck('story_price');
        $story_price = '';
        if(!empty($story_price_data[0])){
            $story_price = $story_price_data[0];
        }

        $take = $AllCategoryCount - count($category);
        $skip = 7;
        $categorySingle =  Category::where('status', ACTIVE)->where('deleted_at', '=', NULL)->skip($skip)->take($take)->get();

        $LoginuserStory =  UserStory::select('user_id')->groupBy('user_id')->where('is_paid','=','1')->where('deleted_at', '=', NULL)->get();
        $user = User::where('role', BUSINESS_ROLE)->get();
        $userArray = array();
        foreach ($user as $usr) {
            $userArray[] = $usr->id;
        }
        $StoryAll = UserStory::select('user_id')->where('deleted_at', '=', NULL)->whereIn('user_id', $userArray)->where('is_paid','=','1')->groupBy('user_id')->get();
        $CheckUser = array();
        foreach ($StoryAll as $key => $tr) {
            $CheckUser[] = $tr['user_id'];
        }
        $Story = array();
        foreach ($CheckUser as $key => $value) {
            $StoryAll = UserStory::with('user', 'category')->where('deleted_at', '=', NULL)->where('is_paid','=','1')->where('user_id', $value)->get()->toArray();
            $Story[] = $StoryAll;
        }

        $storyList = Category::where('status', ACTIVE)->where('deleted_at', '=', NULL)->skip($skip)->take($take)->get();

        /* promoted items start*/
        $userGet = User::where('role', BUSINESS_ROLE)->get()->all();
        $promoted_items_count = BoostItem::where([['deleted_at', '=', NULL]])->orderBy('created_at', 'DESC')->where('is_paid', '1')->get()->count();
        $itemsList = BoostItem::where([['deleted_at', '=', NULL]])->orderBy('created_at', 'DESC')->where('is_paid', '1')->get()->take(16)->toArray();

        $itemArray = [];

        foreach ($itemsList as $key => $value) {
            $itemArray[$key] = $value;
            $items = Item::where('id', $value['item_id'])->where('status', '=', '1')->first();
            $itemArray[$key]['item'] = $items;

            $itemsImage = ItemsImages::where('item_id', $items['id'])->first();
            $itemArray[$key]['item_pictures'] = $itemsImage;

            $condition = Condition::where('id', $items['condition_id'])->first();
            $itemArray[$key]['condition'] = $condition;

            $brand = Brand::where('id', $items['brand_id'])->first();
            $itemArray[$key]['brand'] = $brand;

            $store = Store::where('id', $items['store_id'])->first();
            $itemArray[$key]['store'] = $store;

            $boostItem = BoostItem::where('item_id', $items['id'])->where('is_paid', '1')->first();
            $itemArray[$key]['boostItem'] = $boostItem;

            $wishlist = Wishlist::where('user_id', $items['user_id'])->where('item_id', $items['id'])->first();
            $itemArray[$key]['wishlist'] = $wishlist;
            
            $user = User::where('id', $value['user_id'])->first();
            $itemArray[$key]['user'] = $user;

            $userCity = $user->city_id;
            $getCity = City::where('id', $userCity)->first();
            $itemArray[$key]['city'] = $getCity;

            $avg = ReviewRatings::where('item_id', $value['id']);
            $totalReviewAvg = $avg->avg('rating_star');
            $totalReviewAvg =  number_format($totalReviewAvg, 2);
            $itemArray[$key]['totalReviewAvg'] = $totalReviewAvg;

            $reviewRatings = ReviewRatings::where('item_id', $value['id'])->count();
            $itemArray[$key]['reviewRatings'] = $reviewRatings;

        }

        /* promoted items end*/


        /* new items start*/
        $conditionArr = Condition::where('name', NEW_ITEMS)->first();
        $newitemsConId = $conditionArr->id;
        $newItemsList = Item::where([["condition_id", "=", $newitemsConId], ['deleted_at', '=', NULL]])
            ->where('status', '=', '1')
            ->orderBy('created_at', 'DESC')->get()->take(12)->toArray();

        $newItemsList_count = Item::where([["condition_id", "=", $newitemsConId], ['deleted_at', '=', NULL]])
            ->where('status', '=', '1')
            ->orderBy('created_at', 'DESC')->get()->count();

        $newItemsListArray = [];
        foreach ($newItemsList as $key => $value) {
            $newItemsListArray[$key] = $value;
            $itemsImage = ItemsImages::where('item_id', $value['id'])->first();
            $newItemsListArray[$key]['item_pictures'] = $itemsImage;

            $condition = Condition::where('id', $value['condition_id'])->first();
            $newItemsListArray[$key]['condition'] = $condition;

            $brand = Brand::where('id', $value['brand_id'])->first();
            $newItemsListArray[$key]['brand'] = $brand;

            $store = Store::where('id', $value['store_id'])->first();
            $newItemsListArray[$key]['store'] = $store;

            $boostItem = BoostItem::where('item_id', $value['id'])->where('is_paid', '1')->first();
            $newItemsListArray[$key]['boostItem'] = $boostItem;

            $wishlist = Wishlist::where('user_id', $value['user_id'])->where('item_id', $value['id'])->first();
            $newItemsListArray[$key]['wishlist'] = $wishlist;

            $user = User::where('id', $value['user_id'])->first();
            $newItemsListArray[$key]['user'] = $user;

            $userCity = $user->city_id;
            $getCity = City::where('id', $userCity)->first();
            $newItemsListArray[$key]['city'] = $getCity;

            $avg = ReviewRatings::where('item_id', $value['id']);
            $totalReviewAvg = $avg->avg('rating_star');
            $totalReviewAvg =  number_format($totalReviewAvg, 2);
            $newItemsListArray[$key]['totalReviewAvg'] = $totalReviewAvg;

            $reviewRatings = ReviewRatings::where('item_id', $value['id'])->count();
            $newItemsListArray[$key]['reviewRatings'] = $reviewRatings;


        }
        /* new items end*/

        /* Used items start*/
        $usedItemsId = Condition::where('name', USED_ITEMS)->first();
        $useditemsConId = $usedItemsId->id;
        $usedItemsList = Item::where([["condition_id", "=", $useditemsConId], ['deleted_at', '=', NULL]])
            ->where('status', '=', '1')
            ->orderBy('created_at', 'DESC')->get()->take(12)->toArray();

        $usedItemsList_count = Item::where([["condition_id", "=", $useditemsConId], ['deleted_at', '=', NULL]])
            ->where('status', '=', '1')
            ->orderBy('created_at', 'DESC')->get()->count();

        $usedItemsListArray = [];
        foreach ($usedItemsList as $key => $value) {
            $usedItemsListArray[$key] = $value;
            $itemsImage = ItemsImages::where('item_id', $value['id'])->first();
            $usedItemsListArray[$key]['item_pictures'] = $itemsImage;

            $condition = Condition::where('id', $value['condition_id'])->first();
            $usedItemsListArray[$key]['condition'] = $condition;

            $brand = Brand::where('id', $value['brand_id'])->first();
            $usedItemsListArray[$key]['brand'] = $brand;

            $store = Store::where('id', $value['store_id'])->first();
            $usedItemsListArray[$key]['store'] = $store;

            $boostItem = BoostItem::where('item_id', $value['id'])->where('is_paid', '1')->first();
            $usedItemsListArray[$key]['boostItem'] = $boostItem;

            $wishlist = Wishlist::where('user_id', $value['user_id'])->where('item_id', $value['id'])->first();
            $usedItemsListArray[$key]['wishlist'] = $wishlist;

            $user = User::where('id', $value['user_id'])->first();
            $usedItemsListArray[$key]['user'] = $user;

            $userCity = $user->city_id;
            $getCity = City::where('id', $userCity)->first();
            $usedItemsListArray[$key]['city'] = $getCity;

            $avg = ReviewRatings::where('item_id', $value['id']);
            $totalReviewAvg = $avg->avg('rating_star');
            $totalReviewAvg =  number_format($totalReviewAvg, 2);
            $usedItemsListArray[$key]['totalReviewAvg'] = $totalReviewAvg;

            $reviewRatings = ReviewRatings::where('item_id', $value['id'])->count();
            $usedItemsListArray[$key]['reviewRatings'] = $reviewRatings;
        }
        /* Used items end*/

        /* unused items start*/
        foreach ($userGet as $key => $value) {
            $unusedItemsId = Condition::where('name', UNUSED_ITEMS)->first();
            $unuseditemsConId = $unusedItemsId->id;
            $unusedItemsList = Item::where([['condition_id', '=', $unuseditemsConId], ['deleted_at', '=', NULL]])
                ->where('status', '=', '1')
                ->orderBy('created_at', 'DESC')->get()->take(12)->toArray();

            $unusedItemsList_count = Item::where([['condition_id', '=', $unuseditemsConId], ['deleted_at', '=', NULL]])
                ->where('status', '=', '1')
                ->orderBy('created_at', 'DESC')->get()->count();

            $unusedItemsListArray = [];
            foreach ($unusedItemsList as $key => $value) {
                $unusedItemsListArray[$key] = $value;
                $itemsImage = ItemsImages::where('item_id', $value['id'])->first();
                $unusedItemsListArray[$key]['item_pictures'] = $itemsImage;

                $condition = Condition::where('id', $value['condition_id'])->first();
                $unusedItemsListArray[$key]['condition'] = $condition;

                $brand = Brand::where('id', $value['brand_id'])->first();
                $unusedItemsListArray[$key]['brand'] = $brand;

                $store = Store::where('id', $value['store_id'])->first();
                $unusedItemsListArray[$key]['store'] = $store;

                $boostItem = BoostItem::where('item_id', $value['id'])->where('is_paid', '1')->first();
                $unusedItemsListArray[$key]['boostItem'] = $boostItem;

                $wishlist1 = Wishlist::where('item_id', $value['id'])->first();
                if (!empty($wishlist1)) {
                    $user_whislist = $wishlist1->user_id;
                    $wishlist = Wishlist::where('user_id', $user_whislist)->where('item_id', $value['id'])->first();
                }
                $unusedItemsListArray[$key]['wishlist'] = $wishlist;

                $user = User::where('id', $value['user_id'])->first();
                $unusedItemsListArray[$key]['user'] = $user;

                $userCity = $user->city_id;
                $getCity = City::where('id', $userCity)->first();
                $unusedItemsListArray[$key]['city'] = $getCity;

                $avg = ReviewRatings::where('item_id', $value['id']);
                $totalReviewAvg = $avg->avg('rating_star');
                $totalReviewAvg =  number_format($totalReviewAvg, 2);
                $unusedItemsListArray[$key]['totalReviewAvg'] = $totalReviewAvg;
    
                $reviewRatings = ReviewRatings::where('item_id', $value['id'])->count();
                $unusedItemsListArray[$key]['reviewRatings'] = $reviewRatings;
            }
        }
        /* unused items end*/


        /* Top deals items start*/
        /*
        foreach($userGet as $key => $value){
            $topDealsItems = Condition::where('name', TOP_DEALS_ITEMS)->first();
            $topDealsitemsConId = $topDealsItems->id;
            $topDealsItemsList = Item::where([['user_id', '=', $value->id],['condition_id','=',$topDealsitemsConId],['deleted_at','=', NULL]])->orderBy('created_at','DESC')
            ->get()->take(4)->toArray();
        }

        $topDealsItemsArray = [];
        foreach($topDealsItemsList as $key => $value)
        {
            $topDealsItemsArray[$key] = $value;
            $itemsImage = ItemsImages::where('item_id',$value['id'])->first();
            $topDealsItemsArray[$key]['item_pictures'] = $itemsImage;

            $condition = Condition::where('id',$value['condition_id'])->first();
            $topDealsItemsArray[$key]['condition'] = $condition;

            $brand = Brand::where('id',$value['brand_id'])->first();
            $topDealsItemsArray[$key]['brand'] = $brand;

            $store = Store::where('id',$value['store_id'])->first();
            $topDealsItemsArray[$key]['store'] = $store;

            $boostItem = BoostItem::where('item_id',$value['id'])->first();
            $topDealsItemsArray[$key]['boostItem'] = $boostItem;

            $wishlist = Wishlist::where('item_id',$value['id'])->first();
            $topDealsItemsArray[$key]['wishlist'] = $wishlist;
        }
        */
        /* Top deals items end*/


        /* Trending Items start*/
        /*
        $trendingItemsList = Item::where([['user_id', '=', $value->id],['condition_id','=',$unuseditemsConId],['deleted_at','=', NULL]])->orderBy('created_at','DESC')
        ->get()->take(4)->toArray();
     
        $trendingItemsArray = [];
        foreach($trendingItemsList as $key => $value)
        {
            $trendingItemsArray[$key] = $value;
            $itemsImage = ItemsImages::where('item_id',$value['id'])->first();
            $trendingItemsArray[$key]['item_pictures'] = $itemsImage;

            $condition = Condition::where('id',$value['condition_id'])->first();
            $trendingItemsArray[$key]['condition'] = $condition;

            $brand = Brand::where('id',$value['brand_id'])->first();
            $trendingItemsArray[$key]['brand'] = $brand;

            $store = Store::where('id',$value['store_id'])->first();
            $trendingItemsArray[$key]['store'] = $store;

            $boostItem = BoostItem::where('item_id',$value['id'])->first();
            $trendingItemsArray[$key]['boostItem'] = $boostItem;

            $wishlist = Wishlist::where('item_id',$value['id'])->first();
            $trendingItemsArray[$key]['wishlist'] = $wishlist;
        }
        */
        /* Trending Items end*/
        $recommendedItemsList = Item::where([['deleted_at', '=', NULL]])
            ->where('status', '=', '1')
            ->orderBy('created_at', 'DESC')->get()->take(12)->toArray();

        $recommendedItemsList_count = Item::where([['deleted_at', '=', NULL]])
            ->where('status', '=', '1')
            ->orderBy('created_at', 'DESC')->get()->count();


        $recommendedItemsArray = [];
        foreach ($recommendedItemsList as $key => $value) {
            $recommendedItemsArray[$key] = $value;
            $itemsImage = ItemsImages::where('item_id', $value['id'])->first();
            $recommendedItemsArray[$key]['item_pictures'] = $itemsImage;

            $condition = Condition::where('id', $value['condition_id'])->first();
            $recommendedItemsArray[$key]['condition'] = $condition;

            $brand = Brand::where('id', $value['brand_id'])->first();
            $recommendedItemsArray[$key]['brand'] = $brand;

            $store = Store::where('id', $value['store_id'])->first();
            $recommendedItemsArray[$key]['store'] = $store;

            $boostItem = BoostItem::where('item_id', $value['id'])->where('is_paid', '1')->first();
            $recommendedItemsArray[$key]['boostItem'] = $boostItem;

            $wishlist = Wishlist::where('user_id', $value['user_id'])->where('item_id', $value['id'])->first();
            $recommendedItemsArray[$key]['wishlist'] = $wishlist;

            $user = User::where('id', $value['user_id'])->first();
            $recommendedItemsArray[$key]['user'] = $user;

            $userCity = $user->city_id;
            $getCity = City::where('id', $userCity)->first();
            $recommendedItemsArray[$key]['city'] = $getCity;

            $avg = ReviewRatings::where('item_id', $value['id']);
            $totalReviewAvg = $avg->avg('rating_star');
            $totalReviewAvg =  number_format($totalReviewAvg, 2);
            $recommendedItemsArray[$key]['totalReviewAvg'] = $totalReviewAvg;

            $reviewRatings = ReviewRatings::where('item_id', $value['id'])->count();
            $recommendedItemsArray[$key]['reviewRatings'] = $reviewRatings;
            
        }

        $general_data = WhyUse::where(['status' => TRUE, 'ar_status' => TRUE,])->get();
        $wholesale_general_data = WholesaleGeneral::where(['status' => TRUE, 'ar_status' => TRUE,])->get();
        $short_banner_data = ShortBanner::where(['status' => TRUE, 'ar_status' => TRUE,])->limit('2')->orderBy('id', 'DESC')->get();


        /* Recommended items end */
        return view('frontend.business.layouts.b_master', compact(

            'storyList',
            'story_price',
            'sliderImage',
            'category',
            'LoginuserStory',
            'categorySingle',
            'Story',
            'AllCategoryCount',
            'itemArray',
            'newItemsListArray',
            'usedItemsListArray',
            'unusedItemsListArray',
            // 'topDealsItemsArray',
            // 'trendingItemsArray',
            'recommendedItemsArray',
            'general_data',
            'wholesale_general_data',
            'short_banner_data',

            'promoted_items_count',
            'newItemsList_count',
            'usedItemsList_count',
            'unusedItemsList_count',
            'recommendedItemsList_count',

        ));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('frontend.users.site.index')->with('success', 'Your logged out successfully!');
        // return redirect()->back()->with('success', 'Your logged out successfully!');
    }


    public function story(Request $request)
    {

        $sliderImage = Slider::where('status', ACTIVE)->where('deleted_at', '=', NULL)->get();
        $category =  Category::where('status', ACTIVE)->where('deleted_at', '=', NULL)->limit(7)->get();

        $AllCategoryCount =  Category::where('status', ACTIVE)->where('deleted_at', '=', NULL)->count();

        $take = $AllCategoryCount - count($category);
        $skip = 7;
        $categorySingle =  Category::where('status', ACTIVE)->where('deleted_at', '=', NULL)->skip($skip)->take($take)->get();

        $LoginuserStory =  UserStory::select('user_id')->groupBy('user_id')->where('deleted_at', '=', NULL)->get();
        $user = User::where('role', BUSINESS_ROLE)->get();
        $userArray = array();
        foreach ($user as $usr) {
            $userArray[] = $usr->id;
        }

        $StoryAll = UserStory::select('user_id')->where('deleted_at', '=', NULL)->whereIn('user_id', $userArray)->groupBy('user_id')->get();
        $CheckUser = array();
        foreach ($StoryAll as $key => $tr) {
            $CheckUser[] = $tr['user_id'];
        }

        $Story = array();
        foreach ($CheckUser as $key => $value) {
            $StoryAll = UserStory::with('user', 'category')->where('deleted_at', '=', NULL)->where('user_id', $value)->get()->toArray();
            $Story[] = $StoryAll;
        }
        $storyList = Category::where('status', ACTIVE)->where('deleted_at', '=', NULL)->skip($skip)->take($take)->get();

        return view('frontend.business.layouts.story', compact('sliderImage', 'category', 'LoginuserStory', 'categorySingle', 'storyList', 'AllCategoryCount'));
    }

    public function story_payment(Request $request, $id){  
        $storyPriceId = $id;
        $storyPriceIdDetails = UserStory::where('id', $storyPriceId)->first();
        $story_price_data = StoryPrice::where('status','1')->first();
       // $story_price = $story_price_data['story_price'];
        $monthArray = array(
            "1" => "January", "2" => "February", "3" => "March", "4" => "April",
            "5" => "May", "6" => "June", "7" => "July", "8" => "August",
            "9" => "September", "10" => "October", "11" => "November", "12" => "December",
            );
        return view('frontend.business.layouts.story_payment', compact('storyPriceIdDetails','storyPriceId','monthArray'));
    }

    public function payment_successfull(Request $request)
    {
        $save_token = new cardDetails();
        $save_token->user_id  = Auth::id();
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

        $user = User::where('id', Auth::id())->first();
        $user_id = $user->id;
        $city = $user->city_id;
        $storyPriceIdDetails = UserStory::where('id', $request->storyPriceId)->first();
        $story_price = $storyPriceIdDetails->product_price;
        $story_priceID = $storyPriceIdDetails->id;
        
        $card_details = cardDetails::where('user_id', Auth::id())->Latest('id')->first();
        
        $cityDetails = City::where('id',$city)->first();
        
        $phone = new Phone();
        $phone->country_code = $user->phone_code;
        $phone->number = $user->phone_number;
        
        $address = new Address();
        $address->address_line1 = 'NULL';
        $address->address_line2 = 'NULL';
        $address->city = $cityDetails->name;
        // $address->state = "London";
        $address->zip = 'NULL';
        $address->country = checkoutCountry::$GB;
        
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
        $customerRequest->name =  $user->first_name;
        
        $identification = new Identification();
        $identification->issuing_country = checkoutCountry::$GT;
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
        $request->reference = "Business Story Payment";
        $request->amount = $story_price;
        $request->currency = Currency::$USD;
        $request->customer = $customerRequest;
        $request->sender = $paymentIndividualSender;
        
        try {
            $response = $api->getPaymentsClient()->requestPayment($request);
            
            $save_checkout_details = new CheckOutPayment();
            $save_checkout_details->user_id  = Auth::id();
            $save_checkout_details->item_id  = $story_priceID;
            $save_checkout_details->payment_id  = $response['id'];
            $save_checkout_details->action_id  = $response['action_id'];
            $save_checkout_details->amount  = $response['amount'];
            $save_checkout_details->status  = $response['approved'];
            $save_checkout_details->currency  = $response['currency'];
            $save_checkout_details->type  = 'story';
            $save_checkout_details->save();
            
            $updateId = UserStory::where('id', $story_priceID)->first();
            $updateId->is_paid = '1';
            $updateId->save();
            
            return redirect()->route('frontend.business.home.index')->with('success', __('Payment SuccessFull'));
        } catch (CheckoutApiException $e) {
            // API error
            $error_details = $e->error_details;
            return redirect()->back()->with('danger', __('Payment UnsuccessFull'));
            $http_status_code = isset($e->http_metadata) ? $e->http_metadata->getStatusCode() : null;
        } catch (CheckoutAuthorizationException $e) {
            // Bad Invalid authorization
        }
    }

    public function storeSupportsMessage(Request $request)
    {
        $message_store = new CustomerSupport;
        $message_store->user_id  = Auth::id();
        $message_store->subject  = $request->subject;
        $message_store->message  = $request->query_message;
        $message_store->status  = TRUE;
        $message_store->save();
        return redirect()->route('frontend.business.home.index')->with('success', __('messages.support.success.message_send_successfully'));
    }
}
