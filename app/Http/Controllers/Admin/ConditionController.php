<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Condition;
use Lang;

class ConditionController extends Controller
{
    public function index() 
    {

        $conditions = Condition::get();
        return view('admin.condition.index',compact('conditions'));
    }

    public function create()
    {
        $brands = Brand::get();
        return view('admin.condition.create',compact('brands'));
    }

    public function store(Request $request)
    { 
        $validatedRequestData = $request->validate([

            // 'brand_id' => 'required',
            'name' => 'required',
            'status' => 'required',

        ], [
            // 'brand_id.required' => Lang::get('messages.condition.create.validation.please_select_brand'),
            'name.required' => Lang::get('messages.condition.create.validation.please_enter_name'),
            'status.required' => Lang::get('messages.condition.create.validation.please_select_status'),
        ]);

        $condition = new Condition;
        // $condition->brand_id = $request->brand_id;
        $condition->name = $request->name;
        $condition->status = $request->status;

        $condition->ar_name = $request->ar_name;
        $condition->ar_status = $request->ar_status;
        $condition->save();
        return redirect()->route('admin.condition.index')->with('success', __('messages.condition.success.condition_added_successfully'));
    }

    public function view($id)
    {
        $id = base64_decode($id);
        $view_condition = Condition::where('id',$id)->first();
        return view('admin.condition.view',compact('view_condition'));
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $edit_condition = Condition::where('id',$id)->first();
        $brands = Brand::get();
        return view('admin.condition.edit',compact('edit_condition', 'brands'));

    }

    public function update(Request $request)
    {

        $validatedRequestData = $request->validate([

            // 'brand_id' => 'required',
            'name' => 'required',
            'status' => 'required',

        ], [
            // 'brand_id.required' => Lang::get('messages.condition.create.validation.please_select_brand'),
            'name.required' => Lang::get('messages.condition.create.validation.please_enter_name'),
            'status.required' => Lang::get('messages.condition.create.validation.please_select_status'),
        ]);

        $condition_update = Condition::where('id',$request->id)->first();
        // $condition_update->brand_id = $request->brand_id;
        $condition_update->name = $request->name;
        $condition_update->status = $request->status;

        $condition_update->ar_name = $request->ar_name;
        $condition_update->ar_status = $request->ar_status;
        $condition_update->save();
        return redirect()->route('admin.condition.index')->with('success', __('messages.condition.success.condition_updated_successfully'));
    }

    public function destroy(Request $request)
    {
        $id = $request->condition_id;
        Condition::where('id',$id)->delete();
        return redirect()->route('admin.condition.index')->with('error',  __('messages.condition.success.condition_deleted_successfully'));

    }

    public function condition_status_update(Request $request)
    {
        $status_update = Condition::where('id',$request->condition_id)->first();
        $status_update->status = $request->status;
        $status_update->save();
        return redirect()->route('admin.condition.index')->with('success', __('messages.condition.success.status_updated_successfully'));
    }
}
