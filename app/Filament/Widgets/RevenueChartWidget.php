<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class RevenueChartWidget extends ChartWidget
{
    protected static ?int $sort = 3;
    protected ?string $heading = '📈 Grafik Pendapatan (12 Bulan Terakhir)';
    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $revenueData = [];
        $bookingData = [];
        $labels = [];

        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $labels[] = $month->translatedFormat('M Y');

            $revenue = Booking::whereIn('status', ['disetujui', 'berjalan', 'selesai'])
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->sum('total_price');

            $count = Booking::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();

            $revenueData[] = $revenue / 1000000; // dalam juta rupiah
            $bookingData[] = $count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pendapatan (Juta Rp)',
                    'data' => $revenueData,
                    'backgroundColor' => 'rgba(14, 165, 233, 0.15)',
                    'borderColor' => '#0ea5e9',
                    'borderWidth' => 2,
                    'fill' => true,
                    'tension' => 0.4,
                    'yAxisID' => 'y',
                ],
                [
                    'label' => 'Jumlah Pesanan',
                    'data' => $bookingData,
                    'backgroundColor' => 'rgba(16, 185, 129, 0.15)',
                    'borderColor' => '#10b981',
                    'borderWidth' => 2,
                    'fill' => false,
                    'tension' => 0.4,
                    'yAxisID' => 'y1',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'type' => 'linear',
                    'display' => true,
                    'position' => 'left',
                    'title' => [
                        'display' => true,
                        'text' => 'Pendapatan (Juta Rp)',
                    ],
                ],
                'y1' => [
                    'type' => 'linear',
                    'display' => true,
                    'position' => 'right',
                    'title' => [
                        'display' => true,
                        'text' => 'Jumlah Pesanan',
                    ],
                    'grid' => [
                        'drawOnChartArea' => false,
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                ],
            ],
        ];
    }
}
