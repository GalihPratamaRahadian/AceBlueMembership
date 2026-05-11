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
        Schema::create('solar_logs', function (Blueprint $table) {
            $table->id();
            $table->float('voltage_in')->nullable();
            $table->float('current_in')->nullable();
            $table->float('voltage_out')->nullable();
            $table->float('current_out')->nullable();
            $table->float('power_in')->nullable();
            $table->float('power_out')->nullable();
            $table->float('energy_today')->nullable();
            $table->string('status')->nullable();
            $table->dateTime('logged_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solar_logs');
    }
};
