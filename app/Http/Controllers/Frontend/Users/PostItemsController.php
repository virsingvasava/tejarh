<?php

namespace App\Http\Controllers\Frontend\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemsImages;
use App\Models\SubCategory;
use App\Models\Condition;
use App\Models\ShipMode;
use App\Models\Category;
use App\Models\Store;
use App\Models\Brand;
use App\Models\Item;
use File;
use Lang;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SellNowItesm as ValidationCode;
use App\Models\attribute;
use App\Models\City;
use App\Models\Commission;
use Illuminate\Support\Facades\DB;
use App\Models\DeliveryType;
use App\Models\Inventory;
use App\Models\stock;

class PostItemsController extends Controller
{
    public function index(Request $request)
    {

        $category = Category::where('deleted_at', '=', NULL)->orderBy('category_name', 'ASC')->get();
        $sub_category = SubCategory::where('deleted_at', '=', NULL)->orderBy('sub_cate_name', 'ASC')->get();
        $brands = Brand::where('deleted_at', '=', NULL)->orderBy('name', 'ASC')->get();
        $condition = Condition::where('deleted_at', '=', NULL)->orderBy('name', 'ASC')->get();
        $ship_mode = ShipMode::where('deleted_at', '=', NULL)->orderBy('name', 'ASC')->get();
        $stores = Store::where('deleted_at', '=', NULL)->get();
        $city = City::orderBy('name', 'ASC')->get();
        $delivery_type = DeliveryType::get();
        $commission_data = Commission::where('type','commission_user')->first();
        if(!empty($commission_data)){
            $commission_user = $commission_data->name;            
        }
        return view('frontend.users.post_items.create', compact('commission_user','delivery_type','category', 'sub_category', 'brands', 'condition', 'ship_mode', 'stores','city'));
    }
    public function store(Request $request)
    {
        $sku_generate = random_int(100000, 999999);
        $sku_generate = 'SKU-'.$sku_generate;
        
        $items_add = new Item;
        $items_add->user_id  = Auth::User()->id;
        $items_add->what_are_you_selling  = $request->item_description;
        $items_add->describe_your_items  = $request->describe_your_items;
        $items_add->category_id  = $request->category_id;
        $items_add->sub_category_id  = $request->subcat_id;
        $items_add->brand_id  = $request->brand_id;
        $items_add->condition_id  = $request->condition_id;
        $items_add->weight  = $request->enter_weight;
        $items_add->width  = $request->width;
        $items_add->length  = $request->length;
        $items_add->height  = $request->height;
        $items_add->quantity  = $request->qty_id;
        $items_add->address  = $request->ship_from;
        $items_add->latitude  = $request->lat;
        $items_add->longitude  = $request->lng;
        // $items_add->ship_mode_id  = $request->ship_mode_id;
        $items_add->delivery_type  = $request->delivery_type;
        $items_add->pay_shipping  = $request->pay_shipping;
        $items_add->price_type  = $request->price_type;
        $items_add->price  = $request->total_amount;
        $items_add->total_amount  = $request->price;
        $items_add->commission_charge  = $request->commission_charge;
        $items_add->sku  = 'Sku-'.$request->sku;
        $items_add->status = '1';
        $items_add->attributes = $request->attribute_id;
        $items_add->choice_options = $request->attribute_variants_id;
        //dd($items_add);
        $items_add->save();

        $item_image = new ItemsImages;
        $item_image->user_id  =  Auth::User()->id;
        $item_image->item_id  = $items_add->id;
        if ($request->hasFile('item_picture1')) {
            $picture1 = $request->file('item_picture1');
            $name = 'item_picture1_' . time() . '.' . $picture1->getClientOriginalExtension();
            $destinationPath = public_path(USERS_ITEMS_POST_FOLDER);
            $picture1->move($destinationPath, $name);
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $item_image->item_picture1 = $name;
        }

        if ($request->hasFile('item_picture2')) {
            $picture2 = $request->file('item_picture2');
            $name = 'item_picture2_' . time() . '.' . $picture2->getClientOriginalExtension();
            $destinationPath = public_path(USERS_ITEMS_POST_FOLDER);
            $picture2->move($destinationPath, $name);
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $item_image->item_picture2 = $name;
        }

        if ($request->hasFile('item_picture3')) {
            $picture3 = $request->file('item_picture3');
            $name = 'item_picture3_' . time() . '.' . $picture3->getClientOriginalExtension();
            $destinationPath = public_path(USERS_ITEMS_POST_FOLDER);
            $picture3->move($destinationPath, $name);
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $item_image->item_picture3 = $name;
        }

        if ($request->hasFile('item_picture4')) {
            $picture4 = $request->file('item_picture4');
            $name = 'item_picture4_' . time() . '.' . $picture4->getClientOriginalExtension();
            $destinationPath = public_path(USERS_ITEMS_POST_FOLDER);
            $picture4->move($destinationPath, $name);
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $item_image->item_picture4 = $name;
        }

        if ($request->hasFile('item_picture5')) {
            $picture5 = $request->file('item_picture5');
            $name = 'item_picture5_' . time() . '.' . $picture5->getClientOriginalExtension();
            $destinationPath = public_path(USERS_ITEMS_POST_FOLDER);
            $picture5->move($destinationPath, $name);
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $item_image->item_picture5 = $name;
        }

        if ($request->hasFile('item_picture6')) {
            $picture6 = $request->file('item_picture6');
            $name = 'item_picture6_' . time() . '.' . $picture6->getClientOriginalExtension();
            $destinationPath = public_path(USERS_ITEMS_POST_FOLDER);
            $picture6->move($destinationPath, $name);
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $item_image->item_picture6 = $name;
        }
        $item_image->status  = true;
        //dd($item_image);
        $item_image->save();

        $storeInventory = new Inventory;
        $storeInventory->user_id            = Auth::User()->id;
        $storeInventory->store_id           = $items_add->store_id;
        $storeInventory->item_id            = $items_add->id;
        $storeInventory->total_stock        = $items_add->quantity;
        $storeInventory->stock_remaining    = $items_add->quantity;
        $storeInventory->save();

        $storeStock = new stock;
        $storeStock->user_id            = Auth::User()->id;
        $storeStock->item_id            = $items_add->id;
        $storeStock->quantity           = $items_add->quantity;
        $storeStock->item_upload_status = 'single';
        $storeStock->stock_status       = TRUE;
        $storeStock->save();

        return redirect()->route('frontend.users.site.index')->with('success', __('messages.product.success.product_added_successfully'));
    }

