<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BoostItem;
use App\Models\Brand;
use App\Models\City;
use App\Models\Condition;
use App\Models\Item;
use App\Models\ItemsImages;
use App\Models\ReviewRatings;
use App\Models\Store;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;

class WishlistController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }
    public function userWishlist(Request $request)
    {
        $inputData = $request->all();

        $user_token = $request->header('authorization');

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;
        $limit = 10;
        $page_no = 1;
        if (isset($request->page) && $request->page != "") {
            $page_no = $request->page;
        }
        $start_from = ($page_no - 1) * $limit;

        $wishlist = Wishlist::where('user_id',$user_id)->skip($start_from)->take($limit)->get()->toArray();
        // dd($wishlist);

        foreach ($wishlist as $key => $value) {
            $item = Item::where('id',$value['item_id'])->first();
            $wishlist[$key]['item'] = $item;

            $itemsImage = ItemsImages::where('item_id', $item['id'])->first();
            $wishlist[$key]['item']['item_pictures'] = $itemsImage;

            $avg = ReviewRatings::where('item_id', $value['item_id']);
            $totalReviewAvg = $avg->avg('rating_star');
            $totalReviewAvg =  number_format($totalReviewAvg, 2);
            $wishlist[$key]['totalReviewAvg'] = $totalReviewAvg;

            $reviewRatings = ReviewRatings::where('item_id', $value['item_id'])->count();
            $wishlist[$key]['reviewRatings'] = $reviewRatings;
        }
    
        if(!empty($wishlist)  && count($wishlist) > 0){

            $message = 'Fetch Items wishlist successfully.';
            return SuccessResponse($message,200,$wishlist);

        }else{

            $message = "Items wishlist not found.";
            return InvalidResponse($message,101);
        }
    }

    public function addToWishlist(Request $request)
    {    
        $inputData = $request->all();
    
        $user_token = $request->header('authorization');

        $validator = Validator::make($request->all(), [
            'item_id' => 'required',
        ]);
        
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;
        
        $add_to_wishlist = new Wishlist;
        $add_to_wishlist->user_id = $user_id;
        //$add_to_wishlist->customer_id = $request->customer_id;
        $add_to_wishlist->item_id = $request->item_id;
        $add_to_wishlist->wishlist_status = TRUE;
        $add_to_wishlist->save();

        $message = 'Add to wishlist Successfully.';

        return SuccessResponse($message,200,$add_to_wishlist);
    }

    public function removeFromWishlist(Request $request)
    {
        $inputData = $request->all();
        
        

        $user_token = $request->header('authorization');


        $validator = Validator::make($request->all(), [
            'item_id' => 'required',
        ]);

        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        // $wishlistId = $request->wishlist_id;
        $itemId = $request->item_id;

        $wishlist_removed = Wishlist::where(['item_id' => $itemId,'user_id' => $user_id])->delete();

        if(empty($wishlist_removed)){
            $message = "Request remove item not found in wishlist.";
            return InvalidResponse($message,101);
        }

        $message = 'Wishlist item removed successfully.';
        return SuccessResponse($message,200,$wishlist_removed);
    }
}
