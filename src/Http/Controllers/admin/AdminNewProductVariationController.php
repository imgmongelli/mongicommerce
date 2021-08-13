<?php


namespace Mongi\Mongicommerce\Http\Controllers\admin;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Libraries\Template;
use Mongi\Mongicommerce\Models\ConfigurationField;
use Mongi\Mongicommerce\Models\GiftCode;
use Mongi\Mongicommerce\Models\Product;
use Mongi\Mongicommerce\Models\ProductConfigurationField;
use Mongi\Mongicommerce\Models\ProductItem;
use Mongi\Mongicommerce\Models\ProductItemDetail;

class AdminNewProductVariationController extends Controller
{
    public function page($id_product){
        $product = Product::find($id_product);
        $prod_items = $product->items;
        $items = [];
        foreach ($prod_items as $prod_item) {
            if($prod_item->deleted == false) array_push($items, $prod_item);
        }
        return view('mongicommerce::admin.pages.products.new_product_variation',['product' => $product,'items' => $items]);
    }

    public function createNewVariation(Request $r){
        $r->validate([
            'category_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'image' => 'required',
            'details' => 'required|min:4',
            'weight' => 'required',
            'is_gift' => 'required',
            'duration_time' => 'required',
            'is_image_changed' => 'required'
        ]);
        $product_id = $r->get('product_id');

        $details = json_decode($r->get('details'),true);
        $configuration_fields = json_decode($r->get('configuration_fields'),true);
        $quantity = $r->get('quantity');
        $price = $r->get('price');
        $weight = $r->get('weight');
        $product_name = $r->get('product_name');
        $product_description = $r->get('product_description');
        $get_image = $r->get('image');
        $category_id = $r->get('category_id');
        $is_gift = $r->get('is_gift');
        $duration_time = $r->get('duration_time');
        $is_image_changed = $r->get('is_image_changed');

        $product = Product::find($product_id);

        $product_item = new ProductItem();
        $product_item->product_id = $product->id;
        $product_item->category_id = $category_id;
        $product_item->name = $product_name;
        $product_item->description = $product_description;
        $product_item->image = null;
        $product_item->price = $price;
        $product_item->quantity = $quantity;
        $product_item->weight = $weight;
        $product_item->save();

        $destinationPath = public_path().'/uploads/products_img/'.$product_item->product_id.'/'.$product_item->id.'/';
        $destinationPathDB = url('/').'/uploads/products_img/'.$product_item->product_id.'/'.$product_item->id.'/';

        if(!File::isDirectory($destinationPath)){
            File::makeDirectory($destinationPath, $mode = 0777, true, true);
        }

        $image_name = time().'.'.'jpeg';
        $path_file = $destinationPath.$image_name;
        $dbPath = $destinationPathDB.$image_name;

        if($is_image_changed == 'true'){
            $base64_str = substr($get_image, strpos($get_image, ",")+1);
            $image = base64_decode($base64_str);
            file_put_contents($path_file, $image);

        }else{
            File::copy($product->image, $path_file);
        }
        $product_item->image = $dbPath;
        $product_item->save();

        foreach($details as $detail){
            $detail_obj = (object) $detail;
            $product_detail = new ProductItemDetail();
            $product_detail->product_item_id = $product_item->id;
            $product_detail->product_detail_id = $detail_obj->detail_id;
            $product_detail->product_detail_value_id = $detail_obj->detail_value;
            $product_detail->save();
        }

        foreach ($configuration_fields as $conf_field){
            $conf_fields_obj = (object) $conf_field;
            $configuration_field = new ProductConfigurationField();
            $configuration_field->product_item_id = $product_item->id;
            $configuration_field->config_field_id = $conf_fields_obj->configuration_field_id;
            $configuration_field->value = $conf_fields_obj->configuration_field_value;
            $configuration_field->save();
        }

        //ceare la tabella ProductConfigurationField
        //id, product_item_id, configuration_field_id, configuration_field_value

        if($is_gift == 'true') {
            for($i = 0; $i < $quantity; $i++ ){
                $gift_code = new GiftCode();
                $gift_code->product_item_id = $product_item->id;

                //generate unique code
                $code = Template::generateCode();

                $gift_code->code = $code;
                $gift_code->is_validated = false;
                $gift_code->duration = $duration_time;
                $gift_code->save();
            }
        }
    }

    public function deleteVariation(Request $r){
        $item_id = $r->item_id;
        $product_id = $r->product_id;
        $product = Product::find($product_id);
        $product_item = ProductItem::find($item_id);
        if($product->is_gift){
            GiftCode::where('product_item_id', $product_item->id)->where('bought_the', null)->delete();
        }
        ProductItemDetail::where('product_item_id', $item_id)->delete();
        ProductConfigurationField::where('product_item_id', $item_id)->delete();
        $product_item->deleted = true;
        $product_item->save();
        return true;
    }

    public function editVariation(Request $r){
        $item_id = $r->item_id;
        $item_qta = $r->item_qta;
        $item_price = $r->item_price;
        $item_weight = $r->item_weight;
        $product_item = ProductItem::find($item_id);
        $product_item->price = $item_price;
        $product_item->weight = $item_weight;

        if(Product::find($product_item->product_id)->is_gift){
            $gift_code = GiftCode::where('product_item_id', $product_item->id)
                ->where('bought_the', null);
            $duration_time = 90;
            if($gift_code->count() > 0){
                $duration_time = $gift_code->first()->duration;
            }
            GiftCode::where('product_item_id', $product_item->id)->where('bought_the', null)->delete();

            for($i = 0; $i < $item_qta; $i++ ){
                $gift_code = new GiftCode();
                $gift_code->product_item_id = $product_item->id;
                //generate unique code
                $code = Template::generateCode();
                $gift_code->code = $code;
                $gift_code->is_validated = false;
                $gift_code->duration = $duration_time;
                $gift_code->save();
            }
        }
        $product_item->quantity = $item_qta;
        $product_item->save();
        return true;
    }

}
