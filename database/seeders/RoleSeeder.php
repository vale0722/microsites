<?php

namespace Database\Seeders;

use App\Constants\Role as Roles;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => Roles::ADMIN->value,
                'created_at' => now(),
            ],
            [
                'name' => Roles::CUSTOMER->value,
                'created_at' => now(),
            ],
        ];

        Role::insert($roles);
    }
}
