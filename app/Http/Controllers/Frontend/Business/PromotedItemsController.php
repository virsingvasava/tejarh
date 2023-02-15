<?php

namespace App\Http\Controllers\Frontend\Business;

use App\Http\Controllers\Controller;
use App\Models\AttributeVariant;
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
use App\Models\Inventory;
use App\Models\OrderItem;
use App\Models\Wishlist;
use App\Models\ReviewRatings;
use App\Models\SellerReviewRatings;
use DateTime;
use Lang;
use Mail;
use DB;
use Illuminate\Pagination\Paginator;
use App\Models\Orders;

class PromotedItemsController extends Controller
{

    function index()
    {
        $itemsList = Item::where('deleted_at', '=', NULL)->orderBy('created_at', 'DESC')
            ->where('status', '=', '1')
            ->get()
            ->toArray();

        $data = DB::table('items')->paginate(5);

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

            $user = User::where('id', $value['user_id'])->first();
            $userCity = $user->city_id;
            $getCity = City::where('id', $userCity)->first();
            $usedItemsArray1[$key]['city'] = $getCity;
        }
        return view('frontend.business.pages.items.promoted_Items', compact('itemArray', 'data'));
    }

    public function item_details($id)
    {
        $id = ($id);
        $itemsList = Item::where(['id' => $id, 'deleted_at' => NULL])
            ->where('status', '=', '1')
            ->orderBy('created_at', 'DESC')
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

            $category = Category::where('id', $value['category_id'])->first();
            $itemArray[$key]['category'] = $category;

            $wishlist = Wishlist::where('item_id', $value['id'])->first();
            $itemArray[$key]['wishlist'] = $wishlist;

            $users = User::where('id', $value['user_id'])->first();
            $itemArray[$key]['user'] = $users;

            $userCity = $users->city_id;
            $getCity = City::where('id', $userCity)->first();
            $itemArray[$key]['city'] = $getCity;

            $orders = OrderItem::where('item_id', $value['id'])->first();
            $itemArray[$key]['orders'] = $orders;

            $inventory = Inventory::where('item_id', $value['id'])->first();
            $itemArray[$key]['inventory'] = $inventory;

            $avg = ReviewRatings::where('item_id', $value['id']);
            $totalReviewAvg = $avg->avg('rating_star');
            $totalReviewAvg =  number_format($totalReviewAvg, 2);
            $itemArray[$key]['totalReviewAvg'] = $totalReviewAvg;

            $reviewRatings = ReviewRatings::where('item_id', $value['id'])->count();
            $itemArray[$key]['reviewRatings'] = $reviewRatings;

            $avgSellerReview = SellerReviewRatings::where('seller_id', $users->id);
            $sellerTotalReview = $avgSellerReview->avg('rating_star');
            $sellerTotalReviewAvg1 =  number_format($sellerTotalReview, 2);
            $itemArray[$key]['sellerTotalReviewAvg'] = $sellerTotalReviewAvg1;

            $sellerReviewRatings = SellerReviewRatings::where('seller_id', $users->id)->count();
            $itemArray[$key]['sellerTotalCountReviewRatings'] = $sellerReviewRatings;
            
            $choice_optionsarray = [];
            $check_op = json_decode($value['choice_options']);

            if (!empty($check_op)) {
                foreach($check_op as $key=> $v)
                {
                    $choice_options = AttributeVariant::where('id',$v)->get()->Toarray();
                    $choice_optionsarray[$key] = $choice_options;
                }
            }
        }

        /* Boost items start*/
        $boostItemsList = BoostItem::where([ ['is_paid', '=', 1]])->orderBy('created_at', 'DESC')->get()->take(2)->toArray();
        $boostItemArray = [];
        foreach ($boostItemsList as $boostItemsValuekey => $boostItemsValue) {
            $boostItemArray[$boostItemsValuekey] = $boostItemsValue;

            $items = Item::where('id', $boostItemsValue['item_id'])->first();
            $boostItemArray[$boostItemsValuekey]['items'] = $items;

            $itemsImage = ItemsImages::where('item_id', $items['id'])->first();
            $boostItemArray[$boostItemsValuekey]['item_pictures'] = $itemsImage;

            $condition = Condition::where('id', $items['condition_id'])->first();
            $boostItemArray[$boostItemsValuekey]['condition'] = $condition;

            $brand = Brand::where('id', $items['brand_id'])->first();
            $boostItemArray[$boostItemsValuekey]['brand'] = $brand;

            $store = Store::where('id', $items['store_id'])->first();
            $boostItemArray[$boostItemsValuekey]['store'] = $store;

            $wishlist = Wishlist::where('item_id', $items['id'])->first();
            $boostItemArray[$boostItemsValuekey]['wishlist'] = $wishlist;

            $user = User::where('id', $items['user_id'])->first();
            $boostItemArray[$boostItemsValuekey]['user'] = $user;

            $userCity = $user->city_id;
            $getCity = City::where('id', $userCity)->first();
            $boostItemArray[$boostItemsValuekey]['city'] = $getCity;
        }
        /* Boost items end*/

        /* Related items start*/
        $userGet = User::where('role', BUSINESS_ROLE)->get()->all();
        $get_category_id = $value['category_id'];
        $relatedItemsList = Item::where([['deleted_at', '=', NULL]])
            ->where('status', '=', '1')
            ->where('category_id', '=', $get_category_id)
            ->orderBy('created_at', 'DESC')->get()->take(4)->toArray();
        $relatedItemArray = [];
        foreach ($relatedItemsList as $relatedItemskey => $relatedItemsvalue) {
            $relatedItemArray[$relatedItemskey] = $relatedItemsvalue;
            $itemsImage = ItemsImages::where('item_id', $relatedItemsvalue['id'])->first();
            $relatedItemArray[$relatedItemskey]['item_pictures'] = $itemsImage;

            $condition = Condition::where('id', $relatedItemsvalue['condition_id'])->first();
            $relatedItemArray[$relatedItemskey]['condition'] = $condition;

            $brand = Brand::where('id', $relatedItemsvalue['brand_id'])->first();
            $relatedItemArray[$relatedItemskey]['brand'] = $brand;

            $store = Store::where('id', $relatedItemsvalue['store_id'])->first();
            $relatedItemArray[$relatedItemskey]['store'] = $store;

            $boostItem = BoostItem::where('item_id', $relatedItemsvalue['id'])->where('is_paid', '1')->first();
            $relatedItemArray[$relatedItemskey]['boostItem'] = $boostItem;

            $wishlist = Wishlist::where('item_id', $relatedItemsvalue['id'])->first();
            $relatedItemArray[$relatedItemskey]['wishlist'] = $wishlist;

            $user = User::where('id', $relatedItemsvalue['user_id'])->first();
            $relatedItemArray[$relatedItemskey]['user'] = $user;

            $userCity = $user->city_id;
            $getCity = City::where('id', $userCity)->first();
            $relatedItemArray[$relatedItemskey]['city'] = $getCity;
        }
        /* Related items end*/

        $shareComponent = \Share::page(
            'https://www.positronx.io/create-autocomplete-search-in-laravel-with-typeahead-js/',
            'Your share text comes here',
        )
            ->facebook()
            ->twitter()
            ->linkedin()
            ->telegram()
            ->whatsapp()
            ->reddit();
        return view('frontend.business.pages.items.item_details', compact('shareComponent','itemArray', 'boostItemArray', 'relatedItemArray','choice_optionsarray'));
    }

    public function make_an_offer(Request $request)
    {
        $id = $request->item_Id;
        $itemsList = Item::where(['id' => $id, 'deleted_at' => NULL])
            ->where('status', '=', '1')
            ->orderBy('created_at', 'DESC')
            ->get()
            ->toArray();

        $itemArray = [];
        foreach ($itemsList as $key => $value) {
            $itemArray[$key] = $value;
            $itemsImage = ItemsImages::where('item_id', $value['id'])->first();
            $itemArray[$key]['item_pictures'] = $itemsImage;

            $users = User::where('id', $value['user_id'])->first();
            $itemArray[$key]['user'] = $users;
        }
        return response()->json($itemArray);
    }

    public function hold_an_offer(Request $request)
    {
        $id = $request->item_Id;
        $itemsList = Item::where(['id' => $id, 'deleted_at' => NULL])
            ->where('status', '=', '1')
            ->orderBy('created_at', 'DESC')
            ->get()
            ->toArray();

        $itemArray = [];
        foreach ($itemsList as $key => $value) {
            $itemArray[$key] = $value;
            $itemsImage = ItemsImages::where('item_id', $value['id'])->first();
            $itemArray[$key]['item_pictures'] = $itemsImage;

            $users = User::where('id', $value['user_id'])->first();
            $itemArray[$key]['user'] = $users;

            $brand = Brand::where('id', $value['brand_id'])->first();
            $itemArray[$key]['brand'] = $brand;
        }
        return response()->json($itemArray);
    }
}
