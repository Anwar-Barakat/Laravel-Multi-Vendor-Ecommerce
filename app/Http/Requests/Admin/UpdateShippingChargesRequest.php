<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShippingChargesRequest extends FormRequest
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
            'zero_500g'         => ['required', 'numeric'],
            '_501_1000g'        => ['required', 'numeric'],
            '_1001_2000g'       => ['required', 'numeric'],
            '_2001_5000g'       => ['required', 'numeric'],
            'above_5000g'       => ['required', 'numeric'],
        ];
    }
}