<?php

namespace App\Http\Controllers\Api\BusinessUsers;

use App\Http\Controllers\Controller;
use App\Models\BusinessUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Models\Branch;
use App\Models\modelHasRoles;
use App\Models\State;
use Validator;
use JWTAuth;
use Response;
use JWTFactory;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\JWTException;
use Mail;
use Illuminate\Support\Facades\Crypt;


class BusinessUsersRegisterController extends Controller
{

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'profile_picture' => 'required|image',
            'company_name' => 'required',
            'company_legal_name' => 'required',
            'owner_or_manager_name' => 'required',
            'enter_cr_number' => 'required',
            'upload_cr' => 'required|image',
            'enter_cr_maroof_namber' => 'required',
            'upload_maroof' => 'required|image',
            'date_of_expiry' => 'required',
            'vat_number' => 'required',
            'upload_vat_number_Certificate' => 'required|image',
            'Return_policy' => 'required|image',
            'bank_name' => 'required',
            'bank_account_number' => 'required',
            'Iban_number' => 'required',
            'business_email' => 'required',
            'phone_number' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message, 101);
        }

        $countryId = Country::where('id', $request->country_id)->first();
        if (empty($countryId)) {

            $message = 'Country is not available our record';
            return InvalidResponse($message, 101);
        }

        $stateId = State::where('id', $request->state_id)->first();
        if (empty($stateId)) {

            $message = 'State is not available our record';
            return InvalidResponse($message, 101);
        }

        $cityId = City::where('id', $request->city_id)->first();
        if (empty($cityId)) {

            $message = 'City is not available our record';
            return InvalidResponse($message, 101);
        }

        $user = User::where('email', $request->email)->first();
        if (empty($user)) {

            $otp = generateRandomString(5);

            $create_user = new User;
            $image = $request->profile_picture;
            if (!empty($image)) {
                $imagename = $request->profile_picture;
                $destination = public_path("assets/users");
                if (!is_dir($destination)) {
                    mkdir($destination, 0777, true);
                }
                $name = 'profile_picture_' . time();
                $imageName = $name . '.' . $image->getClientOriginalExtension();
                $image->move($destination, $imageName);
                $create_user->profile_picture = $imageName;
            }
            $create_user->email = $request->business_email;
            $create_user->phone_number = $request->phone_number;
            $create_user->password = Hash::make($request->password);
            $create_user->country_id = $request->country_id;
            $create_user->state_id = $request->state_id;
            $create_user->city_id = $request->city_id;
            $create_user->role = BUSINESS_ROLE;
            $create_user->status = 0;
            $create_user->is_confirm = 0;
            $create_user->otp = (int)$otp;
            //dd($create_user);
            $create_user->save();

            $create_business_user = new BusinessUsers;
            $create_business_user->user_id = $create_user->id;
            $create_business_user->company_name = $request->company_name;
            $create_business_user->company_legal_name = $request->company_legal_name;
            $create_business_user->owner_or_manager_name = $request->owner_or_manager_name;
            $create_business_user->enter_cr_number = $request->enter_cr_number;
            $create_business_user->date_of_expiry = $request->date_of_expiry;
            $create_business_user->vat_number = $request->vat_number;
            $create_business_user->bank_name = $request->bank_name;
            $create_business_user->bank_account_number = $request->bank_account_number;
            $create_business_user->Iban_number = $request->Iban_number;

            /* upload_cr */
            $upload_cr = $request->upload_cr;
            if (!empty($upload_cr)) {
                $destination = public_path(BUSINESS_PROFILE_FOLDER);
                if (!is_dir($destination)) {
                    mkdir($destination, 0777, true);
                }
                $name = 'upload_cr_' . time();
                $upload_crName = $name . '.' . $upload_cr->getClientOriginalExtension();
                $upload_cr->move($destination, $upload_crName);

                $create_business_user->upload_cr = $upload_crName;
                $create_business_user->enter_cr_maroof_namber = $request->enter_cr_maroof_namber;
            }

            /* upload_maroof */
            $upload_maroof = $request->upload_maroof;
            if (!empty($upload_maroof)) {
                $destination = public_path(BUSINESS_PROFILE_FOLDER);
                if (!is_dir($destination)) {
                    mkdir($destination, 0777, true);
                }
                $name = 'upload_maroof_' . time();
                $upload_maroofName = $name . '.' . $upload_maroof->getClientOriginalExtension();
                $upload_maroof->move($destination, $upload_maroofName);
                $create_business_user->upload_maroof = $upload_maroofName;
            }

            /*vatnumber_certificate */
            $upload_maroof = $request->upload_vat_number_Certificate;
            if (!empty($upload_maroof)) {
                $destination = public_path(BUSINESS_PROFILE_FOLDER);
                if (!is_dir($destination)) {
                    mkdir($destination, 0777, true);
                }
                $name = 'vat_number_' . time();
                $upload_vat_number = $name . '.' . $upload_maroof->getClientOriginalExtension();
                $upload_maroof->move($destination, $upload_vat_number);
                $create_business_user->vat_certificate_file = $upload_vat_number;
            }

            /* Return_policy */
            $upload_maroof = $request->Return_policy;
            if (!empty($upload_maroof)) {
                $destination = public_path(BUSINESS_PROFILE_FOLDER);
                if (!is_dir($destination)) {
                    mkdir($destination, 0777, true);
                }
                $name = 'return_policy_' . time();
                $upload_return_policy = $name . '.' . $upload_maroof->getClientOriginalExtension();
                $upload_maroof->move($destination, $upload_return_policy);
                $create_business_user->return_policy_file = $upload_return_policy;
            }
            //   dd($create_business_user);
            $create_business_user->save();

            $modelPermission = new modelHasRoles;
            $modelPermission->role_id = 2;
            $modelPermission->model_type = 'App\Models\User';
            $modelPermission->model_id = $create_user->id;
            $modelPermission->save();

            $businessUsers = BusinessUsers::with('user')->where('id', $create_business_user->id)->get();
            $message = 'Registration Successfully.';
            return SuccessResponse($message, 200, $businessUsers);
        } else {
            $message = 'This email already exists in our record';
            return InvalidResponse($message, 101);
        }
    }
}
