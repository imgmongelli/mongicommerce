<?php


namespace Mongi\Mongicommerce\Http\Controllers\admin;


use Mongi\Mongicommerce\Http\Controllers\Controller;

class AdminDetailController extends Controller
{
    public function page(){
        $types_details = config('mongicommerce.details');

        return view('mongicommerce::admin.pages.details.details',['types' =>$types_details ]);
    }
}
