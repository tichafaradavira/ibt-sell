<?php

namespace Modules\Customers\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class BrowseCustomersRequest extends FormRequest
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
        'quantity' => 'min:0:required',
        ];
    }

    public function messages()
    {
        return [
            'quantity.required' => 'The  name is required',
            'quantity.min' => 'The quantity cannot be less than one',
        ];
    }
}
