<?php

namespace App\Http\Controllers\Frontend\Business;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UsersDeliveryAddress;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index() 
    {  
        $user = User::where('id', '=', Auth::user()->id)->first();
        $userAddressDetail = UsersDeliveryAddress::where('user_id','=',Auth::user()->id)->where('deleted_at','=',NULL)->get(); 
        return view('frontend.business.pages.address.index',compact('userAddressDetail','user'));
    }

    public function shipping_address($id){
    
        $params = ($id);
        $user = User::where('id', '=', Auth::user()->id)->first();
        $userAddressDetail = UsersDeliveryAddress::where('user_id','=',Auth::user()->id)->where('deleted_at','=',NULL)->get();
        return view('frontend.business.pages.address.index', compact('userAddressDetail','user', 'params'));
    }
}
