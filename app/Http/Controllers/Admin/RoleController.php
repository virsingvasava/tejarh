<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use File;
use Lang;

class RoleController extends Controller
{
    public function index() 
    {

        $role = Role::where('role',[USER_ROLE, BUSINESS_ROLE])->get();
        return view('admin.role.index',compact('role'));
    }

    public function create()
    {
        $users = User::get();
        return view('admin.role.create',compact('users'));
    }

    public function store(Request $request)
    { 
       
        $validatedRequestData = $request->validate([

            'name' => 'required',
            'role_picture' => 'required',
            'status' => 'required',

        ], [

            'name.required' => Lang::get('messages.role.create.validation.please_enter_role'),
            'role_picture.required' => Lang::get('messages.role.create.validation.please_enter_picture'),
            'status.required' => Lang::get('messages.role.create.validation.please_select_status'),
        ]);

        $role = new Role;
        $role->name = $request->name;

        $roleName = ucwords($request->name);
        if($roleName == 'Admin'){
            $role->role  = ADMIN_ROLE;
        }
        if($roleName == 'Manager'){
            $role->role  =  MANAGER_ROLE;
        }
        if($roleName == 'Store Boy'){
            $role->role  = STORE_BOYS_ROLE;
        }

        if ($request->hasFile('role_picture')) 
        {
            $role_picture = $request->file('role_picture');
            $name = time().'.'.$role_picture->getClientOriginalExtension();
            $destinationPath = public_path('/img/role_picture');

            if (!file_exists($destinationPath)) {
               File::makeDirectory($destinationPath, 0755, true, true);
            }

            $role_picture->move($destinationPath, $name);
            $role->role_picture = $name;
        }
        $role->status = $request->status;
        $role->save();
        return redirect()->route('admin.role.index')->with('success','Role added successfully');
    }

    public function view($id)
    {
        $id = base64_decode($id);
        $view_role = Role::where('id',$id)->first();
        return view('admin.role.view',compact('view_role'));
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $edit_role = Role::where('id',$id)->first();

        $users = User::get();
        return view('admin.role.edit',compact('edit_role', 'users'));

    }

    public function update(Request $request)
    {
        $validatedRequestData = $request->validate([

            'name' => 'required',
            'role_picture' => 'required',
            'status' => 'required',

        ], [

            'name.required' => Lang::get('messages.role.create.validation.please_enter_role'),
            'role_picture.required' => Lang::get('messages.role.create.validation.please_enter_picture'),
            'status.required' => Lang::get('messages.role.create.validation.please_select_status'),
        ]);

        $role_update = Role::where('id',$request->id)->first();
      
        $role_update->name = $request->name;
        
        $roleName = ucwords($request->name);
        if($roleName == 'Admin'){
            $role_update->role  = ADMIN_ROLE;
        }
        if($roleName == 'Manager'){
            $role_update->role  =  MANAGER_ROLE;
        }
        if($roleName == 'Store Boy'){
            $role_update->role  = STORE_BOYS_ROLE;
        }

        $image = $request->role_picture;
        if ($request->has('role_picture')) {

            $imageName = $request->role_picture;
            $imageold = Role::find($request->id);
            //unlink("img/role_picture/".$imageold->picture);
            $destination = public_path('img/role_picture');
            $name = 'images' . time();
            $imageName = $name . '.' . $image->getClientOriginalExtension();
            $image->move($destination, $imageName);
        } 
        else {

            $imageold = Role::find($request->id);
            $imageName = $imageold->role_picture;
        }

        $role_update->role_picture = $imageName;
        $role_update->status = $request->status;
        $role_update->save();
        return redirect()->route('admin.role.index')->with('success','Role updated successfully');
    }

    public function destroy(Request $request)
    {
        $id = $request->role_id;
        Role::where('id',$id)->delete();
        return redirect()->route('admin.role.index')->with('error','Role deleted successfully!');

    }

    public function role_status_update(Request $request)
    {
        $status_update = Role::where('id',$request->role_id)->first();
        $status_update->status = $request->status;
        $status_update->save();
        return redirect()->route('admin.role.index')->with('success','Status updated successfully!');
    }
}
