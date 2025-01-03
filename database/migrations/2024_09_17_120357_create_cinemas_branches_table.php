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
        Schema::create('cinemas_branches', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('branch_id')->unique();
            $table->longText('summary')->nullable();
            $table->longText('description')->nullable();
            $table->foreignId('cinemas_id')->constrained('cinemas','id')->cascadeOnUpdate()->cascadeOnUpdate();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cinemas_branches');
    }
};
