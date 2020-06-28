<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['user_id', 'name', 'regi_no', 'address', 'email', 'phone', 'others'];

    // protected static function booted()
    // {
    //     static::addGlobalScope('companyByUser', function (Builder $builder) {
    //         $builder->where('user_id', auth()->user()->id);
    //     });
    // }

    public function scopeCompanyByUser($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }
}
