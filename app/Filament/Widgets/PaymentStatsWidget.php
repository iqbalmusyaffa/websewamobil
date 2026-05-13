<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PaymentStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalRevenue = Booking::whereNotNull('status')
            ->whereIn('status', ['disetujui', 'berjalan', 'selesai'])
            ->sum('total_price');

        $pendingPayments = Booking::where('status', 'menunggu pembayaran')->count();
        $pendingProof = Booking::where('payment_method', 'transfer_manual')
            ->where('status', 'pending')
            ->count();

        $transferPayments = Booking::where('payment_method', 'transfer_manual')
            ->whereIn('status', ['disetujui', 'berjalan', 'selesai'])
            ->sum('total_price');

        return [
            Stat::make('💰 Total Pendapatan', 'Rp ' . number_format($totalRevenue, 0, ',', '.'))
                ->description('Dari semua metode pembayaran')
                ->color('success'),

            Stat::make('💳 Menunggu Pembayaran', $pendingPayments . ' pesanan')
                ->description('Belum ada bukti transfer')
                ->color('warning'),

            Stat::make('⏳ Perlu Verifikasi', $pendingProof . ' pesanan')
                ->description('Transfer manual dengan bukti')
                ->color('info'),

            Stat::make('🏦 Total Transfer Manual', 'Rp ' . number_format($transferPayments, 0, ',', '.'))
                ->description('Dari transfer manual terverifikasi')
                ->color('primary'),
        ];
    }
}
