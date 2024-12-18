<?php

namespace App\Providers;

use RoleOptions;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('mediator', function ($user) {
            return $user->role_id == RoleOptions::MEDIATOR;
        });


        Gate::define('admin', function ($user) {
            return $user->role_id == RoleOptions::ADMIN;
        });
    }
}
