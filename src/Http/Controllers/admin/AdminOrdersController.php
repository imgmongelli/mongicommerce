<?php

namespace Mongi\Mongicommerce\Http\Controllers\admin;


use Mongi\Mongicommerce\Models\Order;
use Mongi\Mongicommerce\Models\OrderStatus;

class AdminOrdersController
{
    public function page(){
        $orders = Order::all();
        $statuses = OrderStatus::all();
        return view('mongicommerce::admin.pages.orders.orders_list',['orders' => $orders,'statuses'=> $statuses]);
    }
}
