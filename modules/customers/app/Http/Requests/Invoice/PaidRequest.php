<?php

namespace Modules\Customers\Http\Requests\Invoice;

use Illuminate\Foundation\Http\FormRequest;

class   PaidRequest extends FormRequest
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
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}
