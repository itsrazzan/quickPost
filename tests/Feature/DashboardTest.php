<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_dashboard_page_renders_the_quickpost_preview(): void
    {
        $response = $this->actingAs(User::factory()->create())
            ->get(route('dashboard'));

        $response->assertOk();
        $response->assertSee('Dashboard');
        $response->assertSee('Drafts save to your account');
        $response->assertSee('>0</span>', false);
        $response->assertSee(route('drafts.create'));
        $response->assertSee('No scheduled posts');
        $response->assertSee('Analytics (soon)');
    }
}
