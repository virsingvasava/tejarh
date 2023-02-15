<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use Validator;
use JWTAuth;
use Response;
use JWTFactory;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\JWTException;
use Mail; 

class CategoryController extends Controller
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

    public function getCategoryList(Request $request)
    {
        $inputData = $request->all();
        $limit = 10;
        $page_no = 1;
        if (isset($request->page) && $request->page != "") {
            $page_no = $request->page;
        }

        $start_from = ($page_no - 1) * $limit;
        $category_list = Category::skip($start_from)->take($limit)->get()->toArray();        
        

        // $test = [];
        // foreach($category_list as $key => $value)
        // {
        //     $test[$key] = $value;
        // }
        // $testing = array_values($test);
        if(empty($category_list)){
            $message = "Categories not found";
            return InvalidResponse($message,101);
        }
        $message = 'Fetch categories listing successfully.';
        return SuccessResponse($message,200,$category_list);
    }
}
