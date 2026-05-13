<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarUnit extends Model
{
    protected $guarded = [];

    protected $casts = [
        'locked_by' => 'integer',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function lockedByAdmin()
    {
        return $this->belongsTo(User::class, 'locked_by');
    }

    public function maintenanceLogs()
    {
        return $this->hasMany(MaintenanceLog::class);
    }

    public function isLocked(): bool
    {
        return $this->status === 'maintenance' && $this->locked_by !== null;
    }

    public function isAvailableForCustomer(): bool
    {
        return $this->status === 'available' && !$this->isLocked();
    }

    /**
     * Cek apakah unit tersedia pada range tanggal tertentu
     */
    public function isAvailableOnDateRange($startDate, $endDate): bool
    {
        if (!$this->isAvailableForCustomer()) {
            return false;
        }

        return !$this->bookings()
            ->where(function ($q) use ($startDate, $endDate) {
                $q->whereBetween('start_date', [$startDate, $endDate])
                  ->orWhereBetween('end_date', [$startDate, $endDate])
                  ->orWhere(function ($q) use ($startDate, $endDate) {
                      $q->where('start_date', '<=', $startDate)
                        ->where('end_date', '>=', $endDate);
                  });
            })
            ->where('status', '!=', 'dibatalkan')
            ->where('status', '!=', 'selesai')
            ->exists();
    }

    /**
     * Cari tanggal terdekat berikutnya di mana unit ini tersedia
     */
    public function findNextAvailableDate($fromDate, $carId): ?array
    {
        $dateToCheck = clone $fromDate;
        $maxDaysToCheck = 30; // Cari 30 hari ke depan

        for ($i = 0; $i < $maxDaysToCheck; $i++) {
            $endDate = (clone $dateToCheck)->addDay();

            if (!$this->bookings()
                ->where(function ($q) use ($dateToCheck, $endDate) {
                    $q->whereBetween('start_date', [$dateToCheck, $endDate])
                      ->orWhereBetween('end_date', [$dateToCheck, $endDate])
                      ->orWhere(function ($q) use ($dateToCheck, $endDate) {
                          $q->where('start_date', '<=', $dateToCheck)
                            ->where('end_date', '>=', $endDate);
                      });
                })
                ->where('status', '!=', 'dibatalkan')
                ->where('status', '!=', 'selesai')
                ->exists()) {

                return [
                    'start_date' => $dateToCheck->format('Y-m-d'),
                    'end_date' => $endDate->format('Y-m-d'),
                    'formatted' => $dateToCheck->translatedFormat('d M Y') . ' - ' . $endDate->translatedFormat('d M Y'),
                ];
            }

            $dateToCheck->addDay();
        }

        return null;
    }
}
