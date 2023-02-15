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
use Validator;
use JWTAuth;
use Response;
use JWTFactory;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\JWTException;
use Mail;
use Carbon\Carbon;

class FilterController extends Controller
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

    public function filterItems(Request $request)
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

        $start = Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
        $end = Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');
        $today = Carbon::now()->format('Y-m-d').'%';

        if(!empty($start) && !empty($end) && !empty($today)){
            $filter_items = Product::whereDate('created_at','<=',$end)
            ->whereDate('created_at','>=',$start)
            ->where('created_at', 'like', $today)
            ->get();
        }
       
        if(!empty($filter_items)  && count($filter_items) > 0){
            $message = 'Fetch items successfully.';
            return SuccessResponse($message,200,$filter_items);
        }else{
            $message = "Items not found";
            return InvalidResponse($message,101);
        }
    }
}
