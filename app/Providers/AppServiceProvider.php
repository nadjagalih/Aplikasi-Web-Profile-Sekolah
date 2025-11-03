<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Situs;

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
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();

        config(['app.locale' => 'id']);
        Carbon::setLocale('id');

        // Share logo and situs data to all views
        View::composer('*', function ($view) {
            $situs = Situs::first();
            $view->with('logo', $situs);
            $view->with('situs', $situs);
        });
    }
}
