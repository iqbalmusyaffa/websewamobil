<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AirportZoneArea extends Model
{
    protected $fillable = [
        'airport_zone_id',
        'province_id',
        'province_name',
        'city_id',
        'city_name',
        'district_id',
        'district_name',
        'discount_amount',
    ];

    public function zone()
    {
        return $this->belongsTo(AirportZone::class, 'airport_zone_id');
    }
}
