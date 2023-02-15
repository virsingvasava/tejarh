<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ExportProduct;
use App\Http\Controllers\Controller;
use App\Imports\ImportProduct;
use App\Imports\ImportProductCollection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\ValidationException;
use App\Models\Product;
use App\Models\Item;
use App\Models\ItemPostImage;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Condition;
use App\Models\ShipMode;
use App\Imports\ProductImport;
use App\Models\attribute;
use App\Models\attribute_variant;
use App\Models\AttributeVariant;
use App\Models\BoostItem;
use App\Models\ItemsAttributeVariants;
use App\Models\Cart;
use App\Models\DeliveryType;
use App\Models\HoldAnOffer;
use App\Models\ItemsImages;
use App\Models\MakeAnOffer;
use App\Models\Orders;
use App\Models\User;
use App\Models\UserLike;
use App\Models\Wishlist;
use File;
use Illuminate\Support\Facades\Auth;
use Lang;

class ProductController extends Controller
{

    

    public function index()
    {
        $products = Item::with('itemImage')->orderBy('id','DESC')->get();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $category = Category::get();
        $sub_category = SubCategory::get();
        $brand = Brand::get();
        $condition = Condition::get();
        $ship_mode = ShipMode::get();
        $attribute = attribute::get();
       

        $delivey_type = DeliveryType::get();
        return view('admin.product.create', compact('category', 'sub_category', 'brand','attribute', 'condition', 'ship_mode','delivey_type'));
    }

    public function store(Request $request)
    {
        $product = new Item;
        $product->user_id               = Auth::user()->id;
        $product->category_id           = $request->category_id;
        $product->sub_category_id       = $request->sub_category_id;
        $product->brand_id              = $request->brand_id;
        $product->condition_id          = $request->condition_id;
        $product->what_are_you_selling  = $request->what_are_you_selling;
        $product->describe_your_items   = $request->describe_your_items;
        $product->weight                = $request->weight;
        $product->width                 = $request->width;
        $product->length                = $request->length;
        $product->height                = $request->height;
        $product->quantity              = $request->quantity;
        $product->address               = $request->address;
        $product->latitude              = $request->lat;
        $product->longitude             = $request->lng;
        // $product->ship_mode_id          = $request->ship_mode_id;
        $product->pay_shipping          = $request->pay_shipping;
        $product->delivery_type         = $request->delivery_type;
        $product->price_type            = $request->price_type;
        $product->price                 = $request->price;
        $product->status                = $request->status;
        $product->attributes            = $request->attribute_id;
        $product->choice_options        = json_encode($request->attribute_variant_id);
        $product->save();

        $productImage = new ItemsImages();
        $productImage->user_id  = Auth::user()->id;
        $productImage->item_id   = $product->id;
        if ($request->hasFile('item_picture1')) {
            $item_picture1 = $request->file('item_picture1');
            $name = time() . '.' . $item_picture1->getClientOriginalExtension();
            $destinationPath = public_path('/assets/post');
            $item_picture1->move($destinationPath, $name);
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $productImage->item_picture1 = $name;
        }

        if ($request->hasFile('item_picture2')) {
            $item_picture2 = $request->file('item_picture2');
            $name = time() . '.' . $item_picture2->getClientOriginalExtension();
            $destinationPath = public_path('/assets/post');
            $item_picture2->move($destinationPath, $name);
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $productImage->item_picture2 = $name;
        }

        if ($request->hasFile('item_picture3')) {
            $item_picture3 = $request->file('item_picture3');
            $name = time() . '.' . $item_picture3->getClientOriginalExtension();
            $destinationPath = public_path('/assets/post');
            $item_picture3->move($destinationPath, $name);
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $productImage->item_picture3 = $name;
        }

        if ($request->hasFile('item_picture4')) {
            $item_picture4 = $request->file('item_picture4');
            $name = time() . '.' . $item_picture4->getClientOriginalExtension();
            $destinationPath = public_path('/assets/post');
            $item_picture4->move($destinationPath, $name);
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $productImage->item_picture4 = $name;
        }

        if ($request->hasFile('picture5')) {
            $picture5 = $request->file('picture5');
            $name = time() . '.' . $picture5->getClientOriginalExtension();
            $destinationPath = public_path('/assets/post');
            $picture5->move($destinationPath, $name);
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $productImage->product_picture5 = $name;
        }

        if ($request->hasFile('item_picture6')) {
            $item_picture6 = $request->file('item_picture6');
            $name = time() . '.' . $item_picture6->getClientOriginalExtension();
            $destinationPath = public_path('/assets/post');
            $item_picture6->move($destinationPath, $name);
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $productImage->item_picture6 = $name;
        }
        $productImage->status  = $request->status;
        $productImage->save();

        return redirect()->route('admin.product.index')->with('success', __('messages.product.success.product_added_successfully'));
    }

