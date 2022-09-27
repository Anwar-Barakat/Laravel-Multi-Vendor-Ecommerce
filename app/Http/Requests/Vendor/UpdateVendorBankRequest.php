<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVendorBankRequest extends FormRequest
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
            'account_holder_name'   => 'required|min:3',
            'bank_name'             => 'required|min:3',
            'account_number'        => 'required|numeric',
            'bank_ifsc_code'        => 'required|min:3',
        ];
    }
}