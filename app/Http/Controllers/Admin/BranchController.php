<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use Illuminate\Support\Str;
use File;
use Lang;

class BranchController extends Controller
{
    public function index() 
    {
        $branch = Branch::get();
        return view('admin.branch.index',compact('branch'));
    }

    public function create()
    {
        return view('admin.branch.create');
    }

    public function store(Request $request)
    { 
        $validatedRequestData = $request->validate([

            'name' => 'required',
            'slug' => 'required',
            'status' => 'required',

        ], [
            'name.required' => Lang::get('messages.branch.create.validation.please_enter_name'),
            'slug.required' => Lang::get('messages.branch.create.validation.please_enter_slug'),
            'status.required' => Lang::get('messages.branch.create.validation.please_select_status'),
        ]);

        $branch = new Branch;
        $branch->name = $request->name;
        $branch->slug = Str::slug($request->slug);
        $branch->status = $request->status;

        $branch->ar_name = $request->ar_name;
        $branch->ar_slug = Str::slug($request->ar_slug);
        $branch->ar_status = $request->ar_status;
        $branch->save();
        return redirect()->route('admin.branch.index')->with('success', __('messages.branch.success.branch_added_successfully'));        
    }

    public function view($id)
    {
        $id = base64_decode($id);
        $view_branch = Branch::where('id',$id)->first();
        return view('admin.branch.view',compact('view_branch'));
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $edit_branch = Branch::where('id',$id)->first();
        return view('admin.branch.edit',compact('edit_branch'));
    }

    public function update(Request $request)
    {
      // p($request->all());

        $validatedRequestData = $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'status' => 'required',

        ], [
            'name.required' => Lang::get('messages.branch.create.validation.please_enter_name'),
            'slug.required' => Lang::get('messages.branch.create.validation.please_enter_slug'),
            'status.required' => Lang::get('messages.branch.create.validation.please_select_status'),
        ]);

        $brand_update = Branch::where('id',$request->id)->first();
        $brand_update->name = $request->name;
        $brand_update->slug = Str::slug($request->slug);
        $brand_update->status = $request->status;

        $brand_update->ar_name = $request->ar_name;
        $brand_update->ar_slug = Str::slug($request->ar_slug);
        $brand_update->ar_status = $request->ar_status;
        $brand_update->save();
        return redirect()->route('admin.branch.index')->with('success', __('messages.branch.success.branch_updated_successfully'));
    }

    public function destroy(Request $request)
    {   
        $id = $request->branch_id;
        Branch::where('id',$id)->delete();
        return redirect()->route('admin.branch.index')->with('error', __('messages.branch.success.branch_deleted_successfully'));

    }

    public function brand_status_update(Request $request)
    {
        $status_update = Branch::where('id',$request->branch_id)->first();
        $status_update->status = $request->status;
        $status_update->save();

        return redirect()->route('admin.branch.index')->with('success', __('messages.branch.success.status_updated_successfully'));
    }
}
