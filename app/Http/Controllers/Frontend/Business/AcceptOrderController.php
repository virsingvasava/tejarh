<?php

namespace App\Http\Controllers\Frontend\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AcceptOrderController extends Controller
{
    public function index(){

        return view('frontend.business.pages.b-6-1order-details');
    }
}
