<?php
namespace Mongi\Mongicommerce\Http\Controllers\shop;
use Illuminate\Support\Facades\Auth;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\Order;
use Mongi\Mongicommerce\Models\Product;


class ShopOrderDetailsController extends Controller
{
    public function page($order_id){
        $user = Auth::user();
        $order = Order::find($order_id);
        $products_items = $order->products;
        $product_bool = array();
        foreach ($products_items as $product_item) {
            $product_id = $product_item->product_id;
            $product = Product::find($product_id);
            $product_bool += [$product_id => $product->is_gift];
        }
        //check the confirm of payment if it was by wire transfer(2) or in shop(3)
        //before show gift card code
        $show_code = true;
        if($order->payment_type_id == 2 or $order->payment_type_id == 3){
            if($order->status_id == 2 or $order->status_id == 5){
                $show_code = false;
            }else{
                $show_code = true;
            }
        }
        return view('mongicommerce.pages.user_order_details', compact('products_items', 'user', 'product_bool', 'order', 'show_code'));
    }
}
