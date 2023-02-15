<?php

namespace App\Http\Controllers\Frontend\Business;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\ItemsImages;
use App\Models\Item;
use App\Models\Brand;
use App\Models\Store;
use App\Models\BoostItem;
use App\Models\Category;
use App\Models\ReviewRatings;
use DateTime;
use Lang;
use Mail;
Use DB;
class WishlistController extends Controller
{
    
    public function index()
    {
        $user = Auth::user();
        $wishlists = Wishlist::with('items')
            ->where('user_id', $user->id)
            ->where('wishlist_status', 1)
            ->orderby('id', 'desc')
            ->get()
            ->toArray();

        $itemArray = [];
        foreach($wishlists as $key => $value)
        {
            $itemArray[$key] = $value;
            $items = Item::where('id',$value['item_id'])->where('status','=','1')->first();
            $itemArray[$key]['items'] = $items;

            $itemsImage = ItemsImages::where('item_id',$items['id'])->first();
            $itemArray[$key]['item_pictures'] = $itemsImage;

            $avg = ReviewRatings::where('item_id', $value['id']);
            $totalReviewAvg = $avg->avg('rating_star');
            $totalReviewAvg =  number_format($totalReviewAvg, 2);
            $itemArray[$key]['totalReviewAvg'] = $totalReviewAvg;

            $totalCountReviewRatings = ReviewRatings::where('item_id',  $value['id'])->count();
            $itemArray[$key]['reviewRatings'] = $totalCountReviewRatings;

        } 
        return view('frontend.business.pages.wishlist.index', compact('user', 'itemArray'));
    }


    public function add_to_wishlist(Request $request)
    {     
         $userId = Auth::user()->id;
         $checkWishlist = DB::select('select * from user_wishlists where user_id=? && item_id=?',[$userId, $request->item_id]);

        if(!empty($checkWishlist)) {
            
            $wishlist_update = Wishlist::where(['item_id' => $request->item_id])->where(['user_id' => $userId])->first();
            $wishlist_update->user_id = Auth::user()->id; 
            $wishlist_update->item_id = $request->item_id;
            $wishlist_update->customer_id =  true;
            $wishlist_update->wishlist_status = $request->wishlist_status;
            $wishlist_update->save();

            if($wishlist_update->wishlist_status == 0){
                return response()->json(['status'=> 0, 'code' => 200, 'success' => Lang::get('business_messages.wishlist.wishlist_updated_success')], 200);

            }else{
                return response()->json(['status'=> 1, 'code' => 200, 'success' => Lang::get('business_messages.wishlist.wishlist_added_success')], 200);
            }

        }else{

            $wishlist= new Wishlist;
            $wishlist->user_id = Auth::user()->id;    
            $wishlist->item_id = $request->item_id;
            $wishlist->customer_id = true;
            $wishlist->wishlist_status = $request->wishlist_status;  
            $wishlist->save();
            return response()->json(['status'=> $wishlist->wishlist_status, 'code' => 200, 'success' => Lang::get('business_messages.wishlist.wishlist_added_success')], 200);
        }
    }

    public function wishlist_removed(Request $request)
    {   
        $id = $request->wishlist_id;
        Wishlist::where('id',$id)->delete();
        return response()->json(['code' => 200, 'success' => Lang::get('business_messages.wishlist.wishlist_removed_success')], 200);
    }
    
}
