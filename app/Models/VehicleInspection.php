<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleInspection extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_clean_exterior' => 'boolean',
        'is_clean_interior' => 'boolean',
        'photos' => 'array',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function carUnit()
    {
        return $this->belongsTo(CarUnit::class);
    }

    public function inspector()
    {
        return $this->belongsTo(User::class, 'inspector_id');
    }

    protected static function booted()
    {
        $syncOdometer = function ($inspection) {
            if ($inspection->type === 'post_rental' && $inspection->odometer !== null) {
                $carUnit = $inspection->booking?->carUnit;
                if ($carUnit) {
                    // Hanya update jika odometer baru lebih besar dari yang lama
                    if ($inspection->odometer > $carUnit->current_odometer) {
                        $carUnit->update(['current_odometer' => $inspection->odometer]);
                    }
                }
            }
        };

        static::created(function ($inspection) use ($syncOdometer) {
            $syncOdometer($inspection);
        });

        static::updated(function ($inspection) use ($syncOdometer) {
            $syncOdometer($inspection);
        });
    }
}
