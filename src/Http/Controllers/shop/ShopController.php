<?php


namespace Mongi\Mongicommerce\Http\Controllers\shop;


use Illuminate\Http\Request;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Libraries\Template;
use Mongi\Mongicommerce\Models\Category;
use Mongi\Mongicommerce\Models\Product;

class ShopController extends Controller
{
    public function page($category_id=null){
        $products = Template::getProducts($category_id);
        $category = Category::find($category_id);
        $category_name = '';
        $category_description = '';
        if($category){
            $category_name = $category->name;
        }
        return view('mongicommerce.pages.shop',compact('products','category_name','category_description'));
    }

    public function search(Request $r){
        $r->validate([
            'query' => 'required'
        ]);
        $query = $r->input('query');
        $products = Product::where('name', 'like', "%$query%")->where('deleted', false)->get();
        return view('mongicommerce.pages.search-results', compact('products'));
    }
}
