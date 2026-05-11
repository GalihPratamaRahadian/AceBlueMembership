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
        Schema::table('solar_logs', function (Blueprint $table) {
            $table->string('voltage_in')->change();
            $table->string('voltage_out')->change();
            $table->string('current_in')->change();
            $table->string('current_out')->change();
            $table->string('power_in')->change();
            $table->string('power_out')->change();
            $table->string('energy_today')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('solar_logs', function (Blueprint $table) {
            $table->float('voltage_in')->change();
            $table->float('voltage_out')->change();
            $table->float('current_in')->change();
            $table->float('current_out')->change();
            $table->float('power_in')->change();
            $table->float('power_out')->change();
            $table->float('energy_today')->change();
        });
    }
};
