<?php
namespace Mongi\Mongicommerce\Http\Controllers\shop;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\Cart;
use Mongi\Mongicommerce\Models\Detail;
use Mongi\Mongicommerce\Models\DetailValue;
use Mongi\Mongicommerce\Models\ProductItem;
use Mongi\Mongicommerce\Models\ProductItemDetail;

class ShopCartController extends Controller
{
    public function page(){

        $products_item_id = ProductItemDetail::all();
        $details = Detail::all();
        $details_value = DetailValue::all();
        $cartItems = Cart::all();

        return view('mongicommerce.pages.cart',compact('products_item_id','details','details_value','cartItems'));
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

    public static function calculateTotalPrice(array $cart)
    {
        $info_totale = [];
        $total = [];
        $totale_weight = [];
        foreach ($cart as $element) {
            $total[] = $element['total'];
            $totale_weight[] = $element['sum_weight'];
        }
        $info_totale = [
            'total' => array_sum($total),
            'totale_weight' => array_sum($totale_weight)
        ];

        return $info_totale;
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

    public function getCartProducts()
    {
        $products = [];
        if (!Auth::check()) {
            $ids = [];
            session()->forget('products.ids');
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
                }
            }
            session()->put('products.ids',$ids);

        } else {
            $productsCart = Cart::where('user_id', Auth::user()->id)->get();
            foreach ($productsCart as $element) {
                $product = ProductItem::where('id', $element->product_item_id)->first();
                $products[] = [
                    'detail' => $product,
                    'single_price' => $product->price,
                    'count' => $element->quantity,
                    'single_weight' => 0,
                    'sum_weight' => 0,
                    'total' => $product->price * $element->quantity
                ];
            }
        }
        $products_item_id = ProductItemDetail::all();
        $products_item_id_res = [];
        foreach ($products_item_id as $curr) {
            $products_item_id_res[] = [
                'detail' => $curr,
                'id' => $curr->product_item_id,
                'product_detail_id' => $curr->product_detail_id,
                'product_detail_value_id' => $curr->product_detail_value_id
            ];
        }
        $details = Detail::all();
        $details_res = [];
        foreach ($details as $curr) {
            $details_res[] = [
                'detail' => $curr,
                'id' => $curr->id,
                'name' => $curr->name
            ];
        }
        $details_value = DetailValue::all();
        $details_value_res = [];
        foreach ($details_value as $curr) {
            $details_value_res[] = [
                'detail' => $curr,
                'id' => $curr->id,
                'value' => $curr->value
            ];
        }
        return response()->json(['product' => $products , 'total' => self::calculateTotalPrice($products),
            'products_item_id_res' => $products_item_id_res , 'details_res' => $details_res , 'details_value_res' => $details_value_res ]);
    }

    public function incrementOrDecrementElementInCart(Request $r){
        $product_id = $r->get('product_id');
        $operator = $r->get('operator');
        $product = ProductItem::find($product_id);
        if (!Auth::check()) {
            $cart = session('cart');
            $count_product_in_session = $cart[$product_id];
            if($product->quantity > $count_product_in_session || $operator < 0){
                if($count_product_in_session > 1 || $operator > 0){
                    $cart[$product_id] = $count_product_in_session + $operator;
                    session()->put('cart',$cart);
                }
            }
        }else{
            $cart = Cart::where('product_item_id',$product_id)->first();
            if($product->quantity > $cart->quantity || $operator < 0){
                if($cart->quantity > 1 || $operator > 0){
                    $cart->quantity = $cart->quantity + $operator;
                    $cart->save();
                }
            }
        }

    }

    public function deleteFromCart(Request $r){
        $product_id = $r->get('product_id');
        if (!Auth::check()) {
            $cart_in_session = session('cart');
            unset($cart_in_session[$product_id]);
            session()->put('cart',$cart_in_session);
        }else{
            Cart::where('product_item_id',$product_id)->delete();
            return true;
        }
    }
}
