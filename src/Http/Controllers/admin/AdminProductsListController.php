<?php


namespace Mongi\Mongicommerce\Http\Controllers\admin;


use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\Product;

class AdminProductsListController extends Controller
{
    public function page(){
        $products = Product::all();
        return view('mongicommerce::admin.pages.products.products_list',['products' => $products]);
    }
}
