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
            $table->string('proof_image')->nullable()->after('payment_method')->comment('Path to payment proof image');
            $table->string('proof_link')->nullable()->after('proof_image')->comment('Link to payment proof (screenshot URL)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['proof_image', 'proof_link']);
        });
    }
};
