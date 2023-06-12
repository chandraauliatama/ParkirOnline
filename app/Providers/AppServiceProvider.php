<?php

namespace App\Providers;

use App\Models\StaticImage;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
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
        try {
            DB::connection()->getPDO();
            $db = true;
        } catch (\Exception $e) {
            $db = false;
        }
        if ($db && Schema::hasTable('static_images')) {
            $staticImages = StaticImage::all()->mapWithKeys(function($image) {
                return [$image->label => $image->source];
            });
            
            view()->share('staticImages', $staticImages);
        } 
        
        Filament::serving(function () {
            // Using Vite
            Filament::registerViteTheme('resources/css/filament.css');
        });
    }
}
