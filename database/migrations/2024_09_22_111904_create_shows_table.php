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
        Schema::create('shows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movies_id')->constrained('movies','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('theater_id')->constrained('movie_theaters','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('title');
            $table->string('status');
            $table->longText('summary')->nullable();
            $table->longText('description')->nullable();
            $table->longText('image')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shows');
    }
};
