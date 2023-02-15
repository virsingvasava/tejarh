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

class SearchProductController extends Controller
{
    public function index($id)
    {
        $cate_name = Category::where('id', $id)->first();

        $categories = DB::table('category')->select('id', 'category_name')->get();
        $sub_categories = DB::table('sub_category')->select('id', 'sub_cate_name')->where('category_id', $id)->get();
        $conditions = DB::table('conditions')->select('id', 'name')->get();
        $brands = DB::table('brand')->select('id', 'name')->get();
        $locations = DB::table('countries')->select('id', 'name')->get();

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
        }

        return view('frontend.users.pages.search.index', compact('usedItemsArray', 'cate_name', 'categories', 'sub_categories', 'conditions', 'brands', 'locations'));
    }
}
