<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Lang;


class AddRoles extends FormRequest
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
            'user_name' => 'required',
            'store_name' => 'required',
            'branch_id' => 'required',
            'phone_number' => 'required',
            'gender' => 'required',
            'role_id' => 'required',
            'role_image_name' => 'required',
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
            'user_name.required' => Lang::get('business_messages.role.validation.enter_user_name'),
            'store_name.required' => Lang::get('business_messages.role.validation.enter_store_name'),
            'branch_id.required' => Lang::get('business_messages.role.validation.select_branch'),
            'phone_number.required' => Lang::get('business_messages.role.validation.phone_number'),
            'gender.required' => Lang::get('business_messages.role.validation.please_select_gender'),
            'role_id.required' => Lang::get('business_messages.role.validation.please_select_role'),
            'role_image_name.required' => Lang::get('business_messages.role.validation.please_select_picture'),
        ];
    }
}
