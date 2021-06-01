<?php

namespace Modules\Customers\Http\Requests\Quotation;

use Illuminate\Foundation\Http\FormRequest;

class AddQuotationRequest extends FormRequest
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
            'customer' => 'required_if:lead,null',
            'lead' => 'required_if:customer,null',
            'summary' => '',
            'items' => 'required|array|min:1',
            'discount' => 'numeric',
            'expires_at' => 'required|date_format:j-n-Y',
            'items.*.price' => 'required|numeric',
            'items.*.quantity' => 'required|integer',
            'items.*.description'    => 'required|max:150',
        ];
    }

    public function messages()
    {
        return [
            'items.required' => 'You need at least one item.',
            'expires_at.required' => 'Please specify expiry date.',
            'expires_at.date_format' => 'Date format should be d-m-yyyy',
        ];
    }
}
