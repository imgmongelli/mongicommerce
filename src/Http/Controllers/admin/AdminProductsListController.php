<?php


namespace Mongi\Mongicommerce\Http\Controllers\admin;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\Cart;
use Mongi\Mongicommerce\Models\GiftCode;
use Mongi\Mongicommerce\Models\PrivateList;
use Mongi\Mongicommerce\Models\Product;
use Mongi\Mongicommerce\Models\ProductConfigurationField;
use Mongi\Mongicommerce\Models\ProductItem;
use Mongi\Mongicommerce\Models\ProductItemDetail;
use Mongi\Mongicommerce\Models\ProductPrivateList;

class AdminProductsListController extends Controller
{
    public function page(){
        $products = Product::where('deleted', false)->get();
        $product_item = null;
        return view('mongicommerce::admin.pages.products.products_list', compact('products', 'product_item'));
    }

    public function inHome(Request $r){
        $product_id = $r->product_id;
        $is_checked = $r->is_checked == 'true' ? true : false;
        $product = Product::find($product_id);
        $product->is_home = $is_checked;
        $product->save();
        return true;
    }

    public function deleteSingleProduct(Request $r){
        $product_id = $r->product_id;
        $product = Product::find($product_id);
        $product_item = ProductItem::where('product_id', $product_id)->first();
        if($product_item->count() > 0){
            $product_item_id = $product_item->id;
            if($product->is_gift){
//                //takes all gifts card boughted but not used
//                $gift_in_progress = GiftCode::where('product_item_id', $product_item_id)
//                                    ->whereNotNull('bought_the')
//                                    ->where('is_validated', false)
//                                    ->whereDate('expires_on', '>=', Carbon::now());
//
//                if($gift_in_progress->count() > 0){
//                    return ['error' => 'Impossibile eliminare gift card poiché ce ne sono alcune acquistate ma non utilizzate!'];
//                }else{
            GiftCode::where('product_item_id', $product_item_id)->where('bought_the', null)->delete();
//                }
            }
            ProductConfigurationField::where('product_item_id', $product_item_id)->delete();
            Cart::where('product_item_id', $product_item_id)->delete();
            $product_item->deleted = true;
            $product_item->save();
        }
        ProductPrivateList::where('product_id', $product_id)->delete();
        $product->deleted = true;
        $product->save();
        return true;
    }

    public function deleteAllVariationsProduct(Request $r){
        $product_id = $r->product_id;
        $product_items = ProductItem::where('product_id', $product_id)->get();
        $product = Product::find($product_id);
        foreach($product_items as $product_item) {
            $product_item_id = $product_item->id;
            if($product->is_gift){
                GiftCode::where('product_item_id', $product_item_id)->where('bought_the', null)->delete();
            }
            ProductItemDetail::where('product_item_id', $product_item_id)->delete();
            ProductConfigurationField::where('product_item_id', $product_item_id)->delete();
            Cart::where('product_item_id', $product_item_id)->delete();
            $product_item->deleted = true;
            $product_item->save();
        }
        ProductPrivateList::where('product_id', $product_id)->delete();
        $product->deleted = true;
        $product->save();

        return true;
    }


}
