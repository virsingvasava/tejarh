<?php

namespace App\Http\Controllers\Frontend\Business;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use App\Models\attribute;
use App\Models\BoostItem;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\ItemsImages;
use App\Models\SubCategory;
use App\Models\Condition;
use App\Models\ShipMode;
use App\Models\Category;
use App\Models\Store;
use App\Models\Brand;
use App\Models\City;
use App\Models\Commission;
use App\Models\DeliveryType;
use App\Models\Inventory;
use App\Models\Item;
use App\Models\ItemsAttributeVariants;
use Illuminate\Support\Facades\Auth;
use File;
use Lang;
use App\Models\Orders;
use App\Models\stock;
use Illuminate\Support\Facades\DB;

// use App\Http\Requests\BusinessItemAnPost as ServerSideValidation;

class ItemPostController extends Controller
{
  
    public function index(Request $request){
        $userId = Auth::user()->id;
        $category = Category::where('deleted_at','=',NULL)->orderBy('category_name', 'ASC')->get();
        $sub_category = SubCategory::where('deleted_at','=',NULL)->orderBy('sub_cate_name', 'ASC')->get();
        $brands = Brand::where('deleted_at','=',NULL)->orderBy('name', 'ASC')->get();
        $condition = Condition::where('deleted_at','=',NULL)->orderBy('name', 'ASC')->get();
        $ship_mode = ShipMode::where('deleted_at','=',NULL)->orderBy('name', 'ASC')->get();
        $stores = Store::where('user_id',$userId)->where('deleted_at','=',NULL)->get();
        $city = City::orderBy('name', 'ASC')->get();
        $delivery_type = DeliveryType::get();
        $commission_data = Commission::where('type','commission_user')->first();
        if(!empty($commission_data)){
            $commission_user = $commission_data->name;            
        }
        return view('frontend.business.pages.items.create', compact('commission_user','delivery_type','category', 'sub_category', 'brands', 'condition', 'ship_mode', 'stores','city'));

    }

