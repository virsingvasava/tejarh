<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\CountryCode;
use Validator;
use JWTAuth;
use Response;
use JWTFactory;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\JWTException;
use Mail; 


class CountryStateCityController extends Controller
{
    public function getCountryCodeList(Request $request)
    {
        $countryCode = CountryCode::get(); 

        if(!empty($countryCode) && count($countryCode) > 0){
            $message = 'Fetch cities listing successfully.';
            return SuccessResponse($message,200,$countryCode);
        }else{
            $message = "Country code not found";
            return InvalidResponse($message,101);
        }
      
    }

    public function getCountryList(Request $request)
    {
        $country = Country::get();        
        if(!empty($country) && count($country) > 0){
            $message = 'Fetch country listing successfully.';
            return SuccessResponse($message,200,$country);
        }else{
            $message = "Country not found";
            return InvalidResponse($message,101);
        }
    }

    public function getStateList(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'country_id' => 'required',
        ]);

        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }

        $countryId = $request->country_id;

        $state = State::where('country_id', $countryId)->get();        
        if(!empty($state) && count($state) > 0){
            $message = 'Fetch states listing successfully.';
            return SuccessResponse($message,200,$state);
        }else{
            $message = "States not found";
            return InvalidResponse($message,101);
        }
    }

    public function getCityList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'country_id' => 'required',
            'state_id' => 'required',

        ]);

        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }

        $countryId = $request->country_id;
        $stateId = $request->state_id;

        $city_list = City::where(['country_id' => $countryId, 'state_id' => $stateId])->get(); 
               
        if(!empty($city_list) && count($city_list) > 0){
            $message = 'Fetch cities listing successfully.';
            return SuccessResponse($message,200,$city_list);
        }else{
            $message = "City not found";
            return InvalidResponse($message,101);
        }
    }
}
