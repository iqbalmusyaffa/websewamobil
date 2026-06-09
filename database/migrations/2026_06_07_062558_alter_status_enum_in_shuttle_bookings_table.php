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
        DB::statement("ALTER TABLE shuttle_bookings MODIFY status ENUM('pending', 'paid', 'tiket diterima', 'cancelled') DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE shuttle_bookings MODIFY status ENUM('pending', 'paid', 'cancelled') DEFAULT 'pending'");
    }
};
