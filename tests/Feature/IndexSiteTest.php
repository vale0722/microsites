<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Site;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexSiteTest extends TestCase
{
    use RefreshDatabase;

    public function testItCanViewListSites(): void
    {
        Site::factory()
            ->for(Category::factory()->create())
            ->create([
                'name' => 'Mi Comercio',
            ]);

        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get(route('admin.sites.index'));

        $response->assertOk();
        $response->assertViewIs('sites.index');
        $response->assertViewHas('sites');
        $response->assertSee('Mi Comercio');
    }

    public function testAnUnauthenticatedUserCannotViewListSites(): void
    {
        Site::factory()
            ->for(Category::factory()->create())
            ->create([
                'name' => 'Mi Comercio',
            ]);

        $response = $this->get(route('admin.sites.index'));

        $response->assertRedirect(route('login'));
    }
}
