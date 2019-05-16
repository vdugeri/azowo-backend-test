<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'email',
        'confirmed',
    ];

    public function scopeConfirmed($query)
    {
        return $query->where('confirmed', true);
    }
}
