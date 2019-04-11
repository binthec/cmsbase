<?php
/**
 * Created by PhpStorm.
 * User: minako
 * Date: 2019/04/10
 * Time: 22:10
 */

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
//        $this->loadRoutesFrom(__DIR__.'/routes.php');
//
//        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
//
//        $this->loadViewsFrom(__DIR__.'/resources/views', 'cmsbase');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->register(\Providers\RouteServiceProvider::class);
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