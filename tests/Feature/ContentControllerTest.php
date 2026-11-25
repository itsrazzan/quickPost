<?php

namespace Tests\Feature;

use App\Models\Content;
use App\Models\Media;
use App\Models\SocialAccount;
use App\Models\SocialPlatform;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ContentControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_user_can_create_a_draft_without_assigning_it_to_another_user(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        $response = $this->actingAs($user)->post(route('drafts.store'), [
            'title' => 'A saved idea',
            'caption' => 'A short caption.',
            'user_id' => $otherUser->id,
            'status' => 'published',
        ]);

        $response->assertRedirect(route('drafts'));
        $this->assertDatabaseHas('contents', [
            'user_id' => $user->id,
            'title' => 'A saved idea',
            'status' => 'draft',
        ]);
        $this->assertDatabaseMissing('contents', [
            'user_id' => $otherUser->id,
            'title' => 'A saved idea',
        ]);
    }

    public function test_user_must_enter_a_title_or_caption(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->from(route('drafts.create'))
            ->post(route('drafts.store'), ['title' => '', 'caption' => '']);

        $response->assertRedirect(route('drafts.create'));
        $response->assertSessionHasErrors(['title', 'caption']);
        $this->assertDatabaseCount('contents', 0);
    }

    public function test_user_cannot_edit_or_delete_another_users_draft(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $draft = Content::factory()->for($owner)->create();

        $this->actingAs($otherUser)
            ->put(route('drafts.update', $draft), ['title' => 'Changed', 'caption' => 'Changed'])
            ->assertNotFound();

        $this->actingAs($otherUser)
            ->delete(route('drafts.destroy', $draft))
            ->assertNotFound();

        $this->assertSame($draft->title, $draft->fresh()->title);
    }

    public function test_user_cannot_restore_another_users_deleted_draft(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $draft = Content::factory()->for($owner)->create();
        $draft->delete();

        $this->actingAs($otherUser)
            ->post(route('drafts.restore', $draft->id))
            ->assertNotFound();

        $this->assertTrue(Content::withTrashed()->findOrFail($draft->id)->trashed());
    }

    public function test_deleted_draft_is_hidden_and_can_be_restored_by_its_owner(): void
    {
        $user = User::factory()->create();
        $draft = Content::factory()->for($user)->create();

        $this->actingAs($user)
            ->delete(route('drafts.destroy', $draft))
            ->assertRedirect(route('drafts'));

        $this->assertTrue(Content::withTrashed()->findOrFail($draft->id)->trashed());

        $this->post(route('drafts.restore', $draft->id))
            ->assertRedirect(route('drafts'));

        $this->assertFalse($draft->fresh()->trashed());
    }

    public function test_content_targets_store_individual_schedule_and_social_tokens_stay_private(): void
    {
        $user = User::factory()->create();
        $content = Content::factory()->for($user)->create();
        $platform = SocialPlatform::factory()->create();
        $account = $user->socialAccounts()->create([
            'social_platform_id' => $platform->id,
            'account_name' => 'QuickPost account',
            'username' => 'quickpost-user',
            'access_token' => 'access-secret',
            'refresh_token' => 'refresh-secret',
        ]);
        $anotherAccount = $user->socialAccounts()->create([
            'social_platform_id' => $platform->id,
            'account_name' => 'Second account',
            'username' => 'second-user',
        ]);
        $scheduledAt = now()->addDay()->startOfSecond();
        $laterSchedule = $scheduledAt->copy()->addDay();

        $target = $content->platformTargets()->create([
            'social_account_id' => $account->id,
            'status' => 'scheduled',
            'scheduled_at' => $scheduledAt,
        ]);
        $anotherTarget = $content->platformTargets()->create([
            'social_account_id' => $anotherAccount->id,
            'status' => 'scheduled',
            'scheduled_at' => $laterSchedule,
        ]);

        $this->assertSame($account->id, $target->socialAccount->id);
        $this->assertSame($scheduledAt->toDateTimeString(), $target->scheduled_at->toDateTimeString());
        $this->assertSame($laterSchedule->toDateTimeString(), $anotherTarget->scheduled_at->toDateTimeString());
        $this->assertNotSame('access-secret', DB::table('social_accounts')->where('id', $account->id)->value('access_token'));
        $this->assertArrayNotHasKey('access_token', $account->fresh()->toArray());
        $this->assertSame('access-secret', $account->fresh()->access_token);
    }

    public function test_media_and_social_accounts_support_soft_deletion(): void
    {
        $user = User::factory()->create();
        $media = Media::factory()->for($user)->create();
        $account = $user->socialAccounts()->create([
            'social_platform_id' => SocialPlatform::factory()->create()->id,
            'account_name' => 'Account',
            'username' => 'account',
        ]);

        $media->delete();
        $account->delete();

        $this->assertTrue(Media::withTrashed()->findOrFail($media->id)->trashed());
        $this->assertTrue(SocialAccount::withTrashed()->findOrFail($account->id)->trashed());
    }

    public function test_user_can_attach_owned_media_to_a_draft(): void
    {
        $user = User::factory()->create();
        $first = Media::factory()->for($user)->create();
        $second = Media::factory()->for($user)->create();

        $this->actingAs($user)->post(route('drafts.store'), [
            'title' => 'Draft with media',
            'media' => [$second->id, $first->id],
        ])->assertRedirect(route('drafts'));

        $draft = $user->contents()->where('title', 'Draft with media')->firstOrFail();

        // Urutan pivot mengikuti urutan pilihan di form.
        $this->assertDatabaseHas('content_media', [
            'content_id' => $draft->id,
            'media_id' => $second->id,
            'order' => 0,
        ]);
        $this->assertDatabaseHas('content_media', [
            'content_id' => $draft->id,
            'media_id' => $first->id,
            'order' => 1,
        ]);
    }

    public function test_user_cannot_attach_another_users_media(): void
    {
        $user = User::factory()->create();
        $otherMedia = Media::factory()->create();

        $this->actingAs($user)
            ->from(route('drafts.create'))
            ->post(route('drafts.store'), [
                'title' => 'Sneaky draft',
                'media' => [$otherMedia->id],
            ])
            ->assertRedirect(route('drafts.create'))
            ->assertSessionHasErrors('media.0');

        $this->assertDatabaseCount('content_media', 0);
    }

    public function test_updating_a_draft_syncs_attached_media(): void
    {
        $user = User::factory()->create();
        $draft = Content::factory()->for($user)->create();
        $keep = Media::factory()->for($user)->create();
        $remove = Media::factory()->for($user)->create();
        $add = Media::factory()->for($user)->create();

        $draft->media()->sync([
            $remove->id => ['order' => 0],
            $keep->id => ['order' => 1],
        ]);

        $this->actingAs($user)->put(route('drafts.update', $draft), [
            'title' => $draft->title,
            'caption' => $draft->caption,
            'media' => [$keep->id, $add->id],
        ])->assertRedirect(route('drafts'));

        // Media yang dilepas hilang dari pivot; sisanya mengikuti urutan baru.
        $this->assertDatabaseMissing('content_media', [
            'content_id' => $draft->id,
            'media_id' => $remove->id,
        ]);
        $this->assertDatabaseHas('content_media', [
            'content_id' => $draft->id,
            'media_id' => $keep->id,
            'order' => 0,
        ]);
        $this->assertDatabaseHas('content_media', [
            'content_id' => $draft->id,
            'media_id' => $add->id,
            'order' => 1,
        ]);
    }
}
