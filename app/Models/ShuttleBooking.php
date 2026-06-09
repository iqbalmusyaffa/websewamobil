<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShuttleBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_code',
        'user_id',
        'shuttle_route_id',
        'travel_date',
        'quantity',
        'pickup_address',
        'pickup_lat',
        'pickup_lng',
        'dropoff_address',
        'dropoff_lat',
        'dropoff_lng',
        'include_snack',
        'include_meal',
        'meal_upgrade',
        'total_price',
        'status',
        'seat_numbers',
        'payment_method',
        'payment_status',
        'snap_token',
        'proof_image',
        'proof_link',
        'driver_name',
        'driver_phone',
        'license_plate',
        'car_color',
        'meal_name',
    ];

    protected $casts = [
        'seat_numbers' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function route()
    {
        return $this->belongsTo(ShuttleRoute::class, 'shuttle_route_id');
    }
}
