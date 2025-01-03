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
        Schema::create('android_settings', function (Blueprint $table) {
            $table->id();
            $table->string('android_nav_menu')->nullable();
            $table->string('android_mendatory_login')->default('0');
            $table->string('android_genre_display')->default('0');
            $table->string('android_genre_country')->default('0');
            $table->string('app_version')->nullable();
            $table->string('app_version_code')->nullable();
            $table->text('app_file_url')->nullable();
            $table->longText('whats_on_apk')->nullable();
            $table->string('update_skipable')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('android_settings');
    }
};