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
        Schema::create('post_cat_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained('posts','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('post_cat_id')->constrained('post_categories','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_cat_items');
    }
};
