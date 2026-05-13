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
            $table->foreignId('driver_id')->nullable()->after('car_unit_id')->constrained('drivers')->nullOnDelete();
            $table->dropColumn(['driver_name', 'driver_phone']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('driver_name')->nullable();
            $table->string('driver_phone')->nullable();
            $table->dropForeignKeyIfExists(['driver_id']);
            $table->dropColumn('driver_id');
        });
    }
};