    public function view($id)
    {
        $id = base64_decode($id);
        $view_products = Item::with('itemImage')->where('id', $id)->first();
        $view_user = User::where('id', $view_products->user_id)->first();
        $view_category = Category::where('id', $view_products->category_id)->first();
        $view_sub_category = SubCategory::where('id', $view_products->sub_category_id)->first();
        $view_brand = Brand::where('id', $view_products->brand_id)->first();
        $view_condition = Condition::where('id', $view_products->condition_id)->first();
        // $view_ship_mode = ShipMode::where('id', $view_products->ship_mode_id)->first();
        $view_delivey_type = DeliveryType::where('id', $view_products->delivery_type)->first();
        return view('admin.product.view', compact(
            'view_products',
            'view_category',
            'view_user',
            'view_sub_category',
            'view_brand',
            'view_condition',
            'view_delivey_type'
        ));
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $quantityArray = config('setting.quantityArray');
        $edit_products = Item::where('id', $id)->first();
        $edit_products_image1 = ItemsImages::where('item_id', $edit_products->id)->first();
        if ($edit_products_image1['item_id'] = $edit_products->id) {
            $edit_products_image = ItemsImages::where('item_id', $edit_products->id)->first();
        }
        $category = Category::get();
        $sub_category = SubCategory::get();
        $brand = Brand::get();
        $condition = Condition::get();
        $ship_mode = ShipMode::get();
        $delivey_type = DeliveryType::get();
        return view('admin.product.edit', compact('delivey_type','quantityArray', 'edit_products', 'category', 'sub_category', 'brand', 'condition', 'ship_mode', 'edit_products_image'));
    }

    public function update(Request $request)
    {
        $products_update = Item::where('id', $request->id)->first();
        $post_id                               = $products_update->id;
        $user_id                               = $products_update->user_id;
        $products_update->what_are_you_selling = $request->what_are_you_selling;
        $products_update->describe_your_items  = $request->describe_your_items;
        $products_update->category_id          = $request->category_id;
        $products_update->sub_category_id      = $request->sub_category_id;
        $products_update->brand_id             = $request->brand_id;
        $products_update->condition_id         = $request->condition_id;
        $products_update->weight               = $request->weight;
        $products_update->width                = $request->width;
        $products_update->length               = $request->length;
        $products_update->height               = $request->height;
        $products_update->quantity             = $request->quantity;
        $products_update->address              = $request->ship_from;
        $products_update->latitude             = $request->lat;
        $products_update->longitude            = $request->lng;
        // $products_update->ship_mode_id         = $request->ship_mode_id;
        $products_update->pay_shipping         = $request->pay_shipping;
        $products_update->price_type           = $request->price_type;
        $products_update->price                = $request->price;
        $products_update->delivery_type        = $request->delivery_type;
        $products_update->status               = $request->status;
        $products_update->save();

        $image_update = ItemsImages::where('item_id', $products_update->id)->first();
        if (!empty($image_update)) {
            $view_post_image = ItemsImages::where('item_id', $products_update->id)->first();
            if ($request->hasFile('item_picture1')) {
                $item_picture1 = $request->file('item_picture1');
                $name = time() . '.' . $item_picture1->getClientOriginalExtension();
                $destinationPath = public_path('/assets/post');
                $item_picture1->move($destinationPath, $name);
                $view_post_image->item_picture1 = $name;
            }
            if ($request->hasFile('item_picture2')) {
                $item_picture2 = $request->file('item_picture2');
                $name = time() . '.' . $item_picture2->getClientOriginalExtension();
                $destinationPath = public_path('/assets/post');
                $item_picture2->move($destinationPath, $name);
                $view_post_image->item_picture2 = $name;
            }
            if ($request->hasFile('item_picture3')) {
                $item_picture3 = $request->file('item_picture3');
                $name = time() . '.' . $item_picture3->getClientOriginalExtension();
                $destinationPath = public_path('/assets/post');
                $item_picture3->move($destinationPath, $name);
                $view_post_image->item_picture3 = $name;
            }
            if ($request->hasFile('item_picture4')) {
                $item_picture4 = $request->file('item_picture4');
                $name = time() . '.' . $item_picture4->getClientOriginalExtension();
                $destinationPath = public_path('/assets/post');
                $item_picture4->move($destinationPath, $name);
                $view_post_image->item_picture4 = $name;
            }
            if ($request->hasFile('item_picture5')) {
                $item_picture5 = $request->file('item_picture5');
                $name = time() . '.' . $item_picture5->getClientOriginalExtension();
                $destinationPath = public_path('/assets/post');
                $item_picture5->move($destinationPath, $name);
                $view_post_image->item_picture5 = $name;
            }
            if ($request->hasFile('item_picture6')) {
                $item_picture6 = $request->file('item_picture6');
                $name = time() . '.' . $item_picture6->getClientOriginalExtension();
                $destinationPath = public_path('/assets/post');
                $item_picture6->move($destinationPath, $name);
                $view_post_image->item_picture6 = $name;
            }
        } else {
            $view_post_image = new ItemsImages;
            $view_post_image->user_id = $user_id;
            $view_post_image->item_id  = $post_id;
            if ($request->hasFile('item_picture1')) {
                $item_picture1 = $request->file('item_picture1');
                $name = time() . '.' . $item_picture1->getClientOriginalExtension();
                $destinationPath = public_path('/assets/post');
                $item_picture1->move($destinationPath, $name);
                $view_post_image->item_picture1 = $name;
            }
            if ($request->hasFile('item_picture2')) {
                $item_picture2 = $request->file('item_picture2');
                $name = time() . '.' . $item_picture2->getClientOriginalExtension();
                $destinationPath = public_path('/assets/post');
                $item_picture2->move($destinationPath, $name);
                $view_post_image->item_picture2 = $name;
            }
            if ($request->hasFile('item_picture3')) {
                $item_picture3 = $request->file('item_picture3');
                $name = time() . '.' . $item_picture3->getClientOriginalExtension();
                $destinationPath = public_path('/assets/post');
                $item_picture3->move($destinationPath, $name);
                $view_post_image->item_picture3 = $name;
            }
            if ($request->hasFile('item_picture4')) {
                $item_picture4 = $request->file('item_picture4');
                $name = time() . '.' . $item_picture4->getClientOriginalExtension();
                $destinationPath = public_path('/assets/post');
                $item_picture4->move($destinationPath, $name);
                $view_post_image->item_picture4 = $name;
            }
            if ($request->hasFile('item_picture5')) {
                $item_picture5 = $request->file('item_picture5');
                $name = time() . '.' . $item_picture5->getClientOriginalExtension();
                $destinationPath = public_path('/assets/post');
                $item_picture5->move($destinationPath, $name);
                $view_post_image->item_picture5 = $name;
            }
            if ($request->hasFile('item_picture6')) {
                $item_picture6 = $request->file('item_picture6');
                $name = time() . '.' . $item_picture6->getClientOriginalExtension();
                $destinationPath = public_path('/assets/post');
                $item_picture6->move($destinationPath, $name);
                $view_post_image->item_picture6 = $name;
            }
        }

        $view_post_image->save();

        return redirect()->route('admin.product.index')->with('success', __('messages.product.success.product_updated_successfully'));
    }

