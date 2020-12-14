<?php


namespace Mongi\Mongicommerce\Seedeers;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Mongi\Mongicommerce\Options\DetailTypes;

class DetailTypeSeeder extends Seeder
{
     public function run(){
         foreach (DetailTypes::all() as $detail) {
             DB::table('detail_type')->insert(['name' => $detail]);
         }
     }
}
