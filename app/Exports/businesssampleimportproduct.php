<?php

namespace App\Exports;

use App\Models\Item;
use App\Models\Store;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class businesssampleimportproduct implements WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(String $id = null)
    {
        $this->$id = $id;
    }
    public function headings(): array
    {
        return [
            'SKU',
            'store Name',
            'What Are You Selling',
            'Describe Your Items',
            'Brand Name',
            'Category Name',
            'Sub Category Name',
            'Condition',
            'Picture 1',
            'Picture 2',
            'Picture 3',
            'Picture 4',
            'Picture 5',
            'Picture 6',
            'Weight',
            'Width',
            'Length',
            'Height',
            'Quantity',
            'Stock Plus Or Minus',
            'Address',
            'Latitude',
            'Longitude',
            'Delivery Type',
            'Pay Shipping',
            'Price Type',
            'Price',
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
