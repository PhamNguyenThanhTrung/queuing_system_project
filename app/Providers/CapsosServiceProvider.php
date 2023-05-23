<?php

namespace App\Providers;
use App\Models\Capso;
use Illuminate\Support\ServiceProvider;

class CapsosServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        view()->composer(['thietbi', 'Thietbi', 'thietbi.showthietbi'], function ($view) {
            $capsos = Capso::all();
            $view->with('capsos', $capsos);
        });
    }
}
