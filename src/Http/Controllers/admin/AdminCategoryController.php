<?php


namespace Mongi\Mongicommerce\Http\Controllers\admin;


use Illuminate\Http\Request;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\Category;
use Mongi\Mongicommerce\Models\ConfigurationField;
use Mongi\Mongicommerce\Models\Detail;
use Mongi\Mongicommerce\Models\DetailValue;
use Mongi\Mongicommerce\Models\Product;

class AdminCategoryController extends Controller
{
    public function page(){
        return view('mongicommerce::admin.pages.category.new_category');
    }

    public function setNewCategory(Request $r){
        $r->validate([
            'name' => 'required',
            'description' => 'max:255'
        ]);
        $name = $r->get('name');
        $description = $r->get('description');
        $parent_id = $r->get('parent_id');
        $category = new Category();
        $category->name = $name;
        $category->description = $description;
        $category->parent_id = $parent_id;
        $category->save();
    }

    public function getCategories(){
        $data = $this->getCategoryTree();
        return Response()->json($data);
    }

    function getCategoryTree($parent_id = null, $spacing = '', $tree_array = array()) {
        $categories = Category::select('id', 'name', 'parent_id')->where('parent_id' ,'=', $parent_id)->orderBy('parent_id')->get();
        foreach ($categories as $item){
            $tree_array[] = ['id' => $item->id, 'name' =>$spacing . $item->name] ;
            $tree_array = $this->getCategoryTree($item->id, $spacing . '- ', $tree_array);
        }
        return $tree_array;
    }

    public function getStructureCategories(){

        $categories = Category::with('children')->whereNull('parent_id')->get();
        $tree = [];
        foreach($categories as $category){
                $tree[] = [
                    'id' => $category->id,
                    'text' => $category->name,
                    'state' => ['opened'=>true],
                    'children' =>  $this->recursiveChildren($category->children)
                ];
        }
        return response()->json($tree);
    }

    private function recursiveChildren($childrens){
        $childs = [];
        foreach ($childrens as $children){
            $childs[] = [
                'id' => $children->id,
                'text' => $children->name,
                'state' => ['opened'=>true],
                'children' => $this->recursiveChildren($children->children)
            ];
        }
        return $childs;
    }

    public function deleteCategory(Request $r){
        $category_id = $r->category_id;
        $products = Product::where('category_id', $category_id)->count();
        if($products > 0) {
            return ['error' => 'Per questa categoria ci sono '.$products.' prodotti. Elimina prima i prodotti per questa categoria.'];
        }
        $parent_categories = Category::where('parent_id', $category_id)->get();
        foreach ($parent_categories as $category){
            $products = Product::where('category_id', $category->id)->count();
            if($products > 0){
                return ['error' => 'Per questa categoria '.$category->name .' ci sono '.$products.' prodotti. Elimina prima i prodotti per questa categoria.'];
            } else{
                ConfigurationField::where('category_id', $category->id)->delete();
                $details = Detail::where('category_id', $category->id);
                foreach ($details->get() as $detail){
                    DetailValue::find($detail->id)->delete();
                }
                $details->delete();
                Category::find($category->id)->delete();
            }
        }
        ConfigurationField::where('category_id', $category_id)->delete();
        $details = Detail::where('category_id', $category_id);
        foreach ($details->get() as $detail){
            DetailValue::find($detail->id)->delete();
        }
        $details->delete();
        Category::find($category_id)->delete();
        return true;
    }


}
