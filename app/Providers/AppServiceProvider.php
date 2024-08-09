<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Pengaju;

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
        view()->composer(['pengaju.status', 'pengaju.result'], function($view){
            $view->with('pengajus', Pengaju::all());
        });
    }
}
