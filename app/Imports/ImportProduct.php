<?php

namespace App\Imports;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Condition;
use App\Models\DeliveryType;
use App\Models\Item;
use App\Models\ItemsImages;
use App\Models\ShipMode;
use App\Models\stock;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportProduct implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $user         = Auth::id();
        $category     = Category::where('category_name', $row['category_name'])->first();
        $category_id  = $category->id;
        if (empty($category)) {
            return null;
        }
        $sub_category = SubCategory::where('sub_cate_name', $row['sub_category_name'])->first();
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
        // $ship_modes   = ShipMode::where('name', $row['ship_mode'])->first();
        // $ship_modes_id = $ship_modes->id;
        // if (empty($ship_modes)) {
        //     return null;
        // }
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
                'address' => $row['address'],
                'latitude' => $row['latitude'],
                'longitude' => $row['longitude'],
                'pay_shipping' => $return,
                'price_type' => $return_price,
                'delivery_type' => $delivery_type_id,
                'price' => $row['price'],
                'condition_id' => $conditions_id,
                'sku' => $row['sku'],
                //'delivery_type' => $row['delivery_type'],
                'status' => $return,
                'item_upload_status' => $return,
            ]);
            // dd($item);
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
            //dd($item);
            return $items;
        
    }
}
