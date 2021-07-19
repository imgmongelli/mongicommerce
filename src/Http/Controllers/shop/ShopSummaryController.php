<?php
namespace Mongi\Mongicommerce\Http\Controllers\shop;

use Illuminate\Support\Facades\Auth;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\AdminSetting;
use Mongi\Mongicommerce\Models\Cart;
use Mongi\Mongicommerce\Models\ProductItem;


class ShopSummaryController extends Controller
{
    public function page(){
        $products = [];
        $note = session('checkout.note_delivery');
        $get_in_shop_checkbox = session('checkout.get_in_shop_checkbox');
        $ad_settings = AdminSetting::first();
        $total = 0;
        $total_weight = 0;
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
                    $total_weight += $product->weight * $count;
                }
            }
        } else {
            $productsCart = Cart::where('user_id', Auth::user()->id)->get();
            foreach ($productsCart as $element) {
                $product = ProductItem::where('id', $element->product_item_id)->first();

                $products[] = [
                    'detail' => $product,
                    'single_price' => floatval($product->price),
                    'count' => $element->quantity,
                    'single_weight' => $product->weight,
                    'sum_weight' => $element->quantity * $product->weight,
                    'total' => $product->price * $element->quantity
                ];

                $total += $product->price * $element->quantity;
                $total_weight += $product->weight * $element->quantity;
            }
        }
        $shipping_price = 0;
        if($get_in_shop_checkbox != 'true' && $total < $ad_settings->free_delivery){
            if($ad_settings->is_by_weight){
                if($total_weight <= 5){
                    $shipping_price = $ad_settings->delivery_less_5;
                }
                if($total_weight > 5 && $total_weight <= 10){
                    $shipping_price = $ad_settings->delivery_less_10;
                }
                if($total_weight > 10 && $total_weight <= 20){
                    $shipping_price = $ad_settings->delivery_less_20;
                }
                if($total_weight > 20 && $total_weight <= 30){
                    $shipping_price = $ad_settings->delivery_less_30;
                }
                if($total_weight > 30 && $total_weight <= 50){
                    $shipping_price = $ad_settings->delivery_less_50;
                }
            } else {
                $shipping_price = $ad_settings->min_delivery;
            }
        }
        session()->put('checkout.total', $total + $shipping_price);
        session()->put('checkout.total_weight', $total_weight);
        session()->put('checkout.shipping_price', $shipping_price);
        return view('mongicommerce.pages.summary',compact('products','total','shipping_price','note','get_in_shop_checkbox'));
    }
}
