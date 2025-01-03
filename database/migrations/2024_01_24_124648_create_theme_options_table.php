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
        Schema::create('theme_options', function (Blueprint $table) {
            $table->id();
            $table->string('website_preloader')->default(0);
            $table->string('dark_theme_enable')->default(0);
            $table->string('website_background_enable')->default(0);
            $table->longText('website_background_image')->nullable();
            $table->string('landing_page_search')->default(0);
            $table->longText('landing_page_image')->nullable();
            $table->string('frontend_theme_color')->nullable();
            $table->string('header_template')->nullable();
            $table->string('footer_template')->nullable();
            $table->string('google_map_api')->nullable();
            $table->string('google_map_lat')->nullable();
            $table->string('google_map_lang')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('theme_options');
    }
};

