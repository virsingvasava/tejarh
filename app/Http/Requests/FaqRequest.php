<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Lang;

class FaqRequest extends FormRequest
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
            [
            'category_id' => 'required',
            'title' => 'required',
            'subtitle' => 'required',
            'slug' => 'required',
            'short_description' => 'required',
            'status' => 'required',
        ], [
            'category_id.required' => Lang::get('messages.faq.create.validation.please_select_category'),
            'title.required' => Lang::get('messages.faq.create.validation.please_enter_title'),
            'subtitle.required' => Lang::get('messages.faq.create.validation.please_enter_sub_title'),
            'slug.required' => Lang::get('messages.faq.create.validation.please_enter_slug'),
            'short_description.required' => Lang::get('messages.faq.create.validation.please_enter_description'),
            'status.required' => Lang::get('messages.faq.create.validation.please_select_status'),
        ],
        ];
    }
}