    public function getSubCat($id)
    {

        $subCategory = SubCategory::where("category_id", $id)->pluck("sub_cate_name", "id");
        return json_encode($subCategory);
    }

    public function getBrand($id)
    {

        $brand = Brand::where("sub_category_id", $id)->pluck("name", "id");
        return json_encode($brand);
    }
    
    public function getAttribute(Request $request)
    {
        $attribute = attribute::where('sub_category_id',$request->subcat_id)->pluck("name","id");
        return json_encode($attribute);
    }

    public function getAttributevariants(Request $request)
    {
        $variants = DB::table('attribute_variants')
        ->where('attribute_id',$request->attribute_id)->pluck("name","id");
        return json_encode($variants);
    }

    public function edit($id)
    {
        $quantityArray = config('setting.quantityArray');
        $view_post = Item::where('id', $id)->where('status','=','1')->first();
        $post_image = $view_post->id;
        $view_post_image = ItemsImages::where('item_id', $post_image)->first();
        $category = Category::where('deleted_at', '=', NULL)->orderBy('category_name', 'ASC')->get();
        $sub_category = SubCategory::where('deleted_at', '=', NULL)->orderBy('sub_cate_name', 'ASC')->get();
        $brands = Brand::where('deleted_at', '=', NULL)->orderBy('name', 'ASC')->get();
        $attribute_id = $view_post->attributes;
        $attributes_id = attribute::where('id',$attribute_id)->first();
        // dd($attributes_id);
        $condition = Condition::where('deleted_at', '=', NULL)->orderBy('name', 'ASC')->get();
        $ship_mode = ShipMode::where('deleted_at', '=', NULL)->orderBy('name', 'ASC')->get();
        $stores = Store::where('deleted_at', '=', NULL)->get();
        $city = City::orderBy('name', 'ASC')->get();
        $delivery_type = DeliveryType::get();
        return view('frontend.users.post_items.edit', compact('delivery_type','quantityArray','view_post', 'view_post_image','category','city', 'sub_category', 'brands', 'condition', 'ship_mode', 'stores','attributes_id'));
    }

