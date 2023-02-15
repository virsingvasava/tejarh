<?php

namespace App\Http\Controllers\Frontend\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\ItemsImages;
use App\Models\BoostItem;
use App\Models\Condition;
use App\Models\Category;
use App\Models\Stories;
use App\Models\Brand;
use App\Models\cardDetails;
use App\Models\Cart;
use App\Models\CheckOutPayment;
use App\Models\Store;
use App\Models\City;
use App\Models\Item;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\UsersBannerImage;
use App\Models\UsersDeliveryAddress;
use App\Models\CmsPage;
use App\Models\HoldAnOffer;
use App\Models\Inventory;
use App\Models\MakeAnOffer;
use App\Models\OrderDeliveryAddress;
use App\Models\OrderDeliveryCompany;
use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\ShippingDeliveryCompany;
use App\Models\State;
use App\Models\stock;
use App\Models\StoreDistance;
use App\Models\StoryPrice;
use App\Models\UserFollowers;
use App\Models\UserLike;
use App\Models\UserStory;
use App\Models\SellerReviewRatings;
use Lang;

use Checkout\CheckoutApiException;
use Checkout\CheckoutAuthorizationException;
use Checkout\CheckoutSdk;
use Checkout\Common\Address;
use Checkout\Common\Country as checkoutCountry;
use Checkout\Common\Currency;
use Checkout\Common\CustomerRequest;
use Checkout\Common\Phone;
use Checkout\Environment;
use Checkout\Payments\Request\PaymentRequest;
use Checkout\Payments\Request\Source\RequestCardSource;
use Checkout\Payments\Sender\Identification;
use Checkout\Payments\Sender\IdentificationType;
use Checkout\Payments\Sender\PaymentIndividualSender;

class ProfileController extends Controller
{

    public function index()
    {
        $userId = Auth::user()->id;
        $UserBannerImage = UsersBannerImage::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'DESC')->first();
        $category =  Category::where('status', ACTIVE)->where('deleted_at', '=', NULL)->get();
        $userStory = Stories::select('category_id')->with('category')->where('is_paid', '=', '1')->where('user_id', '=', Auth::user()->id)->where('deleted_at', '=', NULL)->groupBy('category_id')->get();
        $storyAll = Stories::select('category_id')->where('deleted_at', '=', NULL)->where('is_paid', '=', '1')->where('user_id', '=', Auth::user()->id)->groupBy('category_id')->get();
        $userAddress = UsersDeliveryAddress::where('user_id', '=', Auth::user()->id)->first();
        $itemSold = OrderItem::where('user_id', Auth::user()->id)->count();
        $itemBought = OrderItem::where('customer_id', Auth::user()->id)->count();
        
        $story_price_data = StoryPrice::select('story_price')->pluck('story_price');
        $story_price = '';
        if(!empty($story_price_data[0])){
            $story_price = $story_price_data[0];
        }

        $userCity = User::where('id',Auth::user()->id)->first();
        $cityId = $userCity->city_id;
        $stateId = $userCity->state_id;

        $getCity = City::where('id',$cityId)->first();
        $getState = State::where('id',$stateId)->first(); 

