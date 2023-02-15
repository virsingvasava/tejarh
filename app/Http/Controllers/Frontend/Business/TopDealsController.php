<?php

namespace App\Http\Controllers\Frontend\Business;

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
use DateTime;
use Lang;
use Mail;

class TopDealsController extends Controller
{
    public function index() 
    {   
      
        $promotedItemsList = Item::where('deleted_at','=',NULL)
        ->where('status','=','1')
        ->orderBy('created_at','DESC')
        ->get()
        ->toArray();
        
        $promotedItemsArray = [];
        foreach($promotedItemsList as $key => $value)
        {
            $promotedItemsArray[$key] = $value;
            $itemsImage = ItemsImages::where('item_id',$value['id'])->first();
            $promotedItemsArray[$key]['item_pictures'] = $itemsImage;

            $condition = Condition::where('id',$value['condition_id'])->first();
            $promotedItemsArray[$key]['condition'] = $condition;

            $brand = Brand::where('id',$value['brand_id'])->first();
            $promotedItemsArray[$key]['brand'] = $brand;

            $store = Store::where('id',$value['store_id'])->first();
            $promotedItemsArray[$key]['store'] = $store;

            $boostItem = BoostItem::where('item_id',$value['id'])->where('is_paid','1')->first();
            $promotedItemsArray[$key]['boostItem'] = $boostItem;
        }
        return view('frontend.business.pages.items.top_deals',compact('promotedItemsArray'));   
    }
}
