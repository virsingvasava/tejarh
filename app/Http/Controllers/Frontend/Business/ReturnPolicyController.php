<?php

namespace App\Http\Controllers\Frontend\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Lang;
use Mail;
Use DB;

class ReturnPolicyController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $return_policy = Wishlist::with('items')
            ->where('user_id', $user->id)
            ->orderby('id', 'desc')
            ->paginate(10);
        return view('frontend.business.pages.return_policy', compact('user', 'return_policy'));
    }


    public function items_return_form(Request $request)
    {
        $user = Auth::user();
        return response()->json(['code' => 200, 'success' => Lang::get('business_messages.return_policy.item_return_success')], 200);
    }
}
