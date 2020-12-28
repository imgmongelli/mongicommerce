<?php


namespace Mongi\Mongicommerce\Http\Controllers\admin;


use Illuminate\Http\Request;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\ConfigurationField;
use Mongi\Mongicommerce\Models\ConfigurationFieldValue;
use Mongi\Mongicommerce\Models\Detail;

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
        $configurationFields = ConfigurationField::where('category_id',$category_id)->get();
        $d = [];
        foreach ($configurationFields as $field){
            $d[] = [
                'name' => $field->name,
                'type' => $field->type,
                'html' => $this->generateConfigurationFieldHtml($field)
            ];
        }
        return response()->json($d);

    }

    public function generateConfigurationFieldHtml($field){
        $type = $field->type;
        $html = '';
        if($type === 'textarea'){
            $html = '';
            $html .= '<textarea data-configuration_id="'.$field->id .'" class="form-control mongiconfigurationfield"></textarea>';
        }else{
            $html .= '<input type="'.$type.'" data-configuration_id="'.$field->id .'" class="form-control mongiconfigurationfield">';
        }
        return $html;
    }
}
