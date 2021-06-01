<?php

namespace Modules\Transactions\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Customers\Http\Resources\Customer;

class Expense extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public $preserveKeys = true;

    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'cost' => $this->cost,
            'description' => $this->description,
            'paid_at' => $this->paid_at,
            'created_at' => $this->created_at,
        ];
    }

}
