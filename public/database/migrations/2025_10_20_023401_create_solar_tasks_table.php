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
        Schema::create('solar_tasks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('site_id')->nullable();
            $table->string('assigned_by')->nullable();
            $table->string('assigned_to')->nullable();
            $table->string('issue_description')->nullable();
            $table->string('status')->nullable();
            $table->dateTime('accepted_at')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->string('technician_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solar_tasks');
    }
};
