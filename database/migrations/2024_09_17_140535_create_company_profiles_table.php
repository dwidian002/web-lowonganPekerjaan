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
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->id('Profile_id');
            $table->string('Company_name');
            $table->string('Industry');
            $table->string('Location');
            $table->text('Description');
            $table->string('Website')->nullable();
            $table->binary('Logo')->nullable();
            $table->foreignId('User_id')->constrained('users','User_id')->onDelete('cascade');
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_profiles');
    }
};
