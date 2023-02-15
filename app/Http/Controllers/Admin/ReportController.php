<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Str;
use File;
use Lang;

class ReportController extends Controller
{
     public function index() 
    {

        $sales_report = Report::get();
        return view('admin.report.sales.index',compact('sales_report'));
    }

    public function destroy(Request $request)
    {
        $id = $request->report_id;
        Report::where('id',$id)->delete();
        return redirect()->route('admin.report.sales.index')->with('error', __('messages.report.success.deleted_successfully'));

    }

     public function report_status_update(Request $request)
    {
        $status_update = Report::where('id',$request->report_id)->first();
        $status_update->status = $request->status;
        $status_update->save();
        return redirect()->route('admin.report.sales.index')->with('success', __('messages.report.success.status_updated_successfully'));
    }
}
