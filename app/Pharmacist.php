<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\PharmacistResetPasswordNotification;

class Pharmacist extends Authenticatable
{
    use Notifiable;

     protected $guard = 'pharmacist';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status', 'name', 'email', 'contact', 'pharmacyName', 'address', 'society', 'city', 'latitude', 'longitude', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PharmacistResetPasswordNotification($token));
    }
}
