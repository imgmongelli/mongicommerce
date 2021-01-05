<?php


namespace Mongi\Mongicommerce\Libraries;


use Illuminate\Http\Request;
use Mongi\Mongicommerce\Models\Category;
use Mongi\Mongicommerce\Models\Detail;
use Mongi\Mongicommerce\Models\DetailValue;
use Mongi\Mongicommerce\Models\Product;
use Mongi\Mongicommerce\Models\ProductItem;
use Mongi\Mongicommerce\Models\ProductItemDetail;


class Template
{
    public static function getStructureCategories(){

        $categories = Category::with('children')->whereNull('parent_id')->get();
        $tree = [];
        foreach($categories as $category){
            $tree[] = [
                'id' => $category->id,
                'text' => $category->name,
                'state' => ['opened'=>true],
                'children' =>  self::recursiveChildren($category->children)
            ];
        }
        return $tree;
    }

    private static function recursiveChildren($childrens){
        $childs = [];
        foreach ($childrens as $children){
            $childs[] = [
                'id' => $children->id,
                'text' => $children->name,
                'state' => ['opened'=>true],
                'children' =>  self::recursiveChildren($children->children)
            ];
        }
        return $childs;
    }


    /**
     * @param Int $id
     * @return Product
     */
    public static function getProducts($id = null){
        if($id === null){
            $products = Product::all();
        }else{
            if(Category::find($id)){
                $belong_to_this_category = Category::find($id)->children->pluck('id')->toArray();
                $result = array_merge($belong_to_this_category, [0 =>$id]);
                $products = Product::whereIn('category_id',$result)->get();
            }else{
                $products = [];
            }
        }
        return $products;
    }

    public static function getDetailsFields(Product $product){
        $element = '<div class="row">';

        foreach($product->details->groupBy('product_detail_id') as $key => $details){

            $element.= self::generateDetailHtml(Detail::find($key),$details->groupBy('product_detail_value_id'),$product->id);
        }
        $element.= '<button class="btn btn-primary mt-3">Salva nel carrello</button>';
        $element.= '<p class="show_error_product" style="color: red; display: none;">Prodotto non disponibile</p>';
        $element .= '</div>';
        return $element;
    }

    public static function generateDetailHtml($detail,$values,$product_id){

        $type = $detail->type;
        $html = '';
        $filters = Session()->get('filters');
        if($type === 'select'){
            $html = '<label>'.$detail->name.'</label>';
            $html .= '<select onchange="getVariationProduct()" data-product_id="'.$product_id.'" data-detail_id="'.$detail->id .'" class="form-control mongifield_into_product">';
            $html .= '<option value="">Seleziona</option>';
            $selected = '';

            foreach ($values as $detail_value_id =>$value){

                if(isset($filters[$detail->id])){
                    if($filters[$detail->id] == $detail_value_id){
                        $selected = 'selected';
                    }else{
                        $selected = '';
                    }
                }
                $html .= '<option '.$selected.' value="'.$detail_value_id.'">'.DetailValue::find($detail_value_id)->value.'</option>';
            }
            $html .= '</select>';
        }


        return $html;
    }
}
