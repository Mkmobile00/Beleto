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
        Schema::create('web_series_genres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('series_id')->constrained('web_series','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('genre_id')->constrained('genres','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_series_genres');
    }
};
