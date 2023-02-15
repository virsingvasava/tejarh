<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\attribute;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttributeController extends Controller
{
    public function index()
    {
        $attribute = DB::Table('attributes')
        ->leftjoin('category','attributes.category_id','category.id')
        ->leftjoin('sub_category','attributes.sub_category_id','sub_category.id')
        ->select('attributes.id','attributes.name','attributes.ar_name','category.category_name', 'category.ar_category_name', 'sub_category.sub_cate_name','sub_category.ar_sub_cate_name','attributes.status')
        ->get();
        
        return view('admin.attribute.index',compact('attribute'));
    }

    public function create()
    {
        $category = Category::get();
        $sub_category = SubCategory::get();
        return view('admin.attribute.create',compact('category', 'sub_category'));
    }

    public function store(Request $request)
    {

        $validatedRequestData = $request->validate([
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'name' => 'required',
            'status' => 'required',

        ]);
        $attribute = new attribute;
        $attribute->category_id           = $request->category_id;
        $attribute->sub_category_id       = $request->sub_category_id;
        $attribute->name                  = $request->name;
        $attribute->status                = $request->status;
        $attribute->save();
        return redirect()->route('admin.attribute.index')->with('success', __('product_added_successfully'));
    }

    public function view($id)
    {
        $id = base64_decode($id);
        $view_attribute = attribute::where('id',$id)->first();
        $view_category = Category::where('id',$view_attribute->category_id)->first();
        $view_sub_category = SubCategory::where('id',$view_attribute->sub_category_id)->first();
        return view('admin.attribute.view',compact('view_attribute','view_category','view_sub_category'));
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $edit_attribute = attribute::where('id',$id)->first();
        $edit_category = Category::get();
         //dd($edit_category);
        $subCategory = SubCategory::get();
        return view('admin.attribute.edit',compact('edit_attribute','edit_category','subCategory'));

    }

    public function update(Request $request)
    {
        $attribute_update = attribute::where('id',$request->id)->first();
        $attribute_update->category_id = $request->category_id;
        $attribute_update->sub_category_id = $request->sub_category_id;
        $attribute_update->name = $request->name;
        $attribute_update->status = $request->status;
        $attribute_update->save();
        return redirect()->route('admin.attribute.index')->with('success', __('Attribute_updated_successfully'));

    }

    public function destroy(Request $request)
    {
        $id = $request->brand_id;
        attribute::where('id',$id)->delete();
        return redirect()->route('admin.attribute.index')->with('error',__('Attribute_deleted_successfully'));
    }


    public function attribute_status_update(Request $request)
    {
        $status_update = attribute::where('id',$request->attribute_id)->first();
        $status_update->status = $request->status;
        $status_update->save();
        return redirect()->route('admin.attribute.index')->with('success',__('messages.blog.success.status_updated_successfully'));
    }
}
