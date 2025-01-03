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
        Schema::create('movie_theaters', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('summary')->nullable();
            $table->longText('description')->nullable();
            $table->string('status');
            $table->string('screen_id')->nullable();
            $table->string('seat_capacity')->nullable();
            $table->foreignId('cinemas_id')->constrained('cinemas','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('cinemas_branch_id')->constrained('cinemas_branches','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('city_id')->constrained('cities','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('theater_unique_id');
            $table->longText('image')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_theaters');
    }
};
