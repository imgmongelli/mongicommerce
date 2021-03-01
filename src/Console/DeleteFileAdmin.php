<?php
namespace Mongi\Mongicommerce\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class DeleteFileAdmin extends Command
{
    protected $signature = 'mongicommerce:deleteadminfiles';

    protected $description = 'Delete files assets admin';

    public function handle()
    {
        $this->alert('delete Mongicommerce admin template assets...');

        #Public path
        if (file_exists(public_path('/mongicommerce/template/admin'))) {
            File::deleteDirectory(public_path('/mongicommerce/template/admin'));
        }
        $this->alert('Terminate successfully');
    }
}
