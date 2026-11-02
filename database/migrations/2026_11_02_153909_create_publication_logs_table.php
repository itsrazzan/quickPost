<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Creates the publication_logs table to record each publish attempt with its result and payload.
     */
    public function up(): void
    {
        Schema::create('publication_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('content_id')->constrained('contents')->cascadeOnDelete();
            $table->foreignId('social_account_id')->constrained('social_accounts')->cascadeOnDelete();
            $table->string('platform');
            $table->enum('status', ['pending', 'processing', 'success', 'failed'])->default('pending');
            $table->timestamp('attempted_at')->useCurrent();
            $table->string('external_post_id')->nullable();
            $table->string('response_message')->nullable();
            $table->text('error_message')->nullable();
            $table->json('response_payload')->nullable();
            $table->boolean('is_demo')->default(false);
            $table->timestamps();

            $table->index(['content_id', 'status']);
            $table->index(['social_account_id', 'status']);
            $table->index('attempted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publication_logs');
    }
};
