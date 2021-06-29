<?php
namespace Mongi\Mongicommerce\Http\Controllers\admin;

use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\Order;
use Mongi\Mongicommerce\Models\OrderStatus;
use Mongi\Mongicommerce\Models\Product;

class DashboardController extends Controller
{
    public function page(){
        $orders = Order::all();
        $statuses = OrderStatus::all();
        $current_orders = 0;
        $completed_orders = 0;
        foreach($orders as $order){
            if($order->status_id < 4) {
                $current_orders++;
            } elseif($order->status_id === 4) {
                $completed_orders++;
            }
        }
        $products = Product::all();
        $products_number = $products->count();
        return view('mongicommerce::admin.pages.dashboard', compact('orders', 'statuses', 'current_orders', 'completed_orders', 'products_number'));
    }
}
