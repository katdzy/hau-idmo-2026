<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use App\Http\Middleware\isAdmin; 
use App\Http\Middleware\isSuperAdmin; 
use App\Http\Middleware\isSuperOrHR; 
use App\Http\Middleware\RevalidateBackHistory; 
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('admin', isAdmin::class);
        $router->aliasMiddleware('superAdmin', isSuperAdmin::class);
        $router->aliasMiddleware('superOrHR', isSuperOrHR::class);
        $router->aliasMiddleware('revalidate', RevalidateBackHistory::class);
    }
}
