<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'category_id'       => ['required'],
            'brand_id'          => ['required'],
            'name'              => ['required', 'min:3', 'unique:products,name'],
            'code'              => ['required'],
            'color'             => ['required'],
            'price'             => ['required', 'numeric'],
            'discount'          => ['numeric'],
            'weight'            => ['numeric'],
            'description'       => ['required', 'min:10'],
            'meta_title'        => ['required', 'min:3'],
            'meta_description'  => ['required', 'min:10'],
            'meta_keywords'     => ['required', 'min:10'],
            'is_featured'       => ['required', 'in:no,yes'],
            'status'            => ['required', 'in:0,1'],
            'image'             => ['required', 'image', 'mimes:png,jpg', 'max:1024'],
        ];
    }
}