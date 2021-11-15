<?php


namespace Mongi\Mongicommerce\Http\Controllers\admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\PrivateList;
use Mongi\Mongicommerce\Models\Product;
use Mongi\Mongicommerce\Models\ProductPrivateList;
use Mongi\Mongicommerce\Models\Volantino;

class AdminCreatePrivateListController extends Controller
{
    public function page(){
        $products = Product::where('deleted', false)->get();
        $lists = PrivateList::all();
        return view('mongicommerce::admin.pages.lista_privata',['products' => $products, 'lists' => $lists]);
    }

    public function createList(Request $r){
        $name_list = $r->list_name;
        $array_list = $r->products;
        $reserved = $r->reserved;
//        return ['lista' => $array_list, 'reserved' => $reserved];
        $new_list = new PrivateList();
        $new_list->name = $name_list;
        $new_list->id_list = md5(Carbon::now());
        $new_list->save();
        foreach ($array_list as $product_id){
            $new_product_list = new ProductPrivateList();
            $new_product_list->lista_id = $new_list->id;
            $new_product_list->product_id = $product_id;
            $new_product_list->save();
            if($reserved and in_array($product_id,$reserved)){
                $product = Product::where('id', $product_id)->first();
                $product->is_reserved = true;
                $product->save();
            }
        }
//        if($reserved) {
//            foreach ($reserved as $res_id) {
//                $product = Product::where('id', $res_id)->first();
//                $product->is_reserved = true;
//                $product->save();
//            }
//        }

        return true;
    }

    public function deleteList(Request $r){
        $list_id = $r->list_id;
        ProductPrivateList::where('lista_id', $list_id)->delete();
        PrivateList::find($list_id)->delete();
        return true;
    }

}
