<?php

namespace App\Http\Controllers\Frontend\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SellerReviewRatings;
use App\Models\BusinessUsers;
use App\Models\ReviewRatings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Lang;
use Mail;
use Carbon\Carbon;

class SellerReviewsRatingsController extends Controller
{
    public function index() 
    {  
        $reviewRatings = SellerReviewRatings::where('user_id','=','1')->get();
        return view('frontend.business.pages.seller_reviews.index',compact('reviewRatings'));   

    }

    public function seller_reviews_details($id)
    {
        $reviewRating = SellerReviewRatings::where('seller_id', $id)->orderby('id', 'desc')->get()->toArray();
        $sellerDetails = User::where('id', $id)->orderby('id', 'desc')->first();
        $profileArrayBussiness = BusinessUsers::with(['user', 'store', 'items'])->where('user_id', $id)->first();

        $reviewRatingArray = [];
        foreach ($reviewRating as $key => $value) {
            $reviewRatingArray[$key] = $value;
            $user = User::where('id', $value['user_id'])->first();
            $reviewRatingArray[$key]['user'] = $user;
        }
        return view('frontend.business.pages.seller_reviews.index', compact('sellerDetails', 'reviewRatingArray', 'profileArrayBussiness'));

    }

      # Reviews Module Mothods#
    
    public function seller_review_post_store(Request $request){
        
        $userIdCheck = SellerReviewRatings::where('user_id', $request->reviewer_userId)->first();

        if (!empty($userIdCheck)) {
            $update_review = SellerReviewRatings::where('user_id', $userIdCheck->user_id)->first();
            $update_review->seller_id = $request->sellerId;
            $update_review->user_id = $request->reviewer_userId;
            $update_review->rating_star = $request->rating_data;
            $update_review->review_description = $request->user_review_description;
            $update_review->review_picture = NULL;
            $update_review->save();
        }else{
            $new_user = new SellerReviewRatings;
            $new_user->seller_id = $request->sellerId;
            $new_user->user_id = $request->reviewer_userId;
            $new_user->rating_star = $request->rating_data;
            $new_user->review_description = $request->user_review_description;
            $new_user->review_picture = NULL;
            $new_user->save();
        }
        return response()->json(['code' => 200, 'success' => Lang::get('Review Post Successfully')], 200);
    
    }
   
    # Reviews Module End#
}
