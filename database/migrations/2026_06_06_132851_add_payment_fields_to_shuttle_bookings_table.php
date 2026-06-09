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
        Schema::table('shuttle_bookings', function (Blueprint $table) {
            $table->string('payment_method')->nullable()->after('total_price');
            $table->string('payment_status')->default('unpaid')->after('payment_method');
            $table->string('snap_token')->nullable()->after('payment_status');
            $table->string('proof_image')->nullable()->after('snap_token');
            $table->string('proof_link')->nullable()->after('proof_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shuttle_bookings', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'payment_status', 'snap_token', 'proof_image', 'proof_link']);
        });
    }
};
