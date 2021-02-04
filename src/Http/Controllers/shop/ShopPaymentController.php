<?php
namespace Mongi\Mongicommerce\Http\Controllers\shop;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\Cart;
use Mongi\Mongicommerce\Models\ProductItem;


class ShopPaymentController extends Controller
{
    public function page(){
            return view('mongicommerce.pages.payment');
    }
}
