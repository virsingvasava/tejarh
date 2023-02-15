<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class citiesController extends Controller
{
    public function getCityList()
    {
        $City_list = City::all();        

        if(empty($City_list)){
            $message = "Country not found";
            return InvalidResponse($message,101);
        }
        $message = 'Fetch Country listing successfully.';
        return SuccessResponse($message,200,$City_list);
    }
}
