<?php

namespace Mongi\Mongicommerce\Http\Controllers\admin;


use Mongi\Mongicommerce\Models\GiftCode;
use Mongi\Mongicommerce\Models\Order;
use Mongi\Mongicommerce\Models\OrderStatus;
use Mongi\Mongicommerce\Models\ProductItem;

class AdminOrderDetailsController
{
    public function page($order_id){
        $order = Order::find($order_id);
        $cliente = $order->user;
        $products = $order->products;
        $statuses = OrderStatus::all();
        $product_item_gift = [];
        if($order->gift_code_id != null){
            $gift_code = GiftCode::find($order->gift_code_id);
            $product_item_gift = ProductItem::find($gift_code->product_item_id);
        }
        return view('mongicommerce::admin.pages.orders.order_details',compact('cliente','products','order','statuses', 'product_item_gift'));
    }
}
