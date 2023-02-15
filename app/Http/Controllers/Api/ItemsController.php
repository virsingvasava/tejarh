<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BoostItem;
use App\Models\Brand;
use Illuminate\Http\Request;

use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\City;
use App\Models\Commission;
use App\Models\Condition;
use App\Models\Inventory;
use App\Models\Item;
use App\Models\ItemsImages;
use App\Models\Orders;
use App\Models\Product;
use App\Models\ReviewRatings;
use App\Models\stock;
use App\Models\Store;
use App\Models\SubCategory;
use App\Models\User;
use App\Models\UserLike;
use App\Models\Wishlist;
use JWTFactory;
use Validator;
use Response;
use JWTAuth;
use Mail;
use File;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\JWTAuth as JWTAuthJWTAuth;

class ItemsController extends Controller
{
    public function newItemList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id',
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
        $userId = $request->user_id;

        $conditionArr = Condition::where('name', NEW_ITEMS)->first();
        $newitemsConId = $conditionArr->id;
        $newItemsList = Item::where([["condition_id", "=", $newitemsConId], ['deleted_at', '=', NULL]])
            ->where('status', '=', '1')
            ->skip($start_from)->take($limit)
            ->orderBy('created_at', 'DESC')->get()->toArray();

        // $newItemsList_count = Item::where([["condition_id", "=", $newitemsConId], ['deleted_at', '=', NULL]])
        //     ->where('status', '=', '1')
        //     ->orderBy('created_at', 'DESC')->get()->count();

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

            $is_wishlist = 0;
            $newItemsListArray[$key]['wishlist'] = $is_wishlist;
            $wishlist = Wishlist::where('user_id', $userId)->where('item_id', $value['id'])->select('wishlist_status')->first();
            if(!empty($wishlist))
            {
                $newItemsListArray[$key]['wishlist'] = 1;
            }
            $is_likelist = 0;
            $newItemsListArray[$key]['Likelist'] = $is_likelist;
            $Likelist = UserLike::where('user_id', $userId)->where('item_id', $value['id'])->first();
            if(!empty($Likelist))
            {
                $newItemsListArray[$key]['Likelist'] = 1;
            }

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

