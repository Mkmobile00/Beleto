<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // DB::statement('DROP TABLE IF EXISTS subscriptions;');
        DB::statement('DROP TABLE IF EXISTS subscriptions CASCADE;');
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->float('price', 8, 2)->default(0.00);
            $table->enum('is_suggested',['0','1'])->default('0');
            $table->foreignId('plan_id')->constrained('plans','id')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('period_id')->constrained('periods','id')->nullOnDelete()->cascadeOnUpdate();
            $table->enum('status',['active','inactive'])->default('inactive');
            $table->foreignId('currency_type')->constrained('currencies','id')->nullOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
