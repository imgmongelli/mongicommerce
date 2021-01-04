<?php


namespace Mongi\Mongicommerce\Http\Controllers\shop;


use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Libraries\Template;
use Mongi\Mongicommerce\Models\Product;

use Mongi\Mongicommerce\Models\ProductItem;
use Mongi\Mongicommerce\Models\ProductItemDetail;

class ShopSingleProductController extends Controller
{
     public function page($id,$product_item_id = null){
         $product = Product::find($id);
         $details_fields = Template::getDetailsFields($product);
         if($product_item_id != null){
             $product = ProductItem::find($product_item_id);
         }

         return view('mongicommerce.pages.single-product',compact('product','details_fields'));
     }
}
