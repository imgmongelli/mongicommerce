<?php
namespace Mongi\Mongicommerce\Http\Controllers\shop;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\Cart;
use Mongi\Mongicommerce\Models\ProductItem;


class ShopSummaryController extends Controller
{
    public function page(){
        $products = [];
        $note = session('checkout.note_delivery');
        $get_in_shop_checkbox = session('checkout.get_in_shop_checkbox');
        $total = 0;
        if (!Auth::check()) {
            $ids = [];
            $productsCart = session('cart');
            if(isset($productsCart)){
                foreach ($productsCart as $id => $count) {
                    $product = ProductItem::where('id', $id)->first();
                    $ids[] = $id;
                    $products[] = [
                        'detail' => $product,
                        'single_price' => $product->price,
                        'count' => $count,
                        'single_weight' => $product->weight,
                        'sum_weight' => $product->weight * $count,
                        'total' => $product->price * $count
                    ];
                    $total += $product->price * $count;
                }
            }
        } else {
            $productsCart = Cart::where('user_id', Auth::user()->id)->get();
            foreach ($productsCart as $element) {
                $product = ProductItem::where('id', $element->product_id)->first();
                $products[] = [
                    'detail' => $product,
                    'single_price' => floatval($product->price),
                    'count' => $element->quantity,
                    'single_weight' => $product->weight,
                    'sum_weight' => $element->count * $product->weight,
                    'total' => $product->price * $element->count
                ];

                $total += $product->price * $element->count;
            }
        }
            $shipping_price = 0;
            session()->put('checkout.total', $total + $shipping_price);
            return view('mongicommerce.pages.summary',compact('products','total','shipping_price','note','get_in_shop_checkbox'));
    }
}
