<?php

namespace App\Http\Controllers\Frontend\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index() 
    {  
        return view('frontend.users.my_orders.order_placed_successful');
    }

}
