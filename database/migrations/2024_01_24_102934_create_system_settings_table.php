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
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->string('theme')->default('default');
            $table->string('logo')->nullable();
            $table->text('purchase_code')->nullable();
            $table->string('time_zone')->nullable();
            $table->string('site_name')->nullable();
            $table->text('site_url')->nullable();
            $table->string('system_email')->nullable();
            $table->text('bussiness_address')->nullable();
            $table->string('bussiness_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('registration_enable')->default(0);
            $table->string('frontend_login')->default(0);
            $table->string('blog_enable')->default(0);
            $table->string('show_country_to_main')->default(0);
            $table->string('show_genre_to_main')->default(0);
            $table->string('show_release_to_main')->default(0);
            $table->string('show_contact_to_main')->default(0);
            $table->string('show_contact_to_footer')->default(0);
            $table->string('show_actordirwr_image_to_main')->default(0);
            $table->string('show_azlist_to_main')->default(0);
            $table->string('show_azlist_to_footer')->default(0);
            $table->string('enable_movie_report')->default(0);
            $table->string('movie_report_send_to')->nullable();
            $table->longText('movie_report_attention_text')->nullable();
            $table->string('enable_movie_request')->default(0);
            $table->string('movie_request_send_to')->nullable();
            $table->string('enable_google_captcha')->default(0);
            $table->string('google_captcha_sitekey')->nullable();
            $table->string('google_captcha_secretkey')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_settings');
    }
};
