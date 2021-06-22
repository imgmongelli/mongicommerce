<?php


namespace Mongi\Mongicommerce\Http\Controllers\shop;


use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Libraries\Template;
use Mongi\Mongicommerce\Models\Category;
use Mongi\Mongicommerce\Models\Product;

class ShopController extends Controller
{
    public function page($category_id=null){
        $products = Template::getProducts($category_id);
        $category = Category::find($category_id);
        $dict = [];
        foreach ($products as $product) {
            $price = ProductItem::find($product->id)->price;
            $dict += [
                $product->id => $price
            ];
        }
        $category_name = '';
        $category_description = '';
        if($category){
            $category_name = $category->name;
        };
        return view('mongicommerce.pages.shop',compact('products','category_name','category_description', 'dict'));
    }
}
