<?php
namespace Mongi\Mongicommerce\Http\Controllers\shop;
use Illuminate\Support\Facades\Auth;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\Order;

class ShopOrdersController extends Controller
{
    public function page(){
        $user = Auth::user();
        $orders = Order::where('user_id',$user->id)->get();
        return view('mongicommerce.pages.user_orders',compact('user','orders'));
    }
}
