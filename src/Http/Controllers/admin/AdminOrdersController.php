<?php

namespace Mongi\Mongicommerce\Http\Controllers\admin;


use Illuminate\Http\Request;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\Order;
use Mongi\Mongicommerce\Models\OrderStatus;

class AdminOrdersController extends Controller
{
    public function page(){
        $orders = Order::all();
        $statuses = OrderStatus::all();
        return view('mongicommerce::admin.pages.orders.orders_list',['orders' => $orders,'statuses'=> $statuses]);
    }

    public function updateStatus(Request $r){
        $status_id = $r->status;
        $order_id = $r->order_id;
        $order = Order::find($order_id);
        $order->status_id = $status_id;
        $order->save();
        return true;
    }
}
