<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\permission;
use Spatie\Permission\Models\Role;
use DB;

class AdminroleController extends Controller
{
    public function index()
    {
        $role = Role::where('role_status','admin')->get();
        return view('admin.admin_role.index',compact('role'));
    }
    public function create()
    {
        $permission = permission::where('permissions_status','admin')->get();
        return view('admin.admin_role.create',compact('permission'));
    }
    public function store(Request $request)
    {
        // print_r($request->permissions);exit;
        $role = Role::create(['name' => $request->name , 'role_status' => 'admin']);
        // dd($role);
        $role->syncPermissions($request->input('permissions'));
        
        
        return redirect()->route('admin.admin_role.index')
                        ->with('success','Role created successfully');
    }

    public function edit($id){
        // dd($id);
        $role = Role::where('id',$id)->first();
        // dd($role);
        $permission = DB::Table('role_has_permissions')
        ->where('role_id',$id)
        ->leftjoin('permissions','role_has_permissions.permission_id',"=",'permissions.id')
        ->get();
        return view('admin.admin_role.edit',compact('role','permission'));
    }

    public function update(Request $request){
        $updaterole = Role::where('id',$request->Roleid)->first();
        $updaterole->name = $request->name;
        $updaterole->save();

        $update = permission::where('id',$request->permissionsid)->first();
        $update->name = $request->permissions;
        $update->slug = str_replace(' ','_',strtolower($request->permissions));
        $update->save();

        return redirect()->route('admin.admin_role.index')->with('success', __('Role_successfully'));
    }
}

