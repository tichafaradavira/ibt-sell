<?php

namespace Modules\Customers\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Quotation extends JsonResource
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
            'summary' => $this->summary,
            'total_amount' => $this->total_amount,
            'customer' => new Customer($this->customer),
            'lead' =>new Lead($this->lead),
            'expires_at' => $this->expires_at,
        ];
    }

}
