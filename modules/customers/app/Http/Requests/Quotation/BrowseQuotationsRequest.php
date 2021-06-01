<?php

namespace Modules\Customers\Http\Requests\Quotation;

use Illuminate\Foundation\Http\FormRequest;

class BrowseQuotationsRequest extends FormRequest
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
}
