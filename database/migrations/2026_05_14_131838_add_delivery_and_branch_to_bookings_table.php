<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Mode pengambilan: 'pickup_branch' = ambil di cabang, 'home_delivery' = diantar ke alamat
            $table->enum('pickup_mode', ['pickup_branch', 'home_delivery'])->default('home_delivery')->after('pickup_location');
            // Cabang yang dipilih (nullable, diisi jika pickup_mode = pickup_branch)
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete()->after('pickup_mode');
            // Alamat pengiriman (diisi jika pickup_mode = home_delivery)
            $table->text('delivery_address')->nullable()->after('branch_id');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['branch_id']);
            $table->dropColumn(['pickup_mode', 'branch_id', 'delivery_address']);
        });
    }
};
