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
        Schema::create('shuttle_routes', function (Blueprint $table) {
            $table->id();
            $table->string('origin_city');
            $table->string('destination_city');
            $table->time('departure_time');
            $table->time('arrival_time');
            $table->decimal('base_price', 15, 2);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shuttle_routes');
    }
};
