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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->enum('previous_status', ['applied', 'in_review', 'interview', 'hired', 'rejected']);
            $table->enum('new_status', ['applied', 'in_review', 'interview', 'hired', 'rejected']);
            $table->foreignId('application_id')->constrained()->onDelete('cascade');
            $table->timestamp('changed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
