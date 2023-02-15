<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BoostItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\HoldAnOffer;
use App\Models\Item;
use App\Models\MakeAnOffer;
use App\Models\Orders;
use App\Models\Stories;
use App\Models\UserLike;
use App\Models\UserStory;
use App\Models\Wishlist;
use Illuminate\Support\Str;
use File;
use Illuminate\Support\Facades\Auth;
use Lang;
use Hash;

class CategoryController extends Controller
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
        $validatedRequestData = $request->validate([

            'name' => 'required',
            'slug' => 'required',
            'cate_picture' => 'required',
            'status' => 'required',

        ], [
            'name.required' => Lang::get('messages.category.create.validation.please_enter_name'),
            'slug.required' => Lang::get('messages.category.create.validation.please_enter_slug'),
            'cate_picture.required' => Lang::get('messages.category.create.validation.please_choose_picture'),
            'status.required' => Lang::get('messages.category.create.validation.please_select_status'),
        ]);

        $category = new Category;
        $category->user_id = Auth::user()->id;
        $category->category_name = $request->name;
        $category->slug = $request->slug;
        $category->status = $request->status;

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
        $category->ar_category_name = $request->ar_name;
        $category->ar_slug = $request->ar_slug;
        $category->ar_status = $request->ar_status;
        $category->save();
        return redirect()->route('admin.category.index')->with('success', __('messages.category.success.category_added_successfully'));

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
        
        $validatedRequestData = $request->validate([

            'name' => 'required',
            'slug' => 'required',
            'status' => 'required',

        ], [
            'name.required' => Lang::get('messages.category.create.validation.please_enter_name'),
            'slug.required' => Lang::get('messages.category.create.validation.please_enter_slug'),
            'status.required' => Lang::get('messages.category.create.validation.please_select_status'),
        ]);

        $category_update = Category::where('id',$request->id)->first();
        $category_update->user_id = Auth::user()->id;
        $category_update->category_name = $request->name;
        $category_update->slug = $request->slug;

        if ($request->hasFile('cate_picture')) 
        {
            $cate_picture = $request->file('cate_picture');
            $name = time().'.'.$cate_picture->getClientOriginalExtension();
            $destinationPath = public_path('/img/category');
            $cate_picture->move($destinationPath, $name);
            $category_update->cate_picture = $name;
        }
        
        $category_update->ar_category_name = $request->ar_name;
        $category_update->ar_slug = $request->ar_slug;
        $category_update->ar_status = $request->ar_status;
        $category_update->save();

        return redirect()->route('admin.category.index')->with('success', __('messages.category.success.category_updated_successfully'));
    }
 
    public function destroy(Request $request)
    {
        $id = $request->category_id;
        $item = Item::where('category_id',$id)->get();
        foreach($item as $value)
        {
            BoostItem::where('item_id',$value['id'])->delete();
            Cart::where('item_id',$value['id'])->delete();
            HoldAnOffer::where('item_id',$value['id'])->delete();
            MakeAnOffer::where('item_id',$value['id'])->delete();
            Orders::where('item_id',$value['id'])->delete();
            UserLike::where('item_id',$value['id'])->delete();
            Wishlist::where('item_id',$value['id'])->delete();
        }
        Stories::where('category_id',$id)->delete();
        UserStory::where('category_id',$id)->delete();
        Category::where('id',$id)->delete();
        return redirect()->route('admin.category.index')->with('error', __('messages.category.success.category_deleted_successfully'));

    }

    public function category_status_update(Request $request)
    {
        $status_update = Category::where('id',$request->category_id)->first();
        $status_update->status = $request->status;
        $status_update->save();
        return redirect()->route('admin.category.index')->with('success', __('messages.category.success.category_status_successfully'));
    }
}