    public function destroy(Request $request)
    {
        $id = $request->product_id;
        ItemsImages::where('item_id', $id)->delete();
        BoostItem::where('item_id', $id)->delete();
        Cart::where('item_id',$id)->delete();
        HoldAnOffer::where('item_id',$id)->delete();
        MakeAnOffer::where('item_id',$id)->delete();
        Orders::where('item_id',$id)->delete();
        UserLike::where('item_id',$id)->delete();
        Wishlist::where('item_id',$id)->delete();
        Item::where('id', $id)->where('status', '=', '1')->delete();
        return redirect()->route('admin.product.index')->with('success', __('messages.product.success.product_deleted_successfully'));
    }

    /* Product make active and In active */
    public function product_status_update(Request $request)
    {
        $status_update = Item::where('id', $request->product_id)->first();
        $status_update->status = $request->status;
        $status_update->save();
        return redirect()->route('admin.product.index')->with('success', __('messages.product.success.status_updated_successfully'));
    }


    /* Sub Category Listing */
    public function sub_category_listing(Request $request)
    {
        $subCategory = SubCategory::where('category_id', $request->category_id)->get();
        return $subCategory;
    }

    /* Sub Brand Listing */
    public function brand_listing(Request $request)
    {
        $brand = Brand::where('sub_category_id', $request->sub_category_id)->get();
        return $brand;
    }

    public function attribute_listing(Request $request)
    {
        $attribute = attribute::where('sub_category_id',$request->sub_category_id)->get();
        return $attribute;
    }

    public function attribute_variant_listing(Request $request)
    {
        $attribute_variant = AttributeVariant::where('attribute_id',$request->attribute_id)->get();
        return $attribute_variant;
    }

    /* Sub Brand Listing */
    public function condition_listing(Request $request)
    {
        $condition = Condition::where('brand_id', $request->brand_id)->get();
        return $condition;
    }

    public function export()
    {
        $response = Excel::download(new ExportProduct, 'products.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        ob_end_clean();
        return $response;
    }

    public function import(Request $request)
    {
        Excel::import(new ImportProduct, $request->file('import_products')->store('temp'));
        return redirect()->back()->with('success', 'Product imported successfully');
 
    }
}