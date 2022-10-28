<?php


namespace Mongi\Mongicommerce\Http\Controllers\admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Mongi\Mongicommerce\Models\Volantino;
use Illuminate\Support\Facades\Validator;

class AdminVolantiniController
{
    public function page(){
        $volantini = Volantino::all();
        return view('mongicommerce::admin.pages.upload_volantini', ['volantini' => $volantini]);
    }

    public function uploadVolantino(Request $r){
        $validator = Validator::make($r->all(), [
            'nome' => 'required',
            'pdf' => 'required|mimes:pdf|max:8000',
        ]);

        if ($validator->fails()) {
            return ['error' => 'Inserire file e nome.'];
        }else{
            $name = $r->all()['nome'];
            $file_pdf = $r->all()['pdf'];
            $extension_file = $file_pdf->guessExtension();
            $destinationPath = public_path().'/volantini/'.$name.'/';
            $destinationPathDB = url('/').'/volantini/'.$name.'/';
            if(!File::isDirectory($destinationPath)){
                File::makeDirectory($destinationPath, $mode = 0777, true, true);
            }
            $file_name = $name.'.'.$extension_file;
            $dbPath = $destinationPathDB.$file_name;
            $file_pdf->move($destinationPath, $file_name);

            $volantino = new Volantino();
            $volantino->name = $name;
            $volantino->path = $dbPath;
            $volantino->save();
            return true;
        }



    }

    public function deleteVolantino(Request $r){
        $volantino_id = $r->volantino_id;
        Volantino::find($volantino_id)->delete();
        return true;
    }
}
