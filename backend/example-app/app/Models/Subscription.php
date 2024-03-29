<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'duration',
        'startingDate',
        'endingDate',
    ];

    public function users(): BelongsToMany 
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

}
