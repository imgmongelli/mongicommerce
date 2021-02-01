<?php
namespace Mongi\Mongicommerce\Http\Controllers\shop;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\Cart;
use Mongi\Mongicommerce\Models\ProductItem;

class ShopCartController extends Controller
{
    public function page(){
        return view('mongicommerce.pages.cart');
    }
    /**
     * @param ProductItem $product
     * @return bool|\Illuminate\Http\JsonResponse
     */
    private function checkIfProductAvaible(ProductItem $product)
    {
        $num_avaibile_product = $product->quantity;

        $checkElement = Cart::where('product_item_id', $product->id)->first();
        //if is null it means the cart is empty
        if (is_null($checkElement)) {
            if($num_avaibile_product > 0){
                return true;
            }else{
                return false;
            }
        }else{
            //if there is something in the cart check the avaibility
            if ($checkElement->quantity + 1 <= $num_avaibile_product) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function addToCart(Request $r)
    {
        $product_item_id = $r->get('product_item_id');
        $product = ProductItem::find($product_item_id);
        $check = $this->checkIfProductAvaible($product);

        if($check){
            //if i'am not authenticated
            if (!Auth::check()) {
                session()->push('products.ids', $product_item_id);
                session()->put('cart',self::getCountableCart(session('products.ids')));
                return response()->json(session('cart'));
            }else{
                //if number i want is less than number avaible product i can add into cart
                $mycart = Cart::where('product_item_id',$product->id)->where('user_id',Auth::user()->id)->first();
                if(is_null($mycart)){
                    $cart = new Cart();
                    $cart->user_id = Auth::user()->id;
                    $cart->product_item_id = $product_item_id;
                    $cart->quantity = 1;
                    $cart->save();
                }else{
                    $mycart->quantity = $mycart->quantity + 1;
                    $mycart->save();
                }
                return true;
            }
        }else{
            return response()->json([
                'errors' => "Prodotto non disponibile o terminato",
            ], 422);
        }

    }

    public static function getCountableCart($arr)
    {
        if (!is_null($arr)) {
            return array_count_values($arr);
        } else {
            return [];
        }
    }

    public function getCartElements()
    {
        if (!Auth::check()) {
            if (!empty(session('products.ids'))) {
                return response()->json(count(session('cart')));
            } else {
                return 0;
            }

        } else {
            $products_in_cart = Cart::where('user_id', Auth::user()->id)->count();
            return response()->json($products_in_cart);
        }
    }
}
