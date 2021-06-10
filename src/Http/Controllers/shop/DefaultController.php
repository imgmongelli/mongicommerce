<?php
namespace Mongi\Mongicommerce\Http\Controllers\shop;
use Mongi\Mongicommerce\Http\Controllers\Controller;

class DefaultController extends Controller
{
    public function page(){
        #dd(asset('mongicommerce/template/shop/css/animate.css'));
        return view('mongicommerce.pages.landing');
    }
}
