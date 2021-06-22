<?php

namespace Mongi\Mongicommerce;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Foundation\Http\Kernel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Mongi\Mongicommerce\Console\UpdateAdmin;
use Mongi\Mongicommerce\Console\UpdateLayout;
use Mongi\Mongicommerce\Models\Category;
use Mongi\Mongicommerce\Libraries\Template;
use Mongi\Mongicommerce\Models\AdminSetting;
use Mongi\Mongicommerce\Console\UpdatePackage;
use Mongi\Mongicommerce\Console\InstallPackage;
use Mongi\Mongicommerce\Http\Middleware\AdminMiddleware;

class MongicommerceServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(Router $router, Kernel $kernel)
    {

        Blade::directive('money', function ($amount) {
            #return $fmt->formatCurrency($amount,"EUR");
            /*return "<?= $fmt->formatCurrency($amount,'EUR'); ?>";*/
            return "<?= abs($amount) > 1000 ? '€ ' .number_format($amount, 0, ',', '.') : '€ ' . number_format($amount, 2, ',', '.') ?>";
        });
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'mongicommerce');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'mongicommerce');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        if (Schema::hasTable('admin_settings')) {
            //inject global information into views
            View::share('mongicommerce', AdminSetting::first());
        }

        if (Schema::hasTable('categories')) {
            //inject global information into views
            View::share('categories', Template::getCategoryTree());
        }

        #$router->middleware(AdminMiddleware::class);
        $router->aliasMiddleware('admin',AdminMiddleware::class);


        if ($this->app->runningInConsole()) {

            
            // Publishing the config file.
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('mongicommerce.php'),
            ], 'config');


            // Publishing the views.
            
            $this->publishes([
                __DIR__ . '/../resources/views/shop' => resource_path('/views/mongicommerce'),
            ], 'views');


            // Publishing assets.
            $this->publishes([
                __DIR__ . '/../resources/assets' => public_path('/mongicommerce/template'),
            ], 'assets');
            
            #ADMIN
            // Publishing assets.
            $this->publishes([
                __DIR__ . '/../resources/assets/admin' => public_path('/mongicommerce/template/admin'),
            ], 'assets_admin');
            #SHOP
            
            $this->publishes([
                __DIR__ . '/../resources/assets/shop' => public_path('/mongicommerce/template/shop'),
            ], 'assets_shop');
    
            $this->publishes([
                __DIR__ . '/../resources/views/shop/template' => resource_path('/views/mongicommerce/template/'),
            ], 'views_layout');
            
            // Registering package commands.
            $this->commands([
                InstallPackage::class,
                UpdatePackage::class,
                UpdateAdmin::class,
                UpdateLayout::class
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
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'mongicommerce');

        // Register the main class to use with the facade
        $this->app->singleton('mongicommerce', function () {
            return new Mongicommerce;
        });
    }
}
