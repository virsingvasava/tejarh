<?php

namespace App\Http\Controllers\Frontend\Users;

use App\Exports\SampleBulkProduct;
use App\Http\Controllers\Controller;
use App\Imports\ContactsImport;
use App\Imports\ImportBulkProduct;
use App\Imports\ImportProduct;
use App\Models\csv_data;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\CsvImportRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Commission;
use App\Models\Condition;
use App\Models\DeliveryType;
use App\Models\Inventory;
use App\Models\Item;
use App\Models\ItemsImages;
use App\Models\stock;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\HeadingRowImport;

class ProductBulkController extends Controller
{
    public function parseImport(Request $request)
    {
        if ($request->has('header')) {
            $headings = (new HeadingRowImport)->toArray($request->file('csv_file'));
            $data = Excel::toArray(new ImportProduct, $request->file('csv_file'))[0];
        } else {
            $data = array_map('str_getcsv', file($request->file('csv_file')->getRealPath()));
        }
        $userId = Auth::user()->id;
        if (count($data) > 0) {
            $csv_data = array_slice($data, 0);
            $csv_data_file = csv_data::create([
                'user_id' => $userId,
                'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
                'csv_header' => $request->has('header'),
                'csv_data' => json_encode($data)
            ]);
        } else {
            return redirect()->back();
        }

        return view('frontend.users.pages.importproduct.index', [
            'headings' => $headings ?? null,
            'csv_data' => $csv_data,
            'csv_data_file' => $csv_data_file
        ]);
    }
    public function sampleExport(Request $request)
    {
        $response = Excel::download(new SampleBulkProduct, 'import_products.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        ob_end_clean();
        return $response;
    }
    public function import(Request $request)
    {
        $data = csv_data::find($request->csv_data_file_id);
        $csv_data = json_decode($data->csv_data, true);

        $user         = Auth::User()->id;
        foreach ($csv_data as $row) {

            $category     = Category::where('category_name', $row['category_name'])->first();
            $category_id  = $category->id;

            if (empty($category)) {
                return null;
            }
            $sub_category = SubCategory::where('sub_cate_name', $row['sub_category_name'])->first();
            //dd($sub_category);
            $sub_category_id = $sub_category->id;
            if (empty($sub_category)) {
                return null;
            }
            $brand  = Brand::where('name', $row['brand_name'])->first();
            $brand_id = $brand->id;
            if (empty($brand)) {
                return null;
            }

            $deliveryType  = DeliveryType::where('name', $row['delivery_type'])->first();
            $delivery_type_id = $deliveryType->id;
            if (empty($deliveryType)) {
                return null;
            }

            $conditions   = Condition::where('name', $row['condition'])->first();
            $conditions_id = $conditions->id;
            if (empty($conditions)) {
                return null;
            }
            if ($row['pay_shipping'] === 'The buyer') {
                $return = 0;
            } elseif ($row['pay_shipping'] === 'I will pay') {
                $return = 1;
            } else {
                $return = 2;
            }

            if ($row['price_type'] === 'Fixed Price') {
                $return_price = 0;
            } else {
                $return_price = 1;
            }

            if ($row['stock_plus_or_minus'] == 'plus') {
                $stock_plus_or_minus = 1;
            } else {
                $stock_plus_or_minus = 2;
            }
            $commission_data = Commission::where('type', 'commission_user')->first();
            if (!empty($commission_data)) {
                $commission_user = $commission_data->name;
            }
            $item_pro = Item::where('user_id', $user)->where('sku', $row['sku'])->first();
            $commisionPrice = ($row['price']/100) * $commission_user;
            $totalPrice = $row['price'] - $commisionPrice;
            // dd($item_pro);
            if ($item_pro) {

                $item_pro->category_id = $category_id;
                $item_pro->sub_category_id = $sub_category_id;
                $item_pro->brand_id = $brand_id;
                $item_pro->what_are_you_selling = $row['what_are_you_selling'];
                $item_pro->describe_your_items = $row['describe_your_items'];
                $item_pro->weight = $row['weight'];
                $item_pro->length = $row['length'];
                $item_pro->height = $row['height'];
                if ($row['stock_plus_or_minus'] == 'plus') {
                    $item_pro->quantity += $row['quantity'];
                } else {
                    $item_pro->quantity -= $row['quantity'];
                }
                $item_pro->stock_plus_or_minus = $stock_plus_or_minus;
                $item_pro->address = $row['address'];
                $item_pro->latitude = $row['latitude'];
                $item_pro->longitude = $row['longitude'];
                $item_pro->pay_shipping = $return;
                $item_pro->price_type = $return_price;
                $item_pro->delivery_type = $delivery_type_id;
                $item_pro->price = $totalPrice;
                $item_pro->commission_charge = $commission_user;
                $item_pro->total_amount = $row['price'];
                $item_pro->condition_id = $conditions_id;
                $item_pro->save();
                //dd($item_pro);
                $itemId = $item_pro->id;
                // dd($itemId);
                $Inventory = Inventory::where('item_id', $itemId)->first();
                if ($row['stock_plus_or_minus'] == 'plus') {
                    $Inventory->total_stock = $item_pro->quantity;
                    $Inventory->stock_out = FALSE;
                    $Inventory->stock_remaining = $item_pro->quantity;
                } else {
                    $Inventory->total_stock = $Inventory->total_stock;
                    $Inventory->stock_out = $row['quantity'];
                    $remianig =    $Inventory->total_stock -  $row['quantity'];
                    $Inventory->stock_remaining = $remianig;
                }

                $Inventory->save();

                $storeStock = new stock;
                $storeStock->user_id = Auth::User()->id;
                $storeStock->item_id =  $itemId;
                $storeStock->quantity = $row['quantity'];
                $storeStock->item_upload_status = 'CSV_file';
                if ($row['stock_plus_or_minus'] == 'plus') {
                    $storeStock->stock_status = TRUE;
                } else {
                    $storeStock->stock_status = FALSE;
                }
                $storeStock->save();
            } else {

                $commisionPrice = ($row['price']/100) * $commission_user;
                $totalPrice = $row['price'] - $commisionPrice;

                $item = new Item([
                    'user_id' => $user,
                    'category_id' =>  $category_id,
                    'sub_category_id' => $sub_category_id,
                    'brand_id' => $brand_id,
                    'what_are_you_selling' => $row['what_are_you_selling'],
                    'describe_your_items' => $row['describe_your_items'],
                    'weight' => $row['weight'],
                    'width' => $row['width'],
                    'length' => $row['length'],
                    'height' => $row['height'],
                    'quantity' => $row['quantity'],
                    'stock_plus_or_minus' => TRUE,
                    'address' => $row['address'],
                    'latitude' => $row['latitude'],
                    'longitude' => $row['longitude'],
                    'pay_shipping' => $return,
                    'price_type' => $return_price,
                    'delivery_type' => $delivery_type_id,
                    'price' => $totalPrice,
                    'commission_charge' => $commission_user,
                    'total_amount' => $row['price'],
                    'condition_id' => $conditions_id,
                    'sku' =>  'Sku-' . $row['sku'],
                    'status' => TRUE,
                    'item_upload_status' => $return,
                ]);
                $item->save();
                $itemList = Item::where('user_id', $user)->get();
                foreach ($itemList as $item) {
                    $itemId = $item->id;
                }
                $items = new ItemsImages([
                    'user_id' => $user,
                    'item_id' => $itemId,
                    'item_picture1' => $row['picture_1'],
                    'item_picture2' => $row['picture_2'],
                    'item_picture3' => $row['picture_3'],
                    'item_picture4' => $row['picture_4'],
                    'item_picture5' => $row['picture_5'],
                    'item_picture6' => $row['picture_6'],
                ]);
                $items->save();

                $storeInventory = new Inventory;
                $storeInventory->user_id = Auth::User()->id;
                $storeInventory->item_id = $itemId;
                $storeInventory->total_stock = $item->quantity;
                $storeInventory->stock_remaining = $item->quantity;

                $storeInventory->save();

                $storeStock = new stock;
                $storeStock->user_id = Auth::User()->id;
                $storeStock->item_id =  $itemId;
                $storeStock->quantity = $item->quantity;
                $storeStock->item_upload_status = 'CSV_file';
                $storeStock->stock_status = TRUE;
                $storeStock->save();
            }
        }
        return redirect()->route('frontend.users.my-items.index')->with('success', __('Product imported successfully'));
    }
}
