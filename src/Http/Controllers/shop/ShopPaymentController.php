<?php
namespace Mongi\Mongicommerce\Http\Controllers\shop;

use Carbon\Carbon;
use Mongi\Mongicommerce\Models\GiftCode;
use Mongi\Mongicommerce\Models\OrderGift;
use Mongi\Mongicommerce\Models\Product;
use Stripe\Charge;
use Stripe\Stripe;
use Illuminate\Http\Request;
use Stripe\Exception\CardException;
use Illuminate\Support\Facades\Auth;
use Mongi\Mongicommerce\Models\Cart;
use Mongi\Mongicommerce\Models\Order;
use Illuminate\Support\Facades\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Exception\RateLimitException;
use Mongi\Mongicommerce\Models\OrderStatus;
use Mongi\Mongicommerce\Models\ProductItem;
use Mongi\Mongicommerce\Models\TypePayment;
use Mongi\Mongicommerce\Models\AdminSetting;
use Stripe\Exception\ApiConnectionException;
use Stripe\Exception\AuthenticationException;
use Stripe\Exception\InvalidRequestException;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\ProductsOrder;

class ShopPaymentController extends Controller
{
    public function page(){
            $total = session('checkout.total');
            $api_stripe_key = AdminSetting::getStripeApiKey();
            $iban = AdminSetting::getIban();
            return view('mongicommerce.pages.payment',compact('total','api_stripe_key','iban'));
    }

    public function pay(Request $request){

        try {
            $total = session('checkout.total');
            $cost_shipping = session('checkout.shipping_price');
            $order_weight = session('checkout.total_weight');

            $order_id = 0;
            $check_order = Order::orderBy('created_at','desc')->first();
            if(is_null($check_order)){
                $order_id = 1;
            }else{
                $order_id = $check_order->id + 1;
            }
            Stripe::setApiKey(AdminSetting::getStripeApiSecretKey());
            // Use Stripe's library to make requests...
            Charge::create ([
                "amount" => number_format(($total*100) , 0, '', ''),
                "currency" => "eur",
                "source" => $request->stripeToken,
                "description" => "Pagamento ordine N.".$order_id
            ]);

            $note_delivery = session('checkout.note_delivery');
            $note_order = session('checkout.note_order');
            $get_in_shop_checkbox = session('checkout.get_in_shop_checkbox');

            $order = new Order();
            $order->user_id = Auth::user()->id;
            $order->total_price = $total;
            $order->shipping_price = 0;
            $order->order_weight = 0;
            $order->status_id = OrderStatus::IN_PREPARAZIONE;
            $order->note_delivery = $note_delivery;
            $order->note_order = $note_order;
            $order->payment_type_id = TypePayment::STRIPE;
            $order->pick_up_in_shop = $get_in_shop_checkbox == 'true' ? true : false;
            $order->save();
            //save into order_products

            $get_coupon_discount_code = session('checkout.coupon.discount') ? session('checkout.coupon.discount')['code'] : null;
            if($get_coupon_discount_code != null){
                $gift_card_utilizzata = GiftCode::where('code', $get_coupon_discount_code)->whereNotNull('bought_the')->first();
                $gift_card_utilizzata->is_validated = true;
                $gift_card_utilizzata->save();
                session()->forget('checkout.coupon.discount');
            }

            $products = Cart::where('user_id', Auth::user()->id)->get();
            $are_there_gifts = false;
            $gifts_index = [];
            foreach ($products as $product){
                $order_products = new ProductsOrder();
                $order_products->order_id = $order->id;
                $order_products->product_item_id = $product->product_item_id;
                $order_products->number_products = $product->quantity;
                $order_products->save();

                //scalo quantità prodotti
                $productM = ProductItem::find($product->product_item_id);
                $productM->quantity = $productM->quantity - $product->quantity;
                $productM->save();

                //check if there are some gift cards
                $parent_product = Product::find($productM->product_id);
                if($parent_product->is_gift){
                    $are_there_gifts = true;
                    //store the product item key foreach bought gift
                    for($i = 0; $i < $product->quantity; $i++){
                        array_push($gifts_index, $productM->id);
                    }
                }
            }
            if($are_there_gifts){
                $purchased_gift = [];
                for($i = 0; $i < count($gifts_index); $i++){
                    $gift_code = GiftCode::where('product_item_id', $gifts_index[$i])->where('bought_the', null)->first();

                    //set purchase date and expiration date
                    $time_duration = $gift_code->duration;
                    $gift_code->bought_the = Carbon::now('CEST');
                    $gift_code->expires_on = Carbon::now()->addDays($time_duration);
                    $gift_code->save();
                    array_push($purchased_gift, $gift_code->id);

                    //save record in order_gift table
                    $order_gift = new OrderGift();
                    $order_gift->order_id = $order->id;
                    $order_gift->gift_code_id = $gift_code->id;
                    $order_gift->product_item_id = $gifts_index[$i];
                    $order_gift->save();
                }
            }
            //empty cart
            Cart::emptyCart();
            Session::flash('success', 'Pagamento avvenuto con successo');
            return redirect(route('shop.user.orders'));

        } catch(CardException $e) {

            // Since it's a decline, \Stripe\Exception\CardException will be caught
            $error =  '<h4>'.$e->getError()->message.'</h4><br>';
            $error .= 'Status: ' . $e->getHttpStatus() . '<br>';
            $error .= 'Type is:' . $e->getError()->type . '<br>';
            $error .= 'Code is:' . $e->getError()->code . '<br>';
            // param is '' in this case
            $error .= 'Param is:' . $e->getError()->param . '<br>';

            Session::flash('error', $error);
            return back();
        } catch (RateLimitException $e) {
            // Too many requests made to the API too quickly
            $error = $e->getError()->message;
            Session::flash('error', $error);
            return back();
        } catch (InvalidRequestException $e) {
            // Invalid parameters were supplied to Stripe's API
            $error = $e->getError()->message;
            Session::flash('error', $error);
            return back();
        } catch (AuthenticationException $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
            $error = $e->getError()->message;
            Session::flash('error', $error);
            return back();
        } catch (ApiConnectionException $e) {
            // Network communication with Stripe failed
            $error = $e->getError()->message;
            Session::flash('error', $error);
            return back();
        } catch (ApiErrorException $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            $error = $e->getError()->message;
            Session::flash('error', $error);
            return back();
        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
            $error = $e->getError()->message;
            Session::flash('error', $error);
            return back();
        }

    }

