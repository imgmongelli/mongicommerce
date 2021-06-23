<?php


namespace Mongi\Mongicommerce\Http\Controllers\admin;

use Illuminate\Http\Request;
use Mongi\Mongicommerce\Models\Volantino;

class AdminVolantiniController
{
    public function page(){
        $volantini = Volantino::all();
        return view('mongicommerce::admin.pages.upload_volantini', ['volantini' => $volantini]);
    }

    public function uploadVolantino(Request  $r){

    }

    public function deleteVolantino(Request $r){
        $volantino_id = $r->volantino_id;
        Volantino::find($volantino_id)->delete();
        return true;
    }
}
