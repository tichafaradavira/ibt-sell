<?php

namespace Modules\Users\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            'first_name' => $this->first_name,
            'is_admin' => $this->is_admin,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'country'=> $this->country,
            'language' =>  $this->language,
            'phone_number' => $this->phone_number,
            'settings' => $this->settings,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'email_verified_at' => $this->email_verified_at,
            'suspend_at' => $this->suspend_at,
            'activated_at' => $this->email_verified_at,
        ];
    }

}
