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
        Schema::create('movie_video_qualities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movie_id')->constrained('movies','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('video_quality_id')->constrained('video_qualities','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_video_qualities');
    }
};
