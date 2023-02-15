<?php

namespace App\Http\Controllers\Frontend\Business;

use App\Http\Requests\StoryAdd as StoryAddValidation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfileBanner;
use App\Models\BusinessUsers;
use App\Models\ItemsImages;
use App\Models\SubCategory;
use App\Models\BoostItem;
use App\Models\Condition;
use App\Models\StoreType;
use App\Models\Category;
use App\Models\Stories;
use App\Models\Branch;
use App\Models\Slider;
use App\Models\Brand;
use App\Models\cardDetails;
use App\Models\Cart;
use App\Models\CheckOutPayment;
use App\Models\Store;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\Item;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\CmsPage;
use App\Models\HoldAnOffer;
use App\Models\Inventory;
use App\Models\MakeAnOffer;
use App\Models\OrderDeliveryAddress;
use App\Models\OrderDeliveryCompany;
use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\Return_Policy;
use App\Models\ShippingDeliveryCompany;
use App\Models\stock;
use App\Models\StoreDistance;
use App\Models\StoryPrice;
use App\Models\Terms_condition;
use App\Models\UserDeliveryAddress;
use App\Models\UserFollowers;
use App\Models\UserLike;
use App\Models\UsersDeliveryAddress;
use App\Models\SellerReviewRatings;
use App\Models\UserStory;
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
use PhpParser\Node\Stmt\Return_;

class BusinessProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $userId = Auth::user()->id;
        $bannerReplace = ProfileBanner::where('user_id', $userId)->orderBy('created_at', 'DESC')->first();
        $category =  Category::where('status', ACTIVE)->where('deleted_at', '=', NULL)->get();
        $userStory = UserStory::select('category_id')->with('category')->where('user_id', '=', Auth::user()->id)->where('is_paid','=','1')->where('deleted_at', '=', NULL)->groupBy('category_id')->get();
        $storyAll = UserStory::select('category_id')->where('deleted_at', '=', NULL)->where('user_id', '=', Auth::user()->id)->where('is_paid','=','1')->groupBy('category_id')->get();

        $itemSold = OrderItem::where('user_id', Auth::user()->id)->count();
        $itemBought = OrderItem::where('customer_id', Auth::user()->id)->count();

        $story_price_data = StoryPrice::select('story_price')->pluck('story_price');
        $story_price = '';
        if(!empty($story_price_data[0])){
            $story_price = $story_price_data[0];
        }

        $CheckCategory = array();
        foreach ($storyAll as $key => $cat) {
            $CheckCategory[] = $cat['category_id'];
        }
        $story = array();
        foreach ($CheckCategory as $key => $value) {
            $storyAll = UserStory::with('user', 'category')->where('user_id', $userId)->where('deleted_at', '=', NULL)->where('is_paid','=','1')->where('category_id', $value)->get()->toArray();
            $story[] = $storyAll;
        }

        if(Auth::user()->role == BUSINESS_ROLE)
        {
            $getItem = Item::where('business_id', $userId)
            ->where('status', '=', '1')->first();
            if(!empty($getItem)){
                $getBusinessId = $getItem->business_id;
                if(!empty($getBusinessId))
                {
                    $itemsList = Item::where('business_id', $getBusinessId)
                    ->where('status', '=', '1')
                    ->orderBy('created_at', 'DESC')
                    ->get()
                    ->toArray();
                }
                else{
                    $itemsList = Item::where('business_id', "")
                    ->where('status', '=', '1')
                    ->orderBy('created_at', 'DESC')
                    ->get()
                    ->toArray();
                }
            }
        }
        else{
            $itemsList = Item::where('user_id', $userId)
            ->where('status', '=', '1')
            ->orderBy('created_at', 'DESC')
            ->get()
            ->toArray();
        }
        
        $itemArray = [];
        if(!empty($itemsList)){
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
                $itemArray[$key]['user'] = $user;

                $userCity = $user->city_id;
                $getCity = City::where('id', $userCity)->first();
                $itemArray[$key]['city'] = $getCity;
            }
        }
        
        
        $id = Auth::id();
        $usersprofile = User::where(['id' => $id = Auth::id()])->first();
        $profilebusinessArray = BusinessUsers::with(['user', 'store', 'items'])->where(['user_id' => $usersprofile->business_id])->first();
        // dd($profilebusinessArray);
        $profileArray = BusinessUsers::with(['user', 'store', 'items'])->where(['user_id' => $id = Auth::id()])->first();
        $pages = CmsPage::where('status', 1)->first();
        
        $return_policy = Return_Policy::where('user_id',$userId)->first();
        $term_condition = Terms_condition::where('user_id',$userId)->first();

        $followerId = $userId;
        $followingId = Auth::id();
        $following_user = UserFollowers::where(['following_id' => $followingId, 'follow_unfollow_status' => TRUE])->count();
        $follower_user = UserFollowers::where(['follower_id' => $userId, 'follow_unfollow_status' => TRUE])->count();

        $follow_data = UserFollowers::where(['following_id' => $followingId, 'follower_id' => $followerId])->first();
        
    
        //# Current login user Review Ratings #/
        $avg = SellerReviewRatings::where('user_id', $followingId);
        $totalReviewAvg1 = $avg->avg('rating_star');
        $totalReviewAvg =  number_format($totalReviewAvg1, 2);
        $totalCountReviewRatings = SellerReviewRatings::where('user_id',  $followingId)->count();
        //# Current login user Review Ratings #/

        return view('frontend.business.pages.profiles.index', compact(
            'pages',
            'bannerReplace',
            'category',
            'userStory',
            'story',
            'itemArray',
            'profileArray',
            'itemSold',  
            'itemBought',
            'following_user',
            'follower_user',
            'followingId',
            'followerId',
            'follow_data',
            'story_price',
            'return_policy',
            'term_condition',
            'profilebusinessArray',
            'totalReviewAvg',
            'totalCountReviewRatings',
        ));
    }

    public function editProfile(Request $request)
    {
        $id = Auth::id();
        $branches = Branch::all();
        $cities = City::all();
        $stores = StoreType::all();
        $edit_profile = BusinessUsers::with('user')->where(['user_id' => $id])->first();
        return view('frontend.business.pages.profiles.edit', compact('edit_profile', 'branches', 'cities', 'stores'));
    }

    public function updateProfile(Request $request)
    {
        $update = User::where('id', $request->id)->first();
        $update->email = $request->business_email;
        $update->first_name = $request->owner_or_manager_name;
        $update->last_name = $request->owner_or_manager_name;
        $update->name = $request->owner_or_manager_name;
        $update->phone_code = $request->phone_number_code;
        $update->phone_number = $request->phone_number;
        $update->role = BUSINESS_ROLE;

        $profile_picture = $request->profile_picture;
        if ($request->has('profile_picture')) {
            $profile_picturename = $request->profile_picture;
            $destination = public_path(BUSINESS_PROFILE_FOLDER);
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $name = 'profile_picture_' . time();
            $profile_pictureName = $name . '.' . $profile_picture->getClientOriginalExtension();
            $profile_picture->move($destination, $profile_pictureName);
        } else {
            $profile_pictureName = $update->profile_picture;
        }
        $update->profile_picture = $profile_pictureName;
        $update->save();

        $update_b = BusinessUsers::where('user_id', $request->id)->first();
        $update_b->user_id = $update->id;
        $update_b->company_name = $request->company_name;
        $update_b->company_legal_name = $request->company_legal_name;
        $update_b->owner_or_manager_name = $request->owner_or_manager_name;
        $update_b->date_of_expiry = $request->date_of_expiry;
        $update_b->bank_name = $request->bank_name;
        $update_b->bank_account_number = $request->bank_account_number;
        $update_b->Iban_number = $request->Iban_number;
        $update_b->store_name = $request->store_name;
        $update_b->branch_id = $request->branch_id;
        $update_b->store_location  = $request->store_location;
        $update_b->city_id  = $request->city_id;
        $update_b->state_id  = $request->state_id;
        $update_b->country_id  = $request->country_id;
        $update_b->store_phone_number =  $request->store_phone_number;
        $update_b->working_hours = $request->working_hours;
        $update_b->website = $request->website;
        $update_b->store_type = $request->store_type_id;

        /* CR Number and File */
        $update_b->enter_cr_number = $request->enter_cr_number;
        $upload_cr = $request->upload_cr_file;
        if ($request->has('upload_cr_file')) {
            $destination = public_path(BUSINESS_PROFILE_FOLDER);
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $name = 'upload_cr_' . time();
            $upload_crName = $name . '.' . $upload_cr->getClientOriginalExtension();
            $upload_cr->move($destination, $upload_crName);
        } else {
            $upload_crName = $update_b->upload_cr;
        }
        $update_b->upload_cr = $upload_crName;

        /* Maroof number and File */
        $update_b->enter_cr_maroof_namber = $request->enter_cr_maroof_namber;
        $upload_maroof = $request->upload_maroof_file;
        if ($request->has('upload_maroof_file')) {
            $destination = public_path(BUSINESS_PROFILE_FOLDER);
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $name = 'upload_maroof_' . time();
            $upload_maroofName = $name . '.' . $upload_maroof->getClientOriginalExtension();
            $upload_maroof->move($destination, $upload_maroofName);
        } else {
            $upload_maroofName = $update_b->upload_maroof;
        }
        $update_b->upload_maroof = $upload_maroofName;

        /* Vat Certificate File */
        $update_b->vat_number = $request->vat_number;
        $vat_certificate_file = $request->vat_certificate_file;
        if ($request->has('vat_certificate_file')) {
            $destination = public_path(BUSINESS_PROFILE_FOLDER);
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $name = 'vat_certificate_' . time();
            $vat_certificate_file_Name = $name . '.' . $vat_certificate_file->getClientOriginalExtension();
            $vat_certificate_file->move($destination, $vat_certificate_file_Name);
        } else {
            $vat_certificate_file_Name = $update_b->vat_certificate_file;
        }
        $update_b->vat_certificate_file = $vat_certificate_file_Name;

        /* Shop Sign File */
        $shop_sign = $request->shop_sign_file;
        if ($request->has('shop_sign_file')) {
            $destination = public_path(BUSINESS_PROFILE_FOLDER);
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $name = 'shop_sign_' . time();
            $shop_sign_Name = $name . '.' . $shop_sign->getClientOriginalExtension();
            $shop_sign->move($destination, $shop_sign_Name);
        } else {
            $shop_sign_Name = $update_b->shop_sign_file;
        }
        $update_b->shop_sign_file = $shop_sign_Name;

        /* Store Logo File */
        $store_logo = $request->store_logo_file;
        if ($request->has('store_logo_file')) {
            $destination = public_path(BUSINESS_PROFILE_FOLDER);
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $name = 'store_logo_' . time();
            $store_logoName = $name . '.' . $store_logo->getClientOriginalExtension();
            $store_logo->move($destination, $store_logoName);
        } else {
            $store_logoName = $update_b->store_logo_file;
        }
        $update_b->store_logo_file = $store_logoName;

        /* Ministry of Government File */
        $ministry_of_government = $request->ministry_of_government;
        if ($request->has('ministry_of_government')) {
            $destination = public_path(BUSINESS_PROFILE_FOLDER);
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $name = 'minister_of_government' . time();
            $ministry_of_governmentName = $name . '.' . $ministry_of_government->getClientOriginalExtension();
            $ministry_of_government->move($destination, $ministry_of_governmentName);
        } else {
            $ministry_of_governmentName = $update_b->ministry_of_government;
        }
        $update_b->ministry_of_government = $ministry_of_governmentName;

        $update_b->save();
        $update_store = Store::where('user_id', $request->id)->first();
        $update_store->store_logo_file = $store_logoName;
        $update_store->save();
        return redirect()->route('frontend.business.business-profile.index')->with('success', __('business_messages.business_profile.business_profile_updated_success'));
    }

    public function businessReplaceBanner(Request $request)
    {

        $userBanner = new ProfileBanner;
        $image = $request->business_replace_banner_image;
        if ($request->has('business_replace_banner_image')) {
            $imagename = $request->business_replace_banner_image;
            $removeImage = public_path(BUSINESS_BANNER_FOLDER) . $imagename;

            if (file_exists($removeImage)) {
                unlink($removeImage);
            }
            $destination = public_path(BUSINESS_BANNER_FOLDER);
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $name = 'banner_replace_' . time();
            $imageName = $name . '.' . $image->getClientOriginalExtension();
            $image->move($destination, $imageName);
        } else {
            $imageName = null;
        }
        $userBanner->user_id = Auth::user()->id;
        $userBanner->banner_image = $imageName;
        $userBanner->save();
        return response()->json(['code' => 200, 'success' => Lang::get('business_messages.business_profile.b_profile_banner_updated_success')], 200);
    }

    public function addBusinessStory(Request $request)
    {
        $usetStory = new UserStory;
        $image = $request->story_image_name;
        if ($request->has('story_image_name')) {
            $imagename = $request->story_image_name;
            $removeImage = public_path() . "\assets\stories" . "\\" . $imagename;
            if (file_exists($removeImage)) {
                unlink($removeImage);
            }
            $destination = public_path('assets/stories');
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $name = 'story_' . time();
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
        
        return response()->json(['code' => 200, 'success' => Lang::get('business_messages.story.success.msg'), 'response' => $usetStory], 200);
    }

    public function addStory(Request $request)
    {
        $usetStory = new UserStory;
        $image = $request->story_image_name;
        if ($request->has('story_image_name')) {
            $imagename = $request->story_image_name;
            $removeImage = public_path() . "\assets\stories" . "\\" . $imagename;
            if (file_exists($removeImage)) {
                unlink($removeImage);
            }
            $destination = public_path('assets/stories');
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $name = 'story_' . time();
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
        return response()->json(['code' => 200, 'success' => Lang::get('business_messages.story.success.msg'), 'response' => $usetStory], 200);

    }

    public function businessChangePassword(Request $request)
    {

        $user = Auth::User();
        $password = $request->current_password;

        if (isset($user) && !empty($user)) {
            $check_password = Hash::check($password, $user->password);
        }

        if (!$check_password) {
            return redirect()->route('frontend.business.business-profile.index')->with('error', 'Old password does not match!');
        } else {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->route('frontend.business.business-profile.index')->with('success', 'Change Password successfully');
        }
    }
    public function state_listing(Request $request)
    {
        $data['states'] = State::where("country_id", $request->country_id)->get(["name", "id"]);
        return response()->json($data);
    }

    public function city_listing(Request $request)
    {
        $data['cities'] = City::where("state_id", $request->state_id)->get(["name", "id"]);
        return response()->json($data);
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
        Orders::where('item_id',$id)->delete();
        OrderItem::where('item_id', $id)->delete();
        OrderDeliveryAddress::where('item_id', $id)->delete();
        OrderDeliveryCompany::where('item_id', $id)->delete();
        ShippingDeliveryCompany::where('item_id', $id)->delete();
        StoreDistance::where('item_id', $id)->delete();
        ItemsImages::where('item_id', $id)->delete();
        Inventory::where('item_id', $id)->delete();
        stock::where('item_id', $id)->delete();
        Item::where('id', $id)->where('status', '=', '1')->delete();
        return redirect()->route('frontend.business.business-profile.index')->with('success', __('Items deleted successfully'));
    }

    public function add_address(Request $request)
    {

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

        return redirect()->back()->with('success', __('frontend-messages.UserAddresses.success.msg'));
    }

    public function update_address($id, Request $request)
    {

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

    public function story_payment(Request $request, $id){
        $storyPriceId = $id;
        $storyPriceIdDetails = UserStory::where('id', $storyPriceId)->first();
        $story_price_data = StoryPrice::where('status','1')->first();
        $story_price = $story_price_data->story_price;  
        $monthArray = array(
            "1" => "January", "2" => "February", "3" => "March", "4" => "April",
            "5" => "May", "6" => "June", "7" => "July", "8" => "August",
            "9" => "September", "10" => "October", "11" => "November", "12" => "December",
            );
        return view('frontend.business.pages.story_payment', compact('storyPriceIdDetails','storyPriceId','story_price','monthArray'));
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
            
            return redirect()->route('frontend.business.business-profile.index')->with('success', __('Payment SuccessFull'));
        } catch (CheckoutApiException $e) {
            // API error
            $error_details = $e->error_details;
            return redirect()->back()->with('danger', __('Payment UnsuccessFull'));
            $http_status_code = isset($e->http_metadata) ? $e->http_metadata->getStatusCode() : null;
        } catch (CheckoutAuthorizationException $e) {
            // Bad Invalid authorization
        }
    }

    public function following_details(){

        $userId = Auth::user()->id;

        $userList = UserFollowers::where(['following_id' => $userId, 'follow_unfollow_status' => TRUE])->get()
        ->toArray();
        
        $followingArr = [];
        foreach ($userList as $key => $value) {
            
            $followingArr[$key] = $value;
            
            $user = User::where('id', $value['follower_id'])->first();
            $followingArr[$key]['user'] = $user;
        }

        return view('frontend.business.pages.profiles.following', compact('followingArr'));
    }

    public function follower_details(){

        $userId = Auth::user()->id;

        $userList = UserFollowers::where(['follower_id' => $userId, 'follow_unfollow_status' => TRUE])->get()
        ->toArray();
        
        $followingArr = [];
        foreach ($userList as $key => $value) {
            
            $followingArr[$key] = $value;
            
            $user = User::where('id', $value['following_id'])->first();
            $followingArr[$key]['user'] = $user;
        }

        return view('frontend.business.pages.profiles.follower', compact('followingArr'));
    }

    public function sold_details(){
        $user   = Auth::user()->id;
        $itemArray = [];
        $orderItems = OrderItem::where('user_id', $user)->get();
        foreach($orderItems as $key => $value)
        {
            $itemArray[$key] = $value;

            $item = Item::where('id',$value['item_id'])->first();
            $itemArray[$key]['item'] = $item;

            $itemsImage = ItemsImages::where('item_id',$value['item_id'])->first();
            $itemArray[$key]['item_pictures'] = $itemsImage;

            $condition = Condition::where('id',$item['condition_id'])->first();
            $itemArray[$key]['condition'] = $condition;

            $brand = Brand::where('id',$item['brand_id'])->first();
            $itemArray[$key]['brand'] = $brand;

            $store = Store::where('id',$item['store_id'])->first();
            $itemArray[$key]['store'] = $store;

            $boostItem = BoostItem::where('item_id',$item['id'])->where('is_paid','1')->first();
            $itemArray[$key]['boostItem'] = $boostItem;

            $wishlist = Wishlist::where('item_id',$item['id'])->first();
            $itemArray[$key]['wishlist'] = $wishlist;

            $user = User::where('id', $value['user_id'])->first();
            $itemArray[$key]['user'] = $user;

            $userCity = $user->city_id;
            $getCity = City::where('id', $userCity)->first();
            $itemArray[$key]['city'] = $getCity;
        }
       
        return view('frontend.business.pages.profiles.sold', compact('itemArray'));
    }

    public function bought_details(){
        $user   = Auth::user()->id;
        $itemArray = [];
        $orderItems = OrderItem::where('customer_id', $user)->get();
        foreach($orderItems as $key => $value)
        {
            $itemArray[$key] = $value;

            $item = Item::where('id',$value['item_id'])->first();
            $itemArray[$key]['item'] = $item;

            $itemsImage = ItemsImages::where('item_id',$item['id'])->first();
            $itemArray[$key]['item_pictures'] = $itemsImage;

            $condition = Condition::where('id',$item['condition_id'])->first();
            $itemArray[$key]['condition'] = $condition;

            $brand = Brand::where('id',$item['brand_id'])->first();
            $itemArray[$key]['brand'] = $brand;

            $store = Store::where('id',$item['store_id'])->first();
            $itemArray[$key]['store'] = $store;

            $boostItem = BoostItem::where('item_id',$item['id'])->where('is_paid','1')->first();
            $itemArray[$key]['boostItem'] = $boostItem;

            $wishlist = Wishlist::where('item_id',$item['id'])->first();
            $itemArray[$key]['wishlist'] = $wishlist;

            $user = User::where('id', $value['user_id'])->first();
            $itemArray[$key]['user'] = $user;

            $userCity = $user->city_id;
            $getCity = City::where('id', $userCity)->first();
            $itemArray[$key]['city'] = $getCity;
        }
       
        return view('frontend.business.pages.profiles.bought', compact('itemArray'));
    }

    public function return_policy(){
        $user   = Auth::user()->id;
        $check_policy = Return_Policy::where('user_id',$user)->first();
        return view('frontend.business.pages.profiles.return_policy',compact('check_policy'));
    }

    public function add_return_policy(Request $request){
        $user   = Auth::user()->id;
        $add_policy = new Return_Policy();
        $add_policy->user_id = $user;
        $add_policy->description = $request->description;
        $add_policy->save();
        return redirect()->route('frontend.business.business-profile.index')->with('success', __('Add Successfully'));
    }

    public function edit_return_policy(Request $request){
        $user   = Auth::user()->id;
        $check_policy = Return_Policy::where('user_id',$user)->first();
        if(!empty($check_policy)){
            $update_policy = Return_Policy::where('user_id',$user)->first();
            $update_policy->description = $request->description;
            $update_policy->save();
        }
        return redirect()->route('frontend.business.business-profile.index')->with('success', __('Edit Successfully'));
    }

    public function term_condition(){
        $user   = Auth::user()->id;
        $check_term_condition = Terms_condition::where('user_id',$user)->first();
        return view('frontend.business.pages.profiles.term_condition',compact('check_term_condition'));
    }

    public function add_term_condition(Request $request){
        $user   = Auth::user()->id;
        $add_policy = new Terms_condition();
        $add_policy->user_id = $user;
        $add_policy->description = $request->description;
        $add_policy->save();
        return redirect()->route('frontend.business.business-profile.index')->with('success', __('Add Successfully'));
    }

    public function edit_term_condition(Request $request){
        $user   = Auth::user()->id;
        $check_term_condition = Terms_condition::where('user_id',$user)->first();
        if(!empty($check_term_condition)){
            $update_policy = Terms_condition::where('user_id',$user)->first();
            $update_policy->description = $request->description;
            $update_policy->save();
        }
        return redirect()->route('frontend.business.business-profile.index')->with('success', __('Edit Successfully'));
    }
}
