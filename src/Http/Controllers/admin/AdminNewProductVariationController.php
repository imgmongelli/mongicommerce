<?php


namespace Mongi\Mongicommerce\Http\Controllers\admin;


use Illuminate\Http\Request;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\ConfigurationField;
use Mongi\Mongicommerce\Models\Product;
use Mongi\Mongicommerce\Models\ProductConfigurationField;
use Mongi\Mongicommerce\Models\ProductItem;
use Mongi\Mongicommerce\Models\ProductItemDetail;

class AdminNewProductVariationController extends Controller
{
    public function page($id_product){
        $product = Product::find($id_product);
        $items = $product->items;

        return view('mongicommerce::admin.pages.products.new_product_variation',['product' => $product,'items' => $items]);
    }

    public function createNewVariation(Request $r){
        $r->validate([
            'category_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'details' => 'required|min:4',
        ]);
        $product_id = $r->get('product_id');

        $details = json_decode($r->get('details'),true);
        $configuration_fields = json_decode($r->get('configuration_fields'),true);
        $quantity = $r->get('quantity');
        $price = $r->get('price');
        $product_name = $r->get('product_name');
        $product_description = $r->get('product_description');

        $product = Product::find($product_id);

        $product_item = new ProductItem();
        $product_item->product_id = $product->id;
        $product_item->name = $product_name;
        $product_item->description = $product_description;
        $product_item->img = null;
        $product_item->price = $price;
        $product_item->quantity = $quantity;
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

    }
}