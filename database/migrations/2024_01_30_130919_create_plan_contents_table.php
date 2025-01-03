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
        Schema::create('plan_contents', function (Blueprint $table) {
            $table->id();
            $table->longText('content');
            $table->longText('device');
            $table->integer('size');
            $table->longText('video_quality');
            $table->longText('audio_quality');
            $table->enum('livetv',['0','1'])->default('0');
            $table->enum('addfree',['0','1'])->default('0');
            $table->enum('download',['0','1'])->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_contents');
    }
};
