<?php
namespace Mongi\Mongicommerce\Http\Controllers\shop;
use Illuminate\Support\Facades\Auth;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\PrivateList;

class ShopPrivateListController extends Controller
{
    public function page($list_id){
        $list = PrivateList::where('id_list', $list_id)->first();
        $products = $list->products;
        return view('mongicommerce.pages.private_list', compact('list', 'products'));
    }
}
