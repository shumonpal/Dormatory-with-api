<?php

namespace App\Http\Resources\Company;

use Illuminate\Http\Resources\Json\JsonResource;

class Company extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'regi_no' => $this->regi_no,
            'address' => $this->address,
            'email' => $this->email,
            'phone' => $this->phone,
            'created_at' => $this->created_at,
        ];
    }
}
