<?php


namespace Mongi\Mongicommerce\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Mongi\Mongicommerce\Seedeers\SettingsSeeder;
use Mongi\Mongicommerce\Seedeers\StasusesOrderSeeder;
use Mongi\Mongicommerce\Seedeers\TypesPaymentSeeder;

class InstallPackage extends Command
{
    protected $signature = 'mongicommerce:install';

    protected $description = 'Install mongicommerce';

    public function handle()
    {
        $this->alert('Installing Mongicommerce...');

        $this->info('Installing configuration...');

        $this->call('vendor:publish', [
            '--provider' => "Mongi\Mongicommerce\MongicommerceServiceProvider",
            '--tag' => "config"
        ]);
        $this->info('Installing Admin Template');

        $this->call('vendor:publish', [
            '--provider' => "Mongi\Mongicommerce\MongicommerceServiceProvider",
            '--tag' => "assets"
        ]);

        $this->call('vendor:publish', [
            '--provider' => "Mongi\Mongicommerce\MongicommerceServiceProvider",
            '--tag' => "views"
        ]);


        $this->alert('clean tables and installig new tables');
        Artisan::call('migrate:refresh');


        $this->info('Installig settings e-commerce');
        $this->call(SettingsSeeder::class);

        $this->info('Installig Statuses');
        $this->call(StasusesOrderSeeder::class);

        $this->info('Installig types Payments');
        $this->call(TypesPaymentSeeder::class);

        $this->info('Installig breeze');
        Artisan::call('breeze:install');

        $this->alert('Terminate successfully');
    }
}
