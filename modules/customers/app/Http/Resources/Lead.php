<?php

namespace Modules\Customers\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Lead extends JsonResource
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
            'full_name' => $this->full_name,
            'description' => $this->description,
            'phone' => $this->phone,
            'email' =>  $this->email,
            'street_address' =>  $this->street_address,
            'suburb' =>  $this->suburb,
            'city' =>  $this->city,
            'zip_code' =>  $this->zip_code,
            'country' =>  $this->country,

        ];
    }

}
