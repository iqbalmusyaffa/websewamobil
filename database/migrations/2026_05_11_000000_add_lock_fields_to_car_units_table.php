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
        Schema::table('car_units', function (Blueprint $table) {
            $table->text('notes')->nullable()->after('color')->comment('Catatan atau masalah pada kendaraan');
            $table->foreignId('locked_by')->nullable()->after('notes')->constrained('users')->nullOnDelete()->comment('ID user (admin) yang mengunci kendaraan');
            $table->string('locked_reason')->nullable()->after('locked_by')->comment('Alasan kendaraan dikunci (masalah mesin, ban bocor, dll)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('car_units', function (Blueprint $table) {
            $table->dropColumn(['notes', 'locked_by', 'locked_reason']);
            $table->dropForeignKeyIfExists(['locked_by']);
        });
    }
};
