<?php

namespace App\Http\Controllers\Frontend\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CancelOrderController extends Controller
{
    public function index() 
    {   
        return view('frontend.business.pages.order-cancel');
    }
}
