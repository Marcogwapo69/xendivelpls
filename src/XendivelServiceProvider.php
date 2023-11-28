<?php

namespace GlennRaya\Xendivel;

use Illuminate\Support\ServiceProvider;

class XendivelServiceProvider extends ServiceProvider
{
    /**
     * Register Xendivel services.
     */
    public function register(): void
    {
        $this->app->singleton(Xendivel::class, function () {
            return new Xendivel();
        });
    }

    /**
     * Bootstrap Xendivel services.
     */
    public function boot(): void
    {
        // Publishes the Xendivel configuration file to the config directory.
        // `php artisan vendor:publish --tag=xendivel-config`
        $this->publishes([
            __DIR__.'/../config/xendivel.php' => config_path('xendivel.php'),
        ], 'xendivel-config');

        // Publishes Xendivel's view assets to the resources directory of your project.
        // `php artisan vendor:publish --tag=xendivel-views`
        $this->publishes([
            __DIR__.'/../resources/views/cards.blade.php' => resource_path('views/vendor/xendivel/cards.blade.php'),
        ], 'xendivel-views');

        // Xendivel ships with example web and API routes so you could easily test
        // the example files like the cards, ewallet, and subscription templates.
        $this->loadRoutesFrom(__DIR__.'/../routes/xendivel-routes.php');
    }
}
