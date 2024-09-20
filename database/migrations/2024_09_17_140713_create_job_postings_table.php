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
            $table->id('job_id');
            $table->string('job_title');
            $table->string('job_description');
            $table->decimal('gaji', 20, 0);
            $table->string('lokasi');
            $table->boolean('status');
            $table->boolean('sembunyikan_gaji');
            $table->foreignId('company_id')->constrained('company_profiles','profile_id')->onDelete('cascade');
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_postings');
    }
};
