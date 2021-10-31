<?php
namespace Mongi\Mongicommerce\Http\Controllers\shop;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\Product;
use Mongi\Mongicommerce\Models\Volantino;

class DefaultController extends Controller
{
    public function page(){
        #dd(asset('mongicommerce/template/shop/css/animate.css'));
        $volantini = Volantino::all();
        $productsInHome = Product::where('is_home',true)->where('deleted', false)
            ->where('is_reserved', false)->get();
        return view('mongicommerce.pages.landing',compact('volantini','productsInHome'));
    }
}
