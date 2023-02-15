<?php

namespace App\Http\Controllers\Frontend\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
use App\Models\Inventory;
use App\Models\Orders;
use App\Models\ReviewRatings;
use Illuminate\Support\Facades\DB;

class MyItemsController extends Controller
{
    public function index() 
    {   
        $userId = Auth::user()->id;
        $itemsList = Item::where('user_id',$userId)->where('status','=','1')->orderBy('created_at','DESC')->get()->toArray();
        // dd($itemsList);
        $cate_name = Category::get();
        $categories = Category::select('id', 'category_name')->with('my_subcategory')->get()->toArray();
        $conditions = DB::table('conditions')->select('id', 'name')->get();
        $brands = DB::table('brand')->select('id', 'name')->get();

        $itemArray = [];
        foreach($itemsList as $key => $value)
        {
            $itemArray[$key] = $value;
            $itemsImage = ItemsImages::where('item_id',$value['id'])->first();
            $itemArray[$key]['item_pictures'] = $itemsImage;

            $condition = Condition::where('id',$value['condition_id'])->first();
            $itemArray[$key]['condition'] = $condition;

            $brand = Brand::where('id',$value['brand_id'])->first();
            $itemArray[$key]['brand'] = $brand;

            $store = Store::where('id',$value['store_id'])->first();
            $itemArray[$key]['store'] = $store;

            $boostItem = BoostItem::where('item_id',$value['id'])->where('is_paid','1')->first();
            $itemArray[$key]['boostItem'] = $boostItem;

            $wishlist = Wishlist::where('item_id',$value['id'])->first();
            $itemArray[$key]['wishlist'] = $wishlist;

            $user = User::where('id', $value['user_id'])->first();
            $itemArray[$key]['user'] = $user;

            $inventory = Inventory::where('item_id', $value['id'])->first();
            $itemArray[$key]['inventory'] = $inventory;

            $avg = ReviewRatings::where('item_id', $value['id']);
            $totalReviewAvg = $avg->avg('rating_star');
            $totalReviewAvg =  number_format($totalReviewAvg, 2);
            $itemArray[$key]['totalReviewAvg'] = $totalReviewAvg;

            $reviewRatings = ReviewRatings::where('item_id', $value['id'])->count();
            $itemArray[$key]['reviewRatings'] = $reviewRatings;

            $userCity = $user->city_id;
            $getCity = City::where('id', $userCity)->first();
            $itemArray[$key]['city'] = $getCity;
        }
        // dd($itemArray);
        return view('frontend.users.my_items.index', compact('itemArray','categories','cate_name','conditions','brands','userId'));
    }


    public function itemsFilterUser(Request $request){
        
        $user   = Auth::user();
        $orders = Orders::where('is_paid','=', TRUE);
                
        $orders->orderby('id', 'desc');
        if(!empty($request->item_types) && $request->item_types == 'on_sell'){
            //$orders->where('user_id', $user->id);
        }
        if(!empty($request->item_types) && $request->item_types == 'sold'){
            $orders->where('user_id', $user->id);
        }
        if(!empty($request->item_types) && $request->item_types == 'buy'){
            $orders->where('customer_id', $user->id);
        }
        if(!empty($request->item_types) && $request->item_types == 'booked_Items'){
            //$orders->where('user_id', $user->id);
        }

        $orderItemFilters = $orders->get()->toArray();
   
        $itemFiltersArray = [];
        foreach($orderItemFilters as $key => $value)
        {
            $itemFiltersArray[$key] = $value;

            $item = Item::where('id',$value['item_id'])->first();
            $itemFiltersArray[$key]['item'] = $item;

            $itemsImage = ItemsImages::where('item_id',$value['item_id'])->first();
            $itemFiltersArray[$key]['item_pictures'] = $itemsImage;

            $condition = Condition::where('id',$item['condition_id'])->first();
            $itemFiltersArray[$key]['condition'] = $condition;

            $brand = Brand::where('id',$item['brand_id'])->first();
            $itemFiltersArray[$key]['brand'] = $brand;

            $store = Store::where('id',$item['store_id'])->first();
            $itemFiltersArray[$key]['store'] = $store;

            $boostItem = BoostItem::where('item_id',$item['id'])->where('is_paid','1')->first();
            $itemFiltersArray[$key]['boostItem'] = $boostItem;

            $wishlist = Wishlist::where('item_id',$item['id'])->first();
            $itemFiltersArray[$key]['wishlist'] = $wishlist;

            $user = User::where('id', $value['user_id'])->first();
            $itemFiltersArray[$key]['user'] = $user;

            $userCity = $user->city_id;
            $getCity = City::where('id', $userCity)->first();
            $itemFiltersArray[$key]['city'] = $getCity;
        }

        
        return view('frontend.users.my_items.itemsFilter', compact('itemFiltersArray'));
    }
     public function userSubCateFilter(Request $request){
        $query = DB::table('items');
        $query->where("user_id",$request->userIds)->where('deleted_at','=',NULL)->orderBy('created_at', 'DESC');
        $query->where('status', '=', TRUE);
        // dd($query);
        if(isset($request->categorieIds) && !empty($request->categorieIds)){
            $query->whereIn('category_id', $request->categorieIds);
        }
        if(isset($request->subCateIds) && !empty($request->subCateIds)){
            $query->whereIn('sub_category_id', $request->subCateIds);
        }
        if(isset($request->brands) && !empty($request->brands)){
            $query->whereIn('brand_id', $request->brands);
        }
        if(isset($request->conditions) && !empty($request->conditions)){
            $query->whereIn('condition_id', $request->conditions);
        }
        if(isset($request->less) && !empty($request->less)){
            $query->where('quantity','<',10);
        }
        if(isset($request->outoffstock) && !empty($request->outoffstock)){
            $query->where('quantity','=',0);
        }

        $cateFilterArray = $query->get()->toArray();

        // dd($cateFilterArray);
        return view('frontend.users.my_items.product_filter', compact('cateFilterArray'));
     }
}
