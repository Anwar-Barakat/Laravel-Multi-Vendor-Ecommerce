<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVendorDetailRequest extends FormRequest
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
            'name'          => 'required|min:3|regex:/^[\pL\s\-]+$/u',
            'address'       => 'required|min:3',
            'city'          => 'required|min:3',
            'state'         => 'required|min:3',
            'country'       => 'required|min:3',
            'pincode'       => 'required|min:3',
            'mobile'        => 'required|min:10|max:10',
            'avatar'        => 'required|mimes:png,jpg,jpeg|image|max:2048',
        ];
    }
}