        if (empty($newItemsList)) {
            $message = "New item not found";
            return InvalidResponse($message, 101);
        }
        $message = 'Fetch new items listing successfully.';
        return SuccessResponse($message, 200,$newItemsListArray);
    }

    public function  usedItemList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id',
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
        $userId = $request->user_id;

        // $inputData = $request->all();
        $usedItemsId = Condition::where('name', USED_ITEMS)->first();
        $useditemsConId = $usedItemsId->id;
        $usedItemList = Item::where([["condition_id", "=", $useditemsConId], ['deleted_at', '=', NULL]])
        ->where('status', '=', '1')
        ->skip($start_from)->take($limit)
        ->orderBy('created_at', 'DESC')->get()->toArray();
        $usedItemsListArray = [];
        foreach ($usedItemList as $key => $value) {
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
            
            $is_wishlist = 0;
            $usedItemsListArray[$key]['wishlist'] = $is_wishlist;
            $wishlist = Wishlist::where('user_id', $userId)->where('item_id', $value['id'])->select('wishlist_status')->first();
            if(!empty($wishlist))
            {
                $usedItemsListArray[$key]['wishlist'] = 1;
            }
            $is_likelist = 0;
            $usedItemsListArray[$key]['Likelist'] = $is_likelist;
            $Likelist = UserLike::where('user_id', $userId)->where('item_id', $value['id'])->first();
            if(!empty($Likelist))
            {
                $usedItemsListArray[$key]['Likelist'] = 1;
            }
            
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
        
        if (empty($usedItemList)) {
            $message = "Used item not found";
            return InvalidResponse($message, 101);
        }
        $message = 'Fetch used item successfully.';
        return SuccessResponse($message, 200, $usedItemsListArray);
    }
    
    public function  usedItemDetail(Request $request)
    {
        
        $inputData = $request->all();
        
        $usedItemDetail = Category::all();
        
        if (empty($usedItemDetail)) {
            $message = "Used item details not found";
            return InvalidResponse($message, 101);
        }
        $message = 'Fetch used item details successfully.';
        return SuccessResponse($message, 200, $usedItemDetail);
    }
    
    public function unusedItemList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id',
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
        $userId = $request->user_id;

        $unusedItemsId = Condition::where('name', UNUSED_ITEMS)->first();
        $unuseditemsConId = $unusedItemsId->id;
        $unusedItemsList = Item::where([['condition_id', '=', $unuseditemsConId], ['deleted_at', '=', NULL]])
        ->where('status', '=', '1')
        ->skip($start_from)->take($limit)
        ->orderBy('created_at', 'DESC')->get()->toArray();
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
            
            $is_wishlist = 0;
            $unusedItemsListArray[$key]['wishlist'] = $is_wishlist;
            $wishlist = Wishlist::where('user_id', $userId)->where('item_id', $value['id'])->select('wishlist_status')->first();
            if(!empty($wishlist))
            {
                $unusedItemsListArray[$key]['wishlist'] = 1;
            }
            $is_likelist = 0;
            $unusedItemsListArray[$key]['Likelist'] = $is_likelist;
            $Likelist = UserLike::where('user_id', $userId)->where('item_id', $value['id'])->first();
            if(!empty($Likelist))
            {
                $unusedItemsListArray[$key]['Likelist'] = 1;
            }
            
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
        if (empty($unusedItemsList)) {
            $message = "Unused item not found";
            return InvalidResponse($message, 101);
        }
        $message = 'Fetch Unused item successfully.';
        return SuccessResponse($message, 200, $unusedItemsListArray);
    }

    public function promotedItemList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id',
        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message, 101);
        }
        $userId = $request->user_id;
        $limit = 10;
        $page_no = 1;
        if (isset($request->page) && $request->page != "") {
            $page_no = $request->page;
        }
        $start_from = ($page_no - 1) * $limit;
        
        // $promoted_items_count = BoostItem::where([['deleted_at', '=', NULL]])->orderBy('created_at', 'DESC')->where('is_paid', '1')->get()->count();
        $itemsList = BoostItem::where([['deleted_at', '=', NULL]])->orderBy('created_at', 'DESC')->where('is_paid', '1')->get()->skip($start_from)->take($limit)->toArray();
        $itemArray = [];
        foreach ($itemsList as $key => $value) {
            
            $itemArray[$key] = $value;
            
            $items = Item::where('id', $value['item_id'])->where('status', '=', '1')->first();
            $itemArray[$key]['item'] = $items;
            
            $itemsImage = ItemsImages::where('item_id', $items['id'])->first();
            $itemArray[$key]['item']['item_pictures'] = $itemsImage;
            
            $condition = Condition::where('id', $items['condition_id'])->first();
            $itemArray[$key]['item']['condition'] = $condition;
            
            $brand = Brand::where('id', $items['brand_id'])->first();
            $itemArray[$key]['item']['brand'] = $brand;
            
            $store = Store::where('id', $items['store_id'])->first();
            $itemArray[$key]['item']['store'] = $store;
            
            $boostItem = BoostItem::where('item_id', $items['id'])->where('is_paid', TRUE)->first();
            $itemArray[$key]['item']['boostItem'] = $boostItem;
            
            $is_wishlist = 0;
            $itemArray[$key]['item']['wishlist'] = $is_wishlist;
            $wishlist = Wishlist::where('user_id', $userId)->where('item_id', $value['id'])->select('wishlist_status')->first();
            if(!empty($wishlist))
            {
                $itemArray[$key]['item']['wishlist'] = 1;
            }
            $is_likelist = 0;
            $itemArray[$key]['item']['Likelist'] = $is_likelist;
            $Likelist = UserLike::where('user_id', $userId)->where('item_id', $value['id'])->first();
            if(!empty($Likelist))
            {
                $itemArray[$key]['item']['Likelist'] = 1;
            }
            
            $user = User::where('id', $value['user_id'])->first();
            $itemArray[$key]['item']['user'] = $user;
            
            $userCity = $user->city_id;
            $getCity = City::where('id', $userCity)->first();
            $itemArray[$key]['item']['city'] = $getCity;
                
            $avg = ReviewRatings::where('item_id', $value['id']);
            $totalReviewAvg = $avg->avg('rating_star');
            $totalReviewAvg =  number_format($totalReviewAvg, 2);
            $itemArray[$key]['totalReviewAvg'] = $totalReviewAvg;
            
            $reviewRatings = ReviewRatings::where('item_id', $value['id'])->count();
            $itemArray[$key]['reviewRatings'] = $reviewRatings;
            
        }
        if (empty($itemsList)) {
            $message = "Unused item not found";
            return InvalidResponse($message, 101);
        }
        $message = 'Fetch Unused item successfully.';
        return SuccessResponse($message, 200, $itemArray);
    }
    
    public function recommendationList(Request $request)
    {
    
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
    
        $recommendationList = Category::all();
    
        if (empty($recommendationList)) {
            $message = "Recommendation not found";
            return InvalidResponse($message, 101);
        }
        $message = 'Fetch recommendation listing successfully.';
        return SuccessResponse($message, 200, $recommendationList);
    }
    
    public function recommendationPostDetail(Request $request)
    {
    
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
    
        $recommendationPostDetail = Category::all();
    
        if (empty($recommendationPostDetail)) {
            $message = "Recommendation post detail not found";
            return InvalidResponse($message, 101);
        }
        $message = 'Fetch recommendation post detail successfully.';
        return SuccessResponse($message, 200, $recommendationPostDetail);
    }

    public function subcategoryItemList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sub_category_id' => 'required',
            'user_id'
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
        $userId = $request->user_id;
        $subcategoryItemList = $request->sub_category_id;
        $subcategoryItemList = Item::where([['sub_category_id', '=', $subcategoryItemList], ['deleted_at', '=', NULL]])
        ->where('status', '=', '1')
        ->skip($start_from)->take($limit)
        ->orderBy('created_at', 'DESC')->get()->toArray();
        $subcategoryItemListArray = [];
        foreach ($subcategoryItemList as $key => $value) {
            $subcategoryItemListArray[$key] = $value;
            $itemsImage = ItemsImages::where('item_id', $value['id'])->first();
            $subcategoryItemListArray[$key]['item_pictures'] = $itemsImage;

            $condition = Condition::where('id', $value['condition_id'])->first();
            $subcategoryItemListArray[$key]['condition'] = $condition;
            
            $brand = Brand::where('id', $value['brand_id'])->first();
            $subcategoryItemListArray[$key]['brand'] = $brand;
            
            $store = Store::where('id', $value['store_id'])->first();
            $subcategoryItemListArray[$key]['store'] = $store;
            
            $boostItem = BoostItem::where('item_id', $value['id'])->where('is_paid', '1')->first();
            $subcategoryItemListArray[$key]['boostItem'] = $boostItem;

            $user = User::where('id', $value['user_id'])->first();
            $subcategoryItemListArray[$key]['user'] = $user;

            $is_wishlist = 0;
            $unusedItemsListArray[$key]['wishlist'] = $is_wishlist;
            $wishlist = Wishlist::where('user_id', $userId)->where('item_id', $value['id'])->select('wishlist_status')->first();
            if(!empty($wishlist))
            {
                $unusedItemsListArray[$key]['wishlist'] = 1;
            }
            $is_likelist = 0;
            $unusedItemsListArray[$key]['Likelist'] = $is_likelist;
            $Likelist = UserLike::where('user_id', $userId)->where('item_id', $value['id'])->first();
            if(!empty($Likelist))
            {
                $unusedItemsListArray[$key]['Likelist'] = 1;
            }
            
            $userCity = $user->city_id;
            $getCity = City::where('id', $userCity)->first();
            $subcategoryItemListArray[$key]['city'] = $getCity;
            
            
            $avg = ReviewRatings::where('item_id', $value['id']);
            $totalReviewAvg = $avg->avg('rating_star');
            $totalReviewAvg =  number_format($totalReviewAvg, 2);
            $subcategoryItemListArray[$key]['totalReviewAvg'] = $totalReviewAvg;
            
            $reviewRatings = ReviewRatings::where('item_id', $value['id'])->count();
            $subcategoryItemListArray[$key]['reviewRatings'] = $reviewRatings;
        }
        if (empty($subcategoryItemList)) {
            $message = "SubCategory item not found";
            return InvalidResponse($message, 101);
        }
        $message = 'Fetch SubCategory item successfully.';
        return SuccessResponse($message, 200, $subcategoryItemListArray);
        // $subcategoryItemListArray = [];

        // if(!empty($subcategoryItemList)){

        // }
    }

    public function Itemfilter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sub_category_id' => 'required',
            'conditions',
            'minPrice',
            'maxPrice',
            'brands',
            'sorting_data',
            'user_id',
        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message, 101);
        }
        $userId = $request->user_id;
        $limit = 10;
        $page_no = 1;
        if (isset($request->page) && $request->page != "") {
            $page_no = $request->page;
        }
        $start_from = ($page_no - 1) * $limit;
        $subcategoryItemList = $request->sub_category_id;
        $userId = $request->user_id;

        $query = DB::table('items');
        $query->where("sub_category_id",$subcategoryItemList)->orderBy('created_at', 'DESC');
        $query->where('status', '=', TRUE);
        $query->skip($start_from)->take($limit);

        
        if(isset($request->conditions) && !empty($request->conditions)){
            $query->where('condition_id', $request->conditions);
        }
        $minPrice = $request->minPrice == 0 ? 1 : $request->minPrice;
       
        if(!empty($minPrice) && !empty($request->maxPrice)){        
            $query->whereBetween('price', [(int)$minPrice, (int)$request->maxPrice]);
        }

        if(isset($request->brands) && !empty($request->brands)){
            $query->where('brand_id', $request->brands);
        }
        if(isset($request->cities) && !empty($request->cities)){
            $query->where('zip_code', $request->cities);
        }
        
        if ($request->sorting_data == 'asc') {
            $query->orderBy('price','ASC');
        }
        if($request->sorting_data == 'desc') {
            $query->orderBy('price','DESC');
        } 
             
        $cateFilterArray = $query->get()->toArray();
        
        $message = 'Item Filter successfully.';
        return SuccessResponse($message, 200, $cateFilterArray);
    }

    public function usercommission(Request $request)
    {
        $commission = Commission::where('type','commission_user')->first();
        $message = 'Commission Successfully.';
        return SuccessResponse($message, 200, $commission);
    }

    public function businesscommission(Request $request)
    {
        $commission = Commission::where('type','commission_business_user')->first();
        $message = 'Commission Successfully.';
        return SuccessResponse($message, 200, $commission);
    }
}
    