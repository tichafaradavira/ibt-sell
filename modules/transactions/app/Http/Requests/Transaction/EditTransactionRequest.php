<?php

namespace Modules\Transactions\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class EditTransactionRequest extends FormRequest
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
            'items' => 'required|array',
            'paid_price' => 'numeric|digits:20',
            'description' => '',
            'customer' => ''
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The  name is required',
            'buying_price.required' => 'The buying price is required',
            'selling_price.required' => 'The selling price is required',
            'paid_price.digits' => 'The paid price is too large',


        ];
    }
}
