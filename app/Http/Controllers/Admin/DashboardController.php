<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::whereIn('role', [API_ROLE,USER_ROLE,BUSINESS_ROLE,MANAGER_ROLE,STORE_BOYS_ROLE,DELIVERY_BOY_ROLE])->get()->count();
        $items = Item::get()->count();
        $currentYear  = date('Y');
        return view('admin.dashboard', compact('users', 'currentYear','items'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success','Your logged out successfully!');
    }
}
