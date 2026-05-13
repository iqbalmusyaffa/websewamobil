<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$units = \App\Models\CarUnit::all();
$count = 0;
foreach($units as $unit) {
    $hasActive = \App\Models\Booking::where('car_unit_id', $unit->id)
        ->whereIn('status', ['pending', 'menunggu pembayaran', 'disetujui', 'berjalan'])
        ->exists();
    if ($hasActive && $unit->status !== 'rented') {
        $unit->update(['status' => 'rented']);
        echo 'Updated unit ' . $unit->id . " to rented\n";
        $count++;
    } elseif (!$hasActive && $unit->status === 'rented') {
        $unit->update(['status' => 'available']);
        echo 'Updated unit ' . $unit->id . " to available\n";
        $count++;
    }
}
echo "Total updated: " . $count . "\n";
