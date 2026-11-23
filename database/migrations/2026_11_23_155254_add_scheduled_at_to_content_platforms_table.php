<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('content_platforms', function (Blueprint $table) {
            $table->timestamp('scheduled_at')->nullable();
            $table->index(['status', 'scheduled_at']);
        });

        DB::table('content_platforms')
            ->join('contents', 'contents.id', '=', 'content_platforms.content_id')
            ->whereNotNull('contents.scheduled_at')
            ->select('content_platforms.id', 'contents.scheduled_at')
            ->orderBy('content_platforms.id')
            ->get()
            ->each(function (object $target): void {
                DB::table('content_platforms')
                    ->where('id', $target->id)
                    ->update(['scheduled_at' => $target->scheduled_at]);
            });
    }

    public function down(): void
    {
        Schema::table('content_platforms', function (Blueprint $table) {
            $table->dropIndex(['status', 'scheduled_at']);
            $table->dropColumn('scheduled_at');
        });
    }
};
