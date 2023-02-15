<?php

namespace App\Http\Controllers;

use App\Models\CheckOutUserDetails;
use Illuminate\Http\Request;

class MyCheckOutController extends Controller
{  
    public function index(Request $request)
    {
        $checkAddress = CheckOutUserDetails::where('user_id',$request->user_id)->first();
        if(!empty($checkAddress))
        {
            $invoiceCreate = CheckOutUserDetails::where('user_id',$request->user_id)->first();
            $invoiceCreate->user_id  = $request->user_id;
            $invoiceCreate->item_id  = $request->item_id;
            $invoiceCreate->address_id  = $request->address_id;
            $invoiceCreate->status = FALSE;
            $invoiceCreate->save();
        }
        else{
            $invoiceCreate = new CheckOutUserDetails;
            $invoiceCreate->user_id  = $request->user_id;
            $invoiceCreate->item_id  = $request->item_id;
            $invoiceCreate->address_id  = $request->address_id;
            $invoiceCreate->status = FALSE;
            $invoiceCreate->save();
        }
        

        return response()->json(['IsSuccess' => 'true', 'Message' => 'Invoice created successfully.', 'response' => $invoiceCreate]);
    }
}
