<?php

namespace App\Providers;

// REMOVA ESTA LINHA se existir:
// use Illuminate\Support\ServiceProvider;

// ADICIONE ESTAS LINHAS:
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Release;
use App\Policies\ReleasePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Release::class => ReleasePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Gate para acesso administrativo
        Gate::define('access-admin', function ($user) {
            return $user->isAdmin();
        });

        // Gate para acesso de analista
        Gate::define('access-analista', function ($user) {
            return in_array($user->role, ['admin', 'analista']);
        });

        // Gate para gerenciar releases
        Gate::define('manage-releases', function ($user) {
            return in_array($user->role, ['admin', 'analista']);
        });
    }
}