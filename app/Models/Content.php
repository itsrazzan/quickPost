<?php

namespace App\Models;

use Database\Factories\ContentFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['title', 'caption', 'first_comment', 'status', 'published_at', 'timezone'])]
class Content extends Model
{
    /** @use HasFactory<ContentFactory> */
    use HasFactory, SoftDeletes;

    protected function casts(): array
    {
        return [
            'scheduled_at' => 'datetime',
            'published_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function media(): BelongsToMany
    {
        return $this->belongsToMany(Media::class, 'content_media')
            ->withPivot('order')
            ->withTimestamps();
    }

    public function platformTargets(): HasMany
    {
        return $this->hasMany(ContentPlatform::class);
    }
}
