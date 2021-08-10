<?php


namespace Mongi\Mongicommerce\Http\Controllers\admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\Category;
use Mongi\Mongicommerce\Models\GiftCode;
use Mongi\Mongicommerce\Models\Product;
use Mongi\Mongicommerce\Models\ProductConfigurationField;
use Mongi\Mongicommerce\Models\ProductItem;

class AdminEditSingleProductController extends Controller
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
        return view('mongicommerce::admin.pages.products.edit_single_product', compact('product', 'product_item', 'categories', 'gift_code'));
    }

    public function editSingleProduct(Request $r){
        $r->validate([
            'product_id' => 'required',
            'is_image_changed' => 'required',
            'category_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'weight' => 'required',
            'is_gift' => 'required',
            'duration_time' => 'required'

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
        $is_gift = $r->get('is_gift');
        $duration_time = $r->get('duration_time');

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


        $product_item = ProductItem::where('product_id', $product_id)->first();
        $old_qta = $product_item->quantity;
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
            $configuration_field = ProductConfigurationField::where('product_item_id', $product_item->id)
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

        if($is_gift == 'true') {
            if($old_qta == $quantity){
                $gift_codes = GiftCode::where('product_item_id', $product_item->id)->get();
                foreach($gift_codes as $gift_code) {
                    if($gift_code->bought_the == null){
                        $gift_code->duration = $duration_time;
                        $gift_code->save();
                    }
                }
            }else{
                GiftCode::where('product_item_id', $product_item->id)
                            ->where('bought_the', null)
                            ->delete();
                for($i = 0; $i < $quantity; $i++ ){
                    $gift_code = new GiftCode();
                    $gift_code->product_item_id = $product_item->id;
                    //generate unique code
                    $code = Self::generateCode();
                    $gift_code->code = $code;
                    $gift_code->is_validated = false;
                    $gift_code->duration = $duration_time;
                    $gift_code->save();
                }
            }
        }

    }

    public static function generateCode(){
        $random_string = Str::random(5);

        $today = Carbon::now();
        $day = $today->day;
        $mm = $today->month;
        $yy = $today->year;
        $h = $today->hour;
        $mill = $today->milliseconds;

        $date_prod = $day * $mm * $yy;
        $time_sum = $h + $mill;
        $str = $date_prod - $time_sum;

        if(strlen($str) > 5){
            $str = substr($str, 0, 5);
        }else if(strlen($str) < 5){
            $diff = 5 - strlen($str);
            for($i = 0; $i < $diff; $i++){
                $str .= $i;
            }
        }
        return 'GIFT-'.$str.'-'.$random_string;
    }
}
