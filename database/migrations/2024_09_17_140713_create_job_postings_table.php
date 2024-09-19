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
            $table->id('Job_id');
            $table->string('Job_title');
            $table->string('Job_description');
            $table->decimal('Gaji', 20, 0);
            $table->string('Lokasi');
            $table->boolean('Status');
            $table->boolean('Sembunyikan_Gaji');
            $table->foreignId('Company_id')->constrained('company_profiles','Profile_id')->onDelete('cascade');
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
