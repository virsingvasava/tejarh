<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BusinessUsers;

class VerifiedAccountController extends Controller
{
    public function index() 
    {
        $verify = User::whereIn('role', [USER_ROLE, BUSINESS_ROLE])->whereNotNull(['phone_number', 'email'])->where('status','1')->get();
        return view('admin.verified_account.index',compact('verify'));
    }
}
