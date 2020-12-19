<?php


namespace Mongi\Mongicommerce\Http\Controllers\admin;


use Illuminate\Http\Request;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\Product;
use Mongi\Mongicommerce\Models\ProductItem;
use Mongi\Mongicommerce\Models\ProductItemDetail;

class AdminNewProductVariationController extends Controller
{
    public function page($id_product){
        $product = Product::find($id_product);
        return view('mongicommerce::admin.pages.products.new_product_variation',['product' => $product]);
    }

    public function createNewVariation(Request $r){
        $r->validate([
            'category_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'details' => 'required|min:4',
        ]);
        $product_id = $r->get('product_id');

        $details = json_decode($r->get('details'),true);
        $quantity = $r->get('quantity');
        $price = $r->get('price');

        $product = Product::find($product_id);

        $product_item = new ProductItem();
        $product_item->product_id = $product->id;
        $product_item->img = null;
        $product_item->price = $price;
        $product_item->quantity = $quantity;
        $product_item->save();

        foreach($details as $detail){
            $detail_obj = (object) $detail;
            $product_detail = new ProductItemDetail();
            $product_detail->product_item_id = $product_item->id;
            $product_detail->product_detail_id = $detail_obj->detail_id;
            $product_detail->product_detail_value_id = $detail_obj->detail_value;
            $product_detail->save();
        }

    }
}
