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
        Schema::create('applicant_profiles', function (Blueprint $table) {
            $table->id('id_Profile');
            $table->string('name');
            $table->date('tanggal_lahir');
            $table->string('alamat');
            $table->string('phone_number');
            $table->string('resume')->nullable();
            $table->foreignId('user_id')->constrained('users','user_id')->onDelete('cascade');
            $table->timestamps();
        });      
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicant_profiles');
    }
};
