<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add car_id to reviews so a review is linked to a car (for display on car page)
        Schema::table('reviews', function (Blueprint $table) {
            $table->foreignId('car_id')->nullable()->after('booking_id')->constrained()->nullOnDelete();
        });

        // Add promo/discount/addon columns to bookings
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreignId('promo_code_id')->nullable()->after('payment_method')->constrained('promo_codes')->nullOnDelete();
            $table->decimal('discount_amount', 12, 2)->default(0)->after('promo_code_id');
            $table->decimal('addon_amount', 12, 2)->default(0)->after('discount_amount');
        });
    }

    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['car_id']);
            $table->dropColumn('car_id');
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['promo_code_id']);
            $table->dropColumn(['promo_code_id', 'discount_amount', 'addon_amount']);
        });
    }
};
