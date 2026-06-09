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
        Schema::table('shuttle_routes', function (Blueprint $table) {
            $table->integer('total_seats')->default(14)->after('base_price');
        });

        Schema::table('shuttle_bookings', function (Blueprint $table) {
            $table->integer('quantity')->default(1)->after('travel_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shuttle_routes', function (Blueprint $table) {
            $table->dropColumn('total_seats');
        });

        Schema::table('shuttle_bookings', function (Blueprint $table) {
            $table->dropColumn('quantity');
        });
    }
};
