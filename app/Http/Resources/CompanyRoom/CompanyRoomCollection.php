<?php

namespace App\Http\Resources\CompanyRoom;

use Illuminate\Http\Resources\Json\JsonResource;
// use Illuminate\Http\Resources\Json\ResourceCollection;

class CompanyRoomCollection extends JsonResource
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
            'room' => $this->room->room_no,
            'company' => $this->company->name,
            'href' => [
                'link' => route('companyrooms.show', $this->id)
            ]
        ];
    }
}
