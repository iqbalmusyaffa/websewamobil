<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->integer('tier_discount_amount')->default(0)->after('total_price');
            $table->integer('points_discount_amount')->default(0)->after('tier_discount_amount');
            $table->integer('points_used')->default(0)->after('points_discount_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['tier_discount_amount', 'points_discount_amount', 'points_used']);
        });
    }
};
