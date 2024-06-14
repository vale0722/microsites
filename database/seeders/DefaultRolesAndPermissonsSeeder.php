<?php

namespace Database\Seeders;

use App\Constants\PermissionSlug;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DefaultRolesAndPermissonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $baseRolesPermission = [
            [
                'name' => 'Admin',
                'permissions' => [
                    PermissionSlug::CATEGORIES_VIEW_ANY,
                    PermissionSlug::CATEGORIES_CREATE,
                    PermissionSlug::CATEGORIES_UPDATE,

                    PermissionSlug::SITES_VIEW_ANY,
                    PermissionSlug::SITES_VIEW,
                    PermissionSlug::SITES_CREATE,
                    PermissionSlug::SITES_UPDATE,
                    PermissionSlug::SITES_DELETE,
                ],
            ],
            [
                'name' => 'Customer',
                'permissions' => [

                    PermissionSlug::SITES_VIEW_ANY,
                    PermissionSlug::SITES_VIEW,
                ],
            ],
            [
                'name' => 'Guests',
                'permissions' => [

                ],
            ],
        ];

        foreach ($baseRolesPermission as $role) {
            $rol = Role::query()->updateOrCreate([
                'name' => $role['name'],
            ]);

            $rol->syncPermissions($role['permissions']);

        }

        User::query()->find(1)
            ->assignRole('Admin');

        User::query()->find(2)
            ->assignRole('Customer');
    }
}
