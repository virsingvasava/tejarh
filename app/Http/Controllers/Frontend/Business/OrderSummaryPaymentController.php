<?php

namespace App\Http\Controllers\Frontend\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Orders;
use Illuminate\Support\Facades\Auth;
use Lang;
use Mail;

class OrderSummaryPaymentController extends Controller
{
    public function index() 
    {   
        return view('frontend.business.pages.order_summary_payment');
    }

    public function payment_details(Request $request)
    {   
        $id = $request->payment_id;
        $get_details = Item::where('id',$id)->where('status','=','1')->get();

        foreach($get_details as $key => $value){
            $order= new Orders;
            $order->user_id = Auth::user()->id;    
            $order->item_id = $value->id;
            $order->customer_id = true;
            $order->order_number = '#878587'; 
            $order->grand_total = true;
            $order->item_count = '2'; 
            $order->is_paid = true;
            $order->payment_method = 100;
            $order->payment_status = 0;
            $order->item_price = $value->price;
            $order->sell_tax = 10;
            $order->shipping_charge = 5; 
            $order->discount_amount = 2;
            $order->payable_amount = $value->price;
            $order->save();
        }
        return response()->json(['success' => 'Payment successfully done..']);
    }

}




