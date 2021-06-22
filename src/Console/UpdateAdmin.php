<?php


namespace Mongi\Mongicommerce\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;


class UpdateAdmin extends Command
{
    protected $signature = 'mongicommerce:update_admin';

    protected $description = 'Update mongicommerce admin template';

    public function handle()
    {
        $this->alert('delete Mongicommerce admin template assets...');
        
        #Public path
        if (file_exists(public_path('/mongicommerce/template/admin'))) {
            File::deleteDirectory(public_path('/mongicommerce/template/admin'));
            $this->alert('FILE ADMIN ELIMINATI');
        }
        
        $this->info('Updating Admin Template');
        
        $this->call('vendor:publish', [
           '--provider' => "Mongi\Mongicommerce\MongicommerceServiceProvider",
           '--tag' => "assets_admin"
        ]);
        
        $this->alert('Update successfully');
    }
}
