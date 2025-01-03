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
        Schema::create('currency_rates', function (Blueprint $table) {
            $table->id();
            $table->string("name",50);
            $table->string("symbol",6)->nullable();
            $table->string("code",10)->unique();
            $table->float("rate");
            $table->tinyInteger("decimals")->default(2);
            $table->enum("symbol_placement",['before','after'])->default('before');
            $table->integer("order")->default(0);
            $table->integer("is_default")->default(0);
            $table->tinyInteger("is_active")->default(1);
            $table->double('unit')->default(0);
            $table->foreignId('created_by')->constrained('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('updated_by')->constrained('users')->onUpdate('cascade')->onDelete('restrict')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currency_rates');
    }
};
