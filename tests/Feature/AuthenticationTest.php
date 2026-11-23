<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_signup_page_shows_account_fields(): void
    {
        $response = $this->get(route('login', ['intent' => 'signup']));

        $response->assertOk();
        $response->assertSee('Create your QuickPost account');
        $response->assertSee('name="name"', false);
        $response->assertSee('name="email"', false);
        $response->assertSee('name="password_confirmation"', false);
    }

    public function test_user_can_register_and_is_authenticated(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => 'Ada Lovelace',
            'email' => 'ada@example.test',
            'password' => 'correct-horse-battery',
            'password_confirmation' => 'correct-horse-battery',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs(User::query()->where('email', 'ada@example.test')->firstOrFail());
        $this->assertDatabaseHas('users', ['email' => 'ada@example.test']);
    }

    public function test_registration_rejects_duplicate_email_and_mismatched_passwords(): void
    {
        User::factory()->create(['email' => 'ada@example.test']);

        $response = $this->from(route('login', ['intent' => 'signup']))
            ->post(route('register.store'), [
                'name' => 'Ada Lovelace',
                'email' => 'ada@example.test',
                'password' => 'correct-horse-battery',
                'password_confirmation' => 'not-the-same',
            ]);

        $response->assertRedirect(route('login', ['intent' => 'signup']));
        $response->assertSessionHasErrors(['email', 'password']);
    }

    public function test_workspace_pages_redirect_guests_to_login(): void
    {
        foreach (['dashboard', 'analytics', 'calendar', 'drafts', 'media-library', 'settings'] as $routeName) {
            $response = $this->get(route($routeName));

            $response->assertRedirect(route('login'));
        }
    }

    public function test_user_can_log_in_and_log_out(): void
    {
        $user = User::factory()->create(['password' => 'correct-horse-battery']);

        $loginResponse = $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'correct-horse-battery',
        ]);

        $loginResponse->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($user);

        $logoutResponse = $this->post(route('logout'));

        $logoutResponse->assertRedirect(route('home'));
        $this->assertGuest();
    }

    public function test_invalid_credentials_do_not_authenticate_the_user(): void
    {
        User::factory()->create(['email' => 'ada@example.test']);

        $response = $this->from(route('login'))
            ->post(route('login.store'), [
                'email' => 'ada@example.test',
                'password' => 'wrong-password',
            ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }
}
