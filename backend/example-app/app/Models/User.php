<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = [
        'username',
        'name',
        'surname',
        'email',
        'city',
        'date_of_submission',
        'activationStatus'
    ];

    public function pets()
    {
        return $this->hasMany(Pets::class);
    }

    public function routeNotificationForMail()
    {
        return $this->email;
    }
}


