<?php
namespace Mongi\Mongicommerce\Http\Controllers\shop;

use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Libraries\Template;
use Mongi\Mongicommerce\Models\Product;
use Mongi\Mongicommerce\Models\ProductItem;

class ShopSingleProductController extends Controller
{
     public function page($id,$product_item_id = null){
         $product = Product::find($id);
         if($product_item_id == null){
            $product_items = ProductItem::where('product_id', $id)->where('deleted', false);
            if($product_items->count() == 0) {
                $err = true;
                return view('mongicommerce.pages.single-product', compact('product', 'err'));
            }
            foreach($product_items->get() as $product_item){
                return redirect()->route('shop.single.product',[$product->id, $product_item->id]);
            }
         }else if(ProductItem::find($product_item_id)->deleted == true){
             $err = true;
             return view('mongicommerce.pages.single-product', compact('product', 'err'));
         }

         $details_fields = Template::getDetailsFields($product,$product_item_id);
         $configuration_fields = Template::getConfigurationFields($product_item_id);
         $btn_cart = Template::buttonCart($product_item_id);
         $price = Product::getPrice($product_item_id);
         $image = Product::getImage($product_item_id);
         $description = Product::getDescription($product_item_id);
         $name = Product::getName($product_item_id);
         $qr = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=".url()->current();

         return view('mongicommerce.pages.single-product',compact('product','details_fields','configuration_fields','btn_cart','price','image','description','name','qr'));
     }
}
