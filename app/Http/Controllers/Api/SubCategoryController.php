<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Item;
use App\Models\User;
use JWTFactory;
use Validator;
use Response;
use JWTAuth;
use Mail;

class SubCategoryController extends Controller
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

    public function getSubCategoryList(Request $request)
    {    
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
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
        $categoryItemList = $request->category_id;
        $subCategory_list = SubCategory::where('category_id',$categoryItemList)
        ->where('status', '=', '1')
        ->skip($start_from)->take($limit)
        ->orderBy('created_at', 'DESC')->get()->toArray();;        
    
        if(empty($subCategory_list)){
            $message = "Sub categories not found";
            return InvalidResponse($message,101);
        }
        $message = 'Fetch sub categories listing successfully.';
        return SuccessResponse($message,200,$subCategory_list);
    }
}
