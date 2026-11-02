<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Creates the social_platforms table to store supported social media platform definitions.
     */
    public function up(): void
    {
        Schema::create('social_platforms', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('icon')->nullable();
            $table->string('color', 20)->default('#4F46E5');
            $table->boolean('is_active')->default(true);
            $table->json('supported_media_types')->nullable();
            $table->unsignedInteger('caption_character_limit')->default(2200);
            $table->unsignedInteger('max_media_count')->default(10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_platforms');
    }
};
