<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserStory;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\UserFollowers;
use App\Models\CustomerReview;
use App\Models\CustomerReviewRatings;
use Validator;
use JWTAuth;
use Response;
use JWTFactory;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\JWTException;
use Mail;
use File;

class UserItemsController extends Controller
{
    public function postRefreshToken(Request $request) 
    {
        $inputData = $request->all();

        $header = $request->header('AuthorizationUser');

        if(empty($header))
        {
            $message = 'Authorisation required' ;
            return InvalidResponse($message,101);
        }

        $response = veriftyAPITokenData($header);
        $success = $response->original['success'];
        
        if (!$success) 
        {
            return $response;
        }
    }

    /* Post an item */
    public function postAnItem(Request $request)
    {
        $inputData = $request->all();

        $header = $request->header('AuthorizationUser');
        $user_token = $request->header('authorization');

        if(empty($header))
        {
            $message = 'Authorisation required' ;
            return InvalidResponse($message,101);
        }

        $response = veriftyAPITokenData($header);
        $success = $response->original['success'];
        
        if (!$success) {
            return $response;
        }

        $validator = Validator::make($request->all(), [
            'item_picture1' => 'required',
            'description_what_are_you_selling' => 'required',
            'describe_your_items' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'brand_id' => 'required',
            'condition_id' => 'required',
            'weight' => 'required',
            'qty' => 'required',
            'ship_from_zip_code' => 'required',
            'ship_mode' => 'required',
            'pay_shipping' => 'required',
            'price' => 'required',
            'commission_charge' => 'required',
            'shipping_charge' => 'required',
            'total_amount' => 'required',
        ]);
        
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;
    
        $post_an_item = new Product;
        $post_an_item->user_id = $user_id;
        $post_an_item->selling_description = $request->description_what_are_you_selling;
        $post_an_item->product_description = $request->describe_your_items;
        $post_an_item->category_id = $request->category_id;
        $post_an_item->sub_category_id = $request->sub_category_id;
        $post_an_item->brand_id = $request->brand_id;
        $post_an_item->condition_id = $request->condition_id;
        $post_an_item->weight = $request->weight;
        $post_an_item->quantity = $request->qty;
        $post_an_item->zip_code = $request->ship_from_zip_code;
        $post_an_item->ship_mode = $request->ship_mode;
        $post_an_item->pay_shipping = $request->pay_shipping;
        $post_an_item->price = $request->price;
        $post_an_item->commission_charge = $request->commission_charge;
        $post_an_item->shipping_charge = $request->shipping_charge;
        $post_an_item->total_amount = $request->total_amount;
        $post_an_item->status = false;
        $post_an_item->save();

        $item_Image = new ProductImage;
        $item_Image->user_id  = $user_id;
        $item_Image->product_id  = $post_an_item->id;
        if ($request->hasFile('item_picture1')) 
        {
            $picture1 = $request->file('item_picture1');
            $name = time().'.'.$picture1->getClientOriginalExtension();
            $destinationPath = public_path('/img/product/picture1');
            $picture1->move($destinationPath, $name);
            if (!File::isDirectory($destinationPath)){
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $item_Image->product_picture1 = $name;
        }
        if ($request->hasFile('item_picture2')) 
        {
            $picture2 = $request->file('item_picture2');
            $name = time().'.'.$picture2->getClientOriginalExtension();
            $destinationPath = public_path('/img/product/picture2');
            $picture2->move($destinationPath, $name);
            if (!File::isDirectory($destinationPath)){
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $item_Image->product_picture2 = $name;
        }
        if ($request->hasFile('item_picture3')) 
        {
            $picture3 = $request->file('item_picture3');
            $name = time().'.'.$picture3->getClientOriginalExtension();
            $destinationPath = public_path('/img/product/picture3');
            $picture3->move($destinationPath, $name);
            if (!File::isDirectory($destinationPath)){
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $item_Image->product_picture3 = $name;
        }
        if ($request->hasFile('item_picture4')) 
        {
            $picture4 = $request->file('item_picture4');
            $name = time().'.'.$picture4->getClientOriginalExtension();
            $destinationPath = public_path('/img/product/picture4');
            $picture4->move($destinationPath, $name);
            if (!File::isDirectory($destinationPath)){
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $item_Image->product_picture4 = $name;
        }
        if ($request->hasFile('item_picture5')) 
        {
            $picture5 = $request->file('item_picture5');
            $name = time().'.'.$picture5->getClientOriginalExtension();
            $destinationPath = public_path('/img/product/picture5');
            $picture5->move($destinationPath, $name);
            if (!File::isDirectory($destinationPath)){
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $item_Image->product_picture5 = $name;
        }
        if ($request->hasFile('item_picture6')) 
        {
            $picture6 = $request->file('item_picture6');
            $name = time().'.'.$picture6->getClientOriginalExtension();
            $destinationPath = public_path('/img/product/picture6');
            $picture6->move($destinationPath, $name);
            if (!File::isDirectory($destinationPath)){
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $item_Image->product_picture6 = $name;
        }
        $item_Image->status  = false;
        $item_Image->save();
        $message = 'Post an item successfully.';
        $items_details = Product::with('item_pictures')->where('id',$post_an_item->id)->get();
        return SuccessResponse($message,200,$items_details);
    }

    public function ItemsOnSell(Request $request)
    {
        $inputData = $request->all();
        
        $header = $request->header('AuthorizationUser');
        $user_token = $request->header('authorization');

        if(empty($header))
        {
            $message = 'Authorisation required' ;
            return InvalidResponse($message,101);
        }

        $response = veriftyAPITokenData($header);
        $success = $response->original['success'];
        
        if (!$success) {
            return $response;
        }

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $ItemsOnSell = Product::where('user_id',$user_id)->first();        

        if(empty($ItemsOnSell)){
            $message = "Items on sell not found";
            return InvalidResponse($message,101);
        }

        $message = 'Fetch Items on sell listing successfully.';
        return SuccessResponse($message,200,$ItemsOnSell);
    }
    public function ItemsSold(Request $request)
    {
        $inputData = $request->all();
        
        $header = $request->header('AuthorizationUser');
        $user_token = $request->header('authorization');

        if(empty($header))
        {
            $message = 'Authorisation required' ;
            return InvalidResponse($message,101);
        }

        $response = veriftyAPITokenData($header);
        $success = $response->original['success'];
        
        if (!$success) {
            return $response;
        }

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $ItemsSold = Product::where(['user_id' => $user_id, 'status' => 1])->first();        

        if(empty($ItemsSold)){
            $message = "Sold not found";
            return InvalidResponse($message,101);
        }

        $message = 'Fetch Sold listing successfully.';
        return SuccessResponse($message,200,$ItemsSold);
    }

    public function ItemsBuy(Request $request)
    {
        $inputData = $request->all();
        
        $header = $request->header('AuthorizationUser');
        $user_token = $request->header('authorization');

        if(empty($header))
        {
            $message = 'Authorisation required' ;
            return InvalidResponse($message,101);
        }

        $response = veriftyAPITokenData($header);
        $success = $response->original['success'];
        
        if (!$success) {
            return $response;
        }

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $ItemsBuy = Product::where(['user_id' => $user_id, 'status' => 1])->first();        

        if(empty($ItemsOnSell)){
            $message = "Buy item not found";
            return InvalidResponse($message,101);
        }

        $message = 'Fetch Items on sell listing successfully.';
        return SuccessResponse($message,200,$ItemsOnSell);
    }

    public function ItemsBooked(Request $request)
    {
        $inputData = $request->all();
        
        $header = $request->header('AuthorizationUser');
        $user_token = $request->header('authorization');

        if(empty($header))
        {
            $message = 'Authorisation required' ;
            return InvalidResponse($message,101);
        }

        $response = veriftyAPITokenData($header);
        $success = $response->original['success'];
        
        if (!$success) {
            return $response;
        }

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $ItemsBookedItems = Product::where(['user_id' => $user_id, 'status' => 1])->first();

        if(empty($ItemsOnSell)){
            $message = "Booked Items not found";
            return InvalidResponse($message,101);
        }

        $message = 'Fetch Booked Items listing successfully.';

        return SuccessResponse($message,200,$ItemsOnSell);
    }

    public function onItemCustomerReview(Request $request)
    {
        $inputData = $request->all();
        
        $header = $request->header('AuthorizationUser');
        $user_token = $request->header('authorization');

        if(empty($header))
        {
            $message = 'Authorisation required' ;
            return InvalidResponse($message,101);
        }

        $response = veriftyAPITokenData($header);
        $success = $response->original['success'];
        
        if (!$success) {
            return $response;
        }

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $customerReview = CustomerReview::where(['user_id' => $user_id, 'status' => 1])->first();

        if(empty($customerReview)){
            $message = "On Item Customer review not found";
            return InvalidResponse($message,101);
        }

        $message = 'Fetch On Item Customer review listing successfully.';

        return SuccessResponse($message,200,$customerReview);
    }
}
