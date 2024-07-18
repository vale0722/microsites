<?php

namespace App\Policies;

use App\Constants\PermissionSlug;
use App\Models\User;

class CategoryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionSlug::CATEGORIES_VIEW_ANY);
    }

    public function view(User $user): bool
    {
        return $user->hasPermissionTo(PermissionSlug::CATEGORIES_VIEW);
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionSlug::CATEGORIES_CREATE);
    }

    public function update(User $user): bool
    {
        return $user->hasPermissionTo(PermissionSlug::CATEGORIES_UPDATE);
    }

    public function delete(User $user): bool
    {
        return $user->hasPermissionTo(PermissionSlug::CATEGORIES_DELETE);
    }
}
