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
            $table->decimal('deposit_amount', 12, 2)->default(0)->after('total_price');
            $table->enum('deposit_status', ['pending', 'held', 'refunded', 'forfeited'])->default('pending')->after('deposit_amount');
            $table->dateTime('deposit_refund_date')->nullable()->after('deposit_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['deposit_amount', 'deposit_status', 'deposit_refund_date']);
        });
    }
};
