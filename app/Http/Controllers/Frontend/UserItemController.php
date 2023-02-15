<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductImage;
use App\Models\Products;
use App\Models\User;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;

class UserItemController extends Controller
{
    public function PostItem(Request $request){

        $category = Category::where('deleted_at','=',NULL)->get();
        $subCategory = SubCategory::where('deleted_at','=',NULL)->get();
        return view('frontend.users.sell-item',compact('category','subCategory'));
    }

    public function store(Request $request){

        $products = new Products();
        $products->user_id = Auth::user()->id;
        $products->category_id = $request->category_id;
        $products->category_id = $request->sub_category_id;
        $products->brand_id = $request->brand_id;
        $products->selling_description = $request->selling_description;
        $products->item_description = $request->item_description;
        $products->weight = $request->weight;
        $products->condition = $request->condition;
        $products->quantity = $request->quantity;
        $products->zip_code = $request->zip_code;
        $products->ship_mode = $request->ship_mode;
        $products->pay_shipping = $request->pay_shipping;
        $products->price_type = $request->price_type;
        $products->price = $request->price;
        $products->status = $request->status;
        
        // $postItem = new ProductImage();
        // $postItem
    }

    public function getSubCat($id){
        $subCategory = SubCategory::where("category_id",$id)->pluck("sub_cate_name","id");   
        return json_encode($subCategory);
    }

    public function getBrand($id){
        $brand = Brand::where("sub_category_id",$id)->pluck("name","id");   
        return json_encode($brand);
    }
}
