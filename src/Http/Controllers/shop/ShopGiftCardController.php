<?php
namespace Mongi\Mongicommerce\Http\Controllers\shop;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\GiftCode;
use Mongi\Mongicommerce\Models\Order;
use Mongi\Mongicommerce\Models\OrderGift;
use Mongi\Mongicommerce\Models\Product;
use Mongi\Mongicommerce\Models\ProductItem;


class ShopGiftCardController extends Controller
{
    public function page($order_id, $product_item_id){
        $gifts_info = array();
        $orders_gifts = OrderGift::where('order_id', $order_id)->where('product_item_id', $product_item_id)->get();
        foreach($orders_gifts as $order_gift){
//            array_push($gifts_codes, GiftCode::find($order_gift->gift_code_id));
            $gift_code = GiftCode::find($order_gift->gift_code_id);
            $product_item = ProductItem::find($product_item_id);
            $gift_info = [
                'name' => $product_item->name,
                'price' => $product_item->price,
                'bought_the' => Carbon::make($gift_code->bought_the)->format('d/m/y'),
                'expires_on' => Carbon::make($gift_code->expires_on)->format('d/m/y'),
                'duration' => $gift_code->duration,
                'code' => $gift_code->code
            ];
            array_push($gifts_info, $gift_info);
        }
        return view('mongicommerce.pages.gift_card', compact('gifts_info'));
    }

//    public function downloadGift(Request $r){
//        $r->validate([
//            'product_item_id' => 'required',
//            'order_id' => 'required',
//            'product_index' => 'required'
//        ]);
//
//        $product_item_id = $r->get('product_item_id');
//        $order_id = $r->get('order_id');
//        $index = $r->get('product_index');
//
//        $order_gift = OrderGift::where('order_id', $order_id)->where('product_item_id', $product_item_id)->get()[$index];
//        $gift_code = GiftCode::find($order_gift->gift_code_id);
//        return $gift_code->code;
//    }
}
