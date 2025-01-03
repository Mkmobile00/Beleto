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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->enum('premium_content',['1','0'])->default('0');
            $table->enum('livetv',['1','0'])->default('0');
            $table->enum('addfree',['1','0'])->default('0');
            $table->enum('download',['1','0'])->default('0');
            $table->longText('device');
            $table->integer('screensize')->nullable();
            $table->longText('video_quality');
            $table->longText('audio_quality');
            $table->enum('status',['active','inactive'])->default('inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};

