<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        $this->app->bind('path.public', function() {
            return base_path().'/../video.gov/';
        });
        
        //          $this->app->bind('path.public', function() {
        //     return '/home/grulovic/public_html/video_gov';
        // });
        
        
    }
}