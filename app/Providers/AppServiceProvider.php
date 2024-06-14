<?php

namespace App\Providers;

use App\Constants\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('is_admin', function (User $user) {
            return $user->roles()->where('name', Role::ADMIN->value)->exists();
        });

        Gate::define('is_customer', function (User $user) {
            return $user->roles()->where('name', Role::CUSTOMER->value)->exists();
        });
    }
}
