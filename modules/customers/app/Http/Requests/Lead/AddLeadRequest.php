<?php

namespace Modules\Customers\Http\Requests\Lead;

use Illuminate\Foundation\Http\FormRequest;

class AddLeadRequest extends FormRequest
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
            'full_name' => 'required|max:255',
            'description' => '',
            'email' => 'required|email',
            'phone' => '',
            'street_address' => '',
            'suburb' => '',
            'city' => '',
            'country' => '',
            'zip_code' => '',

        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'The  full name is required',

        ];
    }
}
