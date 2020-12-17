<?php


namespace Mongi\Mongicommerce\Http\Controllers\admin;

use Illuminate\Http\Request;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\Detail;
use Mongi\Mongicommerce\Models\DetailValue;

class AdminCreateDetailController extends Controller
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
}
