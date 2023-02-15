<?php

namespace App\Http\Controllers\Frontend\Users;

use App\Http\Controllers\Admin\Attribute_variantController;
use App\Http\Controllers\Controller;
use App\Models\attribute;
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
use App\Models\UserLike;
use App\Models\Wishlist;
use App\Models\ReviewRatings;
use App\Models\SellerReviewRatings;
use DateTime;
use Lang;
use Mail;
use DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

use App\Models\Orders;
use App\Models\stock;
use Attribute as GlobalAttribute;
use Illuminate\Support\Facades\DB as FacadesDB;

class NewItemsController extends Controller
{
    public function index()
    {

        $conditionArr = Condition::where('name', NEW_ITEMS)->first();

        $newitemsConId = $conditionArr->id;
        $newItemsList = Item::where([["condition_id", "=", $newitemsConId], ['deleted_at', '=', NULL]])
            ->where('status', '=', '1')->orderBy('created_at', 'DESC')->get()->toArray();

        $newItemsArray = [];
        foreach ($newItemsList as $key => $value) {
            $newItemsArray[$key] = $value;
            $itemsImage = ItemsImages::where('item_id', $value['id'])->first();
            $newItemsArray[$key]['item_pictures'] = $itemsImage;

            $condition = Condition::where('id', $value['condition_id'])->first();
            $newItemsArray[$key]['condition'] = $condition;

            $brand = Brand::where('id', $value['brand_id'])->first();
            $newItemsArray[$key]['brand'] = $brand;

            $store = Store::where('id', $value['store_id'])->first();
            $newItemsArray[$key]['store'] = $store;

            $boostItem = BoostItem::where('item_id', $value['id'])->where('is_paid', '1')->first();
            $newItemsArray[$key]['boostItem'] = $boostItem;

            $user = User::where('id', $value['user_id'])->first();
            $newItemsArray[$key]['user'] = $user;

            $userCity = $user->city_id;
            $getCity = City::where('id', $userCity)->first();
            $newItemsArray[$key]['city'] = $getCity;
        }



        return view('frontend.users.pages.new_items.index', compact('newItemsArray'));
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

            $likelist = UserLike::where('item_id', $value['id'])->first();
            $itemArray[$key]['likelist'] = $likelist;

            $orders = OrderItem::where('item_id', $value['id'])->first();
            $itemArray[$key]['orders'] = $orders;

            // $orderItem = OrderItem::where(['order_id'=> $orders['id'], 'item_id' => $value['id']])->first();
            // $itemArray[$key]['orderItem'] = $orderItem;

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


            $check_op = json_decode($value['choice_options']);
            $choice_optionsarray = [];

            if (!empty($check_op)) {
                foreach ($check_op as $key => $v) {
                    $choice_options = AttributeVariant::where('id', $v)->get()->Toarray();
                    $choice_optionsarray[$key] = $choice_options;
                }
            }
        }

