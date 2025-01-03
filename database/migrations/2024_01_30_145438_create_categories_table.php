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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            // $table->foreignId('parent_id')->nullable()->constrained('categories','id')->nullOnDelete()->cascadeOnUpdate();
            $table->longText('image')->nullable();
            $table->enum('status',['0','1'])->default('0');
            $table->enum('is_featured',['0','1'])->default('0');
            $table->string('meta_title')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('view_type');
            $table->nestedSet();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
        Schema::table('categories', function (Blueprint $table) {
            // $table->dropNestedSet();
        });
    }
};
