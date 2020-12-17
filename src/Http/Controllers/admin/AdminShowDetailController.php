<?php


namespace Mongi\Mongicommerce\Http\Controllers\admin;

use Illuminate\Http\Request;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\Detail;
use Mongi\Mongicommerce\Models\DetailValue;

class AdminShowDetailController extends Controller
{
    public function page(){
        return view('mongicommerce::admin.pages.details.show_details');
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
                'html' => $this->generateDetailHtml($detail->type,$detail->values)
            ];
        }

        return response()->json($d);

    }

    public function generateDetailHtml($type,$values){
        if($type === 'select'){
            $html = '';
            $html .= '<select class="form-control">';
            $html .= '<option value="">Seleziona</option>';
            foreach($values as $value){
                $html .= '<option value="'.$value->id.'">'.$value->value.'</option>';
            }
            $html .= '</select>';
            return $html;
        }
        if($type === 'checkbox'){
            $html = '';

            foreach($values as $value){
                $html .= '<div class="custom-control custom-checkbox">';
                $html .= '<input type="checkbox" class="custom-control-input" id="defaultUnchecked_'.$value->id.'">';
                $html .= '<label class="custom-control-label" for="defaultUnchecked_'.$value->id.'">'.$value->value.'</label>';
                $html .= '</div>';
            }

            return $html;
        }
    }

}
