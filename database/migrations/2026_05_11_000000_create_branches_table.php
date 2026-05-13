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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "Jakarta Pusat"
            $table->string('slug')->unique(); // e.g., "jakarta-pusat"
            $table->string('city'); // e.g., "Jakarta"
            $table->text('address'); // Full address
            $table->string('phone'); // Phone number
            $table->string('whatsapp')->nullable(); // WhatsApp number
            $table->string('email')->nullable(); // Email
            $table->json('operational_hours')->nullable(); // { opening_time: "08:00", closing_time: "22:00" }
            $table->text('description')->nullable(); // Branch description
            $table->json('features')->nullable(); // Array of features: ["Free WiFi", "24/7 Service", etc]

            // Photo/Media
            $table->string('cover_image')->nullable(); // Banner/hero image (URL or path)
            $table->json('gallery_images')->nullable(); // Array of images
            $table->string('photo_source')->default('unsplash'); // 'url', 'upload', 'unsplash'

            // Location
            $table->string('maps_url')->nullable(); // Google Maps embed URL
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            // Meta
            $table->integer('total_vehicles')->default(0); // Total vehicles at branch
            $table->decimal('rating', 3, 2)->default(0); // Branch rating
            $table->integer('total_reviews')->default(0); // Total reviews

            // Status
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0); // For ordering

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
