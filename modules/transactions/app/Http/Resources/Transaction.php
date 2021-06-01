<?php

namespace Modules\Transactions\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Customers\Http\Resources\Customer;

class Transaction extends JsonResource
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
            'description' => $this->description,
            'total_price' => $this->total_price,
            'paid_price' => $this->paid_price,
            'discount'=> $this->discount,
            'products'=> $this->products,
            'customer'=> new Customer($this->whenLoaded('customer')),
            'created_at'=> $this->created_at,

        ];
    }

}
