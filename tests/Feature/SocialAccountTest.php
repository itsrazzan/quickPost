<?php

namespace Tests\Feature;

use App\Models\SocialPlatform;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class SocialAccountTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_guest_cannot_view_connected_accounts(): void
    {
        $this->get(route('accounts'))->assertRedirect(route('login'));
    }

    public function test_user_can_connect_a_social_account(): void
    {
        $user = User::factory()->create();
        $platform = SocialPlatform::factory()->create();

        $response = $this->actingAs($user)->post(route('accounts.store'), [
            'social_platform_id' => $platform->id,
            'account_name' => 'QuickPost official',
            'username' => 'quickpost',
        ]);

        $response->assertRedirect(route('accounts'));
        $this->assertDatabaseHas('social_accounts', [
            'user_id' => $user->id,
            'social_platform_id' => $platform->id,
            'username' => 'quickpost',
            'status' => 'connected',
            'is_demo' => true,
        ]);
    }

    public function test_connect_requires_valid_fields(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->from(route('accounts'))
            ->post(route('accounts.store'), [
                'social_platform_id' => 999999,
                'account_name' => '',
                'username' => '',
            ]);

        $response->assertRedirect(route('accounts'));
        $response->assertSessionHasErrors(['social_platform_id', 'account_name', 'username']);
        $this->assertDatabaseCount('social_accounts', 0);
    }

    public function test_user_cannot_disconnect_another_users_account(): void
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $account = $owner->socialAccounts()->create([
            'social_platform_id' => SocialPlatform::factory()->create()->id,
            'account_name' => 'Owner account',
            'username' => 'owner-handle',
        ]);

        $this->actingAs($other)
            ->delete(route('accounts.destroy', $account))
            ->assertNotFound();

        $this->assertNotSoftDeleted($account);
    }

    public function test_connected_accounts_page_only_lists_the_current_users_accounts(): void
    {
        $user = User::factory()->create();
        $other = User::factory()->create();
        $platform = SocialPlatform::factory()->create();

        $user->socialAccounts()->create([
            'social_platform_id' => $platform->id,
            'account_name' => 'My account',
            'username' => 'my-handle',
        ]);
        $other->socialAccounts()->create([
            'social_platform_id' => $platform->id,
            'account_name' => 'Other account',
            'username' => 'other-handle',
        ]);

        $this->actingAs($user)
            ->get(route('accounts'))
            ->assertOk()
            ->assertSee('my-handle')
            ->assertDontSee('other-handle');
    }
}
