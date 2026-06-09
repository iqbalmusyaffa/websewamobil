<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirportTransferPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'airport_id',
        'airport_zone_id',
        'car_id',
        'price'
    ];

    public function airport()
    {
        return $this->belongsTo(Airport::class);
    }

    public function airportZone()
    {
        return $this->belongsTo(AirportZone::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
