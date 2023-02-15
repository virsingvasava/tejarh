<?php

namespace App\Exports;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class SampleBulkProduct implements  WithHeadings, ShouldAutoSize, WithEvents
{
    public function headings(): array
    {
        return [
            'SKU',
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

