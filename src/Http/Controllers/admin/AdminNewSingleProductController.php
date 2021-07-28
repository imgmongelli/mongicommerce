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
use PHPUnit\Framework\MockObject\Stub\ReturnReference;

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
            'weight' => 'required'
        ]);

        $configuration_fields = json_decode($r->get('configuration_fields'),true);
        $quantity = $r->get('quantity');
        $price = $r->get('price');
        $weight = $r->get('weight');
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
        $product_item->weight = $weight;
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
        $r->validate([
            'product_id' => 'required',
            'is_image_changed' => 'required',
            'category_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'weight' => 'required'
        ]);

        $configuration_fields = json_decode($r->get('configuration_fields'),true);
        $quantity = $r->get('quantity');
        $price = $r->get('price');
        $weight = $r->get('weight');
        $product_name = $r->get('product_name');
        $product_description = $r->get('product_description');
        $get_image = $r->get('image');
        $category_id = $r->get('category_id');
        $product_id = $r->get('product_id');
        $is_image_changed = $r->get('is_image_changed');

        $product = Product::find($product_id);
        $product->category_id = $category_id;
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


        $product_item = ProductItem::find($product_id);
        $product_item->category_id = $category_id;
        $product_item->name = $product_name;
        $product_item->description = $product_description;
        if($is_image_changed === 'true') $product_item->image = $dbPath;
        $product_item->price = $price;
        $product_item->quantity = $quantity;
        $product_item->weight = $weight;
        $product_item->save();

        foreach ($configuration_fields as $conf_field){
            $conf_fields_obj = (object) $conf_field;
            $configuration_field = ProductConfigurationField::where('product_item_id', $product_id)
                                    ->where('config_field_id', $conf_fields_obj->configuration_field_id)
                                    ->first();
            if(isset($configuration_field)){
                $configuration_field->value = $conf_fields_obj->configuration_field_value;
                $configuration_field->save();
            }else{
                $configuration_field = new ProductConfigurationField();
                $configuration_field->product_item_id = $product_item->id;
                $configuration_field->config_field_id = $conf_fields_obj->configuration_field_id;
                $configuration_field->value = $conf_fields_obj->configuration_field_value;
                $configuration_field->save();
            }

        }

    }
}
