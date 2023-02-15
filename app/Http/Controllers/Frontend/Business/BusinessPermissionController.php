<?php

namespace App\Http\Controllers\Frontend\Business;

use App\Http\Controllers\Controller;
use App\Models\permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessPermissionController extends Controller
{
    public function index(){
        $permission = permission::where('permissions_status','business_user')->get();
        return view('frontend.business.pages.permission.index',compact('permission'));
    }

    public function create(){
        return view('frontend.business.pages.permission.create');
    }

    public function store(Request $request){
        $createPermission = new permission;
        $createPermission->name = $request->Permission_name;
        $createPermission->slug = str_replace(' ','_',strtolower($request->Permission_name));
        $createPermission->guard_name = 'web';
        $createPermission->permissions_status = 'business_user';
        $createPermission->save();
        return redirect()->route('frontend.business.permission.index')->with('success','Permission created successfully');
    }

    public function permission_index()
    {
        $permission = permission::where('permissions_status','business_store_user')->get();
        return view('frontend.business.pages.permission.index',compact('permission'));
    }
    public function permission_create(){
        return view('frontend.business.pages.permission.create');
    }
    public function permission_store(Request $request){
        $createPermission = new permission;
        $createPermission->name = $request->Permission_name;
        $createPermission->slug = str_replace(' ','_',strtolower($request->Permission_name));
        $createPermission->guard_name = 'web';
        $createPermission->permissions_status = 'business_store_user';
        $createPermission->save();
        return redirect()->route('frontend.store.permission.index')->with('success','Permission created successfully');
    }
}