    public function update(Request $request)
    {
        $view_post = Item::where('id', $request->id)->where('status','=','1')->first();

        if($request->stock_plus_or_minus == 'plus'){
            $stock_plus_or_minus = 1;
        }else{
            $stock_plus_or_minus = 2;
        }
        $post_image = $view_post->id;

        $view_post->sku= $request->sku;
        $view_post->what_are_you_selling= $request->what_are_you_selling;
        $view_post->describe_your_items = $request->describe_your_items;
        $view_post->category_id         = $request->category_id;
        $view_post->sub_category_id     = $request->subcat_id;
        $view_post->brand_id            = $request->brand_id;
        $view_post->condition_id        = $request->condition_id;
        // $view_post->ship_mode_id        = $request->ship_mode_id;
        $view_post->width               = $request->width;
        $view_post->length              = $request->length;
        $view_post->height              = $request->height;
        $view_post->weight              = $request->weight;
        if($request->stock_plus_or_minus == 'plus'){
            $view_post->quantity += $request->quantity;
        }else{
            $view_post->quantity -= $request->quantity;
        }
        $view_post->stock_plus_or_minus = $stock_plus_or_minus;
        $view_post->address             = $request->address;
        $view_post->latitude            = $request->lat;
        $view_post->longitude           = $request->lng;
        $view_post->pay_shipping        = $request->pay_shipping;
        $view_post->price_type          = $request->price_type;
        $view_post->delivery_type       = $request->delivery_type;
        $view_post->price               = $request->price;
        $view_post->save();

        $view_post_image = ItemsImages::where('item_id', $post_image)->first();
        if ($request->hasFile('item_picture1')) 
        {
            $item_picture1 = $request->file('item_picture1');
            $name = time().'.'.$item_picture1->getClientOriginalExtension();
            $destinationPath = public_path('/assets/post');
            $item_picture1->move($destinationPath, $name);
            $view_post_image->item_picture1 = $name;
        }
        if ($request->hasFile('item_picture2')) 
        {
            $item_picture2 = $request->file('item_picture2');
            $name = time().'.'.$item_picture2->getClientOriginalExtension();
            $destinationPath = public_path('/assets/post');
            $item_picture2->move($destinationPath, $name);
            $view_post_image->item_picture2 = $name;
        }
        if ($request->hasFile('item_picture3')) 
        {
            $item_picture3 = $request->file('item_picture3');
            $name = time().'.'.$item_picture3->getClientOriginalExtension();
            $destinationPath = public_path('/assets/post');
            $item_picture3->move($destinationPath, $name);
            $view_post_image->item_picture3 = $name;
        }
        if ($request->hasFile('item_picture4')) 
        {
            $item_picture4 = $request->file('item_picture4');
            $name = time().'.'.$item_picture4->getClientOriginalExtension();
            $destinationPath = public_path('/assets/post');
            $item_picture4->move($destinationPath, $name);
            $view_post_image->item_picture4 = $name;
        }
        if ($request->hasFile('item_picture5')) 
        {
            $item_picture5 = $request->file('item_picture5');
            $name = time().'.'.$item_picture5->getClientOriginalExtension();
            $destinationPath = public_path('/assets/post');
            $item_picture5->move($destinationPath, $name);
            $view_post_image->item_picture5 = $name;
        }
        if ($request->hasFile('item_picture6')) 
        {
            $item_picture6 = $request->file('item_picture6');
            $name = time().'.'.$item_picture6->getClientOriginalExtension();
            $destinationPath = public_path('/assets/post');
            $item_picture6->move($destinationPath, $name);
            $view_post_image->item_picture6 = $name;
        }
        $view_post_image->save();

        $storeInventory = Inventory::where('item_id', $post_image)->first();

        if($request->stock_plus_or_minus == 'plus'){
            $storeInventory->total_stock = $view_post->quantity;
            $storeInventory->stock_out = FALSE;
            $storeInventory->stock_remaining = $view_post->quantity;
        }else{
            $storeInventory->total_stock = $storeInventory->total_stock;
            $storeInventory->stock_out = $request->quantity;
            $remianig =    $storeInventory->total_stock - $request->quantity;
            $storeInventory->stock_remaining = $remianig;
        }
        $storeInventory->save();

        $storeStock = new stock;
        $storeStock->user_id            = Auth::User()->id;
        $storeStock->item_id            = $view_post->id;
        $storeStock->quantity           = $request->quantity;
        $storeStock->item_upload_status = 'single';

        if($request->stock_plus_or_minus == 'plus'){
            $storeStock->stock_status = TRUE;
        }else{
            $storeStock->stock_status = FALSE;
        }
        $storeStock->save();
        
        return redirect()->route('frontend.users.profile.index')->with('success', __('Post Updated Successfull'));
    }
}
