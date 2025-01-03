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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('sub_title')->nullable();
            $table->enum('type',['file','video'])->default('file');
            $table->enum('is_video',['no','yes'])->default('no');
            $table->enum('status',['active','inactive'])->default('active');
            $table->text('path')->nullable();
            $table->string('item_type')->nullable();
            $table->string('movie_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};