<?php

namespace App\Imports;

use App\Models\Item;
use App\Models\ItemsImages;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Condition;
use App\Models\ShipMode;
use App\Models\SubCategory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportProductCollection implements ToCollection,WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        $user         = Auth::id();
        $category     = Category::where('category_name', $rows['category_name'])->first();
        $category_id = $category->id;
        if (empty($category)) {
            return null;
        }
        $sub_category = SubCategory::where('sub_cate_name', $rows['sub_category_name'])->first();
        $sub_category_id = $sub_category->id;
        if (empty($sub_category)) {
            return null;
        }
        $brand  = Brand::where('name', $rows['brand_name'])->first();
        $brand_id = $brand->id;
        if (empty($brand)) {
            return null;
        }
        $ship_modes   = ShipMode::where('name', $rows['ship_mode'])->first();
        $ship_modes_id = $ship_modes->id;
        if (empty($ship_modes)) {
            return null;
        }
        $conditions   = Condition::where('name', $rows['condition'])->first();
        $conditions_id = $conditions->id;
        if (empty($conditions)) {
            return null;
        }
        foreach ($rows as $row) {
            $item = Item::create([
                'user_id' => $user,
                'category_id' =>  $category_id,
                'sub_category_id' => $sub_category_id,
                'brand_id' => $brand_id,
                'ship_mode_id' => $ship_modes_id,
                'what_are_you_selling' => $row['what_are_you_selling'],
                'describe_your_items' => $row['describe_your_items'],
                'weight' => $row['weight'],
                'quantity' => $row['quantity'],
                'zip_code' => $row['zip_code'],
                'pay_shipping' => $row['pay_shipping'],
                'price_type' => $row['price_type'],
                'price' => $row['price'],
                'condition_id' => $conditions_id,
            ]);
            $itemList = Item::where('user_id', $user)->get();
            foreach ($itemList as $item) {
                $itemId = $item->id;
            }

            $item = ItemsImages::create([
                'user_id' => $user,
                'item_id' => $itemId,
                'item_picture1' => $row['picture_1'],
            ]);
        }
    }
}
