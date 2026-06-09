<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$booking = \App\Models\ShuttleBooking::where('booking_code', 'SH-6A24278895B21')->first();
if ($booking) {
    $booking->payment_status = 'paid';
    $booking->status = 'tiket diterima';
    $booking->save();
    echo "Successfully updated booking " . $booking->booking_code . " to paid and tiket diterima.\n";
} else {
    echo "Booking SH-6A24278895B21 not found.\n";
}
