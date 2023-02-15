<?php

namespace App\Http\Controllers\Frontend\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
use Illuminate\Support\Facades\Hash;
use App\Mail\ForgotuserEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Mail;
use DateTime;
use App\Models\{
    User,
    Slider,
    Category,
    PasswordReset,
    UserOtp,
    UsersBannerImage,
    UserStory,
    AccessToken,
    Stories,
    Item,
    ItemsImages,
    Condition,
    Brand,
    Store,
    BoostItem,
    cardDetails,
    CheckOutPayment,
    City,
    General,
    WhyUse,
    ShortBanner,
    WholesaleGeneral,
    Wishlist,
    Country,
    StoryPrice,
    UserProfile,
    ReviewRatings,
    Subscription,
    CustomerSupport,
    Orders,
};
use App\Jobs\{
    PasswordresetEmail,
    ResetOtpEmail,
    SubscribeEmail,
    SendEmailJobSubscribe,
};

class SiteController extends Controller
{

    public function index()
    {
        try {
            \DB::connection()->getPdo();

            if (\DB::connection()->getDatabaseName()) {
            } else {

                $data  = "Could not find the database.";
                return view('frontend.users.layouts.db_connect_fail', compact('data'));
            }
        } catch (\Exception $e) {

            $data  = "Could not open connection to database server.";
            return view('frontend.users.layouts.db_connect_fail', compact('data'));
        }

        $sliderImage = Slider::where('status', ACTIVE)->where('deleted_at', '=', NULL)->get();

        $category =  Category::where('status', ACTIVE)->where('deleted_at', '=', NULL)->limit(7)->get();

        $AllCategoryCount =  Category::where('status', ACTIVE)->where('deleted_at', '=', NULL)->count();

        $take = $AllCategoryCount - count($category);
        $skip = 7;
        $categorySingle =  Category::where('status', ACTIVE)->where('deleted_at', '=', NULL)->skip($skip)->take($take)->get();

        if (Auth::check()) {
            $story_price_data = StoryPrice::select('story_price')->pluck('story_price');
            $story_price = '';
            if(!empty($story_price_data[0])){
                $story_price = $story_price_data[0];
            }
            $LoginuserStory =  UserStory::select('user_id')->groupBy('user_id')
            //->where('user_id', '=', Auth::user()->id)
            ->where('is_paid', '=', '1')
            ->where('deleted_at', '=', NULL)->get();
            $Story = UserStory::where('deleted_at', '=', NULL)
            ->where('is_paid', '=', '1')->get();
        } else {
            $story_price_data = StoryPrice::select('story_price')->pluck('story_price');
            $story_price = '';
            if(!empty($story_price_data[0])){
                $story_price = $story_price_data[0];
            }
            $LoginuserStory =  UserStory::select('user_id')->groupBy('user_id')->where('deleted_at', '=', NULL)->where('is_paid', '=', '1')->get();
            $user = User::where('role', USER_ROLE)->get();
            $userArray = array();
            foreach ($user as $usr) {
                $userArray[] = $usr->id;
            }
            $StoryAll = UserStory::select('user_id')->where('deleted_at', '=', NULL)->where('is_paid', '=', '1')->groupBy('user_id')->get();

            $CheckUser = array();
            foreach ($StoryAll as $key => $tr) {
                $CheckUser[] = $tr['user_id'];
            }

            $Story = array();
            foreach ($CheckUser as $key => $value) {
                $StoryAll = UserStory::with('user', 'category')->where('deleted_at', '=', NULL)->where('is_paid', '=', '1')->where('user_id', $value)->get()->toArray();
                $Story[] = $StoryAll;
            }
        }

        /* promoted items start*/
        $userGet = User::where('role', USER_ROLE)->get()->all();
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

            $boostItem = BoostItem::where('item_id', $items['id'])->where('is_paid', TRUE)->first();
            $itemArray[$key]['boostItem'] = $boostItem;

            $wishlist = Wishlist::where('user_id', $items['user_id'])->where('item_id', $items['id'])->first();
            $itemArray[$key]['wishlist'] = $wishlist;

            $user = User::where('id', $value['user_id'])->first();
            $itemArray[$key]['user'] = $user;

            $userCity = $user->city_id;
            $getCity = City::where('id', $userCity)->first();
            $itemArray[$key]['city'] = $getCity;

            $orders = Orders::where('item_id', $value['id'])->first();
            $itemArray[$key]['orders'] = $orders;

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
        return view(
            'frontend.users.layouts.home',
            compact(
                'sliderImage',
                'story_price',
                'category',
                'LoginuserStory',
                'categorySingle',
                'Story',
                'AllCategoryCount',
                'itemArray',
                'newItemsListArray',
                'usedItemsListArray',
                'unusedItemsListArray',
                'general_data',
                'wholesale_general_data',
                'short_banner_data',
                'promoted_items_count',
                'newItemsList_count',
                'usedItemsList_count',
                'unusedItemsList_count',
                'recommendedItemsList_count',

            )
        );
    }

