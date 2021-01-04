<?php


namespace Mongi\Mongicommerce\Http\Controllers\admin;


use Illuminate\Support\Facades\Artisan;
use Mongi\Mongicommerce\Http\Controllers\Controller;

class AdminUpdatePackageController extends Controller
{
    public function update(){
        #$dd = shell_exec('cd .. && composer update mongi/mongicommerce');
        $dd = shell_exec('cd .. && php artisan mongicommerce:update');
        echo '<pre>';
        var_dump($dd);
        echo '</pre>';
    }
}
