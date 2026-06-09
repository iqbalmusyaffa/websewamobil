<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function transferPrices()
    {
        return $this->hasMany(AirportTransferPrice::class);
    }

    public function bookings()
    {
        return $this->hasMany(AirportBooking::class);
    }
}
