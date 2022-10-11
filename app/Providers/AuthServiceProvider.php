<?php

namespace App\Providers;

use App\Models\user_phone;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
//Gate::guessPolicyNamesUsing(function ($modelClass) {
//    // Return the name of the policy class for the given model...
//});
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */



    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        user_phone::class=>PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {


        $this->registerPolicies();
        Gate::define('update-user_phone', [PostPolicy::class, 'update']);
        Gate::define('delete-user_phone', [PostPolicy::class, 'delete']);

        //
    }
}
