<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
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
}


