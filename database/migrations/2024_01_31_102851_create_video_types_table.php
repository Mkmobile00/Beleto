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
        Schema::create('video_types', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->longText('description')->nullable();
            $table->string('status')->default('0');
            $table->boolean('primary_menu')->default(0);
            $table->boolean('footer_menu')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_types');
    }
};
