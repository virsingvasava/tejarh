<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Models\BoostItem;
use App\Models\Brand;
use App\Models\BusinessUsers;
use App\Models\City;
use App\Models\Condition;
use App\Models\Item;
use App\Models\ItemsImages;
use App\Models\OrderItem;
use App\Models\ReviewRatings;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserFollowers;
use App\Models\UserLike;
use App\Models\UsersBannerImage;
use App\Models\UserStory;
use App\Models\Wishlist;
use Validator;
use Response;
use JWTFactory;
use Illuminate\Support\Str;

use Tymon\JWTAuth\Exceptions\JWTException;
use Mail;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\JWTAuth as JWTAuthJWTAuth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function postRefreshToken(Request $request)
    {
        /*$enc = Crypt::encrypt('apiuser@tejarh.com|123456789');*/
        $inputData = $request->all();

        $header = $request->header('AuthorizationUser');
        if (empty($header)) {
            $message = 'Authorisation required';
            return InvalidResponse($message, 101);
        }

        $response = veriftyAPITokenData($header);

        $success = $response->original['success'];

        if (!$success) {
            return $response;
        }
    }
    public function updateProfile(Request $request)
    {
        $inputData = $request->all();
        $user_token = $request->header('authorization');


        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $checkPhoneNumber = User::where('phone_number', $request->phone_number)->where('id', '<>', $user_id)->count();

        if ($checkPhoneNumber > 0) {
            $message = "This Phone Number already used by another user";
            return InvalidResponse($message, 101);
        }

        $checkusersname = User::where('username', $request->username)->where('id', '<>', $user_id)->count();

        if ($checkusersname > 0) {
            $message = "This Username already used by another user";
            return InvalidResponse($message, 101);
        }

        $UpdateProfile = User::where('id', $user_id)->first();

        if (empty($UpdateProfile)) {
            $message = "User Detail not found";
            return InvalidResponse($message, 101);
        }
        $image = $request->profile_picture;
        if (!empty($image)) {
            $imagename = $request->profile_picture;
            $destination = public_path("assets/users");
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $name = 'profile_picture_' . time();
            $imageName = $name . '.' . $image->getClientOriginalExtension();
            $image->move($destination, $imageName);
            $UpdateProfile->profile_picture = $imageName;
        }
        // $UpdateProfile->first_name = $request->first_name;
        // $UpdateProfile->last_name = $request->last_name;
        // $UpdateProfile->name = $request->first_name . " " . $request->last_name;
        $UpdateProfile->username = $request->username;
        $UpdateProfile->phone_number = $request->phone_number;
        $UpdateProfile->gender = $request->gender;
        $UpdateProfile->birth_date = $request->dob;
        $UpdateProfile->address = $request->address;
        $UpdateProfile->save();

        $message = 'User Profile updated successfully';
        return SuccessResponse($message, 200, $UpdateProfile);
    }

    public function profilebanner(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'banner_image' => 'required|image',
        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }
        $inputData = $request->all();
        $user_token = $request->header('authorization');


        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $userBanner = new UsersBannerImage;
        $image = $request->banner_image;
        if ($request->banner_image) {
            $imagename = $request->banner_image;

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
        $userBanner->user_id = $user_id;
        $userBanner->banner_image = $imageName;
        $userBanner->save();

        $message = 'Updated successfully';
        return SuccessResponse($message, 200, $userBanner);
    }

    public function getProfile(Request $request)
    {
        $user_token = $request->header('authorization');
        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);

        $inputData = $request->all();

        $user_id = $jwt_user->id;
        $limit = 10;
        $page_no = 1;
        if (isset($request->page) && $request->page != "") {
            $page_no = $request->page;
        }
        $start_from = ($page_no - 1) * $limit;

        $userProfile = User::where('id', $user_id)->first();

        if (empty($userProfile)) {
            $message = "User Detail not found";
            return InvalidResponse($message, 101);
        }
        $userProfile = $userProfile->toArray();
        
        $Story = UserStory::where('deleted_at', '=', NULL)
        ->where('is_paid', '=', '1')
        ->where('user_id', '=',$user_id)
        ->orderBy('created_at', 'DESC')
        ->get();
        $userProfile['Story'] = $Story;
        
        $UserBannerImage = UsersBannerImage::where('user_id', '=', $user_id)->orderBy('created_at', 'DESC')->first();
        $userProfile['BannerImage'] = $UserBannerImage;

        $followingId = $user_id ;
        $followerId = $user_id;
        $following_user = UserFollowers::where(['following_id' => $user_id, 'follow_unfollow_status' => TRUE])->count();
        $userProfile['following_user'] = $following_user;

        $follower_user = UserFollowers::where(['follower_id' => $user_id, 'follow_unfollow_status' => TRUE])->count();
        $userProfile['follower_user'] = $follower_user;

        $follow_data = UserFollowers::where(['following_id' => $followingId, 'follower_id' => $followerId])->first();
        $userProfile['follow_data'] = $follow_data;


        $itemSold = OrderItem::where('user_id', $user_id)->count();
        $userProfile['itemSold'] = $itemSold;

        $itemBought = OrderItem::where('customer_id', $user_id)->count();
        $userProfile['itemBought'] = $itemBought;

        $ItemList = Item::where([['user_id', '=', $user_id], ['deleted_at', '=', NULL]])
            ->where('status', '=', '1')
            ->skip($start_from)->take($limit)
            ->orderBy('created_at', 'DESC')->get()->toArray();
        foreach ($ItemList as $key => $value) {
            $itemsImage = ItemsImages::where('item_id', $value['id'])->first();
            $ItemList[$key]['item_pictures'] = $itemsImage;

            $condition = Condition::where('id', $value['condition_id'])->first();
            $ItemList[$key]['condition'] = $condition;

            $brand = Brand::where('id', $value['brand_id'])->first();
            $ItemList[$key]['brand'] = $brand;

            $store = Store::where('id', $value['store_id'])->first();
            $ItemList[$key]['store'] = $store;

            $boostItem = BoostItem::where('item_id', $value['id'])->where('is_paid', '1')->first();
            $ItemList[$key]['boostItem'] = $boostItem;

            $is_wishlist = 0;
            $ItemList[$key]['wishlist'] = $is_wishlist;
            $wishlist = Wishlist::where('user_id', $user_id)->where('item_id', $value['id'])->select('wishlist_status')->first();
            if(!empty($wishlist))
            {
                $ItemList[$key]['wishlist'] = 1;
            }

            $is_likelist = 0;
            $ItemList[$key]['Likelist'] = $is_likelist;
            $Likelist = UserLike::where('user_id', $user_id)->where('item_id', $value['id'])->first();
            if(!empty($Likelist))
            {
                $ItemList[$key]['Likelist'] = 1;
            }

            $user = User::where('id', $value['user_id'])->first();
            $userCity = $user->city_id;
            $getCity = City::where('id', $userCity)->first();
            $ItemList[$key]['city'] = $getCity;


            $avg = ReviewRatings::where('item_id', $value['id']);
            $totalReviewAvg = $avg->avg('rating_star');
            $totalReviewAvg =  number_format($totalReviewAvg, 2);
            $subcategoryItemListArray[$key]['totalReviewAvg'] = $totalReviewAvg;

            $reviewRatings = ReviewRatings::where('item_id', $value['id'])->count();
            $subcategoryItemListArray[$key]['reviewRatings'] = $reviewRatings;
        }

        $userProfile['itemList'] = $ItemList;


        $message = 'User detail';
        return SuccessResponse($message, 200, $userProfile);
    }

    public function updateLocation(Request $request)
    {
        $inputData = $request->all();

        $header = $request->header('AuthorizationUser');
        $user_token = $request->header('authorization');

        if (empty($header)) {
            $message = 'Authorisation required';
            return InvalidResponse($message, 101);
        }

        $response = veriftyAPITokenData($header);
        $success = $response->original['success'];

        if (!$success) {
            return $response;
        }

        $validator = Validator::make($request->all(), [
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message, 101);
        }

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $user = User::where('id', $user_id)->first();
        if (isset($request->location) && $request->location != "") {
            $user->address = $request->location;
        }
        $user->latitude = $request->latitude;
        $user->longitude = $request->longitude;
        $user->save();

        $message = 'User Location Updated successfully';
        return SuccessResponse($message, 200, $user);
    }
}
