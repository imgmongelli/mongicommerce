<?php


namespace Mongi\Mongicommerce\Http\Controllers\admin;


use Illuminate\Support\Facades\Artisan;

class AdminUpdatePackageController
{
    public function update(){
        exec('composer update mongi/mongicommerce');
        Artisan::call('mongi:install');
    }
}
