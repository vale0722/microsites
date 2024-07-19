<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::where('email', 'admin@admin.com')
            ->firstOr(function () {
                return User::factory()->create([
                    'name' => 'Administrator',
                    'email' => 'admin@admin.com',
                ]);
            });

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory()->create([
            'name' => 'Cliente',
            'email' => 'cliente@example.com',
        ]);

        $this->call(CategorySeeder::class);
        $this->call(SiteSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(DefaultRolesAndPermissonsSeeder::class);
    }
}
