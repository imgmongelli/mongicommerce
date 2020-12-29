<?php


namespace Mongi\Mongicommerce\Libraries;


use Mongi\Mongicommerce\Models\Category;
use Mongi\Mongicommerce\Models\Product;


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
}
