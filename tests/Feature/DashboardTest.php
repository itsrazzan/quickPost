<?php

namespace Tests\Feature;

use Tests\TestCase;

class DashboardTest extends TestCase
{
    public function test_dashboard_page_renders_the_quickpost_preview(): void
    {
        $response = $this->withSession(['demo_user_name' => 'Agil Razzan'])
            ->get(route('dashboard'));

        $response->assertOk();
        $response->assertSee('Dashboard');
        $response->assertSee('Demo preview');
        $response->assertSee('No scheduled posts');
        $response->assertSee('Analytics (soon)');
    }
}
