<?php
namespace Mongi\Mongicommerce\Http\Controllers\admin;

use Mongi\Mongicommerce\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function page(){
        return view('mongicommerce::admin.pages.dashboard');
    }
}
