<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingExtension extends Model
{
    protected $guarded = [];

    protected $casts = [
        'original_end_date' => 'date',
        'new_end_date'      => 'date',
        'approved_at'       => 'datetime',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending'  => '⏳ Menunggu Persetujuan',
            'approved' => '✅ Disetujui',
            'rejected' => '❌ Ditolak',
            default    => $this->status,
        };
    }

    protected static function booted()
    {
        static::updated(function ($extension) {
            // Jika status berubah menjadi approved
            if ($extension->isDirty('status') && $extension->status === 'approved') {
                $booking = $extension->booking;
                $booking->end_date = $extension->new_end_date;
                $booking->total_price += $extension->extra_price;
                $booking->save();
            }
        });
    }
}
