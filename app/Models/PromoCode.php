<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PromoCode extends Model
{
    protected $guarded = [];

    protected $casts = [
        'valid_from' => 'date',
        'valid_until' => 'date',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function isValid(): bool
    {
        if (!$this->is_active) return false;
        if ($this->quota !== null && $this->used_count >= $this->quota) return false;
        if ($this->valid_from && Carbon::today()->lt($this->valid_from)) return false;
        if ($this->valid_until && Carbon::today()->gt($this->valid_until)) return false;
        return true;
    }

    public function calculateDiscount(float $total): float
    {
        if (!$this->isValid()) return 0;
        if ($total < $this->min_booking) return 0;

        if ($this->type === 'percent') {
            $discount = $total * ($this->value / 100);
            if ($this->max_discount !== null) {
                $discount = min($discount, $this->max_discount);
            }
            return $discount;
        }

        return min($this->value, $total);
    }
}