    public function register(Request $request) 
    {

        $checkEmail = User::where('email', $request->reg_email)->count();

        if ($checkEmail > 0) {
            return redirect()->back()->with('danger', 'Entered Email already used by another User');
        }
        $new_user = new User;

        $image = $request->profile_image;
        if ($request->has('profile_image')) {
            $imagename = $request->profile_image;
            $destination = public_path('assets/users');
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $name = 'images' . time();
            $imageName = $name . '.' . $image->getClientOriginalExtension();
            $image->move($destination, $imageName);
        } else {
            $imageName = null;
        }

        $new_user->profile_picture = $imageName;
        $new_user->first_name = $request->first_name;
        $new_user->last_name = $request->last_name;
        $new_user->username = $request->user_name;
        $new_user->email = $request->reg_email;
        $new_user->phone_code = $request->phone_code;
        $new_user->phone_number = $request->phone_number;
        $new_user->password = Hash::make($request->password);
        $new_user->status = 0;
        $new_user->country_id = $request->country_id;
        $new_user->state_id = $request->state_id;
        $new_user->city_id = $request->city_id;
        $new_user->role = USER_ROLE;
        $new_user->save();

        

        return response()->json(['code' => 200, 'success' => Lang::get('frontend-messages.Register.successmsg.msg')], 200);
    }

