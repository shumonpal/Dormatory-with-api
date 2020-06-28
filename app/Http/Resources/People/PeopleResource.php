<?php

namespace App\Http\Resources\People;

use Illuminate\Http\Resources\Json\JsonResource;

class PeopleResource extends JsonResource
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
            'name' => $this->name,
            'identity' => $this->indentity,
            'others' => $this->others,
        ];
    }
}
