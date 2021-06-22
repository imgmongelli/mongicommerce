<?php


namespace Mongi\Mongicommerce\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Mongi\Mongicommerce\Seedeers\SettingsSeeder;
use Mongi\Mongicommerce\Seedeers\StasusesOrderSeeder;
use Mongi\Mongicommerce\Seedeers\TypesPaymentSeeder;

class UpdatePackage extends Command
{
    protected $signature = 'mongicommerce:update';

    protected $description = 'Update mongicommerce pay attention because rewrite everything';

    public function handle()
    {
    
        if (file_exists(resource_path('views/mongicommerce/'))) {
            File::deleteDirectory(resource_path('views/mongicommerce/'));
            $this->alert('RESOURCES ELIMINATI');
        }
    
        if (file_exists(public_path('/mongicommerce/'))) {
            File::deleteDirectory(public_path('/mongicommerce/'));
            $this->alert('FILE ASSETS ELIMINATI');
        }
      
 
        $this->call('vendor:publish', [
            '--provider' => "Mongi\Mongicommerce\MongicommerceServiceProvider",
            '--tag' => "config"
        ]);

        $this->info('Updating Admin Template');

        $this->call('vendor:publish', [
            '--provider' => "Mongi\Mongicommerce\MongicommerceServiceProvider",
            '--tag' => "assets"
        ]);

        $this->call('vendor:publish', [
            '--provider' => "Mongi\Mongicommerce\MongicommerceServiceProvider",
            '--tag' => "views"
        ]);
      
        $this->alert('Update successfully');
    }
}
