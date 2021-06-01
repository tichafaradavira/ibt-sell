<?php

namespace Modules\Transactions\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class AddTransactionRequest extends FormRequest
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
        'items' => 'required|array|min:1',
        'paid_price' => '',
        'description' => '',
         'customer' => []
        ];
    }

    public function messages()
    {
        return [
            'items.required' => 'The  items are required',
//            'paid_price.required' => 'The paid price is required',
        ];
    }
}
