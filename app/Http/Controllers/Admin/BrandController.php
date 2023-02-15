<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use Illuminate\Support\Str;
use File;
use Lang;

class BrandController extends Controller
{
    public function index() 
    {

        $brand = Brand::get();
        return view('admin.brand.index',compact('brand'));
    }

    public function create()
    {
        $category = Category::get();
        $sub_category = SubCategory::get();
        return view('admin.brand.create',compact('sub_category', 'category'));
    }

    public function store(Request $request)
    { 
        //p($request->all());
        
        $validatedRequestData = $request->validate([

            // 'sub_category_id' => 'required',
            'name' => 'required',
            'model' => 'required',
            'slug' => 'required',
            'status' => 'required',

        ], [
            // 'sub_category_id' => Lang::get('messages.brand.create.validation.please_select_sub_category'),
            'name.required' => Lang::get('messages.brand.create.validation.please_enter_name'),
            'model.required' => Lang::get('messages.brand.create.validation.please_enter_model'),
            'slug.required' => Lang::get('messages.brand.create.validation.please_enter_slug'),
            'status.required' => Lang::get('messages.brand.create.validation.please_select_status'),
        ]);

        $brand = new Brand;
        $brand->category_id = $request->category_id;
        $subCate[] = $request->subCate;
        $brand->sub_category_id = json_encode($subCate);
        $brand->name = $request->name;
        $brand->model = $request->model;
        $brand->slug = $request->slug;
        $brand->status = $request->status;

        $brand->ar_name = $request->ar_name;
        $brand->ar_model = $request->ar_model;
        $brand->ar_slug = $request->ar_slug;
        $brand->ar_status = $request->ar_status;
        $brand->save();
        return redirect()->route('admin.brand.index')->with('success', __('messages.brand.success.brand_added_successfully'));
    }

    public function view($id)
    {
        $id = base64_decode($id);
        $view_brand = Brand::where('id',$id)->first();
        $view_sub_category = SubCategory::where('id',$view_brand->sub_category_id)->first();
        return view('admin.brand.view',compact('view_brand','view_sub_category'));
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $edit_brand = Brand::where('id',$id)->first();
        $subCategory = SubCategory::get();
        return view('admin.brand.edit',compact('edit_brand', 'subCategory'));

    }

    public function update(Request $request)
    {

        $validatedRequestData = $request->validate([
            // 'sub_category_id' => 'required',
            'name' => 'required',
            'model' => 'required',
            'slug' => 'required',
            'status' => 'required',

        ], [
            // 'sub_category_id.required' => Lang::get('messages.brand.create.validation.please_select_sub_category'),
            'name.required' => Lang::get('messages.brand.create.validation.please_enter_name'),
            'model.required' => Lang::get('messages.brand.create.validation.please_enter_model'),
            'slug.required' => Lang::get('messages.brand.create.validation.please_enter_slug'),
            'status.required' => Lang::get('messages.brand.create.validation.please_select_status'),
        ]);

        $brand_update = Brand::where('id',$request->id)->first();
        $brand_update->category_id = $request->category_id;

        $subCate[] = $request->subCate;
        $brand_update->sub_category_id = json_encode($subCate);
        $brand_update->name = $request->name;
        $brand_update->model = $request->model;
        $brand_update->slug = $request->slug;
        $brand_update->status = $request->status;

        $brand_update->ar_name = $request->ar_name;
        $brand_update->ar_model = $request->ar_model;
        $brand_update->ar_slug = $request->ar_slug;
        $brand_update->ar_status = $request->ar_status;
        $brand_update->save();
        return redirect()->route('admin.brand.index')->with('success', __('messages.brand.success.brand_updated_successfully'));
    }

    public function destroy(Request $request)
    {
        $id = $request->brand_id;
        Brand::where('id',$id)->delete();
        return redirect()->route('admin.brand.index')->with('error',__('messages.brand.success.brand_deleted_successfully'));

    }

    public function brand_status_update(Request $request)
    {
        $status_update = Brand::where('id',$request->brand_id)->first();
        $status_update->status = $request->status;
        $status_update->save();
        return redirect()->route('admin.brand.index')->with('success',__('messages.brand.success.status_updated_successfully'));
    }

    public function subCategories(Request $request)
    {
        $subCategory = SubCategory::where("category_id",$request->cat_id)->pluck("sub_cate_name","id");   
        return json_encode($subCategory);
    }


    
}
