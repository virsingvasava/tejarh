<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Lang;

class SellNowItesm extends FormRequest
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
            'item_picture1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'item_description' => 'required|min:3|max:1000',
            'describe_your_items' => 'required|min:4|max:1000',
            'category_id' => 'required',
            'subcat_id' => 'required',
            'brand_id' => 'required',
            'condition_id' => 'required',
            'enter_weight' => 'required',
            'qty_id' => 'required',
            'zipcode' => 'required',
            'ship_mode_id' => 'required',
            'pay_for_shipping' => 'required',
            'price_type' => 'required',
            'price' => 'required',

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
            'item_picture1.required' => Lang::get('users_messages.post_an_item.validation.item_picture1'),
            'item_description.required' => Lang::get('users_messages.post_an_item.validation.item_description'),
            'describe_your_items.required' => Lang::get('users_messages.post_an_item.validation.describe_your_items'),
            'category_id.required' => Lang::get('users_messages.post_an_item.validation.please_select_category'),
            'subcat_id.required' => Lang::get('users_messages.post_an_item.validation.please_select_sub_category'),
            'brand_id.required' => Lang::get('users_messages.post_an_item.validation.please_select_brand'),
            'condition_id.required' => Lang::get('users_messages.post_an_item.validation.please_select_condition'),
            'enter_weight.required' => Lang::get('users_messages.post_an_item.validation.please_enter_weight'),
            'qty_id.required' => Lang::get('users_messages.post_an_item.validation.please_select_qty'),
            'zipcode.required' => Lang::get('users_messages.post_an_item.validation.please_enter_input_zip_code'),
            'ship_mode_id.required' => Lang::get('users_messages.post_an_item.validation.please_select_ship_mode'),
            'pay_for_shipping.required' => Lang::get('users_messages.post_an_item.validation.please_enter_pay_for_shipping'),
            'price_type.required' => Lang::get('users_messages.post_an_item.validation.please_enter_price_type'),
            'price.required' => Lang::get('users_messages.post_an_item.validation.please_enter_pricing'),
        ];
    }
}
