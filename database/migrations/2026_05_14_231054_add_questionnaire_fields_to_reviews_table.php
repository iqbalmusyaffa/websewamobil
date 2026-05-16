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
        Schema::table('reviews', function (Blueprint $table) {
            $table->foreignId('branch_id')->nullable()->constrained()->nullOnDelete();
            
            // Kuesioner Cabang
            $table->integer('service_rating')->nullable()->comment('Pelayanan Cabang 1-5');
            $table->integer('friendliness_rating')->nullable()->comment('Keramahan Staf 1-5');
            
            // Kuesioner Kendaraan
            $table->integer('cleanliness_rating')->nullable()->comment('Kebersihan Kendaraan 1-5');
            $table->integer('comfort_rating')->nullable()->comment('Kenyamanan Kendaraan 1-5');
            $table->integer('car_condition_rating')->nullable()->comment('Kondisi Mesin/Mobil 1-5');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['branch_id']);
            $table->dropColumn([
                'branch_id', 'service_rating', 'friendliness_rating',
                'cleanliness_rating', 'comfort_rating', 'car_condition_rating'
            ]);
        });
    }
};
