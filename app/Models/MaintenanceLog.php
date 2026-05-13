<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceLog extends Model
{
    protected $guarded = [];

    protected $casts = [
        'service_date' => 'date',
        'next_service_date' => 'date',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function carUnit()
    {
        return $this->belongsTo(CarUnit::class);
    }
}
