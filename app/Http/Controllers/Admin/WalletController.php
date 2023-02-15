<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WalletController extends Controller
{
     public function index() 
    {
        $category = Category::get();
        return view('admin.category.index',compact('category'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    { 

        $category = new Category;
        $category->user_id = Auth::user()->id;
        $category->category_name = $request->category_name;
        $category->slug = Str::slug($request->slug);

        if ($request->hasFile('cate_picture')) 
        {
            $cate_picture = $request->file('cate_picture');
            $name = time().'.'.$cate_picture->getClientOriginalExtension();
            $destinationPath = public_path('/img/category');

            if (!file_exists($destinationPath)) {
               File::makeDirectory($destinationPath, 0755, true, true);
            }

            $cate_picture->move($destinationPath, $name);
            $category->cate_picture = $name;
        }
        $category->status = $request->status;
        $category->save();
        return redirect()->route('admin.category.index')->with('success','Category added successfully');

    }

    public function view($id)
    {
        $id = base64_decode($id);
        $view_category = Category::where('id',$id)->first();
        return view('admin.category.view',compact('view_category'));
    }

    public function edit($id)
    {
        $id = base64_decode($id);        
        $edit_category = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('edit_category'));

    }

    public function update(Request $request)
    {
        $category_update = Category::where('id',$request->id)->first();
        $category_update->user_id = Auth::user()->id;
        $category_update->category_name = $request->category_name;
        $category_update->slug = Str::slug($request->slug);

        if ($request->hasFile('cate_picture')) 
        {
            $cate_picture = $request->file('cate_picture');
            $name = time().'.'.$cate_picture->getClientOriginalExtension();
            $destinationPath = public_path('/img/category');
            $cate_picture->move($destinationPath, $name);
            $category_update->cate_picture = $name;
        }
        
        $category_update->status = $request->status;
        $category_update->save();

        return redirect()->route('admin.category.index')->with('success','Category updated successfully');
    }

    public function destroy(Request $request)
    {
        $id = $request->category_id;
        Category::where('id',$id)->delete();
        return redirect()->route('admin.category.index')->with('error','Category deleted successfully!');

    }

    public function category_status_update(Request $request)
    {
        $status_update = Category::where('id',$request->category_id)->first();
        $status_update->status = $request->status;
        $status_update->save();
        return redirect()->route('admin.category.index')->with('success','Status updated successfully!');
    }
}
