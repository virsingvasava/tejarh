<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerSupport;
use App\Models\User;
use Illuminate\Support\Str;
use File;
use Lang;

class CustomerSupportController extends Controller
{
    public function index() 
    {
        $customerSupport = CustomerSupport::get();
        return view('admin.customer_support.index',compact('customerSupport'));
    }

    public function destroy(Request $request)
    {   

        $id = $request->query_message_id;
        CustomerSupport::where('id',$id)->delete();
        return redirect()->route('admin.customer_support.index')->with('error', __('messages.customer_support.success.customer_query_deleted_successfully'));

    }

}
