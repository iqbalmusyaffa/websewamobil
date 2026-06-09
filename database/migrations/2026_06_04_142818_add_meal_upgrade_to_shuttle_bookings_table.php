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
            $table->boolean('meal_upgrade')->default(false)->after('include_meal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shuttle_bookings', function (Blueprint $table) {
            $table->dropColumn('meal_upgrade');
        });
    }
};
