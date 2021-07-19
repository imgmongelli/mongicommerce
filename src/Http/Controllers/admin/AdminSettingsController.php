<?php


namespace Mongi\Mongicommerce\Http\Controllers\admin;

use Illuminate\Http\Request;
use Mongi\Mongicommerce\Models\AdminSetting;
use Mongi\Mongicommerce\Models\Setting;

class AdminSettingsController
{
    public function page(){
        $settings = AdminSetting::first();
        return view('mongicommerce::admin.pages.settings',['settings' => $settings]);
    }

    public function update(Request $r){
        $settings = Setting::first();
        $settings->shop_name = $r->nome_negozio;
        $settings->iban = $r->iban;
        $settings->email = $r->email;
        $settings->minimum_shop = $r->acquisto_min;
        $settings->stripe_api_key = $r->api_key;
        $settings->stripe_api_secret = $r->api_secret;
        $settings->share_capital = $r->capitale_sociale;
        $settings->address = $r->indirizzo;
        $settings->currency = $r->currency;
        $settings->telephone = $r->telefono;
        $settings->claim_email = $r->email_reclami;
        $settings->piva = $r->piva;
        $settings->free_delivery = $r->free_delivery;
        $settings->min_delivery = $r->min_delivery;
        $settings->is_by_weight = $r->is_by_weight == 'true' ? true : false;
        $settings->delivery_less_5 = $r->less_5;
        $settings->delivery_less_10 = $r->less_10;
        $settings->delivery_less_20 = $r->less_20;
        $settings->delivery_less_30 = $r->less_30;
        $settings->delivery_less_50 = $r->less_50;
        $settings->save();
    }
}
