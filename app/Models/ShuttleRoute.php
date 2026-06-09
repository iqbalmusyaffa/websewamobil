<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShuttleRoute extends Model
{
    use HasFactory;

    protected $fillable = [
        'origin_city',
        'destination_city',
        'class_type',
        'departure_time',
        'arrival_time',
        'base_price',
        'total_seats',
        'is_active',
    ];

    public function availableSeats($date)
    {
        $bookedSeats = ShuttleBooking::where('shuttle_route_id', $this->id)
            ->where('travel_date', $date)
            ->where('status', '!=', 'cancelled')
            ->sum('quantity');
            
        return max(0, $this->total_seats - $bookedSeats);
    }
}
