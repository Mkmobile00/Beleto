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
        Schema::create('footer_contents', function (Blueprint $table) {
            $table->id();
            $table->text('footer_title1')->nullable();
            $table->longText('footer_content1')->nullable();
            $table->text('footer_title2')->nullable();
            $table->longText('footer_content2')->nullable();
            $table->text('footer_title3')->nullable();
            $table->longText('footer_content3')->nullable();
            $table->longText('copyright')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footer_contents');
    }
};


