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
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('from_model');
            $table->string('model_id');
            $table->string('transaction_id');
            $table->string('purpose');
            $table->double('amount');
            $table->string('payment_type');
            $table->enum('amount_type',['npr','usd'])->default('npr');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_histories');
    }
};

