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
        Schema::table('airport_bookings', function (Blueprint $table) {
            $table->string('proof_image')->nullable()->after('snap_token');
            $table->string('proof_link')->nullable()->after('proof_image');
        });
        
        // Update enum using DB statement
        DB::statement("ALTER TABLE airport_bookings MODIFY payment_method ENUM('transfer', 'transfer_manual', 'tunai', 'cash', 'whatsapp', 'midtrans') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('airport_bookings', function (Blueprint $table) {
            $table->dropColumn(['proof_image', 'proof_link']);
        });
    }
};
