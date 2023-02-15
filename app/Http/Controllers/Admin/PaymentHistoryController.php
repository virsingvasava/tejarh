<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CheckOutPayment;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Condition;
use App\Models\ShipMode;

class PaymentHistoryController extends Controller
{
    public function index()
    {
        $payment_history = CheckOutPayment::get();
        return view('admin.payment.index', compact('payment_history'));
    }

    public function view($id)
    {
        $id = base64_decode($id);
        $view_ckeckout = CheckOutPayment::where('item_id', $id)->first();
        $view_ckeckout_user = User::where('id', $view_ckeckout->user_id)->first();
        $view_products = Item::with('itemImage')->where('id', $id)->first();
        $view_user = User::where('id', $view_products->user_id)->first();
        $view_category = Category::where('id', $view_products->category_id)->first();
        $view_sub_category = SubCategory::where('id', $view_products->sub_category_id)->first();
        $view_brand = Brand::where('id', $view_products->brand_id)->first();
        $view_condition = Condition::where('id', $view_products->condition_id)->first();
        $view_ship_mode = ShipMode::where('id', $view_products->ship_mode_id)->first();
        return view('admin.payment.view', compact(
            'view_products',
            'view_category',
            'view_user',
            'view_sub_category',
            'view_brand',
            'view_condition',
            'view_ship_mode',
            'view_ckeckout',
            'view_ckeckout_user'
        ));
    }

    public function destroy(Request $request)
    {
        $id = $request->payment_id;
        CheckOutPayment::where('id', $id)->delete();
        return redirect()->route('admin.order.index')->with('error', __('messages.history.success.payment_history_deleted_successfully'));
    }

    public function payment_status_update(Request $request)
    {
        $status_update = CheckOutPayment::where('id', $request->payment_id)->first();
        $status_update->status = $request->status;
        $status_update->save();
        return redirect()->route('admin.payment.index')->with('success', 'messages.history.success.payment_history_status_update_successfully');
    }
}
