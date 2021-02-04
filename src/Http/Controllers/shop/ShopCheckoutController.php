<?php
namespace Mongi\Mongicommerce\Http\Controllers\shop;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mongi\Mongicommerce\Http\Controllers\Controller;


class ShopCheckoutController extends Controller
{
    public function page(){
            $note = session('checkout.note_delivery');
            $delivery_where = session('checkout.get_in_shop_checkbox');
            return view('mongicommerce.pages.checkout',compact('note','delivery_where'));
    }

    public function saveDetailsInSession(Request $r){
        $note_delivery = $r->get('note_delivery');
        $get_in_shop_checkbox = $r->get('get_in_shop_checkbox');
        session()->put('checkout.note_delivery', $note_delivery);
        session()->put('checkout.get_in_shop_checkbox', $get_in_shop_checkbox);
        return response()->json(['link' => route('shop.summary')]);
    }
}
