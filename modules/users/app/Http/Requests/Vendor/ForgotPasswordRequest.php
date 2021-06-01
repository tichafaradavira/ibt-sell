<?php

namespace Modules\Users\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
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
        'email' => 'email|required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'The email address is required',
            'email.email' => 'The email address should be a valid email',
        ];
    }
}
