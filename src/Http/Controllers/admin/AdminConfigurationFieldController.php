<?php


namespace Mongi\Mongicommerce\Http\Controllers\admin;


use Illuminate\Http\Request;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\ConfigurationField;
use Mongi\Mongicommerce\Models\ConfigurationFieldValue;
use Mongi\Mongicommerce\Models\Detail;
use Mongi\Mongicommerce\Models\ProductConfigurationField;

class AdminConfigurationFieldController extends Controller
{
    public function setNewConfiguration(Request $r){

        $r->validate([
            'name' => 'required',
            'type' => 'required',
            'category' => 'required'
        ]);

        $name = $r->get('name');
        $type = $r->get('type');
        $category_id = $r->get('category');

        $configuration = new ConfigurationField();
        $configuration->category_id = $category_id;
        $configuration->type = $type;
        $configuration->name = $name;
        $configuration->save();

        return response()->json(true);
    }

    public function getConfigurationFields(Request $r){
        $category_id = $r->get('category_id');
        $is_edit = $r->get('is_edit') ? $r->get('is_edit') : false;
        $product_item_id = $r->get('product_item_id') ? $r->get('product_item_id') : null;
        $configurationFields = ConfigurationField::where('category_id',$category_id)->get();
        $d = [];
        foreach ($configurationFields as $field){
            $d[] = [
                'name' => $field->name,
                'type' => $field->type,
                'html' => $this->generateConfigurationFieldHtml($field, $is_edit, $product_item_id)
            ];
        }
        return response()->json($d);

    }

    public function generateConfigurationFieldHtml($field, $is_edit, $product_item_id){
        $type = $field->type;
        $html = '';
        if($type === 'textarea'){
            $html = '';
            if(!$is_edit){
                $html .= '<textarea data-configuration_id="'.$field->id .'" class="form-control mongiconfigurationfield"></textarea>';
            }else{
                $product_configuration_fields = ProductConfigurationField::where('config_field_id', $field->id)
                                                ->where('product_item_id', $product_item_id)->first();
                if(isset($product_configuration_fields)){
                    $html .= '<textarea data-configuration_id="'.$field->id .'" class="form-control mongiconfigurationfield">'
                        .$product_configuration_fields->value.'</textarea>';
                }else{
                    $html .= '<textarea data-configuration_id="'.$field->id .'" class="form-control mongiconfigurationfield"></textarea>';
                }

            }

        }else{
            if(!$is_edit) {
                $html .= '<input type="' . $type . '" data-configuration_id="' . $field->id . '" class="form-control mongiconfigurationfield">';
            }else{
                $product_configuration_fields = ProductConfigurationField::where('config_field_id', $field->id)
                    ->where('product_item_id', $product_item_id)->first();
                if(isset($product_configuration_fields)) {
                    $html .= '<input type="' . $type . '" data-configuration_id="' . $field->id .
                        '" class="form-control mongiconfigurationfield" value="' . $product_configuration_fields->value . '">';
                }else{
                    $html .= '<input type="' . $type . '" data-configuration_id="' . $field->id . '" class="form-control mongiconfigurationfield">';
                }
            }
        }
        return $html;
    }

    public function deleteConfigurationFields(Request $r){
        $r->validate([
            'config_name' => 'required',
            'category' => 'required'
        ]);
        $configuration_field_name = $r->get('config_name');
        $category_id = $r->get('category');
        $configuration_field = ConfigurationField::where('name', $configuration_field_name)
                                ->where('category_id', $category_id)
                                ->first();
        $products_configuration_fields = ProductConfigurationField::where('config_field_id', $configuration_field->id)->get();
        foreach ($products_configuration_fields as $product_configuration_field) {
            $product_configuration_field->delete();
        }
        $configuration_field->delete();
        return true;
    }
}
