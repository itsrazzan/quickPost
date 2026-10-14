<?php

namespace Tests\Feature;

use Tests\TestCase;

class DashboardTest extends TestCase
{
    public function test_dashboard_page_renders_the_quickpost_preview(): void
    {
        $response = $this->get(route('dashboard'));

        $response->assertOk();
        $response->assertSee('Dashboard');
        $response->assertSee('Interface preview. Everything shown is an example, not real data.');
        $response->assertSee('No scheduled posts');
        $response->assertSee('Analytics (soon)');
    }
}
