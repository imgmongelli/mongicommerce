<?php

namespace Mongi\Mongicommerce\Http\Controllers\admin;


use Mongi\Mongicommerce\Models\Order;
use Mongi\Mongicommerce\Models\OrderStatus;

class AdminOrderDetailsController
{
    public function page($order_id){
        $order = Order::find($order_id);
        $cliente = $order->user;
        $products = $order->products;
        $statuses = OrderStatus::all();
        return view('mongicommerce::admin.pages.orders.order_details',compact('cliente','products','order','statuses'));
    }
}
