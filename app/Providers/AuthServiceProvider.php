<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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

/*        Gate::define('users', function ($user) {
           return $user->hasPermission('users');
        });
  */

       /* $permissions = ['products','brands', 'categories', 'options', 'settings', 'privileges', 'users' , 'settings'];

        foreach ($permissions as $permission) {
            Gate::define($permission, function ($user) use ($permission) {
                return $user->hasPermission($permission);
            });
        }
       */
        foreach ( config('global.permissions') as $ability => $value) { //brands
            Gate::define($ability, function ($auth) use ($ability){
                return $auth->hasPermission($ability);
            });
        }
    }
}
