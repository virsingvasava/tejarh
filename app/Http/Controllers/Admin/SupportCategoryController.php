<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportCategory;
use Illuminate\Http\Request;

class SupportCategoryController extends Controller
{
    public function index()
    {
        $support_category = SupportCategory::get();
        return view('admin.support_category.index',compact('support_category'));
    }

    public function create()
    {
        return view('admin.support_category.create');
    }

    public function store(Request $request)
    { 
        $support_category = new SupportCategory;
        $support_category->support_category_name    = $request->name;
        $support_category->ar_support_category_name = $request->ar_name;
        $support_category->status = $request->status;
        $support_category->save();
        return redirect()->route('admin.support-categories.index')->with('success', __('messages.category.success.category_added_successfully'));
    }

    public function status_update(Request $request)
    {
        $status_update = SupportCategory::where('id',$request->support_category_id)->first();
        $status_update->status = $request->status;
        $status_update->save();
        return redirect()->route('admin.support-categories.index')->with('success', __('messages.category.success.category_status_successfully'));
    }

    public function edit($id)
    {
        $id = ($id);        
        $edit_category = SupportCategory::where('id',$id)->first();
        return view('admin.support_category.edit',compact('edit_category'));
    }

    public function update(Request $request)
    {
        $support_category_update = SupportCategory::where('id',$request->id)->first();
        $support_category_update->support_category_name = $request->name;
        $support_category_update->ar_support_category_name = $request->ar_name;
        $support_category_update->status = $request->status;
        $support_category_update->save();
        return redirect()->route('admin.support-categories.index')->with('success', __('Support Category Updated'));
    }

    public function destroy(Request $request)
    {
        $id = $request->support_category_id;
        SupportCategory::where('id',$id)->delete();
        return redirect()->route('admin.support-categories.index')->with('error', __('Support category_deleted_successfully'));
    }
}
