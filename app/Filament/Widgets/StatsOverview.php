<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalRevenue = \App\Models\Booking::whereIn('status', ['disetujui', 'berjalan', 'selesai'])->sum('total_price');
        $activeBookings = \App\Models\Booking::whereIn('status', ['menunggu pembayaran', 'disetujui', 'berjalan'])->count();
        $totalCars = \App\Models\Car::count();

        $carsNeedingService = \App\Models\CarUnit::whereColumn('current_odometer', '>=', 'next_service_odometer')->count();
        $carsInUse = \App\Models\CarUnit::where('status', 'rented')->count();

        return [
            Stat::make('Total Pendapatan', 'Rp ' . number_format($totalRevenue, 0, ',', '.'))
                ->description('Total pesanan aktif & selesai')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
                
            Stat::make('Pesanan Aktif', $activeBookings)
                ->description($carsInUse . ' unit sedang di jalan')
                ->descriptionIcon('heroicon-m-clock')
                ->color('primary'),
                
            Stat::make('Waktunya Servis', $carsNeedingService . ' Unit')
                ->description('Mobil mencapai batas Odometer')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color($carsNeedingService > 0 ? 'danger' : 'success'),

            Stat::make('Rata-rata Penilaian', number_format(\App\Models\Review::avg('rating') ?? 0, 1) . ' / 5.0')
                ->description(\App\Models\Review::count() . ' Ulasan masuk')
                ->descriptionIcon('heroicon-m-star')
                ->color('warning'),
        ];
    }
}
