<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends \TCG\Voyager\Models\User
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'country', 'city', 'post_code', 'address', 'phone'
    ];


    protected $appends = [
        'companies', 'rooms'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function companies()
    {
        return $this->hasMany('\App\Models\Company', 'user_id');
    }

    public function rooms()
    {
        return $this->hasMany('\App\Models\Room', 'user_id');
    }

    public function people()
    {
        return $this->hasMany('\App\Models\People', 'user_id');
    }


    public function companyRooms()
    {
        return $this->hasMany('\App\Models\CompanyRoom', 'room_id');
    }


    public function temparatures()
    {
        return $this->hasMany('\App\Models\Temparature', 'user_id');
    }
}
