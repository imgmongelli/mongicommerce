<?php


namespace Mongi\Mongicommerce\Http\Controllers\admin;

use Illuminate\Http\Request;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\Detail;
use Mongi\Mongicommerce\Models\DetailValue;

class AdminDetailController extends Controller
{
    public function page(){
        $types_details = config('mongicommerce.details');
        return view('mongicommerce::admin.pages.details.create_details',['types' =>$types_details ]);
    }

    public function setNewDetail(Request $r){

        $r->validate([
            'name' => 'required',
            'type' => 'required',
            'category' => 'required'
        ]);

        $name = $r->get('name');
        $type = $r->get('type');
        $values = $r->get('values');
        $category_id = $r->get('category');

        $detail = new Detail();
        $detail->category_id = $category_id;
        $detail->type = $type;
        $detail->name = $name;
        $detail->save();

        if($type === 'select' || $type === 'checkbox' || $type === 'radio'){
            foreach ($values as $value){
                $datails_value = new DetailValue();
                $datails_value->detail_id = $detail->id;
                $datails_value->value = $value;
                $datails_value->save();
            }
        }

        return response()->json(true);
    }

    public function getDetails(Request $r){
        $category_id = $r->get('category_id');
        $details = Detail::where('category_id',$category_id)->get();
        $d = [];
        foreach ($details as $detail){
            $d[] = [
                'name' => $detail->name,
                'type' => $detail->type,
                'values' => $detail->values,
                'html' => $this->generateDetailHtml($detail,$detail->values)
            ];
        }

        return response()->json($d);

    }

    public function generateDetailHtml($detail,$values){
        $type = $detail->type;

        if($type === 'select'){
            $html = '';
            $html .= '<select class="form-control">';
            $html .= '<option value="">Seleziona</option>';
            foreach($values as $value){
                $html .= '<option value="'.$value->id.'">'.$value->value.'</option>';
            }
            $html .= '</select>';
        }

        if($type === 'checkbox'){
            $html = '';

            foreach($values as $value){
                $html .= '<div class="custom-control custom-checkbox">';
                $html .= '<input type="checkbox" class="custom-control-input" id="defaultUnchecked_'.$value->id.'">';
                $html .= '<label class="custom-control-label" for="defaultUnchecked_'.$value->id.'">'.$value->value.'</label>';
                $html .= '</div>';
            }
        }

        if($type === 'radio'){
            $html = '';
            foreach($values as $value){
                $html .= '<div class="custom-control custom-radio">';
                $html .= '<input name="radio_'.$value->detail_id.'"  type="radio" class="custom-control-input" id="defaultradio_'.$value->id.'">';
                $html .= '<label class="custom-control-label" for="defaultradio_'.$value->id.'">'.$value->value.'</label>';
                $html .= '</div>';
            }
        }

        if($type === 'text'){
            $html = '<input  type="text" class="form-control" id="text_' . $detail->id . '">';
        }

        if($type === 'number'){
            $html = '<input  type="number" class="form-control" id="number_' . $detail->id . '">';
        }

        if($type === 'textarea'){
            $html = '<textarea class="form-control" id="textarea_'.$detail->id.'"></textarea>';
        }

        return $html;
    }
}