        /* Related items start*/
        $userGet = User::where('role', USER_ROLE)->get()->all();
        $get_category_id = $value['category_id'];
        $relatedItemsList = Item::where([['deleted_at', '=', NULL]])
            ->where('status', '=', '1')
            ->where('category_id', '=', $get_category_id)
            ->orderBy('created_at', 'DESC')->get()->take(4)->toArray();
        $relatedItemArray = [];
        foreach ($relatedItemsList as $key => $value) {
            $relatedItemArray[$key] = $value;
            $itemsImage = ItemsImages::where('item_id', $value['id'])->first();
            $relatedItemArray[$key]['item_pictures'] = $itemsImage;

            $condition = Condition::where('id', $value['condition_id'])->first();
            $relatedItemArray[$key]['condition'] = $condition;

            $brand = Brand::where('id', $value['brand_id'])->first();
            $relatedItemArray[$key]['brand'] = $brand;

            $store = Store::where('id', $value['store_id'])->first();
            $relatedItemArray[$key]['store'] = $store;

            $boostItem = BoostItem::where('item_id', $value['id'])->where('is_paid', '1')->first();
            $relatedItemArray[$key]['boostItem'] = $boostItem;

            $wishlist = Wishlist::where('item_id', $value['id'])->first();
            $relatedItemArray[$key]['wishlist'] = $wishlist;

            $user = User::where('id', $value['user_id'])->first();
            $relatedItemArray[$key]['user'] = $user;

            $userCity = $user->city_id;
            $getCity = City::where('id', $userCity)->first();
            $relatedItemArray[$key]['city'] = $getCity;
        }
        /* Related items end*/

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
        /* Boost items end*/
        return view('frontend.users.post_items.details', compact('itemArray', 'relatedItemArray', 'boostItemArray', 'choice_optionsarray','shareComponent'));
    }


    public function myproduct_details($id)
    {
        $id = ($id);
        $itemsList = Item::where(['id' => $id, 'deleted_at' => NULL])->where('status', '=', '1')->orderBy('created_at', 'DESC')
            ->get()->toArray();

        //  dd($itemsList);
        $choice_optionsarray = [];
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

            $likelist = UserLike::where('item_id', $value['id'])->first();
            $itemArray[$key]['likelist'] = $likelist;

            $orders = Orders::where('item_id', $value['id'])->first();
            $itemArray[$key]['orders'] = $orders;

            $inventory = Inventory::where('item_id', $value['id'])->first();
            $itemArray[$key]['inventory'] = $inventory;

            $avg = ReviewRatings::where('item_id', $value['id']);
            $totalReviewAvg = $avg->avg('rating_star');
            $totalReviewAvg =  number_format($totalReviewAvg, 2);
            $itemArray[$key]['totalReviewAvg'] = $totalReviewAvg;

            $reviewRatings = ReviewRatings::where('item_id', $value['id'])->count();
            $itemArray[$key]['reviewRatings'] = $reviewRatings;


            $check_op = json_decode($value['choice_options']);
            if (!empty($check_op)) {
                foreach ($check_op as $key => $v) {
                    $choice_options = AttributeVariant::where('id', $v)->get()->Toarray();
                    $choice_optionsarray[$key] = $choice_options;
                }
            }
        }
        //dd($choice_optionsarray);
        /* Related items start*/
        $userGet = User::where('role', USER_ROLE)->get()->all();
        $get_category_id = $value['category_id'];
        $relatedItemsList = Item::where([['deleted_at', '=', NULL]])
            ->where('status', '=', '1')
            ->where('category_id', '=', $get_category_id)
            ->orderBy('created_at', 'DESC')->get()->take(4)->toArray();
        $relatedItemArray = [];
        foreach ($relatedItemsList as $key => $value) {
            $relatedItemArray[$key] = $value;
            $itemsImage = ItemsImages::where('item_id', $value['id'])->first();
            $relatedItemArray[$key]['item_pictures'] = $itemsImage;

            $condition = Condition::where('id', $value['condition_id'])->first();
            $relatedItemArray[$key]['condition'] = $condition;

            $brand = Brand::where('id', $value['brand_id'])->first();
            $relatedItemArray[$key]['brand'] = $brand;

            $store = Store::where('id', $value['store_id'])->first();
            $relatedItemArray[$key]['store'] = $store;

            $boostItem = BoostItem::where('item_id', $value['id'])->where('is_paid', '1')->first();
            $relatedItemArray[$key]['boostItem'] = $boostItem;

            $wishlist = Wishlist::where('item_id', $value['id'])->first();
            $relatedItemArray[$key]['wishlist'] = $wishlist;

            $user = User::where('id', $value['user_id'])->first();
            $relatedItemArray[$key]['user'] = $user;

            $userCity = $user->city_id;
            $getCity = City::where('id', $userCity)->first();
            $relatedItemArray[$key]['city'] = $getCity;
        }
        /* Related items end*/

        /* Boost items start*/
        $userGet = User::where('role', USER_ROLE)->get()->all();
        foreach ($userGet as $key => $value) {
            $boostItemsList = Item::where([['user_id', '=', $value->id], ['deleted_at', '=', NULL]])
                ->where('status', '=', '0')
                ->orderBy('created_at', 'DESC')->get()->take(2)->toArray();
        }
        $boostItemArray = [];
        foreach ($boostItemsList as $key => $value) {
            $boostItemArray[$key] = $value;
            $itemsImage = ItemsImages::where('item_id', $value['id'])->first();
            $boostItemArray[$key]['item_pictures'] = $itemsImage;

            $condition = Condition::where('id', $value['condition_id'])->first();
            $boostItemArray[$key]['condition'] = $condition;

            $brand = Brand::where('id', $value['brand_id'])->first();
            $boostItemArray[$key]['brand'] = $brand;

            $store = Store::where('id', $value['store_id'])->first();
            $boostItemArray[$key]['store'] = $store;

            $boostItem = BoostItem::where('item_id', $value['id'])->where('is_paid', '1')->first();
            $boostItemArray[$key]['boostItem'] = $boostItem;

            $wishlist = Wishlist::where('item_id', $value['id'])->first();
            $boostItemArray[$key]['wishlist'] = $wishlist;

            $user = User::where('id', $value['user_id'])->first();
            $boostItemArray[$key]['user'] = $user;

            $userCity = $user->city_id;
            $getCity = City::where('id', $userCity)->first();
            $boostItemArray[$key]['city'] = $getCity;
        }
        $stockList = stock:: where('item_id',$id)->get()->toArray();
        $stockArray = [];
        foreach ($stockList as $stockkey => $stockValue) {
            $stockArray[$stockkey] = $stockValue;
            $items = Item::where('id', $stockValue['item_id'])->first();
            $stockArray[$stockkey]['items'] = $items;
        }
        /* Boost items end*/
        return view('frontend.users.post_items.product_details', compact('itemArray', 'relatedItemArray', 'boostItemArray', 'choice_optionsarray', 'stockArray'));
    }
}
