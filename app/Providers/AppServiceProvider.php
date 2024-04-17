<?php

namespace App\Providers;

use App\Models\Settings;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\URL;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Settings::class, function () {
            return Settings::make(storage_path('app/settings.json'));
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        URL::forceScheme('https');

        $this->app->bind('path.public', function() {
            return base_path().'/../video-plus-public/';
        });




    }
}
