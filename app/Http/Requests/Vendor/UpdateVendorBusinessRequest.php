<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVendorBusinessRequest extends FormRequest
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
            // 'shop_name'                 => 'required',
            // 'shop_address'              => 'required',
            // 'shop_city'                 => 'required',
            // 'shop_state'                => 'required',
            // 'shop_country'              => 'required',
            // 'shop_pincode'              => 'required',
            // 'shop_mobile'               => 'required',
            // 'shop_website'              => 'required',
            // 'shop_email'                => 'required',
            // 'address_proof'             => 'required|in:1,2,3,4,5',
            // 'address_proof_image'       => 'required',
            // 'business_license_number'   => 'required',
            // 'gst_number'                => 'required',
            // 'pan_number'                => 'required',
        ];
    }
}