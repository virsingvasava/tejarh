<?php

namespace App\Http\Controllers\Frontend\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
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
        }
        return view('frontend.business.pages.product_details', compact('itemArray'));
    }
}
