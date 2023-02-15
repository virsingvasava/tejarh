<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Lang;

class AddStore extends FormRequest
{
   /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'store_name' => 'required',
            'store_location' => 'required',
            'city_id' => 'required',
            'state_id' => 'required',
            'country_id' => 'required',
            'phone_number' => 'required',
            // 'shop_sign_file' => 'required',
            // 'store_logo_file' => 'required',
            'working_hours' => 'required',
            'website' => 'required',
            'store_type_id' => 'required',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
    *
    * @return array
    */
    public function messages()
    {
        return [
            'store_name.required' => Lang::get('business_messages.store.add_store.validation.store_name'),
            'store_location.required' => Lang::get('business_messages.store.add_store.validation.location'),
            'country_id.required' => Lang::get('business_messages.store.add_store.validation.country'),
            'state_id.required' => Lang::get('business_messages.store.add_store.validation.city_area'),
            'city_id.required' => Lang::get('business_messages.store.add_store.validation.city_id'),
            // 'shop_sign_file.required' => Lang::get('business_messages.store.add_store.validation.shop_sign_file'),
            // 'store_logo_file.required' => Lang::get('business_messages.store.add_store.validation.store_logo_file'),
            'phone_number.required' => Lang::get('business_messages.store.add_store.validation.store_phone_number'),
            'working_hours.required' => Lang::get('business_messages.store.add_store.validation.working_hours'),
            'website.required' => Lang::get('business_messages.store.add_store.validation.website'),
            'store_type_id.required' => Lang::get('business_messages.store.add_store.validation.store_type_id'),
        ];
    }
}
