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
        Schema::create('video_likes', function (Blueprint $table) {
            $table->id();
            $table->string('video_unique_code');
            $table->foreignId('customer_id')->constrained('customers','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('status');
            $table->string('type');
            $table->timestamps();
        });
    }
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_likes');
    }
};
