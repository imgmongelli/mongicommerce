<?php


namespace Mongi\Mongicommerce\Http\Controllers\admin;


class DashboardController
{
    public function page(){
        return view('mongicommerce::admin.pages.dashboard');
    }
}
