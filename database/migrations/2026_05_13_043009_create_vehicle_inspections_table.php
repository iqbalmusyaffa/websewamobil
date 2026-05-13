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
        Schema::create('vehicle_inspections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();
            $table->foreignId('car_unit_id')->constrained()->cascadeOnDelete();
            $table->foreignId('inspector_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('type', ['pre_rental', 'post_rental'])->comment('pre_rental = sebelum disewa, post_rental = setelah dikembalikan');
            $table->string('fuel_level')->default('1/2')->comment('e.g., Empty, 1/4, 1/2, 3/4, Full');
            $table->integer('odometer')->default(0);
            $table->boolean('is_clean_exterior')->default(true);
            $table->boolean('is_clean_interior')->default(true);
            $table->text('exterior_notes')->nullable();
            $table->text('interior_notes')->nullable();
            $table->json('photos')->nullable(); // array of image paths
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_inspections');
    }
};
