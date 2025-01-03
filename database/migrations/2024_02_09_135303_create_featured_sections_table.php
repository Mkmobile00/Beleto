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
        Schema::create('featured_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title', 191);
            $table->string('slug')->nullable()->unique();
            $table->string('status');
            $table->string('type');
            $table->text('image')->nullable();
            $table->string('meta_title')->nullable();
            $table->mediumText('meta_keywords')->nullable();
            $table->mediumText('meta_description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('featured_sections');
    }
};
