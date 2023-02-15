<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Support\Str;
use Lang;
use File;

class SubCategoryController extends Controller
{
    public function index() 
    {
        
        $sub_category1 = SubCategory::get();
        $sub_category = SubCategory::with('category')->get();
        return view('admin.sub_category.index',compact('sub_category'));
    }

    public function create()
    {
        $category = Category::get();
        return view('admin.sub_category.create',compact('category'));
    }

    public function store(Request $request)
    { 
        
        $validatedRequestData = $request->validate([

            'category_id' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'sub_cate_picture' => 'required',
            'status' => 'required',

        ], [

            'category_id.required' => Lang::get('messages.sub_category.create.validation.please_select_category'),
            'name.required' => Lang::get('messages.sub_category.create.validation.please_enter_name'),
            'slug.required' => Lang::get('messages.sub_category.create.validation.please_enter_slug'),
            'sub_cate_picture.required' => Lang::get('messages.sub_category.create.validation.please_choose_picture'),
            'status.required' => Lang::get('messages.sub_category.create.validation.please_select_status'),
        ]);

        
        $sub_category = new SubCategory;
        $sub_category->category_id = $request->category_id;
        $sub_category->sub_cate_name = $request->name;
        $sub_category->slug = $request->slug;
        $sub_category->status = $request->status;

        if ($request->hasFile('sub_cate_picture')) 
        {
            $sub_cate_picture = $request->file('sub_cate_picture');
            $name = time().'.'.$sub_cate_picture->getClientOriginalExtension();
            $destinationPath = public_path('/img/sub_category');

            if (!file_exists($destinationPath)) {
               File::makeDirectory($destinationPath, 0755, true, true);
            }

            $sub_cate_picture->move($destinationPath, $name);
            $sub_category->sub_cate_picture = $name;
        }

        $sub_category->ar_category_id = $request->ar_category_id;
        $sub_category->ar_sub_cate_name = $request->ar_sub_cate_name;
        $sub_category->ar_slug = $request->ar_slug;
        $sub_category->ar_status = $request->ar_status;
        $sub_category->save();
        return redirect()->route('admin.sub_category.index')->with('success', __('messages.sub_category.success.sub_category_added_successfully'));

    }

    public function view($id)
    {
        $id = base64_decode($id);
        $view_sub_category = SubCategory::where('id',$id)->first();
        return view('admin.sub_category.view',compact('view_sub_category'));
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $edit_sub_category = SubCategory::where('id',$id)->first();
        $category = Category::get();
        return view('admin.sub_category.edit',compact('edit_sub_category', 'category'));

    }

    public function update(Request $request)
    {
        $validatedRequestData = $request->validate([

            'category_id' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'status' => 'required',

        ], [

            'category_id.required' => Lang::get('messages.sub_category.create.validation.please_select_category'),
            'name.required' => Lang::get('messages.sub_category.create.validation.please_enter_name'),
            'slug.required' => Lang::get('messages.sub_category.create.validation.please_enter_slug'),
            'status.required' => Lang::get('messages.sub_category.create.validation.please_select_status'),
        ]);


        $sub_category_update = SubCategory::where('id',$request->id)->first();
        $sub_category_update->category_id = $request->category_id;
        $sub_category_update->sub_cate_name = $request->name;
        $sub_category_update->slug = $request->slug;


        if ($request->hasFile('sub_cate_picture')) 
        {
            $sub_cate_picture = $request->file('sub_cate_picture');
            $name = time().'.'.$sub_cate_picture->getClientOriginalExtension();
            $destinationPath = public_path('/img/sub_category');
            $sub_cate_picture->move($destinationPath, $name);
            $sub_category_update->sub_cate_picture = $name;
        }

        $sub_category_update->ar_category_id = $request->ar_category_id;
        $sub_category_update->ar_sub_cate_name = $request->ar_name;
        $sub_category_update->ar_slug = $request->ar_slug;
        $sub_category_update->ar_status = $request->ar_status;
        $sub_category_update->save();

        return redirect()->route('admin.sub_category.index')->with('success', __('messages.sub_category.success.sub_category_updated_successfully'));
    }

    public function destroy(Request $request)
    {
        $id = $request->sub_category_id;
        SubCategory::where('id',$id)->delete();
        return redirect()->route('admin.sub_category.index')->with('error', __('messages.sub_category.success.sub_category_deleted_successfully'));

    }

    public function sub_category_status_update(Request $request)
    {
        $status_update = SubCategory::where('id',$request->sub_category_id)->first();
        $status_update->status = $request->status;
        $status_update->save();
        return redirect()->route('admin.sub_category.index')->with('success', __('messages.sub_category.success.sub_category_status_successfully'));
    }
}
