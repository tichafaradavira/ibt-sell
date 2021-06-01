<?php

namespace Modules\Products\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'buying_price' => $this->buying_price,
            'selling_price' => $this->selling_price,
            'quantity'=> $this->quantity,
            'created_at'=> $this->created_at,

        ];
    }

}
