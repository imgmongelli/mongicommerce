<?php


namespace Mongi\Mongicommerce\Http\Controllers\admin;


use Illuminate\Http\Request;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\PrivateList;
use Mongi\Mongicommerce\Models\Product;
use Mongi\Mongicommerce\Models\ProductConfigurationField;
use Mongi\Mongicommerce\Models\ProductItem;

class AdminProductsListController extends Controller
{
    public function page(){
        $products = Product::all();
        return view('mongicommerce::admin.pages.products.products_list',['products' => $products]);
    }

    public function inHome(Request $r){
        $product_id = $r->product_id;
        $is_checked = $r->is_checked == 'true' ? true : false;
        $product = Product::find($product_id);
        $product->is_home = $is_checked;
        $product->save();
        return true;
    }

    public function deleteProduct(Request $r){
        $product_id = $r->product_id;
        $product_item = ProductItem::where('product_id', $product_id);
        $product_item_id = $product_item->first()->id;
        ProductConfigurationField::where('product_item_id', $product_item_id)->delete();
        $product_item->delete();
        Product::find($product_id)->delete();
        return true;
    }

}
