<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StoreType;
use Lang;

class StoreTypeController extends Controller
{
    public function index() 
    {

        $storeType = StoreType::get();
        return view('admin.store_type.index',compact('storeType'));
    }

    public function create()
    {
        return view('admin.store_type.create');
    }

    public function store(Request $request)
    { 
        $validatedRequestData = $request->validate([

            'name' => 'required',
            'slug' => 'required',
            'status' => 'required',

        ], [
            'name.required' => Lang::get('messages.store_type.create.validation.please_enter_name'),
            'slug.required' => Lang::get('messages.store_type.create.validation.please_enter_slug'),
            'status.required' => Lang::get('messages.store_type.create.validation.please_select_status'),
        ]);

        $storeType = new StoreType;
        $storeType->name = $request->name;
        $storeType->slug = $request->slug;
        $storeType->status = $request->status;

        $storeType->ar_name = $request->ar_name;
        $storeType->ar_slug = $request->ar_slug;
        $storeType->ar_status = $request->ar_status;

        $storeType->save();
        return redirect()->route('admin.store_type.index')->with('success', __('messages.store_type.success.store_type_added_successfully'));
    }

    public function view($id)
    {
        $id = base64_decode($id);
        $view_storeType = StoreType::where('id',$id)->first();
        return view('admin.store_type.view',compact('view_storeType'));
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $edit_storeType = StoreType::where('id',$id)->first();
        return view('admin.store_type.edit',compact('edit_storeType'));

    }

    public function update(Request $request)
    {

        $validatedRequestData = $request->validate([

            'name' => 'required',
            'slug' => 'required',
            'status' => 'required',

        ], [
            'name.required' => Lang::get('messages.store_type.create.validation.please_enter_name'),
            'slug.required' => Lang::get('messages.store_type.create.validation.please_enter_slug'),
            'status.required' => Lang::get('messages.store_type.create.validation.please_select_status'),
        ]);
        
        $storeType_update = StoreType::where('id',$request->id)->first();
        $storeType_update->name = $request->name;
        $storeType_update->slug = $request->slug;
        $storeType_update->status = $request->status;

        $storeType_update->ar_name = $request->ar_name;
        $storeType_update->ar_slug = $request->ar_slug;
        $storeType_update->ar_status = $request->ar_status;
        $storeType_update->save();
        return redirect()->route('admin.store_type.index')->with('success', __('messages.store_type.success.store_type_updated_successfully'));
    }

    public function destroy(Request $request)
    {
        $id = $request->store_type_id;
        StoreType::where('id',$id)->delete();
        return redirect()->route('admin.store_type.index')->with('error',  __('messages.store_type.success.store_type_deleted_successfully'));

    }
    
    public function store_type_status_update(Request $request)
    {
        $status_update = StoreType::where('id',$request->store_type_id)->first();
        $status_update->status = $request->status;
        $status_update->save();
        return redirect()->route('admin.store_type.index')->with('success', __('messages.store_type.success.status_updated_successfully'));
    }
}
