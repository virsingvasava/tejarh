<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Slider;
use App\Models\PasswordReset;
use App\Models\UserOtp;
use App\Models\UsersBannerImage;
use App\Models\UserStory;
use App\Mail\ForgotuserEmail;
use Illuminate\Support\Facades\Auth;
use App\Jobs\PasswordresetEmail;
use App\Jobs\ResetOtpEmail;
use Lang;
use Mail;
use DateTime;


use App\Models\Category;

use App\Models\Stories;
use App\Models\Item;
use App\Models\ItemsImages;
use App\Models\Condition;
use App\Models\Brand;
use App\Models\Store;
use App\Models\BoostItem;
use App\Models\Wishlist;


class FrontUserController extends Controller

{

    public function index(){
        
        $sliderImage = Slider::where('status',ACTIVE)->where('deleted_at','=',NULL)->get();

        $category =  Category::where('status',ACTIVE)->where('deleted_at','=',NULL)->limit(7)->get();
        
        $AllCategoryCount =  Category::where('status',ACTIVE)->where('deleted_at','=',NULL)->count();

        $take = $AllCategoryCount - count($category);
        $skip = 7;
        $categorySingle =  Category::where('status',ACTIVE)->where('deleted_at','=',NULL)->skip($skip)->take($take)->get();  
        if(Auth::check()){
            $LoginuserStory =  UserStory::select('user_id')->groupBy('user_id')->where('user_id','=',Auth::user()->id)->where('deleted_at','=',NULL)->get();  
            $Story = UserStory::where('deleted_at','=',NULL)->where('user_id','=',Auth::user()->id)->get();     
        }else{
            $LoginuserStory =  UserStory::select('user_id')->groupBy('user_id')->where('deleted_at','=',NULL)->get(); 
            $user = User::where('role',USER_ROLE)->get();
            $userArray = array();
            foreach($user as $usr){
                $userArray[] = $usr->id; 
            }    
            // For Multi Story
            $StoryAll = UserStory::select('user_id')->where('deleted_at','=',NULL)->whereIn('user_id',$userArray)->groupBy('user_id')->get(); 
                       
            $CheckUser = array();
            foreach($StoryAll as $key => $tr){
                $CheckUser[] = $tr['user_id'];         
            }

            $Story = array();
            foreach($CheckUser as $key => $value){
                $StoryAll = UserStory::with('user','category')->where('deleted_at','=',NULL)->where('user_id',$value)->get()->toArray(); 
                $Story[] = $StoryAll;
            }

        }
   
        /* Home Page */
        /* promoted items start*/
        $userGet = User::where('role', USER_ROLE)->get()->all();
        foreach($userGet as $key => $value){
            $itemsList = Item::where([['deleted_at','=', NULL]])
            ->orderBy('created_at','DESC')->get()->take(4)->toArray();
        }
        $itemArray = [];
        foreach($itemsList as $key => $value)
        {
            $itemArray[$key] = $value;
            $itemsImage = ItemsImages::where('item_id',$value['id'])->first();
            $itemArray[$key]['item_pictures'] = $itemsImage;

            $condition = Condition::where('id',$value['condition_id'])->first();
            $itemArray[$key]['condition'] = $condition;

            $brand = Brand::where('id',$value['brand_id'])->first();
            $itemArray[$key]['brand'] = $brand;

            $store = Store::where('id',$value['store_id'])->first();
            $itemArray[$key]['store'] = $store;

            $boostItem = BoostItem::where('item_id',$value['id'])->where('is_paid','1')->first();
            $itemArray[$key]['boostItem'] = $boostItem;

            $wishlist = Wishlist::where('item_id',$value['id'])->first();
            $itemArray[$key]['wishlist'] = $wishlist;
        }

        //p($itemArray);
        /* promoted items end*/

        
        /* new items start*/
        foreach($userGet as $key => $value){
            $conditionArr = Condition::where('name', NEW_ITEMS)->first();
            $newitemsConId = $conditionArr->id;
            $newItemsList = Item::where([["condition_id", "=", $newitemsConId], ['user_id','=',$value->id],['deleted_at','=', NULL]])
            ->orderBy('created_at','DESC')->get()->take(4)->toArray();
        }

        $newItemsListArray = [];
        foreach($newItemsList as $key => $value)
        {
            $newItemsListArray[$key] = $value;
            $itemsImage = ItemsImages::where('item_id',$value['id'])->first();
            $newItemsListArray[$key]['item_pictures'] = $itemsImage;

            $condition = Condition::where('id',$value['condition_id'])->first();
            $newItemsListArray[$key]['condition'] = $condition;

            $brand = Brand::where('id',$value['brand_id'])->first();
            $newItemsListArray[$key]['brand'] = $brand;

            $store = Store::where('id',$value['store_id'])->first();
            $newItemsListArray[$key]['store'] = $store;

            $boostItem = BoostItem::where('item_id',$value['id'])->where('is_paid','1')->first();
            $newItemsListArray[$key]['boostItem'] = $boostItem;

            $wishlist = Wishlist::where('item_id',$value['id'])->first();
            $newItemsListArray[$key]['wishlist'] = $wishlist;
        }
        /* new items end*/


        /* Used items start*/
        foreach($userGet as $key => $value){
            $usedItemsId = Condition::where('name', USED_ITEMS)->first();
            $useditemsConId = $usedItemsId->id;
            $usedItemsList = Item::where([["condition_id", "=", $useditemsConId], ['user_id','=',$value->id],['deleted_at','=', NULL]])
            ->orderBy('created_at','DESC')->get()->take(4)->toArray();    
        }
       
        $usedItemsListArray = [];
        foreach($usedItemsList as $key => $value)
        {
            $usedItemsListArray[$key] = $value;
            $itemsImage = ItemsImages::where('item_id',$value['id'])->first();
            $usedItemsListArray[$key]['item_pictures'] = $itemsImage;

            $condition = Condition::where('id',$value['condition_id'])->first();
            $usedItemsListArray[$key]['condition'] = $condition;

            $brand = Brand::where('id',$value['brand_id'])->first();
            $usedItemsListArray[$key]['brand'] = $brand;

            $store = Store::where('id',$value['store_id'])->first();
            $usedItemsListArray[$key]['store'] = $store;

            $boostItem = BoostItem::where('item_id',$value['id'])->where('is_paid','1')->first();
            $usedItemsListArray[$key]['boostItem'] = $boostItem;

            $wishlist = Wishlist::where('item_id',$value['id'])->first();
            $usedItemsListArray[$key]['wishlist'] = $wishlist;
        }
        /* Used items end*/

        /* unused items start*/
        foreach($userGet as $key => $value){
            $unusedItemsId = Condition::where('name', UNUSED_ITEMS)->first();
            $unuseditemsConId = $unusedItemsId->id;
            $unusedItemsList = Item::where([['user_id', '=', $value->id],['condition_id','=',$unuseditemsConId],['deleted_at','=', NULL]])
            ->orderBy('created_at','DESC')->get()->take(4)->toArray();
        }
        $unusedItemsListArray = [];
        foreach($unusedItemsList as $key => $value)
        {
            $unusedItemsListArray[$key] = $value;
            $itemsImage = ItemsImages::where('item_id',$value['id'])->first();
            $unusedItemsListArray[$key]['item_pictures'] = $itemsImage;

            $condition = Condition::where('id',$value['condition_id'])->first();
            $unusedItemsListArray[$key]['condition'] = $condition;

            $brand = Brand::where('id',$value['brand_id'])->first();
            $unusedItemsListArray[$key]['brand'] = $brand;

            $store = Store::where('id',$value['store_id'])->first();
            $unusedItemsListArray[$key]['store'] = $store;

            $boostItem = BoostItem::where('item_id',$value['id'])->where('is_paid','1')->first();
            $unusedItemsListArray[$key]['boostItem'] = $boostItem;

            $wishlist = Wishlist::where('item_id',$value['id'])->first();
            $unusedItemsListArray[$key]['wishlist'] = $wishlist;
        }
         /* unused items end*/


        /* Top deals items start*/
        /*
        foreach($userGet as $key => $value){
            $topDealsItems = Condition::where('name', TOP_DEALS_ITEMS)->first();
            $topDealsitemsConId = $topDealsItems->id;
            $topDealsItemsList = Item::where([['user_id', '=', $value->id],['condition_id','=',$topDealsitemsConId],['deleted_at','=', NULL]])->orderBy('created_at','DESC')
            ->get()->take(4)->toArray();
        }

        $topDealsItemsArray = [];
        foreach($topDealsItemsList as $key => $value)
        {
            $topDealsItemsArray[$key] = $value;
            $itemsImage = ItemsImages::where('item_id',$value['id'])->first();
            $topDealsItemsArray[$key]['item_pictures'] = $itemsImage;

            $condition = Condition::where('id',$value['condition_id'])->first();
            $topDealsItemsArray[$key]['condition'] = $condition;

            $brand = Brand::where('id',$value['brand_id'])->first();
            $topDealsItemsArray[$key]['brand'] = $brand;

            $store = Store::where('id',$value['store_id'])->first();
            $topDealsItemsArray[$key]['store'] = $store;

            $boostItem = BoostItem::where('item_id',$value['id'])->first();
            $topDealsItemsArray[$key]['boostItem'] = $boostItem;

            $wishlist = Wishlist::where('item_id',$value['id'])->first();
            $topDealsItemsArray[$key]['wishlist'] = $wishlist;
        }
        */
         /* Top deals items end*/


        /* Trending Items start*/
        /*
        $trendingItemsList = Item::where([['user_id', '=', $value->id],['condition_id','=',$unuseditemsConId],['deleted_at','=', NULL]])->orderBy('created_at','DESC')
        ->get()->take(4)->toArray();
     
        $trendingItemsArray = [];
        foreach($trendingItemsList as $key => $value)
        {
            $trendingItemsArray[$key] = $value;
            $itemsImage = ItemsImages::where('item_id',$value['id'])->first();
            $trendingItemsArray[$key]['item_pictures'] = $itemsImage;

            $condition = Condition::where('id',$value['condition_id'])->first();
            $trendingItemsArray[$key]['condition'] = $condition;

            $brand = Brand::where('id',$value['brand_id'])->first();
            $trendingItemsArray[$key]['brand'] = $brand;

            $store = Store::where('id',$value['store_id'])->first();
            $trendingItemsArray[$key]['store'] = $store;

            $boostItem = BoostItem::where('item_id',$value['id'])->first();
            $trendingItemsArray[$key]['boostItem'] = $boostItem;

            $wishlist = Wishlist::where('item_id',$value['id'])->first();
            $trendingItemsArray[$key]['wishlist'] = $wishlist;
        }
        */
         /* Trending Items end*/
        $recommendedItemsList = Item::where([['condition_id','=',$unuseditemsConId],['deleted_at','=', NULL]])
        ->orderBy('created_at','DESC')->get()->take(4)->toArray();
     

        $recommendedItemsArray = [];
        foreach($recommendedItemsList as $key => $value)
        {
            $recommendedItemsArray[$key] = $value;
            $itemsImage = ItemsImages::where('item_id',$value['id'])->first();
            $recommendedItemsArray[$key]['item_pictures'] = $itemsImage;

            $condition = Condition::where('id',$value['condition_id'])->first();
            $recommendedItemsArray[$key]['condition'] = $condition;

            $brand = Brand::where('id',$value['brand_id'])->first();
            $recommendedItemsArray[$key]['brand'] = $brand;

            $store = Store::where('id',$value['store_id'])->first();
            $recommendedItemsArray[$key]['store'] = $store;

            $boostItem = BoostItem::where('item_id',$value['id'])->where('is_paid','1')->first();
            $recommendedItemsArray[$key]['boostItem'] = $boostItem;

            $wishlist = Wishlist::where('item_id',$value['id'])->first();
            $recommendedItemsArray[$key]['wishlist'] = $wishlist;
        }
        /* Recommended items end */
        return view('frontend.users.layouts.home',compact('sliderImage','category','LoginuserStory','categorySingle','Story','AllCategoryCount', 'itemArray', 'newItemsListArray', 'usedItemsListArray'));   
    }
    

