<?php

namespace App\Http\Controllers\Frontend\Business;

use App\Http\Requests\AddStore as AddStoreValidation;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StoreType;
use App\Models\Store;
use App\Models\City;
use App\Models\Branch;
use App\Models\BusinessUsers;
use App\Models\Country;
use App\Models\modelHasRoles;
use App\Models\State;
use App\Models\User;
use DateTime;
use Lang;
use Illuminate\Support\Str;
use File;
use Illuminate\Support\Facades\Hash;

class AddStoreController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $cities = City::where('deleted_at', '=', NULL)->orderBy('name', 'ASC')->get();
        $storeTypes = StoreType::where('deleted_at', '=', NULL)->get();
        $store = Store::where(['business_id' => Auth::id()])->orderBy('id', 'DESC')->get();
        return view('frontend.business.pages.stores.index', compact('cities', 'storeTypes', 'store'));
    }

    public function create_store()
    {

        $cities = City::where('deleted_at', '=', NULL)->orderBy('name', 'ASC')->get();
        $storeTypes = StoreType::where('deleted_at', '=', NULL)->get();
        $branches = Branch::where('deleted_at', '=', NULL)->get();
        return view('frontend.business.pages.stores.create', compact('cities', 'storeTypes', 'branches'));
    }

    public function addStore(AddStoreValidation $request)
    {
        $create_Store = new User;

        $create_Store->business_id = $request->business_id;
        $create_Store->first_name = $request->store_name;
        $create_Store->last_name = Null;
        $create_Store->name = $request->store_username;
        $create_Store->email = $request->store_email;
        $create_Store->phone_code = $request->phone_code;
        $create_Store->phone_number = $request->phone_number;
        $create_Store->password = Hash::make($request->password);
        $create_Store->status = 0;
        $create_Store->country_id = $request->country_id;
        $create_Store->state_id = $request->state_id;
        $create_Store->city_id = $request->city_id;
        $create_Store->role = STORE_ROLE;
        //$create_Store->business_role = $request->role_id;
        $create_Store->role_user = 'business_store_user';
        $create_Store->save();

        $add_Store = new Store;
        $add_Store->user_id  = $create_Store->id;
        $add_Store->business_id  = Auth::id();
        $add_Store->store_name  = $request->store_name;
        $add_Store->store_location  = $request->store_location;
        $add_Store->city_id  = $request->city_id;
        $add_Store->state_id  = $request->state_id;
        $add_Store->country_id  = $request->country_id;
        $add_Store->phone_code  = $request->phone_code;
        $add_Store->phone_number  = $request->phone_number;
        $add_Store->working_hours  = $request->working_hours;
        $add_Store->website  = $request->website;
        $add_Store->store_type_id  = $request->store_type_id;
        $add_Store->branch_id  = $request->branch_id;

        /* Shop Sign File */
        $shop_sign = $request->shop_sign_file;
        if ($request->has('shop_sign_file')) {
            $destination = public_path(BUSINESS_PROFILE_FOLDER);
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $name = 'shop_sign_' . time();
            $shop_sign_Name = $name . '.' . $shop_sign->getClientOriginalExtension();
            $shop_sign->move($destination, $shop_sign_Name);
        } else {

            $shop_sign_Name = $add_Store->shop_sign_file;
        }
        $add_Store->shop_sign_file = $shop_sign_Name;

        /* Store Logo File */
        $store_logo = $request->store_logo_file;
        if ($request->has('store_logo_file')) {
            $destination = public_path(BUSINESS_PROFILE_FOLDER);
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $name = 'store_logo_' . time();
            $store_logoName = $name . '.' . $store_logo->getClientOriginalExtension();
            $store_logo->move($destination, $store_logoName);
        } else {
            $store_logoName =  $add_Store->store_logo_file;
        }
        $add_Store->store_logo_file = $store_logoName;
        $add_Store->save();

        $updateLogo = User::where('id', $create_Store->id)->first();
        $updateLogo->profile_picture = $store_logoName;
        $updateLogo->save();

        $modelPermission = new modelHasRoles;
        $modelPermission->role_id = 3;
        $modelPermission->model_type = 'App\Models\User';
        $modelPermission->model_id = $create_Store->id;
        $modelPermission->save();


        return redirect()->route('frontend.business.add-store.index')->with('success', __('Store Added Successfully'));
    }
    public function state_list(Request $request)
    {
        $data['states'] = State::where("country_id", $request->country_id)->orderBy('name', 'ASC')->get(["name", "id"]);
        return response()->json($data);
    }

    public function city_list(Request $request)
    {
        $data['cities'] = City::where("state_id", $request->state_id)->orderBy('name', 'ASC')->get(["name", "id"]);
        return response()->json($data);
    }

    public function edit($id)
    {
        $storeData = Store::where('id', $id)->first();
        $cities = City::where('deleted_at', '=', NULL)->orderBy('name', 'ASC')->get();
        $storeTypes = StoreType::where('deleted_at', '=', NULL)->get();
        $branches = Branch::where('deleted_at', '=', NULL)->get();
        return view('frontend.business.pages.stores.edit', compact('storeData', 'cities', 'storeTypes', 'branches'));
    }

    public function update(AddStoreValidation $request)
    {
        $storeUpdate = Store::where('id', $request->id)->first();
        $storeUpdate->store_name  = $request->store_name;
        $storeUpdate->store_location  = $request->store_location;
        $storeUpdate->city_id  = $request->city_id;
        $storeUpdate->state_id  = $request->state_id;
        $storeUpdate->country_id  = $request->country_id;
        $storeUpdate->phone_code  = $request->phone_code;
        $storeUpdate->phone_number  = $request->phone_number;
        $storeUpdate->working_hours  = $request->working_hours;
        $storeUpdate->website  = $request->website;
        $storeUpdate->store_type_id  = $request->store_type_id;
        $storeUpdate->branch_id  = $request->branch_id;

        /* Shop Sign File */
        $shop_sign = $request->shop_sign_file;
        if ($request->has('shop_sign_file')) {
            $destination = public_path(BUSINESS_PROFILE_FOLDER);
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $name = 'shop_sign_' . time();
            $shop_sign_Name = $name . '.' . $shop_sign->getClientOriginalExtension();
            $shop_sign->move($destination, $shop_sign_Name);
        } else {

            $shop_sign_Name = $storeUpdate->shop_sign_file;
        }
        $storeUpdate->shop_sign_file = $shop_sign_Name;

        /* Store Logo File */
        $store_logo = $request->store_logo_file;
        if ($request->has('store_logo_file')) {
            $destination = public_path(BUSINESS_PROFILE_FOLDER);
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $name = 'store_logo_' . time();
            $store_logoName = $name . '.' . $store_logo->getClientOriginalExtension();
            $store_logo->move($destination, $store_logoName);
        } else {
            $store_logoName =  $storeUpdate->store_logo_file;
        }
        $storeUpdate->store_logo_file = $store_logoName;
        $storeUpdate->save();
        return redirect()->route('frontend.business.add-store.index')->with('success', __('Store Added Successfully'));
    }

    public function store_removed(Request $request)
    {
        $id = $request->store_id;
        Store::where('id', $id)->delete();
        return redirect()->route('frontend.business.add-store.index')->with('success', __('Store deleted successfully'));
    }
}
