<?php


namespace Mongi\Mongicommerce\Seedeers;


use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mongi\Mongicommerce\Options\DetailTypes;

class UserAdminSeeder extends Seeder
{
     public function run(){
          $user = new User();
          $user->name = 'Gianluca';
          $user->email = 'gianluca.mongelli@gmail.com';
          $user->password = Hash::make('ciaociao');
          $user->first_name = 'Gianluca';
          $user->last_name =  'Mongelli';
          $user->admin = true;
          $user->save();
     }
}
