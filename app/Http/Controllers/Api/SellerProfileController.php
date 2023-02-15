<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BoostItem;
use App\Models\Brand;
use App\Models\BusinessUsers;
use App\Models\Category;
use App\Models\City;
use App\Models\CmsPage;
use App\Models\Condition;
use App\Models\Item;
use App\Models\ItemsImages;
use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\ProfileBanner;
use App\Models\Return_Policy;
use App\Models\SellerReviewRatings;
use App\Models\Store;
use App\Models\Stories;
use App\Models\Terms_condition;
use App\Models\User;
use App\Models\UserDeliveryAddress;
use App\Models\UserFollowers;
use App\Models\UserLike;
use App\Models\UsersBannerImage;
use App\Models\UserStory;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;

class SellerProfileController extends Controller
{
    public function SellerProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'users_id' => 'required',
        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message, 101);
        }
        $limit = 10;
        $page_no = 1;
        if (isset($request->page) && $request->page != "") {
            $page_no = $request->page;
        }
        $start_from = ($page_no - 1) * $limit;
        $userId = $request->users_id;
        $sellerProfile = User::where('id', $userId)->first();
        if (empty($sellerProfile)) {
            $message = "User Detail not found";
            return InvalidResponse($message, 101);
        }
        if ($sellerProfile->role == USER_ROLE) {

            $sellerProfile = $sellerProfile->toArray();

            $userBannerReplace = UsersBannerImage::where('user_id', $userId)->orderBy('created_at', 'DESC')->first();
            $sellerProfile['BannerImage'] = $userBannerReplace;

            $userStory = UserStory::where('deleted_at', '=', NULL)
                ->where('is_paid', '=', '1')
                ->where('user_id', '=', $userId)
                ->get();

            $sellerProfile['Story'] = $userStory;

            $profileCity = UserDeliveryAddress::where('user_id', $userId)->first();
            $sellerProfile['profileCity'] = $profileCity;

            $followingId = $userId;
            $followerId = $userId;
            $following_user = UserFollowers::where(['following_id' => $userId, 'follow_unfollow_status' => TRUE])->count();
            $sellerProfile['following_user'] = $following_user;

            $follower_user = UserFollowers::where(['follower_id' => $userId, 'follow_unfollow_status' => TRUE])->count();
            $sellerProfile['follower_user'] = $follower_user;

            $follow_data = UserFollowers::where(['following_id' => $followingId, 'follower_id' => $followerId])->first();
            $sellerProfile['follow_data'] = $follow_data;


            $itemSold = OrderItem::where('user_id', $userId)->count();
            $sellerProfile['itemSold'] = $itemSold;

            $itemBought = OrderItem::where('customer_id', $userId)->count();
            $sellerProfile['itemBought'] = $itemBought;

            $avg = SellerReviewRatings::where('seller_id', $userId);
            $totalReviewAvg1 = $avg->avg('rating_star');
            $totalReviewAvg =  number_format($totalReviewAvg1, 2);
            $sellerProfile['totalSellerReviewRatings'] = $totalReviewAvg;

            $totalCountReviewRatings = SellerReviewRatings::where('seller_id',  $userId)->count();
            $sellerProfile['totalCountSellerReviewRatings'] = $totalCountReviewRatings;

            $itemsList = Item::where('user_id', $userId)
                ->where('status', '=', '1')
                ->orderBy('created_at', 'DESC')
                ->skip($start_from)->take($limit)
                ->get()
                ->toArray();

            foreach ($itemsList as $key => $value) {
                $itemsImage = ItemsImages::where('item_id', $value['id'])->first();
                $itemsList[$key]['item_pictures'] = $itemsImage;

                $condition = Condition::where('id', $value['condition_id'])->first();
                $itemsList[$key]['condition'] = $condition;

                $brand = Brand::where('id', $value['brand_id'])->first();
                $itemsList[$key]['brand'] = $brand;

                $boostItem = BoostItem::where('item_id', $value['id'])->where('is_paid', '1')->first();
                $itemsList[$key]['boostItem'] = $boostItem;

                $is_wishlist = 0;
                $itemsList[$key]['item']['wishlist'] = $is_wishlist;
                $wishlist = Wishlist::where('user_id', $userId)->where('item_id', $value['id'])->select('wishlist_status')->first();
                if (!empty($wishlist)) {
                    $itemsList[$key]['item']['wishlist'] = 1;
                }
                $is_likelist = 0;
                $itemsList[$key]['item']['Likelist'] = $is_likelist;
                $Likelist = UserLike::where('user_id', $userId)->where('item_id', $value['id'])->first();
                if (!empty($Likelist)) {
                    $itemsList[$key]['item']['Likelist'] = 1;
                }

                $userData = User::where('id', $value['user_id'])->first();
                // $itemsList[$key]['user'] = $userData;

                $userCity = $userData->city_id;
                $getCity = City::where('id', $userCity)->first();
                $itemsList[$key]['city'] = $getCity;
            }
            $sellerProfile['itemList'] = $itemsList;
        } else {
            $sellerProfile = $sellerProfile->toArray();
            $bannerReplace = ProfileBanner::where('user_id', $userId)->orderBy('created_at', 'DESC')->first();
            $sellerProfile['BannerImage'] = $bannerReplace;

            $profileArrayBussiness = BusinessUsers::with(['user', 'store', 'items'])->where('user_id', $userId)
                ->first();
            $sellerProfile['profile'] = $profileArrayBussiness;

            $Story = Stories::where('deleted_at', '=', NULL)
                ->where('is_paid', '=', '1')
                ->where('user_id', '=', $userId)
                ->get();

            $sellerProfile['Story'] = $Story;

            $profileCity = UserDeliveryAddress::where('user_id', $userId)->first();
            $sellerProfile['profileCity'] = $profileCity;

            $return_policy = Return_Policy::where('user_id', $userId)->first();
            $sellerProfile['return_policy'] = $return_policy;

            $term_condition = Terms_condition::where('user_id', $userId)->first();
            $sellerProfile['term_condition'] = $term_condition;

            $followingId = $userId;
            $followerId = $userId;
            $following_user = UserFollowers::where(['following_id' => $userId, 'follow_unfollow_status' => TRUE])->count();
            $sellerProfile['following_user'] = $following_user;

            $follower_user = UserFollowers::where(['follower_id' => $userId, 'follow_unfollow_status' => TRUE])->count();
            $sellerProfile['follower_user'] = $follower_user;

            $follow_data = UserFollowers::where(['following_id' => $followingId, 'follower_id' => $followerId])->first();
            $sellerProfile['follow_data'] = $follow_data;


            $itemSold = OrderItem::where('user_id', $userId)->count();
            $sellerProfile['itemSold'] = $itemSold;

            $itemBought = OrderItem::where('customer_id', $userId)->count();
            $sellerProfile['itemBought'] = $itemBought;

            $avg = SellerReviewRatings::where('seller_id', $userId);
            $totalReviewAvg1 = $avg->avg('rating_star');
            $totalReviewAvg =  number_format($totalReviewAvg1, 2);
            $sellerProfile['totalSellerReviewRatings'] = $totalReviewAvg;

            $totalCountReviewRatings = SellerReviewRatings::where('seller_id',  $userId)->count();
            $sellerProfile['totalCountSellerReviewRatings'] = $totalCountReviewRatings;

            $itemsList = Item::where('user_id', $userId)
                ->where('status', '=', '1')
                ->orderBy('created_at', 'DESC')
                ->get()
                ->toArray();
            foreach ($itemsList as $key => $value) {
                $itemsImage = ItemsImages::where('item_id', $value['id'])->first();
                $sellerProfile[$key]['item_pictures'] = $itemsImage;

                $condition = Condition::where('id', $value['condition_id'])->first();
                $sellerProfile[$key]['condition'] = $condition;

                $brand = Brand::where('id', $value['brand_id'])->first();
                $sellerProfile[$key]['brand'] = $brand;

                $store = Store::where('id', $value['store_id'])->first();
                $sellerProfile[$key]['store'] = $store;

                $boostItem = BoostItem::where('item_id', $value['id'])->where('is_paid', '1')->first();
                $sellerProfile[$key]['boostItem'] = $boostItem;

                $is_wishlist = 0;
                $sellerProfile[$key]['item']['wishlist'] = $is_wishlist;
                $wishlist = Wishlist::where('user_id', $userId)->where('item_id', $value['id'])->select('wishlist_status')->first();
                if (!empty($wishlist)) {
                    $sellerProfile[$key]['item']['wishlist'] = 1;
                }
                $is_likelist = 0;
                $sellerProfile[$key]['item']['Likelist'] = $is_likelist;
                $Likelist = UserLike::where('user_id', $userId)->where('item_id', $value['id'])->first();
                if (!empty($Likelist)) {
                    $sellerProfile[$key]['item']['Likelist'] = 1;
                }

                $userData = User::where('id', $value['user_id'])->first();
                $sellerProfile[$key]['user'] = $userData;

                $userCity = $userData->city_id;
                $getCity = City::where('id', $userCity)->first();
                $sellerProfile[$key]['city'] = $getCity;
            }
            $sellerProfile['itemList'] = $itemsList;
        }
        $message = 'User detail';
        return SuccessResponse($message, 200, $sellerProfile);
    }

    public function followers(Request $request)
    {
        $user_token = $request->header('authorization');

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $validator = Validator::make($request->all(), [
            'following_id' => 'required',
            'follower_id' => 'required',
        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message, 101);
        }

        $data = UserFollowers::where(['following_id' => $request->following_id, 'follower_id' => $request->follower_id])->first();
        if (!empty($data)) {

            if ($request->follow_unfollow_status == 'Follow') {

                $status_update = UserFollowers::where(['following_id' => $request->following_id, 'follower_id' => $request->follower_id])->first();
                $status_update->following_id = $request->following_id;
                $status_update->follower_id = $request->follower_id;
                $status_update->follow_unfollow_status = FALSE;
                $status_update->save();
                $follower_user = UserFollowers::where(['follower_id' => $request->follower_id, 'follow_unfollow_status' => TRUE])->count();
                $message = 'Successfully done';
                return SuccessResponse($message, 200, $status_update);
            } else {

                $status_update = UserFollowers::where(['following_id' => $request->following_id, 'follower_id' => $request->follower_id])->first();
                $status_update->following_id = $request->following_id;
                $status_update->follower_id = $request->follower_id;
                $status_update->follow_unfollow_status = TRUE;
                $status_update->save();
                $follower_user = UserFollowers::where(['follower_id' => $request->follower_id, 'follow_unfollow_status' => TRUE])->count();
                $message = 'Successfully done';
                return SuccessResponse($message, 200, $status_update);
            }
        } else {

            $follow = new UserFollowers;
            $follow->following_id = $request->following_id;
            $follow->follower_id = $request->follower_id;
            $follow->follow_unfollow_status = true;
            $follow->save();
            $follower_user = UserFollowers::where(['follower_id' => $request->follower_id, 'follow_unfollow_status' => TRUE])->count();
            $message = 'Successfully done';
            return SuccessResponse($message, 200, $follow);
        }
    }

    public function unfollower(Request $request)
    {
        $user_token = $request->header('authorization');

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        //$user_id = $jwt_user->id;

        $validator = Validator::make($request->all(), [
            'following_id' => 'required',
            'follower_id' => 'required',
        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message, 101);
        }
        $follow = UserFollowers::where([['follower_id',$request->follower_id],['following_id',$request->following_id]])->first();
        $follow->follow_unfollow_status = FALSE;
        $follow->save();

        $message = 'Successfully done';
        return SuccessResponse($message, 200, $follow);
    }

    public function followerlisting(Request $request)
    {
        $user_token = $request->header('authorization');

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $userId = $jwt_user->id;
        $limit = 10;
        $page_no = 1;
        if (isset($request->page) && $request->page != "") {
            $page_no = $request->page;
        }
        $start_from = ($page_no - 1) * $limit;

        $userList = UserFollowers::where(['follower_id' => $userId, 'follow_unfollow_status' => 1])
        ->skip($start_from)->take($limit)
        ->get()->toArray();

        $followingArr = [];
        foreach ($userList as $key => $value) {

            $followingArr[$key] = $value;

            $user = User::where('id', $value['following_id'])->first();
            $followingArr[$key]['user'] = $user;
        }
        $message = 'Successfully done';
        return SuccessResponse($message, 200, $followingArr);
    }

    public function followinglisting(Request $request)
    {
        $user_token = $request->header('authorization');

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $userId = $jwt_user->id;
        $limit = 10;
        $page_no = 1;
        if (isset($request->page) && $request->page != "") {
            $page_no = $request->page;
        }
        $start_from = ($page_no - 1) * $limit;

        $userList = UserFollowers::where(['following_id' => $userId, 'follow_unfollow_status' => 1])
        ->skip($start_from)->take($limit)
        ->get()->toArray();

        $followingArr = [];
        foreach ($userList as $key => $value) {

            $followingArr[$key] = $value;

            $user = User::where('id', $value['follower_id'])->first();
            $followingArr[$key]['user'] = $user;
        }
        $message = 'Successfully done';
        return SuccessResponse($message, 200, $followingArr);
    }
    public function sold_details(Request $request)
    {
        $user_token = $request->header('authorization');

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $userId = $jwt_user->id;
        $user_id = $jwt_user->id;

        $limit = 10;
        $page_no = 1;
        if (isset($request->page) && $request->page != "") {
            $page_no = $request->page;
        }
        $start_from = ($page_no - 1) * $limit;
        
        $itemArray = [];
        $orderItems = OrderItem::where('user_id', $userId)->skip($start_from)->take($limit)->get()->ToArray();
        foreach ($orderItems as $orderKey => $orderValue) {
            $itemArray[$orderKey] = $orderValue;

            $item = Item::where('id', $orderValue['item_id'])->first();
            $itemArray[$orderKey]['item'] = $item;

            $itemsImage = ItemsImages::where('item_id', $item['id'])->first();
            $itemArray[$orderKey]['item']['item_pictures'] = $itemsImage;

            $condition = Condition::where('id', $item['condition_id'])->first();
            $itemArray[$orderKey]['item']['condition'] = $condition;

            $brand = Brand::where('id', $item['brand_id'])->first();
            $itemArray[$orderKey]['item']['brand'] = $brand;

            $store = Store::where('id', $item['store_id'])->first();
            $itemArray[$orderKey]['item']['store'] = $store;

            $boostItem = BoostItem::where('item_id', $item['id'])->where('is_paid', '1')->first();
            $itemArray[$orderKey]['item']['boostItem'] = $boostItem;

            $is_wishlist = 0;
            $itemArray[$orderKey]['item']['wishlist'] = $is_wishlist;
            $wishlist = Wishlist::where('user_id', $userId)->where('item_id', $item['id'])->select('wishlist_status')->first();
            if (!empty($wishlist)) {
                $itemArray[$orderKey]['item']['wishlist'] = 1;
            }
            $is_likelist = 0;
            $itemArray[$orderKey]['item']['Likelist'] = $is_likelist;
            $Likelist = UserLike::where('user_id', $userId)->where('item_id', $item['id'])->first();
            if (!empty($Likelist)) {
                $itemArray[$orderKey]['item']['Likelist'] = 1;
            }

            $order = Orders::where('id', $orderValue['order_id'])->first();
            $itemArray[$orderKey]['order'] = $order;

            $user = User::where('id', $orderValue['customer_id'])->first();
            $itemArray[$orderKey]['item']['user'] = $user;

            $userCity = $user->city_id;
            $getCity = City::where('id', $userCity)->first();
            $itemArray[$orderKey]['item']['city'] = $getCity;
        }
        $message = 'sold-list';
        return SuccessResponse($message, 200, $itemArray);
    }

    public function bought_details(Request $request)
    {
        $user_token = $request->header('authorization');

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $userId = $jwt_user->id;
        $limit = 10;
        $page_no = 1;
        if (isset($request->page) && $request->page != "") {
            $page_no = $request->page;
        }
        $start_from = ($page_no - 1) * $limit;
        $itemArray = [];
        $orderItems = OrderItem::where('customer_id', $userId)->skip($start_from)->take($limit)->get()->ToArray();
        foreach ($orderItems as $orderKey => $orderValue) {
            $itemArray[$orderKey] = $orderValue;

            $item = Item::where('id', $orderValue['item_id'])->first();
            $itemArray[$orderKey]['item'] = $item;

            $itemsImage = ItemsImages::where('item_id', $item['id'])->first();
            $itemArray[$orderKey]['item']['item_pictures'] = $itemsImage;

            $condition = Condition::where('id', $item['condition_id'])->first();
            $itemArray[$orderKey]['item']['condition'] = $condition;

            $brand = Brand::where('id', $item['brand_id'])->first();
            $itemArray[$orderKey]['item']['brand'] = $brand;

            $store = Store::where('id', $item['store_id'])->first();
            $itemArray[$orderKey]['item']['store'] = $store;

            $boostItem = BoostItem::where('item_id', $item['id'])->where('is_paid', '1')->first();
            $itemArray[$orderKey]['item']['boostItem'] = $boostItem;

            $is_wishlist = 0;
            $itemArray[$orderKey]['item']['wishlist'] = $is_wishlist;
            $wishlist = Wishlist::where('user_id', $userId)->where('item_id', $item['id'])->select('wishlist_status')->first();
            if (!empty($wishlist)) {
                $itemArray[$orderKey]['item']['wishlist'] = 1;
            }
            $is_likelist = 0;
            $itemArray[$orderKey]['item']['Likelist'] = $is_likelist;
            $Likelist = UserLike::where('user_id', $userId)->where('item_id', $item['id'])->first();
            if (!empty($Likelist)) {
                $itemArray[$orderKey]['item']['Likelist'] = 1;
            }

            $order = Orders::where('id', $orderValue['order_id'])->first();
            $itemArray[$orderKey]['item']['order'] = $order;

            $user = User::where('id', $orderValue['user_id'])->first();
            $itemArray[$orderKey]['item']['user'] = $user;

            $userCity = $user->city_id;
            $getCity = City::where('id', $userCity)->first();
            $itemArray[$orderKey]['item']['city'] = $getCity;
        }
        $message = 'Bought-list';
        return SuccessResponse($message, 200, $itemArray);
    }
}
