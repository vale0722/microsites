<?php

namespace Database\Seeders;

use App\Constants\Permission as Permissions;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {

        $data = [];

        foreach (Permissions::toArray() as $permission) {
            $data[] = [
                'name' => $permission,
                'created_at' => now(),
            ];
        }

        Permission::upsert($data, ['name']);
    }
}
