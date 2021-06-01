<?php

namespace Modules\Customers\Http\Requests\Invoice;

use Illuminate\Foundation\Http\FormRequest;

class BrowseInvoicesRequest extends FormRequest
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
