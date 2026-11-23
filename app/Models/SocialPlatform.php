<?php

namespace App\Models;

use Database\Factories\SocialPlatformFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'slug',
    'name',
    'icon',
    'color',
    'is_active',
    'supported_media_types',
    'caption_character_limit',
    'max_media_count',
])]
class SocialPlatform extends Model
{
    /** @use HasFactory<SocialPlatformFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'supported_media_types' => 'array',
            'caption_character_limit' => 'integer',
            'max_media_count' => 'integer',
        ];
    }

    public function accounts(): HasMany
    {
        return $this->hasMany(SocialAccount::class);
    }
}
