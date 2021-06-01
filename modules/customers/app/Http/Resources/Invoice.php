<?php

namespace Modules\Customers\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Invoice extends JsonResource
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
            'items' => $this->items,
            'number' => $this->number,
            'discount' => $this->discount,
            'total_amount' => $this->total_amount,
            'customer' => new Customer($this->customer),
            'created_at' => $this->created_at,
            'due_at' => $this->due_at,
            'paid_at' => $this->paid_at,
        ];
    }

}
