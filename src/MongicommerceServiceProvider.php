<?php

namespace Mongi\Mongicommerce;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Mongi\Mongicommerce\Console\InstallPackage;

class MongicommerceServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'mongicommerce');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'mongicommerce');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {

            $config_file = config_path('mongicommerce.php');
            if(file_exists($config_file)){
                File::delete($config_file);
            }

            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('mongicommerce.php'),
            ], 'config');


            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/mongicommerce'),
            ], 'views');*/

            // Publishing assets.
            $this->publishes([
                __DIR__.'/../resources/assets' => public_path('/mongicommerce/template'),
            ], 'assets');

            $this->commands([
                InstallPackage::class
            ]);

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/mongicommerce'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'mongicommerce');

        // Register the main class to use with the facade
        $this->app->singleton('mongicommerce', function () {
            return new Mongicommerce;
        });
    }
}
