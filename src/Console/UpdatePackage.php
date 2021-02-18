<?php


namespace Mongi\Mongicommerce\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Mongi\Mongicommerce\Seedeers\SettingsSeeder;
use Mongi\Mongicommerce\Seedeers\StasusesOrderSeeder;
use Mongi\Mongicommerce\Seedeers\TypesPaymentSeeder;

class UpdatePackage extends Command
{
    protected $signature = 'mongicommerce:update';

    protected $description = 'Update mongicommerce';

    public function handle()
    {

        $this->alert('Updating Mongicommerce...');

        $this->info('Updating configuration...');

        $this->call('vendor:publish', [
            '--provider' => "Mongi\Mongicommerce\MongicommerceServiceProvider",
            '--tag' => "config"
        ]);
        /*
        $this->info('Updating Admin Template');

        $this->call('vendor:publish', [
            '--provider' => "Mongi\Mongicommerce\MongicommerceServiceProvider",
            '--tag' => "assets"
        ]);

        $this->call('vendor:publish', [
            '--provider' => "Mongi\Mongicommerce\MongicommerceServiceProvider",
            '--tag' => "views"
        ]);
        */
        $this->alert('Update successfully');
    }
}
