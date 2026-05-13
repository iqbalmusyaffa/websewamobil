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
        Schema::table('bookings', function (Blueprint $table) {
            // Update status enum untuk add pending_review
            // (akan di-handle dengan raw SQL untuk MySQL compatibility)

            // Refund method: bank transfer atau wallet credit
            $table->enum('refund_method', ['bank_transfer', 'wallet_credit'])->nullable()->after('refund_percentage')->comment('Metode refund: bank transfer atau wallet credit');

            // Damage related fields
            $table->boolean('is_customer_fault')->nullable()->after('refund_method')->comment('Apakah kerusakan adalah kesalahan customer');
            $table->text('damage_description')->nullable()->after('is_customer_fault')->comment('Deskripsi detail kerusakan');
            $table->boolean('insurance_claimed')->default(false)->after('damage_description')->comment('Apakah sudah klaim asuransi');

            // Cutoff time untuk cancel (dalam jam sebelum pickup)
            $table->integer('cancel_cutoff_hours')->default(24)->after('insurance_claimed')->comment('Jam sebelum pickup harus cancel (default: 24 jam)');

            // Manual override refund
            $table->boolean('refund_override')->default(false)->after('cancel_cutoff_hours')->comment('Admin override policy refund');
            $table->string('override_reason')->nullable()->after('refund_override')->comment('Alasan override');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'refund_method',
                'is_customer_fault',
                'damage_description',
                'insurance_claimed',
                'cancel_cutoff_hours',
                'refund_override',
                'override_reason'
            ]);
        });
    }
};
