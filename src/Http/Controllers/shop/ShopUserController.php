<?php
namespace Mongi\Mongicommerce\Http\Controllers\shop;
use Mongi\Mongicommerce\Http\Controllers\Controller;

class ShopUserController extends Controller
{
    public function page(){
        return view('mongicommerce.pages.user_settings');
    }
}