    public function login(Request $request)
    {

        $email = $request->email;
        $username = $request->username;
        $password = $request->password;

        $user = User::where('username', $username)->orWhere('email', $username)->first();
        if (!empty($user)) {

            $check_password = Hash::check($password, $user->password);

            if ($check_password) {
                if ($user->role == USER_ROLE) {
                    $role = USER_ROLE;

                    if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
                        //user sent their email 
                        Auth::attempt(['email' => $username, 'password' => $password]);
                        return response()->json(['code' => 200, 'success' => Lang::get('frontend-messages.LoginUser.successmsg.msg'), 'auth' => $role], 200);
                    } else {
                        //they sent their username instead 
                        Auth::attempt(['username' => $username, 'password' => $password]);
                        return response()->json(['code' => 200, 'success' => Lang::get('frontend-messages.LoginUser.successmsg.msg'),  'auth' => $role], 200);
                    }
                }
                if ($user->role == BUSINESS_ROLE) {
                    $role = BUSINESS_ROLE;
                    if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
                        //user sent their email 
                        Auth::attempt(['email' => $username, 'password' => $password]);
                        return response()->json(['code' => 200, 'success' => Lang::get('frontend-messages.LoginUser.successmsg.msg'), 'auth' => $role], 200);
                    } else {
                        //they sent their username instead 
                        Auth::attempt(['username' => $username, 'password' => $password]);
                        return response()->json(['code' => 200, 'success' => Lang::get('frontend-messages.LoginUser.successmsg.msg'), 'auth' => $role], 200);
                    }
                }
                if($user->role == STORE_ROLE){
                    $role = STORE_ROLE;
                    if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
                        Auth::attempt(['email' => $username, 'password' => $password]);
                        return response()->json(['code' => 200, 'success' => Lang::get('frontend-messages.LoginUser.successmsg.msg'), 'auth' => $role], 200);
                    }else {
                        //they sent their username instead 
                        Auth::attempt(['username' => $username, 'password' => $password]);
                        return response()->json(['code' => 200, 'success' => Lang::get('frontend-messages.LoginUser.successmsg.msg'), 'auth' => $role], 200);
                    }
                }
            }
        }
    }

    public function users_login(Request $request)
    {
        
         $validatedRequestData = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username' => 'required|string|max:20|unique:users',
            // 'username' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $email = $request->email;
        $username = $request->username;
        $password = $request->password;

        $user = User::where('username', $username)->orWhere('email', $username)->first();
        
        if(!empty($user)){
            
            $check_password = Hash::check($password, $user->password);

            if($check_password){

                if ($user->role == USER_ROLE) {

                    if (filter_var($username, FILTER_VALIDATE_EMAIL)) {

                        Auth::attempt(['email' => $username, 'password' => $password]);
                        return redirect()->route('frontend.users.site.index')->with('success','You are login successfully.');

                    } else {

                        Auth::attempt(['username' => $username, 'password' => $password]);
                        return redirect()->route('frontend.users.site.index')->with('success','You are login successfully.');
                    }
                }
                else if($user->role == BUSINESS_ROLE){

                    if (filter_var($username, FILTER_VALIDATE_EMAIL)) {

                        Auth::attempt(['email' => $username, 'password' => $password]);
                        return redirect()->route('frontend.business.home.index')->with('success','You are login successfully.');

                    } else {
                        Auth::attempt(['username' => $username, 'password' => $password]);
                        return redirect()->route('frontend.business.home.index')->with('success','You are login successfully.');

                    }
                    
                } else if($user->role == STORE_ROLE){

                    if (filter_var($username, FILTER_VALIDATE_EMAIL)) {

                        Auth::attempt(['email' => $username, 'password' => $password]);
                        return redirect()->route('frontend.store.home.index')->with('success','You are login successfully.');

                    }else {

                        Auth::attempt(['username' => $username, 'password' => $password]);
                        return redirect()->route('frontend.store.home.index')->with('success','You are login successfully.');

                    }

                }
                else {

                    return redirect()->back()->with('error','Please enter valid credentials');
                }
            } else {

                return redirect()->back()->with('error','Please enter valid credentials');
            }
        } else {

            return redirect()->back()->with('error','Please enter valid credentials');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('frontend.users.site.index')->with('success', 'Your logged out successfully!');
        //return redirect()->back()->with('success','Your logged out successfully!');
    }

    public function forgot_password(Request $request)
    {
        //p($request->email);
        $email = $request->email;
        $userUnique = User::where('email', $email)->first();

        if (!empty($userUnique)) {
            if ($userUnique->role == 3) {
                $randomNumber = random_int(10000, 99999);
                PasswordReset::where('email', $email)->delete();
                $token = generateRandomToken(40);
                $reset = new PasswordReset;
                $reset->email = $email;
                $reset->token = $token;
                $reset->save();

                $userOTP = new UserOtp;
                $userOTP->token = $reset->token;
                $userOTP->OTP = $randomNumber;
                $userOTP->save();

                $emailJobs = new PasswordresetEmail($userUnique, $userOTP);
                dispatch($emailJobs);
                return response()->json(['code' => 200, 'success' => Lang::get('frontend-messages.Forgot.success.msg')], 200);
            }

            if ($userUnique->role == 4) {
                $randomNumber = random_int(10000, 99999);
                PasswordReset::where('email', $email)->delete();
                $token = generateRandomToken(40);
                $reset = new PasswordReset;
                $reset->email = $email;
                $reset->token = $token;
                $reset->save();

                $userOTP = new UserOtp;
                $userOTP->token = $reset->token;
                $userOTP->OTP = $randomNumber;
                $userOTP->save();

                $emailJobs = new PasswordresetEmail($userUnique, $userOTP);
                dispatch($emailJobs);
                return response()->json(['code' => 200, 'success' => Lang::get('frontend-messages.Forgot.success.msg')], 200);
            }
        }
    }

    public function verify_user_otp(Request $request)
    {
        $checkToken = $request->token;
        $data = [
            'otp1' => $request['otp1'],
            'otp2' => $request['otp2'],
            'otp3' => $request['otp3'],
            'otp4' => $request['otp4'],
            'otp5' => $request['otp5'],
        ];
        $verifyotp =  implode("", $data);
        $verification = UserOtp::where('token', $checkToken)->first();
        if (isset($verification->token) && !empty($verification->token)) {
            if ($verification->OTP == $verifyotp) {
                return response()->json(['code' => 200, 'success' => Lang::get('frontend-messages.Verification.success.msg')], 200);
            } else {
                return response()->json(['error' => Lang::get('frontend-messages.Verification.errormsg.msg')]);
            }
        } else {
            return response()->json(['error' => Lang::get('frontend-messages.Verification.errormsg.msg')]);
        }
    }

    public function resend_otp(Request $request)
    {
        $verification = PasswordReset::where('token', $request->token)->first();
        if (isset($verification->token) && !empty($verification->token)) {
            $randomNumber = random_int(10000, 99999);
            $userID = UserOtp::where('token', $request->token)->first();
            $user = UserOtp::find($userID->id);
            $user->OTP = $randomNumber;
            $user->save();
            $UserDetail = PasswordReset::where('token', $request->token)->first();
            if ($UserDetail->token) {
                if (isset($UserDetail) && !empty($UserDetail)) {
                    $user =  User::where('email', $UserDetail->email)->first();
                }
                $resendOtp = new ResetOtpEmail($user, $randomNumber);
                dispatch($resendOtp);
                return response()->json(['code' => 200, 'success' => Lang::get('frontend-messages.ResendOtp.success.msg')], 200);
            }
        }
    }

    public function reset_password(Request $request)
    {

        $userFetch = PasswordReset::where('token', $request->token)->first();
        if (isset($userFetch)) {
            $user = User::where('email', $userFetch->email)->first();
        } else {
            return response()->json(['error' => 'User not found']);
        }
        if (!empty($user)) {
            $user->password = Hash::make($request->reset_password);
            $user->save();
            PasswordReset::where('email', $user->email)->delete();
            return response()->json(['code' => 200, 'success' => Lang::get('frontend-messages.ResetPassword.success.msg')], 200);
        }
    }

    public function resetPassword(Request $request)
    {   
        $userFetch = PasswordReset::where('token', $request->token)->first();
        if (isset($userFetch)) {
            $user = User::where('email', $userFetch->email)->first();
        } else {
            return redirect()->route('frontend.users.site.index')->with('success','User not found');

        }
        if (!empty($user)) {
            $user->password = Hash::make($request->reset_password);
            $user->save();
            PasswordReset::where('email', $user->email)->delete();
            return redirect()->route('frontend.users.site.index')->with('success','Password reset successfully.');
        }
    }

    public function add_user_story(Request $request)
    {
        $usetStory = new UserStory;
        $image = $request->file;

        if ($request->has('file')) {

            $imagename = $request->profile_image;

            $removeImage = public_path() . "\assets\stories" . "\\" . $imagename;
            if (is_file($removeImage)) {
                unlink($removeImage);
            }
            $destination = public_path('assets/stories');
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $name = 'images' . time();
            $imageName = $name . '.' . $image->getClientOriginalExtension();

            $image->move($destination, $imageName);
        } else {
            $imageName = null;
        }
        $usetStory->user_id = Auth::user()->id;
        $usetStory->video_or_image_file = $imageName;
        $usetStory->product_name = $request->product_name;
        $usetStory->category_id = $request->category_id;
        $usetStory->story_description = $request->story_description;
        $usetStory->product_price = $request->story_price;
        $usetStory->store_location = $request->store_location;
        $usetStory->save();

        return response()->json(['code' => 200, 'success' => Lang::get('frontend-messages.UserStory.success.msg'), 'response' => $usetStory], 200);
    }

    public function subscribe_tejarh(Request $request)
    {
        $email = $request->email;
        $first_name = $request->first_name;

        $userUnique = User::where('email', $email)->first();
        if (!empty($userUnique)) {
            
            $emailJobs = new SendEmailJobSubscribe($userUnique, $first_name);
            dispatch($emailJobs);

            $message = new Subscription;
            $message->heading_title = NULL;
            $message->username = $first_name;
            $message->email = $email;
            $message->subject = NULL;
            $message->message_description = NULL;
            $message->status =true;
            $message->save();

            return redirect()->route('frontend.users.site.index')->with('success', 'Successfully Subscribe!');
           
        }else{

            return redirect()->route('frontend.users.site.index')->with('success', 'Entered details not found');  
        }
    }

    public function home_search_bar(Request $request)
    {

        if (!empty($request->search_data)) {
            $res = Category::where('category_name', 'Like', '%' . $request->search_data . '%')->first();
        };
        return response()->json($res);
    }

    public function story_payment(Request $request, $id){  
        $storyPriceId = $id;
        $storyPriceIdDetails = UserStory::where('id', $storyPriceId)->first();
        $monthArray = array(
            "1" => "January", "2" => "February", "3" => "March", "4" => "April",
            "5" => "May", "6" => "June", "7" => "July", "8" => "August",
            "9" => "September", "10" => "October", "11" => "November", "12" => "December",
            );
        return view('frontend.users.layouts.story_payment', compact('storyPriceIdDetails','storyPriceId','monthArray'));
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
        $request->reference = "User Story Payment";
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
            
            return redirect()->route('frontend.users.site.index')->with('success', __('Payment SuccessFull'));
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
        return redirect()->route('frontend.users.site.index')->with('success', __('messages.support.success.message_send_successfully'));
    }

    public function checkUsernameEmail(Request $request)
    {
        $input = $request->only(['username']);

        $request_data = $request->validate([
            'username' => 'required|string|max:20|unique:users',

        ], [
            'username.required' => Lang::get('email'),
        ]);

        $validator = Validator::make($input, $request_data);

        // json is null
        if ($validator->fails()) {
            $errors = json_decode(json_encode($validator->errors()), 1);
            return response()->json([
                'success' => false,
                'message' => array_reduce($errors, 'array_merge', array()),
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'The email is available'
            ]);
        }
    }

}
