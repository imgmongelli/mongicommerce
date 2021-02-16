<?php
namespace Mongi\Mongicommerce\Http\Controllers\shop;
use Mongi\Mongicommerce\Http\Controllers\Controller;

class ShopOrdersController extends Controller
{
    public function page(){
        return view('mongicommerce.pages.user_orders');
    }
}
