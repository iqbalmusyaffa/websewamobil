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
            $table->string('cancelled_reason')->nullable()->after('status')->comment('Alasan pembatalan');
            $table->timestamp('cancelled_at')->nullable()->after('cancelled_reason')->comment('Waktu pembatalan');
            $table->foreignId('cancelled_by_user_id')->nullable()->after('cancelled_at')->constrained('users')->nullOnDelete()->comment('Admin yang membatalkan');
            $table->decimal('refund_amount', 12, 2)->nullable()->after('cancelled_by_user_id')->comment('Jumlah refund');
            $table->integer('refund_percentage')->nullable()->after('refund_amount')->comment('Persentase refund (0, 50, 100)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeignKeyIfExists(['cancelled_by_user_id']);
            $table->dropColumn(['cancelled_reason', 'cancelled_at', 'cancelled_by_user_id', 'refund_amount', 'refund_percentage']);
        });
    }
};
