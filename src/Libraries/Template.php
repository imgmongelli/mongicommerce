<?php


namespace Mongi\Mongicommerce\Libraries;


use Illuminate\Http\Request;
use Mongi\Mongicommerce\Models\Category;
use Mongi\Mongicommerce\Models\Detail;
use Mongi\Mongicommerce\Models\DetailValue;
use Mongi\Mongicommerce\Models\Product;
use Mongi\Mongicommerce\Models\ProductConfigurationField;
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
            $products = Category::find($id)->products;
        }
        return $products;
    }

    public static function getDetailsFields(Product $product,$product_item_id){
        $element = '<div class="row">';

        foreach($product->details->groupBy('product_detail_id') as $key => $details){

            $element.= self::generateDetailHtml(Detail::find($key),$details->groupBy('product_detail_value_id'),$product->id,$product_item_id);
        }
        $element.= '<p class="show_error_product" style="color: red; display: none;">Prodotto non disponibile</p>';
        $element .= '</div>';
        return $element;
    }

    public static function generateHtmlField($type,$value,$label){
        if($type !== 'textarea'){
            $html = '';
            $html .= "<label>{$label}</label>";
            $html .= "<input class='form-control' type='{$type}' value='{$value}'>";
            return $html;
        }else{
            $html = '';
            $html .= "<label>{$label}</label>";
            $html .= "<textarea class='form-control'>{$value}</textarea>";
            return $html;
        }
    }

    public static function getConfigurationFields($product_item_id){
        $configurationFields = ProductConfigurationField::where('product_item_id',$product_item_id)->get();
        $element = '';
        foreach ($configurationFields as $field){
                $element .= '<div class="row">';
                $element .= self::generateHtmlField($field->field->type,$field->value,$field->field->name);
                $element .= '</div>';
            }
        return $element;
    }

    public static function buttonCart($product_item_id){
        return "<button onclick='addToCart(this)' data-product_item_id='{$product_item_id}' class='btn btn-primary mt-3'>Salva nel carrello</button>";
    }

    public static function generateDetailHtml($detail,$values,$product_id,$product_item_id){

        $type = $detail->type;
        $html = '';
        if($type === 'select'){
            $html = '<label>'.$detail->name.'</label>';
            $html .= '<select onchange="getVariationProduct()" data-product_id="'.$product_id.'" data-detail_id="'.$detail->id .'" class="form-control mongifield_into_product">';
            $selected = '';

            $details = ProductItemDetail::where('product_item_id',$product_item_id)->get();
            $filter = [];
            foreach ($details as $_detail){
                $filter[$_detail->product_detail_id] = $_detail->product_detail_value_id;
            }
            foreach ($values as $detail_value_id =>$value){
                if(isset($filter[$detail->id])){
                    if($filter[$detail->id] == $detail_value_id){
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
