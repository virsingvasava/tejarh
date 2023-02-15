<?php

namespace App\Http\Controllers\Frontend\Users;

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
use App\Models\Store;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\Item;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\CmsPage;
use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\Return_Policy;
use App\Models\Terms_condition;
use App\Models\UserDeliveryAddress;
use App\Models\UserFollowers;
use App\Models\UsersBannerImage;
use App\Models\SellerReviewRatings;
use App\Models\UserStory;
use DateTime;
use Lang;
use Mail;
use DB;

class ProfileSellerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index($id)
    {
        $userId = $id;
        $followingId = Auth::id();
        $followerId = $id;

        $bannerReplace = ProfileBanner::where('user_id', $userId)->orderBy('created_at', 'DESC')->first();
        $userBannerReplace = UsersBannerImage::where('user_id', $userId)->orderBy('created_at', 'DESC')->first();
        $category =  Category::where('status', ACTIVE)->where('deleted_at', '=', NULL)->get();
        $userStory = UserStory::select('category_id')->with('category')
        ->where('is_paid', '=', '1')
        ->where('user_id', '=', $userId)
        ->where('deleted_at', '=', NULL)
        ->groupBy('category_id')->get();

        $storyAll = UserStory::select('category_id')
        ->where('deleted_at', '=', NULL)
        ->where('is_paid', '=', '1')
        ->where('user_id', '=', $userId)
        ->groupBy('category_id')->get();

        $CheckCategory = array();
        foreach ($storyAll as $key => $cat) {
            $CheckCategory[] = $cat['category_id'];
        }
        $story = array();
        foreach ($CheckCategory as $key => $value) {
            $storyAll = UserStory::with('user', 'category')
            ->where('user_id', $userId)
            ->where('is_paid', '=', '1')
            ->where('deleted_at', '=', NULL)
            ->where('category_id', $value)
            ->get()->toArray();
            $story[] = $storyAll;
        }

        $userStoryNormal = UserStory::select('category_id')
        ->where('is_paid', '=', '1')
        ->with('category')
        ->where('user_id', '=', $userId)
        ->where('deleted_at', '=', NULL)
        ->groupBy('category_id')->get();
        $storyAllNormal = UserStory::select('category_id')
        ->where('is_paid', '=', '1')
        ->where('deleted_at', '=', NULL)
        ->where('user_id', '=', $userId)
        ->groupBy('category_id')->get();
        $CheckCategoryNormal = array();
        foreach ($storyAllNormal as $key => $cat) {
            $CheckCategoryNormal[] = $cat['category_id'];
        }
        $storyNormal = array();
        foreach ($CheckCategoryNormal as $key => $value) {
            $storyAllNormal = UserStory::with('user', 'category')
            ->where('is_paid', '=', '1')
            ->where('user_id', $userId)
            ->where('deleted_at', '=', NULL)
            ->where('category_id', $value)
            ->get()->toArray();
            $storyNormal[] = $storyAllNormal;
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

            $userData = User::where('id', $value['user_id'])->first();
            $itemArray[$key]['user'] = $userData;

            $userCity = $userData->city_id;
            $getCity = City::where('id', $userCity)->first();
            $itemArray[$key]['city'] = $getCity;
        }

        $following_user = UserFollowers::where(['follower_id' => $userId, 'follow_unfollow_status' => TRUE])->count();
        $follower_user = UserFollowers::where(['following_id' => $userId, 'follow_unfollow_status' => TRUE])->count();
        $follow_data = UserFollowers::where(['following_id' => $followingId, 'follower_id' => $followerId])->first();

        $profileArray = User::where('id', $userId)->first();
        
        $userCityID = $profileArray->city_id;
        $getCityName = City::where('id', $userCityID)->first();

        $userCountryID = $profileArray->country_id;
        $getCountryName = Country::where('id', $userCountryID)->first();

        $profileCity = UserDeliveryAddress::where('user_id', $userId)->first();
        $profileArrayBussiness = BusinessUsers::with(['user', 'store', 'items'])->where('user_id', $userId)
            ->first();

        $itemSold = OrderItem::where('user_id', $userId)->count();
        $itemBought = OrderItem::where('customer_id', $userId)->count();

        $pages = CmsPage::where('status', 1)->first();

        $return_policy = Return_Policy::where('user_id',$userId)->first();
        $term_condition = Terms_condition::where('user_id',$userId)->first();


        //# Seller Review Ratings #/
        $avg = SellerReviewRatings::where('seller_id', $id);
        $totalReviewAvg1 = $avg->avg('rating_star');
        $totalReviewAvg =  number_format($totalReviewAvg1, 2);
        $totalCountReviewRatings = SellerReviewRatings::where('seller_id',  $id)->count();
        //# Seller Review Ratings #/

        return view('frontend.users.pages.seller_profile.index', compact(
            'pages',
            'userBannerReplace',
            'bannerReplace',
            'category',
            'userStory',
            'story',
            'userStoryNormal',
            'storyNormal',
            'itemArray',
            'getCityName',
            'getCountryName',
            'profileArray',
            'following_user',
            'follower_user',
            'profileArrayBussiness',
            'profileCity',
            'itemSold',
            'itemBought',
            'followingId',
            'followerId',
            'follow_data',
            'return_policy',
            'term_condition',
            'totalReviewAvg',
            'totalCountReviewRatings'
        ));
    }

    public function followers(Request $request)
    {
        $data = UserFollowers::where(['following_id' => $request->following_id, 'follower_id' => $request->follower_id])->first();
        
        if (!empty($data)) {

            if ($request->follow_unfollow_status == 'Follow') {

                $status_update = UserFollowers::where(['following_id' => $request->following_id, 'follower_id' => $request->follower_id])->first();
                $status_update->following_id = $request->following_id;
                $status_update->follower_id = $request->follower_id;
                $status_update->follow_unfollow_status = FALSE;
                $status_update->save();
                $follower_user = UserFollowers::where(['follower_id' => $request->follower_id, 'follow_unfollow_status' => TRUE])->count();
                return response()->json(['data' => $follower_user, 'code' => 200, 'success' => "Successfully done ".$request->follow_unfollow_status.""], 200);

                

            } else {

                $status_update = UserFollowers::where(['following_id' => $request->following_id, 'follower_id' => $request->follower_id])->first();
                $status_update->following_id = $request->following_id;
                $status_update->follower_id = $request->follower_id;
                $status_update->follow_unfollow_status = TRUE;
                $status_update->save();
                $follower_user = UserFollowers::where(['follower_id' => $request->follower_id, 'follow_unfollow_status' => TRUE])->count();
                return response()->json(['data' => $follower_user, 'code' => 200, 'success' => "Successfully done ".$request->follow_unfollow_status.""], 200);

            }


        } else {

            $follow = new UserFollowers;
            $follow->following_id = $request->following_id;
            $follow->follower_id = $request->follower_id;
            $follow->follow_unfollow_status = true;
            $follow->save();
            $follower_user = UserFollowers::where(['follower_id' => $request->follower_id, 'follow_unfollow_status' => TRUE])->count();
            return response()->json(['data' => $follower_user, 'code' => 200, 'success' => "Successfully done ".$request->follow_unfollow_status.""], 200);


        }
    }
    public function import_images()
    {
        return view('frontend.users.profile-seller.import_images');
    }
}
