<?php

namespace App\Http\Controllers\Frontend\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Lang;
use Mail;
use Carbon\Carbon;
use DB;

class SalesReportController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $sales_reports = Orders::where('user_id', $user->id)
            ->orderby('id', 'desc')
            ->get()
            ->toArray();
            
        $date = Carbon::today()->subDays(60);
        $users = User::where('created_at','>=',$date)
        ->select('id')
        ->get();
        return view('frontend.business.pages.reports.sales_report', compact('sales_reports'));
    }
}
