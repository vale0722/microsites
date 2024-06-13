<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        $this->call(CategorySeeder::class);
    }
}
