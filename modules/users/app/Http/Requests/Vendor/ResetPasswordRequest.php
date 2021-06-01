<?php

namespace Modules\Users\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
        'password' => 'min:8|required',
        'confirm_password' => 'same:password|required',
        'otp' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'The email address is required',
            'email.email' => 'The email address should be a valid email',
            'password.required' => 'The password is required',
            'password.min' => 'The password should be at least 8 characters',
            'confirm_password.same' => 'The confirm password should be equal to password',
            'confirm_password.required' => 'The confirm password is required',
            'otp.required' => 'The OTP is required.',
        ];
    }
}
