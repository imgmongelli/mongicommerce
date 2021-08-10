<?php


namespace Mongi\Mongicommerce\Http\Controllers\admin;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
            'image' => 'required',
            'is_gift' => 'required'
        ]);

        $product_name = $r->get('product_name');
        $product_description = $r->get('product_description');
        $category_id = $r->get('category_id');
        $get_image = $r->get('image');
        $is_gift = $r->get('is_gift');


        $product = new Product();
        $product->name = $product_name;
        $product->description = $product_description;
        $product->category_id = $category_id;
        $product->is_gift = $is_gift == 'true' ? true : false;
        $product->save();

        $base64_str = substr($get_image, strpos($get_image, ",")+1);
        $image = base64_decode($base64_str);
        $destinationPath = public_path().'/uploads/products_img/'.$product->id.'/';
        $destinationPathDB = url('/').'/uploads/products_img/'.$product->id.'/';

        if(!File::isDirectory($destinationPath)){
            File::makeDirectory($destinationPath, $mode = 0777, true, true);
        }
        $image_name = time().'.'.'jpeg';
        $path_file = $destinationPath.$image_name;
        $dbPath = $destinationPathDB.$image_name;
        file_put_contents($path_file, $image);

        $product->image = $dbPath;
        $product->save();


        return response()->json(['product_id' => $product->id]);
    }
}
