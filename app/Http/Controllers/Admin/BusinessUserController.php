<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessUsers;
use App\Models\City;
use App\Models\ItemsImages;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UsersBannerImage;
use File;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendcrMaroofNoVerifiedEmailJob;

class BusinessUserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $users = User::whereIn('role', [BUSINESS_ROLE])->orderBy('id', 'DESC')->get();
        return view('admin.business_users.index', compact('users'));
    }

    public function view($id)
    {
        $id = base64_decode($id);
        $user_view = User::where('id', $id)->first();
        $user_role = Role::where('role', $user_view->role)->first();
        $user_business_view = BusinessUsers::where('user_id', $user_view->id)->first();
        $user_business_city_view = City::where('id', $user_business_view->city_id)->first();
        $user_post = ItemsImages::where('user_id', $user_view->id)->get();
        $user_banner_view = UsersBannerImage::where('user_id', $id)->orderBy('id', 'desc')->first();
        return view('admin.business_users.view', compact('user_view', 'user_banner_view', 'user_role', 'user_post', 'user_business_view', 'user_business_city_view'));
    }

    public function destroy(Request $request)
    {
        $id = $request->business_user_id;
        User::where('id', $id)->delete();
        return redirect()->back()->with('error', __('messages.business_user.success.business_user_deleted_successfully'));
    }

    public function business_user_status_update(Request $request)
    {

        $id = $request->business_user_id;
        $organization_status = User::where('id', $id)->first();
        $organization_status->status = $request->status;
        $organization_status->save();
        return redirect()->route('admin.business_users.index')->with('success', __('messages.business_user.success.status_updated_successfully'));
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $edit_user = User::where('id', $id)->first();
        $user_business_edit = BusinessUsers::where('user_id', $edit_user->id)->first();
        $user_banner_edit = UsersBannerImage::where('user_id', $id)->orderBy('id', 'desc')->first();
        return view('admin.business_users.edit', compact('edit_user', 'user_business_edit', 'user_banner_edit'));
    }

    public function update(Request $request)
    {
        $user_update = User::where('id', $request->id)->first();
        $user_update->first_name = $request->first_name;
        $user_update->last_name = $request->last_name;
        $user_update->username = $request->username;
        $user_update->phone_number = $request->phone_number;

        if ($request->hasFile('profile_picture')) {
            $profile_picture = $request->file('profile_picture');
            $name = time() . '.' . $profile_picture->getClientOriginalExtension();
            $destinationPath = public_path('/assets/users');
            $profile_picture->move($destinationPath, $name);
            $user_update->profile_picture = $name;
        }

        $user_update->status = $request->status;
        $user_update->save();

        if ($user_update) {
            $userDetailsUpdate = BusinessUsers::where('user_id', $request->id)->first();
            $userDetailsUpdate->company_name = $request->company_name;
            $userDetailsUpdate->company_legal_name = $request->company_legal_name;
            $userDetailsUpdate->owner_or_manager_name = $request->owner_or_manager_name;
            $userDetailsUpdate->enter_cr_number = $request->enter_cr_number;
            $userDetailsUpdate->date_of_expiry = $request->date_of_expiry;
            $userDetailsUpdate->vat_number = $request->vat_number;
            $userDetailsUpdate->bank_name = $request->bank_name;
            $userDetailsUpdate->bank_account_number = $request->bank_account_number;
            $userDetailsUpdate->Iban_number = $request->Iban_number;
            $userDetailsUpdate->store_name = $request->store_name;
            $userDetailsUpdate->store_location = $request->store_location;
            $userDetailsUpdate->store_phone_number = $request->store_phone_number;
            $userDetailsUpdate->website = $request->website;

            if ($request->hasFile('store_logo_file')) {
                $store_logo_file = $request->file('store_logo_file');
                $name_store = time() . '.' . $store_logo_file->getClientOriginalExtension();
                $destinationPath = public_path('/assets/users');
                $store_logo_file->move($destinationPath, $name_store);
                $userDetailsUpdate->store_logo_file = $name_store;
            }
            $userDetailsUpdate->save();
        }

        return redirect()->route('admin.business_users.index')->with('success', __('Business User updated Successfully'));
    }

    public function phoneVerified(Request $request)
    {
        $status_update = User::where('id', $request->user_phone_id)->first();
        $status_update->phone_number_approved = $request->phone_number_approved;
        $status_update->save();
        return redirect()->back()->with('success', __('Approved Successfully'));
    }

    public function crNumberVerified(Request $request)
    {
        $status_update = BusinessUsers::where('id', $request->user_cr_number_id)->first();
        $status_update->cr_number_approved = $request->cr_number_approved;
        $status_update->save();
        return redirect()->back()->with('success', __('Approved Successfully'));
    }

    public function crUploadVerified(Request $request)
    {
        $status_update = BusinessUsers::where('id', $request->user_cr_upload_id)->first();
        $status_update->upload_cr_approved = $request->upload_cr_approved;
        $status_update->save();
        return redirect()->back()->with('success', __('Approved Successfully'));
    }

    public function crDownload(Request $request)
    {
        $download_file = BusinessUsers::where('upload_cr', $request->upload_cr)->first();
        $crFile = $download_file->upload_cr;
        $file_path = public_path('assets/users/' . $crFile);
        return response()->download($file_path);
    }

    public function crMaroofNoVerified(Request $request)
    {

        $status_update = BusinessUsers::where('id', $request->user_maroof_number_id)->first();
        $status_update->cr_maroof_no_approved = $request->cr_maroof_no_approved;
        $status_update->save();

        if ((int)$request->cr_maroof_no_approved == 1) {
            $details['email'] = 'gaurangkabra97@gmail.com';
            dispatch(new SendcrMaroofNoVerifiedEmailJob($details));
            // dd($details);
        } else {
            // dd('hello_2');
        }
        return redirect()->back()->with('success', __('Approved Successfully'));
    }

    public function membersinceVerified(Request $request)
    {
        $status_update = User::where('id', $request->user_id)->first();
        $status_update->member_since_approved = $request->member_since_approved;
        $status_update->save();
        return redirect()->back()->with('success', __('Approved Successfully'));
    }
    public function quickshipperVerified(Request $request)
    {
        $status_update = User::where('id', $request->user_id)->first();
        $status_update->quick_shipper_approved = $request->quick_shipper_approved;
        $status_update->save();
        return redirect()->back()->with('success', __('Approved Successfully'));
    }
    public function reliableVerified(Request $request)
    {
        $status_update = User::where('id', $request->user_id)->first();
        $status_update->reliable_approved = $request->reliable_approved;
        $status_update->save();
        return redirect()->back()->with('success', __('Approved Successfully'));
    }





    public function manroofDownload(Request $request)
    {
        $download_file = BusinessUsers::where('upload_maroof', $request->upload_maroof)->first();
        $manroofFile = $download_file->upload_maroof;
        $file_path = public_path('assets/users/' . $manroofFile);
        return response()->download($file_path);
    }

    public function uploadMaroofrVerified(Request $request)
    {
        $status_update = BusinessUsers::where('id', $request->user_upload_maroof_id)->first();
        $status_update->upload_maroof_approved = $request->upload_maroof_approved;
        $status_update->save();
        return redirect()->back()->with('success', __('Approved Successfully'));
    }

    public function vatNoVerified(Request $request)
    {
        $status_update = BusinessUsers::where('id', $request->user_vat_number_id)->first();
        $status_update->vat_number_approved = $request->vat_number_approved;
        $status_update->save();
        return redirect()->back()->with('success', __('Approved Successfully'));
    }

    public function vatCertificateDownload(Request $request)
    {
        $download_file = BusinessUsers::where('vat_certificate_file', $request->vat_certificate_file)->first();
        $vatCertificateFile = $download_file->vat_certificate_file;
        $file_path = public_path('assets/users/' . $vatCertificateFile);
        return response()->download($file_path);
    }

    public function vatCertificateVerified(Request $request)
    {
        $status_update = BusinessUsers::where('id', $request->user_vat_certificate_id)->first();
        $status_update->vat_certificate_approved = $request->vat_certificate_approved;
        $status_update->save();
        return redirect()->back()->with('success', __('Approved Successfully'));
    }

    public function MOGCertificateDownload(Request $request)
    {
        $download_file = BusinessUsers::where('ministry_of_government', $request->ministry_of_government)->first();
        $mogCertificateFile = $download_file->ministry_of_government;
        $file_path = public_path('assets/users/' . $mogCertificateFile);
        return response()->download($file_path);
    }

    public function mogCertificateVerified(Request $request)
    {
        $status_update = BusinessUsers::where('id', $request->user_mog_certificate_id)->first();
        $status_update->ministry_of_government_approved = $request->ministry_of_government_approved;
        $status_update->save();
        return redirect()->back()->with('success', __('Approved Successfully'));
    }
}
