<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name'              => ['required', 'min:3', 'regex:/^[\pL\s\-]+$/u'],
            'url'               => ['required'],
            'section_id'        => ['required'],
            'parent_id'         => ['required'],
            'discount'          => ['required', 'numeric'],
            'image'             => ['required', 'image', 'mimes:png,jpg', 'max:1024'],
            'description'       => ['required', 'min:10'],
            'description'       => ['required', 'min:10'],
            'description'       => ['required', 'min:10'],
            'meta_title'        => ['required', 'min:3'],
            'meta_description'  => ['required', 'min:10'],
            'meta_keywords'     => ['required', 'min:3'],
        ];
    }
}
