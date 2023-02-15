<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Condition;
use App\Models\DeliveryType;
use App\Models\Item;
use App\Models\ItemsImages;
use App\Models\OrderDeliveryAddress;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\ShipMode;
use App\Models\SubCategory;
use App\Models\User;
use App\Models\UserDeliveryAddress;

class OrdersController extends Controller
{
    public function index()
    {
        $order = OrderItem::get();
        $order_user = [];
        $itemImages = [];
        $payemntMode = [];
        foreach ($order as $orders) {
            $order_user_id = $orders->customer_id;
            $order_user['order_user'] = User::where('id', $order_user_id)->first();

            $item = $orders->item_id;
            $itemImages['itemImages'] = ItemsImages::where('item_id', $item)->first();

            $orderPaymentMode = $orders->order_id;
            $payemntMode['payemntMode'] = Orders::where('id', $orderPaymentMode)->first();
        }
        return view('admin.order.index', compact('order', 'order_user','itemImages','payemntMode'));
    }

    public function view($id)
    {
        $id = base64_decode($id);
        $view_order = OrderItem::where('id', $id)->first();
        $userAddress = OrderDeliveryAddress::where('order_item_id',$id)->first();
        $view_order_address = UserDeliveryAddress::where('id', $userAddress->address_id)->first();
        $itemDetails = Item::where('id', $view_order->item_id)->first();
        $itemUser = User::where('id', $itemDetails->user_id)->first();
        $itemImages = ItemsImages::where('item_id', $itemDetails->id)->get();
        $view_category = Category::where('id', $itemDetails->category_id)->first();
        $view_sub_category = SubCategory::where('id', $itemDetails->sub_category_id)->first();
        $view_brand = Brand::where('id', $itemDetails->brand_id)->first();
        $view_condition = Condition::where('id', $itemDetails->condition_id)->first();
        $view_deliveryType = DeliveryType::where('id', $itemDetails->delivery_type)->first();
        $order_user = User::where('id', $view_order->user_id)->first();
        return view('admin.order.view', compact(
            'view_order',
            'itemDetails',
            'itemImages',
            'order_user',
            'view_category',
            'view_sub_category',
            'view_brand',
            'view_condition',
            'view_order_address',
            'view_deliveryType',
            'itemUser'
        ));
    }

    public function destroy(Request $request)
    {
        $id = $request->story_id;
        Orders::where('id', $id)->delete();
        return redirect()->route('admin.order.index')->with('error', __('messages.order.success.order_deleted_successfully'));
    }

    public function order_status_update(Request $request)
    {
        $status_update = Orders::where('id', $request->story_id)->first();
        $status_update->status = $request->status;
        $status_update->save();
        return redirect()->route('admin.story.index')->with('success', __('messages.order.success.status_updated_successfully'));
    }
}
