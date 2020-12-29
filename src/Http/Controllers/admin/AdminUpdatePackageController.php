<?php


namespace Mongi\Mongicommerce\Http\Controllers\admin;


use Illuminate\Support\Facades\Artisan;
use Mongi\Mongicommerce\Http\Controllers\Controller;

class AdminUpdatePackageController extends Controller
{
    public function update(){
       $dd = shell_exec('composer update 2>&1 mongi/mongicommerce');
        echo '<pre>';
        var_dump($dd);
        echo '</pre>';

    }
}
