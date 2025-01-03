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
        Schema::create('customer_notification_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('from_model');
            $table->string('from_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_notification_lists');
    }
};
