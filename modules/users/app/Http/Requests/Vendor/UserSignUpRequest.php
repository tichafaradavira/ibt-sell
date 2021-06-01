<?php

namespace Modules\Users\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class UserSignUpRequest extends FormRequest
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

            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'company_name' => '',
            'email' => 'email|required',
            'country' => '',
            'language' => '',
            'phone_number' => '',
            'password' => 'required|min:8',
            'confirm_password' => 'same:password|required',

        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'First name can not be blank',
            'last_name.required' => 'Last name can not be blank',
            'email.required' => 'Your email is required',
            'email.email' => 'Email should be a valid email',
            'password.min' => 'The password should have a minimum of 8 characters.',
            'confirm_password.same' => 'The confirm password should be equal to password',
            'confirm_password.required' => 'The confirm password is required',
        ];
    }
}
