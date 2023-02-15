<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\CmsPage;
use App\Models\ItemsImages;
use App\Models\Role;
use App\Models\User;
use App\Models\UsersBannerImage;
use File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereIn('role', [USER_ROLE, API_ROLE])->orderBy('id', 'DESC')->get();
        return view('admin.user.index', compact('users'));
    }
    
    public function user_index()
    {
        $users = User::where('admin_user','admin')->get();
        return view('admin.user.admin_index', compact('users'));
    }
    public function create()
    {
        $role = Role::where('guard_name','web')->get();
        return view('admin.user.create', compact('role'));
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
        $new_user->admin_user = 'admin';
        $new_user->save();

        $role_ex = Role::where('id',$request->role)->first();
        $new_user->assignRole($role_ex->name);
        

        return redirect()->route('admin.user.index')->with('success','user_added_successfully');
        
    }

    public function view($id)
    {
        $id = base64_decode($id);
        $user_view = User::where('id', $id)->first();
        $user_role = Role::where('role', $user_view->role)->first();
        $user_post = ItemsImages::where('user_id', $user_view->id)->get();
        $user_banner_view = UsersBannerImage::where('user_id', $id)->orderBy('id', 'desc')->first();
        return view('admin.user.view', compact('user_view', 'user_banner_view', 'user_role', 'user_post'));
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $edit_user = User::where('id', $id)->first();
        return view('admin.user.edit', compact('edit_user'));
    }

    public function update(Request $request)
    {
        $user_update = User::where('id', $request->id)->first();
        $user_update->first_name = $request->first_name;
        $user_update->last_name = $request->last_name;
        $user_update->name = $request->name;

        if ($request->hasFile('profile_picture')) {
            $profile_picture = $request->file('profile_picture');
            $name = time() . '.' . $profile_picture->getClientOriginalExtension();

            $destinationPath = public_path('/img/users');
            if (!file_exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            $profile_picture->move($destinationPath, $name);
            $user_update->profile_picture = $name;
        }

        $user_update->status = $request->status;
        $user_update->save();

        return redirect()->route('admin.user.index')->with('success', __('messages.user.success.user_updated_successfully'));
    }

    public function destroy(Request $request)
    {
        $id = $request->user_id;
        User::where('id', $id)->delete();
        return redirect()->back()->with('error', __('messages.user.success.user_deleted_successfully'));
    }


    public function user_status_update(Request $request)
    {
        $id = $request->user_id;
        $organization_status = User::where('id', $id)->first();
        $organization_status->status = $request->status;
        $organization_status->save();
        return redirect()->route('admin.user.index')->with('success', __('messages.user.success.status_updated_successfully'));
    }

    public function phoneVerified(Request $request)
    {   
        $status_update = User::where('id', $request->user_phone_id)->first();
        $status_update->phone_number_approved = $request->phone_number_approved;
        $status_update->save();
        return redirect()->back()->with('success', __('messages.category.success.category_status_successfully'));
    }

    public function membersinceVerified(Request $request)
    {
        
        $status_update = User::where('id', $request->user_id)->first();
        $status_update->member_since_approved = $request->member_since_approved;
        $status_update->save();
        return redirect()->back()->with('success', __('messages.category.success.category_status_successfully'));
    }
    public function quickshipperVerified(Request $request)
    {
        $status_update = User::where('id', $request->user_id)->first();
        $status_update->quick_shipper_approved = $request->quick_shipper_approved;
        $status_update->save();
        return redirect()->back()->with('success', __('messages.category.success.category_status_successfully'));
    }
    public function reliableVerified(Request $request)
    {
        $status_update = User::where('id', $request->user_id)->first();
        $status_update->reliable_approved = $request->reliable_approved;
        $status_update->save();
        return redirect()->back()->with('success', __('messages.category.success.category_status_successfully'));
    }
}
