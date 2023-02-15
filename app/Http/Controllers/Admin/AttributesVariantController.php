<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\attribute;
use App\Models\attribute_variant;
use App\Models\AttributeVariant;
use Illuminate\Http\Request;

class AttributesVariantController extends Controller
{
    public function index()
    {
        $attribute_variant = AttributeVariant::get();
        return view('admin.attribute_variant.index',compact('attribute_variant'));
    }

    public function create()
    {
        $attribute = attribute::get();
        return view('admin.attribute_variant.create',compact('attribute'));
    }
    
    public function store(Request $request)
    {
        $validatedRequestData = $request->validate([
            'attribute_id' => 'required',
            'name' => 'required',
            'status' => 'required',

        ]);
        $attribute_variant = new AttributeVariant;
        $attribute_variant->attribute_id           = $request->attribute_id;
        $attribute_variant->name                  = $request->name;
        $attribute_variant->status                = $request->status;
        $attribute_variant->save();
        return redirect()->route('admin.attribute_variant.index')->with('success', __('attribute_variant_added_successfully'));
    }

    public function edit($id){
        $id = base64_decode($id);
        $edit_attribute_variant = AttributeVariant::where('id',$id)->first();
        $edit_attribute = attribute::get();
        return view('admin.attribute_variant.edit',compact('edit_attribute_variant','edit_attribute'));
    }
    public function update(Request $request)
    {
        $attribute_variant_update = AttributeVariant::where('id',$request->id)->first();
        $attribute_variant_update->attribute_id = $request->attribute_id;
        $attribute_variant_update->name = $request->name;
        $attribute_variant_update->status = $request->status;
        $attribute_variant_update->save();
        return redirect()->route('admin.attribute_variant.index')->with('success', __('Attribute_Variant_updated_successfully'));
    }

    public function attribute_variant_status_update(Request $request)
    {
        $status_update = AttributeVariant::where('id',$request->attribute_variant_id)->first();
        $status_update->status = $request->status;
        $status_update->save();
        return redirect()->route('admin.attribute_variant.index')->with('success',__('status_updated_successfully'));
    }
}
