<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Temparature extends Model
{
    protected $fillable = ['user_id', 'room_id', 'people_id', 'morning', 'evenning', 'created_at'];

    public function people()
    {
        return $this->belongsTo('\App\Models\People', 'people_id');
    }

    public function room()
    {
        return $this->belongsTo('\App\Models\Room', 'room_id');
    }

    protected static function booted()
    {
        static::addGlobalScope('temparetureByUser', function (Builder $query) {
            if (auth()->user()->isAdmin()) {
                return $query;
            }
            $query->where('user_id', auth()->user()->id);
        });
    }
}
