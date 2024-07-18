<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Site;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateSiteTest extends TestCase
{
    use RefreshDatabase;

    public function testItCanViewSitesCreateForm(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get(route('sites.create'));

        $response->assertOk();
        $response->assertViewIs('sites.create');
    }

    public function testItCanStoreASite(): void
    {
        $site = Site::factory()
            ->for(Category::factory()->create())
            ->make();
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('sites.store'), $site->toArray());

        $response->assertRedirect(route('sites.index'));

        $this->assertDatabaseHas('sites', [
            'name' => $site->name,
            'slug' => $site->slug
        ]);
    }

    public function testItCannotStoreASiteWithInvalidData(): void
    {
        $site = Site::factory()
            ->for(Category::factory()->create())
            ->make();
        $site->slug = null;
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('sites.store'), $site->toArray());

        $response->assertInvalid(['slug']);

        $this->assertDatabaseMissing('sites', [
            'name' => $site->name,
            'slug' => $site->slug
        ]);
    }
}
