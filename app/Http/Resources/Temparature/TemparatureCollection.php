<?php

namespace App\Http\Resources\Temparature;

use Illuminate\Http\Resources\Json\JsonResource;

class TemparatureCollection extends JsonResource
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
            'name' => $this->people->name,
            'identity' => $this->people->indentity,
            'morning' => $this->morning,
            'evenning' => $this->evenning,
            'others' => $this->others,
        ];
    }
}