    public function store(Request $request)
    {
       // p($request->all());
        $user = Auth::User();
        $sku_generate = random_int(100000, 999999);
        $sku_generate = 'SKU-'.$sku_generate;
        
        $items_add = new Item;
        if($user->role == BUSINESS_ROLE) {
            $items_add->user_id  = $user->id;
            $items_add->business_id  = $user->id;
        }
        elseif($user->role == STORE_ROLE)
        {
            $items_add->user_id  = $user->id;
            $items_add->business_id  = $user->business_id;
        }
        $items_add->what_are_you_selling  = $request->item_description;
        $items_add->describe_your_items  = $request->describe_your_items;
        $items_add->category_id  = $request->category_id;
        $items_add->sub_category_id  = $request->subcat_id;
        $items_add->brand_id  = $request->brand_id;
        $items_add->condition_id  = $request->condition_id;
        $getStore = Store::where('user_id',$user->id)->first();
        if($user->role == STORE_ROLE)
        {
            $items_add->store_id  = $getStore->id;
        }
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
        $items_add->pay_shipping  = $request->pay_for_shipping;
        $items_add->price_type  = $request->price_type;
        $items_add->price  = $request->total_amount;
        $items_add->total_amount  = $request->pricing;
        $items_add->commission_charge  = $request->commission_charge;
        $items_add->sku  = 'Sku-'.$request->sku;
        $items_add->status = TRUE;
        $items_add->attributes = $request->attribute_id;
        $items_add->choice_options = $request->attribute_variants_id;
        // dd($items_add);
        $items_add->save();
        
        $item_image = new ItemsImages;
        $item_image->user_id  = Auth::User()->id;
        $item_image->item_id  = $items_add->id;
       
        if ($request->hasFile('item_picture1')) 
        {
            $picture1 = $request->file('item_picture1');
            $name = 'item_picture1_' . time().'.'.$picture1->getClientOriginalExtension();
            $destinationPath = public_path(BUSINESS_ITEMS_POST_FOLDER);
            $picture1->move($destinationPath, $name);
            if (!File::isDirectory($destinationPath)){
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $item_image->item_picture1 = $name;
        }

        if ($request->hasFile('item_picture2')) 
        {
            $picture2 = $request->file('item_picture2');
            $name = 'item_picture2_' . time().'.'.$picture2->getClientOriginalExtension();
            $destinationPath = public_path(BUSINESS_ITEMS_POST_FOLDER);
            $picture2->move($destinationPath, $name);
            if (!File::isDirectory($destinationPath)){
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $item_image->item_picture2 = $name;
        }

        if ($request->hasFile('item_picture3')) 
        {
            $picture3 = $request->file('item_picture3');
            $name = 'item_picture3_' . time().'.'.$picture3->getClientOriginalExtension();
            $destinationPath = public_path(BUSINESS_ITEMS_POST_FOLDER);
            $picture3->move($destinationPath, $name);
            if (!File::isDirectory($destinationPath)){
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $item_image->item_picture3 = $name;
        }

        if ($request->hasFile('item_picture4')) 
        {
            $picture4 = $request->file('item_picture4');
            $name = 'item_picture4_' . time().'.'.$picture4->getClientOriginalExtension();
            $destinationPath = public_path(BUSINESS_ITEMS_POST_FOLDER);
            $picture4->move($destinationPath, $name);
            if (!File::isDirectory($destinationPath)){
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $item_image->item_picture4 = $name;
        }

        if ($request->hasFile('item_picture5')) 
        {
            $picture5 = $request->file('item_picture5');
            $name = 'item_picture5' . time().'.'.$picture5->getClientOriginalExtension();
            $destinationPath = public_path(BUSINESS_ITEMS_POST_FOLDER);
            $picture5->move($destinationPath, $name);
            if (!File::isDirectory($destinationPath)){
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $item_image->item_picture5 = $name;
        }

        if ($request->hasFile('item_picture6')) 
        {
            $picture6 = $request->file('item_picture6');
            $name = 'item_picture6' . time().'.'.$picture6->getClientOriginalExtension();
            $destinationPath = public_path(BUSINESS_ITEMS_POST_FOLDER);
            $picture6->move($destinationPath, $name);
            if (!File::isDirectory($destinationPath)){
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $item_image->item_picture6 = $name;
        }
        $item_image->status  = true;
        $item_image->save();

        $storeInventory = new Inventory;
        $storeInventory->user_id = Auth::User()->id;
        $storeInventory->store_id = $items_add->store_id;
        $storeInventory->item_id = $items_add->id;
        $storeInventory->total_stock = $items_add->quantity;
        $storeInventory->stock_remaining = $items_add->quantity;
        $storeInventory->save();

        $storeStock = new stock;
        $storeStock->user_id            = Auth::User()->id;
        $storeStock->item_id            = $items_add->id;
        $storeStock->store_id           = $items_add->store_id;
        $storeStock->quantity           = $items_add->quantity;
        $storeStock->item_upload_status = 'single';
        $storeStock->stock_status       = TRUE;
        $storeStock->save();

        return redirect()->route('frontend.business.home.index')->with('success', __('messages.product.success.product_added_successfully'));
    }

    public function getSubCat(Request $request)
    {
        if (\App::isLocale('en')) {
            $subCategory = SubCategory::where('category_id', $request->categoryId)->pluck("sub_cate_name", "id");
            return json_encode($subCategory);
        } else {
            $subCategory = SubCategory::where('category_id', $request->categoryId)->pluck("ar_sub_cate_name", "id");
            return json_encode($subCategory);
        }
    }

    public function getBrand(Request $request)
    {
        if (\App::isLocale('en')) {
            $brand = Brand::where('sub_category_id',$request->subCategoryId)->pluck("name", "id");
            return json_encode($brand);
        } else {
            $brand = Brand::where('sub_category_id',$request->subCategoryId)->pluck("ar_name", "id");
            return json_encode($brand);
        }
    }

    public function getAttribute(Request $request)
    {
        $attribute = attribute::where('sub_category_id',$request->subCategoryId)->pluck("name","id");
        return json_encode($attribute);
    }

    public function getAttributevariants(Request $request)
    {
        $variants = DB::table('attribute_variants')
        ->where('attribute_id',$request->attribute_id)->pluck("name","id");
        return json_encode($variants);
    }

    public function items_details(Request $Request)
    {     
        $itemsList = Item::where(['id' => $id, 'deleted_at' => NULL])
        ->where('status','=','1')
        ->orderBy('created_at','DESC')
        ->get()
        ->toArray();

        $itemArray = [];
        foreach($itemsList as $key => $value)
        {
            $itemArray[$key] = $value;
            $itemsImage = ItemsImages::where('item_id',$value['id'])->first();
            $itemArray[$key]['item_pictures'] = $itemsImage;

            $condition = Condition::where('id',$value['condition_id'])->first();
            $itemArray[$key]['condition'] = $condition;

            $brand = Brand::where('id',$value['brand_id'])->first();
            $itemArray[$key]['brand'] = $brand;

            $store = Store::where('id',$value['store_id'])->first();
            $itemArray[$key]['store'] = $store;

            $boostItem = BoostItem::where('item_id',$value['id'])->where('is_paid','1')->first();
            $itemArray[$key]['boostItem'] = $boostItem;
        }
        return view('frontend.business.pages.product_details', compact('itemArray'));
    }

    public function edit($id)
    {
        $quantityArray = config('setting.quantityArray');
        $view_post = Item::where('id', $id)->first();
        $post_image = $view_post->id;
        $view_post_image = ItemsImages::where('item_id', $post_image)->first();
        $category = Category::where('deleted_at','=',NULL)->orderBy('category_name', 'ASC')->get();
        $sub_category = SubCategory::where('deleted_at','=',NULL)->orderBy('sub_cate_name', 'ASC')->get();
        $brands = Brand::where('deleted_at','=',NULL)->orderBy('name', 'ASC')->get();
        $condition = Condition::where('deleted_at','=',NULL)->orderBy('name', 'ASC')->get();
        $ship_mode = ShipMode::where('deleted_at','=',NULL)->orderBy('name', 'ASC')->get();
        $stores = Store::where('deleted_at','=',NULL)->get();
        $city = City::orderBy('name', 'ASC')->get();
        $delivery_type = DeliveryType::get();
        return view('frontend.business.pages.items.edit', compact('delivery_type','quantityArray','view_post', 'view_post_image','category', 'sub_category','city', 'brands', 'condition', 'ship_mode', 'stores'));
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
        $view_post->store_id            = $request->store_id;
        $view_post->weight              = $request->weight;
        $view_post->width               = $request->width;
        $view_post->length              = $request->length;
        $view_post->height              = $request->height;
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
        $view_post->delivery_type       = $request->delivery_type;
        $view_post->price_type          = $request->price_type;
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
        $storeStock->store_id           = $request->store_id;
        $storeStock->quantity           = $request->quantity;
        $storeStock->item_upload_status = 'single';

        if($request->stock_plus_or_minus == 'plus'){
            $storeStock->stock_status = TRUE;
        }else{
            $storeStock->stock_status = FALSE;
        }
        $storeStock->save();

        return redirect()->route('frontend.business.business-profile.index')->with('success', __('Post Updated Successfull'));
    }
    
}
