<?php

namespace App\Providers;
use App\Models\RCR;
use App\Policies\RCRPolicy; 

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('create-user', function ($user) {
            return $user->role === Role::ADMIN;

        });

        Gate::resource('rcr', RCRPolicy::class);

    }
}
