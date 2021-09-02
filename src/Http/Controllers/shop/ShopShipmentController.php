<?php
namespace Mongi\Mongicommerce\Http\Controllers\shop;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mongi\Mongicommerce\Models\Cart;
use Mongi\Mongicommerce\Models\User;
use Mongi\Mongicommerce\Models\ProductItem;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Libraries\Template;

class ShopShipmentController extends Controller
{
    public function page(){
        //if logged in
        $piva = '';
        $rag_soc = '';
        $first_name = '';
        $last_name = '';
        $address = '';
        $telephone = '';
        $email_sped = '';
        $floor = '';
        $province = '';
        $city = '';
        $cap = '';
        $cf = '';
        $ipa = '';
        if(Auth::check()){
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
                Template::MoveSessionToCart($user->id);
        }

        return view('mongicommerce.pages.shipment',compact(
            'piva',
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
            'cf',

        ));
    }

    public function goToCheckout(Request $r)
    {
        $r->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'telephone' => 'required',
            'email_sped' => 'required',
            'province' => 'required',
            'city' => 'required',
            'cap' => 'required',
            'cf' => 'nullable|min:16|max:16',
            'ipa' => 'nullable|min:6|max:7',
        ]);


        $piva = $r->get('piva');
        $rag_soc = $r->get('rag_soc');
        $first_name = $r->get('first_name');
        $last_name = $r->get('last_name');
        $address = $r->get('address');
        $telephone = $r->get('telephone');
        $email_sped = $r->get('email_sped');
        $floor = $r->get('floor');
        $province = $r->get('province');
        $city = $r->get('city');
        $cap = $r->get('cap');
        $ipa = $r->get('ipa');
        $cf = $r->get('cf');

        $user = User::where('email',$email_sped)->first();
        //if user exist
        if($user){
                $user->piva = $piva;
                $user->company = $rag_soc;
                $user->first_name = $first_name;
                $user->last_name = $last_name;
                $user->address = $address;
                $user->telephone = $telephone;
                $user->floor = $floor;
                $user->province = $province;
                $user->city = $city;
                $user->cap = $cap;
                $user->ipa = $ipa;
                $user->cf = $cf;
                $user->save();
        //if user doesn't exist
        }else{
            $user = new User();
            $user->piva = $piva;
            $user->company = $rag_soc;
            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->email = $email_sped;
            $user->password = Hash::make('ciaociao');
            $user->address = $address;
            $user->telephone = $telephone;
            $user->floor = $floor;
            $user->province = $province;
            $user->city = $city;
            $user->cap = $cap;
            $user->ipa = $ipa;
            $user->cf = $cf;
            $user->save();
            Auth::login($user);
        }
        Template::MoveSessionToCart($user->id);
        return response()->json(['link' => route('shop.checkout')]);

    }
}
