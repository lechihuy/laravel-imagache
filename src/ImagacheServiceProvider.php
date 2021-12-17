<?php

namespace Imagache;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ImagacheServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/imagache.php', 'imagache'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerRoutes();
    }

    /**
     * Register all routes for the package.
     * 
     * @return void
     */
    protected function registerRoutes()
    {
        Route::prefix(config('imagache.prefix'))
            ->middleware(config('imagache.middleware'), [])
            ->name('imagache.')
            ->group(function() {
                $this->loadRoutesFrom(
                    __DIR__.'/../routes/api.php'
                );
            });
    }
}