    public function UserRegister(Request $request){      

        $checkEmail = User::where('email',$request->reg_email)->count();
        if($checkEmail > 0){
            return redirect()->back()->with('danger','Entered Email already used by another User');
        }
        $new_user = new User;
        // update profile
        $image = $request->profile_image;
        if ($request->has('profile_image')) {
            $imagename = $request->profile_image;        
            $destination = public_path('assets/users');
            if(!is_dir($destination)) 
            {
                mkdir($destination, 0777, true);
            }
            $name = 'images' . time();
            $imageName = $name . '.' . $image->getClientOriginalExtension();
            $image->move($destination, $imageName);
        } else {
            $imageName = null;
        }            
        $new_user->profile_picture = $imageName;
        $new_user->first_name = $request->first_name;
        $new_user->last_name = $request->last_name;
        $new_user->username = $request->user_name;
        $new_user->email = $request->reg_email;
        $new_user->phone_code = $request->country_code;
        $new_user->phone_number = $request->phone_number;
        $new_user->password = Hash::make($request->password);
        $new_user->status = 0;
        $new_user->role = USER_ROLE;
        $new_user->save();

        return response()->json(['code' => 200, 'success' => Lang::get('frontend-messages.Register.successmsg.msg')], 200);
    }

    public function UserLogin(Request $request){    
    
        $email = $request->email;
        $username = $request->username;
        $password = $request->password;

        $user = User::where('username',$username)->orWhere('email',$username)->first();
        if(!empty($user)){
            
            $check_password = Hash::check($password, $user->password);

            if($check_password){                
                if($user->role == USER_ROLE){
                    $role = USER_ROLE;

                    if(filter_var($username, FILTER_VALIDATE_EMAIL)) {
                        //user sent their email 
                        Auth::attempt(['email' => $username, 'password' => $password]);
                        return response()->json(['code' => 200, 'success' => Lang::get('frontend-messages.LoginUser.successmsg.msg'), 'auth' => $role], 200);
                    } else {
                        //they sent their username instead 
                        Auth::attempt(['username' => $username, 'password' => $password]);
                        return response()->json(['code' => 200, 'success' => Lang::get('frontend-messages.LoginUser.successmsg.msg'),  'auth' => $role], 200);
                    }                    
                }
                if($user->role == BUSINESS_ROLE){
                    $role = BUSINESS_ROLE;
                    if(filter_var($username, FILTER_VALIDATE_EMAIL)) {
                        //user sent their email 
                        Auth::attempt(['email' => $username, 'password' => $password]);
                        return response()->json(['code' => 200, 'success' => Lang::get('frontend-messages.LoginUser.successmsg.msg'), 'auth' => $role], 200);

                    } else {
                        //they sent their username instead 
                        Auth::attempt(['username' => $username, 'password' => $password]);
                        return response()->json(['code' => 200, 'success' => Lang::get('frontend-messages.LoginUser.successmsg.msg'), 'auth' => $role], 200);
                    }                    
                }
            } 
        } 
    }

