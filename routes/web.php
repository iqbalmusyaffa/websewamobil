<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/cars', [FrontController::class, 'cars'])->name('cars.index');
Route::get('/cars/{car}', [FrontController::class, 'show'])->name('cars.show');
Route::get('/about', [FrontController::class, 'about'])->name('about');
Route::get('/faq', [FrontController::class, 'faq'])->name('faq');
Route::get('/contact', [FrontController::class, 'contact'])->name('contact');
Route::get('/career', [FrontController::class, 'career'])->name('career');
Route::get('/career/{job}', [FrontController::class, 'careerShow'])->name('career.show');
Route::get('/blog', [FrontController::class, 'blog'])->name('blog');
Route::get('/blog/{post}', [FrontController::class, 'blogShow'])->name('blog.show');
Route::get('/privacy-policy', [FrontController::class, 'privacy'])->name('privacy');
Route::get('/terms', [FrontController::class, 'terms'])->name('terms');
Route::get('/promos', [FrontController::class, 'promos'])->name('promos.index');
Route::get('/cabang', [FrontController::class, 'cabangIndex'])->name('cabang.index');
Route::get('/cabang/{slug}', [FrontController::class, 'cabang'])->name('cabang.show');
Route::get('/sitemap', [FrontController::class, 'sitemap'])->name('sitemap');

// AJAX: promo code check (allow both guest and auth)
Route::post('/promo/check', [FrontController::class, 'checkPromo'])->name('promo.check');

// AJAX: check unit availability
Route::post('/api/check-availability', [FrontController::class, 'checkAvailability'])->name('api.check-availability');
Route::get('/invoice/{booking}/validate', [FrontController::class, 'validateInvoice'])->name('invoice.validate');

// Validasi Dokumen Umum
Route::get('/validasi-dokumen', [FrontController::class, 'validationForm'])->name('validation.form');
Route::post('/validasi-dokumen', [FrontController::class, 'processValidation'])->name('validation.process');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [FrontController::class, 'dashboard'])->name('dashboard');

    // Booking
    Route::get('/checkout/{car}', [FrontController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/{car}', [FrontController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/bookings', [FrontController::class, 'bookings'])->name('bookings.index');
    Route::get('/bookings/{booking}', [FrontController::class, 'bookingDetail'])->name('bookings.show');
    Route::post('/bookings/{booking}/review', [FrontController::class, 'submitReview'])->name('bookings.review');
    Route::put('/bookings/{booking}/cancel', [FrontController::class, 'cancelBooking'])->name('bookings.cancel');
    Route::get('/bookings/{booking}/extend', [FrontController::class, 'extendBooking'])->name('bookings.extend');
    Route::post('/bookings/{booking}/extend', [FrontController::class, 'processExtension'])->name('bookings.extend.process');

    // Payment
    Route::get('/payment/{booking}', [\App\Http\Controllers\PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment/{booking}/manual', [\App\Http\Controllers\PaymentController::class, 'manual'])->name('payment.manual');

    // Wishlist
    Route::get('/wishlist', [FrontController::class, 'wishlist'])->name('wishlist');
    Route::post('/wishlist/{car}/toggle', [FrontController::class, 'toggleWishlist'])->name('wishlist.toggle');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/extend-card', [ProfileController::class, 'extendMemberCard'])->name('profile.extend-member-card');
    
    // Wallet
    Route::post('/wallet/withdraw', [FrontController::class, 'withdrawWallet'])->name('wallet.withdraw');

    // Activity Log
    Route::get('/activity-log', [FrontController::class, 'activityLog'])->name('activity-log');

    // Documents
    Route::get('/documents', [FrontController::class, 'documents'])->name('documents.index');
    Route::post('/documents', [FrontController::class, 'storeDocuments'])->name('documents.store');

    // Invoice
    Route::get('/bookings/{booking}/invoice', [FrontController::class, 'invoicePrint'])->name('bookings.invoice');
    Route::get('/admin/bookings/{booking}/invoice', [\App\Http\Controllers\AdminInvoiceController::class, 'download'])->name('admin.invoice.download');

    // Notifications
    Route::post('/notifications/read-all', function() {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    })->name('notifications.read-all');
});

require __DIR__.'/auth.php';

// Google OAuth Routes
Route::get('/auth/google/redirect', [\App\Http\Controllers\Auth\GoogleAuthController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [\App\Http\Controllers\Auth\GoogleAuthController::class, 'callback'])->name('google.callback');

// Midtrans Webhook
Route::post('/api/midtrans-callback', [\App\Http\Controllers\PaymentController::class, 'callback']);
