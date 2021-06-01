<?php

namespace Modules\Customers\Http\Requests\Invoice;

use Illuminate\Foundation\Http\FormRequest;

class AddInvoiceRequest extends FormRequest
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
            'customer' => 'required|numeric',
            'items' => 'required|array|min:1',
            'discount' => 'numeric',
            'due_at' => 'required|date_format:j-n-Y',
            'items.*.price' => 'required|numeric',
            'items.*.quantity' => 'required|integer',
            'items.*.description' => 'required|max:150',
        ];
    }

    public function messages()
    {

        return [
            'items.required' => 'Items are required',
            'due_at.required' => 'The  due date is required',
            'due_at.date_format' => 'Date format should be d-m-yyyy',
        ];

    }
}
