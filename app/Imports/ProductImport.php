<?php

namespace App\Imports;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Condition;
use App\Models\Item;
use App\Models\ShipMode;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Auth;

class ProductImport implements ToModel, WithStartRow
{

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user         = Auth::user();
        $category     = Category::where('category_name', $row[1])->first();
        $sub_category = SubCategory::where('sub_cate_name', $row[2])->first();
        $brand        = Brand::where('name', $row[3])->first();
        $ship_modes   = ShipMode::where('name', $row[4])->first();
        $conditions   = Condition::where('name', $row[13])->first();

        $item = new Item([
            'user_id' => $user[0],
            'category_id' => $category->id,
            'sub_category_id' => $sub_category->id,
            'brand_id' => $brand->id,
            'ship_mode_id' => $ship_modes->id,
            'what_are_you_selling' => $row[5],
            'describe_your_items' => $row[6],
            'weight' => $row[7],
            'quantity' => $row[8],
            'zip_code' => $row[9],
            'pay_shipping' => $row[10],
            'price_type' => $row[11],
            'price' => $row[12],
            'conditions' => $conditions->id,
        ]);
        return $item;
    }
}
