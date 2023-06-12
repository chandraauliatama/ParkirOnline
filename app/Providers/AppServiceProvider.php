<?php

namespace App\Providers;

use App\Models\StaticImage;
use Filament\Facades\Filament;
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
        $staticImages = StaticImage::all()->mapWithKeys(function($image) {
            return [$image->label => $image->source];
        });
        view()->share('staticImages', $staticImages);

        Filament::serving(function () {
            // Using Vite
            Filament::registerViteTheme('resources/css/filament.css');
        });
    }
}
