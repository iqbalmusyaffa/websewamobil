<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function show(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        // If booking already has a snap token and status is waiting
        if (!$booking->snap_token && $booking->status === 'menunggu pembayaran') {
            try {
                \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
                \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
                \Midtrans\Config::$isSanitized = config('services.midtrans.is_sanitized');
                \Midtrans\Config::$is3ds = config('services.midtrans.is_3ds');

                $params = [
                    'transaction_details' => [
                        'order_id' => 'TRX-' . $booking->id . '-' . time(),
                        'gross_amount' => $booking->total_price,
                    ],
                    'customer_details' => [
                        'first_name' => auth()->user()->name,
                        'email' => auth()->user()->email,
                        'phone' => auth()->user()->phone ?? '081111111111',
                    ],
                    'item_details' => [
                        [
                            'id' => 'CAR-' . $booking->car_id,
                            'price' => $booking->total_price,
                            'quantity' => 1,
                            'name' => substr('Sewa ' . $booking->car->name . ' (' . \Carbon\Carbon::parse($booking->start_date)->format('d M') . ')', 0, 50),
                        ]
                    ]
                ];

                $snapToken = \Midtrans\Snap::getSnapToken($params);
                $booking->update([
                    'snap_token' => $snapToken
                ]);
            } catch (\Exception $e) {
                Log::error('Midtrans Error: ' . $e->getMessage());
                session()->flash('error', 'Layanan pembayaran otomatis saat ini sedang gangguan. Anda dapat memilih metode Manual atau Tunai.');
            }
        }

        return view('front.payment', compact('booking'));
    }

    public function callback(Request $request)
    {
        $serverKey = config('services.midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            // Validate order id prefix
            $orderParts = explode('-', $request->order_id);
            if (count($orderParts) >= 2 && $orderParts[0] === 'TRX') {
                $bookingId = $orderParts[1];
                $booking = Booking::find($bookingId);

                if ($booking) {
                    if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                        // Only award points if it was previously not paid
                        if ($booking->payment_status !== 'paid') {
                            $booking->update(['status' => 'disetujui', 'payment_method' => $request->payment_type, 'payment_status' => 'paid']);
                            
                            // Award points (1 point per Rp 10.000)
                            $pointsEarned = floor($booking->total_price / 10000);
                            if ($pointsEarned > 0) {
                                $booking->user->addPoints($pointsEarned, 'Mendapatkan poin dari Booking #' . $booking->id, $booking->id);
                            }
                        }
                    } elseif ($request->transaction_status == 'cancel' || $request->transaction_status == 'deny' || $request->transaction_status == 'expire') {
                        $booking->update(['status' => 'dibatalkan']);
                    }
                }
            }
        }

        return response()->json(['message' => 'Callback received']);
    }

    public function manual(Request $request, Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'payment_method' => 'required|in:tunai,transfer_manual',
            'selected_bank' => 'nullable|in:mandiri,bni,bca,bri',
            'proof_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'proof_link' => 'nullable|url'
        ]);

        // Bank account details
        $bankDetails = [
            'mandiri' => ['name' => 'Mandiri', 'number' => '1234567890', 'accountName' => 'PT AUTORENT INDONESIA'],
            'bni' => ['name' => 'BNI', 'number' => '0987654321', 'accountName' => 'PT AUTORENT INDONESIA'],
            'bca' => ['name' => 'BCA', 'number' => '1122334455', 'accountName' => 'PT AUTORENT INDONESIA'],
            'bri' => ['name' => 'BRI', 'number' => '5566778899', 'accountName' => 'PT AUTORENT INDONESIA'],
        ];

        // Get selected bank info
        $selectedBank = $validated['selected_bank'] ?? 'mandiri';
        $bankInfo = $bankDetails[$selectedBank] ?? $bankDetails['mandiri'];

        // Handle proof image upload
        $proofImagePath = null;
        if ($request->hasFile('proof_image') && $request->file('proof_image')->isValid()) {
            $file = $request->file('proof_image');
            $filename = 'transfer-proof-' . $booking->id . '-' . time() . '.' . $file->getClientOriginalExtension();
            $proofImagePath = $file->storeAs('transfer-proofs', $filename, 'public');
        }

        // Update booking with payment details and proof
        $booking->update([
            'payment_method' => $validated['payment_method'],
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'snap_token' => null,
            'proof_image' => $proofImagePath,
            'proof_link' => $validated['proof_link'] ?? null
        ]);

        if ($validated['payment_method'] == 'tunai') {
            $message = 'Anda memilih bayar tunai. Silakan lakukan pembayaran saat pengambilan kendaraan atau kepada sopir kami.';
        } else {
            $message = 'Transfer Manual - Bank: ' . $bankInfo['name'] . ' | No. Rek: ' . $bankInfo['number'] . ' | Jumlah: Rp ' . number_format($booking->total_price, 0, ',', '.') . '. Konfirmasi via WhatsApp Admin kami.';
        }

        return redirect()->route('bookings.show', $booking)->with('success', $message);
    }
}
