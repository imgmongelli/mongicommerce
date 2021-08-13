<?php
namespace Mongi\Mongicommerce\Http\Controllers\shop;
use Illuminate\Http\Request;
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
        $ipa = $user->ipa;
        $cf = $user->cf;
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
            'cap',
            'ipa',
            'cf'));
    }

    public function updateSettings(Request $r){
        $r->validate([
            'cf' => 'nullable|min:16|max:16',
            'ipa' => 'nullable|min:6|max:7',
            'email' => 'nullable|email'
        ]);

        $piva = $r->get('piva');
        $rag_soc = $r->get('rag_soc');
        $first_name = $r->get('first_name');
        $last_name = $r->get('last_name');
        $address = $r->get('address');
        $telephone = $r->get('telephone');
        $email_sped = $r->get('email');
        $floor = $r->get('floor');
        $province = $r->get('province');
        $city = $r->get('city');
        $cap = $r->get('cap');
        $ipa = $r->get('ipa');
        $cf = $r->get('cf');

        $user = Auth::user();

        $user->piva = $piva;
        $user->company = $rag_soc;
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->address = $address;
        $user->telephone = $telephone;
        $user->email = $email_sped;
        $user->floor = $floor;
        $user->province = $province;
        $user->city = $city;
        $user->cap = $cap;
        $user->ipa = $ipa;
        $user->cf = $cf;
        $user->save();

    }
}
