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
        Schema::table('system_settings', function (Blueprint $table) {
            $table->longText('fb_link')->nullable();
            $table->longText('insta_link')->nullable();
            $table->longText('twitter_link')->nullable();
            $table->longText('youtube_link')->nullable();

            $table->longText('android_link')->nullable();
            $table->longText('apple_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('system_settings', function (Blueprint $table) {
            //
        });
    }
};
