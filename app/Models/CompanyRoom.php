<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CompanyRoom extends Model
{
    protected $fillable = ['user_id', 'room_id', 'company_id'];

    protected static function booted()
    {
        static::addGlobalScope('companyRoomByUser', function (Builder $builder) {
            $builder->where('user_id', auth()->user()->id);
        });
    }

    public function company()
    {
        return $this->belongsTo('\App\Models\Company', 'company_id');
    }

    public function room()
    {
        return $this->belongsTo('\App\Models\Room', 'room_id');
    }
}
