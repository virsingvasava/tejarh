<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class countriesController extends Controller
{
    public function getcountryList(Request $request)
    {
        $subCategory_list = Country::all();        

        if(empty($subCategory_list)){
            $message = "Country not found";
            return InvalidResponse($message,101);
        }
        $message = 'Fetch Country listing successfully.';
        return SuccessResponse($message,200,$subCategory_list);
    }
}
