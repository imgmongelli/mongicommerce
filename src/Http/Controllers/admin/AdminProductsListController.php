<?php


namespace Mongi\Mongicommerce\Http\Controllers\admin;


use Illuminate\Http\Request;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\PrivateList;
use Mongi\Mongicommerce\Models\Product;
use Mongi\Mongicommerce\Models\ProductConfigurationField;
use Mongi\Mongicommerce\Models\ProductItem;
use Mongi\Mongicommerce\Models\ProductItemDetail;
use Mongi\Mongicommerce\Models\ProductPrivateList;

class AdminProductsListController extends Controller
{
    public function page(){
        $products = Product::all();
        $product_item = null;
        return view('mongicommerce::admin.pages.products.products_list', compact('products', 'product_item'));
    }

    public function inHome(Request $r){
        $product_id = $r->product_id;
        $is_checked = $r->is_checked == 'true' ? true : false;
        $product = Product::find($product_id);
        $product->is_home = $is_checked;
        $product->save();
        return true;
    }

    public function deleteSingleProduct(Request $r){
        $product_id = $r->product_id;
        $product_item = ProductItem::where('product_id', $product_id);
        if($product_item->count() > 0){
            $product_item_id = $product_item->first()->id;
            ProductConfigurationField::where('product_item_id', $product_item_id)->delete();
            $product_item->delete();
        }
        ProductPrivateList::where('product_id', $product_id)->delete();
        Product::find($product_id)->delete();
        return true;
    }

    public function deleteVariationProduct(Request $r){
        $product_id = $r->product_id;
        $product_items = ProductItem::where('product_id', $product_id)->get();
        foreach($product_items as $product_item) {
            $product_item_id = $product_item->id;
            ProductItemDetail::where('product_item_id', $product_item_id)->delete();
            ProductConfigurationField::where('product_item_id', $product_item_id)->delete();
            $product_item->delete();
        }
        ProductPrivateList::where('product_id', $product_id)->delete();
        Product::find($product_id)->delete();

        return true;
    }


}