    public function UserLogout(){
        Auth::logout();
        return redirect()->back()->with('success','Your logged out successfully!');
    }

    public function productdetail(Request $request){   
        return view('frontend.product-detail');
    }

    public function productlist(Request $request){
        return view('frontend.product-list');
    }

    public function UserForgotpassword(Request $request){ 
               
        $email = $request->email;
        $userUnique = User::where('email',$email)->first();
        if(!empty($userUnique)){    
            if($userUnique->role == 3){
                $randomNumber = random_int(10000, 99999);
                PasswordReset::where('email',$email)->delete();
                $token = generateRandomToken(40);
                $reset = new PasswordReset;
                $reset->email = $email;
                $reset->token = $token;
                $reset->save();

                $userOTP = new UserOtp;
                $userOTP->token = $reset->token;
                $userOTP->OTP = $randomNumber;
                $userOTP->save();          
                
                $emailJobs = new PasswordresetEmail($userUnique, $userOTP);
                dispatch($emailJobs);
                return response()->json(['code' => 200, 'success' => Lang::get('frontend-messages.Forgot.success.msg')], 200);
            }

            if($userUnique->role == 4){
                $randomNumber = random_int(10000, 99999);
                PasswordReset::where('email',$email)->delete();
                $token = generateRandomToken(40);
                $reset = new PasswordReset;
                $reset->email = $email;
                $reset->token = $token;
                $reset->save();

                $userOTP = new UserOtp;
                $userOTP->token = $reset->token;
                $userOTP->OTP = $randomNumber;
                $userOTP->save();          
                
                $emailJobs = new PasswordresetEmail($userUnique, $userOTP);
                dispatch($emailJobs);
                return response()->json(['code' => 200, 'success' => Lang::get('frontend-messages.Forgot.success.msg')], 200);
            }
        } 
    }