      public function normalPayment(Request $r){
        $type = $r->get('type_payment');
        switch ($type){
            case 'iban':
                $typePayment = TypePayment::BONIFICO;
                $orderStatus = OrderStatus::ATTESA_PAGAMENTO;
                break;
            case 'negozio':
                $typePayment = TypePayment::IN_NEGOZIO;
                $orderStatus = OrderStatus::ATTESA_PAGAMENTO;
                break;
        }

        $total = session('checkout.total');
        $cost_shipping = session('checkout.shipping_price');
        $order_weight = session('checkout.total_weight');
        $get_coupon_discount_code = session('checkout.coupon.discount') ? session('checkout.coupon.discount')['code'] : null;
        if($get_coupon_discount_code != null){
            $gift_card_utilizzata = GiftCode::where('code', $get_coupon_discount_code)->whereNotNull('bought_the')->first();
            $gift_card_utilizzata->is_validated = true;
            $gift_card_utilizzata->save();
            session()->forget('checkout.coupon.discount');
        }
        $note_delivery = session('checkout.note_delivery');
        $note_order = session('checkout.note_order');
        $get_in_shop_checkbox = session('checkout.get_in_shop_checkbox');

        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->total_price = $total;
        $order->shipping_price = 0;
        $order->order_weight = 0;
        $order->status_id = $orderStatus;
        $order->note_delivery = $note_delivery;
        $order->note_order = $note_order;
        $order->payment_type_id = $typePayment;
        $order->pick_up_in_shop = $get_in_shop_checkbox == 'true' ? true : false;
        $order->gift_code_id = ($get_coupon_discount_code != null) ? $gift_card_utilizzata->id : null;
        $order->save();

        //save into order_products

        $products = Cart::where('user_id',Auth::user()->id)->get();
        $are_there_gifts = false;
        $gifts_index = [];
        foreach ($products as $product){
            $order_products = new ProductsOrder();
            $order_products->order_id = $order->id;
            $order_products->product_item_id = $product->product_item_id;
            $order_products->number_products = $product->quantity;
            $order_products->save();

            //scalo quantità prodotti
            $productM = ProductItem::find($product->product_item_id);
            $productM->quantity = $productM->quantity - $product->quantity;
            $productM->save();

            //check if there are some gift cards
            $parent_product = Product::find($productM->product_id);
            if($parent_product->is_gift){
                $are_there_gifts = true;
                //store the product item key foreach bought gift
                for($i = 0; $i < $product->quantity; $i++){
                    array_push($gifts_index, $productM->id);
                }
            }
        }
        if($are_there_gifts){
            $purchased_gift = [];
            for($i = 0; $i < count($gifts_index); $i++){
                $gift_code = GiftCode::where('product_item_id', $gifts_index[$i])->where('bought_the', null)->first();

                //set purchase date and expiration date
                $time_duration = $gift_code->duration;
                $gift_code->bought_the = Carbon::now('CEST');
                $gift_code->expires_on = Carbon::now()->addDays($time_duration);
                $gift_code->save();
                array_push($purchased_gift, $gift_code->id);

                //save record in order_gift table
                $order_gift = new OrderGift();
                $order_gift->order_id = $order->id;
                $order_gift->gift_code_id = $gift_code->id;
                $order_gift->product_item_id = $gifts_index[$i];
                $order_gift->save();
            }
        }
        //empty cart
        Cart::emptyCart();
        Session::flash('success', 'Ordine inoltrato con successo. Controlla i dettagli ordine');
        return response()->json(['url'=>route('shop.user.orders')]);


    }
}
