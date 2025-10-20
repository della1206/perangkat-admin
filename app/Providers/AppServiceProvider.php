<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
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
    $menuPath = resource_path('menu/menu.json');
    $menuData = file_exists($menuPath)
        ? json_decode(file_get_contents($menuPath))
        : [];

    View::share('menuData', $menuData);
}
}
