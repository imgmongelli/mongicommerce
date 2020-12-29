<?php

namespace Mongi\Mongicommerce\Http\Controllers\admin;


use Mongi\Mongicommerce\Models\Order;

class AdminOrdersController
{
    public function page(){
        $orders = Order::all();
        return view('mongicommerce::admin.pages.orders.orders_list',['orders' => $orders]);
    }
}
