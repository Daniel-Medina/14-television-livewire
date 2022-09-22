<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Lista;
use App\Models\User;
use App\Models\Video;
use App\Policies\AdminPolicy;
use App\Policies\ListaPolicy;
use App\Policies\VideoPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Video::class => VideoPolicy::class,
        Lista::class => ListaPolicy::class,
        User::class => AdminPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
