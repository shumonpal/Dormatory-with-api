<?php

namespace App\Http\Resources\CompanyRoom;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyRoomResource extends JsonResource
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
            'room' => $this->room->room_no,
            'company' => $this->company->name,
        ];
    }
}
