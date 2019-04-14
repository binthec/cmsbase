<?php

namespace Binthec\CmsBase;

use Illuminate\Support\ServiceProvider;

class CmsBaseServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
//        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'cmsbase');

        $this->publishes([__DIR__ . '/public/backend' => public_path('/backend'),], 'public');
        $this->publishes([__DIR__ . '/public/frontend' => public_path('/frontend'),], 'public');
        $this->publishes([__DIR__ . '/public/common' => public_path('/common'),], 'public');
        $this->publishes([__DIR__ . '/public/lib' => public_path('/lib'),], 'public');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\Binthec\CmsBase\Providers\RouteServiceProvider::class);
    }

//    /**
//     * Get the services provided by the provider.
//     *
//     * @return array
//     */
//    public function provides()
//    {
//        return ['cmsbase'];
//    }
}