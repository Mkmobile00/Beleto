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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique()->nullable();
            $table->string('slug')->unique()->nullable();
            $table->longText('description')->nullable();
            $table->string('rating')->nullable();
            $table->date('release_date')->default(today());
            $table->string('run_time')->nullable();
            $table->enum('publication',['0','1'])->default('0');
            $table->enum('download',['0','1'])->default('0');
            $table->enum('is_file',['0','1'])->default('0');
            $table->enum('is_file1',['0','1'])->default('0');
            $table->string('freePaid')->nullable();
            $table->text('trailer_url')->nullable();
            $table->text('trailer_url1')->nullable();
            $table->text('thumbnail')->nullable();
            $table->text('poster')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->longText('meta_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};


