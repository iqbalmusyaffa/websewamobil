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
            $table->string('snap_token')->nullable()->after('payment_status');
        });
        
        // Modify enum using raw SQL
        DB::statement("ALTER TABLE airport_bookings MODIFY payment_method ENUM('transfer', 'cash', 'whatsapp', 'midtrans') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('airport_bookings', function (Blueprint $table) {
            $table->dropColumn('snap_token');
        });
        
        DB::statement("ALTER TABLE airport_bookings MODIFY payment_method ENUM('transfer', 'cash', 'whatsapp') NOT NULL");
    }
};
