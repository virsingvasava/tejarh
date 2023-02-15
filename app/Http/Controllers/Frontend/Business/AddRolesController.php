<?php

namespace App\Http\Controllers\Frontend\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AddRoleUser;
use App\Models\Branch;
use Spatie\Permission\Models\Role;
use App\Http\Requests\AddRoles as AddRolesVali;
use App\Models\modelHasRoles;
use App\Models\permission;
use DateTime;
use Lang;
use Illuminate\Support\Str;
use File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AddRolesController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }

    public function index(){  
        $userId = Auth::user()->id; 
        $user = modelHasRoles::where('model_id',$userId)->first();
        if(!empty($user))
        {
            $role = Role::where('role_status','business_user')->get();
        }else{
            $role = Role::where('role_status','business_store_user')->get();
        }
        return view('frontend.business.pages.roles.index',compact('role'));
    }

    public function create(){
        $userId = Auth::user()->id; 
        $user = modelHasRoles::where('model_id',$userId)->first();
        if(!empty($user))
        {
            $permission = permission::where('permissions_status','business_user')->get();
        }else{
            $permission = permission::where('permissions_status','business_store_user')->get();
        }
        return view('frontend.business.pages.roles.create',compact('permission'));
    }

    public function store(Request $request){
        $userId = Auth::user()->id; 
        $user = modelHasRoles::where('model_id',$userId)->first();
        if(!empty($user))
        {
            $role = Role::create(['name' => $request->name ,'role' => 4, 'role_status' => 'business_user']);
            $role->syncPermissions($request->input('permissions'));
        }else{
            $role = Role::create(['name' => $request->name , 'role' => 8 ,'role_status' => 'business_store_user']);
            $role->syncPermissions($request->input('permissions'));
        }
        return redirect()->route('frontend.business.add-roles.index')
                        ->with('success','Role created successfully');
    }

}


