<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Booking extends Model
{
    protected $guarded = [];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'actual_return_date' => 'datetime',
        'deposit_refund_date' => 'datetime',
        'cancelled_at' => 'datetime',
        'is_customer_fault' => 'boolean',
        'insurance_claimed' => 'boolean',
        'refund_override' => 'boolean',
    ];

    protected static function booted()
    {
        $syncCarUnitStatus = function ($booking) {
            if (!$booking->car_unit_id) return;
            
            if (in_array($booking->status, ['pending', 'menunggu pembayaran', 'disetujui', 'berjalan'])) {
                $booking->carUnit->update(['status' => 'rented']);
            } elseif (in_array($booking->status, ['selesai', 'dibatalkan'])) {
                // Cek apakah ada booking aktif lain untuk mobil ini
                $hasActiveBookings = Booking::where('car_unit_id', $booking->car_unit_id)
                    ->where('id', '!=', $booking->id)
                    ->whereIn('status', ['pending', 'menunggu pembayaran', 'disetujui', 'berjalan'])
                    ->exists();
                    
                if (!$hasActiveBookings) {
                    $booking->carUnit->update(['status' => 'available']);
                }
            }
        };

        static::created(function ($booking) use ($syncCarUnitStatus) {
            $syncCarUnitStatus($booking);
        });

        static::updated(function ($booking) use ($syncCarUnitStatus) {
            // Update car unit status
            if ($booking->isDirty('status') || $booking->isDirty('car_unit_id')) {
                // Free up old unit if changed
                $originalUnitId = $booking->getOriginal('car_unit_id');
                if ($originalUnitId && $originalUnitId !== $booking->car_unit_id) {
                    $hasActive = Booking::where('car_unit_id', $originalUnitId)
                        ->where('id', '!=', $booking->id)
                        ->whereIn('status', ['pending', 'menunggu pembayaran', 'disetujui', 'berjalan'])
                        ->exists();
                    if (!$hasActive) {
                        \App\Models\CarUnit::find($originalUnitId)?->update(['status' => 'available']);
                    }
                }
                $syncCarUnitStatus($booking);
            }

            // Update driver status
            if ($booking->isDirty('driver_id') || $booking->isDirty('status')) {
                $originalDriverId = $booking->getOriginal('driver_id');
                if ($originalDriverId && $originalDriverId !== $booking->driver_id) {
                    \App\Models\Driver::find($originalDriverId)?->update(['status' => 'available']);
                }
                if ($booking->driver_id && in_array($booking->status, ['disetujui', 'berjalan'])) {
                    $booking->driver->update(['status' => 'busy']);
                }
                if ($booking->driver_id && in_array($booking->status, ['selesai', 'dibatalkan'])) {
                    $booking->driver->update(['status' => 'available']);
                }
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function carUnit()
    {
        return $this->belongsTo(CarUnit::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function promoCode()
    {
        return $this->belongsTo(PromoCode::class);
    }

    public function addons()
    {
        return $this->belongsToMany(Addon::class, 'booking_addons')->withPivot('price')->withTimestamps();
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function inspections()
    {
        return $this->hasMany(VehicleInspection::class);
    }

    public function extensions()
    {
        return $this->hasMany(BookingExtension::class);
    }

    public function branch()
    {
        return $this->belongsTo(\App\Models\Branch::class);
    }

    /**
     * Check apakah booking bisa diperpanjang
     */
    public function canExtend(): bool
    {
        return in_array($this->status, ['disetujui', 'berjalan'])
            && !$this->extensions()->where('status', 'pending')->exists();
    }

    public function cancelledByAdmin()
    {
        return $this->belongsTo(User::class, 'cancelled_by_user_id');
    }

    /**
     * Calculate refund percentage dengan logika komprehensif
     * Categories: exception, force_majeure, damage, normal
     */
    public function calculateRefundPercentage(?Carbon $cancelledAt = null, ?string $category = null): int
    {
        // Jika admin override
        if ($this->refund_override && $this->refund_percentage !== null) {
            return $this->refund_percentage;
        }

        $category = $category ?? $this->cancel_category;

        // Force Majeure: Selalu 100%
        if ($category === 'force_majeure') {
            return 100;
        }

        // Exception: Selalu 100%
        if ($category === 'exception') {
            return 100;
        }

        // Damage: Perlu admin decision
        if ($category === 'damage') {
            if ($this->insurance_claimed) {
                return 100;
            }
            if ($this->is_customer_fault) {
                return 0;
            }
            return 50;
        }

        // Normal: berdasarkan timing
        $cancelDate = $cancelledAt ?? now();
        $pickupDate = $this->start_date;
        $daysUntilPickup = $cancelDate->diffInDays($pickupDate);

        if ($daysUntilPickup > 7) {
            return 100;
        } elseif ($daysUntilPickup >= 3) {
            return 50;
        } else {
            return 0;
        }
    }

    /**
     * Calculate refund amount berdasarkan percentage
     */
    public function calculateRefundAmount($refundPercentage = null): float
    {
        if ($refundPercentage === null) {
            $refundPercentage = $this->calculateRefundPercentage();
        }

        return ($this->total_price * $refundPercentage) / 100;
    }

    /**
     * Get refund policy info sebagai string
     */
    public function getRefundPolicyInfo(): string
    {
        $daysUntilPickup = now()->diffInDays($this->start_date);

        if ($daysUntilPickup > 7) {
            return "Refund 100% (Pembatalan > 7 hari sebelum pickup)";
        } elseif ($daysUntilPickup >= 3) {
            return "Refund 50% (Pembatalan 3-7 hari sebelum pickup)";
        } else {
            return "Refund 0% (Pembatalan < 3 hari sebelum pickup)";
        }
    }

    /**
     * Cancel booking dengan auto refund calculation
     */
    public function cancelBooking(
        string $reason,
        string $category = 'normal',
        ?int $userId = null,
        ?string $refundMethod = 'bank_transfer',
        $damageData = null
    ): void
    {
        $status = $category === 'damage' ? 'pending_review' : 'dibatalkan';
        $refundPercentage = $this->calculateRefundPercentage(null, $category);
        $refundAmount = $this->calculateRefundAmount($refundPercentage);

        $data = [
            'status' => $status,
            'cancel_category' => $category,
            'cancelled_reason' => $reason,
            'cancelled_at' => now(),
            'cancelled_by_user_id' => $userId,
            'refund_percentage' => $refundPercentage,
            'refund_amount' => $refundAmount,
            'refund_method' => $refundMethod,
        ];

        if ($category === 'damage' && $damageData) {
            $data['is_customer_fault'] = $damageData['is_customer_fault'] ?? null;
            $data['damage_description'] = $damageData['damage_description'] ?? null;
            $data['insurance_claimed'] = $damageData['insurance_claimed'] ?? false;
        }

        $this->update($data);
        $this->notifyCustomerCancellation($status, $refundAmount);
    }

    /**
     * Check apakah masih bisa cancel berdasarkan cutoff time
     */
    public function canCancel(): bool
    {
        // Jika start_date sudah lewat, tidak bisa dibatalkan
        if (now()->gte($this->start_date)) {
            return false;
        }
        $cutoff = $this->cancel_cutoff_hours ?? 24;
        // diffInHours tanpa parameter kedua (default absolute=true) selalu return nilai positif
        $hoursUntilPickup = now()->diffInHours($this->start_date);
        return $hoursUntilPickup > $cutoff;
    }

    /**
     * Get deadline untuk cancel
     */
    public function getCancelDeadline(): Carbon
    {
        return $this->start_date->subHours($this->cancel_cutoff_hours);
    }

    /**
     * Format refund info untuk display
     */
    public function getRefundSummary(): array
    {
        return [
            'category' => $this->cancel_category,
            'percentage' => ($this->refund_percentage ?? 0) . '%',
            'amount' => 'Rp ' . number_format($this->refund_amount ?? 0, 0, ',', '.'),
            'method' => match($this->refund_method) {
                'wallet_credit' => 'Wallet Credit',
                'bank_transfer' => 'Bank Transfer',
                default => '-'
            },
            'status' => $this->status === 'pending_review' ? 'Menunggu Review Admin' : 'Disetujui',
        ];
    }

    /**
     * Notify customer tentang pembatalan
     */
    public function notifyCustomerCancellation(string $status, float $refundAmount): void
    {
        // TODO: Implement email, SMS, push notification
        // Format pesan sesuai dengan status (dibatalkan atau pending_review)
    }

    /**
     * Approve cancellation dari pending_review
     */
    public function approveCancellation(?int $refundPercentage = null, ?string $refundMethod = null, ?string $overrideReason = null): void
    {
        if ($refundPercentage !== null) {
            $this->refund_percentage = $refundPercentage;
            $this->refund_amount = $this->calculateRefundAmount($refundPercentage);
            $this->refund_override = true;
            $this->override_reason = $overrideReason;
        }

        if ($refundMethod) {
            $this->refund_method = $refundMethod;
        }

        $this->status = 'dibatalkan';
        $this->save();
        $this->notifyCustomerCancellation('dibatalkan', $this->refund_amount);
    }

    /**
     * Reject cancellation dari pending_review
     */
    public function rejectCancellation(string $reason): void
    {
        $this->status = 'disetujui';
        $this->cancel_category = null;
        $this->cancelled_reason = null;
        $this->cancelled_at = null;
        $this->cancelled_by_user_id = null;
        $this->refund_percentage = null;
        $this->refund_amount = null;
        $this->save();
    }
}
