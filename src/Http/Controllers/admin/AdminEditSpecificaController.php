<?php


namespace Mongi\Mongicommerce\Http\Controllers\admin;
use Mongi\Mongicommerce\Models\ConfigurationField;
use Mongi\Mongicommerce\Models\ProductConfigurationField;
use Illuminate\Http\Request;

class AdminEditSpecificaController
{
    public function page($id){
        $products_config_fields = ProductConfigurationField::where('product_item_id', $id)->get();
        $config_fields = ConfigurationField::all();
        $count = ProductConfigurationField::where('product_item_id', $id)->count();
        return view('mongicommerce::admin.pages.products.editSpecifica',compact('products_config_fields','config_fields','count'));
    }

    public function saveSpecifica(Request $r){
        $id = $r->id;
        $value = $r->value;

        $products_config_fields = ProductConfigurationField::find($id);

        $products_config_fields->value = $value;
        $products_config_fields->save();
        return true;
    }
}
