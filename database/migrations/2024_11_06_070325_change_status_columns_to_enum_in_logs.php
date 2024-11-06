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
        Schema::table('logs', function (Blueprint $table) {
            $table->enum('previous_status', ['applied', 'in_review', 'interview', 'hired', 'rejected'])->change();
            $table->enum('new_status', ['applied', 'in_review', 'interview', 'hired', 'rejected'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('logs', function (Blueprint $table) {
            $table->string('previous_status')->change();
            $table->string('new_status')->change();
        });
    }
};
