<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Role;
use Illuminate\Support\Facades\Schema;
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

     protected $roles = [
         'superadmin',
         'admin',
         'customer',
         'expert_one',
         'exper_tow'
     ];
    public function boot()
    {
        $this->registerPolicies();

        if(Schema::hasTable('roles')){
            foreach(Role::all() as $role){
                Gate::define($role->option, function($user) use($role){
                    return $user->hasRole(explode(',', $role->access_role_name));
                });
            }
        }
        
    }
}
