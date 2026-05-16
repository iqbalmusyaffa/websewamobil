<?php

namespace App\Filament\Widgets;

use App\Models\Car;
use Filament\Widgets\ChartWidget;

class TopCarsWidget extends ChartWidget
{
    protected static ?int $sort = 5;
    protected ?string $heading = '🏆 Top 5 Mobil Terpopuler (Bulan Ini)';
    protected ?string $maxHeight = '280px';

    protected function getData(): array
    {
        $topCars = Car::withCount(['bookings' => function ($q) {
                $q->whereMonth('created_at', now()->month)
                  ->whereYear('created_at', now()->year)
                  ->whereIn('status', ['disetujui', 'berjalan', 'selesai', 'menunggu pembayaran']);
            }])
            ->orderBy('bookings_count', 'desc')
            ->take(5)
            ->get();

        $labels = $topCars->map(fn($c) => "{$c->brand} {$c->name}")->toArray();
        $data   = $topCars->pluck('bookings_count')->toArray();

        $colors = [
            'rgba(14, 165, 233, 0.85)',
            'rgba(16, 185, 129, 0.85)',
            'rgba(245, 158, 11, 0.85)',
            'rgba(239, 68, 68, 0.85)',
            'rgba(139, 92, 246, 0.85)',
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pesanan',
                    'data' => $data,
                    'backgroundColor' => $colors,
                    'borderColor' => array_map(fn($c) => str_replace('0.85', '1', $c), $colors),
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'indexAxis' => 'y',
            'plugins' => [
                'legend' => ['display' => false],
            ],
            'scales' => [
                'x' => [
                    'beginAtZero' => true,
                    'title' => [
                        'display' => true,
                        'text' => 'Jumlah Pesanan',
                    ],
                ],
            ],
        ];
    }
}
