<?php


namespace Mongi\Mongicommerce\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\Category;
use Mongi\Mongicommerce\Models\Product;
use Mongi\Mongicommerce\Models\ProductConfigurationField;
use Mongi\Mongicommerce\Models\ProductItem;
use Mongi\Mongicommerce\Models\ProductItemDetail;

class AdminNewSingleProductController extends Controller
{
    public function page(){
        $caregories = Category::all();
        return view('mongicommerce::admin.pages.products.new_single_product',['categories' => $caregories]);
    }

    public function createNewSingleProduct(Request $r){
        $r->validate([
            'category_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);

        $configuration_fields = json_decode($r->get('configuration_fields'),true);
        $quantity = $r->get('quantity');
        $price = $r->get('price');
        $product_name = $r->get('product_name');
        $product_description = $r->get('product_description');
        $get_image = $r->get('image');
        $category_id = $r->get('category_id');

        $product = new Product();
        $product->category_id = $category_id;
        $product->name = $product_name;
        $product->single_product = true;
        $product->description = $product_description;
        $product->image = null;
        $product->save();

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

        $product_item = new ProductItem();
        $product_item->product_id = $product->id;
        $product_item->category_id = $category_id;
        $product_item->name = $product_name;
        $product_item->description = $product_description;
        $product_item->image = $dbPath;
        $product_item->price = $price;
        $product_item->quantity = $quantity;
        $product_item->save();

        foreach ($configuration_fields as $conf_field){
            $conf_fields_obj = (object) $conf_field;
            $configuration_field = new ProductConfigurationField();
            $configuration_field->product_item_id = $product_item->id;
            $configuration_field->config_field_id = $conf_fields_obj->configuration_field_id;
            $configuration_field->value = $conf_fields_obj->configuration_field_value;
            $configuration_field->save();
        }

    }

    public function editSingleProduct(Request $r){
        $item_id = $r->item_id;
        $item_qta = $r->item_qta;
        $item_price = $r->item_price;
        $product_item = ProductItem::find($item_id);
        $product_item->price = $item_price;
        $product_item->quantity = $item_qta;
        $product_item->save();
        return true;
    }
}
