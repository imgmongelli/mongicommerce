<?php
namespace Mongi\Mongicommerce\Http\Controllers\shop;

use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Libraries\Template;
use Mongi\Mongicommerce\Models\Product;

class ShopSingleProductController extends Controller
{
     public function page($id,$product_item_id = null){
         $product = Product::find($id);
         if($product_item_id == null){
             return redirect()->route('shop.single.product',[$product->id,$product->items->first()->id]);
         }
         
         $details_fields = Template::getDetailsFields($product,$product_item_id);
         $configuration_fields = Template::getConfigurationFields($product_item_id);
         $btn_cart = Template::buttonCart($product_item_id);
         $price = Product::getPrice($product_item_id);
         $image = Product::getImage($product_item_id);
         return view('mongicommerce.pages.single-product',compact('product','details_fields','configuration_fields','btn_cart','price','image'));
     }
}
