<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::where('role_user','admin')->get();
        return view('admin.adminUser.admin_index', compact('users'));
    }

    public function create()
    {
        $role = Role::where('guard_name','web')->where('role_status','admin')->get();
        return view('admin.adminUser.create', compact('role'));
    }

    public function store(Request $request)
    {
        $checkEmail = User::where('email',$request->email)->count();

        if($checkEmail > 0){

            return redirect()->back()->with('danger','Entered Email already used by another User');
        }

        $new_user = new User;
        $new_user->first_name = $request->name;
        $new_user->last_name = null;
        $new_user->name = $request->name;
        $new_user->email = $request->email;
        $new_user->password = Hash::make($request->password);
        $new_user->phone_number = $request->phone_number;
        $new_user->status = true;
        $new_user->admin_role = $request->role;
        $new_user->role_user = 'admin';
        $new_user->save();

        $role_ex = Role::where('id',$request->role)->first();
        $new_user->assignRole($role_ex->name);
        

        return redirect()->route('admin.admin_index')->with('success','user_added_successfully');
        
    }
    public function destroy(Request $request)
    {
        $id = $request->user_id;
        User::where('id', $id)->delete();
        return redirect()->route('admin.admin_index')->with('error', __('messages.user.success.user_deleted_successfully'));
    }
}
