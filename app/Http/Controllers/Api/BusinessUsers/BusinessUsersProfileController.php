<?php

namespace App\Http\Controllers\Api\BusinessUsers;

use App\Http\Controllers\Controller;
use App\Models\BoostItem;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Models\BusinessUsers;
use App\Models\Category;
use App\Models\Branch;
use App\Models\Brand;
use App\Models\City;
use App\Models\Condition;
use App\Models\Item;
use App\Models\ItemsImages;
use App\Models\OrderItem;
use App\Models\ProfileBanner;
use App\Models\ReviewRatings;
use App\Models\Store;
use App\Models\Stories;
use App\Models\User;
use App\Models\UserFollowers;
use App\Models\UserLike;
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

class BusinessUsersProfileController extends Controller
{

    public function updateProfile(Request $request)
    {
        $inputData  = $request->all();
        $user_token = $request->header('authorization');
        $jwt_user   = JWTAuth::parseToken()->authenticate($user_token);
        $user_id     = $jwt_user->id;


        $user = User::where('id', $user_id)->first();
        if (empty($user)) {
            $message = 'User Detail not found';
            return InvalidResponse($message, 101);
        }

        //$otp = generateRandomString(5);
        $update = User::where('id', $user_id)->first();

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
            $update->profile_picture = $imageName;
        }
    
        //$update->profile_picture = $profile;
        //$update->email = $request->business_email;
        $update->phone_number = $request->phone_number;
        $update->country_id = $request->country_id;
        $update->state_id = $request->state_id;
        $update->city_id = $request->city_id;
        $update->status = 0;
        $update->is_confirm = 0;
        $update->save();

        $bupdate = BusinessUsers::where('user_id', $user_id)->first();
        $bupdate->user_id = $update->id;
        $bupdate->company_name = $request->company_name;
        $bupdate->company_legal_name = $request->company_legal_name;
        $bupdate->owner_or_manager_name = $request->owner_or_manager_name;
        $bupdate->enter_cr_number = $request->enter_cr_number;
        $bupdate->date_of_expiry = $request->date_of_expiry;
        $bupdate->vat_number = $request->vat_number;
        $bupdate->bank_name = $request->bank_name;
        $bupdate->bank_account_number = $request->bank_account_number;
        $bupdate->Iban_number = $request->Iban_number;
        $bupdate->country_id = $request->country_id;
        $bupdate->state_id = $request->state_id;
        $bupdate->city_id = $request->city_id;
        $bupdate->enter_cr_maroof_namber = $request->enter_cr_maroof_namber;

        /* upload_cr */
        $upload_cr = $request->upload_cr;
        if (!empty($upload_cr)) {
            $destination = public_path('assets/users');
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $name = 'upload_cr_' . time();
            $upload_crName = $name . '.' . $upload_cr->getClientOriginalExtension();
            $upload_cr->move($destination, $upload_crName);

            $bupdate->upload_cr = $upload_crName;
           
        }

        /* upload_maroof */
        $upload_maroof = $request->upload_maroof;
        if (!empty($upload_maroof)) {
            $destination = public_path('assets/users');
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $name = 'upload_maroof_' . time();
            $upload_maroofName = $name . '.' . $upload_maroof->getClientOriginalExtension();
            $upload_maroof->move($destination, $upload_maroofName);
            $bupdate->upload_maroof = $upload_maroofName;
        }

        /*vatnumber_certificate */
        $upload_maroof = $request->upload_vat_number_Certificate;
        if (!empty($upload_maroof)) {
            $destination = public_path(BUSINESS_PROFILE_FOLDER);
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $name = 'vat_number_' . time();
            $upload_vat_number = $name . '.' . $upload_maroof->getClientOriginalExtension();
            $upload_maroof->move($destination, $upload_vat_number);
            $bupdate->vat_certificate_file = $upload_vat_number;
        }

        /* Return_policy */
        $upload_maroof = $request->Return_policy;
        if (!empty($upload_maroof)) {
            $destination = public_path(BUSINESS_PROFILE_FOLDER);
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $name = 'return_policy_' . time();
            $upload_return_policy = $name . '.' . $upload_maroof->getClientOriginalExtension();
            $upload_maroof->move($destination, $upload_return_policy);
            $bupdate->return_policy_file = $upload_return_policy;
        }
        $bupdate->save();

        $businessUsers = BusinessUsers::with('user')->where('user_id', $user_id)->get();
        $message = 'Update profile Successfully.';

        return SuccessResponse($message, 200, $businessUsers);
    }

    public function profile_pricture($picture)
    {
        $image = $picture;
        $profile_picture = $picture;
        if ($profile_picture) {
            $imagename = $picture;
            $destination = public_path('assets/users');
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $name = 'profile_picture_' . time();
            $imageName = $name . '.' . $image->getClientOriginalExtension();
            $image->move($destination, $imageName);
        } else {
            $imageName = $profile_picture;
        }
        return  $imageName;
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

        $userBanner = new ProfileBanner;
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
        $inputData  = $request->all();
        $user_token = $request->header('authorization');
        $jwt_user   = JWTAuth::parseToken()->authenticate($user_token);
        $userId     = $jwt_user->id;


        $userProfile = User::where('id', $userId)->first();

        $BusinessUsers = BusinessUsers::where('user_id', $userId)->first();
        $userProfile['BusinessUsers'] = $BusinessUsers;
        
        if (empty($userProfile)) {
            $message = "User Detail not found";
            return InvalidResponse($message, 101);
        }
        $userProfile = $userProfile->toArray();
        $bannerReplace = ProfileBanner::where('user_id', $userId)->orderBy('created_at', 'DESC')->first();
        $userProfile['BannerImage'] = $bannerReplace;

        $Story = Stories::where('deleted_at', '=', NULL)
                ->where('is_paid', '=', '1')
                ->where('user_id', '=',$userId)
                ->get();
    
        $userProfile['Story'] = $Story;

        $followingId = $userId ;
        $followerId = $userId;
        $following_user = UserFollowers::where(['following_id' => $userId, 'follow_unfollow_status' => TRUE])->count();
        $userProfile['following_user'] = $following_user;

        $follower_user = UserFollowers::where(['follower_id' => $userId, 'follow_unfollow_status' => TRUE])->count();
        $userProfile['follower_user'] = $follower_user;

        $follow_data = UserFollowers::where(['following_id' => $followingId, 'follower_id' => $followerId])->first();
        $userProfile['follow_data'] = $follow_data;


        $itemSold = OrderItem::where('user_id', $userId)->count();
        $userProfile['itemSold'] = $itemSold;

        $itemBought = OrderItem::where('customer_id', $userId)->count();
        $userProfile['itemBought'] = $itemBought;
        $limit = 10;
        $page_no = 1;
        if (isset($request->page) && $request->page != "") {
            $page_no = $request->page;
        }
        $start_from = ($page_no - 1) * $limit;

        $ItemList = Item::where([['user_id', '=', $userId], ['deleted_at', '=', NULL]])
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
            $wishlist = Wishlist::where('user_id', $userId)->where('item_id', $value['id'])->select('wishlist_status')->first();
            if(!empty($wishlist))
            {
                $ItemList[$key]['wishlist'] = 1;
            }

            $is_likelist = 0;
            $ItemList[$key]['Likelist'] = $is_likelist;
            $Likelist = UserLike::where('user_id', $userId)->where('item_id', $value['id'])->first();
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
}
