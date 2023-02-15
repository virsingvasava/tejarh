<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;

class statesController extends Controller
{
    public function getstateList()
    {
        $state_list = State::all();        

        if(empty($state_list)){
            $message = "Country not found";
            return InvalidResponse($message,101);
        }
        $message = 'Fetch Country listing successfully.';
        return SuccessResponse($message,200,$state_list);
    }
}
