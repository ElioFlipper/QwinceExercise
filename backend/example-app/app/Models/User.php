<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasFactory, HasApiTokens;

    protected $fillable = [
        'username',
        'name',
        'surname',
        'email',
        'city',
        'date_of_submission',
        'activationStatus',
        'password',
        'is_admin'
    ];

    public function pets()
    {
        return $this->hasMany(Pets::class);
    }

    public function routeNotificationForMail()
    {
        return $this->email;
    }

    public function subscriptions(): BelongsToMany
    {
        return $this->belongsToMany(Subscription::class)->withTimestamps();
    }
}


