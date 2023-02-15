<?php

namespace App\Http\Controllers\Frontend\Business;

use App\Http\Controllers\Controller;
use App\Models\AccessToken;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\BusinessUsers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\modelHasRoles;
use App\Models\permission;
use App\Models\Role;
use App\Models\roleHasPermissions;
use DateTime;
use Illuminate\Support\Facades\Lang;
use Mail;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $emailCheck = User::where('email', $request->business_email)->first();

        if (empty($emailCheck)) {

            $create_user = new User;
            $image = $request->profile_picture;
            if ($request->has('profile_picture')) {
                $imagename = $request->profile_picture;
                $destination = public_path(BUSINESS_PROFILE_FOLDER);
                if (!is_dir($destination)) {
                    mkdir($destination, 0777, true);
                }
                $name = 'profile_picture_' . time();
                $imageName = $name . '.' . $image->getClientOriginalExtension();
                $image->move($destination, $imageName);
            } else {
                $imageName = null;
            }
            $create_user->profile_picture = $imageName;
            $create_user->first_name = $request->owner_manager_name;
            $create_user->name = $request->owner_manager_name;
            $create_user->email = $request->business_email;
            $create_user->phone_number = $request->phone_number;
            $create_user->phone_code = $request->phone_code;
            $create_user->password = Hash::make($request->password);
            $create_user->country_id = $request->country_id;
            $create_user->state_id = $request->state_id;
            $create_user->city_id = $request->city_id;
            $create_user->role = BUSINESS_ROLE;
            $create_user->status = 0;
            $create_user->is_confirm = 0;
            $create_user->otp = null;
            $create_user->save();

            $create_business_user = new BusinessUsers;
            $create_business_user->user_id = $create_user->id;
            $create_business_user->company_name = $request->company_name;
            $create_business_user->company_legal_name = $request->company_legal_name;
            $create_business_user->owner_or_manager_name = $request->owner_manager_name;
            $create_business_user->enter_cr_number = $request->cr_number;
            /* upload_cr */
            $upload_cr = $request->upload_cr_file;
            if ($request->has('upload_cr_file')) {
                $destination = public_path(BUSINESS_PROFILE_FOLDER);
                if (!is_dir($destination)) {
                    mkdir($destination, 0777, true);
                }
                $name = 'upload_cr_' . time();
                $upload_crName = $name . '.' . $upload_cr->getClientOriginalExtension();
                $upload_cr->move($destination, $upload_crName);
            } else {
                $upload_crName = null;
            }
            $create_business_user->upload_cr = $upload_crName;

            $create_business_user->enter_cr_maroof_namber = $request->enter_maroof_number;
            /* upload_maroof */
            $upload_maroof = $request->upload_maroof_file;
            if ($request->has('upload_maroof_file')) {
                $destination = public_path(BUSINESS_PROFILE_FOLDER);
                if (!is_dir($destination)) {
                    mkdir($destination, 0777, true);
                }
                $name = 'upload_maroof_' . time();
                $upload_maroofName = $name . '.' . $upload_maroof->getClientOriginalExtension();
                $upload_maroof->move($destination, $upload_maroofName);
            } else {
                $upload_maroofName = null;
            }
            $create_business_user->upload_maroof = $upload_maroofName;

            $create_business_user->date_of_expiry = $request->date_of_expiry;
            $create_business_user->bank_name = $request->bank_name;
            $create_business_user->bank_account_number = $request->bank_account_number;
            $create_business_user->Iban_number = $request->Iban_number;

            $create_business_user->country_id = $request->country_id;
            $create_business_user->state_id = $request->state_id;
            $create_business_user->city_id = $request->city_id;

            /* vat_number */
            $create_business_user->vat_number = $request->vat_number;
            $vat_number = $request->vat_certificate_file;
            if ($request->has('vat_certificate_file')) {
                $destination = public_path(BUSINESS_PROFILE_FOLDER);
                if (!is_dir($destination)) {
                    mkdir($destination, 0777, true);
                }
                $name = 'vat_number_' . time();
                $vat_numberName = $name . '.' . $vat_number->getClientOriginalExtension();
                $vat_number->move($destination, $vat_numberName);
            } else {
                $vat_numberName = null;
            }
            $create_business_user->vat_certificate_file = $vat_numberName;

            /* return_policy */
            $return_policy = $request->return_policy;
            if ($request->has('return_policy')) {
                $destination = public_path(BUSINESS_PROFILE_FOLDER);
                if (!is_dir($destination)) {
                    mkdir($destination, 0777, true);
                }
                $name = 'return_policy_' . time();
                $return_policyName = $name . '.' . $return_policy->getClientOriginalExtension();
                $return_policy->move($destination, $return_policyName);
            } else {
                $return_policyName = null;
            }
            $create_business_user->return_policy_file = $return_policyName;
            $create_business_user->save();
            
            $modelPermission = new modelHasRoles;
            $modelPermission->role_id = 2;
            $modelPermission->model_type = 'App\Models\User';
            $modelPermission->model_id = $create_user->id;
            $modelPermission->save();

            $refresh_token = "AOkPPWRZljv46I7_3LMmVqZovTrVMQ038ibe3eM09a4VLFRdAp77npbFk2gDXlwEHZ956qC-JHnmjLGOcMN9ZmKDr9sVwX6boo2tZL_NG89izBUd45G76RHESQI6xTgWc0IKX_paOigV8B4NIqloAp7rx7KoN4o3ozDFj6D6JaVRT5PyHjDsRhK63HK0xq9YVcS2EARRTwLM00kFnl6d7fT0Q7kNcZRUXw";

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.tryoto.com/rest/v2/refreshToken',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{"refresh_token": "AOkPPWRZljv46I7_3LMmVqZovTrVMQ038ibe3eM09a4VLFRdAp77npbFk2gDXlwEHZ956qC-JHnmjLGOcMN9ZmKDr9sVwX6boo2tZL_NG89izBUd45G76RHESQI6xTgWc0IKX_paOigV8B4NIqloAp7rx7KoN4o3ozDFj6D6JaVRT5PyHjDsRhK63HK0xq9YVcS2EARRTwLM00kFnl6d7fT0Q7kNcZRUXw"}',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);

            $json = json_decode($response, true);
            $access_token = $json['access_token'];
            $refresh_token = $json['refresh_token'];
            $success = $json['success'];
            $token_type = $json['token_type'];
            $expires_in = $json['expires_in'];


            $insertToken = new AccessToken;
            $insertToken->access_token = $access_token;
            $insertToken->refresh_token = $refresh_token;
            $insertToken->success = $success;
            $insertToken->token_type = $token_type;
            $insertToken->expires_in = $expires_in;
            $insertToken->save();


            $getAccessToken = AccessToken::latest()->first();
            $fetch_access_token = $getAccessToken->access_token;

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.tryoto.com/rest/v2/register',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{"companyLogoURL":"","billingAddress":"","crNumber":"' . $create_business_user->enter_cr_number . '","vatNumber":"' . $create_business_user->vat_number . '", "mobileNumber":"' . $create_user->phone_number . '","fullName":"' . $create_user->first_name . '","email":"' . $create_user->email . '","companyName":"' . $create_business_user->company_name . '","webhookURL": "", "webhookMethod": "","webhookSecretKey": ""
            }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $fetch_access_token
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            echo $response;
            // p($response['activationLink']);
            return response()->json(['code' => 200, 'success' => Lang::get('frontend-messages.Register.successmsg.msg')], 200);

        } else {

            // echo 'This email already exists in our record';
            return response()->json(['code' => 200, 'error' => 'This email already exists in our record'], 200);
        }
    }

    public function getCountry(Request $request)
    {
        $data['countries'] = Country::get(["name", "id"]);
        return view('country-state-city', $data);
    }

    public function getState(Request $request)
    {
        $data['states'] = State::where("country_id", $request->country_id)->get(["name", "id"]);
        return response()->json($data);
    }

    public function getCity(Request $request)
    {
        $data['cities'] = City::where("state_id", $request->state_id)->get(["name", "id"]);
        return response()->json($data);
    }
}
