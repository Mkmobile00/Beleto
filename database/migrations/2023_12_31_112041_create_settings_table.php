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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('icon')->nullable();
            $table->string('logo')->nullable();
            $table->string('logo2')->nullable();
            $table->longText('site_name')->nullable();
            $table->longText('quatation')->nullable();
            $table->string('fb_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('insta_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('pinterest_link')->nullable();
            $table->string('google_plus')->nullable();
            $table->longText('address')->nullable();
            $table->longText('location_url')->nullable();
            $table->string('email')->nullable();
            $table->longText('phone')->nullable();
            $table->longText('contact')->nullable();
            $table->longText('contact_second')->nullable();
            $table->longText('meta_title')->nullable();
            $table->longText('meta_keywords')->nullable();
            $table->longText('meta_description')->nullable();
            $table->longText('copyright')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
