<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Car;
use App\Models\CarUnit;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FleetAnalyticsWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 4;

    protected function getStats(): array
    {
        $totalUnits = CarUnit::count();
        $rentedUnits = CarUnit::where('status', 'rented')->count();
        $maintenanceUnits = CarUnit::where('status', 'maintenance')->count();
        $availableUnits = CarUnit::where('status', 'available')->count();

        // Fleet utilization rate
        $utilizationRate = $totalUnits > 0 ? round(($rentedUnits / $totalUnits) * 100, 1) : 0;

        // Top performing cars (most booked this month)
        $topCar = Car::withCount(['bookings' => function ($q) {
                $q->whereMonth('created_at', now()->month)
                  ->whereYear('created_at', now()->year);
            }])
            ->orderBy('bookings_count', 'desc')
            ->first();

        // Cancelled bookings this month
        $cancelledThisMonth = Booking::where('status', 'dibatalkan')
            ->whereMonth('cancelled_at', now()->month)
            ->whereYear('cancelled_at', now()->year)
            ->count();

        // Total bookings this month
        $totalThisMonth = Booking::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $cancelRate = $totalThisMonth > 0 ? round(($cancelledThisMonth / $totalThisMonth) * 100, 1) : 0;

        // Pending refunds
        $pendingRefunds = Booking::where('status', 'pending_review')->count();

        // Revenue this month vs last month
        $revenueThisMonth = Booking::whereIn('status', ['disetujui', 'berjalan', 'selesai'])
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_price');

        $revenueLastMonth = Booking::whereIn('status', ['disetujui', 'berjalan', 'selesai'])
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->sum('total_price');

        $revenueGrowth = $revenueLastMonth > 0
            ? round((($revenueThisMonth - $revenueLastMonth) / $revenueLastMonth) * 100, 1)
            : 0;

        return [
            Stat::make('🚗 Utilisasi Armada', $utilizationRate . '%')
                ->description("{$rentedUnits} disewa | {$availableUnits} tersedia | {$maintenanceUnits} servis")
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color($utilizationRate >= 70 ? 'success' : ($utilizationRate >= 40 ? 'warning' : 'danger')),

            Stat::make('📅 Revenue Bulan Ini', 'Rp ' . number_format($revenueThisMonth, 0, ',', '.'))
                ->description($revenueGrowth >= 0 ? "↑ {$revenueGrowth}% vs bulan lalu" : "↓ " . abs($revenueGrowth) . "% vs bulan lalu")
                ->descriptionIcon($revenueGrowth >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($revenueGrowth >= 0 ? 'success' : 'danger'),

            Stat::make('⭐ Mobil Terpopuler', $topCar ? "{$topCar->brand} {$topCar->name}" : 'Belum ada data')
                ->description($topCar ? "{$topCar->bookings_count} pesanan bulan ini" : '-')
                ->descriptionIcon('heroicon-m-star')
                ->color('primary'),

            Stat::make('🔁 Pembatalan Bulan Ini', "{$cancelledThisMonth} pesanan")
                ->description("Tingkat cancel: {$cancelRate}% | ⏳ Refund pending: {$pendingRefunds}")
                ->descriptionIcon('heroicon-m-x-circle')
                ->color($cancelRate > 10 ? 'danger' : ($cancelRate > 5 ? 'warning' : 'success')),
        ];
    }
}
