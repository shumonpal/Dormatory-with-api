<?php

namespace App\Http\Resources\Room;

use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
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
            'room_no' => $this->room_no,
            'capability' => $this->capability,
            'others' => $this->others,
            'created_at' => $this->created_at,
        ];
    }
}
