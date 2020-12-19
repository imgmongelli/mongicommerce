<?php


namespace Mongi\Mongicommerce\Http\Controllers\admin;


use Illuminate\Http\Request;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\Product;
use Mongi\Mongicommerce\Models\ProductItem;
use Mongi\Mongicommerce\Models\ProductItemDetail;

class AdminNewProductController extends Controller
{
    public function page(){
        return view('mongicommerce::admin.pages.products.new_product');
    }

    public function createNewProduct(Request $r){

        $r->validate([
            'product_name' => 'required',
            'product_description' => 'required',
            'category_id' => 'required',
        ]);

        $product_name = $r->get('product_name');
        $product_description = $r->get('product_description');
        $category_id = $r->get('category_id');

        $product = new Product();
        $product->name = $product_name;
        $product->description = $product_description;
        $product->category_id = $category_id;
        $product->save();

        return response()->json(['product_id' => $product->id]);
    }
}
