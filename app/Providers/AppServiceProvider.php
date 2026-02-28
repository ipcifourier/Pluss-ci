<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Gtt;

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
        //
        //Partager la liste des GTT avec le layout
    View::composer('layouts.app', function ($view) {
        $view->with('menuGtts', Gtt::where('is_published', true)->get());
    });
        
    }
}
