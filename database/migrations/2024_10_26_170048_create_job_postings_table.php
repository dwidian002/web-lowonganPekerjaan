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
            $table->string('position');
            $table->foreignId('location_id')->constrained('locations')->onDelete('cascade');
            $table->foreignId('field_of_work_id')->constrained('fields_of_work')->onDelete('cascade');
            $table->foreignId('company_profile_id')->constrained('company_profiles')->onDelete('cascade');
            $table->foreignId('job_category_id')->constrained('job_categories')->onDelete('cascade');
            $table->text('job_description');
            $table->text('requirements_desciption');
            $table->decimal('gaji', 20, 0);
            $table->boolean('status');
            $table->boolean('sembunyikan_gaji');
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
