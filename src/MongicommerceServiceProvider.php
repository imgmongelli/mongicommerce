<?php

namespace Mongi\Mongicommerce;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Mongi\Mongicommerce\Console\InstallPackage;
use Mongi\Mongicommerce\Console\UpdatePackage;
use Mongi\Mongicommerce\Libraries\Template;
use Mongi\Mongicommerce\Models\AdminSetting;
use Mongi\Mongicommerce\Models\Category;

class MongicommerceServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {

        Blade::directive('money', function ($amount){
            #return $fmt->formatCurrency($amount,"EUR");
            /*return "<?= $fmt->formatCurrency($amount,'EUR'); ?>";*/
            return "<?= abs($amount) > 1000 ? '€ ' .number_format($amount, 0, ',', '.') : '€ ' . number_format($amount, 2, ',', '.') ?>";

        });
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'mongicommerce');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'mongicommerce');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        if(Schema::hasTable('admin_settings')){
            //inject global information into views
            View::share('mongicommerce', AdminSetting::first());
        }

        if(Schema::hasTable('categories')){
            //inject global information into views
            View::share('categories', Template::getStructureCategories());
        }


        if ($this->app->runningInConsole()) {

            $config_file = config_path('mongicommerce.php');

            /*
                if(file_exists($config_file)){
                    File::delete($config_file);
                    error_log('Cancello il file di configurazione');
                }


                if(file_exists(resource_path('/views/mongicommerce'))){
                    File::deleteDirectory(resource_path('/views/mongicommerce'));
                }

                if(file_exists(public_path('/mongicommerce/template'))){
                    File::deleteDirectory(public_path('/mongicommerce/template'));
                }
            */

            // Publishing the config file.
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('mongicommerce.php'),
            ], 'config');


            // Publishing the views.
            $this->publishes([
                __DIR__.'/../resources/views/shop' => resource_path('/views/mongicommerce'),
            ], 'views');


            // Publishing assets.
            $this->publishes([
                __DIR__.'/../resources/assets' => public_path('/mongicommerce/template'),
            ], 'assets');

            // Registering package commands.
            $this->commands([
                InstallPackage::class,
                UpdatePackage::class
            ]);

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/mongicommerce'),
            ], 'lang');*/

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
