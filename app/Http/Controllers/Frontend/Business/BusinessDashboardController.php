<?php

namespace App\Http\Controllers\Frontend\Business;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
use App\Models\Wishlist;
use App\Models\Orders;
use Lang;
use Mail;

class BusinessDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index() 
    {   
      
        $ordersList = Orders::pluck('item_id')->take(4)->toArray();
        $itemsList = Item::whereIn('id', $ordersList)
        ->where('status','=','1')
        ->orderBy('created_at','DESC')->get()->take(4)->toArray();

        $ordersItemArray = [];
        foreach($itemsList as $key => $value)
        {
            $ordersItemArray[$key] = $value;
            $itemsImage = ItemsImages::where('item_id',$value['id'])->first();
            $ordersItemArray[$key]['item_pictures'] = $itemsImage;

            $condition = Condition::where('id',$value['condition_id'])->first();
            $ordersItemArray[$key]['condition'] = $condition;

            $brand = Brand::where('id',$value['brand_id'])->first();
            $ordersItemArray[$key]['brand'] = $brand;

            $store = Store::where('id',$value['store_id'])->first();
            $ordersItemArray[$key]['store'] = $store;

            $boostItem = BoostItem::where('item_id',$value['id'])->where('is_paid','1')->first();
            $ordersItemArray[$key]['boostItem'] = $boostItem;

            $wishlist = Wishlist::where('item_id',$value['id'])->first();
            $ordersItemArray[$key]['wishlist'] = $wishlist;
        }
        
        $userId = Auth::user()->id;
        $currentBalance = Orders::where('user_id', $userId)->pluck('item_price')->sum();
        $todayDate = date('d M Y');
        $currentYear = date('Y');
        $netProfit = '500';
        $totalGMV = '2K';
        $repeatingCustomers = User::pluck('id')->sum();
        $deliveredOrderValue = Orders::where('user_id', $userId)->pluck('item_price')->sum();
        $numberofCustomers = User::pluck('id')->sum();
        $InventoryValue = '10k';
        $completedOrdersValue = '20K';
        $totaltoCollect = '5k';
        $deliveredOrder = Orders::where('user_id', $userId)->pluck('id')->sum();
        $pendingOrder= '2';
        $rejectedOrder = '8';
        $returnedOrder = '5';
     
        return view('frontend.business.pages.dashboard.index', compact('ordersItemArray', 'currentBalance', 'todayDate','currentYear', 'netProfit', 'totalGMV', 'repeatingCustomers', 'deliveredOrderValue', 'numberofCustomers','InventoryValue', 'completedOrdersValue', 'totaltoCollect','deliveredOrder', 'pendingOrder', 'rejectedOrder', 'returnedOrder'));
    }
}
