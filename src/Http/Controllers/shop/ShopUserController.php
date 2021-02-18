<?php
namespace Mongi\Mongicommerce\Http\Controllers\shop;
use Illuminate\Support\Facades\Auth;
use Mongi\Mongicommerce\Http\Controllers\Controller;

class ShopUserController extends Controller
{
    public function page(){
        $user = Auth::user();
        $piva = $user->piva;
        $rag_soc = $user->company;
        $first_name = $user->first_name;
        $last_name = $user->last_name;
        $address = $user->address;
        $telephone = $user->telephone;
        $email_sped = $user->email;
        $floor = $user->floor;
        $province = $user->province;
        $city = $user->city;
        $cap = $user->cap;
        return view('mongicommerce.pages.user_settings',compact('piva',
            'rag_soc',
            'first_name',
            'last_name',
            'address',
            'telephone',
            'email_sped',
            'floor',
            'province',
            'city',
            'cap'));
    }
}
