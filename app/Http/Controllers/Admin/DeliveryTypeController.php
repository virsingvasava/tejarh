<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class DeliveryTypeController extends Controller
{
    public function index() 
    {
        $deliveryType = DeliveryType::get();
        return view('admin.delivery_type.index',compact('deliveryType'));
    }

    public function create()
    {
        return view('admin.delivery_type.create');
    }

    public function store(Request $request)
    { 
        $validatedRequestData = $request->validate([

            'name' => 'required',
            'slug' => 'required',
            'status' => 'required',

        ], [
            'name.required' => Lang::get('messages.delivery_type.create.validation.please_enter_name'),
            'slug.required' => Lang::get('messages.delivery_type.create.validation.please_enter_slug'),
            'status.required' => Lang::get('messages.delivery_type.create.validation.please_select_status'),
        ]);

        $deliveryType = new DeliveryType;
        $deliveryType->name = $request->name;
        $deliveryType->slug = $request->slug;
        $deliveryType->status = $request->status;

        $deliveryType->ar_name = $request->ar_name;
        $deliveryType->ar_slug = $request->ar_slug;
        $deliveryType->ar_status = $request->ar_status;
        $deliveryType->save();
        return redirect()->route('admin.delivery_type.index')->with('success', __('messages.delivery_type.success.delivery_type_added_successfully'));
    }

    public function view($id)
    {
        $id = base64_decode($id);
        $view_deliveryType = DeliveryType::where('id',$id)->first();
        return view('admin.delivery_type.view',compact('view_deliveryType'));
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $edit_deliveryType = DeliveryType::where('id',$id)->first();
        return view('admin.delivery_type.edit',compact('edit_deliveryType'));

    }

    public function update(Request $request)
    {

        $validatedRequestData = $request->validate([

            'name' => 'required',
            'slug' => 'required',
            'status' => 'required',

        ], [
            'name.required' => Lang::get('messages.delivery_type.create.validation.please_enter_name'),
            'slug.required' => Lang::get('messages.delivery_type.create.validation.please_enter_slug'),
            'status.required' => Lang::get('messages.delivery_type.create.validation.please_select_status'),
        ]);
        
        $deliveryType_update = DeliveryType::where('id',$request->id)->first();
        $deliveryType_update->name = $request->name;
        $deliveryType_update->slug = $request->slug;
        $deliveryType_update->status = $request->status;

        $deliveryType_update->ar_name = $request->ar_name;
        $deliveryType_update->ar_name = $request->ar_name;
        $deliveryType_update->ar_status = $request->ar_status;

        $deliveryType_update->save();
        return redirect()->route('admin.delivery_type.index')->with('success', __('messages.delivery_type.success.delivery_type_updated_successfully'));
    }

    public function destroy(Request $request)
    {
        $id = $request->delivery_type_id;
        DeliveryType::where('id',$id)->delete();
        return redirect()->route('admin.delivery_type.index')->with('error',  __('messages.delivery_type.success.delivery_type_deleted_successfully'));

    }
    
    public function delivery_type_status_update(Request $request)
    {
        $status_update = DeliveryType::where('id',$request->delivery_type_id)->first();
        $status_update->status = $request->status;
        $status_update->save();
        return redirect()->route('admin.delivery_type.index')->with('success', __('messages.delivery_type.success.status_updated_successfully'));
    }
}