    public function UserVerify(Request $request)
    { 
        $checkToken = $request->token;
        $data = [
            'otp1' => $request['otp1'],
            'otp2' => $request['otp2'],
            'otp3' => $request['otp3'],
            'otp4' => $request['otp4'],
            'otp5' => $request['otp5'],
        ];                
        $verifyotp =  implode("",$data);
        $verification = UserOtp::where('token',$checkToken)->first();        
        if(isset($verification->token) && !empty($verification->token)){
            if($verification->OTP == $verifyotp){
                return response()->json(['code' => 200, 'success' => Lang::get('frontend-messages.Verification.success.msg')], 200);
            }else{
                return response()->json(['error' => Lang::get('frontend-messages.Verification.errormsg.msg')]);
            }
        }else{
            return response()->json(['error' => Lang::get('frontend-messages.Verification.errormsg.msg')]);
        }
        
    }
    
    public function UserResendotp(Request $request)
    {
        $verification = PasswordReset::where('token',$request->token)->first();
        if(isset($verification->token) && !empty($verification->token)){
            $randomNumber = random_int(10000, 99999);
            $userID = UserOtp::where('token',$request->token)->first();
            $user = UserOtp::find($userID->id);
            $user->OTP = $randomNumber; 
            $user->save();
            $UserDetail = PasswordReset::where('token',$request->token)->first();
            if($UserDetail->token){
                if(isset($UserDetail) && !empty($UserDetail)){
                    $user =  User::where('email',$UserDetail->email)->first();    
                }                   
                $resendOtp = new ResetOtpEmail($user, $randomNumber);
                dispatch($resendOtp);                          
                return response()->json(['code' => 200, 'success' => Lang::get('frontend-messages.ResendOtp.success.msg')], 200);
            }
            
        }             
    }

