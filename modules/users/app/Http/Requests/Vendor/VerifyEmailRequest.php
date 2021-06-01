<?php

namespace Modules\Users\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class VerifyEmailRequest extends FormRequest
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
        'otp' => 'required',
        'email' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'otp.required' => 'The one time password is required',
            'email.required' => 'The email is required',
        ];
    }
}
