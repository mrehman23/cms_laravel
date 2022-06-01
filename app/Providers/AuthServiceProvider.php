<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Kd\Kdladmin\Models\Assignment;

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
        view()->composer('*', function($view) {
            $assignment=new Assignment();
            foreach ($assignment->getUserPermissions() as $key => $permission) {
                Gate::define($key, function ($user) use ($key) {
                    return true;
                });
            }
        });
    }
}
