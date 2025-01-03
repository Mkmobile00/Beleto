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
        Schema::create('show_dates_time_slots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('show_date_id')->constrained('show_dates','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('show_dates_time_slots');
    }
};
