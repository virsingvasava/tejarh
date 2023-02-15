<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Lang;

class MakeAnOfferValidation extends FormRequest
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
            'offer_price' => 'required',
            'offer_message' => 'required',
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
            'offer_price.required' => Lang::get('business_messages.make_an_offer.validation.enter_offer_price'),
            'offer_message.required' => Lang::get('business_messages.make_an_offer.validation.write_your_message'),
        ];
    }
}
