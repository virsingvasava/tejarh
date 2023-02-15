<?php

namespace App\Exports;

use App\Models\Item;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class ExportProduct implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
     * @return response()
     */
    public function collection()
    {
        $itemExport = DB::table('items')
            ->select(
                "items.what_are_you_selling",
                "items.describe_your_items",
                "category.category_name",
                "sub_category.sub_cate_name",
                "brand.name",
                "items.weight",
                "items.weight",
                "items.length",
                "items.height",
                "items.quantity",
                "items.price",
                "items.address",
                "items.latitude",
                "items.longitude",

                DB::raw('(CASE 
                        WHEN items.pay_shipping = "0" THEN "The buyer" 
                        WHEN items.pay_shipping = "1" THEN "I will pay" 
                        WHEN items.pay_shipping = "2" THEN "Split" 
                        ELSE "SuperAdmin" 
                        END) AS pay_shipping_lable'),
                DB::raw('(CASE 
                        WHEN items.price_type = "0" THEN "Fixed Price" 
                        WHEN items.price_type = "1" THEN "Negotiable" 
                        ELSE "SuperAdmin" 
                        END) AS price_type_lable'),
                DB::raw('(CASE 
                        WHEN items.delivery_type = "within 2-3 days" THEN "within 2-3 days" 
                        WHEN items.delivery_type = "within 7 days" THEN "within 7 days" 
                        ELSE "SuperAdmin" 
                        END) AS delivery_pay_type'),

                "conditions.name as conditionName",
                "delivery_types.name as deliveryName",
                
            )
            ->join('category', 'category.id', '=', 'items.category_id')
            ->join('sub_category', 'sub_category.id', '=', 'items.sub_category_id')
            ->join('brand', 'brand.id', '=', 'items.brand_id')
            ->join('conditions', 'conditions.id', '=', 'items.condition_id')
            ->join('delivery_types', 'delivery_types.id', '=', 'items.delivery_type')
            ->get();

        return $itemExport;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */

    public function headings(): array
    {
        return [
            'What are you selling',
            'Describe your items',
            'Category name',
            'Sub Category name',
            'Brand name',
            'Weight',
            'Width',
            'Length',
            'Height',
            'Quantity',
            'Price',
            'Address',
            'Latitude',
            'Longitude',
            'Pay Shipping',
            'Price Type',
            'Delivery Type',
            'Condition',
            'Delivery Type',
        ];
    }


    /**
     * @return array
     */

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }
}
