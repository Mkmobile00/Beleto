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
        Schema::create('tv_series_parts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tvseries_id')->constrained('tv_series','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('summary')->nullable();
            $table->longText('description')->nullable();
            $table->longText('video_path')->nullable();
            $table->string('status');
            $table->string('releasedate');
            $table->bigInteger('order')->default(0);
            $table->longText('poster')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tv_series_parts');
    }
};