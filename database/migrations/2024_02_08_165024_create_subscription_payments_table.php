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
        Schema::create('subscription_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('subscription_id')->constrained('subscriptions','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->longText('payment_type');
            $table->string('payment_status');
            $table->double('amount');
            $table->text('transaction_id');
            $table->enum('is_expired',['0','1'])->default('0');
            $table->date('purchase_date');
            $table->date('from_date');
            $table->date('to_date');
            $table->enum('amount_type',['npr','usd'])->default('npr');
            $table->string('payment_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_payments');
    }
};
