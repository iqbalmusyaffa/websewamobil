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
            // Ubah tipe kolom tanggal ke datetime (jika didukung, jika tidak tambahkan kolom baru)
            $table->dateTime('start_date')->change();
            $table->dateTime('end_date')->change();
            
            // Kolom baru
            $table->dateTime('actual_return_date')->nullable()->after('status');
            $table->decimal('penalty_fee', 12, 2)->default(0)->after('actual_return_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['actual_return_date', 'penalty_fee']);
            
            $table->date('start_date')->change();
            $table->date('end_date')->change();
        });
    }
};
