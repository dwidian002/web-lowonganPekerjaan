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
        Schema::create('applications', function (Blueprint $table) {
            $table->id('application_id');
            $table->string('application_status');
            $table->string('resume');
            $table->timestamp('applied_at');
            $table->string('cover_letter');
            $table->foreignId('job_id')->constrained('job_postings','job_id')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users','user_id')->onDelete('cascade');
            $table->timestamps();
        });     
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
