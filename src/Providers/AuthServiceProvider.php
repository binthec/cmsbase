<?php

namespace Binthec\CmsBase\Providers;

use Binthec\CmsBase\Policies\UserPolicy;
use Binthec\CmsBase\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the package.
     *
     * @var array
     */
    protected $policies = [
        // Bind User policy
        User::class => UserPolicy::class,
    ];

    /**
     * Register any package authentication / authorization services.
     *
     * @param \Illuminate\Contracts\Auth\Access\Gate $gate
     *
     * @return void
     */
    public function boot()
    {

        $this->registerPolicies();

        //開発者のみ許可
        Gate::define('system-only', function ($user) {
            return $user->role === User::SYSTEM_ADMIN;
        });

        //オーナー以上（＝開発者とオーナー）のみ許可
        Gate::define('owner-higher', function ($user) {
            return $user->role <= User::OWNER && $user->role >= User::SYSTEM_ADMIN;
        });

    }
}
