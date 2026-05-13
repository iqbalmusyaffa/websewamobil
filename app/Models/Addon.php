<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    protected $guarded = [];

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_addons')->withPivot('price')->withTimestamps();
    }
}
