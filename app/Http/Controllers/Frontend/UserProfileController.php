<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UsersBannerImage;
use App\Models\UsersDeliveryAddress;
use App\Models\UserProfile;
use App\Models\User;
use App\Models\Category;
use App\Models\UserStory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Lang;
use DB;

class UserProfileController extends Controller
{
    public function UserProfile(Request $request){

        // get Auth user banner
        $UserBannerImage = UsersBannerImage::where('user_id','=',Auth::user()->id)->orderBy('created_at', 'DESC')->first();
        $userAddress = UsersDeliveryAddress::where('user_id','=',Auth::user()->id)->first();
        $category =  Category::where('status',ACTIVE)->where('deleted_at','=',NULL)->get();
        $userStory = UserStory::select('category_id')->with('category')->where('user_id','=',Auth::user()->id)->where('deleted_at','=',NULL)->groupBy('category_id')->get();
        $StoryAll = UserStory::select('category_id')->where('deleted_at','=',NULL)->where('user_id','=',Auth::user()->id)->groupBy('category_id')->get();
       
        // check category
        $CheckCategory = array();
        foreach($StoryAll as $key => $cat){
            $CheckCategory[] = $cat['category_id'];         
        }
        // get category wise story
        $Story = array();
        foreach($CheckCategory as $key => $value){
            $StoryAll = UserStory::with('user','category')->where('user_id',Auth::user()->id)->where('deleted_at','=',NULL)->where('category_id',$value)->get()->toArray(); 
            $Story[] = $StoryAll;
        }
        return view('frontend.users.profile',compact('UserBannerImage','userAddress','category','userStory','Story'));
    }

    public function UserBanner(Request $request){
        // store UserBannerImage
        $userBanner= new UsersBannerImage;
        $image = $request->file;
        if ($request->has('file')) {
            $imagename = $request->file;

            // File unlink to public path
            $removeImage = public_path() . "\assets\users\banner" . "\\" . $imagename;
            if (file_exists($removeImage)) {
                unlink($removeImage);
            }

            // if folder is not created than create the folder this function            
            $destination = public_path('assets/users/banner');
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
        $userBanner->user_id = Auth::user()->id;    
        $userBanner->banner_image = $imageName;    
        $userBanner->save();
    }

    public function UserEditProfile(Request $request){
        $userProfileDetail = User::where('id',Auth::user()->id)->first();
        $image = $request->profile_picture;
        if ($request->has('profile_picture')) {
            $imagename = $request->profile_picture;        
            $destination = public_path('assets/users');
            if(!is_dir($destination)) 
            {
                mkdir($destination, 0777, true);
            }
            $name = 'images' . time();
            $imageName = $name . '.' . $image->getClientOriginalExtension();
            $image->move($destination, $imageName);
        } else {
            $imageName = $userProfileDetail->profile_picture ;
        }            
        $userProfileDetail->profile_picture = $imageName;
        $userProfileDetail->username = $request->username;
        $userProfileDetail->gender = $request->gender;
        $userProfileDetail->birth_date = $request->birthdate;
        $userProfileDetail->email = $request->email;
        $userProfileDetail->phone_number = $request->phone_number;
        $userProfileDetail->address = $request->address;
        $userProfileDetail->save();

        return response()->json(['code' => 200, 'success' => Lang::get('frontend-messages.UserProfile.success.msg')], 200);        
    }
 
    public function ChangePassword(request $request){
        $user = Auth::User();
        $password = $request->old_password;

        // CHECK OLD PASSWORD IS MATCH
        if(isset($user) && !empty($user)){
            $check_password = Hash::check($password, $user->password);
        }

        // check old password condition
        if(!$check_password){
            return response()->json(['error' => 'Old password does not match!']);
        } else {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return response()->json(['code' => 200, 'success' => Lang::get('frontend-messages.ChangPassword.success.msg')], 200);
        }
    }

    public function UserAddress(Request $request){    
        $userAddressDetail = UsersDeliveryAddress::where('user_id','=',Auth::user()->id)->where('deleted_at','=',NULL)->get(); 
        return view('frontend.users.address',compact('userAddressDetail'));
    }

    public function AddressSubmit(Request $request){

        // Store data to UsersDeliveryAddress
        $usersDeliveryAddress = new UsersDeliveryAddress;
        $usersDeliveryAddress->user_id = Auth::user()->id;
        $usersDeliveryAddress->name = $request->name;
        $usersDeliveryAddress->phone_number = $request->phone_number;
        $usersDeliveryAddress->pincode = $request->pincode;
        $usersDeliveryAddress->locality = $request->locality;
        $usersDeliveryAddress->address = $request->address;
        $usersDeliveryAddress->city = $request->city;
        $usersDeliveryAddress->landmark = $request->landmark;
        $usersDeliveryAddress->alternate_phone = $request->alternate_phone;
        $usersDeliveryAddress->address_type = $request->address_type;
        $usersDeliveryAddress->save();

        return response()->json(['code' => 200, 'success' => Lang::get('frontend-messages.UserAddresses.success.msg')], 200);
    }   

    public function UpdateAddress($id,Request $request){

        //Update User Address
        $userAddress = UsersDeliveryAddress::find($request->id);
        $userAddress->user_id = Auth::user()->id;
        $userAddress->name = $request->name;
        $userAddress->phone_number = $request->phone_number;
        $userAddress->pincode = $request->pincode;
        $userAddress->locality = $request->locality;
        $userAddress->address = $request->address;
        $userAddress->city = $request->city;
        $userAddress->landmark = $request->landmark;
        $userAddress->alternate_phone = $request->alternate_phone;
        $userAddress->address_type = $request->address_type;        
        $userAddress->save();

        return response()->json(['code' => 200, 'success' => Lang::get('frontend-messages.UserAddresses.editaddress.success.msg')], 200);
    }

}
