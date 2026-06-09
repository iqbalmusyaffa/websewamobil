<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirportBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_code',
        'user_id',
        'transfer_type',
        'airport_id',
        'airport_zone_id',
        'car_id',
        'pickup_datetime',
        'pickup_address',
        'flight_number',
        'customer_name',
        'customer_phone',
        'notes',
        'total_price',
        'payment_method',
        'payment_status',
        'booking_status',
        'snap_token',
        'proof_image',
        'proof_link'
    ];

    protected $casts = [
        'pickup_datetime' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
