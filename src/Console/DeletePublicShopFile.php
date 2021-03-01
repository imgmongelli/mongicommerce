<?php

namespace Mongi\Mongicommerce\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class DeletePublicShop extends Command
{
    protected $signature = 'mongicommerce:deleteshop';

    protected $description = 'Delete shop files [PAY ATTENTION]';

    public function handle()
    {
        $this->alert('deleting...');
        $this->alert('delete Mongicommerce ASSETS file...');

        if (file_exists(public_path('/mongicommerce/template/shop'))) {
            File::deleteDirectory(public_path('/mongicommerce/template/shop'));
        }

        $this->alert('Assets shop deleted successfully!');

        if (file_exists(resource_path('/views/mongicommerce'))) {
            File::deleteDirectory(resource_path('/views/mongicommerce'));
        }
        $this->alert('Views shop deleted successfully');
    }
}
