<?php

namespace App\Http\Controllers\Frontend\Users;

use App\Http\Controllers\Controller;
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
use App\Models\City;
use App\Models\UserLike;
use App\Models\Wishlist;
use DateTime;
use Lang;
use Mail;
use DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use App\Models\ReviewRatings;

class ProductCategoryController extends Controller
{
    public function index($id)
    {
        $newItemsList = Item::where([['deleted_at', '=', NULL], ["category_id", "=", $id]])
                        ->where('status', '=', TRUE)
                        ->orderBy('created_at', 'DESC')->get()->toArray();

        $usedItemsArray = [];
        foreach ($newItemsList as $key => $value) {

            $usedItemsArray[$key] = $value;

            $itemsImage = ItemsImages::where('item_id', $value['id'])->first();
            $usedItemsArray[$key]['item_pictures'] = $itemsImage;

            $condition = Condition::where('id', $value['condition_id'])->first();
            $usedItemsArray[$key]['condition'] = $condition;
        
            $brand = Brand::where('id', $value['brand_id'])->first();
            $usedItemsArray[$key]['brand'] = $brand;

            $store = Store::where('id', $value['store_id'])->first();
            $usedItemsArray[$key]['store'] = $store;

            $boostItem = BoostItem::where('item_id', $value['id'])->where('is_paid', '1')->first();
            $usedItemsArray[$key]['boostItem'] = $boostItem;

            $user = User::where('id', $value['user_id'])->first();
            $usedItemsArray[$key]['user'] = $user;

            $userCity = $user->city_id;
            $getCity = City::where('id', $userCity)->first();
            $usedItemsArray[$key]['city'] = $getCity;

            $avg = ReviewRatings::where('item_id', $value['id']);
            $totalReviewAvg = $avg->avg('rating_star');
            $totalReviewAvg =  number_format($totalReviewAvg, 2);
            $usedItemsArray[$key]['totalReviewAvg'] = $totalReviewAvg;

            $reviewRatings = ReviewRatings::where('item_id', $value['id'])->count();
            $usedItemsArray[$key]['reviewRatings'] = $reviewRatings;
    
        }

        $cate_name = Category::where('id', $id)->first();
        $categories = DB::table('category')->select('id', 'category_name', 'ar_category_name')->get();
        $sub_categories = DB::table('sub_category')->select('id', 'sub_cate_name','ar_sub_cate_name', 'category_id')->where('category_id', $id)->get();
        $conditions = DB::table('conditions')->select('id', 'name', 'ar_name')->get();
        $brands = DB::table('brand')->select('id', 'name', 'ar_name')->where('category_id', $id)->get();
        $locations = DB::table('cities')->select('id', 'name')->get();

        $minprice = DB::table('items')->select('*')->where('category_id','=',$id)->min('price');
        $maxprice =  DB::table('items')->select('*')->where('category_id','=',$id)->max('price');

        return view('frontend.users.pages.product_category.index', compact('id','usedItemsArray', 'cate_name', 'categories', 'sub_categories', 'conditions', 'brands', 'locations', 'minprice', 'maxprice'));
    }

    public function userSubCateFilter(Request $request)
    {  
        $query = DB::table('items');
        $query->where("category_id",$request->cateIds)->orderBy('created_at', 'DESC');
        $query->where('status', '=', TRUE);
        
        if(isset($request->subCateIds) && !empty($request->subCateIds)){
            $query->whereIn('sub_category_id', $request->subCateIds);
        }
        if(isset($request->conditions) && !empty($request->conditions)){
            $query->whereIn('condition_id', $request->conditions);
        }
        $minPrice = $request->minPrice == 0 ? 1 : $request->minPrice;
       
        if(!empty($minPrice) && !empty($request->maxPrice)){        
            $query->whereBetween('price', [(int)$minPrice, (int)$request->maxPrice]);
        }

        if(isset($request->brands) && !empty($request->brands)){
            $query->whereIn('brand_id', $request->brands);
        }
        if(isset($request->cities) && !empty($request->cities)){
            $query->whereIn('zip_code', $request->cities);
        }
        
        if ($request->sorting_data == 'asc') {
            $query->orderBy('price','ASC');
        }
        if($request->sorting_data == 'desc') {
            $query->orderBy('price','DESC');
        }        
        $cateFilterArray = $query->get()->toArray();
        
        $category = Category::where('id', $request->cateIds)->first();

        return view('frontend.users.pages.product_category.cate_filter', compact('cateFilterArray', 'category'));
        
    }
}

