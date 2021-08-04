<?php


namespace Mongi\Mongicommerce\Http\Controllers\shop;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\ProductItem;
use Mongi\Mongicommerce\Models\ProductItemDetail;

class ShopShowVariationProductController extends Controller
{
    public function getData(Request $r)
    {
        $r->validate([
            'product_id' => 'required'
        ]);

        $informations = $r->get('informations');
        $product_id = $r->get('product_id');

        $flash_data = $r->get('flash_data');
        session()->flash('filters', $flash_data);

        $g = '';
        foreach ($informations as $key => $information) {
            $information = (object)$information;
            $product_detail_id = $information->product_detail_id;
            $product_detail_value_id = $information->product_detail_value_id;
            $condition = '';

            if(count($informations) == $key +1){
                $condition = '';
            }else{
                $condition = 'or';
            }
            $g .= ('(a.product_detail_id ='.$product_detail_id.' and a.product_detail_value_id ='.$product_detail_value_id.') '.$condition.'');
        }
        $q = DB::table('product_item_details AS p')->select(DB::raw('product_item_id, count(*) as num_details'))->groupByRaw('product_item_id having num_details = ( select count(*) from product_item_details a where a.product_item_id = p.product_item_id and ('.$g.'))');

        //$result = $q->first();
        $result = [];
        //check if we are taken the right product because in $q there can be more than one record
        foreach ($q->get() as $item){
            if(ProductItem::find($item->product_item_id)->product_id == $product_id){
                $result = $item;
            }
        }

        if($result){
            $filters = $result->num_details >= count($informations);
            if($filters){
                $product_item_id = $result->product_item_id;

                return response()->json(route('shop.single.product',[$product_id,$product_item_id]));
            }else{
                return response()->json(false);
            }
        }else{
            return response()->json(false);
        }


    }
}
