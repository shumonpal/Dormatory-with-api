<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{

    protected $guarded = [];

    protected static function booted()
    {

        static::addGlobalScope('roomByUser', function (Builder $builder) {
            $builder->where('user_id', auth()->user()->id);
        });
    }

    public function people()
    {
        return $this->hasMany('App\Models\People', 'room_id');
    }
}
