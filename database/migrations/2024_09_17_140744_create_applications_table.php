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
            $table->id('Application_id');
            $table->string('Application_status');
            $table->string('Resume');
            $table->timestamp('Applied_at');
            $table->string('Cover_letter');
            $table->foreignId('Job_id')->constrained('job_postings','Job_id')->onDelete('cascade');
            $table->foreignId('User_id')->constrained('users','User_id')->onDelete('cascade');
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
