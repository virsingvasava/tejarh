<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $permission = permission::where('permissions_status','admin')->get();
        // dd($permission);
        return view('admin.permission.index',compact('permission'));
    }

    public function create()
    {
        return view('admin.permission.create');
    }

    public function store(Request $request){

        $createPermission = new permission;
        $createPermission->name = $request->Permission_name;
        $createPermission->slug = str_replace(' ','_',strtolower($request->Permission_name));
        $createPermission->guard_name = 'web';
        $createPermission->permissions_status = 'admin';
        $createPermission->save();
        return redirect()->route('admin.permission.index')->with('success','Permission created successfully');
    }
    public function edit($id){
        $id = base64_decode($id);
        $permission = Permission::where('id',$id)->first();
        return view('admin.permission.edit',compact('permission'));
    }
    public function update(Request $request)
    {
        $update = permission::where('id',$request->id)->first();
        $update->name = $request->Permission_name;
        $update->slug = str_replace(' ','_',strtolower($request->Permission_name));
        $update->save();
        return redirect()->route('admin.permission.index')->with('success', __('Permission_updated_successfully'));
    }
}
