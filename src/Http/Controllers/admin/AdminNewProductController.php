<?php


namespace Mongi\Mongicommerce\Http\Controllers\admin;


use Mongi\Mongicommerce\Http\Controllers\Controller;

class AdminNewProductController extends Controller
{
    public function page(){
        return view('mongicommerce::admin.pages.products.new_product');
    }
}
