<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Policies\ArticlePolicy;
use App\Models\Article;

use App\Policies\LivePolicy;
use App\Models\Live;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         Article::class => ArticlePolicy::class,
         Live::class => LivePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin',function( $user ){
          return $user->isAdmin();
        });
    
    	Gate::define('isUser',function( $user ){
          return $user->isUser();
        });
    }
}
