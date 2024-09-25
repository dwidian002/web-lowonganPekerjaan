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
            $table->id('profile_id');
            $table->string('company_name');
            $table->string('industry');
            $table->year('tahun_berdiri');
            $table->string('alamat');
            $table->text('description');
            $table->string('website')->nullable();
            $table->binary('logo')->nullable();
            $table->foreignId('user_id')->constrained('users','user_id')->onDelete('cascade');
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
