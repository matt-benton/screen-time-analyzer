<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('components.session_table', 'session_table');
        Blade::component('components.eye_status_bar', 'eye_status_bar');
        Blade::component('components.segment_card', 'segment_card');
        Blade::component('components.inputs.glasses-select', 'glasses-select');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
