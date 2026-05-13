<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenance_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained()->cascadeOnDelete();
            $table->foreignId('car_unit_id')->nullable()->constrained()->nullOnDelete();
            $table->string('type'); // servis rutin, ganti oli, ban, STNK, dll
            $table->text('description')->nullable();
            $table->decimal('cost', 12, 2)->nullable();
            $table->date('service_date');
            $table->date('next_service_date')->nullable();
            $table->string('technician')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenance_logs');
    }
};
