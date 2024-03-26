<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pets extends Model
{
    protected $fillable = [
        'name',
        'species',
        'user_id'
    ];

    public $timestamps = false;
}