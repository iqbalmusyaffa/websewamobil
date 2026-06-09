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
        Schema::create('airport_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code')->unique();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            
            // Transfer details
            $table->enum('transfer_type', ['to_airport', 'from_airport']);
            $table->foreignId('airport_id')->constrained()->cascadeOnDelete();
            $table->foreignId('airport_zone_id')->constrained()->cascadeOnDelete();
            $table->foreignId('car_id')->constrained()->cascadeOnDelete();
            
            $table->dateTime('pickup_datetime');
            $table->text('pickup_address');
            $table->string('flight_number')->nullable();
            
            // Customer details
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->text('notes')->nullable();
            
            // Price & Payment
            $table->decimal('total_price', 15, 2);
            $table->enum('payment_method', ['transfer', 'cash', 'whatsapp']);
            $table->string('payment_status')->default('pending'); // pending, paid, failed
            $table->string('booking_status')->default('pending'); // pending, accepted, completed, cancelled
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airport_bookings');
    }
};