    public function UserResetpassword(Request $request){
        $userFetch = PasswordReset::where('token',$request->token)->first();
        if(isset($userFetch)){
            $user = User::where('email',$userFetch->email)->first();
        }else{
            return response()->json(['error' => 'User not found']);
        }    
        if(!empty($user)){
            $user->password = Hash::make($request->reset_password);
            $user->save();
            PasswordReset::where('email',$user->email)->delete();
            return response()->json(['code' => 200, 'success' => Lang::get('frontend-messages.ResetPassword.success.msg')], 200);
        } 
    }
    
    public function UserStory(Request $request){
        $usetStory = new UserStory;    
        $image = $request->file;
        if ($request->has('file')) {
            $imagename = $request->profile_image;
            $removeImage = public_path() . "\assets\userstories" . "\\" . $imagename;
            if (file_exists($removeImage)) {
                unlink($removeImage);
            }
            $destination = public_path('assets/userstories');
            if(!is_dir($destination)) 
            {
                mkdir($destination, 0777, true);
            }
            $name = 'images' . time();
            $imageName = $name . '.' . $image->getClientOriginalExtension();
            // dd($imageName);
            $image->move($destination, $imageName);
        } else {
            $imageName = null;
        }            
        $usetStory->user_id = Auth::user()->id;    
        $usetStory->video_or_image_file = $imageName;    
        $usetStory->product_name = $request->product_name;
        $usetStory->category_id = $request->category_id;
        $usetStory->story_description = $request->story_description;  
        $usetStory->product_price = $request->product_price;        
        $usetStory->store_location = $request->store_location;     
        $usetStory->save();

        return response()->json(['code' => 200, 'success' => Lang::get('frontend-messages.UserStory.success.msg')], 200);
    }

}