<?php


namespace Mongi\Mongicommerce\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;


class UpdateLayout extends Command
{
    protected $signature = 'mongicommerce:update_layout';

    protected $description = 'Update only shops layout and assets';

    public function handle()
    {
        $this->alert('delete layout shop');
    
        #RESOURCE path
        if (file_exists(resource_path('views/mongicommerce/template/'))) {
            File::deleteDirectory(resource_path('views/mongicommerce/template/'));
            $this->alert('LAYOUT ELIMINATO');
        }
    
        if (file_exists(public_path('/mongicommerce/template/shop'))) {
            File::deleteDirectory(public_path('/mongicommerce/template/shop'));
            $this->alert('FILE ASSETS SHOP ELIMINATI');
        }
        
        $this->alert('copio file assets shop');
        
        $this->call('vendor:publish', [
            '--provider' => "Mongi\Mongicommerce\MongicommerceServiceProvider",
            '--tag' => "assets_shop"
        ]);
    
        $this->call('vendor:publish', [
            '--provider' => "Mongi\Mongicommerce\MongicommerceServiceProvider",
            '--tag' => "views_layout"
        ]);
       
        $this->info("DONE");
        
        
    }
}
