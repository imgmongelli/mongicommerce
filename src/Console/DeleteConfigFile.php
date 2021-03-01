<?php

namespace Mongi\Mongicommerce\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class DeleteConfigFile extends Command
{
    protected $signature = 'mongicommerce:deleteconfigfile';

    protected $description = 'Delete config file';

    public function handle()
    {
        $this->alert('delete Mongicommerce config file...');

        $config_file = config_path('mongicommerce.php');
        #Config file
        if (file_exists($config_file)) {
            File::delete($config_file);
            error_log('Cancello il file di configurazione');
        }
        $this->alert('Terminate successfully');
    }
}
