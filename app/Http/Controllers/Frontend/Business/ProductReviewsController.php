<?php

namespace App\Http\Controllers\Frontend\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Orders;
use App\Models\ItemsImages;
use App\Models\Category;
use App\Models\Store;
use App\Models\User;
use App\Models\ReviewRatings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Lang;
use Mail;
use Carbon\Carbon;

class ProductReviewsController extends Controller
{
    public function index() 
    {  
        $reviewRatings = ReviewRatings::where('user_id','=','1')->get();
        return view('frontend.business.pages.product_review.index', compact('reviewRatings'));

    }

    public function reviews_details($id)
    {
        $id = ($id);
        $reviewRating = ReviewRatings::where('item_id', $id)->orderby('id', 'desc')->get()->toArray();

        $item_name = Item::where('id', $id)->first();
        $category_name = Category::where('id', $item_name->category_id)->first();

        $itemArray = [];
        foreach($reviewRating as $key => $value)
        {
            $itemArray[$key] = $value;
            
            $items = Item::where('id',$value['item_id'])->first();
            $itemArray[$key]['items'] = $items;


            $itemsImage = ItemsImages::where('item_id',$items->id)->first();
            $itemArray[$key]['item_pictures'] = $itemsImage;

            $category = Category::where('id',$items->category_id)->first();
            $itemArray[$key]['category'] = $category;

            $users = User::where('id',$value['user_id'])->first();
            $itemArray[$key]['user'] = $users;

        }

        $itemImage = [];
        foreach($reviewRating as $key => $value)
        {
            $itemImage[$key] = $value;
            
            $items = Item::where('id',$value['item_id'])->first();
            $itemImage[$key]['items'] = $items;

            $itemsImage = ItemsImages::where('item_id',$items->id)->first();
            $itemImage[$key]['item_pictures'] = $itemsImage;

            $category = Category::where('id',$items->category_id)->first();
            $itemImage[$key]['category'] = $category;

        }
        return view('frontend.business.pages.product_review.index', compact('itemImage','itemArray', 'category_name', 'item_name'));
    }

}
