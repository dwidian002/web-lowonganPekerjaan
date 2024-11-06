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
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('location_id')->constrained()->onDelete('cascade');
            $table->foreignId('industry_id')->constrained('industry')->onDelete('cascade');  
            $table->foreignId('type_company_id')->constrained('type_company')->onDelete('cascade'); 
            $table->string('company_name');
            $table->year('tahun_berdiri');
            $table->string('alamat_lengkap');
            $table->text('description');
            $table->string('website');
            $table->string('logo');
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
