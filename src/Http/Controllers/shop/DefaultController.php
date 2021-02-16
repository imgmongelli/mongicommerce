<?php
namespace Mongi\Mongicommerce\Http\Controllers\shop;
use Mongi\Mongicommerce\Http\Controllers\Controller;

class DefaultController extends Controller
{
    public function page(){
        return view('mongicommerce.pages.default');
    }
}
