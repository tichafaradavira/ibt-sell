<?php

namespace Modules\Transactions\Http\Requests\Expense;

use Illuminate\Foundation\Http\FormRequest;

class EditExpenseRequest extends FormRequest
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
            'cost' => 'required',
            'description' => '',
            'paid_at' => ''
        ];
    }

    public function messages()
    {
        return [
            'cost.required' => 'The  cost is required',
        ];
    }
}