        // get Auth user banner
        $UserBannerImage = UsersBannerImage::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'DESC')->first();
        $userAddress = UsersDeliveryAddress::where('user_id', '=', Auth::user()->id)->first();
        $category =  Category::where('status', ACTIVE)->where('deleted_at', '=', NULL)->get();
        $userStory = UserStory::select('category_id')->with('category')->where('user_id', '=', Auth::user()->id)
        ->where('is_paid', '=', '1')
        ->where('deleted_at', '=', NULL)->groupBy('category_id')->get();
        $StoryAll = UserStory::select('category_id')->where('deleted_at', '=', NULL)
        ->where('is_paid', '=', '1')
        ->where('user_id', '=', Auth::user()->id)->groupBy('category_id')->get();

        // check category
        $CheckCategory = array();
        foreach ($StoryAll as $key => $cat) {
            $CheckCategory[] = $cat['category_id'];
        }
        // get category wise story
        $Story = array();
        foreach ($CheckCategory as $key => $value) {
            $StoryAll = UserStory::with('user', 'category')->where('user_id', Auth::user()->id)->where('deleted_at', '=', NULL)
            ->where('is_paid', '=', '1')
            ->where('category_id', $value)->get()->toArray();
            $Story[] = $StoryAll;
        }

        $CheckCategory = array();
        foreach ($storyAll as $key => $cat) {
            $CheckCategory[] = $cat['category_id'];
        }
        $story = array();
        foreach ($CheckCategory as $key => $value) {
            $storyAll = UserStory::with('user', 'category')->where('user_id', $userId)->where('is_paid', '=', '1')->where('deleted_at', '=', NULL)->where('category_id', $value)->get()->toArray();
            $story[] = $storyAll;
        }
        $itemsList = Item::where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->where('status', '=', '1')
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

            $wishlist = Wishlist::where('item_id', $value['id'])->first();
            $itemArray[$key]['wishlist'] = $wishlist;

            $user = User::where('id', $value['user_id'])->first();
            $userCity = $user->city_id;
            $getCity = City::where('id', $userCity)->first();
            $itemArray[$key]['city'] = $getCity;
        }

        $followerId = $userId;
        $followingId = Auth::id();

        $following_user = UserFollowers::where(['following_id' => $followingId, 'follow_unfollow_status' => TRUE])->count();
        $follower_user = UserFollowers::where(['follower_id' => $userId, 'follow_unfollow_status' => TRUE])->count();


        $follow_data = UserFollowers::where(['following_id' => $followingId, 'follower_id' => $followerId])->first();

        $pages = CmsPage::where('status', 1)->first();


          //# Current login user Review Ratings #/
          $avg = SellerReviewRatings::where('user_id', $followingId);
          $totalReviewAvg1 = $avg->avg('rating_star');
          $totalReviewAvg =  number_format($totalReviewAvg1, 2);
          $totalCountReviewRatings = SellerReviewRatings::where('user_id',  $followingId)->count();
          //# Current login user Review Ratings #/

        return view('frontend.users.user_profile.index', compact(
            'UserBannerImage',
            'userAddress',
            'category',
            'userStory',
            'Story',
            'itemArray',
            'itemSold',
            'itemBought',
            'following_user',
            'follower_user',
            'followingId',
            'followerId',
            'follow_data',
            'story_price',
            'getCity',
            'getState',
            'totalReviewAvg',
            'totalCountReviewRatings',
        ));
    }

    public function profile_banner(Request $request)
    {
        // store UserBannerImage
        $userBanner = new UsersBannerImage;
        $image = $request->file;
        if ($request->has('file')) {
            $imagename = $request->file;
            // File unlink to public path
            $removeImage = public_path() . "\assets\banner" . "\\" . $imagename;
            if (file_exists($removeImage)) {
                unlink($removeImage);
            }

            // if folder is not created than create the folder this function            
            $destination = public_path('assets/banner');
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $name = 'images' . time();
            $imageName = $name . '.' . $image->getClientOriginalExtension();
            $image->move($destination, $imageName);
        } else {
            $imageName = null;
        }
        $userBanner->user_id = Auth::user()->id;
        $userBanner->banner_image = $imageName;
        $userBanner->save();
    }

    public function edit_profile(Request $request)
    {
        $userProfileDetail = User::where('id', Auth::user()->id)->first();
        $image = $request->profile_picture;
        if ($request->has('profile_picture')) {
            $imagename = $request->profile_picture;
            $destination = public_path('assets/users');
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $name = 'images' . time();
            $imageName = $name . '.' . $image->getClientOriginalExtension();
            $image->move($destination, $imageName);
        } else {
            $imageName = $userProfileDetail->profile_picture;
        }
        $userProfileDetail->profile_picture = $imageName;
        $userProfileDetail->username = $request->username;
        $userProfileDetail->first_name = $request->username;
        $userProfileDetail->last_name = NULL;
        $userProfileDetail->gender = $request->gender;
        $userProfileDetail->birth_date = $request->birthdate;
        $userProfileDetail->email = $request->email;
        $userProfileDetail->phone_number = $request->phone_number;
        $userProfileDetail->address = $request->address;
        $userProfileDetail->save();

        return response()->json(['code' => 200, 'success' => Lang::get('frontend-messages.UserProfile.success.msg')], 200);
    }

    public function change_password(request $request)
    {
        $user = Auth::User();
        $password = $request->old_password;

        // CHECK OLD PASSWORD IS MATCH
        if (isset($user) && !empty($user)) {
            $check_password = Hash::check($password, $user->password);
        }

        // check old password condition
        if (!$check_password) {
            return response()->json(['error' => 'Old password does not match!']);
        } else {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return response()->json(['code' => 200, 'success' => Lang::get('frontend-messages.ChangPassword.success.msg')], 200);
        }
    }

    public function UserAddress(Request $request)
    {
        
        $userAddressDetail = UsersDeliveryAddress::where('user_id', '=', Auth::user()->id)->where('deleted_at', '=', NULL)->get();
        return view('frontend.users.user_profile.index', compact('userAddressDetail'));
    }

    public function add_address(Request $request)
    {
        // Store data to UsersDeliveryAddress
        $usersDeliveryAddress = new UsersDeliveryAddress;
        $usersDeliveryAddress->user_id = Auth::user()->id;
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

        return response()->json(['code' => 200, 'success' => Lang::get('frontend-messages.UserAddresses.success.msg')], 200);
    }

    public function update_address($id, Request $request)
    {
        //Update User Address
        $userAddress = UsersDeliveryAddress::find($request->id);
        $userAddress->user_id = Auth::user()->id;
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

        return response()->json(['code' => 200, 'success' => Lang::get('frontend-messages.UserAddresses.editaddress.success.msg')], 200);
    }

    public function post_removed(Request $request)
    {
        $id = $request->post_id;
        BoostItem::where('item_id', $id)->delete();
        Cart::where('item_id',$id)->delete();
        HoldAnOffer::where('item_id',$id)->delete();
        MakeAnOffer::where('item_id',$id)->delete();
        Wishlist::where('item_id',$id)->delete();
        UserLike::where('item_id',$id)->delete();
        ItemsImages::where('item_id', $id)->delete();
        Inventory::where('item_id', $id)->delete();
        stock::where('item_id', $id)->delete();
        Item::where('id', $id)->where('status', '=', '1')->delete();
        return redirect()->back()->with('success', Lang::get('Post Remove Successfully'));
    }
  
    public function story_payment(Request $request, $id){
        $storyPriceId = $id;
        $storyPriceIdDetails = UserStory::where('id', $storyPriceId)->first();
        $monthArray = array(
            "1" => "January", "2" => "February", "3" => "March", "4" => "April",
            "5" => "May", "6" => "June", "7" => "July", "8" => "August",
            "9" => "September", "10" => "October", "11" => "November", "12" => "December",
            );
        return view('frontend.users.user_profile.story_payment', compact('storyPriceIdDetails','storyPriceId','monthArray'));
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
        
        // $api = CheckoutSdk::builder()->staticKeys()
        // ->environment(Environment::sandbox())
        // ->secretKey("sk_sbox_kxgkyhqokicx6oll6dzvf7zdxqk")
        // ->build();
        
        // $api = CheckoutSdk::builder()->oAuth()
        // ->clientCredentials("ack_4vesek7j37ne5l73rfg5pxolzy", "cCJYVaOdkJLU72BRCOagBxQivblDEIW0LxsZyeQ3sPsW_w_buLocD9e0A20dkkpF_B7OjY3LzM3FR51cuDJnOg")
        // ->scopes(['gateway'])
        //     ->environment(Environment::sandbox())
        //     ->build();

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
            
            return redirect()->route('frontend.users.profile.index')->with('success', __('Payment SuccessFull'));
        } catch (CheckoutApiException $e) {
            // API error
            $error_details = $e->error_details;
            return redirect()->back()->with('danger', __('Payment UnsuccessFull'));
            $http_status_code = isset($e->http_metadata) ? $e->http_metadata->getStatusCode() : null;
        } catch (CheckoutAuthorizationException $e) {
            // Bad Invalid authorization
        }
    }

    public function followerDetails(){
        $userId = Auth::user()->id;

        $userList = UserFollowers::where(['follower_id' => $userId, 'follow_unfollow_status' => TRUE])->get()
        ->toArray();
        
        $followingArr = [];
        foreach ($userList as $key => $value) {
            
            $followingArr[$key] = $value;
            
            $user = User::where('id', $value['following_id'])->first();
            $followingArr[$key]['user'] = $user;
        }

        return view('frontend.users.user_profile.follower_details', compact('followingArr'));
    }

    public function followingDetails(){
        $userId = Auth::user()->id;

        $userList = UserFollowers::where(['following_id' => $userId, 'follow_unfollow_status' => TRUE])->get()
        ->toArray();
        
        $followingArr = [];
        foreach ($userList as $key => $value) {
            
            $followingArr[$key] = $value;
            
            $user = User::where('id', $value['follower_id'])->first();
            $followingArr[$key]['user'] = $user;
        }
 
        return view('frontend.users.user_profile.following_details', compact('followingArr'));
    }

    public function sold_details(){

        $user   = Auth::user()->id;
        $itemArray = [];
        $orderItems = OrderItem::where('user_id', $user)->get();
        foreach($orderItems as $orderKey => $orderValue)
        {
            $itemArray[$orderKey] = $orderValue;

            $item = Item::where('id',$orderValue['item_id'])->first();
            $itemArray[$orderKey]['item'] = $item;

            $itemsImage = ItemsImages::where('item_id',$item['id'])->first();
            $itemArray[$orderKey]['item_pictures'] = $itemsImage;

            $condition = Condition::where('id',$item['condition_id'])->first();
            $itemArray[$orderKey]['condition'] = $condition;

            $brand = Brand::where('id',$item['brand_id'])->first();
            $itemArray[$orderKey]['brand'] = $brand;

            $store = Store::where('id',$item['store_id'])->first();
            $itemArray[$orderKey]['store'] = $store;

            $boostItem = BoostItem::where('item_id',$item['id'])->where('is_paid','1')->first();
            $itemArray[$orderKey]['boostItem'] = $boostItem;

            $wishlist = Wishlist::where('item_id',$item['id'])->first();
            $itemArray[$orderKey]['wishlist'] = $wishlist;

            $order = Orders::where('id', $orderValue['order_id'])->first();
            $itemArray[$orderKey]['order'] = $order;

            $user = User::where('id', $orderValue['customer_id'])->first();
            $itemArray[$orderKey]['user'] = $user;

            $userCity = $user->city_id;
            $getCity = City::where('id', $userCity)->first();
            $itemArray[$orderKey]['city'] = $getCity;
        }
        return view('frontend.users.user_profile.sold', compact('itemArray'));
    }

    public function bought_details(){
        $user   = Auth::user()->id;
        $itemArray = [];
        $orderItems = OrderItem::where('customer_id', $user)->get();
            foreach($orderItems as $orderKey => $orderValue)
            {
                $itemArray[$orderKey] = $orderValue;

                $item = Item::where('id',$orderValue['item_id'])->first();
                $itemArray[$orderKey]['item'] = $item;

                $itemsImage = ItemsImages::where('item_id',$item['id'])->first();
                $itemArray[$orderKey]['item_pictures'] = $itemsImage;

                $condition = Condition::where('id',$item['condition_id'])->first();
                $itemArray[$orderKey]['condition'] = $condition;

                $brand = Brand::where('id',$item['brand_id'])->first();
                $itemArray[$orderKey]['brand'] = $brand;

                $store = Store::where('id',$item['store_id'])->first();
                $itemArray[$orderKey]['store'] = $store;

                $boostItem = BoostItem::where('item_id',$item['id'])->where('is_paid','1')->first();
                $itemArray[$orderKey]['boostItem'] = $boostItem;

                $wishlist = Wishlist::where('item_id',$item['id'])->first();
                $itemArray[$orderKey]['wishlist'] = $wishlist;

                $order = Orders::where('id', $orderValue['order_id'])->first();
                $itemArray[$orderKey]['order'] = $order;

                $user = User::where('id', $orderValue['customer_id'])->first();
                $itemArray[$orderKey]['user'] = $user;

                $userCity = $user->city_id;
                $getCity = City::where('id', $userCity)->first();
                $itemArray[$orderKey]['city'] = $getCity;
            }
        return view('frontend.users.user_profile.bought', compact('itemArray'));
    }
}
