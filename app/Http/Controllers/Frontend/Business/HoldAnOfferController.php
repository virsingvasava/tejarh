<?php

namespace App\Http\Controllers\Frontend\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HoldAnOffer;
use Auth; 
use Lang;

class HoldAnOfferController extends Controller
{
    public function hold_an_offer_post(Request $request){
        
        $holdAnOffer = new HoldAnOffer;
        $holdAnOffer->buyer_id  = Auth::user()->id;
        $holdAnOffer->seller_id  = $request->productAuthorId;
        $holdAnOffer->item_id  = $request->productId;
        $holdAnOffer->item_price  = $request->productPrice;
        $holdAnOffer->booking_price = $request->bookingPrice;
        $holdAnOffer->payable_amount  = $request->payableAmountForItem;
        $holdAnOffer->save();
        $id = $request->productId;
        return redirect()->route('frontend.business.promoted-items.item_details', base64_encode($id))->with('success', __('business_messages.hold_an_offer.success.hold_an_offer_book_successfully'));
    }
}
