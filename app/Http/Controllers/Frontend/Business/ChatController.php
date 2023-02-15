<?php

namespace App\Http\Controllers\Frontend\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $buyerId = Auth::User()->id;
        // $sellerId = $id;

        return view('frontend.business.pages.chat', compact('buyerId'));
    }
}
