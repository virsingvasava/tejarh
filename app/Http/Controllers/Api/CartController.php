<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BoostItem;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\CheckOutUserDetails;
use App\Models\Condition;
use App\Models\Inventory;
use App\Models\Item;
use App\Models\ItemsImages;
use App\Models\Store;
use App\Models\User;
use App\Models\UserDeliveryAddress;
use App\Models\UserLike;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }
    public function cartlisting(Request $request)
    {
        $user_token = $request->header('authorization');

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $checkCart = Cart::where('customer_id', $user_id)->get();
        if (!empty($checkCart) && count($checkCart) > 0) {


            $cartData = Cart::where('customer_id', $user_id)->get()->toArray();
            
            $itemArray = [];
            $grand_total = 0;
            foreach ($cartData as $key => $value) {
                $itemArray[$key] = $value;

                $itemsList = Item::where('id', $value['item_id'])->where('status', '=', '1')->first();
                $itemArray[$key]['itemsList'] = $itemsList;
                
                $itemsImage = ItemsImages::where('item_id', $value['id'])->withTrashed()->first();
                $itemArray[$key]['item_pictures'] = $itemsImage;

                $condition = Condition::where('id', $itemsList['condition_id'])->first();
                $itemArray[$key]['condition'] = $condition;

                $brand = Brand::where('id', $itemsList['brand_id'])->first();
                $itemArray[$key]['brand'] = $brand;

                $store = Store::where('id', $itemsList['store_id'])->first();
                $itemArray[$key]['store'] = $store;

                $boostItem = BoostItem::where('item_id', $value['id'])->where('is_paid', '1')->first();
                $itemArray[$key]['boostItem'] = $boostItem;

                $category = Category::where('id', $itemsList['category_id'])->first();
                $itemArray[$key]['category'] = $category;

                $users = User::where('id', $itemsList['user_id'])->first();
                $itemArray[$key]['user'] = $users;


                $selectAddress = CheckOutUserDetails::where('user_id', $user_id)->first();
                $address = UserDeliveryAddress::where('id',$selectAddress['address_id'])->first();
                $itemArray[$key]['Select Address'] = $address;
            }
            $message = 'Address Add successfully';
            return SuccessResponse($message, 200, $itemArray);
        } else {
            $message = 'cart';
            return SuccessResponse($message, 200, "");
        }
    }

    public function addTocart(Request $request)
    {
        $user_token = $request->header('authorization');

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;


        $validator = validator::make($request->all(), [
            'item_id' => 'required',
        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message, 101);
        }
        $items_data  = Item::where(['id' => $request->item_id])->first();
        $customer_id  = $user_id;

        $Addcart  = new Cart;
        $Addcart->user_id  = $items_data->user_id;
        $Addcart->customer_id  = $user_id;
        $Addcart->item_id  = $items_data->id;
        $Addcart->store_id  = $items_data->store_id;
        $Addcart->price = $items_data->price;
        $Addcart->quantity = TRUE;
        $Addcart->total_amount = $items_data->price;
        $Addcart->attributevariant = $request->attribute_id;
        $Addcart->save();

        $message = 'Address Add successfully';
        return SuccessResponse($message, 200, $Addcart);
    }

    public function updatequantity(Request $request)
    {
        $user_token = $request->header('authorization');

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;


        $validator = validator::make($request->all(), [
            'item_id' => 'required',
            'quantity' => 'required',
            'cart_id' => 'required',
            'price' => 'required',
        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message, 101);
        }
        $get_item  = Item::where(['id' => $request->item_id])->first();
        $getUserId = $get_item->user_id;

        $requestedQty = $request->quantity;

        $getInventory = Inventory::where(['item_id' => $request->item_id])->first();
        $inventoryStock = 0;
        if (!empty($getInventory)) {
            $inventoryStock = $getInventory->stock_remaining;
        }

        if ((int)$inventoryStock < (int)$requestedQty) {
            $message = 'Address Add successfully';
            return SuccessResponse($message, 200, ['total_amount' => 0, 'grand_total' => 0, 'in_stock' => 0]);
        }

        $data  = Cart::where(['id' => $request->cart_id])->first();
        if (!empty($data)) {
            $update  = Cart::where(['id' => $request->cart_id])->first();
            $update->user_id  = $getUserId;
            $update->customer_id  = $user_id;
            $update->item_id  = $request->item_id;
            $update->quantity = $request->quantity;
            $update->price = $request->price;
            $update->shipping_price = 0;
            $update->total_amount = ($request->price * $request->quantity);
            $update->save();
        } else {
            $qty_update  = new Cart;
            $qty_update->user_id  = $getUserId;
            $qty_update->customer_id  = $user_id;
            $qty_update->item_id  = $request->item_id;
            $qty_update->price = $request->price;
            $qty_update->quantity = $request->quantity;
            $qty_update->shipping_price = 0;
            $qty_update->total_amount =  ($request->price * $request->quantity);
            $qty_update->save();
        }

        $price = $request->price;
        $quantity = $request->quantity;
        $total_amount = ($price * $quantity);


        $total_amount = numberFormat($price * $quantity);

        $grand_total = ($price * $quantity);

        $message = 'Qty Updated successfully';
        return SuccessResponse($message, 200, ['total_amount' => $total_amount, 'grand_total' => $grand_total, 'in_stock' => 1, 'data' => $data]);
    }

    public function deletecartlist(Request $request)
    {
        $user_token = $request->header('authorization');

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;


        $validator = validator::make($request->all(), [
            'item_id' => 'required',
        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message, 101);
        }

        if (!empty($user_id)) {
            $cart =  Cart::where('customer_id', $user_id)->where('item_id', $request->item_id)->delete();
            $message = 'Delete item successfully';
            return SuccessResponse($message, 200, $cart);
        } else {
            $message = 'cart is empty';
            return InvalidResponse($message, 101);
        }
    }
}
