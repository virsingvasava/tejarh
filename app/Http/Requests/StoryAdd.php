<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Lang;

class StoryAdd extends FormRequest
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
            'story_image_name' => 'required',
            'product_name' => 'required',
            'category_id' => 'required',
            'story_description' => 'required',
            'product_price' => 'required',
            'store_location' => 'required',
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
            'story_image_name.required' => Lang::get('business_messages.story.validation.video_or_image'),
            'product_name.required' => Lang::get('business_messages.story.validation.productname'),
            'category_id.required' => Lang::get('business_messages.story.validation.category_id'),
            'description.required' => Lang::get('business_messages.story.validation.description'),
            'product_price.required' => Lang::get('business_messages.story.validation.productprice'),
            'store_location.required' => Lang::get('business_messages.story.validation.storelocation'),
        ];
    }
}
