<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserStory;
use App\Models\Product;
use App\Models\UserFollowers;
use App\Models\CustomerReview;
use App\Models\CustomerReviewRatings;
use App\Models\Offer;
use Validator;
use JWTAuth;
use Response;
use JWTFactory;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\JWTException;
use Mail;

class OfferController extends Controller
{
    public function postRefreshToken(Request $request) 
    {
        $inputData = $request->all();

        $header = $request->header('AuthorizationUser');
        if(empty($header))
        {
            $message = 'Authorisation required' ;
            return InvalidResponse($message,101);
        }

        $response = veriftyAPITokenData($header);
        $success = $response->original['success'];
        
        if (!$success) 
        {
            return $response;
        }
    }

    public function makeAnOffer(Request $request)
    {    
        $inputData = $request->all();
        
        $header = $request->header('AuthorizationUser');
        $user_token = $request->header('authorization');

        if(empty($header))
        {
            $message = 'Authorisation required' ;
            return InvalidResponse($message,101);
        }

        $response = veriftyAPITokenData($header);
        $success = $response->original['success'];
        
        if (!$success) {
            return $response;
        }

        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'item_id' => 'required',
            'offer_price' => 'required',
            'message' => 'required',
        ]);
        
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;
        
        $make_an_offer = new Offer;
        $make_an_offer->user_id = $user_id;
        $make_an_offer->customer_id = $request->customer_id;
        $make_an_offer->items_id = $request->item_id;
        $make_an_offer->offer_price = $request->offer_price;
        $make_an_offer->message = $request->message;
        $make_an_offer->status = false;
        $make_an_offer->save();

        $message = 'Make an offer Successfully.';

        return SuccessResponse($message,200,$make_an_offer);
    }

    public function holdAnOffer(Request $request)
    {    
        $inputData = $request->all();
        
        $header = $request->header('AuthorizationUser');
        $user_token = $request->header('authorization');

        if(empty($header))
        {
            $message = 'Authorisation required' ;
            return InvalidResponse($message,101);
        }

        $response = veriftyAPITokenData($header);
        $success = $response->original['success'];
        
        if (!$success) {
            return $response;
        }

        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'item_id' => 'required',
            'offer_price' => 'required',
            'message' => 'required',
            'start_offer' => 'required',
            'end_offer' => 'required',
        ]);

        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;
        
        $hold_an_offer = new Offer;
        $hold_an_offer->user_id = $user_id;
        $hold_an_offer->customer_id = $request->customer_id;
        $hold_an_offer->items_id = $request->item_id;
        $hold_an_offer->offer_price = $request->offer_price;
        $hold_an_offer->message = $request->message;
        $hold_an_offer->start_offer = $request->start_offer;
        $hold_an_offer->end_offer = $request->end_offer;
        $hold_an_offer->status = false;
        $hold_an_offer->save();
        
        $message = 'Hold an offer Successfully.';

        return SuccessResponse($message,200,$hold_an_offer);
    }
    
    public function offerRecieved(Request $request)
    {    
        $inputData = $request->all();
        
        $header = $request->header('AuthorizationUser');
        $user_token = $request->header('authorization');

        if(empty($header))
        {
            $message = 'Authorisation required' ;
            return InvalidResponse($message,101);
        }

        $response = veriftyAPITokenData($header);
        $success = $response->original['success'];
        
        if (!$success) {
            return $response;
        }

        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'item_id' => 'required',
            'offer_price' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;
        
        $offer_recieved = new Offer;
        $offer_recieved->user_id = $user_id;
        $offer_recieved->customer_id = $request->customer_id;
        $offer_recieved->items_id = $request->item_id;
        $offer_recieved->offer_price = $request->offer_price;
        $offer_recieved->message = $request->message;
        $offer_recieved->status = false;
        $offer_recieved->offer_status = false;
        $offer_recieved->save();
        
        $message = 'Offer recieved Successfully.';

        return SuccessResponse($message,200,$offer_recieved);
    }

    public function offerNegotiate(Request $request)
    {    
        $inputData = $request->all();
                
        $header = $request->header('AuthorizationUser');

        $user_token = $request->header('authorization');

        if(empty($header))
        {
            $message = 'Authorisation required' ;
            return InvalidResponse($message,101);
        }

        $response = veriftyAPITokenData($header);

        $success = $response->original['success'];
        
        if (!$success) {
            return $response;
        }

        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'item_id' => 'required',
            'negotiate_price' => 'required',
            'offer_price' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;
        
        $offer_negotiate = new Offer;
        $offer_negotiate->user_id = $user_id;
        $offer_negotiate->customer_id = $request->customer_id;
        $offer_negotiate->items_id = $request->item_id;
        $offer_negotiate->negotiate_price = $request->negotiate_price;
        $offer_negotiate->offer_price = $request->offer_price;
        $offer_negotiate->message = $request->message;
        $offer_negotiate->status = false;
        $offer_negotiate->offer_status = true;
        $offer_negotiate->save();
        
        $message = 'Offer negotiate Successfully.';

        return SuccessResponse($message,200,$offer_negotiate);
    }
}
