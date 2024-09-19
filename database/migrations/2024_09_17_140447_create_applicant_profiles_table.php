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
            $table->string('Alamat');
            $table->string('Ttl');
            $table->string('Phone_number');
            $table->string('Experience');
            $table->string('Education');
            $table->string('Skills');
            $table->foreignId('User_id')->constrained('users','User_id')->onDelete('cascade');
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
