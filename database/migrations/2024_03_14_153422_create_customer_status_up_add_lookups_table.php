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
        Schema::create('customer_status_up_add_lookups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('startupadd_id')->constrained('start_up_adds','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->longText('device_serial_num');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_status_up_add_lookups');
    }

};
