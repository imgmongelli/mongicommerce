<?php


namespace Mongi\Mongicommerce\Http\Controllers\admin;

use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\Category;
use Mongi\Mongicommerce\Models\Product;
use Mongi\Mongicommerce\Models\ProductItem;

class AdminEditSingleProductController extends Controller
{
    public function page($id_product){
        $product = Product::find($id_product);
        $product_item = ProductItem::where('product_id', $id_product)->first();
        $categories = Category::all();
        return view('mongicommerce::admin.pages.products.edit_single_product', compact('product', 'product_item', 'categories'));
    }

}
