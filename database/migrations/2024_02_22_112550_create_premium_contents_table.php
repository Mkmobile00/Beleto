<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('DROP TABLE IF EXISTS premium_contents CASCADE;');
        Schema::create('premium_contents', function (Blueprint $table) {
            $table->id();
            $table->string('movie_id');
            $table->string('type');
            $table->float('price', 8, 2)->default(0.00);
            $table->enum('is_premium',['0','1'])->default('0');
            $table->string('duration')->nullable();
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('premium_contents');
    }
};
