<?php

namespace Tests\Feature;

use Tests\TestCase;

class DemoSessionTest extends TestCase
{
    public function test_landing_page_links_to_get_started(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('Get started');
        $response->assertSee(route('login', ['intent' => 'signup']));
    }

    public function test_signup_page_offers_a_credential_free_demo(): void
    {
        $response = $this->get(route('login', ['intent' => 'signup']));

        $response->assertOk();
        $response->assertSee('Create your QuickPost account');
        $response->assertSee('No email or password needed.');
        $response->assertSee('Create account and continue');
    }

    public function test_login_starts_a_demo_session_and_redirects_to_dashboard(): void
    {
        $response = $this->post(route('demo-session.store'), ['intent' => 'login']);

        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('demo_user_name', 'Agil Razzan');
    }

    public function test_signup_starts_a_demo_session_and_redirects_to_dashboard(): void
    {
        $response = $this->post(route('demo-session.store'), ['intent' => 'signup']);

        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('demo_user_name', 'Agil Razzan');
    }

    public function test_workspace_pages_redirect_guests_to_login(): void
    {
        foreach (['dashboard', 'analytics', 'calendar', 'drafts', 'media-library', 'settings'] as $routeName) {
            $response = $this->get(route($routeName));

            $response->assertRedirect(route('login'));
        }
    }

    public function test_demo_user_can_open_all_workspace_pages(): void
    {
        $this->withSession(['demo_user_name' => 'Agil Razzan']);

        foreach ([
            'dashboard' => 'No scheduled posts',
            'analytics' => 'No analytics to show yet',
            'calendar' => 'Monthly view',
            'drafts' => 'No drafts yet',
            'media-library' => 'Your library is empty',
            'settings' => 'Agil Razzan',
        ] as $routeName => $pageContent) {
            $response = $this->get(route($routeName));

            $response->assertOk();
            $response->assertSee($pageContent);
        }
    }

    public function test_invalid_demo_intent_does_not_start_a_session(): void
    {
        $response = $this->from(route('login'))
            ->post(route('demo-session.store'), ['intent' => 'admin']);

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('intent');
        $response->assertSessionMissing('demo_user_name');
    }

    public function test_logout_ends_the_demo_session(): void
    {
        $response = $this->withSession(['demo_user_name' => 'Agil Razzan'])
            ->post(route('logout'));

        $response->assertRedirect(route('home'));
        $response->assertSessionMissing('demo_user_name');
    }
}
