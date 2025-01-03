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
        Schema::create('seo_socials', function (Blueprint $table) {
            $table->id();
            $table->text('site_map')->nullable();
            $table->string('author_name')->nullable();
            $table->string('google_analytics_id')->nullable();
            $table->string('social_share_ad')->nullable();
            $table->longText('fb_url')->nullable();
            $table->longText('twitter_url')->nullable();
            $table->longText('linkedin_url')->nullable();
            $table->longText('vimeo_url')->nullable();
            $table->longText('youtube_url')->nullable();
            $table->longText('home_page_seo_title')->nullable();
            $table->longText('home_page_seo_keyword')->nullable();
            $table->longText('home_page_seo_metadescription')->nullable();
            $table->longText('movie_page_seo_title')->nullable();
            $table->longText('movie_page_seo_keyword')->nullable();
            $table->longText('movie_page_seo_metadescription')->nullable();
            $table->longText('tv_series_page_seo_title')->nullable();
            $table->longText('tv_series_page_seo_keyword')->nullable();
            $table->longText('tv_series_page_seo_metadescription')->nullable();
            $table->longText('live_tv_page_seo_title')->nullable();
            $table->longText('live_tv_page_seo_keyword')->nullable();
            $table->longText('live_tv_page_seo_metadescription')->nullable();
            $table->longText('blog_page_seo_title')->nullable();
            $table->longText('blog_page_seo_keyword')->nullable();
            $table->longText('blog_page_seo_metadescription')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_socials');
    }
};
