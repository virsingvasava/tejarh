<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StoryPrice;
use Illuminate\Http\Request;

class StoryPriceController extends Controller
{
    public function index()
    {
     
        $story_price_data = StoryPrice::select('story_price')->pluck('story_price');

        $story_price = '';

        if(!empty($story_price_data[0])){
            
            $story_price = $story_price_data[0];            
        }

        return view('admin.story_price.index',compact('story_price'));
    }

    public function story_price_update(Request $request)
    {
        $story_price = StoryPrice::where('status','1')->first();

        if(empty($story_price)){

            $story_price = new StoryPrice;
            $story_price->story_price = $request->story_price;
            $story_price->status = "1";
            $story_price->save();

        } else {
            $story_price->story_price = $request->story_price;
            $story_price->status = "1";
            $story_price->save();
        }
        return redirect()->back()->with('success', __('messages.story_price.success.story_price_added_successfully'));

    }
}
