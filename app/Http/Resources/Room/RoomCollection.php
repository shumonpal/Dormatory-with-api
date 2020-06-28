<?php

namespace App\Http\Resources\Room;

use Illuminate\Http\Resources\Json\JsonResource;
// use Illuminate\Http\Resources\Json\ResourceCollection;

class RoomCollection extends JsonResource
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
            'room_no' => $this->room_no,
            'capability' => $this->capability,
            'others' => $this->others,
            'created_at' => $this->created_at,
            'href' => [
                'link' => route('rooms.show', $this->id)
            ]
        ];
    }
}
