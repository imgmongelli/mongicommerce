<?php


namespace Mongi\Mongicommerce\Http\Controllers\admin;


use Mongi\Mongicommerce\Models\AdminSetting;

class AdminSettingsController
{
    public function page(){
        $settings = AdminSetting::first();
        return view('mongicommerce::admin.pages.settings',['settings' => $settings]);
    }
}
