<?php

namespace App\Http\Controllers\Frontend\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MakeAnOfferValidation as RequestValidation;
use App\Models\Item;
use App\Models\ItemsImages;
use App\Models\MakeAnOffer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Lang;

class MakeAnOfferController extends Controller
{
    public function make_an_offer_post(RequestValidation $request){

        $makeAnOffer = new MakeAnOffer;
        $makeAnOffer->buyer_id  = Auth::user()->id;
        $makeAnOffer->seller_id  = $request->productAuthorId;
        $makeAnOffer->item_id  = $request->productId;
        $makeAnOffer->item_price  = $request->productPrice;
        $makeAnOffer->offer_price = $request->offer_price;
        $makeAnOffer->offer_message  = $request->offer_message;
        $makeAnOffer->save();
        $id = $request->productId;
        return redirect()->back()->with('success', __('business_messages.make_an_offer.success.make_an_offer_send_successfully'));

    }

    public function make_an_offer(Request $request)
    {   
        $id = $request->item_Id;
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

            $users = User::where('id',$value['user_id'])->first();
            $itemArray[$key]['user'] = $users;

        }
        return response()->json($itemArray);
    }
}
