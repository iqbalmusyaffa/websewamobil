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
        Schema::table('airport_zones', function (Blueprint $table) {
            $table->dropColumn([
                'province_id', 'province_name', 
                'city_id', 'city_name', 
                'district_id', 'district_name'
            ]);
        });

        Schema::create('airport_zone_areas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('airport_zone_id')->constrained()->cascadeOnDelete();
            $table->string('province_id');
            $table->string('province_name');
            $table->string('city_id');
            $table->string('city_name');
            $table->string('district_id')->nullable();
            $table->string('district_name')->nullable();
            $table->decimal('discount_amount', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airport_zone_areas');

        Schema::table('airport_zones', function (Blueprint $table) {
            $table->string('province_id')->nullable();
            $table->string('province_name')->nullable();
            $table->string('city_id')->nullable();
            $table->string('city_name')->nullable();
            $table->string('district_id')->nullable();
            $table->string('district_name')->nullable();
        });
    }
};
