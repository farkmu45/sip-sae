<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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

        Filament::serving(function () {
            Filament::registerTheme(mix('css/filament.css'));
        });


        Filament::registerScripts([
            'https://unpkg.com/flowbite@1.4.7/dist/datepicker.js'
        ]);
    }
}
