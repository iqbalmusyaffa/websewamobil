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
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category'); // Engineering, Marketing, Sales, Customer Success, etc
            $table->string('location');
            $table->enum('type', ['Full-time', 'Part-time', 'Contract', 'Internship'])->default('Full-time');
            $table->enum('work_mode', ['On-site', 'Remote', 'Hybrid'])->default('Hybrid');
            $table->longText('description');
            $table->json('requirements')->nullable(); // Array of requirements
            $table->json('benefits')->nullable(); // Array of benefits
            $table->integer('salary_from')->nullable();
            $table->integer('salary_to')->nullable();
            $table->enum('status', ['Open', 'Closed', 'Draft'])->default('Open');
            $table->integer('views')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
