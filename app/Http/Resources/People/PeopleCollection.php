<?php

namespace App\Http\Resources\People;

use Illuminate\Http\Resources\Json\JsonResource;

class PeopleCollection extends JsonResource
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
            'name' => $this->name,
            'identity' => $this->indentity,
            'others' => $this->others,
            'href' => [
                'link' => route('people.show', $this->id)
            ]
        ];
    }
}
