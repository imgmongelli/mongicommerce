<?php


namespace Mongi\Mongicommerce\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\Category;
use Mongi\Mongicommerce\Models\GiftCode;
use Mongi\Mongicommerce\Models\Product;
use Mongi\Mongicommerce\Models\ProductConfigurationField;
use Mongi\Mongicommerce\Models\ProductItem;

class AdminEditProductVariationController extends Controller
{
    public function page($id_product){
        $product = Product::find($id_product);
        $product_item = ProductItem::where('product_id', $id_product)->first();
        $categories = Category::all();
        $gift_code = null;
        if($product->is_gift){
            $gift_code = GiftCode::where('product_item_id', $product_item->id)
                            ->where('bought_the', null)
                            ->first();
        }
        return view('mongicommerce::admin.pages.products.edit_product', compact('product', 'product_item', 'categories', 'gift_code'));
    }

    public function editProduct(Request $r){
        $r->validate([
            'product_id' => 'required',
            'product_name' => 'required',
            'product_description' => 'required',
            'is_image_changed' => 'required',
        ]);

        $product_id = $r->get('product_id');
        $product_name = $r->get('product_name');
        $product_description = $r->get('product_description');
        $is_image_changed = $r->get('is_image_changed');
        $get_image = $r->get('image');


        $product = Product::find($product_id);
        $product->name = $product_name;
        $product->description = $product_description;
        $product->save();

        if($is_image_changed == 'true'){
            $base64_str = substr($get_image, strpos($get_image, ",")+1);
            $image = base64_decode($base64_str);
            $destinationPath = public_path().'/uploads/products_img/'.$product->id.'/'.$product->id.'/';
            $destinationPathDB = url('/').'/uploads/products_img/'.$product->id.'/'.$product->id.'/';

            if(!File::isDirectory($destinationPath)){
                File::makeDirectory($destinationPath, $mode = 0777, true, true);
            }

            $image_name = time().'.'.'jpeg';
            $path_file = $destinationPath.$image_name;
            $dbPath = $destinationPathDB.$image_name;
            file_put_contents($path_file, $image);

            $product->image = $dbPath;
            $product->save();
        }


    }

}
