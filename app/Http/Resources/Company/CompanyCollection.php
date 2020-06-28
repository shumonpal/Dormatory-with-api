<?php

namespace App\Http\Resources\Company;

use Illuminate\Http\Resources\Json\JsonResource;
// use Illuminate\Http\Resources\Json\ResourceCollection;

class CompanyCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'regi_no' => $this->regi_no,
            'address' => $this->address,
            'email' => $this->email,
            'phone' => $this->phone,
            'created_at' => $this->created_at,
            'href' => [
                'link' => route('companies.show', $this->id)
            ]
        ];
    }
}
