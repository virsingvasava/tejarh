<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ReviewRatings;
use App\Models\SellerReviewRatings;
use App\Models\User;
use Illuminate\Http\Request;
use SebastianBergmann\Type\NullType;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth')->except(['productReviewlisting','sellerReviewlisting']);
    }
    public function addproductReviewRating(Request $request)
    {
        $user_token = $request->header('authorization');

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $new_user = new ReviewRatings;
        // $image = $request->user_review_items_Image;
        // if ($request->has('user_review_items_Image')) {
        //     $imagename = $request->user_review_items_Image;
        //     $destination = public_path('assets/review_items_Image');
        //     if (!is_dir($destination)) {
        //         mkdir($destination, 0777, true);
        //     }
        //     $name = 'images' . time();
        //     $imageName = $name . '.' . $image->getClientOriginalExtension();
        //     $image->move($destination, $imageName);
        // } else {
        //     $imageName = null;
        // }

        $new_user->user_id = $user_id;
        $new_user->item_id = $request->item_Ids;
        $new_user->rating_star = $request->rating_data;
        $new_user->review_description = $request->user_review_description;
        // $new_user->review_picture = $imageName;
        $new_user->save();

        $message = 'Product Review Add successfully.';
        return SuccessResponse($message, 200, $new_user);
    }
    public function productReviewlisting(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_id' => 'required',
        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message, 101);
        }
        $limit = 10;
        $page_no = 1;
        if (isset($request->page) && $request->page != "") {
            $page_no = $request->page;
        }
        $start_from = ($page_no - 1) * $limit;
        $itemId = $request->item_id;
        $productReviewlisting = ReviewRatings::where('item_id',$itemId)
        ->where('deleted_at', '=', NULL)
        ->skip($start_from)->take($limit)
        ->get()->toArray();
        foreach($productReviewlisting as $key => $value)
        {
            $user = User::where('id', $value['user_id'])->select('name','profile_picture')->first();
            $productReviewlisting[$key]['user'] = $user;
        }

        $message = 'product Review Listing.';
        return SuccessResponse($message, 200, $productReviewlisting);
    }

    public function addsellerReviewRating(Request $request)
    {
        $user_token = $request->header('authorization');

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $new_user = new SellerReviewRatings;
        // $image = $request->user_review_items_Image;
        // if ($request->has('user_review_items_Image')) {
        //     $imagename = $request->user_review_items_Image;
        //     $destination = public_path('assets/review_items_Image');
        //     if (!is_dir($destination)) {
        //         mkdir($destination, 0777, true);
        //     }
        //     $name = 'images' . time();
        //     $imageName = $name . '.' . $image->getClientOriginalExtension();
        //     $image->move($destination, $imageName);
        // } else {
        //     $imageName = null;
        // }
        $new_user->seller_id = $request->sellerId;
        $new_user->user_id = $user_id;
        $new_user->rating_star = $request->rating_data;
        $new_user->review_description = $request->user_review_description;
        $new_user->review_picture = NULL;
        $new_user->save();

        $message = 'Seller Review Add successfully.';
        return SuccessResponse($message, 200, $new_user);
    }

    public function sellerReviewlisting(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'seller_id' => 'required',
        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message, 101);
        }
        $limit = 10;
        $page_no = 1;
        if (isset($request->page) && $request->page != "") {
            $page_no = $request->page;
        }
        $start_from = ($page_no - 1) * $limit;
        $sellerId = $request->seller_id;

        $sellerReviewlisting = SellerReviewRatings::where('seller_id',$sellerId)
        ->where('deleted_at', '=', NULL)
        ->skip($start_from)->take($limit)
        ->get()->toArray();
        foreach($sellerReviewlisting as $key => $value)
        {
            $user = User::where('id', $value['user_id'])->select('name','profile_picture')->first();
            $sellerReviewlisting[$key]['user'] = $user;
        }
        $message = 'product Review Listing.';
        return SuccessResponse($message, 200, $sellerReviewlisting);
    }
}
