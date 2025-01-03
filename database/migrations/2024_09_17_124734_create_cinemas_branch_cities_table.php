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
        Schema::create('cinemas_branch_cities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cinemas_branch_id')->constrained('cinemas_branches','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('city_id')->constrained('cities','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cinemas_branch_cities');
    }
};
