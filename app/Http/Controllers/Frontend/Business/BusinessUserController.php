<?php

namespace App\Http\Controllers\Frontend\Business;

use App\Http\Controllers\Controller;
use App\Models\modelHasRoles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BusinessUserController extends Controller
{
    public function index()
    {
        if(Auth::user()->role == STORE_ROLE){
            $user = User::where('business_id', Auth::user()->id)->where('role_user','business_store_user')->get();
        }else{
            $user = User::where('business_id', Auth::user()->id)->where('role_user','business_user')->get();
        }
        //dd($user);
        return view('frontend.business.pages.business_users.index', compact('user'));
    }
    public function store(Request $request)
    {
        $checkEmail = User::where('email', $request->reg_email)->count();

        if ($checkEmail > 0) {
            return redirect()->back()->with('danger', 'Entered Email already used by another User');
        }
        $new_user = new User;

        $image = $request->profile_image;
        if ($request->has('profile_image')) {
            $imagename = $request->profile_image;
            $destination = public_path('assets/users');
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $name = 'images' . time();
            $imageName = $name . '.' . $image->getClientOriginalExtension();
            $image->move($destination, $imageName);
        } else {
            $imageName = null;
        }

        $new_user->profile_picture = $imageName;
        $new_user->business_id = $request->business_id;
        $new_user->first_name = $request->first_name;
        $new_user->last_name = $request->last_name;
        $new_user->name = $request->user_name;
        $new_user->email = $request->reg_email;
        $new_user->phone_code = $request->phone_code;
        $new_user->phone_number = $request->phone_number;
        $new_user->password = Hash::make($request->password);
        $new_user->status = 0;
        $new_user->country_id = $request->country_id;
        $new_user->state_id = $request->state_id;
        $new_user->city_id = $request->city_id;
        $new_user->role = BUSINESS_ROLE;
        $new_user->business_role = $request->role_id;
        $new_user->role_user = 'business_user';
        $new_user->save();


        $modelPermission = new modelHasRoles;
        $modelPermission->role_id = $new_user->business_role;
        $modelPermission->model_type = 'App\Models\User';
        $modelPermission->model_id = $new_user->id;
        $modelPermission->save();
        
        return redirect()->route('frontend.business.business_user.index')->with('success', 'User created successfully');
    }
}
