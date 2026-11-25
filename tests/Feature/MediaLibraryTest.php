<?php

namespace Tests\Feature;

use App\Models\Media;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MediaLibraryTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_guest_cannot_view_media_library(): void
    {
        $this->get(route('media-library'))->assertRedirect(route('login'));
    }

    public function test_user_can_upload_an_image(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('media-library.store'), [
            'file' => UploadedFile::fake()->image('cover.jpg', 800, 600),
        ]);

        $response->assertRedirect(route('media-library'));
        $this->assertDatabaseHas('media', [
            'user_id' => $user->id,
            'file_name' => 'cover.jpg',
            'disk' => 'public',
        ]);

        $media = $user->media()->firstOrFail();
        Storage::disk('public')->assertExists($media->file_path);
        $this->assertEquals(['width' => 800, 'height' => 600], $media->dimensions);
    }

    public function test_upload_rejects_non_image_files(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->from(route('media-library'))
            ->post(route('media-library.store'), [
                'file' => UploadedFile::fake()->create('document.pdf', 100, 'application/pdf'),
            ]);

        $response->assertRedirect(route('media-library'));
        $response->assertSessionHasErrors('file');
        $this->assertDatabaseCount('media', 0);
    }

    public function test_media_library_only_lists_the_current_users_media(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $other = User::factory()->create();

        Media::factory()->for($user)->create(['file_name' => 'mine.jpg']);
        Media::factory()->for($other)->create(['file_name' => 'theirs.jpg']);

        $this->actingAs($user)
            ->get(route('media-library'))
            ->assertOk()
            ->assertSee('mine.jpg')
            ->assertDontSee('theirs.jpg');
    }

    public function test_user_cannot_delete_another_users_media(): void
    {
        Storage::fake('public');
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $media = Media::factory()->for($owner)->create();

        $this->actingAs($other)
            ->delete(route('media-library.destroy', $media))
            ->assertNotFound();

        $this->assertNotSoftDeleted($media);
    }
}
