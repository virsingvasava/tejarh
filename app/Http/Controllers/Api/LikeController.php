<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemsImages;
use App\Models\ReviewRatings;
use App\Models\UserLike;
use Illuminate\Http\Request;
use Overtrue\LaravelLike\Like;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }
    public function userlike(Request $request)
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

        $wishlist = UserLike::where('user_id',$user_id)->skip($start_from)->take($limit)->get()->toArray();
        foreach ($wishlist as $key => $value) {

            $item = Item::where('id',$value['item_id'])->first();
            $wishlist[$key]['item'] = $item;

            $itemsImage = ItemsImages::where('item_id', $value['item_id'])->first();
            $wishlist[$key]['item']['item_pictures'] = $itemsImage;

            $avg = ReviewRatings::where('item_id', $value['item_id']);
            $totalReviewAvg = $avg->avg('rating_star');
            $totalReviewAvg =  number_format($totalReviewAvg, 2);
            $wishlist[$key]['totalReviewAvg'] = $totalReviewAvg;

            $reviewRatings = ReviewRatings::where('item_id', $value['item_id'])->count();
            $wishlist[$key]['reviewRatings'] = $reviewRatings;
        }       

        if(!empty($wishlist)  && count($wishlist) > 0){

            $message = 'Fetch Items Like successfully.';
            return SuccessResponse($message,200,$wishlist);

        }else{

            $message = "Items Like not found.";
            return InvalidResponse($message,101);
        }
    }
    public function addTolike(Request $request)
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
        
        $add_to_like = new UserLike;
        $add_to_like->user_id = $user_id;
        $add_to_like->item_id = $request->item_id;
        $add_to_like->like_status = TRUE;
        $add_to_like->save();

        $message = 'Add to Like Successfully.';

        return SuccessResponse($message,200,$add_to_like);
    }
    public function removelike(Request $request)
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

        // $likeId = $request->like_id;
        $itemId = $request->item_id;

        $wishlist_removed = UserLike::where(['item_id' => $itemId,'user_id' => $user_id])->delete();

        if(empty($wishlist_removed)){
            $message = "Request remove item not found in wishlist.";
            return InvalidResponse($message,101);
        }

        $message = 'Wishlist item removed successfully.';
        return SuccessResponse($message,200,$wishlist_removed);
    }
}
