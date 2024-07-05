<?php

namespace App\Providers;

use App\Models\Settings;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        
        $settings = Settings::first();
        if ($settings) {
            View::share('settings', $settings);
        }
    }
}
