<?php

namespace Modules\Products\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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

        'name' => 'required|max:255',
        'buying_price' => '',
        'selling_price' => 'required',
        'description' => '',
        'quantity' => 'min:0',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The  name is required',
            'buying_price.required' => 'The buying price is required',
            'selling_price.required' => 'The selling price is required',
        ];
    }
}
