<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('car_units', function (Blueprint $table) {
            $table->integer('current_odometer')->default(0)->after('status');
            $table->integer('next_service_odometer')->default(10000)->after('current_odometer');
        });
    }

    public function down(): void
    {
        Schema::table('car_units', function (Blueprint $table) {
            $table->dropColumn(['current_odometer', 'next_service_odometer']);
        });
    }
};
