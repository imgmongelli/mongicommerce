<?php
namespace Mongi\Mongicommerce\Http\Controllers\shop;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\AdminSetting;
use Mongi\Mongicommerce\Models\Cart;
use Mongi\Mongicommerce\Models\Detail;
use Mongi\Mongicommerce\Models\DetailValue;
use Mongi\Mongicommerce\Models\GiftCode;
use Mongi\Mongicommerce\Models\Product;
use Mongi\Mongicommerce\Models\ProductItem;
use Mongi\Mongicommerce\Models\ProductItemDetail;


class ShopSummaryController extends Controller
{
    public function page(){
        $products = [];
        $note = session('checkout.note_delivery');
        $get_in_shop_checkbox = session('checkout.get_in_shop_checkbox');
        $get_coupon_discount_name = session('checkout.coupon.discount') ? session('checkout.coupon.discount')['name'] : null;
        $get_coupon_discount_price = session('checkout.coupon.discount') ? session('checkout.coupon.discount')['price'] : null;
        $ad_settings = AdminSetting::first();
        $total = 0;
        $total_weight = 0;
        $allGiftCards = true;

        $products_item_id = ProductItemDetail::all();
        $details = Detail::all();
        $details_value = DetailValue::all();

        if (!Auth::check()) {
            $ids = [];
            $productsCart = session('cart');
            if(isset($productsCart)){
                foreach ($productsCart as $id => $count) {
                    $product = ProductItem::where('id', $id)->first();
                    $product_parent = Product::find($product->product_id);
                    $ids[] = $id;

                    //check if in the cart there are only gift cards
                    if(!$product_parent->is_gift){
                        $allGiftCards = false;
                    }
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
                $product_parent = Product::find($product->product_id);

                //check if in the cart there are only gift cards
                if(!$product_parent->is_gift){
                    $allGiftCards = false;
                }

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
        //check discount
        if($get_coupon_discount_price != null){
            if($total + $shipping_price - $get_coupon_discount_price < 0){
                session()->put('checkout.total', 0);
            }else{
                session()->put('checkout.total', $total + $shipping_price - $get_coupon_discount_price);
            }
        }else{
            session()->put('checkout.total', $total + $shipping_price);
        }

        if($allGiftCards){
            $shipping_price = 0;
        }
        session()->put('checkout.total_weight', $total_weight);
        session()->put('checkout.shipping_price', $shipping_price);
        return view('mongicommerce.pages.summary',compact('products','total','shipping_price','note','get_in_shop_checkbox', 'get_coupon_discount_name', 'get_coupon_discount_price','products_item_id','details','details_value' ));
    }

    public function applyCoupon(Request $r){
        $r->validate([
            'gift_card_code' => 'required'
        ]);

        $input_code = $r->get('gift_card_code');

        $gift_code = GiftCode::where('code', $input_code)->whereNotNull('bought_the');

        if($gift_code->count() == 0) return ['error' => "Gift card non esistente"];

        $gift_code = $gift_code->first();
        $product_item = ProductItem::find($gift_code->product_item_id);
        if($gift_code->is_validated){
            return ['error' => "La gift card è stata già utilizzata"];
        }else if(!$gift_code->is_validated and Carbon::parse($gift_code->expires_on)->isBefore(Carbon::now())){
            return ['error' => "La gift card è scaduta"];
        }else{
            //only if the code is valid
            session()->put('checkout.coupon.discount', [
                'name' => $product_item->name,
                'code' => $gift_code->code,
                'price' => $product_item->price,
            ]);
            return response()->json(['link' => route('shop.summary')]);
            //return Redirect::back()->with('success_message', 'Buono applicato correttamente');
            //return redirect()->route('shop.summary')->with('success_message', 'Buono applicato correttamente');
        }
    }

    public function removeCoupon(){
        session()->forget('checkout.coupon.discount');
        return response()->json(['link' => route('shop.summary')]);
    }
}
