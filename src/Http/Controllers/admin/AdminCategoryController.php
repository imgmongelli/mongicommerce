<?php


namespace Mongi\Mongicommerce\Http\Controllers\admin;


use Mongi\Mongicommerce\Http\Controllers\Controller;

class AdminCategoryController extends Controller
{
    public function page(){
        return view('mongicommerce::admin.pages.category.new_category');
    }
}
