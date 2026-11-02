<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Creates the user_settings table to store notification and display preferences per user.
     */
    public function up(): void
    {
        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('theme')->default('system');
            $table->string('timezone')->default('Asia/Jakarta');
            $table->boolean('email_notifications')->default(true);
            $table->boolean('notify_publish_success')->default(true);
            $table->boolean('notify_publish_failure')->default(true);
            $table->boolean('notify_scheduled_reminder')->default(true);
            $table->timestamps();

            $table->unique('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_settings');
    }
};
