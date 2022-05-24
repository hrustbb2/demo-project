<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\AdminModulesProvider;

class AppServiceProvider extends ServiceProvider
{
    
    const ADMIN_MODULES = 'admin_modules';
    
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
        $this->loadViewsFrom(__DIR__ . '/../../src/views', 'common');
        $this->app->singleton(self::ADMIN_MODULES, function ($app) {
            return new AdminModulesProvider();
        });
    }
}
