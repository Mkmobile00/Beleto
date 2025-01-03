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
        Schema::create('customer_default_currencies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('currency_id')->constrained('currency_rates','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    protected $fillable=[
        'customer_id',
        'currency_id'
    ];

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_default_currencies');
    }
};
