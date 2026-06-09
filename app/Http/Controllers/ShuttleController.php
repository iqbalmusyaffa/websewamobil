<?php

namespace App\Http\Controllers;

use App\Models\ShuttleRoute;
use App\Models\ShuttleBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ShuttleController extends Controller
{
    public function index(Request $request)
    {
        $query = ShuttleRoute::where('is_active', true);

        if ($request->filled('origin')) {
            $query->where('origin_city', 'like', '%' . $request->origin . '%');
        }

        if ($request->filled('destination')) {
            $query->where('destination_city', 'like', '%' . $request->destination . '%');
        }

        $routes = $query->get();
        return view('front.shuttle.index', compact('routes'));
    }

    public function checkout(ShuttleRoute $route)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk memesan tiket Shuttle.');
        }

        // Find branches that match the origin city
        $originCity = trim(str_ireplace(['Kota', 'Kabupaten'], '', $route->origin_city));
        $pickupBranches = \App\Models\Branch::active()->where('city', 'like', '%' . $originCity . '%')->get();

        // Find branches that match the destination city
        $destCity = trim(str_ireplace(['Kota', 'Kabupaten'], '', $route->destination_city));
        $dropoffBranches = \App\Models\Branch::active()->where('city', 'like', '%' . $destCity . '%')->get();

        $freeMeals = \App\Models\MealMenu::where('is_active', true)->where('is_premium', false)->get();
        $premiumMeals = \App\Models\MealMenu::where('is_active', true)->where('is_premium', true)->get();

        return view('front.shuttle.checkout', compact('route', 'pickupBranches', 'dropoffBranches', 'freeMeals', 'premiumMeals'));
    }

    public function getBookedSeats(Request $request)
    {
        $request->validate([
            'route_id' => 'required|exists:shuttle_routes,id',
            'travel_date' => 'required|date',
        ]);

        $bookings = ShuttleBooking::where('shuttle_route_id', $request->route_id)
            ->where('travel_date', $request->travel_date)
            ->where('status', '!=', 'cancelled')
            ->get();

        $bookedSeats = [];
        foreach ($bookings as $booking) {
            if (is_array($booking->seat_numbers)) {
                $bookedSeats = array_merge($bookedSeats, $booking->seat_numbers);
            }
        }

        return response()->json([
            'booked_seats' => array_values(array_unique($bookedSeats))
        ]);
    }

    public function store(Request $request, ShuttleRoute $route)
    {
        $request->validate([
            'travel_date' => 'required|date|after_or_equal:today',
            'seat_numbers' => 'required|string',
            'pickup_address' => 'required|string',
            'pickup_lat' => 'nullable|numeric',
            'pickup_lng' => 'nullable|numeric',
            'dropoff_address' => 'required|string',
            'dropoff_lat' => 'nullable|numeric',
            'dropoff_lng' => 'nullable|numeric',
            'include_snack' => 'nullable|boolean',
            'include_meal' => 'nullable|boolean',
            'meal_upgrade' => 'nullable|boolean',
        ]);

        $seatNumbers = json_decode($request->seat_numbers, true);
        if (!is_array($seatNumbers) || empty($seatNumbers)) {
            return back()->withInput()->with('error', 'Silakan pilih setidaknya satu kursi.');
        }

        $quantity = count($seatNumbers);

        // Verify if any selected seat is already booked
        $existingBookings = ShuttleBooking::where('shuttle_route_id', $route->id)
            ->where('travel_date', $request->travel_date)
            ->where('status', '!=', 'cancelled')
            ->get();

        $bookedSeats = [];
        foreach ($existingBookings as $b) {
            if (is_array($b->seat_numbers)) {
                $bookedSeats = array_merge($bookedSeats, $b->seat_numbers);
            }
        }

        $conflicts = array_intersect($seatNumbers, $bookedSeats);
        if (!empty($conflicts)) {
            return back()->withInput()->with('error', 'Maaf, kursi nomor ' . implode(', ', $conflicts) . ' baru saja dipesan orang lain. Silakan pilih kursi lain.');
        }

        // Cek ketersediaan kursi
        if ($route->availableSeats($request->travel_date) < $quantity) {
            return back()->withInput()->with('error', 'Maaf, sisa kursi tidak mencukupi untuk tanggal tersebut (Sold Out).');
        }

        $basePrice = $route->base_price;
        $snackPrice = 0; // Free
        $mealPrice = $request->has('meal_upgrade') ? 30000 : 0;
        
        // Harga dikali kuantitas
        $totalPrice = ($basePrice + $snackPrice + $mealPrice) * $quantity;

        $booking = ShuttleBooking::create([
            'booking_code' => 'SH-' . strtoupper(uniqid()),
            'user_id' => Auth::id(),
            'shuttle_route_id' => $route->id,
            'travel_date' => $request->travel_date,
            'quantity' => $quantity,
            'seat_numbers' => $seatNumbers,
            'pickup_address' => $request->pickup_address,
            'pickup_lat' => $request->pickup_lat,
            'pickup_lng' => $request->pickup_lng,
            'dropoff_address' => $request->dropoff_address,
            'dropoff_lat' => $request->dropoff_lat,
            'dropoff_lng' => $request->dropoff_lng,
            'include_snack' => $request->has('include_snack'),
            'include_meal' => $request->has('include_meal'),
            'meal_upgrade' => $request->has('meal_upgrade'),
            'meal_name' => $request->meal_name,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        // Meneruskan ke halaman pembayaran (meminjam PaymentController manual payment atau view custom)
        // Untuk sementara kita arahkan ke halaman sukses/menunggu pembayaran
        return redirect()->route('shuttle.payment', $booking->booking_code);
    }
    
    public function show($booking_code)
    {
        $booking = ShuttleBooking::where('booking_code', $booking_code)->with('route')->firstOrFail();
        if ($booking->user_id !== Auth::id()) abort(403);
        
        return view('front.shuttle.show', compact('booking'));
    }

    public function printThermal($booking_code)
    {
        $booking = ShuttleBooking::where('booking_code', $booking_code)->with(['route', 'user'])->firstOrFail();
        if ($booking->user_id !== Auth::id() && !auth()->user()->is_admin) abort(403);

        return view('front.shuttle.print', compact('booking'));
    }

    public function downloadPdf($booking_code)
    {
        $booking = ShuttleBooking::where('booking_code', $booking_code)->with(['route', 'user'])->firstOrFail();
        if ($booking->user_id !== Auth::id() && !auth()->user()->is_admin) abort(403);

        $html = \Illuminate\Support\Facades\View::make('front.shuttle.pdf', compact('booking'))->render();

        $dompdf = new \Dompdf\Dompdf();
        
        $options = new \Dompdf\Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        $dompdf->setOptions($options);
        
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream("Tiket_Shuttle_{$booking->booking_code}.pdf", [
            "Attachment" => true
        ]);
    }

    public function payment($booking_code)
    {
        $booking = ShuttleBooking::where('booking_code', $booking_code)->firstOrFail();
        if ($booking->user_id !== Auth::id()) abort(403);
        
        // Generate Snap Token if not exists and status is unpaid/pending
        if (!$booking->snap_token && in_array($booking->payment_status, ['unpaid', 'pending'])) {
            try {
                \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
                \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
                \Midtrans\Config::$isSanitized = config('services.midtrans.is_sanitized');
                \Midtrans\Config::$is3ds = config('services.midtrans.is_3ds');

                $params = [
                    'transaction_details' => [
                        'order_id' => 'SHT-' . $booking->id . '-' . time(),
                        'gross_amount' => $booking->total_price,
                    ],
                    'customer_details' => [
                        'first_name' => auth()->user()->name,
                        'email' => auth()->user()->email,
                        'phone' => auth()->user()->phone ?? '081111111111',
                    ],
                    'item_details' => [
                        [
                            'id' => 'SHT-' . $booking->id,
                            'price' => $booking->total_price,
                            'quantity' => 1,
                            'name' => substr('Travel Shuttle (' . \Carbon\Carbon::parse($booking->travel_date)->format('d M') . ')', 0, 50),
                        ]
                    ]
                ];

                $snapToken = \Midtrans\Snap::getSnapToken($params);
                $booking->update([
                    'snap_token' => $snapToken
                ]);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Midtrans Error (Shuttle): ' . $e->getMessage());
                session()->flash('error', 'Layanan pembayaran otomatis saat ini sedang gangguan. Anda dapat memilih metode Manual atau Tunai.');
            }
        }

        return view('front.shuttle.payment', compact('booking'));
    }

    public function manualPayment(Request $request, $booking_code)
    {
        $booking = ShuttleBooking::where('booking_code', $booking_code)->firstOrFail();
        if ($booking->user_id !== Auth::id()) abort(403);

        $validated = $request->validate([
            'payment_method' => 'required|in:tunai,transfer_manual',
            'selected_bank' => 'nullable|in:mandiri,bni,bca,bri',
            'proof_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'proof_link' => 'nullable|url'
        ]);

        // Handle proof image upload
        $proofImagePath = null;
        if ($request->hasFile('proof_image') && $request->file('proof_image')->isValid()) {
            $file = $request->file('proof_image');
            $filename = 'transfer-proof-sht-' . $booking->id . '-' . time() . '.' . $file->getClientOriginalExtension();
            $proofImagePath = $file->storeAs('transfer-proofs', $filename, 'public');
        }

        // Update booking with payment details and proof
        $booking->update([
            'payment_method' => $validated['payment_method'],
            'payment_status' => 'unpaid',
            'status' => 'pending',
            'snap_token' => null,
            'proof_image' => $proofImagePath,
            'proof_link' => $validated['proof_link'] ?? null
        ]);

        $message = $validated['payment_method'] == 'tunai' 
            ? 'Anda memilih bayar tunai. Silakan lakukan pembayaran saat di lokasi jemput.'
            : 'Bukti transfer berhasil diunggah. Menunggu konfirmasi admin.';

        return redirect()->route('shuttle.payment', $booking->booking_code)->with('success', $message);
    }
}
