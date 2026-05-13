<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Car;
use App\Models\Booking;
use App\Models\Addon;
use App\Models\PromoCode;
use App\Models\Review;
use App\Models\Wishlist;
use App\Models\Job;
use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

class FrontController extends Controller
{
    public function index()
    {
        $cars = Car::take(6)->get();
        $promos = PromoCode::where('is_active', true)
            ->where(function($q) {
                $q->whereNull('valid_from')->orWhere('valid_from', '<=', now());
            })
            ->where(function($q) {
                $q->whereNull('valid_until')->orWhere('valid_until', '>=', now());
            })
            ->latest()
            ->take(2)
            ->get();
        return view('front.index', compact('cars', 'promos'));
    }

    public function dashboard()
    {
        $user = Auth::user();

        // Data for dashboard - adjusted for actual status values
        $activeBookingsCount = Booking::where('user_id', $user->id)
            ->whereIn('status', ['disetujui', 'berjalan'])
            ->count();

        // Total completed bookings
        $completedBookingsCount = Booking::where('user_id', $user->id)
            ->where('status', 'selesai')
            ->count();

        $wishlistCount = Wishlist::where('user_id', $user->id)->count();

        $recentBookings = Booking::where('user_id', $user->id)
            ->with('car')
            ->latest()
            ->take(3)
            ->get();

        // My Reviews
        $myReviews = Review::where('user_id', $user->id)
            ->with(['booking', 'car'])
            ->latest()
            ->take(3)
            ->get();

        // Average Rating
        $averageRating = Review::where('user_id', $user->id)->avg('rating') ?? 0;

        // Total Savings from Promo Codes
        $totalSavings = Booking::where('user_id', $user->id)
            ->whereNotNull('promo_code_id')
            ->get()
            ->sum(function($booking) {
                if ($booking->promo_code) {
                    if ($booking->promo_code->type === 'percent') {
                        return ($booking->total_price / (1 - ($booking->promo_code->value / 100))) - $booking->total_price;
                    } else {
                        return $booking->promo_code->value;
                    }
                }
                return 0;
            });

        // Active Promos Today
        $activePromos = PromoCode::where('is_active', true)
            ->where(function($q) {
                $q->whereNull('valid_from')->orWhere('valid_from', '<=', now());
            })
            ->where(function($q) {
                $q->whereNull('valid_until')->orWhere('valid_until', '>=', now());
            })
            ->latest()
            ->take(3)
            ->get();

        // Recommended Cars - Cars with high ratings not rented by user
        $userRentedCarIds = Booking::where('user_id', $user->id)->pluck('car_id')->toArray();
        $recommendedCars = Car::whereNotIn('id', $userRentedCarIds)
            ->withAvg('reviews', 'rating')
            ->orderBy('reviews_avg_rating', 'desc')
            ->take(4)
            ->get();

        // Recent Payments
        $recentPayments = Booking::where('user_id', $user->id)
            ->has('payment')
            ->with('payment')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'activeBookingsCount',
            'completedBookingsCount',
            'wishlistCount',
            'recentBookings',
            'user',
            'myReviews',
            'averageRating',
            'totalSavings',
            'activePromos',
            'recommendedCars',
            'recentPayments'
        ));
    }

    public function cars(Request $request)
    {
        $query = Car::query();

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('brand', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('transmission')) {
            $query->where('transmission', $request->transmission);
        }

        if ($request->filled('capacity')) {
            $query->where('capacity', '>=', $request->capacity);
        }

        if ($request->filled('price_min')) {
            $query->where('price_without_driver', '>=', $request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('price_without_driver', '<=', $request->price_max);
        }

        if ($request->filled('sort')) {
            if ($request->sort == 'price_asc') {
                $query->orderBy('price_without_driver', 'asc');
            } elseif ($request->sort == 'price_desc') {
                $query->orderBy('price_without_driver', 'desc');
            } elseif ($request->sort == 'rating') {
                $query->withCount('reviews')->orderBy('reviews_count', 'desc');
            }
        } else {
            $query->latest();
        }

        $cars = $query->paginate(12)->withQueryString();
        $wishlistIds = Auth::check() ? Wishlist::where('user_id', Auth::id())->pluck('car_id')->toArray() : [];
        return view('front.cars', compact('cars', 'wishlistIds'));
    }

    public function show(Car $car)
    {
        $reviews = $car->reviews()->with('user')->latest()->take(10)->get();
        $avgRating = $car->averageRating();
        $isWishlisted = $car->isWishlisted(Auth::id());
        return view('front.show', compact('car', 'reviews', 'avgRating', 'isWishlisted'));
    }

    public function checkout(Car $car)
    {
        $addons = Addon::where('is_active', true)->get();
        return view('front.checkout', compact('car', 'addons'));
    }

    public function processCheckout(Request $request, Car $car)
    {
        $request->validate([
            'start_date'      => 'required|date|after_or_equal:today',
            'end_date'        => 'required|date|after_or_equal:start_date',
            'pickup_location' => 'required|string',
            'with_driver'     => 'nullable|boolean',
            'promo_code'      => 'nullable|string',
            'addons'          => 'nullable|array',
            'addons.*'        => 'integer|exists:addons,id',
        ]);

        $startDate  = Carbon::parse($request->start_date);
        $endDate    = Carbon::parse($request->end_date);
        $days       = $startDate->diffInDays($endDate) + 1;

        $withDriver = $request->has('with_driver') && $request->with_driver == '1';
        if (!$car->can_lepas_kunci) {
            $withDriver = true;
        }

        $dailyPrice  = $withDriver ? $car->price_with_driver : $car->price_without_driver;
        $basePrice   = $days * $dailyPrice;

        // Add-ons
        $addonAmount = 0;
        $selectedAddons = [];
        if ($request->filled('addons')) {
            $addonModels = Addon::whereIn('id', $request->addons)->where('is_active', true)->get();
            foreach ($addonModels as $addon) {
                $addonPrice   = $addon->price * $days;
                $addonAmount += $addonPrice;
                $selectedAddons[$addon->id] = ['price' => $addonPrice];
            }
        }

        // Promo Code
        $discountAmount = 0;
        $promoCodeId    = null;
        if ($request->filled('promo_code')) {
            $promo = PromoCode::where('code', strtoupper($request->promo_code))->first();
            if ($promo && $promo->isValid()) {
                $discountAmount = $promo->calculateDiscount($basePrice + $addonAmount);
                $promoCodeId    = $promo->id;
                $promo->increment('used_count');
            }
        }

        // Tier Discount
        $tierDiscountAmount = 0;
        $user = Auth::user();
        if ($user->member_tier === 'platinum') {
            $tierDiscountAmount = ($basePrice + $addonAmount) * 0.15;
        } elseif ($user->member_tier === 'gold') {
            $tierDiscountAmount = ($basePrice + $addonAmount) * 0.10;
        } elseif ($user->member_tier === 'silver') {
            $tierDiscountAmount = ($basePrice + $addonAmount) * 0.05;
        }

        // Redeem Points (1 point = Rp 100)
        $pointsDiscountAmount = 0;
        $pointsUsed = 0;
        if ($request->has('redeem_points') && $request->redeem_points == '1') {
            $availablePoints = $user->member_points;
            $currentTotal = max(0, $basePrice + $addonAmount - $discountAmount - $tierDiscountAmount);
            $maxPointsToUse = min($availablePoints, floor($currentTotal / 100));
            if ($maxPointsToUse > 0) {
                $pointsUsed = $maxPointsToUse;
                $pointsDiscountAmount = $pointsUsed * 100;
            }
        }

        $totalPrice = max(0, $basePrice + $addonAmount - $discountAmount - $tierDiscountAmount - $pointsDiscountAmount);

        $booking = Booking::create([
            'user_id'         => Auth::id(),
            'car_id'          => $car->id,
            'start_date'      => $request->start_date,
            'end_date'        => $request->end_date,
            'pickup_location' => $request->pickup_location,
            'with_driver'     => $withDriver,
            'total_price'     => $totalPrice,
            'status'          => 'menunggu pembayaran',
            'promo_code_id'   => $promoCodeId,
            'discount_amount' => $discountAmount,
            'tier_discount_amount' => $tierDiscountAmount,
            'points_discount_amount' => $pointsDiscountAmount,
            'points_used'     => $pointsUsed,
            'addon_amount'    => $addonAmount,
        ]);

        if (!empty($selectedAddons)) {
            $booking->addons()->sync($selectedAddons);
        }

        if ($pointsUsed > 0) {
            $user->redeemPoints($pointsUsed, 'Digunakan untuk Booking #' . $booking->id, $booking->id);
        }

        return redirect()->route('payment.show', $booking->id)->with('success', 'Booking berhasil dibuat. Silakan selesaikan pembayaran.');
    }

    public function bookings()
    {
        $bookings = Booking::where('user_id', Auth::id())->with('car')->orderBy('created_at', 'desc')->get();
        return view('front.bookings', compact('bookings'));
    }

    public function bookingDetail(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) abort(403);
        $booking->load(['car', 'carUnit', 'driver', 'addons', 'promoCode', 'review']);
        return view('front.booking_detail', compact('booking'));
    }

    public function submitReview(Request $request, Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) abort(403);
        if ($booking->status !== 'selesai') abort(403, 'Ulasan hanya bisa diberikan setelah sewa selesai.');
        if ($booking->review) abort(403, 'Anda sudah memberikan ulasan untuk pesanan ini.');

        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Review::create([
            'booking_id' => $booking->id,
            'car_id'     => $booking->car_id,
            'user_id'    => Auth::id(),
            'rating'     => $request->rating,
            'comment'    => $request->comment,
        ]);

        return redirect()->route('bookings.show', $booking->id)->with('success', 'Ulasan berhasil dikirim. Terima kasih!');
    }

    /**
     * Cancel a booking with refund calculation
     */
    public function cancelBooking(Request $request, Booking $booking)
    {
        // Authorization check
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        // Check if booking can be cancelled
        if (!$booking->canCancel()) {
            return back()->with('error', 'Pesanan tidak bisa dibatalkan. Deadline pembatalan sudah lewat.');
        }

        // Validate request
        $request->validate([
            'cancel_category' => 'required|in:normal,exception,force_majeure,damage',
            'cancelled_reason' => 'required|string|min:10',
            'refund_method' => 'required|in:bank_transfer,wallet_credit',
            'is_customer_fault' => 'nullable|boolean',
            'damage_description' => 'nullable|string',
            'insurance_claimed' => 'nullable|boolean',
        ]);

        // Calculate refund
        $refundPercentage = $booking->calculateRefundPercentage(
            $request->cancel_category
        );
        $refundAmount = $booking->calculateRefundAmount($refundPercentage);

        // Determine status (damage requires review)
        $status = $request->cancel_category === 'damage' ? 'pending_review' : 'dibatalkan';

        // Cancel the booking
        $booking->cancelBooking(
            $request->cancelled_reason,
            $request->cancel_category,
            Auth::id(),
            $request->refund_method,
            [
                'is_customer_fault' => $request->boolean('is_customer_fault'),
                'damage_description' => $request->input('damage_description'),
                'insurance_claimed' => $request->boolean('insurance_claimed'),
            ]
        );

        // Set refund amount
        $booking->refund_percentage = $refundPercentage;
        $booking->refund_amount = $refundAmount;
        $booking->status = $status;
        $booking->save();

        $message = $status === 'pending_review'
            ? 'Pembatalan Anda sedang dalam review. Kami akan mengkonfirmasi dalam 1-2 jam kerja.'
            : 'Pesanan berhasil dibatalkan. Refund akan diproses sesuai metode pembayaran yang dipilih.';

        return redirect()->route('bookings.show', $booking->id)->with('success', $message);
    }

    // Wishlist
    public function wishlist()
    {
        $wishlists = Wishlist::where('user_id', Auth::id())->with('car')->latest()->get();
        return view('front.wishlist', compact('wishlists'));
    }

    public function toggleWishlist(Car $car)
    {
        $existing = Wishlist::where('user_id', Auth::id())->where('car_id', $car->id)->first();
        if ($existing) {
            $existing->delete();
            $saved = false;
        } else {
            Wishlist::create(['user_id' => Auth::id(), 'car_id' => $car->id]);
            $saved = true;
        }

        if (request()->expectsJson()) {
            return response()->json(['saved' => $saved]);
        }

        return back()->with('success', $saved ? 'Mobil ditambahkan ke wishlist!' : 'Mobil dihapus dari wishlist.');
    }

    // Promo code check (AJAX)
    public function checkPromo(Request $request)
    {
        $promo = PromoCode::where('code', strtoupper($request->code))->first();
        if (!$promo || !$promo->isValid()) {
            return response()->json(['valid' => false, 'message' => 'Kode promo tidak valid atau sudah kedaluwarsa.']);
        }
        return response()->json([
            'valid'      => true,
            'type'       => $promo->type,
            'value'      => $promo->value,
            'max_discount' => $promo->max_discount,
            'min_booking'  => $promo->min_booking,
            'description'  => $promo->description,
        ]);
    }

    // Check unit availability (AJAX)
    public function checkAvailability(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $carId = $request->car_id;
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // Count available units for this car on these dates
        $availableCount = \App\Models\CarUnit::where('car_id', $carId)
            ->where(function ($q) {
                $q->where('status', '!=', 'maintenance')
                  ->orWhere(function ($q) {
                      $q->where('status', '=', 'maintenance')
                        ->where('locked_by', null);
                  });
            })
            ->whereDoesntHave('bookings', function ($q) use ($startDate, $endDate) {
                $q->where(function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('start_date', [$startDate, $endDate])
                      ->orWhereBetween('end_date', [$startDate, $endDate])
                      ->orWhere(function ($q) use ($startDate, $endDate) {
                          $q->where('start_date', '<=', $startDate)
                            ->where('end_date', '>=', $endDate);
                      });
                })->where('status', '!=', 'dibatalkan')->where('status', '!=', 'selesai');
            })
            ->count();

        // If available, return success
        if ($availableCount > 0) {
            return response()->json([
                'available' => true,
                'available_count' => $availableCount,
                'message' => "✅ Ada {$availableCount} unit yang tersedia untuk periode ini."
            ]);
        }

        // If not available, find alternative dates
        $startDateParsed = Carbon::parse($startDate);
        $suggestions = [];
        $dateToCheck = clone $startDateParsed;

        // Get first available unit to check dates
        $firstUnit = \App\Models\CarUnit::where('car_id', $carId)
            ->where(function ($q) {
                $q->where('status', '!=', 'maintenance')
                  ->orWhere(function ($q) {
                      $q->where('status', '=', 'maintenance')
                        ->where('locked_by', null);
                  });
            })
            ->first();

        if ($firstUnit) {
            for ($i = 0; $i < 5; $i++) {
                $nextAvailable = $firstUnit->findNextAvailableDate($dateToCheck, $carId);
                if ($nextAvailable) {
                    $suggestions[] = $nextAvailable;
                    $dateToCheck = Carbon::parse($nextAvailable['end_date'])->addDay();
                }
            }
        }

        return response()->json([
            'available' => false,
            'available_count' => 0,
            'message' => "❌ Maaf, semua unit sudah terboking untuk periode ini.",
            'suggestions' => $suggestions,
        ]);
    }

    public function about()
    {
        return view('front.about');
    }

    public function faq()
    {
        return view('front.faq');
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function career()
    {
        $jobs = Job::where('status', 'Open')->get();
        return view('front.career', compact('jobs'));
    }

    public function careerShow(Job $job)
    {
        $job->increment('views');
        $otherJobs = Job::where('status', 'Open')
            ->where('id', '!=', $job->id)
            ->limit(3)
            ->get();
        return view('front.career_detail', compact('job', 'otherJobs'));
    }

    public function blog(Request $request)
    {
        $query = BlogPost::where('status', 'Published')->orderBy('published_at', 'desc');

        if ($request->has('category') && !empty($request->category)) {
            $query->where('category', $request->category);
        }

        $posts = $query->paginate(9);
        $categories = BlogPost::where('status', 'Published')->distinct()->pluck('category')->sort();

        return view('front.blog', compact('posts', 'categories'));
    }

    public function blogShow(BlogPost $post)
    {
        if ($post->status !== 'Published') {
            abort(404);
        }

        $post->increment('views');

        $categories = BlogPost::where('status', 'Published')->distinct()->pluck('category')->sort();
        $relatedPosts = BlogPost::where('status', 'Published')
            ->where('category', $post->category)
            ->where('id', '!=', $post->id)
            ->limit(3)
            ->get();

        return view('front.blog_detail', compact('post', 'categories', 'relatedPosts'));
    }

    public function privacy()
    {
        return view('front.privacy');
    }

    public function terms()
    {
        return view('front.terms');
    }

    public function sitemap()
    {
        return view('front.sitemap');
    }

    public function cabangIndex()
    {
        $branches = \App\Models\Branch::active()->ordered()->get();
        return view('front.cabang-index', compact('branches'));
    }

    public function cabang($slug)
    {
        $branch = \App\Models\Branch::where('slug', $slug)->firstOrFail();
        return view('front.cabang', compact('branch'));
    }

    public function promos()
    {
        // Get active promos (valid_from <= today, valid_until >= today or null)
        $promos = PromoCode::where('is_active', true)
            ->where(function($q) {
                $q->whereNull('valid_from')->orWhere('valid_from', '<=', now());
            })
            ->where(function($q) {
                $q->whereNull('valid_until')->orWhere('valid_until', '>=', now());
            })
            ->latest()
            ->get();

        return view('front.promos', compact('promos'));
    }

    public function documents()
    {
        $user = Auth::user();
        $document = $user->document;

        return view('documents.upload', compact('user', 'document'));
    }

    public function storeDocuments(Request $request)
    {
        $user = Auth::user();
        $document = $user->document ?? new \App\Models\Document();

        $data = [];

        // Handle KTP - file upload
        if ($request->hasFile('ktp_file')) {
            $file = $request->file('ktp_file');
            $path = $file->store('documents/ktp', 'public');
            $data['ktp_path'] = 'storage/' . $path;
        }
        // Handle KTP - URL link
        elseif ($request->filled('ktp_url')) {
            $data['ktp_path'] = $request->input('ktp_url');
        }

        // Handle SIM - file upload
        if ($request->hasFile('sim_file')) {
            $file = $request->file('sim_file');
            $path = $file->store('documents/sim', 'public');
            $data['sim_path'] = 'storage/' . $path;
        }
        // Handle SIM - URL link
        elseif ($request->filled('sim_url')) {
            $data['sim_path'] = $request->input('sim_url');
        }

        // Set status to pending if new upload
        if (!$document->exists) {
            $data['user_id'] = $user->id;
            $data['status'] = 'pending';
        }

        $document->fill($data)->save();

        return redirect()->route('documents.index')->with('success', 'Dokumen berhasil diunggah. Silakan tunggu verifikasi admin.');
    }

    public function invoicePrint(Booking $booking)
    {
        // Check authorization - user can only view their own invoice
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $booking->load('car', 'user', 'addons', 'promoCode');

        // Render view to HTML
        $html = View::make('invoice.pdf', compact('booking'))->render();

        // Create Dompdf instance
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Return PDF as download
        $filename = 'invoice-' . str_pad($booking->id, 5, '0', STR_PAD_LEFT) . '.pdf';
        return response($dompdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    public function validateInvoice(Booking $booking)
    {
        $booking->load('car', 'user', 'carUnit');
        return view('front.invoice_validation', compact('booking'));
    }

    public function validationForm()
    {
        return view('front.validation_form');
    }

    public function processValidation(Request $request)
    {
        $request->validate([
            'invoice_number' => 'required|string'
        ]);

        // Clean up the invoice number (remove '#', spaces, etc)
        $invoiceId = preg_replace('/[^0-9]/', '', $request->invoice_number);
        $booking = Booking::find((int) $invoiceId);

        if (!$booking) {
            return back()->with('error', 'Dokumen tidak ditemukan atau nomor invoice tidak valid.');
        }

        return redirect()->route('invoice.validate', $booking->id);
    }
}
