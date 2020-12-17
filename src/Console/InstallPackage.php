<?php


namespace Mongi\Mongicommerce\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Mongi\Mongicommerce\Seedeers\DetailTypeSeeder;

class InstallPackage extends Command
{
    protected $signature = 'mongicommerce:install';

    protected $description = 'Install mongicommerce';

    public function handle()
    {
        $this->info('Installing Mongicommerce...');

        $this->info('Publishing configuration...');

        $this->call('vendor:publish', [
            '--provider' => "Mongi\Mongicommerce\MongicommerceServiceProvider",
            '--tag' => "config"
        ]);
        $this->info('Publishing Admin Template');

        $this->call('vendor:publish', [
            '--provider' => "Mongi\Mongicommerce\MongicommerceServiceProvider",
            '--tag' => "assets"
        ]);


        $this->info('Installig Tables');
        Artisan::call('migrate:refresh');
        $this->info('Installig Options');
        #$this->call(DetailTypeSeeder::class);
        $this->info('Terminate successfully');
    }
}
