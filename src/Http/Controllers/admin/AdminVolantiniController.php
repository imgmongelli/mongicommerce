<?php
    
    
namespace Mongi\Mongicommerce\Http\Controllers\admin;

use Illuminate\Http\Request;

class AdminVolantiniController
{
    public function page(){
        return view('mongicommerce::admin.pages.upload_volantini');
    }
    
    public function uploadVolantino(Request  $r){
    
    }
}