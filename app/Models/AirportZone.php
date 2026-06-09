<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirportZone extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function areas()
    {
        return $this->hasMany(AirportZoneArea::class);
    }

    public function transferPrices()
    {
        return $this->hasMany(AirportTransferPrice::class);
    }

    public function bookings()
    {
        return $this->hasMany(AirportBooking::class);
    }
}
