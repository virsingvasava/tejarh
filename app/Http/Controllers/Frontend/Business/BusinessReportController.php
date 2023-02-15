<?php

namespace App\Http\Controllers\Frontend\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Lang;
use Mail;
use Carbon\Carbon;
use DB;

class BusinessReportController extends Controller
{
    public function index()
    {
        $growthRate = '56%';
        $growthRateLatest = '5.7%';

        $newOrders = '25%';
        $newOrdersLatest = '12.9%';

        $returnOrders = '10%';
        $returnOrdersLatest = '7.5%';


        $current_year = User::select(DB::raw("(COUNT(*)) as count"),DB::raw("MONTHNAME(created_at) as monthname"))
        ->whereYear('created_at', date('Y'))
        ->groupBy('monthname')
        ->get();

        $current_year1 = User::select(DB::raw("(COUNT(*)) as count"),DB::raw("YEAR(created_at) as year"))
        ->groupBy('year')
        ->get();


        $current_month = User::whereMonth('created_at', date('m'))
        ->whereYear('created_at', date('Y'))
        ->get(['name','created_at']);
        $current_week = User::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $customerVisit = count($current_month);
        $customerVisitLatest = count($current_week);

        $itemSold = '17.9%';
        $wasLastMonth = '';
        $typeOfOffer = '';
        $numberOfCustomers = '';
        $newCustomer = '';
        $offerIncrease = '';
        $followers = '';
        $following = '';

        return view('frontend.business.pages.reports.business_reports', compact('growthRate','growthRateLatest', 'newOrders', 'newOrdersLatest', 'returnOrders','returnOrdersLatest','customerVisit','customerVisitLatest','itemSold', 'wasLastMonth', 'typeOfOffer', 'numberOfCustomers', 'newCustomer', 'offerIncrease','followers','following'));
    }

    public function business_report_filter(Request $request){
        
        $addUserRoles =  Orders::where('id', 1)->orderBy('created_at','DESC')
        ->get()
        ->toArray();

        $rolesArray = [];
        foreach($addUserRoles as $key => $value)
        {
            $rolesArray[$key] = $value;
            $branch = Branch::where('id',$value['branch_id'])->first();
            $rolesArray[$key]['branch'] = $branch;

            $branch = Role::where('id',$value['role_id'])->first();
            $rolesArray[$key]['role'] = $branch;
        }
        return response()->json($rolesArray);
    }
}
